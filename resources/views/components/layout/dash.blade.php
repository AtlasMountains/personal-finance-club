<x-layout.app>

    <x-slot name='styles'>
        @livewireStyles
    </x-slot>

    <x-slot name='scripts'>
        @livewireScripts
    </x-slot>

    {{ $slot }}

</x-layout.app>
