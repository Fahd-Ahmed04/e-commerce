<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-gray-60 flex items-center justify-center">

    <div class="max-w-md w-full bg-white p-8 rounded-2xl shadow-lg">
        <h2 class="text-3xl font-bold text-center text-gray-700 mb-2">تسجيل الدخول</h2>
        <p class="text-sm text-center text-gray-600 mb-6">
            سجل الدخول للاستمرار
        </p>
        <form action="/login" method="POST" class="space-y-6">
            @csrf
            @if (Session::has('errormessage'))
                <p class="flex justify-center mt-4 text-red-500">{{ Session::get('errormessage') }}</ح>
            @endif

            <div>
                <label for="email" class="block text-gray-700 font-medium mb-2">البريد الالكتروني</label>
                <input type="email" id="email" name="email" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 @error('email') border-red-500 @enderror"
                    value="{{ old('email') }}">

                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-gray-700 font-medium mb-2">الرقم السري</label>
                <input type="password" id="password" name="password" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 @error('password') border-red-500 @enderror">

                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>


            <div>
                <button type="submit"
                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    تسجيل الدخول
                </button>
            </div>

            
        </form>
    </div>

</body>

</html>
