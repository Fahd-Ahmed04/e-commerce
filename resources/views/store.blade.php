<x-layout>
    <x-slot name="header">
        المخازن
    </x-slot>

    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-semibold text-gray-800">قائمة المنتجات في المخازن</h2>
        <a href="{{ route('add-store') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ إضافة</a>
    </div>

    @if ($stories->isNotEmpty())
        <div class="overflow-x-auto bg-white rounded-xl shadow-lg">
            <table class="min-w-full text-sm text-center rtl text-gray-800">
                <thead class="bg-gray-100 text-gray-700 font-bold border-b">
                    <tr>
                        <th class="py-3 px-4">#</th>
                        <th class="py-3 px-4">اسم المخزن</th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-100">
                    @foreach ($stories as $store)
                        <tr class="hover:bg-blue-50 transition duration-200">
                            <td class="py-3 px-4 font-medium">{{ $store->id }}</td>
                            <td class="py-3 px-4">{{ $store->name }}</td>
                            <td class="py-3 px-4 flex justify-center gap-4">
                                <a href="{{ route('show-store', $store->id) }}"
                                    class="text-blue-600 hover:text-blue-800 transition" title="عرض التقرير">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h7l5 5v14a2 2 0 01-2 2z" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="p-6 bg-white rounded shadow text-center text-gray-600">
            لا توجد مخازن حتى الآن.
        </div>
    @endif


</x-layout>
