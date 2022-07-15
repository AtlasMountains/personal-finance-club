<x-layout.app>
  <x-notifications/>
  <x-dialog/>

  <div class="flex flex-col h-full dark:bg-slate-700">

    {{-- <x-accountNav /> --}}

    <div class="flex-1 mt-3">
      <div class="grid gap-4 px-4 md:grid-cols-2 lg:grid-cols-3">

        <div class="p-2 bg-gray-100 rounded shadow dark:bg-slate-600">
          <livewire:profile/>
        </div>

        <div class="p-2 bg-gray-100 rounded shadow dark:bg-slate-600">
          <livewire:accounts/>
        </div>

        <div class="p-2 bg-gray-100 rounded shadow dark:bg-slate-600">
          <div class="flex flex-col w-full text-center">
            <h1 class="text-lg font-semibold text-center dark:text-white">Family</h1>
            <p class="text-center text-gray-600 dark:text-gray-400">manage your family</p>
          </div>
          <p class="text-lg m-16 xl:m-32 py-5 font-bold text-white bg-slate-700 rounded-lg shadow-lg text-center">
            coming soon
          </p>
        </div>

      </div>
    </div>

  </div>

</x-layout.app>
