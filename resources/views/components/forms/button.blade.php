<button
    {{ $attributes->merge([
        'type' => 'button',
        'class' => 'px-4 py-2 bg-primary-500 text-white font-bold rounded shadow-lg
                              hover:text-white hover:bg-secondary-500 transition',
    ]) }}>

    {{ $slot }}

</button>
