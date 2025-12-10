<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use App\Models\DataKolam;
use App\Models\DataSeeding;
use App\Models\DataEstimasiPanen as DataPanen;
use App\Models\MapFeature;

class Dashboard extends Component
{
    public function getUserProperty()
    {
        return User::where('role', 'Pemilik Kolam')->count();
    }

    public function getKolamInMapProperty()
    {
        return MapFeature::where('geometry_type', 'Polygon')->count();
    }

    public function getKolamInMapNotTerdaftarProperty()
    {
        $dataKolam = DataKolam::get()->pluck('feature_id')->toArray(); 
        return MapFeature::where('geometry_type', 'Polygon')->whereNotIn('feature_id', $dataKolam)->count();
    }

    public function getKolamInMapTerdaftarProperty()
    {
        $dataKolam = DataKolam::get()->pluck('feature_id')->toArray(); 
        return MapFeature::where('geometry_type', 'Polygon')->whereIn('feature_id', $dataKolam)->count();
    }

    public function getKolamAktifProperty()
    {
        return DataKolam::where('status', 'Aktif')->count();
    }

    public function getKolamRusakProperty()
    {
        return DataKolam::where('status', 'Rusak')->count();
    }

    public function getSeedingProperty()
    {
        return DataSeeding::count();
    }

    public function getPanenProperty()
    {
        return DataPanen::count();
    }

    public function getKolamActivityProperty()
    {
        return DataKolam::with('user')->latest()->take(5)->get();
    }

    public function getUserActivityProperty()
    {
        return User::where('last_login', '!=', null)->take(5)->get();
    }
    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}
