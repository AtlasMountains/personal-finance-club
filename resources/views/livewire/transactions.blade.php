<div x-data="{ showAddTransactionForm: @entangle('showForm') }">
  <div class="flex justify-center mt-5">
    <button x-on:click="showAddTransactionForm =! showAddTransactionForm"
            class="p-3 font-semibold bg-white rounded shadow dark:bg-slate-500 dark:hover:text-black dark:focus:text-black dark:hover:bg-gray-200 dark:focus:bg-gray-200 hover:bg-secondary-500 hover:text-white focus:text-white focus:bg-secondary-500">
      Create a new transaction
    </button>
  </div>

  <div x-data="{ showModel:@entangle('showModel') }">
    <x-modal.card title="Create a New Tag" blur wire:model="tagModel" x-show="showModel" x-transition.duration.500ms>
      <p class="text-center">tags can not be deleted</p>
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <x-input label="Tag" placeholder="Tag name" wire:model.lazy="newTag"/>
      </div>

      <x-slot name="footer">
        <div class="flex justify-between gap-x-4">
          <x-button primary label="Save" wire:click="saveTag"/>
          <x-button flat label="Cancel" x-on:click="close"/>
        </div>
      </x-slot>
    </x-modal.card>
  </div>

  <div class="w-2/5 mx-auto my-5" x-show="showAddTransactionForm" x-transition.duration.500ms>
    <x-card title="Add transaction" class="dark:bg-slate-600">
      <div class="grid grid-cols-2 gap-5">

        <x-inputs.currency
          label="Amount"
          placeholder="Amount"
          icon="currency-euro"
          thousands=" "
          decimal="."
          precision="2"
          wire:model.lazy="amount"
        />

        <x-input label="Recipient" placeholder="Recipient" wire:model.defer="recipient"/>

        <x-input label="transaction Date" placeholder="transaction Date" type="date"
                 wire:model.defer="date"/>

        <x-input label="transaction Time" placeholder="transaction Time" type="time"
                 wire:model.defer="time"/>

        <x-native-select label="Type" placeholder="Type" :options="$types" option-label="type"
                         option-value="id" wire:model="type"/>

        <x-native-select label="Category" placeholder="Category" :options="$categories" option-label="category"
                         option-value="id" wire:model.defer="category"/>

        <x-textarea label="Description" placeholder="Description" wire:model.defer="description"/>

        <div class="space-y-2">
          <x-native-select label="Tag" placeholder="Tag" :options="$tags" option-label="tag"
                           option-value="id"
                           wire:model="tag"/>
          <x-button label="create new tag" x-on:click="$openModal('tagModel')"/>
        </div>
      </div>

      <x-slot name="footer">
        <div class="flex items-center justify-between">
          <x-button label="Save" primary wire:click="createTransaction"/>
          <x-button label="Reset" warning wire:click="resetForm"/>
          <x-button label="close" secondary wire:click="closeTransactionForm"/>
        </div>
      </x-slot>
    </x-card>
  </div>
</div>
