<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تفاصيل المخزن</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 text-right font-sans">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">تفاصيل المخزن</h1>
            <a href="{{ route('store') }}"
                class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg font-medium transition duration-200">
                ← عودة إلى المخازن
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
            <div class="p-6 sm:p-8">
                <h2 class="text-2xl font-bold text-blue-700 mb-6">مخزن : {{ $store->name }}</h2>

                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto divide-y divide-gray-200 text-center">
                        <thead class="bg-gray-100 text-gray-700 text-sm uppercase">
                            <tr>
                                <th class="px-4 py-3">#</th>
                                <th class="px-4 py-3">اسم المنتج</th>
                                <th class="px-4 py-3">الكميه</th>
                                <th class="px-4 py-3">السعر</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-sm">
                            @foreach ($products as $product)
                                <tr class="hover:bg-blue-50 transition">
                                    <td class="px-4 py-3">{{ $product->id }}</td>
                                    <td class="px-4 py-3">{{ $product->name }}</td>
                                    <td class="px-4 py-3">{{ $product->amount }}</td>
                                    <td class="px-4 py-3">{{ $product->price }} EGP</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
