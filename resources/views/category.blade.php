<x-layout>
    <x-slot name="header">
        التصنيفات
    </x-slot>
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-semibold">التصنيفات</h2>
    </div>

    <div class="flex justify-end w-full px-4">
        <a href="/addcategory" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-800">+ اضافه صنف جديد</a>
    </div>
    <div class="max-w-3xl mx-auto mt-6 p-6 bg-gray-50 rounded-2xl shadow">
        @if ($category->isNotEmpty())
            <table class="min-w-full bg-white rounded-lg overflow-hidden">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500  tracking-wider">
                            #
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500  tracking-wider">
                            الصنف
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">

                    <ul class="space-y-4">
                        @foreach ($category as $cate)
                            <tr class="hover:bg-green-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $cate->id }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $cate->name }}</div>
                                </td>
                                <td>
                                    <a href="/category/{{ $cate['id'] }}/edit"
                                        class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                                        تعديل
                                    </a>
                                </td>
                                <td>
                                    <button type="button" onclick="openConfirmModal({{ $cate->id }}, 'category')"
                                        class="bg-red-600 text-white px-3 py-1.5 rounded hover:bg-red-700 transition">
                                        حذف
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </ul>
                @else
                    <p class="text-center text-gray-500">لا يوجد اصناف </p>
        @endif

    </div>
    <div id="confirmModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg max-w-sm w-full p-6 text-center animate-fade-in">
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
