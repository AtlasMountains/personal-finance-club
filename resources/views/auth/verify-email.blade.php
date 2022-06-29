<x-layout.app>

  <div
    class="mx-auto mt-48 w-4/5 md:w-3/6 p-4 bg-dark text-white text-center shadow-lg rounded-lg
    flex flex-col items-center justify-center space-y-6
    dark:bg-gray-300 dark:text-black">
    <h1 class="text-3xl font-bold">{{__('messages.verify_email')}}</h1>
    <p class="">{{ __('messages.verify_email_body') }}</p>
    <form action="{{ route('verification.send') }}" method="post">
      @csrf
      <button class="p-3 bg-primary rounded-lg shadow-lg hover:text-white hover:bg-secondary transition">
        {{ __('messages.resend') }}
      </button>
    </form>
  </div>

</x-layout.app>
