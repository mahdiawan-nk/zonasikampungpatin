<?php $__env->startPush('styles'); ?>
    <style>
        .section-bg {
            background-image: url('<?php echo e(asset("images/kampung-patin-bg.jpg")); ?>');
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <section
        class="section-bg mt-18 bg-center h-screen bg-no-repeat bg-cover bg-dark bg-blend-multiply">
        <div class="px-4 mx-auto max-w-screen-xl text-center py-24 lg:py-56">
            <h1 class="mb-6 text-4xl font-bold tracking-tighter text-white md:text-5xl lg:text-6xl">Peta Zonasi Kolam
                Patin Kampung Patin XIII Koto Kampar</h1>
            <p class="mb-8 text-base font-normal text-white md:text-xl sm:px-16 lg:px-48">Here at Flowbite we focus on
                markets where technology, innovation, and capital can unlock long-term value and drive economic growth.
            </p>
            <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0 md:space-x-4">
                <button type="button"
                    class="inline-flex items-center justify-center text-white bg-brand hover:bg-brand-strong box-border border border-transparent focus:ring-4 focus:ring-brand-medium shadow-xs font-medium rounded-base text-base px-5 py-3 focus:outline-none">
                    Getting started
                    <svg class="w-4 h-4 ms-1.5 -me-0.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 12H5m14 0-4 4m4-4-4-4" />
                    </svg>
                </button>
                <button type="button"
                    class="text-body bg-neutral-secondary-medium box-border border border-default-medium hover:bg-neutral-tertiary-medium hover:text-heading focus:ring-4 focus:ring-neutral-tertiary shadow-xs font-medium leading-5 rounded-base text-base px-5 py-3 focus:outline-none">Learn
                    more</button>
            </div>
            <div class="mt-10 max-w-screen-xl mx-auto px-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                <!-- Card: Jumlah Kolam -->
                <div
                    class="bg-white/90 backdrop-blur-md shadow-md rounded-xl p-6 text-center border border-border animate-in fade-in duration-700">
                    <p class="text-sm text-body">Jumlah Kolam Terdata</p>
                    <h2 class="text-4xl font-bold tracking-tight text-heading mt-2">128</h2>
                </div>

                <!-- Card: Total Panen -->
                <div
                    class="bg-white/90 backdrop-blur-md shadow-md rounded-xl p-6 text-center border border-border animate-in fade-in duration-700 delay-100">
                    <p class="text-sm text-body">Total Panen Ikan</p>
                    <h2 class="text-4xl font-bold tracking-tight text-heading mt-2">54 Ton</h2>
                </div>

                <!-- Card: (Opsional) Luas Kawasan -->
                <div
                    class="bg-white/90 backdrop-blur-md shadow-md rounded-xl p-6 text-center border border-border animate-in fade-in duration-700 delay-200">
                    <p class="text-sm text-body">Luas Kawasan Kolam</p>
                    <h2 class="text-4xl font-bold tracking-tight text-heading mt-2">32 Ha</h2>
                </div>

                <!-- Card: (Opsional) Pembudidaya -->
                <div
                    class="bg-white/90 backdrop-blur-md shadow-md rounded-xl p-6 text-center border border-border animate-in fade-in duration-700 delay-300">
                    <p class="text-sm text-body">Jumlah Pembudidaya</p>
                    <h2 class="text-4xl font-bold tracking-tight text-heading mt-2">87 Orang</h2>
                </div>

            </div>

        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('components.layouts.landing', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/welcome.blade.php ENDPATH**/ ?>