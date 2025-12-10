@props([
    'title' => 'Overview Data',
    'headers' => [],
    'data' => [],
    'fields' => [],
])

<div class="space-y-3">

    {{-- Title --}}
    <div class="flex items-center justify-between">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-white">{{ $title }}</h3>
    </div>

    {{-- Table Container --}}
    <div class="overflow-hidden border border-gray-200 rounded-xl bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-gray-700">

                {{-- Head --}}
                <thead class="bg-gray-100 text-gray-600">
                    <tr>
                        @foreach ($headers as $header)
                            <th class="px-4 py-3 font-semibold uppercase text-xs tracking-wide">
                                {{ $header }}
                            </th>
                        @endforeach
                    </tr>
                </thead>

                {{-- Body --}}
                <tbody class="divide-y divide-gray-100">
                    @forelse ($data as $row)
                        <tr class="hover:bg-gray-50 transition-colors">
                            @foreach ($fields as $field)
                                <td class="px-4 py-3">
                                    {{ data_get($row, $field) }}
                                </td>
                            @endforeach
                        </tr>

                    @empty
                        <tr>
                            <td colspan="{{ count($headers) }}" class="px-6 py-10 text-center">
                                <div class="flex flex-col items-center text-gray-400">
                                    <svg class="w-10 h-10 mb-2 opacity-60" fill="none" stroke="currentColor"
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
