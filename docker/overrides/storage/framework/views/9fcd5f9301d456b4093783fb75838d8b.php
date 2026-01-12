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
    $colors = [
        'H-14' => 'blue',
        'H-7' => 'amber',
        'H-3' => 'rose',
    ];
?>

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
        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $estimasi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <!--[if BLOCK]><![endif]--><?php if($items->count()): ?>
                <div class="space-y-3">
                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $color = $colors[$key] ?? 'neutral'; ?>

                        <div
                            class="rounded-lg border border-neutral-200 dark:border-neutral-700
                                   bg-neutral-50 dark:bg-neutral-800 p-4">

                            <div class="flex items-start justify-between gap-4">
                                <!-- Left -->
                                <div class="space-y-1">
                                    <p class="text-xs uppercase tracking-wide text-neutral-500 dark:text-neutral-400">
                                        <?php echo e($data->jenis_benih ?? 'Seeding'); ?>

                                    </p>

                                    <h4 class="text-base font-medium text-neutral-900 dark:text-neutral-100">
                                        Target <?php echo e($data->target_weight ?? '-'); ?> kg
                                    </h4>

                                    <p class="text-sm text-neutral-500 dark:text-neutral-400">
                                        Est. Panen:
                                        <span class="font-medium text-neutral-700 dark:text-neutral-200">
                                            <?php echo e($data->estimated_harvest_date?->format('d M Y') ?? '-'); ?>

                                        </span>
                                    </p>
                                </div>

                                <!-- Badge -->
                                <span
                                    class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-medium
                                           bg-<?php echo e($color); ?>-100 text-<?php echo e($color); ?>-700
                                           dark:bg-<?php echo e($color); ?>-900/40 dark:text-<?php echo e($color); ?>-300">
                                    <?php echo e($key); ?>

                                </span>
                            </div>

                            <!--[if BLOCK]><![endif]--><?php if($data->keterangan): ?>
                                <p class="mt-2 text-sm text-neutral-500 dark:text-neutral-400">
                                    <?php echo e($data->keterangan); ?>

                                </p>
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                </div>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->

        <!--[if BLOCK]><![endif]--><?php if(collect($estimasi)->flatten()->isEmpty()): ?>
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
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    </div>
</div>
<?php /**PATH /var/www/html/resources/views/components/widgets/higligth-list.blade.php ENDPATH**/ ?>