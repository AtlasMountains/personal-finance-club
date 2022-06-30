<x-layout.app>
  <div class="flex items-center justify-center h-full">
    <div class="w-4/5 md:w-3/6 p-4 space-y-4">

      @if(session('max_attempts'))
        <div class="alert bg-red-500">
          {{ session('max_attempts') }}
        </div>
      @endif
      <div
        class="text-center bg-white shadow-lg rounded-lg
          flex flex-col items-center justify-center space-y-3
          dark:bg-gray-300 dark:text-black">

        <h1 class="text-3xl font-bold p-3">{{__('messages.verify_email')}}</h1>
        <p class="px-6">{{ __('messages.verify_email_body') }}</p>

        <form action="{{ route('verification.send') }}" method="post">
          @csrf
          <button
            class="p-3 mb-4 text-white bg-primary rounded-lg shadow-lg hover:text-white hover:bg-secondary transition">
            {{ __('messages.resend') }}
          </button>

          @if( $remaining > 0 )
            <div class="pb-2">
              {{ __('auth.emails_available') }} {{ $remaining }}
              @else
                {{ __('auth.max_emails_send') }}
            </div>
          @endif
          <div class="pb-2">
            {{ __('auth.more_emails_after') }} {{ $wait_time }}
          </div>
        </form>

      </div>

      @if (session('message'))
        <div class="alert bg-secondary">
          {{ session('message') }}
        </div>
      @endif
    </div>
  </div>
</x-layout.app>
