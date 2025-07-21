<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#product_name').prop('disabled', true);

            $('#store-select').on('change', function() {
                const storeId = $(this).val();
                if (!storeId) return;

                const productSelect = $('#product_name');
                productSelect.prop('disabled', true);
                productSelect.empty().append('<option disabled selected>جاري التحميل...</option>');

                $.ajax({
                    url: `/get-products-by-store/${storeId}`,
                    method: 'GET',
                    success: function(data) {
                        productSelect.empty().append(
                            '<option value="" disabled selected>تحديد منتج</option>'
                        );

                        if (data.length === 0) {
                            productSelect.append('<option disabled>تحديد منتج</option>');
                        } else {
                            data.forEach(function(product) {
                                productSelect.append(`
                                <option value="${product.id}"
                                    data-price-url="/get-price/${product.id}"
                                    data-quantity-url="/get-amount/${product.id}">
                                    ${product.name} ( ${product.store_name} )
                                </option>
                            `);
                            });
                            productSelect.prop('disabled', false);
                        }
                    },
                    error: function() {
                        console.error('فشل في تحميل المنتجات');
                        productSelect.empty().append(
                            '<option disabled>فشل في تحميل المنتجات</option>');
                    }
                });
            });

            $('#product_name').on('change', function() {
                const selected = $(this).find(':selected');
                const priceUrl = selected.data('price-url');
                const quantityUrl = selected.data('quantity-url');

                if (priceUrl) {
                    $.get(priceUrl, function(response) {
                        $('#price').val(response.price);
                    }).fail(function() {
                        $('#price').val(0);
                        alert('فشل في جلب السعر');
                    });
                }

                if (quantityUrl) {
                    $.get(quantityUrl, function(response) {
                        $('#quantity').val(response.quantity);
                    }).fail(function() {
                        $('#quantity').val(0);
                        alert('فشل في جلب الكمية');
                    });
                }
            });
        });
    </script>
    <title>Document</title>
</head>

<body>
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-xl shadow-md overflow-hidden p-6">
            <div class="mb-8 flex justify-center">
                <h2 class="text-xl font-bold text-gray-800 mb-2 text-center"> استبدال طلب</h2>
            </div>
            <form method="POST" action="{{ route('replace-order',$order->id) }}">
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
                        <div class="relative rounded-md shadow-sm">
                            <input type="text" id="user_name" name="user_name"
                                value="{{ $orderDetails->user_name }}"
                                class="block w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 bg-gray-50 text-gray-700 sm:text-sm @error('admin') border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 @enderror"
                                readonly>
                        </div>
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
                    <div class="flex justify-between items-center pt-4">
                        <a href="{{ route('show-order', $orderDetails->order_id) }}"
                            class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg font-semibold transition">
                            عودة
                        </a>
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold transition">
                            تحديث
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
