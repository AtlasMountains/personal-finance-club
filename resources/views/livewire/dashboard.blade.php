<div class="w-3/5 p-4 mx-auto space-y-4">

    <h1 class="text-3xl font-semibold text-center dark:text-white">
        {{ trans('user.welcome_dashboard', ['firstName' => $firstName]) }}
    </h1>

    <x-input wire:model.lazy='firstName' icon="user" right-icon="pencil" label="{{ __('first name') }}" />

    <x-input wire:model.lazy='lastName' icon="user" right-icon="pencil" label="{{ __('last name') }}" />

    <x-input wire:model.lazy='email' icon="user" right-icon="pencil" label="{{ __('email') }}" />


</div>
