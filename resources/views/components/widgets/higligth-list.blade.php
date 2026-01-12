@props([
    'estimasi' => [], // array keyed 'H-14', 'H-7', 'H-3'
])

@php
    $colors = [
        'H-14' => 'blue',
        'H-7' => 'amber',
        'H-3' => 'rose',
    ];
@endphp

<div class="rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-900 p-6">
    <!-- Header -->
    <div class="mb-6">
        <h3 class="text-lg font-semibold text-neutral-900 dark:text-neutral-100">
            Highlight Panen Mendatang
        </h3>
        <p class="text-sm text-neutral-500 dark:text-neutral-400">
            Estimasi panen berdasarkan tanggal tebar
        </p>
    </div>

    <!-- Content -->
    <div class="space-y-6">
        @foreach ($estimasi as $key => $items)
            @if ($items->count())
                <div class="space-y-3">
                    @foreach ($items as $data)
                        @php $color = $colors[$key] ?? 'neutral'; @endphp

                        <div
                            class="rounded-lg border border-neutral-200 dark:border-neutral-700
                                   bg-neutral-50 dark:bg-neutral-800 p-4">

                            <div class="flex items-start justify-between gap-4">
                                <!-- Left -->
                                <div class="space-y-1">
                                    <p class="text-xs uppercase tracking-wide text-neutral-500 dark:text-neutral-400">
                                        {{ $data->jenis_benih ?? 'Seeding' }}
                                    </p>

                                    <h4 class="text-base font-medium text-neutral-900 dark:text-neutral-100">
                                        Target {{ $data->target_weight ?? '-' }} kg
                                    </h4>

                                    <p class="text-sm text-neutral-500 dark:text-neutral-400">
                                        Est. Panen:
                                        <span class="font-medium text-neutral-700 dark:text-neutral-200">
                                            {{ $data->estimated_harvest_date?->format('d M Y') ?? '-' }}
                                        </span>
                                    </p>
                                </div>

                                <!-- Badge -->
                                <span
                                    class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-medium
                                           bg-{{ $color }}-100 text-{{ $color }}-700
                                           dark:bg-{{ $color }}-900/40 dark:text-{{ $color }}-300">
                                    {{ $key }}
                                </span>
                            </div>

                            @if ($data->keterangan)
                                <p class="mt-2 text-sm text-neutral-500 dark:text-neutral-400">
                                    {{ $data->keterangan }}
                                </p>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        @endforeach

        @if (collect($estimasi)->flatten()->isEmpty())
            <!-- Empty State -->
            <div
                class="flex items-start gap-3 rounded-lg border border-dashed border-neutral-300
                       dark:border-neutral-700 bg-neutral-50 dark:bg-neutral-800 p-4">
                <svg class="w-5 h-5 text-neutral-400 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 9v3.75m0 3.75h.008M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>

                <div>
                    <p class="font-medium text-neutral-700 dark:text-neutral-200">
                        Belum ada panen mendatang
                    </p>
                    <p class="text-sm text-neutral-500 dark:text-neutral-400">
                        Data estimasi panen akan muncul otomatis sesuai jadwal
                    </p>
                </div>
            </div>
        @endif
    </div>
</div>
