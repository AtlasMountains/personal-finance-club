<div class="w-3/5 p-4 mx-auto space-y-4">

    <x-notifications z-index="z-50" />

    <h1 class="text-xl font-semibold text-center dark:text-white">
        {{ trans('user.welcome_profile', ['firstName' => $firstName, 'lastName' => $lastName]) }}
    </h1>

    <p class="text-center">{{ trans('user.subtitle_profile') }}</p>

    <x-input wire:model.lazy='firstName' icon="user" right-icon="pencil" label="{{ __('first name') }}" />
    <x-input wire:model.lazy='lastName' icon="user" right-icon="pencil" label="{{ __('last name') }}" />
    <x-input wire:model.lazy='email' icon="user" right-icon="pencil" label="{{ __('email') }}" />

</div>
