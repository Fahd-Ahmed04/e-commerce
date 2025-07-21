@auth
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>اضافه منتج</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>

    <body class="bg-gray-100 min-h-screen flex items-center justify-center p-6">

        <form action="{{ route('add.store') }}" method="POST"
            class="w-full max-w-2xl bg-white p-8 rounded-2xl shadow-lg space-y-6">
            @csrf

            <h2 class="text-2xl font-bold text-center text-gray-600 mb-6">اضافه منتج جديد</h2>

            <div>
                <label for="name" class="block text-gray-700 font-medium mb-2">المنتج</label>
                <input type="text" id="name" name="name" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 @error('price') border-red-500 @enderror">

                @error('name')
                    <p class="text-red-500 text-sm mt-1">الاسم غير مسموح به</p>
                @enderror
            </div>
            <div>
                <label for="price" class="block text-gray-700 font-medium mb-2">السعر</label>
                <input type="number" id="price" name="price" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 @error('price') border-red-500 @enderror">

                @error('price')
                    <p class="text-red-500 text-sm mt-1">السعر غير مسموح به</p>
                @enderror
            </div>
            <div>
                <label for="amount" class="block text-gray-700 font-medium mb-2">الكميه</label>
                <input type="number" id="amount" name="amount" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 @error('price') border-red-500 @enderror">

                @error('amount')
                    <p class="text-red-500 text-sm mt-1">الكميه غير مسموح به</p>
                @enderror
            </div>
            <div>
                <label for="category_id" class="block text-gray-700 font-medium mb-2">الصنف</label>
                <select id="category_id" name="category_id" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">

                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                    @error('category_id')
                        <p class="text-red-500 text-sm mt-1">الصنف مطلوب</p>
                    @enderror
                </select>
            </div>
            <div>
                <label for="store_id" class="block text-gray-700 font-medium mb-2">المخزن</label>
                <select id="store_id" name="store_id" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">

                    @foreach ($stories as $store)
                        <option value="{{ $store->id }}">{{ $store->name }}</option>
                    @endforeach
                    @error('store_id')
                        <p class="text-red-500 text-sm mt-1">المخزن مطلوب</p>
                    @enderror
                </select>
            </div>
            <div class="flex justify-end space-x-4">

                <button type="submit"
                    class="bg-green-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-700 transition">
                    اضافه
                </button>

                <a href="/dashboard"
                    class="bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-700 transition">
                    عوده
                </a>
            </div>
        </form>

    </body>

    </html>
@endauth
