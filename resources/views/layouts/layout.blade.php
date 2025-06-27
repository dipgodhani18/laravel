<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Laravel</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('/frontend/assets/favicon.ico') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="{{ asset('/frontend/css/styles.css') }}" rel="stylesheet" />
</head>

<body>
    <!-- Navigation -->
    <nav class="fixed top-0 w-full bg-gray-800 text-gray-300 shadow md:p-5 p-4 z-50">
        <div class="container mx-auto flex justify-between items-center px-4">
            <a class="text-xl font-bold" href="{{route('home')}}">Education Hub</a>
            <div class="hidden md:flex space-x-6">
                <a class="hover:text-gray-50 font-semibold" href="#about">About</a>
                <a class="hover:text-gray-50 font-semibold" href="#profile">Profile</a>
                <a class="hover:text-gray-50 font-semibold" href="{{route('subscription')}}">Subscription</a>
                <a class="hover:text-red-400 font-semibold" href="#"
                    onclick="event.preventDefault(); document.getElementById('logout_form').submit();">Logout</a>

                <form action="{{route('logout')}}" method="POST" id="logout_form" style="display: none;">
                    @csrf
                </form>
            </div>
            <div class="md:hidden">
                <button id="mobileMenuToggle" class="text-gray-600 focus:outline-none">
                    <i class="bi bi-list text-2xl"></i>
                </button>
            </div>
        </div>
        <div id="mobileMenu" class="md:hidden hidden flex-col px-4 space-y-2 mt-4">
            <a class="hover:text-gray-50 font-semibold" href="#about">About</a>
            <br>
            <a class="hover:text-gray-50 font-semibold" href="#profile">Profile</a>
            <br>
            <a class="hover:text-red-400 font-semibold" href="#"
                onclick="event.preventDefault(); document.getElementById('logout_form').submit();">Logout</a>

            <form action="{{route('logout')}}" method="POST" id="logout_form" style="display: none;">
                @csrf
            </form>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="">
        @yield('content')
    </main>

    <!-- Flash Messages -->
    <div class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50">
        @if(session('success'))
        <div class="bg-green-500 text-white px-4 py-2 rounded shadow mb-2">{{ session('success') }}</div>
        @endif

        @if(session('error'))
        <div class="bg-red-500 text-white px-4 py-2 rounded shadow">{{ session('error') }}</div>
        @endif
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 py-6 text-center text-sm text-gray-400">
        <div class="container mx-auto">&copy; 2023 - Company Name</div>
    </footer>

    <script src="{{ asset('/frontend/js/scripts.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    @stack('scripts')

</body>

</html>