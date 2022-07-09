<x-layout.app>

    <x-slot name='styles'>
        @livewireStyles
        @powerGridStyles
    </x-slot>

    <x-slot name='scripts'>
        @livewireScripts
        @powerGridScripts
    </x-slot>

    {{ $slot }}

</x-layout.app>
