<div>
    <div class="flex justify-center mt-5">
        <button
            class="p-3 bg-white rounded shadow hover:bg-secondary-500 hover:text-white focus:text-white focus:bg-secondary-500">
            Create a transaction
        </button>
    </div>

    <div class="w-2/5 mx-auto my-5">
        <x-card title="Add transaction" class="dark:bg-slate-600">
            <div class="grid grid-cols-2 gap-5">
                <x-input label="Amount" placeholder="Amount" type="number" step="0.01" wire:model.defer="amount" />
                <x-input label="Recipient" placeholder="Recipient" wire:model.defer="recepient" />

                <x-textarea wire:model="Discription" label="Discription" placeholder="Discription" />

                <x-native-select label="Type" placeholder="Type" :options="$types" wire:model.defer="type" />
                <x-native-select label="Category" placeholder="Category" :options="$categories"
                    wire:model.defer="category" />
                <x-native-select label="Tag" placeholder="Tag" :options="$tags" wire:model.defer="tag" />
            </div>

            <x-slot name="footer">
                <div class="flex justify-between items-center">
                    <x-button label="Save" primary />
                </div>
            </x-slot>
        </x-card>
    </div>
</div>
