<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PizZaky')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <style>
        .no-padding {
            padding: 0 !important;
            margin: 0 !important;
        }
    </style>
</head>
<body style="display: flex; flex-direction: column; min-height: 100vh;">

<div class="shadow-md position-relative" style="z-index: 10;">
    @include('components.navbar')
</div>

    <!-- Konten halaman -->
    <div class="container-fluid px-0" style="flex-grow: 1;">
        @yield('content')
    </div>

    <!-- Memanggil footer -->
    @include('components.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
