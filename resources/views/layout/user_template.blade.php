<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #1a1e21 !important;
            color: #ffffff;
            min-height: 100vh;
            overflow-x: hidden;
        }
    </style>
</head>
<body>

    @include('navbar')

    <main class="container-fluid py-4" style="background-color: #f8f9fa; min-height: 100vh;">
        <div class="row justify-content-center">
            <div class="col-12">
                @yield('content')
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <div class="toast-container position-fixed top-0 start-50 translate-middle-x p-3">
        @if(session('success'))
            <div id="successToast" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body fw-bold text-white">
                        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var toastEl = document.getElementById('successToast');
                    var toast = new bootstrap.Toast(toastEl);
                    toast.show();
                });
            </script>
        @endif
    </div>

</body>
</html>