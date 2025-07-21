<x-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-800">الطلبات</h1>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-xl shadow-md overflow-hidden p-6">
            <div class="mb-8 flex justify-center">
                <h2 class="text-xl font-bold text-gray-800 mb-2 text-center"> اضافه طلب</h2>
            </div>
            <form method="POST" action="{{ route('add-order') }}">
                @csrf
                <div class="space-y-4">
                    <div class="space-y-1">
                        <label for="admin_name" class="block text-sm font-medium text-gray-700">اسم المستخدم</label>
                        <div class="relative rounded-md shadow-sm">

                            <input type="text" id="admin_name" name="admin_name"
                                value="{{ auth()->user()->username }}"
                                class="block w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 bg-gray-50 text-gray-700 sm:text-sm @error('admin') border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 @enderror"
                                readonly aria-describedby ="admin-description">
                        </div>

                    </div>
                    <div>
                        <label for="user_name" class="block text-sm font-medium text-gray-700">اسم المشتري</label>
                        <select id="user_name" name="user_name"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option value="" disabled selected>الاسم</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->name }}">
                                    {{ $user->name }}
                                </option>
                            @endforeach
                            @error('user_name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </select>
                    </div>
                    <div>
                        <label for="store_id" class="block text-sm font-medium text-gray-700">المخزن</label>
                        <select id="store-select" name="store_id"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option value="" disabled selected>اختر المخزن</option>
                            @foreach ($stores as $store)
                                <option value="{{ $store->id }}">{{ $store->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mt-4">
                        <label for="product_name" class="block text-sm font-medium text-gray-700">المنتج</label>
                        <select id="product_name" name="product_name" disabled
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <!-- لاحظ disabled هنا -->
                            <option value="" disabled selected>تحديد المنتج</option>
                        </select>
                    </div>

                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700">السعر</label>
                        <input type="text" id="price" name="price"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            readonly>
                    </div>

                    <div>
                        <label for="amount" class="block text-sm font-medium text-gray-700">الكمية</label>
                        <input type="number" id="amount" name="amount"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <div class="mt-4">
                            <label class="block mb-2 font-medium">الكمية المتوفرة:</label>
                            <input type="text" id="quantity" class="border rounded px-3 py-2 w-full bg-gray-100"
                                readonly>
                        </div>

                        @if (session('error'))
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-4">
                                {{ session('error') }}
                            </div>
                        @endif
                    </div>
                    <div class="flex flex-col sm:flex-row justify-center sm:space-x-4 space-y-4 sm:space-y-0 mt-6">
                        <form action="{{ route('add-order') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="w-full sm:w-auto px-6 py-2 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                                اضافه
                            </button>
                        </form>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <br>
    <br>

    @if ($order_details->isNotEmpty())
        <div class="bg-white rounded-xl shadow-md overflow-hidden mt-8">
            <div class="p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-6">شيت الطلب</h2>

                <div class="space-y-4">
                    @foreach ($order_details as $order)
                        <div class="border border-gray-200 rounded-lg p-4 shadow-sm hover:shadow-md transition">
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 text-sm text-gray-800">
                                <div>
                                    <span class="font-medium"> {{ auth()->user()->username }} : البياع</span>
                                </div>
                                <div>
                                    <span class="font-medium">الاسم : {{ $order->user_name }}</span>
                                </div>
                                <div>
                                    <span class="font-medium">المنتج:</span> {{ $order->product_name }}
                                </div>
                                <div>
                                    <span class="font-medium">EGP {{ $order->price }} :السعر</span>
                                </div>
                                <div>
                                    <span class="font-medium">{{ $order->amount }} : الكمية</span>
                                </div>
                                <div>
                                    <span class="font-semibold text-blue-600"> EGP {{ $order->total_price }} : السعر
                                        الكلي</span>
                                </div>
                            </div>
                            <div class="mt-4">
                                <button type="button" onclick="openConfirmModal({{ $order->id }}, 'order')"
                                    class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    حذف
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6 border-t pt-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-700">

                        <div class="flex justify-between items-center">
                            <span class="font-medium">{{ $order_details->sum('amount') }} : عدد العناصر </span>
                        </div>
                        <div class="flex justify-between items-center">
                            <h2 class="font-medium"> EGP {{ $order_details->sum('total_price') }} : السعر
                                الكلي</h2>
                            <span class="text-blue-600 font-semibold">
                            </span>
                        </div>
                    </div>
                </div>

                <div class="flex justify-center mt-6">
                    <a href="{{ route('buy-order') }}"
                        class="px-8 py-2 bg-green-600 text-white rounded-md text-sm font-medium hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition">
                        تاكيد الطلب
                    </a>
                </div>
            </div>
        </div>
    @endif
    <div id="confirmModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 text-center">
            <h2 class="text-xl font-bold mb-4">تأكيد الحذف</h2>
            <p class="text-gray-700 mb-6">هل أنت متأكد أنك تريد حذف هذا الطلب؟</p>
            <div class="flex justify-center gap-4">
                <button onclick="submitDeleteForm()"
                    class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">
                    نعم، احذف
                </button>
                <button onclick="closeConfirmModal()"
                    class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400 transition">
                    إلغاء
                </button>
            </div>
        </div>
    </div>

    <!-- فورم حذف مخفي -->
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

</x-layout>
