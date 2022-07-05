<button
    {{ $attributes->merge([
        'type' => 'button',
        'class' => 'px-4 py-2 bg-primary text-white font-bold rounded shadow-lg
                      hover:text-white hover:bg-secondary transition',
    ]) }}>

    {{ $slot }}

</button>
