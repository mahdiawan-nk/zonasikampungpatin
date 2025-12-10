<?php $__env->startPush('styles'); ?>
    <?php echo $__env->yieldPushContent('styles'); ?>
<?php $__env->stopPush(); ?>
<?php if (isset($component)) { $__componentOriginalf0e942a0893f566d7326d9a8900e8bc2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf0e942a0893f566d7326d9a8900e8bc2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.app.landing','data' => ['title' => $title ?? null]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app.landing'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($title ?? null)]); ?>
    <?php echo e($slot); ?>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf0e942a0893f566d7326d9a8900e8bc2)): ?>
<?php $attributes = $__attributesOriginalf0e942a0893f566d7326d9a8900e8bc2; ?>
<?php unset($__attributesOriginalf0e942a0893f566d7326d9a8900e8bc2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf0e942a0893f566d7326d9a8900e8bc2)): ?>
<?php $component = $__componentOriginalf0e942a0893f566d7326d9a8900e8bc2; ?>
<?php unset($__componentOriginalf0e942a0893f566d7326d9a8900e8bc2); ?>
<?php endif; ?>
<?php $__env->startPush('scripts'); ?>
    <?php echo $__env->yieldPushContent('scripts'); ?>
<?php $__env->stopPush(); ?>
<?php /**PATH /var/www/html/resources/views/components/layouts/frontend.blade.php ENDPATH**/ ?>