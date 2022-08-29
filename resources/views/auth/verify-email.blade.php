<x-layout.app>
    <div class="flex flex-col items-center justify-center h-full">
        <div class="w-4/5 p-4 space-y-4 md:w-3/6">

            @error('max_attempts')
                <div class="bg-red-500 alert">
                    {{ $errors->first('max_attempts') }}
                </div>
            @enderror
            <div
                class="flex flex-col items-center justify-center space-y-3 text-center bg-white rounded-lg shadow-lg dark:bg-gray-300 dark:text-black">

                <h1 class="p-3 text-3xl font-bold">{{ __('messages.verify_email') }}</h1>
                <p class="px-6">{{ __('messages.verify_email_body') }}</p>

                <form action="{{ route('verification.send') }}" method="post">
                    @csrf
                    <x-forms.button type="submit">
                        {{ __('messages.resend') }}
                    </x-forms.button>

                    @if ($remaining > 0)
                        <div class="py-2">
                            {{ __('auth.emails_available', compact('remaining')) }}
                        </div>
                    @else
                        <div class="py-2">
                            <p>{{ __('auth.more_emails_after', compact('wait_time')) }} </p>
                        </div>
                    @endif
                </form>

            </div>

            @if (session('message'))
                <div class="alert bg-secondary-500">
                    {{ session('message') }}
                </div>
            @endif
        </div>
    </div>
</x-layout.app>
