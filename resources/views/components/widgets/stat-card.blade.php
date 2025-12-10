@props(['label', 'value', 'icon' => null, 'color' => 'blue','sizeIcon'=>null])

<div class="p-4 bg-white shadow-sm rounded-xl border border-gray-100">
    <div class="flex items-center justify-between">

        <div>
            <p class="text-gray-500 text-sm">{{ $label }}</p>
            <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ $value }}</h3>
        </div>

        <div class="p-3 rounded-lg bg-{{ $color }}-100 text-{{ $color }}-600">
            @if ($icon)
                <x-dynamic-component :component="$icon" class="size-{{ $sizeIcon ?? '16' }}" />
            @endif
        </div>

    </div>
</div>
