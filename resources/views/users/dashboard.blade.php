<x-layout.app>
  <x-notifications/>
  <x-dialog/>

  <div class="flex flex-col h-full dark:bg-slate-900">

    <div class="flex-1 mt-3">
      <div class="grid gap-4 px-4 md:grid-cols-2 lg:grid-cols-3">

        <div class="p-2 bg-gray-100 rounded shadow dark:bg-slate-600">
          <livewire:profile/>
        </div>

        <div class="p-2 bg-gray-100 rounded shadow dark:bg-slate-600">
          <livewire:accounts/>
        </div>

        <div class="p-2 bg-gray-100 rounded shadow dark:bg-slate-600">
          <livewire:families/>
        </div>

      </div>
    </div>

  </div>

</x-layout.app>
