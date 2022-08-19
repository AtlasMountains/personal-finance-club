<x-layout.app>

  <x-slot name='styles'>
    @powerGridStyles
  </x-slot>

  <x-slot name='scripts'>
    @powerGridScripts

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.js"
            integrity="sha512-d6nObkPJgV791iTGuBoVC9Aa2iecqzJRE0Jiqvk85BhLHAPhWqkuBiQb1xz2jvuHNqHLYoN3ymPfpiB1o+Zgpw=="
            crossorigin="anonymous" referrerpolicy="no-referrer">

    </script>

    <script defer src="{{ asset('js/charts.js') }}"></script>
  </x-slot>

  {{ $slot }}

</x-layout.app>
