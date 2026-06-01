<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 

class DashboardController extends Controller
{
    public function showdashboard()
    {
        $totalUsers = User::count(); 
        
        $totalMenus = 86; 
        $activeOrders = 24;
        $cancelledOrders = 3;

        return view('dashboard', compact('totalUsers', 'totalMenus', 'activeOrders', 'cancelledOrders'));
    }
}