@props(['action' => ' '])

<div {{ $attributes->merge([
    'class' => 'flex flex-col flex-grow w-full',
]) }}>

    <form action="{{ $action }}" method="post" class="flex flex-col items-center w-full py-3 space-y-6">
        @csrf
        {{ $slot }}
    </form>

</div>
