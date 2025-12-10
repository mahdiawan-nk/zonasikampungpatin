import '../../vendor/masmerise/livewire-toaster/resources/js';
import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';


Livewire.start();

window.Livewire = Livewire;
window.Alpine = Alpine;

Alpine.start();