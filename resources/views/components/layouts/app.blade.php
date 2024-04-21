<!-- resources/views/layouts/admin-layout.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-200 font-sans">
    <!-- Navigation -->
    <nav class="bg-blue-500 p-4">
        <div class="container mx-auto">
            <h1 class="text-white text-xl font-bold">Admin Panel</h1>
        </div>
    </nav>

    <!-- Page Content -->
    <div class="container mx-auto mt-4">
        {{ $slot }}
    </div>

    <!-- Footer -->
    <footer class="bg-blue-500 text-white text-center py-4 mt-8">
        <p>&copy; {{ date('Y') }} Your Company</p>
    </footer>
</body>

</html>
