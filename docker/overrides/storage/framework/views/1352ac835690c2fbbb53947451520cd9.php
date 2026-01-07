<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'title' => 'Overview Data',
    'headers' => [],
    'data' => [],
    'fields' => [],
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
    'title' => 'Overview Data',
    'headers' => [],
    'data' => [],
    'fields' => [],
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div class="space-y-4 bg-white p-6 rounded-xl shadow-md dark:bg-gray-800 dark:text-gray-200 transition-colors">

    
    <div class="flex items-center justify-between">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-white"><?php echo e($title); ?></h3>
    </div>

    
    <div
        class="overflow-hidden border border-gray-200 rounded-xl shadow-sm dark:border-gray-700 dark:bg-gray-800 transition-colors">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-gray-700 dark:text-gray-300">

                
                <thead class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-200">
                    <tr>
                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $headers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $header): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <th class="px-4 py-3 font-semibold uppercase text-xs tracking-wide text-left">
                                <?php echo e($header); ?>

                            </th>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                    </tr>
                </thead>

                
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <?php echo e(data_get($row, $field)); ?>

                                </td>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="<?php echo e(count($headers)); ?>" class="px-6 py-10 text-center">
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
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                </tbody>

            </table>
        </div>
    </div>

</div>
<?php /**PATH /var/www/html/resources/views/components/widgets/table.blade.php ENDPATH**/ ?>