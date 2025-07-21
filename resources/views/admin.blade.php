<x-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-bold text-gray-800">إدارة الأدمن</h1>
    </x-slot>

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold text-gray-700">قائمة الأدمن</h2>

        @can('add-admin', auth()->user())
            <a href="{{ route('newadmin') }}"
                class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-xl shadow hover:bg-green-700 transition">
                + إضافة أدمن جديد
            </a>
        @endcan
    </div>

    <div class="max-w-5xl mx-auto p-6 bg-white rounded-2xl shadow-lg">

        @if ($admins->isNotEmpty())
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto text-sm text-gray-700">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-left font-medium">#</th>
                            <th class="px-4 py-3 text-left font-medium">اسم المستخدم</th>
                            <th class="px-4 py-3 text-left font-medium">البريد الإلكتروني</th>
                            <th class="px-4 py-3 text-left font-medium">الحالة</th>
                            @can('add-admin', auth()->user())
                                <th class="px-4 py-3 text-left font-medium">الإجراءات</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($admins as $admin)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-3">{{ $admin->id }}</td>
                                <td class="px-4 py-3">{{ $admin->username }}</td>
                                <td class="px-4 py-3">{{ $admin->email }}</td>
                                <td class="px-4 py-3">
                                    @if (auth()->check() && auth()->user()->id === $admin->id)
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            نشط الآن (أنت)
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            غير نشط
                                        </span>
                                    @endif
                                </td>
                                @can('add-admin', auth()->user())
                                    <td class="px-4 py-3 flex space-x-2">
                                        <a href="/admin/{{ $admin['id'] }}/edit"
                                            class="px-3 py-1.5 bg-blue-600 text-white text-xs rounded-xl hover:bg-blue-700 transition">
                                            تعديل
                                        </a>

                                        <button type="button" onclick="openConfirmModal({{ $admin['id'] }}, 'admin')"
                                            class="px-3 py-1.5 bg-red-600 text-white text-xs rounded-xl hover:bg-red-700 transition">
                                            حذف
                                        </button>
                                    </td>
                                @endcan
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-8 text-gray-500">
                لا يوجد أدمن مسجل حتى الآن.
            </div>
        @endif
    </div>
    <!-- مودال تأكيد الحذف -->
    <div id="confirmModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg max-w-sm w-full p-6 text-center">
            <h2 class="text-lg font-semibold mb-4">تأكيد الحذف</h2>
            <p class="mb-6 text-gray-700">هل أنت متأكد أنك تريد حذف هذا العنصر؟</p>
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
