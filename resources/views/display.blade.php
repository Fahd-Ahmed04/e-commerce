<x-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-800">Sheet Order</h1>
        </div>
    </x-slot>
    <div class="px-6 py-4">
        <form method="POST" action="{{ route('buy-order') }}" class="max-w-4xl mx-auto" id="buy-form">
            @csrf
            <div class="bg-white rounded-xl shadow-md overflow-hidden mt-8">
                <div class="p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-6">شيت الطلب</h2>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th>البياع</th>
                                    <th>الاسم</th>
                                    <th>المنتج</th>
                                    <th>السعر</th>
                                    <th>الكميه</th>
                                    <th>السعر الكلي</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($order_details as $index => $order)
                                    <tr class="hover:bg-blue-50 transition-colors">
                                        <td>
                                            {{ auth()->user()->username }}
                                            <input type="hidden" name="orders[{{ $index }}][admin_name]"
                                                value="{{ auth()->user()->username }}">
                                        </td>
                                        <td>
                                            {{ $order->user_name }}
                                            <input type="hidden" name="orders[{{ $index }}][user_name]"
                                                value="{{ $order->user_name }}">
                                        </td>
                                        <td>
                                            {{ $order->product_name }}
                                            <input type="hidden" name="orders[{{ $index }}][product_name]"
                                                value="{{ $order->product_name }}">
                                        </td>
                                        <td>
                                            {{ $order->price }} EGP
                                            <input type="hidden" name="orders[{{ $index }}][price]"
                                                value="{{ $order->price }}">
                                        </td>
                                        <td>
                                            {{ $order->amount }}
                                            <input type="hidden" name="orders[{{ $index }}][amount]"
                                                value="{{ $order->amount }}">
                                        </td>
                                        <td>
                                            {{ $order->total_price }} EGP
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-right"> الكميه الكليه</td>
                                    <td> {{ $order_details->sum('amount') }}</td>
                                    <td>{{ $order_details->sum('total_price') }} EGP</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="flex flex-col sm:flex-row justify-center sm:space-x-4 space-y-4 sm:space-y-0 mt-6">
                        <button type="button"
                            class="w-full sm:w-auto px-6 py-2 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700 transition"
                            id="open-modal">
                            شراء
                        </button>
                        <a href="/order" class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">
                            عوده
                        </a>
                    </div>
                </div>
            </div>
        </form>

        <!-- ✅ Modal -->
        <div id="confirm-modal"
            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
            <div class="bg-white rounded-lg p-6 w-full max-w-md shadow-lg text-center">
                <h2 class="text-xl font-bold text-gray-800 mb-4">تاكيد الطلب</h2>
                <p class="text-gray-600 mb-6">هل تريد الشراء بالفعل ؟</p>
                <div class="flex justify-center space-x-4">
                    <button id="confirm-submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">تأكيد</button>
                    <button id="cancel-modal"
                        class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 transition">إلغاء</button>
                </div>
            </div>
        </div>

        <script>
            const openModalBtn = document.getElementById('open-modal');
            const confirmModal = document.getElementById('confirm-modal');
            const confirmSubmitBtn = document.getElementById('confirm-submit');
            const cancelModalBtn = document.getElementById('cancel-modal');
            const form = document.getElementById('buy-form');

            openModalBtn.addEventListener('click', () => {
                confirmModal.classList.remove('hidden');
            });

            cancelModalBtn.addEventListener('click', () => {
                confirmModal.classList.add('hidden');
            });

            confirmSubmitBtn.addEventListener('click', () => {
                form.submit();
            });
        </script>

    </div>
</x-layout>
