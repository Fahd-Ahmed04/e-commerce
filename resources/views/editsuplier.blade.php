<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعديل المستخدم</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">

    <form action="{{ route('edit-supplier', $supplier->id) }}" method="POST"
        class="w-full max-w-lg bg-white rounded-xl shadow-lg p-8 space-y-6 border border-gray-200">
        @csrf
        @method('PUT')

        <h2 class="text-2xl font-bold text-center text-gray-800 mb-4">تعديل بيانات المستخدم</h2>
        @if (session())
            <p class="text-red-500 text-sm mt-1">{{ session('email_error') }}</p>
        @endif
        <div>
            <label for="name" class="block text-gray-700 font-medium mb-1">الاسم</label>
            <input type="text" id="name" name="name" required
                class="w-full border border-gray-300 rounded-md px-4 py-2 text-right focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror"
                value="{{ $supplier->name }}">
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="phone" class="block text-gray-700 font-medium mb-1">الاسم</label>
            <input type="text" id="phone" name="phone" required
                class="w-full border border-gray-300 rounded-md px-4 py-2 text-right focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror"
                value="{{ $supplier->phone }}">
            @error('phone')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="email" class="block text-gray-700 font-medium mb-1">البريد الإلكتروني</label>
            <input type="email" id="email" name="email" required
                class="w-full border border-gray-300 rounded-md px-4 py-2 text-right focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror"
                value="{{ $supplier->email }}">
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-gray-700 font-medium mb-1">كلمة المرور</label>
            <input type="password" id="password" name="password" required
                class="w-full border border-gray-300 rounded-md px-4 py-2 text-right focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password') border-red-500 @enderror"
                value="{{ $supplier->password }}">
            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex flex-col sm:flex-row justify-between gap-4 pt-4">
            <button type="submit"
                class="w-full sm:w-1/2 bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition text-sm font-semibold">
                تحديث
            </button>

            <a href="{{ route('supplier') }}"
                class="w-full sm:w-1/2 text-center bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition text-sm font-semibold">
                عودة
            </a>
        </div>
    </form>

</body>

</html>
