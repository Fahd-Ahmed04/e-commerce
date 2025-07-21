<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اضافه صنف</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center p-6">

    <form action="/addcategory" method="POST" class="w-full max-w-2xl bg-white p-8 rounded-2xl shadow-lg space-y-6">
        @csrf

        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">اضافه صنف جديد</h2>

        <div>
            <label for="name" class="block text-gray-700 font-medium mb-2">اسم الصنف</label>
            <input type="text" id="name" name="name" required
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 @error('name') border-red-500 @enderror">

            @error('name')
                <p class="text-red-500 text-sm mt-1">غير مسموح بهذا الاسم</p>
            @enderror
        </div>

        <div class="flex justify-end space-x-4">

            <button type="submit"
                class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                اضافه
            </button>

            <a href="/category"
                class="bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-700 transition">
                عوده
            </a>
        </div>
    </form>

</body>

</html>
