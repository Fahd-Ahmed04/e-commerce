<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اضافه ادمن</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center p-6">

    <form action="/addadmin" method="POST" class="w-full max-w-2xl bg-white p-8 rounded-2xl shadow-lg space-y-6">
        @csrf

        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">اضافه ادمن جديد</h2>

        <div>
            <label for="username" class="block text-gray-700 font-medium mb-2">اسم المستخدم</label>
            <input type="text" id="username" name="username" required
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 @error('name') border-red-500 @enderror">

            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="status" class="block text-gray-700 font-medium mb-2">الحالة</label>
            <select id="status" name="status" required
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 @error('status') border-red-500 @enderror">
                <option value="" disabled selected>-- اختر الحالة --</option>
                <option value="super" {{ old('status', $admin->status ?? '') == 'super' ? 'selected' : '' }}>Super
                </option>
                <option value="not super" {{ old('status', $admin->status ?? '') == 'not super' ? 'selected' : '' }}>Not
                    Super</option>
            </select>

            @error('status')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="email" class="block text-gray-700 font-medium mb-2">البريد الالكتروني</label>
            <input type="email" id="email" name="email" required
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 @error('email') border-red-500 @enderror">

            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>        
        <div>
            <label for="password" class="block text-gray-700 font-medium mb-2">كلمه السر</label>
            <input type="password" id="password" name="password" required
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 @error('password') border-red-500 @enderror">

            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end space-x-4">

            <button type="submit"
                class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                اضافه
            </button>

            <a href="/admin"
                class="bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-700 transition">
                عوده
            </a>
        </div>
    </form>
</body>

</html>
