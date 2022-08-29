<x-layout.app>

  <x-slot name='styles'>
    @powerGridStyles
  </x-slot>

  <x-slot name='scripts'>
    @powerGridScripts
  </x-slot>

  {{ $slot }}

</x-layout.app>
