<x-layout.app>
  <div class="flex flex-col pt-3">
    <h1 class="p-3 mx-auto text-3xl font-bold text-center text-white bg-primary-500 rounded-lg">
      The personal finance club
    </h1>

    <section class="mt-2 overflow-hidden">
      <div class="container mx-auto">

        <div class="flex flex-wrap items-center justify-between mx-4">

          <div class="flex items-center w-full px-4 -mx-3 sm:-mx-4 lg:w-8/12">
            <div class="w-full px-3 xl:w-1/2 sm:px-4">
              <div class="py-3 sm:py-4">
                <img src="{{ asset('/images/account charts dark.png') }}"
                     alt=""
                     class="w-full rounded-2xl z-10 hover:z-50 hover:scale-150 hover:translate-x-24 hover:translate-y-12 transition duration-300 ease-in-out"/>
              </div>
              <div class="py-3 sm:py-4">
                <img src="{{ asset('/images/dashboard dark.png') }}"
                     alt=""
                     class="w-full rounded-2xl z-10 hover:z-50 hover:scale-150 hover:translate-x-24 hover:-translate-y-12 transition duration-300 ease-in-out"/>
              </div>
            </div>

            <div class="w-full px-3 xl:w-1/2 sm:px-4">
              <img src="{{ asset('/images/transactions table light.png') }}"
                   alt=""
                   class="w-full rounded-2xl hover:scale-150 transition duration-300 ease-in-out z-10 hover:z-50"/>
            </div>
          </div>

          <div class="w-full px-4 lg:w-4/12">
            <div class="mt-10 lg:mt-0">
              <span class="block mb-2 text-lg font-semibold text-primary-500">
              Why Choose Us
              </span>
              <h2 class="mb-8 text-3xl font-bold sm:text-4xl text-dark dark:text-white">
                Manage your personal finances
              </h2>
              <div class="mb-8 space-y-1 text-base text-body-color dark:text-gray-300">
                <p>
                  This is a demo project to show my skills as a web developer.
                  You can test this application using demo accounts or make your own.
                  Upon creation of your account an email will be sent containing a link to verify your email-address.
                </p>
                <p>Please use demo data (use real email for verification) to test this application.</p>
                <ul>
                  <li>Test as a member or head of a family using the following emails & use 'password' as the login
                    credentials.
                  </li>
                  <li>email: member@family.com</li>
                  <li>email: head@family.com</li>
                </ul>
              </div>
              <a href="{{ route('user.dashboard') }}"
                 class="inline-flex items-center justify-center px-10 py-4 text-base font-normal text-center text-white rounded-lg lg:px-8 xl:px-10 bg-primary-500 hover:bg-secondary-500 focus:bg-secondary-500">
                Get Started
              </a>
              <a href="https://github.com/AtlasMountains/personal-finance-club"
                 target="_blank"
                 class="inline-flex items-center justify-center px-10 py-4 text-base font-normal text-center text-white rounded-lg lg:px-8 xl:px-10 bg-secondary-500 hover:bg-info-500 focus:bg-info-500">
                <x-icon name="code" class="w-4 h-4 mr-1"></x-icon>
                Github
              </a>
            </div>
          </div>

        </div>

      </div>
    </section>

  </div>
</x-layout.app>
