@props(['for', 'type' => 'text', 'value'=>'', 'step'=>''])

<div {{ $attributes->merge(['class' => 'w-4/5 space-y-1']) }}>

  <label for="{{ $for }}" class="w-full mx-2 text-body-color dark:text-gray-200">
    {{ $slot }}
  </label>

  <input type="{{ $type }}"
         name="{{ $for }}"
         id="{{ $for }}"
         placeholder="{{ $slot }}"
         value="{{ $value }}"
         step="{{ $step }}"
         class="
              mx-2 px-4 py-1 text-black border-2 border-gray-400 rounded block w-full
              focus:outline-none focus:border-secondary-500 @error($for) border-red-500 @enderror">
  @error($for)
  <div class="pl-2 text-red-500">
    {{$message}}
  </div>
  @enderror
</div>
