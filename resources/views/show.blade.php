<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تفاصيل الطلب</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 text-right font-sans">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">تفاصيل الطلب</h1>
            <a href="/allorder"
                class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg font-medium transition duration-200">
                ← عودة إلى الطلبات
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
            <div class="p-6 sm:p-8">
                <h2 class="text-2xl font-bold text-blue-700 mb-6">مراجعة تفاصيل الطلب</h2>

                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto divide-y divide-gray-200 text-center">
                        <thead class="bg-gray-100 text-gray-700 text-sm uppercase">
                            <tr>
                                <th class="px-4 py-3">#</th>
                                <th class="px-4 py-3">الاسم</th>
                                <th class="px-4 py-3">البياع</th>
                                <th class="px-4 py-3">المنتج</th>
                                <th class="px-4 py-3">السعر</th>
                                <th class="px-4 py-3">الكمية</th>
                                <th class="px-4 py-3">الإجمالي</th>
                                <th class="px-4 py-3">إجراء</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-sm">
                            @foreach ($total_order as $order)
                                <tr class="hover:bg-blue-50 transition">
                                    <td class="px-4 py-3">{{ $order->id }}</td>
                                    <td class="px-4 py-3">{{ $order->user_name }}</td>
                                    <td class="px-4 py-3">{{ $order->admin_name }}</td>
                                    <td class="px-4 py-3">{{ $order->product_name }}</td>
                                    <td class="px-4 py-3">{{ $order->price }} EGP</td>
                                    <td class="px-4 py-3">{{ $order->amount }}</td>

                                    <td class="px-4 py-3 font-semibold text-blue-600">{{ $order->total_price }} EGP</td>
                                    <td>
                                        <form action="{{ route('replace-order-show', $order->id) }}" method="GET"
                                            class="inline">
                                            <button type="submit"
                                                class="bg-yellow-600 hover:bg-yellow-700 text-white text-xs px-4 py-1.5 rounded-lg shadow-md transition">
                                                استبدال
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-gray-100 text-sm text-gray-800 font-semibold">
                            <tr>
                                <td colspan="4" class="px-4 py-3 text-right text-base text-gray-700">
                                    الإجمالي:
                                </td>
                                <td class="px-4 py-3 text-base text-green-700">
                                    {{ $total_order->sum('amount') }}
                                </td>
                                <td class="px-4 py-3 text-base text-blue-700">
                                    {{ $total_order->sum('total_price') }} EGP
                                </td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
