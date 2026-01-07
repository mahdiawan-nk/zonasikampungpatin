@extends('components.layouts.landing')
@push('styles')
    <style>
        .section-bg {
            background-image: url('{{ asset('images/kampung-patin-bg.jpg') }}');
        }
    </style>
@endpush
@section('content')
    <section
        class="relative mt-18 min-h-screen bg-center bg-cover bg-no-repeat section-bg
           before:absolute before:inset-0 before:bg-black/60 before:backdrop-blur-[2px]">

        <div class="relative z-10 mx-auto max-w-screen-xl px-4 py-24 lg:py-40 text-center">

            <!-- Heading -->
            <h1 class="mb-6 text-4xl font-bold tracking-tight text-white
                   md:text-5xl lg:text-6xl">
                Peta Zonasi Kolam Patin<br class="hidden sm:block">
                Kampung Patin XIII Koto Kampar
            </h1>

            <!-- Subtitle -->
            <p class="mx-auto mb-10 max-w-3xl text-base text-neutral-200
                   md:text-lg lg:text-xl">
                Sistem visualisasi spasial untuk pemetaan, monitoring, dan
                pengelolaan kolam budidaya ikan patin secara terintegrasi dan
                transparan.
            </p>

            <!-- CTA -->
            <div class="flex flex-col items-center gap-4 sm:flex-row sm:justify-center">

                <a href="/peta-zonasi" wire:navigate
                    class="inline-flex items-center gap-2 rounded-lg
                       bg-brand px-6 py-3 text-base font-semibold text-white
                       shadow-lg transition
                       hover:bg-brand-strong focus:outline-none
                       focus:ring-4 focus:ring-brand/40">
                    Lihat Peta Zonasi
                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 12H5m14 0-4 4m4-4-4-4" />
                    </svg>
                </a>

                {{-- <a href="#about"
                    class="rounded-lg border border-white/30 px-6 py-3
                       text-base font-medium text-white/90
                       backdrop-blur-sm transition
                       hover:bg-white/10 hover:text-white">
                    Pelajari Lebih Lanjut
                </a> --}}
            </div>

            <!-- Stats -->
            <div class="mt-16 grid grid-cols-1 gap-6 sm:grid-cols-3 lg:grid-cols-3 hidden">

                <!-- Card -->
                <div
                    class="rounded-xl border border-white/10
                       bg-white/90 p-6 text-center shadow-md
                       backdrop-blur-md
                       dark:bg-neutral-900/70 dark:text-white">
                    <p class="text-sm text-neutral-500 dark:text-neutral-400">
                        Jumlah Kolam Terdata
                    </p>
                    <h2 class="mt-2 text-4xl font-bold text-neutral-900 dark:text-white">
                        128
                    </h2>
                </div>

                <div
                    class="rounded-xl border border-white/10
                       bg-white/90 p-6 text-center shadow-md
                       backdrop-blur-md
                       dark:bg-neutral-900/70 dark:text-white">
                    <p class="text-sm text-neutral-500 dark:text-neutral-400">
                        Luas Kawasan Kolam
                    </p>
                    <h2 class="mt-2 text-4xl font-bold text-neutral-900 dark:text-white">
                        32 Ha
                    </h2>
                </div>

                <div
                    class="rounded-xl border border-white/10
                       bg-white/90 p-6 text-center shadow-md
                       backdrop-blur-md
                       dark:bg-neutral-900/70 dark:text-white">
                    <p class="text-sm text-neutral-500 dark:text-neutral-400">
                        Jumlah Pembudidaya
                    </p>
                    <h2 class="mt-2 text-4xl font-bold text-neutral-900 dark:text-white">
                        87 Orang
                    </h2>
                </div>

            </div>

        </div>
    </section>
@endsection
