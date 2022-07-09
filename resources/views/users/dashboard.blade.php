<x-layout.dash>
    <x-notifications />
    <x-dialog />

    <div class="flex flex-col h-full">

        <x-accountNav />

        <div class="flex-1 mt-3">
            <div class="grid gap-4 px-4 md:grid-cols-2 lg:grid-cols-3">

                <div class="p-2 bg-gray-100 rounded shadow dark:bg-slate-600">
                    <livewire:profile />
                </div>
                <div class="p-2 bg-gray-100 rounded shadow dark:bg-slate-600">
                    <livewire:accounts />
                </div>
                <div class="p-2 bg-green-500 rounded shadow">family</div>

            </div>
        </div>

    </div>

</x-layout.dash>
