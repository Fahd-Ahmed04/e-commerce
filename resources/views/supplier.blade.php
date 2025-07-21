<x-layout>
    <x-slot name="header">
        الموردين
    </x-slot>

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold text-gray-800">قائمة الموردين</h2>
        <a href="{{ route('display-add-supplier') }}"
            class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition-all duration-200 shadow">
            + إضافة مورد
        </a>
    </div>

    @if ($suppliers->isNotEmpty())
        <div class="overflow-x-auto bg-white rounded-xl shadow">
            @if (Session::has('errormessage'))
                <div class="p-4 text-red-600 text-center font-semibold bg-red-100 rounded-t-xl">
                    {{ Session::get('errormessage') }}
                </div>
            @endif

            <table class="min-w-full divide-y divide-gray-200 text-sm text-center">
                <thead class="bg-gray-100 text-gray-700 font-semibold">
                    <tr>
                        <th class="py-3 px-4">#</th>
                        <th class="py-3 px-4">الاسم</th>
                        <th class="py-3 px-4">البريد الإلكتروني</th>
                        <th class="py-3 px-4">رقم الهاتف</th>
                        <th class="py-3 px-4">تعديل</th>
                        <th class="py-3 px-4">حذف</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @foreach ($suppliers as $supplier)
                        <tr class="hover:bg-blue-50 transition duration-150">
                            <td class="py-3 px-4 font-medium text-gray-700">{{ $supplier->id }}</td>
                            <td class="py-3 px-4">{{ $supplier->name }}</td>
                            <td class="py-3 px-4">{{ $supplier->email }}</td>
                            <td class="py-3 px-4">{{ $supplier->phone }}</td>
                            <td class="py-3 px-4">
                                <a href="{{ route('display-edit-supplier', $supplier->id) }}"
                                    class="bg-green-600 text-white px-4 py-1 rounded hover:bg-green-700 transition shadow">
                                    تعديل
                                </a>
                            </td>
                            <td class="py-3 px-4">
                                <button onclick="openConfirmModal({{ $supplier->id }})"
                                    class="bg-red-600 text-white px-4 py-1 rounded hover:bg-red-700 transition shadow">
                                    حذف
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="p-8 bg-white rounded-xl shadow text-center text-gray-600 mt-6">
            لا يوجد موردين حتى الآن.
        </div>
    @endif

    <!-- Modal -->
    <div id="confirmModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6 text-center space-y-5">
            <h2 class="text-lg font-bold text-gray-800">تأكيد الحذف</h2>
            <p class="text-sm text-gray-600">هل أنت متأكد أنك تريد حذف هذا المورد؟ لا يمكن التراجع عن هذا الإجراء.</p>

            <div class="flex justify-center gap-4 pt-2">
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="bg-red-600 text-white px-6 py-2 rounded hover:bg-red-700 transition shadow">
                        نعم، حذف
                    </button>
                </form>
                <button onclick="closeConfirmModal()"
                    class="bg-gray-300 text-gray-800 px-6 py-2 rounded hover:bg-gray-400 transition">
                    إلغاء
                </button>
            </div>
        </div>
    </div>

    <script>
        function openConfirmModal(supplierId) {
            const modal = document.getElementById('confirmModal');
            const form = document.getElementById('deleteForm');
            form.action = `/supplier/${supplierId}`;
            modal.classList.remove('hidden');
        }

        function closeConfirmModal() {
            document.getElementById('confirmModal').classList.add('hidden');
        }
    </script>
</x-layout>
