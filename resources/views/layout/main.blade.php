<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>main.blade</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-dark">

         @include('header')
       
        <div class="bg-dark">
            @yield('content')
        </div>

        <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1100;">
            
            <div id="successToast" class="toast bg-warning text-dark border-0 rounded-3 shadow" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex p-3 justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-check-circle-fill fs-5"></i>
                        <span class="fw-bold" id="successToastMessage">Action Successful!</span>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>

            <div id="errorToast" class="toast bg-danger text-white border-0 rounded-3 shadow" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex p-3 justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-exclamation-triangle-fill fs-5"></i>
                        <span class="fw-bold" id="errorToastMessage">Something went wrong.</span>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>

        </div>
        
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            
            // Pag-check kung may 'success' message na galing sa controller
            @if(session('success'))
                document.getElementById('successToastMessage').innerText = "{{ session('success') }}";
                const successEl = document.getElementById('successToast');
                const showSuccess = new bootstrap.Toast(successEl);
                showSuccess.show();
            @endif

            // Pag-check kung may 'errors' na galing sa validation ng controller
            @if($errors->any())
                document.getElementById('errorToastMessage').innerText = "{{ $errors->first() }}";
                const errorEl = document.getElementById('errorToast');
                const showError = new bootstrap.Toast(errorEl);
                showError.show();
            @endif

        });
    </script>
</body>
</html>