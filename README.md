# my first laravel project

In my first project I have made simple website.
I started from scratch,
looked at starter-kits like [Laravel Breeze](https://laravel.com/docs/9.x/starter-kits#laravel-breeze) & plugins
like [filament](https://filamentphp.com/).
But decided to start without them, in order to get a good foundation first.
At the start of this project, I learned Tailwindcss for the styling since a lot of the starter-kits and plugins use it.
Along the way I added [AlpineJS](https://alpinejs.dev/) for functionality with a dark mode and dropdown in mobile.

## What I used

- Laravel
- Tailwindcss
- [AlpineJS](https://alpinejs.dev/)

## What I knew before

Before this project I already knew HTML, CSS, Sass, bootstrap, Javascript, PHP, MVC structure, twig templating & Agile
SCRUM.
Find out more take a look at [My Portfolio]().

## What I learned
### I started with the general layout, navigation & a few pages

In the beginning there was nothing, so something had to be made. And that something was the general layout and navigation as well as some pages.
at the start I learned about routing (naming, grouping) and with routing comes views and there is a lot to cover with views.

- blade templating
- work modular with @section @yield @include
- after the basics I learned how to work with custom components using <x-component> syntax
- style it using tailwindcss some features like:
  - dark mode
  - mobile responsive
  - tailwindcss.config to change default behaviors or add custom colors etc
  - tailwind components to group some classes together

- [AlpineJS](https://alpinejs.dev/) for dropdown & remember dark mode in LocalStorage

### Second I made an authentication system.

After having played with the starter kit breeze, I wanted to build it from the beginning to learn how it all worked. 
It was great to learn the basics of laravel and the system could always be expanded with more complex features.

After lots of work on the routing and views it was time to learn controllers & form requests.
I build an authentication system where you can register, login, verify email address, tested using [mailtrap](https://mailtrap.io/) 
- view
  - showing validation errors in forms with @error
  - displaying custom error pages like 404
- routing
  - middleware like (auth, verified, guest)
  - route model binding (inc slugs for SEO)


## Where to go from here
