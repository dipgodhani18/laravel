<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Create Accout</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="bg-blue-100 min-h-screen flex items-center justify-center px-4">
    <div class="w-full max-w-xl bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-center text-xl font-semibold text-gray-700 mb-6">Create Your Account</h2>

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

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent"
                    placeholder="Enter your name">
                @foreach ($errors->get('name') as $message)
                <p class="text-sm text-red-700 mt-1">{{ $message }}</p>
                @endforeach
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email address</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent"
                    placeholder="name@example.com">
                @foreach ($errors->get('email') as $message)
                <p class="text-sm text-red-700 mt-1">{{ $message }}</p>
                @endforeach
            </div>

            <div class="flex gap-4 mb-4">
                <div class="w-1/2">
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone No (+91)</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent"
                        placeholder="Phone number">
                    @foreach ($errors->get('phone') as $message)
                    <p class="text-sm text-red-700 mt-1">{{ $message }}</p>
                    @endforeach
                </div>

                <div class="w-1/2">
                    <label for="gender" class="block text-sm font-medium text-gray-700 mb-1">Gender</label>
                    <select name="gender" id="gender"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent">
                        <option value="" disabled selected>Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                    @foreach ($errors->get('gender') as $message)
                    <p class="text-sm text-red-700 mt-1">{{ $message }}</p>
                    @endforeach
                </div>
            </div>

            <div class="flex gap-4 mb-4">
                <div class="w-1/2">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" id="password"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent"
                        placeholder="Create password">
                    @foreach ($errors->get('password') as $message)
                    <p class="text-sm text-red-700 mt-1">{{ $message }}</p>
                    @endforeach
                </div>

                <div class="w-1/2">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm
                        Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent"
                        placeholder="Confirm password">
                </div>
            </div>

            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded transition">
                Student Registration
            </button>
        </form>

        <div class="text-center mt-4">
            <p class="text-sm text-gray-600">
                Already have an account?
                <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Go to login</a>
            </p>
        </div>
    </div>

    <script src="{{ asset('/frontend/js/scripts.js') }}"></script>
</body>

</html>