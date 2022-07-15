@props(['route'])

<a {{ $attributes->merge([
    'class' => 'text-base font-medium text-dark px-2
    hover:text-secondary-300
    dark:text-white dark:hover:text-secondary',
]) }}
   href="{{ $route }}">

  {{ $slot }}
</a>
