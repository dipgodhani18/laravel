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
            <a class="text-xl font-bold" href="#">Education Hub</a>
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

    <!-- Masthead -->
    <header class="h-screen text-white text-center flex flex-col justify-center items-center px-4 masthead-section">
        <h1 class="text-4xl md:text-5xl font-bold">Your Favorite Place for Free Bootstrap Themes</h1>
        <hr class="w-32 border-t-2 border-white my-6 mx-auto">
        <p class="max-w-2xl text-lg">Start Bootstrap can help you build better websites using the Bootstrap framework!
            Just download a theme and start customizing, no strings attached!</p>
        <a href="#about"
            class="mt-6 bg-blue-600 text-white px-5 py-2 rounded transition duration-300 ease-in-out hover:bg-blue-700 ">
            Find Out More
        </a>
    </header>

    <!-- About -->
    <section id="about" class="bg-blue-700 text-white py-20">
        <div class="container mx-auto text-center px-4">
            <h2 class="text-3xl font-semibold">We've got what you need!</h2>
            <hr class="w-24 border-t-4 border-white my-6 mx-auto">
            <p class="mb-8 max-w-xl mx-auto">Start Bootstrap has everything you need to get your new website up and
                running in no time! Choose one of our open source, free to download, and easy to use themes! No strings
                attached!</p>
            <a class="text-blue-600 bg-white font-semibold px-6 py-2 rounded shadow" href="#services">Get Started!</a>
        </div>
    </section>

    <!-- Services -->
    <section id="services" class="py-20 bg-gray-100">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-8">At Your Service</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 text-center">
                <div>
                    <i class="bi-gem text-4xl text-blue-600"></i>
                    <h3 class="text-xl font-semibold mt-4">Sturdy Themes</h3>
                    <p class="text-gray-600">Our themes are updated regularly to keep them bug free!</p>
                </div>
                <div>
                    <i class="bi-laptop text-4xl text-blue-600"></i>
                    <h3 class="text-xl font-semibold mt-4">Up to Date</h3>
                    <p class="text-gray-600">All dependencies are kept current to keep things fresh.</p>
                </div>
                <div>
                    <i class="bi-globe text-4xl text-blue-600"></i>
                    <h3 class="text-xl font-semibold mt-4">Ready to Publish</h3>
                    <p class="text-gray-600">You can use this design as is, or you can make changes!</p>
                </div>
                <div>
                    <i class="bi-heart text-4xl text-blue-600"></i>
                    <h3 class="text-xl font-semibold mt-4">Made with Love</h3>
                    <p class="text-gray-600">Is it really open source if it's not made with love?</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-20 bg-gray-800 text-white text-center">
        <div class="container mx-auto px-4">
            <h3 class="text-2xl mb-4">Free Download at Start Bootstrap!</h3>
            <a href="https://startbootstrap.com/theme/creative/"
                class="bg-white text-gray-800 px-6 py-2 rounded shadow">Download Now!</a>
        </div>
    </section>

    <!-- Profile -->
    <section id="profile">
        <div class="bg-white/80 py-10 px-4">
            <div class="container mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-semibold">Profile</h2>
                    <hr class="w-24 border-t-4 border-blue-600 my-4 mx-auto">
                    <p class="text-gray-700">View and update your profile</p>
                </div>
                <div class="max-w-xl mx-auto shadow-lg border border-gray-100 p-4">
                    <form method="POST" action="{{ route('home.user.edit', Auth::user()->id) }}">
                        @csrf
                        @method('PATCH')
                        <div class="mb-4">
                            <label for="name" class="block mb-2">Student Name</label>
                            <input id="name" name="name" type="text" value="{{ Auth::user()->name }}"
                                class="w-full px-2 py-2 border">
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block mb-2">Email address</label>
                            <input id="email" name="email" type="email" value="{{ Auth::user()->email }}" disabled
                                class="w-full px-2 py-2 border rounded bg-gray-100 text-gray-600">
                        </div>
                        <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="phone" class="block mb-2">Phone no (+91)</label>
                                <input id="phone" name="phone" type="text" value="{{ Auth::user()->phone }}"
                                    class="w-full px-2 py-2 border rounded">
                            </div>
                            <div>
                                <label for="gender" class="block mb-2">Gender</label>
                                <select id="gender" name="gender" class="w-full px-2 pt-3 pb-2 border">
                                    <option value="" disabled selected>Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-6">
                            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded shadow">Update
                                Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>



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
</body>

</html>