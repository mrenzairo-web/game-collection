<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::all();
        return view('game', compact('games'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'        => 'required',
            'category'     => 'required',
            'release_date' => 'required',
            'developer'    => 'required',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('games', 'public');
        }

        Game::create($data);
        return back()->with('success', 'Game added successfully!');
    }

    public function update(Request $request, $id)
    {
        $game = Game::findOrFail($id);

        $data = $request->validate([
            'title'        => 'required',
            'category'     => 'required',
            'release_date' => 'required',
            'developer'    => 'required',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($game->image) {
                \Storage::disk('public')->delete($game->image);
            }
            $data['image'] = $request->file('image')->store('games', 'public');
        }

        $game->update($data);
        return back()->with('success', 'Game updated successfully!');
    }

    public function destroy($id)
    {
        $game = Game::findOrFail($id);

        if ($game->image) {
            \Storage::disk('public')->delete($game->image);
        }

        $game->delete();
        return back()->with('success', 'Game deleted successfully!');
    }
}