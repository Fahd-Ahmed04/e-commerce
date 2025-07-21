<x-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center" dir="rtl">
            <h1 class="text-2xl font-bold text-gray-800">شــيـت الـمـرتـجـعــات</h1>
        </div>
    </x-slot>
    <div class="px-6 py-4" dir="rtl">
        <form method="POST" action="{{ route('buy-order') }}" class="max-w-6xl mx-auto" id="buy-form">
            @csrf

            <div class="bg-white rounded-xl shadow-md overflow-hidden mt-8 border border-gray-200" dir="rtl">

                <div class="p-6 pt-0">

                    @if ($retrieves->isNotEmpty())
                        <h2 class="text-xl font-bold text-center text-gray-800 mb-6 border-b pb-2">
                            تفــاصـيـل الـمـرتـجـعــات
                        </h2>
                        <div class="overflow-x-auto rounded-lg">
                            <table class="min-w-full divide-y divide-gray-300 text-center text-sm">
                                <thead class="bg-gray-100 text-gray-700 font-semibold">
                                    <tr>
                                        <th class="px-4 py-3">#</th>
                                        <th class="px-4 py-3">اســم الـبـائـع</th>
                                        <th class="px-4 py-3">الـمـنـتـج</th>
                                        <th class="px-4 py-3">الســعــر</th>
                                        <th class="px-4 py-3">الكمية قبل الاسترجاع</th>
                                        <th class="px-4 py-3">الكمية المسترجعة</th>
                                        <th class="px-4 py-3">الكمية بعد الاسترجاع</th>
                                        <th class="px-4 py-3">تاريخ</th>
                                        <th class="px-4 py-3">الوقت</th>
                                    </tr>
                                </thead>

                                <tbody class="bg-white divide-y divide-gray-200 text-gray-800">
                                    @foreach ($retrieves as $order)
                                        <tr class="hover:bg-blue-50 transition duration-150">
                                            <td class="px-4 py-3 font-medium">{{ $order->id }}</td>
                                            <td class="px-4 py-3">{{ $order->admin_name }}</td>
                                            <td class="px-4 py-3">{{ $order->product_name }}</td>
                                            <td class="px-4 py-3">{{ $order->price }}</td>
                                            <td class="px-4 py-3">{{ $order->amount_before }}</td>
                                            <td class="px-4 py-3">{{ $order->amount }}</td>
                                            <td class="px-4 py-3">{{ $order->amount_after }}</td>
                                            <td class="px-4 py-3 text-gray-500">
                                                {{ $order->created_at->format('Y-m-d') }}</td>
                                            <td class="px-4 py-3 text-gray-500">
                                                {{ $order->created_at->format('H:i:s') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-center text-xl text-gray-500 py-12 font-semibold">لا توجد مرتجعات حالياً.</p>
                    @endif

                </div>
            </div>
        </form>
    </div>
</x-layout>
