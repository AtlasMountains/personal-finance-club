<section class="pb-3 mx-auto space-y-1">
    <div>
        <h1 class="text-lg font-semibold text-center dark:text-white">
            {{ trans('user.welcome_profile', ['firstName' => $firstName, 'lastName' => $lastName]) }}
        </h1>
        <p class="text-center text-gray-600 dark:text-gray-400">{{ trans('user.subtitle_profile') }}</p>
    </div>

    <div class="w-3/5 pt-2 mx-auto space-y-2">
        <x-input wire:model.lazy='firstName' icon="user" right-icon="pencil" label="{{ __('first name') }}" />
        <x-input wire:model.lazy='lastName' icon="user" right-icon="pencil" label="{{ __('last name') }}" />
        <x-input wire:model.lazy='email' icon="mail" right-icon="pencil" label="{{ __('email') }}" />
    </div>
</section>
