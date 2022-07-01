<div {{ $attributes->merge([
    'class' => 'w-full flex flex-col flex-grow md:w-4/5 lg:w-3/5 2xl:w-2/5',
]) }}>

    <form action="" method="post" class="flex flex-col items-center space-y-6 w-full py-3">
        @csrf
        {{ $slot }}
    </form>

</div>
