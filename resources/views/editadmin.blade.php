<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center p-6">

    <form action="/admin/{{ $admin->id }}" method="POST"
        class="max-w-md mx-auto p-6 bg-white rounded-xl shadow-md space-y-6">
        @csrf
        @method('PATCH')

        <div>
            <label for="username" class="block text-gray-700 font-medium mb-2">اسم المستخدم</label>
            <input type="text" id="username" name="username" required
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 @error('name') border-red-500 @enderror"
                value={{ $admin->username }}>

            @error('username')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-gray-700 font-medium mb-2">البريد الالكتروني</label>
            <input type="email" id="email" name="email" required
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 @error('name') border-red-500 @enderror"
                value={{ $admin->email }}>

            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="password" class="block text-gray-700 font-medium mb-2">كلمه السر </label>
            <input type="password" id="password" name="password" required
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 @error('name') border-red-500 @enderror"
                value='{{ $admin->password }}'>

            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="status" class="block text-gray-700 font-medium mb-2">الحالة</label>
            <select id="status" name="status" required
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 @error('status') border-red-500 @enderror">
                <option value="">-- اختر الحالة --</option>
                <option value="super" {{ old('status', $admin->status ?? '') == 'super' ? 'selected' : '' }}>Super
                </option>
                <option value="not super" {{ old('status', $admin->status ?? '') == 'not super' ? 'selected' : '' }}>Not
                    Super</option>
            </select>

            @error('status')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
            class="w-full inline-flex justify-center rounded-md bg-green-600 px-4 py-2 text-white text-sm font-semibold shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
            تعديل
        </button>

        <a href="/admin"
            class="w-full inline-flex justify-center rounded-md bg-gray-500 px-4 py-2 text-white text-sm font-semibold shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 text-center">
            عودة
        </a>
        </div>
    </form>

</body>

</html>
