<button
    {{ $attributes->merge([
        'type' => 'button',
        'class' => 'bg-primary font-bold rounded shadow-lg px-4 py-2 text-white',
    ]) }}>

    {{ $slot }}

</button>
