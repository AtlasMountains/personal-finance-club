@props(['for', 'type' => 'text','value'=>''])

<div {{ $attributes->merge(['class' => 'w-4/5 space-y-1']) }}>

  <label for="{{ $for }}" class="mx-2 w-full text-body-color
        dark:text-gray-200">
    {{ $slot }}
  </label>

  <input type="{{ $type }}"
         name="{{ $for }}"
         id="{{ $for }}"
         placeholder="{{ $slot }}"
         value="{{ $value }}"
         class="
              mx-2 px-4 py-1 text-black border-2 border-gray-400 rounded block w-full
              focus:outline-none focus:border-secondary">
</div>
