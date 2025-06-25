<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>User Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="bg-blue-100 min-h-screen flex items-center justify-center px-4">
    <div class="w-full max-w-md bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-center text-xl font-semibold text-gray-700 mb-6">Login to continue</h2>

        @if(session('success'))
        <div class="bg-green-100 border border-green-700 text-green-800 text-sm p-3 rounded mb-4 alert-dismissible">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="bg-red-100 text-red-800 border border-red-700 text-sm p-3 rounded mb-4 alert-dismissible">
            {{ session('error') }}
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent"
                    placeholder="name@example.com">
                @foreach ($errors->get('email') as $message)
                <p class="text-sm text-red-700 mt-1">{{ $message }}</p>
                @endforeach
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input id="password" type="password" name="password"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent"
                    placeholder="Password">
                @foreach ($errors->get('password') as $message)
                <p class="text-sm text-red-700 mt-1">{{ $message }}</p>
                @endforeach
            </div>

            <div class="flex items-center mb-4">
                <input id="remember_me" name="remember" type="checkbox"
                    class="h-4 w-4 text-blue-200 focus:ring-blue-500 border-gray-300 rounded cursor-pointer">
                <label for="remember_me" class="ml-2 block text-sm text-gray-700">
                    Remember me
                </label>
            </div>

            <div class="flex justify-between items-center mb-4">
                <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:underline">
                    Forgot Password?
                </a>
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded transition">
                    Login
                </button>
            </div>
        </form>

        <div class="text-center mt-4">
            <p class="text-sm text-gray-600">
                Need an account?
                <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Sign up!</a>
            </p>
        </div>
    </div>
</body>


<script src="{{ asset('/frontend/js/scripts.js') }}"></script>


</html>