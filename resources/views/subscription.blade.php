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
    <nav class="fixed top-0 w-full bg-gray-800 text-gray-300 shadow p-5 z-50">
        <div class="container mx-auto flex justify-between items-center px-4">
            <a class="text-xl font-bold" href="#">Education Hub</a>
            <div class="hidden md:flex space-x-6">
                <a class="hover:text-gray-50 font-semibold" href="{{route('home')}}">Home</a>
                <a class="hover:text-gray-50 font-semibold" href="#about">About</a>
                <a class="hover:text-gray-50 font-semibold" href="#profile">Profile</a>
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

    <!-- Subscription Plan -->
    <div class="h-[calc(100vh-136px)] mt-[68px]">
        <div class="container mx-auto p-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                @foreach($plans as $plan)
                <div class="bg-gray-200 p-2">
                    <h3 class="text-xl text-blue-800 font-semibold text-center">{{$plan->name}}</h3>
                    <div class="text-center">
                        <span class="font-semibold">$ {{$plan->plan_amount}}.00</span>
                    </div>
                    <div class="text-center mt-4">
                        <button class="p-2 bg-blue-700 text-white text-sm font-medium rounded"
                            onclick="openModal('confirmationModal')">Subscribe</button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div id="confirmationModal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50">
        <div class="bg-white rounded-lg shadow-lg w-11/12 max-w-md">
            <div class="flex justify-between items-center border-b p-4">
                <h3 class="text-xl font-semibold text-gray-700">Confirm Subscription</h3>
                <button onclick="closeModal('confirmationModal')"
                    class="text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
            </div>

            <div class="p-4">
                <p class="text-gray-600">
                    Are you sure you want to subscribe to this plan?
                </p>
            </div>

            <div class="flex justify-end space-x-3 border-t p-4">
                <button onclick="closeModal('confirmationModal')"
                    class="bg-red-500 transition-all duration-200 text-white px-4 py-2 rounded hover:bg-red-700">
                    Cancel
                </button>
                <button
                    class="bg-green-700 transition-all duration-200 text-white px-4 py-2 rounded hover:bg-green-800">
                    Confirm
                </button>
            </div>

        </div>
    </div>


    <!-- Footer -->
    <footer class="bg-gray-800 py-6 text-center text-sm text-gray-400">
        <div class="container mx-auto">&copy; 2023 - Company Name</div>
    </footer>
    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
            document.getElementById(modalId).classList.add('flex');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
            document.getElementById(modalId).classList.remove('flex');
        }
    </script>
</body>

</html>