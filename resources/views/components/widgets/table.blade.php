@props([
    'title' => 'Overview Data',
    'headers' => [],
    'data' => [],
    'fields' => [],
])

<div class="space-y-4 bg-white p-6 rounded-xl shadow-md dark:bg-gray-800 dark:text-gray-200 transition-colors">

    {{-- Title --}}
    <div class="flex items-center justify-between">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-white">{{ $title }}</h3>
    </div>

    {{-- Table Container --}}
    <div
        class="overflow-hidden border border-gray-200 rounded-xl shadow-sm dark:border-gray-700 dark:bg-gray-800 transition-colors">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-gray-700 dark:text-gray-300">

                {{-- Head --}}
                <thead class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-200">
                    <tr>
                        @foreach ($headers as $header)
                            <th class="px-4 py-3 font-semibold uppercase text-xs tracking-wide text-left">
                                {{ $header }}
                            </th>
                        @endforeach
                    </tr>
                </thead>

                {{-- Body --}}
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @forelse ($data as $row)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            @foreach ($fields as $field)
                                <td class="px-4 py-3 whitespace-nowrap">
                                    {{ data_get($row, $field) }}
                                </td>
                            @endforeach
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ count($headers) }}" class="px-6 py-10 text-center">
                                <div class="flex flex-col items-center text-gray-400 dark:text-gray-500">
                                    <svg class="w-12 h-12 mb-3 opacity-60" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M20 12H4m9 8l-8-8 8-8" />
                                    </svg>
                                    <p class="text-sm font-medium">Tidak ada data untuk ditampilkan</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>

</div>
