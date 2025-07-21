<x-layout>
    <x-slot name="header">
        المنتجات
    </x-slot>

    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-semibold text-gray-800">قائمة المنتجات</h2>
        <a href="/add" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ إضافة منتج</a>
    </div>

    @if ($products->isNotEmpty())
        <div class="overflow-x-auto bg-white rounded shadow">
            <table class="min-w-full divide-y divide-gray-200 text-sm text-center">
                <thead class="bg-gray-50 text-gray-700 font-semibold">
                    <tr>
                        <th class="py-3 px-4">#</th>
                        <th class="py-3 px-4">اسم المنتج</th>
                        <th class="py-3 px-4">الصنف</th>
                        <th class="py-3 px-4">المخزن</th>
                        <th class="py-3 px-4">تعديل</th>
                        <th class="py-3 px-4">حذف</th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-100">
                    @foreach ($products as $product)
                        <tr class="hover:bg-blue-50 transition duration-200">
                            <td class="py-3 px-4">{{ $product->id }}</td>
                            <td class="py-3 px-4">{{ $product->name }}</td>
                            <td class="py-3 px-4">{{ $product->category->name }}</td>
                            <td class="py-3 px-4">{{ $product->store->name }}</td>
                            <td class="py-3 px-4">
                                <a href="/dashboard/{{ $product->id }}/edit"
                                    class="bg-green-600 text-white px-3 py-1.5 rounded hover:bg-green-700 transition">
                                    تعديل
                                </a>
                            </td>
                            <td class="py-3 px-4">
                                <button type="button" onclick="openConfirmModal({{ $product->id }})"
                                    class="bg-red-600 text-white px-3 py-1.5 rounded hover:bg-red-700 transition">
                                    حذف
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="p-6 bg-white rounded shadow text-center text-gray-600">
            لا توجد منتجات حتى الآن.
        </div>
    @endif


    <div id="confirmModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg max-w-sm w-full p-6 text-center animate-fade-in">
            <h2 class="text-lg font-semibold mb-4">تأكيد الحذف</h2>
            <p class="mb-6 text-gray-700">هل أنت متأكد من أنك تريد حذف هذا المنتج؟</p>
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

    <!-- فورم الحذف الخفي -->
    <form id="deleteForm" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>

    <script>
        let selectedId = null;

        function openConfirmModal(id) {
            selectedId = id;
            document.getElementById('confirmModal').classList.remove('hidden');
        }

        function closeConfirmModal() {
            document.getElementById('confirmModal').classList.add('hidden');
            selectedId = null;
        }

        function submitDeleteForm() {
            if (selectedId) {
                const form = document.getElementById('deleteForm');
                form.action = `/dashboard/${selectedId}`;
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
