<x-layout>
    <x-slot name="header">
        المستخدمين
    </x-slot>

    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-semibold text-gray-800">قائمة المستخدمين</h2>
        <a href="{{ route('display-add-user') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+
            إضافة مستخدم</a>
    </div>

    @if ($users->isNotEmpty())
        <div class="overflow-x-auto bg-white rounded shadow">
            @if (Session::has('errormessage'))
                <p class="flex justify-center mt-4 text-red-500">{{ Session::get('errormessage') }}</ح>
            @endif
            <table class="min-w-full divide-y divide-gray-200 text-sm text-center">
                <thead class="bg-gray-50 text-gray-700 font-semibold">
                    <tr>
                        <th class="py-3 px-4">#</th>
                        <th class="py-3 px-4">اسم </th>
                        <th class="py-3 px-4">البريد الالكتروني</th>
                        <th class="py-3 px-4">تعديل</th>
                        <th class="py-3 px-4">حذف</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @foreach ($users as $user)
                        <tr class="hover:bg-blue-50 transition duration-200">
                            <td class="py-3 px-4">{{ $user->id }}</td>
                            <td class="py-3 px-4">{{ $user->name }}</td>
                            <td class="py-3 px-4">{{ $user->email }}</td>
                            <td class="py-3 px-4">
                                <a href="{{ route('edit-user', $user->id) }}"
                                    class="bg-green-600 text-white px-3 py-1.5 rounded hover:bg-green-700 transition">
                                    تعديل
                                </a>
                            </td>
                            <td class="py-3 px-4">
                                <button type="button" onclick="openConfirmModal({{ $user->id }})"
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
            لا يوجد مستخدمين حتى الآن.
        </div>
    @endif

    <div id="confirmModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6 text-center space-y-4">
            <h2 class="text-lg font-bold text-gray-800">تأكيد الحذف</h2>
            <p class="text-sm text-gray-600">هل أنت متأكد أنك تريد حذف هذا المستخدم؟ لا يمكن التراجع.</p>

            <div class="flex justify-center gap-4 pt-4">
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">
                        نعم، احذف
                    </button>
                </form>

                <button onclick="closeConfirmModal()"
                    class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400 transition">
                    إلغاء
                </button>
            </div>
        </div>
    </div>
    <script>
        function openConfirmModal(userId) {
            const modal = document.getElementById('confirmModal');
            const form = document.getElementById('deleteForm');
            form.action = `/user/${userId}`; // تأكد من تطابق المسار مع Route الحذف لديك
            modal.classList.remove('hidden');
        }

        function closeConfirmModal() {
            document.getElementById('confirmModal').classList.add('hidden');
        }
    </script>

</x-layout>
