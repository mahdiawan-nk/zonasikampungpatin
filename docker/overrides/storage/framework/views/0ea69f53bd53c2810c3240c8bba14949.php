<div>
    
    <nav class="bg-neutral-primary fixed w-full z-20 top-0 start-0 border-b border-default">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="https://flowbite.com/" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="<?php echo e($brandLogo); ?>" class="h-7" alt="Flowbite Logo">
                <span class="self-center text-xl text-heading font-semibold whitespace-nowrap"><?php echo e($brandTitle); ?></span>
            </a>
            <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                <a href="<?php echo e(route('login')); ?>" wire:navigate
                    class="text-white bg-brand hover:bg-brand-strong box-border border border-transparent focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-sm text-sm px-2 py-1 focus:outline-none">Login</a>
                <a href="<?php echo e(route('register')); ?>" wire:navigate
                    class="text-white bg-default hover:bg-brand-strong box-border border border-transparent focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-sm text-sm px-2 py-1 mx-2 focus:outline-none">Daftar</a>
                <button data-collapse-toggle="navbar-sticky" type="button"
                    class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-body rounded-base md:hidden hover:bg-neutral-secondary-soft hover:text-heading focus:outline-none focus:ring-2 focus:ring-neutral-tertiary"
                    aria-controls="navbar-sticky" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                            d="M5 7h14M5 12h14M5 17h14" />
                    </svg>
                </button>
            </div>
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
                <ul
                    class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-default rounded-base
           bg-neutral-secondary-soft md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-neutral-primary">

                    
                    <li>
                        <a href="<?php echo e(route('home')); ?>" wire:navigate class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                            'block py-2 px-3 rounded-sm md:p-0',
                            'text-white bg-brand md:bg-transparent md:text-fg-brand' => request()->routeIs(
                                'home'),
                            'text-heading hover:bg-neutral-tertiary md:hover:bg-transparent md:hover:text-fg-brand' => !request()->routeIs(
                                'home'),
                        ]); ?>">
                            Home
                        </a>
                    </li>

                    
                    <li>
                        <a href="<?php echo e(route('peta-zonasi')); ?>" wire:navigate class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                            'block py-2 px-3 rounded-sm md:p-0',
                            'text-white bg-brand md:bg-transparent md:text-fg-brand' => request()->routeIs(
                                'peta-zonasi'),
                            'text-heading hover:bg-neutral-tertiary md:hover:bg-transparent md:hover:text-fg-brand' => !request()->routeIs(
                                'peta-zonasi'),
                        ]); ?>">
                            Peta Zonasi
                        </a>
                    </li>

                </ul>

            </div>
        </div>
    </nav>
</div><?php /**PATH /var/www/html/resources/views/livewire/navbar.blade.php ENDPATH**/ ?>