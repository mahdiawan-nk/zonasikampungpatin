<div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
    <div class="w-full">
        <!-- Welcome Card -->
        <div
            class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-xl shadow-lg p-6 flex flex-col md:flex-row items-center justify-between gap-6 animate-fadeIn">

            <!-- Kiri: Icon + Greeting -->
            <div class="flex items-center gap-4">
                <!-- Icon / Illustration -->
                <div class="flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="h-20 w-20">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12.75 19.5v-.75a7.5 7.5 0 0 0-7.5-7.5H4.5m0-6.75h.75c7.87 0 14.25 6.38 14.25 14.25v.75M6 18.75a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                    </svg>
                </div>
                <!-- Greeting Text -->
                <div>
                    <h2 class="text-2xl md:text-3xl font-bold">Selamat Datang, <span
                            class="underline decoration-white/50"><?php echo e(auth()->user()->name); ?></span>!</h2>
                    <p class="mt-2 text-white/80">Semoga hari ini produktif! Lihat ringkasan aktivitasmu di dashboard.
                    </p>
                    <!-- Quick Actions -->
                    <div class="mt-4 flex flex-wrap gap-3">
                        <a href="<?php echo e(route('kolam.index')); ?>" wire:navigate
                            class="bg-white text-indigo-600 font-semibold px-4 py-2 rounded-lg shadow hover:bg-indigo-50 transition">Mulai
                            Aktivitas</a>
                    </div>
                </div>
            </div>

            <!-- Kanan: Hari, Tanggal, Jam -->
            <div x-data="clock()" class="text-right flex flex-col items-end space-y-1">
                <div class="text-lg font-semibold" x-text="day"></div>
                <div class="text-sm" x-text="date"></div>
                <div class="text-2xl font-mono" x-text="time"></div>
            </div>
        </div>
    </div>
    <div class="grid auto-rows-min gap-6 md:grid-cols-3">
        <div class="grid auto-rows-min gap-4 md:grid-cols-1">
            <!--[if BLOCK]><![endif]--><?php if(auth()->user()->role === 'Administrator'): ?>
                <?php if (isset($component)) { $__componentOriginal861c61a8b6ee78360a5799f0ed99e8cb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal861c61a8b6ee78360a5799f0ed99e8cb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.widgets.stat-card','data' => ['label' => 'Total Pemilik Kolam','value' => ''.e($this->getUserProperty()).'','icon' => 'heroicon-o-users','color' => 'indigo','sizeIcon' => '8']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('widgets.stat-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Total Pemilik Kolam','value' => ''.e($this->getUserProperty()).'','icon' => 'heroicon-o-users','color' => 'indigo','sizeIcon' => '8']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal861c61a8b6ee78360a5799f0ed99e8cb)): ?>
<?php $attributes = $__attributesOriginal861c61a8b6ee78360a5799f0ed99e8cb; ?>
<?php unset($__attributesOriginal861c61a8b6ee78360a5799f0ed99e8cb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal861c61a8b6ee78360a5799f0ed99e8cb)): ?>
<?php $component = $__componentOriginal861c61a8b6ee78360a5799f0ed99e8cb; ?>
<?php unset($__componentOriginal861c61a8b6ee78360a5799f0ed99e8cb); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginal861c61a8b6ee78360a5799f0ed99e8cb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal861c61a8b6ee78360a5799f0ed99e8cb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.widgets.stat-card','data' => ['label' => 'Total Kolam Di Peta','value' => ''.e($this->getKolamInMapProperty()).'','icon' => 'heroicon-o-cube','color' => 'indigo','sizeIcon' => '8']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('widgets.stat-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Total Kolam Di Peta','value' => ''.e($this->getKolamInMapProperty()).'','icon' => 'heroicon-o-cube','color' => 'indigo','sizeIcon' => '8']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal861c61a8b6ee78360a5799f0ed99e8cb)): ?>
<?php $attributes = $__attributesOriginal861c61a8b6ee78360a5799f0ed99e8cb; ?>
<?php unset($__attributesOriginal861c61a8b6ee78360a5799f0ed99e8cb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal861c61a8b6ee78360a5799f0ed99e8cb)): ?>
<?php $component = $__componentOriginal861c61a8b6ee78360a5799f0ed99e8cb; ?>
<?php unset($__componentOriginal861c61a8b6ee78360a5799f0ed99e8cb); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginal861c61a8b6ee78360a5799f0ed99e8cb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal861c61a8b6ee78360a5799f0ed99e8cb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.widgets.stat-card','data' => ['label' => 'Total Kolam Di Peta Belum Terdata','value' => ''.e($this->getKolamInMapNotTerdaftarProperty()).'','icon' => 'heroicon-o-cube','color' => 'indigo','sizeIcon' => '8']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('widgets.stat-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Total Kolam Di Peta Belum Terdata','value' => ''.e($this->getKolamInMapNotTerdaftarProperty()).'','icon' => 'heroicon-o-cube','color' => 'indigo','sizeIcon' => '8']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal861c61a8b6ee78360a5799f0ed99e8cb)): ?>
<?php $attributes = $__attributesOriginal861c61a8b6ee78360a5799f0ed99e8cb; ?>
<?php unset($__attributesOriginal861c61a8b6ee78360a5799f0ed99e8cb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal861c61a8b6ee78360a5799f0ed99e8cb)): ?>
<?php $component = $__componentOriginal861c61a8b6ee78360a5799f0ed99e8cb; ?>
<?php unset($__componentOriginal861c61a8b6ee78360a5799f0ed99e8cb); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginal861c61a8b6ee78360a5799f0ed99e8cb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal861c61a8b6ee78360a5799f0ed99e8cb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.widgets.stat-card','data' => ['label' => 'Total Kolam Di Peta Terdata','value' => ''.e($this->getKolamInMapTerdaftarProperty()).'','icon' => 'heroicon-o-cube','color' => 'indigo','sizeIcon' => '8']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('widgets.stat-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Total Kolam Di Peta Terdata','value' => ''.e($this->getKolamInMapTerdaftarProperty()).'','icon' => 'heroicon-o-cube','color' => 'indigo','sizeIcon' => '8']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal861c61a8b6ee78360a5799f0ed99e8cb)): ?>
<?php $attributes = $__attributesOriginal861c61a8b6ee78360a5799f0ed99e8cb; ?>
<?php unset($__attributesOriginal861c61a8b6ee78360a5799f0ed99e8cb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal861c61a8b6ee78360a5799f0ed99e8cb)): ?>
<?php $component = $__componentOriginal861c61a8b6ee78360a5799f0ed99e8cb; ?>
<?php unset($__componentOriginal861c61a8b6ee78360a5799f0ed99e8cb); ?>
<?php endif; ?>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            <?php if(auth()->user()->role === 'Pemilik Kolam'): ?>
                <?php if (isset($component)) { $__componentOriginal861c61a8b6ee78360a5799f0ed99e8cb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal861c61a8b6ee78360a5799f0ed99e8cb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.widgets.stat-card','data' => ['label' => 'Total Kolam Saya','value' => ''.e($this->getMyKolamProperty()).'','icon' => 'heroicon-o-cube','color' => 'indigo','sizeIcon' => '8']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('widgets.stat-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Total Kolam Saya','value' => ''.e($this->getMyKolamProperty()).'','icon' => 'heroicon-o-cube','color' => 'indigo','sizeIcon' => '8']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal861c61a8b6ee78360a5799f0ed99e8cb)): ?>
<?php $attributes = $__attributesOriginal861c61a8b6ee78360a5799f0ed99e8cb; ?>
<?php unset($__attributesOriginal861c61a8b6ee78360a5799f0ed99e8cb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal861c61a8b6ee78360a5799f0ed99e8cb)): ?>
<?php $component = $__componentOriginal861c61a8b6ee78360a5799f0ed99e8cb; ?>
<?php unset($__componentOriginal861c61a8b6ee78360a5799f0ed99e8cb); ?>
<?php endif; ?>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            <?php if (isset($component)) { $__componentOriginal861c61a8b6ee78360a5799f0ed99e8cb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal861c61a8b6ee78360a5799f0ed99e8cb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.widgets.stat-card','data' => ['label' => 'Total Kolam Aktif','value' => ''.e($this->getKolamAktifProperty()).'','icon' => 'heroicon-o-cube','color' => 'indigo','sizeIcon' => '8']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('widgets.stat-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Total Kolam Aktif','value' => ''.e($this->getKolamAktifProperty()).'','icon' => 'heroicon-o-cube','color' => 'indigo','sizeIcon' => '8']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal861c61a8b6ee78360a5799f0ed99e8cb)): ?>
<?php $attributes = $__attributesOriginal861c61a8b6ee78360a5799f0ed99e8cb; ?>
<?php unset($__attributesOriginal861c61a8b6ee78360a5799f0ed99e8cb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal861c61a8b6ee78360a5799f0ed99e8cb)): ?>
<?php $component = $__componentOriginal861c61a8b6ee78360a5799f0ed99e8cb; ?>
<?php unset($__componentOriginal861c61a8b6ee78360a5799f0ed99e8cb); ?>
<?php endif; ?>
            <?php if (isset($component)) { $__componentOriginal861c61a8b6ee78360a5799f0ed99e8cb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal861c61a8b6ee78360a5799f0ed99e8cb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.widgets.stat-card','data' => ['label' => 'Total Kolam Rusak','value' => ''.e($this->getKolamRusakProperty()).'','icon' => 'heroicon-o-cube','color' => 'indigo','sizeIcon' => '8']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('widgets.stat-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Total Kolam Rusak','value' => ''.e($this->getKolamRusakProperty()).'','icon' => 'heroicon-o-cube','color' => 'indigo','sizeIcon' => '8']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal861c61a8b6ee78360a5799f0ed99e8cb)): ?>
<?php $attributes = $__attributesOriginal861c61a8b6ee78360a5799f0ed99e8cb; ?>
<?php unset($__attributesOriginal861c61a8b6ee78360a5799f0ed99e8cb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal861c61a8b6ee78360a5799f0ed99e8cb)): ?>
<?php $component = $__componentOriginal861c61a8b6ee78360a5799f0ed99e8cb; ?>
<?php unset($__componentOriginal861c61a8b6ee78360a5799f0ed99e8cb); ?>
<?php endif; ?>
            <?php if (isset($component)) { $__componentOriginal861c61a8b6ee78360a5799f0ed99e8cb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal861c61a8b6ee78360a5799f0ed99e8cb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.widgets.stat-card','data' => ['label' => 'Total Penebaran Benih','value' => ''.e($this->getSeedingProperty()).'','icon' => 'heroicon-o-cube','color' => 'indigo','sizeIcon' => '8']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('widgets.stat-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Total Penebaran Benih','value' => ''.e($this->getSeedingProperty()).'','icon' => 'heroicon-o-cube','color' => 'indigo','sizeIcon' => '8']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal861c61a8b6ee78360a5799f0ed99e8cb)): ?>
<?php $attributes = $__attributesOriginal861c61a8b6ee78360a5799f0ed99e8cb; ?>
<?php unset($__attributesOriginal861c61a8b6ee78360a5799f0ed99e8cb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal861c61a8b6ee78360a5799f0ed99e8cb)): ?>
<?php $component = $__componentOriginal861c61a8b6ee78360a5799f0ed99e8cb; ?>
<?php unset($__componentOriginal861c61a8b6ee78360a5799f0ed99e8cb); ?>
<?php endif; ?>
            <?php if (isset($component)) { $__componentOriginal861c61a8b6ee78360a5799f0ed99e8cb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal861c61a8b6ee78360a5799f0ed99e8cb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.widgets.stat-card','data' => ['label' => 'Total Estimasi Panen','value' => ''.e($this->getPanenProperty()).'','icon' => 'heroicon-o-cube','color' => 'indigo','sizeIcon' => '8']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('widgets.stat-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Total Estimasi Panen','value' => ''.e($this->getPanenProperty()).'','icon' => 'heroicon-o-cube','color' => 'indigo','sizeIcon' => '8']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal861c61a8b6ee78360a5799f0ed99e8cb)): ?>
<?php $attributes = $__attributesOriginal861c61a8b6ee78360a5799f0ed99e8cb; ?>
<?php unset($__attributesOriginal861c61a8b6ee78360a5799f0ed99e8cb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal861c61a8b6ee78360a5799f0ed99e8cb)): ?>
<?php $component = $__componentOriginal861c61a8b6ee78360a5799f0ed99e8cb; ?>
<?php unset($__componentOriginal861c61a8b6ee78360a5799f0ed99e8cb); ?>
<?php endif; ?>
        </div>
        <div class="col-span-2 relative h-full flex-1 overflow-hidden">

            <div class="grid auto-rows-min gap-4 md:grid-cols-1">

                <!--[if BLOCK]><![endif]--><?php if(auth()->user()->role === 'Administrator'): ?>
                    <?php if (isset($component)) { $__componentOriginalf085f9df6703c5ab744e421312724804 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf085f9df6703c5ab744e421312724804 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.widgets.table','data' => ['title' => 'Kolam Baru Ditambahkan','headers' => ['Nama Kolam', 'Pemilik', 'Status', 'Dibuat Pada'],'data' => $this->getKolamActivityProperty(),'fields' => ['nama_kolam', 'user.name', 'status', 'created_at']]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('widgets.table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Kolam Baru Ditambahkan','headers' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['Nama Kolam', 'Pemilik', 'Status', 'Dibuat Pada']),'data' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($this->getKolamActivityProperty()),'fields' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['nama_kolam', 'user.name', 'status', 'created_at'])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf085f9df6703c5ab744e421312724804)): ?>
<?php $attributes = $__attributesOriginalf085f9df6703c5ab744e421312724804; ?>
<?php unset($__attributesOriginalf085f9df6703c5ab744e421312724804); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf085f9df6703c5ab744e421312724804)): ?>
<?php $component = $__componentOriginalf085f9df6703c5ab744e421312724804; ?>
<?php unset($__componentOriginalf085f9df6703c5ab744e421312724804); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginalf085f9df6703c5ab744e421312724804 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf085f9df6703c5ab744e421312724804 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.widgets.table','data' => ['title' => 'Pengguna Activity Login','headers' => ['Nama Pengguna', 'Email', 'Role', 'Login Terakhir'],'data' => $this->getUserActivityProperty(),'fields' => ['name', 'email', 'role', 'last_login']]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('widgets.table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Pengguna Activity Login','headers' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['Nama Pengguna', 'Email', 'Role', 'Login Terakhir']),'data' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($this->getUserActivityProperty()),'fields' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['name', 'email', 'role', 'last_login'])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf085f9df6703c5ab744e421312724804)): ?>
<?php $attributes = $__attributesOriginalf085f9df6703c5ab744e421312724804; ?>
<?php unset($__attributesOriginalf085f9df6703c5ab744e421312724804); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf085f9df6703c5ab744e421312724804)): ?>
<?php $component = $__componentOriginalf085f9df6703c5ab744e421312724804; ?>
<?php unset($__componentOriginalf085f9df6703c5ab744e421312724804); ?>
<?php endif; ?>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                <?php if (isset($component)) { $__componentOriginalb28d6d5947946cbeaf27c90638f4aa66 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb28d6d5947946cbeaf27c90638f4aa66 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.widgets.higligth-list','data' => ['estimasi' => $this->getEstimateHighlightProperty()]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('widgets.higligth-list'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['estimasi' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($this->getEstimateHighlightProperty())]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb28d6d5947946cbeaf27c90638f4aa66)): ?>
<?php $attributes = $__attributesOriginalb28d6d5947946cbeaf27c90638f4aa66; ?>
<?php unset($__attributesOriginalb28d6d5947946cbeaf27c90638f4aa66); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb28d6d5947946cbeaf27c90638f4aa66)): ?>
<?php $component = $__componentOriginalb28d6d5947946cbeaf27c90638f4aa66; ?>
<?php unset($__componentOriginalb28d6d5947946cbeaf27c90638f4aa66); ?>
<?php endif; ?>
            </div>
        </div>
    </div>

</div>
<script>
    function clock() {
        return {
            day: '',
            date: '',
            time: '',
            init() {
                const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                const updateClock = () => {
                    const now = new Date();
                    this.day = days[now.getDay()];
                    this.date = now.toLocaleDateString('id-ID', {
                        day: '2-digit',
                        month: 'long',
                        year: 'numeric'
                    });
                    this.time = now.toLocaleTimeString('id-ID', {
                        hour: '2-digit',
                        minute: '2-digit',
                        second: '2-digit'
                    });
                }
                updateClock();
                setInterval(updateClock, 1000);
            }
        }
    }
</script><?php /**PATH /var/www/html/resources/views/livewire/admin/dashboard.blade.php ENDPATH**/ ?>