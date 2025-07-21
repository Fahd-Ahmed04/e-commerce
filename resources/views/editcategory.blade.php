<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-200 min-h-screen flex items-center justify-center p-8">
    <form action="/category/{{ $category->id }}" method="POST"
        class="w-full max-w-2xl bg-white p-8 rounded-2xl shadow-lg space-y-6">
        @csrf @method('PATCH')
        <div>
            <h2 class="text-center text-2xl font-bold text-gray-800">تحديث الصنف</h2>
            <br>
            <label for="name" class="block text-base font-medium text-gray-700 mb-1">الاسم</label>
            <input type="text" name="name" id="name" value="{{ $category->name }}"
                class="mt-1 w-full rounded-md border border-gray-300 px-4 py-2 text-lg text-gray-900 shadow-sm placeholder-gray-400 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                required />
            @error('name')
                <p class="text-red-500 text-sm mt-1">غير مسموح بهذا الاسم</p>
            @enderror
        </div>

        <div class="flex space-x-4">
            <button type="submit"
                class="w-full inline-flex justify-center rounded-md bg-green-600 px-4 py-2 text-white text-lg font-semibold shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                تحديث
            </button>

            <a href="/category"
                class="w-full inline-flex justify-center rounded-md bg-gray-500 px-4 py-2 text-white text-lg font-semibold shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 text-center">
                عودة
            </a>
        </div>
    </form>

</body>

</html>
