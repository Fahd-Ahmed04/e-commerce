<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعديل منتج</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">

    <form action="/dashboard/{{ $product->id }}" method="POST" enctype="multipart/form-data"
        class="w-full max-w-xl bg-white rounded-2xl shadow-lg p-8 space-y-6">
        @csrf
        @method('PATCH')

        <h2 class="text-2xl font-bold text-center text-gray-700 mb-4">تعديل المنتج</h2>

        <div>
            <label for="name" class="block mb-1 text-gray-700 font-semibold">اسم المنتج</label>
            <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required
                class="w-full border border-gray-300 rounded-lg px-4 py-2 text-right focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 @error('name') border-red-500 @enderror">
            @error('name')
                <p class="text-red-500 text-sm mt-1">الاسم غير مسموح به</p>
            @enderror
        </div>

        <div>
            <label for="price" class="block mb-1 text-gray-700 font-semibold">السعر</label>
            <input type="number" id="price" name="price" value="{{ old('price', $product->price) }}" required
                class="w-full border border-gray-300 rounded-lg px-4 py-2 text-right focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 @error('price') border-red-500 @enderror">
            @error('price')
                <p class="text-red-500 text-sm mt-1">السعر غير مسموح به</p>
            @enderror
        </div>

        <div>
            <label for="amount" class="block mb-1 text-gray-700 font-semibold">الكمية</label>
            <input type="number" id="amount" name="amount" value="{{ old('amount', $product->amount) }}" required
                class="w-full border border-gray-300 rounded-lg px-4 py-2 text-right focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 @error('amount') border-red-500 @enderror">
            @error('amount')
                <p class="text-red-500 text-sm mt-1">الكمية غير مسموح بها</p>
            @enderror
        </div>

        <div>
            <label for="category_id" class="block mb-1 text-gray-700 font-semibold">الصنف</label>
            <select id="category_id" name="category_id" required
                class="w-full border border-gray-300 rounded-lg px-4 py-2 text-right focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
                @error('category_id')
                    <p class="text-red-500 text-sm mt-1">الاسم غير مسموح به</p>
                @enderror
            </select>
        </div>

        <div>
            <label for="store_id" class="block mb-1 text-gray-700 font-semibold">المخزن </label>
            <select id="store_id" name="store_id" required
                class="w-full border border-gray-300 rounded-lg px-4 py-2 text-right focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                @foreach ($stories as $store)
                    <option value="{{ $store->id }}"
                        {{ old('store_id', $product->store_id ?? '') == $store->id ? 'selected' : '' }}>
                        {{ $store->name }}
                    </option>
                @endforeach
            </select>
            @error('store_id')
                <p class="text-red-500 text-sm mt-1">الاسم غير مسموح به</p>
            @enderror
        </div>

        <div class="flex justify-between items-center pt-4">
            <a href="/dashboard"
                class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg font-semibold transition">
                عودة
            </a>

            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold transition">
                تحديث
            </button>
        </div>
    </form>

</body>

</html>
