@props([
    'estimasi' => [], // array keyed 'H-14', 'H-7', 'H-3'
])
@php
    use Illuminate\Support\Carbon;
    $today = Carbon::today();

    $colors = [
        'H-14' => 'blue',
        'H-7' => 'red',
        'H-3' => 'green',
    ];
@endphp

<div class="bg-white shadow-sm p-7 dark:bg-gray-800">
    <div class="block mb-7">
        <h5 class="text-xl font-bold leading-none tracking-tight text-neutral-900 dark:text-white">Higlight Panen Yang
            Akan Datang</h5>
    </div>
    @foreach ($estimasi as $key => $items)
        @if ($items->count() > 0)
            <div class="space-y-4 mb-6">
                @forelse ($items as $data)
                    @php
                        $color = $colors[$key] ?? 'gray';
                    @endphp

                    <div
                        class="p-4 rounded-xl shadow-sm border transition-colors
                    bg-{{ $color }}-50 dark:bg-{{ $color }}-700 border-{{ $color }}-800 dark:border-{{ $color }}-600">

                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-gray-500 dark:text-white text-sm">
                                    Seeding: {{ $data->dataSeeding->jenis_benih ?? 'N/A' }}
                                </p>
                                <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mt-1">
                                    Target: {{ $data->target_weight }} kg
                                </h3>
                                <p class="text-gray-500 dark:text-gray-300 text-sm mt-1">
                                    Est. Panen:
                                    {{ \Carbon\Carbon::parse($data->estimated_harvest_date)->format('d M Y') }}
                                </p>
                            </div>

                            <span
                                class="inline-block px-3 py-1 text-xs font-semibold rounded-full
                        bg-{{ $color }}-500 text-white">
                                {{ $key }}
                            </span>
                        </div>

                        @if ($data->notes)
                            <p class="text-gray-400 dark:text-gray-300 text-sm mt-2">{{ $data->notes }}</p>
                        @endif
                    </div>

                @empty
                    <p class="text-gray-400 dark:text-gray-500 text-center py-6">Tidak ada data {{ $key }}</p>
                @endforelse
            </div>
        @else
            <div
                class="relative w-full rounded-lg border border-transparent bg-blue-50 p-4 [&>svg]:absolute [&>svg]:text-foreground [&>svg]:left-4 [&>svg]:top-4 [&>svg+div]:translate-y-[-3px] [&:has(svg)]:pl-11 text-blue-600">
                <svg class="w-5 h-5 -translate-y-0.5" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                </svg>
                <h5 class="mb-1 font-medium leading-none tracking-tight">Informasi</h5>
                <div class="text-sm opacity-80">Belum Ada Panen Yang Akan Datang</div>
            </div>
            @break

        @endif
    @endforeach
</div>
