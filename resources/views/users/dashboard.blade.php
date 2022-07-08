<x-layout.dash>
    <div class="flex flex-col h-full">

        <x-accountNav />

        <div class="flex-1 mt-3">
            <div class="grid grid-cols-2 grid-rows-2 gap-5">

                <div class="bg-green-500">
                    <livewire:profile />
                </div>
                <div class="bg-red-500">
                    red
                </div>

                <div class="bg-yellow-500">
                    yellow
                </div>

                <div class="bg-blue-500">blue</div>

            </div>


        </div>

    </div>

</x-layout.dash>
