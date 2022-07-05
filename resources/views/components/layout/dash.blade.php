<x-layout.app>
  <h1 class="mx-auto text-3xl bg-blue-400 p-3 mb-3 rounded-lg text-center w-6/12 text-white">Dashboard</h1>

  <div class="grid grid-cols-5 h-full bg-yellow-200">
    <aside class="col-span-1">

      <div class="text-center font-bold text-lg">ROLE</div>
      <ul class="pl-3 space-y-2">
        <li class="">family
          @if($family)
            {{ $family->name }}
            <ul>
              @foreach($familyAccounts as $account)
                <li class="ml-3">{{ $account->name }}</li>
              @endforeach
            </ul>
          @endif
        </li>

        <li class="">accounts
          <ul class="flex flex-col">
            @foreach($userAccounts as $account)
              <li class="ml-3">
                <a href="">{{ $account->name }}</a>
              </li>
            @endforeach
          </ul>
        </li>
      </ul>
    </aside>

    <section class="col-span-4 flex flex-col items-center h-full bg-red-200">
      {{ $slot }}
    </section>

  </div>
</x-layout.app>
