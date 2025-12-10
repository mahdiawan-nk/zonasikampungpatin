<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use App\Livewire\Admin\Datakolam\Create;
use App\Livewire\Admin\Peta\Index as PetaIndex;
use App\Livewire\Admin\Datakolam\Update as UpdateKolam;
use App\Livewire\Admin\Dataseeding\Index as DataseedingIndex;
use App\Livewire\Admin\Datapanen\Index as DatapanenIndex;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('peta-zonasi', function () {
    return view('peta-zonasi');
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::view('admins/users', 'admins.users.index')->name('users.index');
    Route::view('admins/datakolam', 'admins.datakolam.index')->name('kolam.index');
    Route::get('admins/datakolam/create', Create::class)->name('kolam.create');
    Route::get('admins/datakolam/update/{id}', UpdateKolam::class)->name('kolam.update');
    Route::get('admins/pemetaan', PetaIndex::class)->name('pemetaan.index');
    Route::get('admins/dataseedings', DataseedingIndex::class)->name('seeding.index');
    Route::get('admins/datapanens', DatapanenIndex::class)->name('panen.index');
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('user-password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});
