<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'estimasi' => [], // array keyed 'H-14', 'H-7', 'H-3'
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'estimasi' => [], // array keyed 'H-14', 'H-7', 'H-3'
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<?php
    use Illuminate\Support\Carbon;
    $today = Carbon::today();

    $colors = [
        'H-14' => 'blue',
        'H-7' => 'red',
        'H-3' => 'green',
    ];
?>

<div class="bg-white shadow-sm p-7 dark:bg-gray-800">
    <div class="block mb-7">
        <h5 class="text-xl font-bold leading-none tracking-tight text-neutral-900 dark:text-white">Higlight Panen Yang
            Akan Datang</h5>
    </div>
    <?php $__currentLoopData = $estimasi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <!--[if BLOCK]><![endif]--><?php if($items->count() > 0): ?>
            <div class="space-y-4 mb-6">
                <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php
                        $color = $colors[$key] ?? 'gray';
                    ?>

                    <div
                        class="p-4 rounded-xl shadow-sm border transition-colors
                    bg-<?php echo e($color); ?>-50 dark:bg-<?php echo e($color); ?>-700 border-<?php echo e($color); ?>-800 dark:border-<?php echo e($color); ?>-600">

                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-gray-500 dark:text-white text-sm">
                                    Seeding: <?php echo e($data->dataSeeding->jenis_benih ?? 'N/A'); ?>

                                </p>
                                <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mt-1">
                                    Target: <?php echo e($data->target_weight); ?> kg
                                </h3>
                                <p class="text-gray-500 dark:text-gray-300 text-sm mt-1">
                                    Est. Panen:
                                    <?php echo e(\Carbon\Carbon::parse($data->estimated_harvest_date)->format('d M Y')); ?>

                                </p>
                            </div>

                            <span
                                class="inline-block px-3 py-1 text-xs font-semibold rounded-full
                        bg-<?php echo e($color); ?>-500 text-white">
                                <?php echo e($key); ?>

                            </span>
                        </div>

                        <!--[if BLOCK]><![endif]--><?php if($data->notes): ?>
                            <p class="text-gray-400 dark:text-gray-300 text-sm mt-2"><?php echo e($data->notes); ?></p>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    </div>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="text-gray-400 dark:text-gray-500 text-center py-6">Tidak ada data <?php echo e($key); ?></p>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </div>
        <?php else: ?>
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
            <?php break; ?>

        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
</div>
<?php /**PATH /var/www/html/resources/views/components/widgets/higligth-list.blade.php ENDPATH**/ ?>