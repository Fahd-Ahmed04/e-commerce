<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
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


</head>

<body class="bg-gray-100">
    <nav class="bg-gray-600 fixed top-0 left-0 right-0 z-50 h-20 shadow-lg">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 h-full">
            <div class="flex h-full items-center justify-between">
                <div class="flex items-center"></div>
                <div class="flex items-center space-x-9 pr-4">
                    @auth
                        <div class="hidden md:flex flex-col items-end mr-4">
                            <div class="text-gray-300 text-xs mb-0.5">
                                <div class="text-white text-sm font-medium mt-0.5">
                                    تسجيل الدخول ب اسم {{ auth()->user()->username }}

                                </div>
                            </div>

                        </div>

                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="flex items-center space-x-2 bg-red-500 hover:bg-red-700 text-white px-5 py-3 rounded-md text-sm font-medium transition-colors duration-200 shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                <span>تسجيل الخروج</span>
                            </button>
                        </form>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
    
    <div class="flex pt-16">
        <aside class="w-60 bg-gray-600 text-white fixed h-screen">
            <nav class="flex-1 p-4 space-y-4 mt-4">

                <a href="store"
                    class="block p-2 rounded {{ request()->is('store') ? 'bg-gray-800 font-bold' : 'hover:bg-gray-800' }}">
                    المخازن
                </a>


                <a href="category"
                    class="block p-2 rounded {{ request()->is('category') ? 'bg-gray-800 font-bold' : 'hover:bg-gray-800' }}">
                    الاصناف
                </a>

                <a href="dashboard"
                    class="block p-2 rounded {{ request()->is('dashboard') ? 'bg-gray-800 font-bold' : 'hover:bg-gray-800' }}">
                    المنتجات
                </a>
                <a href="users"
                    class="block p-2 rounded {{ request()->is('users') ? 'bg-gray-800 font-bold' : 'hover:bg-gray-800' }}">
                    المستخدمون
                </a>

                <a href="admin"
                    class="block p-2 rounded {{ request()->is('admin') ? 'bg-gray-800 font-bold' : 'hover:bg-gray-800' }}">
                    الادمن
                </a>
                {{-- <a href="supplier"
                    class="block p-2 rounded {{ request()->is('supplier') ? 'bg-gray-800 font-bold' : 'hover:bg-gray-800' }}">
                    الموردين
                </a> --}}
                <a href="allorder"
                    class="block p-2 rounded {{ request()->is('allorder') ? 'bg-gray-800 font-bold' : 'hover:bg-gray-800' }}">
                    الطلبات
                </a>

                <a href="retrieve"
                    class="block p-2 rounded {{ request()->is('retrieve') ? 'bg-gray-800 font-bold' : 'hover:bg-gray-800' }}">
                    المترجعات
                </a>

            </nav>
        </aside>
    </div>



    <main class="flex-1 ml-64 p-6">
        <div class="bg-white rounded-lg shadow p-6">
            {{ $slot }}
        </div>
    </main>
    </div>
</body>

</html>
