<x-layout.app>
  <h1 class="w-6/12 p-3 mx-auto mb-3 text-3xl text-center text-white bg-blue-400 rounded-lg">Dashboard</h1>

  <div class="grid h-full grid-cols-5 bg-yellow-200">
    <aside class="col-span-1">

      <div class="text-lg font-bold text-center">ROLE</div>
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

    <section class="flex flex-col items-center h-full col-span-4 bg-red-200">
      {{ $slot }}
    </section>

  </div>
</x-layout.app>
