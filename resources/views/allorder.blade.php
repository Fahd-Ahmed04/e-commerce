<x-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-800">شيت الطلب</h1>
        </div>
    </x-slot>

    <div class="px-6 py-6" dir="rtl">
        <div class="max-w-7xl mx-auto bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-200 p-6">

            <div class="flex justify-end mb-4">
                <a href="/order"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg text-sm font-medium shadow-md transition">
                    + إضافة طلب جديد
                </a>
            </div>

            @if ($orders->isNotEmpty())
                <h2 class="text-xl font-semibold text-center text-gray-700 mb-6">قائمة الطلبات</h2>

                <div class="overflow-x-auto rounded-lg border border-gray-100">
                    <table class="min-w-full divide-y divide-gray-200 text-sm text-center">
                        <thead class="bg-gray-100 text-gray-600 font-semibold">
                            <tr>
                                <th class="px-4 py-3">#</th>
                                <th class="px-4 py-3">الاسم</th>
                                <th class="px-4 py-3">البائع</th>
                                <th class="px-4 py-3">السعر الكلي</th>
                                <th class="px-4 py-3">الكمية الكلية</th>
                                <th class="px-4 py-3">تاريخ الطلب</th>
                                <th class="px-4 py-3">الوقت</th>
                                <th class="px-4 py-3">تفاصيل</th>
                                <th class="px-4 py-3">استرجاع</th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-100">
                            @foreach ($orders as $order)
                                <tr class="hover:bg-gray-50 transition duration-150">
                                    <td class="px-4 py-3 font-bold text-gray-700">{{ $order->id }}</td>
                                    <td class="px-4 py-3">{{ $order->user_name }}</td>
                                    <td class="px-4 py-3">{{ $order->admin_name }}</td>
                                    <td class="px-4 py-3 text-green-600 font-semibold">{{ $order->total_price }} ج</td>
                                    <td class="px-4 py-3">{{ $order->total_amount }}</td>
                                    <td class="px-4 py-3 text-gray-500">{{ $order->created_at->format('Y-m-d') }}</td>
                                    <td class="px-4 py-3 text-gray-500">{{ $order->created_at->format('H:i:s') }}</td>

                                    <td class="px-4 py-3">
                                        <a href="{{ route('show-order', $order['order_id']) }}"
                                            class="text-blue-600 hover:text-blue-800 transition duration-150"
                                            title="عرض تفاصيل الطلب">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mx-auto"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.522 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.478 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                    </td>

                                    <td class="px-4 py-3">
                                        @if ($order->status !== 'retrieve')
                                            <button type="button"
                                                onclick="openConfirmModal({{ $order['id'] }}, 'allorder')"
                                                class="bg-green-600 hover:bg-green-700 text-white text-xs px-4 py-1.5 rounded-lg shadow-md transition">
                                                استرجاع
                                            </button>
                                        @else
                                            <span class="text-gray-400 text-xs font-medium">مُسترجع</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-6 bg-white rounded shadow text-center text-gray-500">
                    لا توجد طلبات حتى الآن.
                </div>
            @endif
        </div>
    </div>

    <!-- Modal تأكيد الاسترجاع -->
    <div id="confirmModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-sm p-6 text-center animate-fade-in">
            <h2 class="text-xl font-bold text-gray-700 mb-4">تأكيد الاسترجاع</h2>
            <p class="mb-6 text-gray-600">هل أنت متأكد من استرجاع هذا المنتج؟</p>
            <div class="flex justify-center gap-4">
                <button onclick="submitDeleteForm()"
                    class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
                    نعم
                </button>
                <button onclick="closeConfirmModal()"
                    class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400 transition">
                    إلغاء
                </button>
            </div>
        </div>
    </div>

    <form id="deleteForm" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>

    <script>
        let selectedId = null;
        let deleteType = null;

        function openConfirmModal(id, type) {
            selectedId = id;
            deleteType = type;
            document.getElementById('confirmModal').classList.remove('hidden');
        }

        function closeConfirmModal() {
            document.getElementById('confirmModal').classList.add('hidden');
            selectedId = null;
            deleteType = null;
        }

        function submitDeleteForm() {
            if (selectedId && deleteType) {
                const form = document.getElementById('deleteForm');
                form.action = `/${deleteType}/${selectedId}`;
                form.submit();
            }
        }
    </script>

    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: scale(0.95);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.25s ease-out;
        }
    </style>
</x-layout>
