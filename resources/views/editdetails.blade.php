<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعديل الطلب</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#product_name').change(function() {
                var selectedOption = $(this).find(':selected');
                var priceUrl = selectedOption.data('price-url');

                if (priceUrl) {
                    $.ajax({
                        url: priceUrl,
                        method: 'GET',
                        success: function(response) {
                            $('#price').val(response.price);
                        },
                        error: function() {
                            alert('error');
                        }
                    });
                } else {
                    $('#price').val('0');
                }
            });
        });


        $(document).ready(function() {
            $('#product_name').change(function() {
                var selectedOption = $(this).find(':selected');
                var quantityUrl = selectedOption.data('quantity-url');

                if (quantityUrl) {
                    $.ajax({
                        url: quantityUrl,
                        method: 'GET',
                        success: function(response) {
                            $('#quantity').val(response.quantity);
                        },
                        error: function() {
                            alert('error');
                        }
                    });
                } else {
                    $('#quantity').val('0');
                }
            });
        });
    </script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center p-6">

    <form action="{{route('update-order',$orderDetails->id)}}" method="POST"
        class="w-full max-w-md bg-white p-6 rounded-xl shadow-md space-y-6">
        @csrf
        @method('PUT')

        <h2 class="text-xl font-bold text-blue-700 text-center mb-4">تعديل تفاصيل الطلب</h2>

        <div>
            <label for="admin_name" class="block text-gray-700 font-medium mb-2">البياع</label>
            <input type="text" id="admin_name" name="admin_name" required
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 @error('price') border-red-500 @enderror"
                readonly value="{{ $orderDetails->admin_name }}">
        </div>
        <div>
            <label for="product_name" class="block text-sm font-medium text-gray-700">المنتج</label>
            <select id="product_name" name="product_name"
                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">

                <option value="{{ $orderDetails->product_id }}" selected>
                    {{ $orderDetails->product_name }}
                </option>

                @foreach ($products as $product)
                    @if ($product->name != $orderDetails->product_name)
                        <option value="{{ $product->id }}" data-price-url="{{ route('get-price', $product->id) }}"
                            data-quantity-url="{{ route('get-amount', $product->id) }}">
                            {{ $product->name }}
                        </option>
                    @endif
                @endforeach
            </select>
        </div>

        <div>
            <label for="price" class="block text-gray-700 font-medium mb-2">السعر</label>
            <input type="number" id="price" name="price" required readonly
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 @error('price') border-red-500 @enderror"
                value="{{ $orderDetails->price }}">
            @error('price')
                <p class="text-red-500 text-sm mt-1">السعر غير مسموح به</p>
            @enderror
        </div>
        <div>
            <label for="amount" class="block text-gray-700 font-medium mb-2">الكميه</label>
            <input type="text" id="amount" name="amount" required
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 @error('price') border-red-500 @enderror"
                value="{{ $orderDetails->amount }}">
        </div>
        <div class="mt-4">
            <label class="block mb-2 font-medium">الكمية المتوفرة:</label>
            <input type="text" id="quantity" class="border rounded px-3 py-2 w-full bg-gray-100" readonly
                @foreach ($products as $product)
                    @if ($product->name == $orderDetails->product_name)
                        value="{{ $product->amount }}"@endif @endforeach>


        </div>       
        </div>
        <div class="flex gap-4">
            <button type="submit"
                class="flex-1 rounded-md bg-green-600 px-4 py-2 text-white font-semibold shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                تعديل
            </button>
            <a href="/allorder"
                class="flex-1 text-center rounded-md bg-gray-500 px-4 py-2 text-white font-semibold shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-400">
                عودة
            </a>
        </div>
    </form>
</body>

</html>
