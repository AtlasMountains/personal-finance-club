# My first laravel project

In my first project I have made simple website from scratch.
before I started I did some research by looking at starter-kits
like [Laravel Breeze](https://laravel.com/docs/9.x/starter-kits#laravel-breeze) & plugins
like [filament](https://filamentphp.com/).
But decided to **start without plugins**, in order to get a good foundation first.

### summary (more details below):

At the start of this project, I learned [Tailwindcss](https://tailwindcss.com/) for the styling since a lot of the
starter-kits and plugins use it. which I plan to use in following projects.
Along the way I added [AlpineJS](https://alpinejs.dev/) for functionality with a dark mode and dropdown in mobile.

After the general layout, navigation & a few pages (responsive and with a dark mode), I made an authentication system
with email verification. Expanded on that with rate limiting (emails sent per user, login & registration attempts by ip
address) and job queuing for increased performance, user experience and security.

## What I used

- [Laravel](https://laravel.com/)
- [Tailwindcss](https://tailwindcss.com/)
- [AlpineJS](https://alpinejs.dev/)
- [vscode](https://code.visualstudio.com/)
- [phpstorm](https://www.jetbrains.com/phpstorm/)
- [github](https://github.com/AtlasMountains)
- [mailtrap](https://mailtrap.io/)

## What I knew before

Before this project I already knew

1. [x] HTML, CSS, Sass, bootstrap,
2. [x] Javascript, PHP, MVC structure, twig templating
3. [x] Agile SCRUM, Git, Git flow & [github](https://github.com/AtlasMountains).

Find out more at [My Portfolio](https://github.com/AtlasMountains).

## What I learned

### I started with the general layout, navigation & a few pages

In the beginning there was nothing, so something had to be made. And that something was the general layout and
navigation as well as some pages.
At the start I learned about routing (naming, grouping) and with routing comes views and there is a lot to cover with
views.

- blade templating
- work modular with @section @yield @include
- after the basics I learned how to work with custom components using <x-component> syntax
- style it using [Tailwindcss](https://tailwindcss.com/) some features like:
  - dark mode
  - mobile responsive
  - tailwindcss.config to change default behaviors or add custom colors, include plugins etc
  - tailwind components to group some classes together

- [AlpineJS](https://alpinejs.dev/) for dropdown & remembering dark mode in LocalStorage

### Second I made an authentication system.

After having played with the starter kit breeze, I wanted to build it from the beginning to learn how it all worked.
It was great to learn the basics of laravel and the system could always be expanded with more complex features.
After lots of work on the routing and views it was time to learn controllers, form requests, custom middleware, rate
limiting & job queuing.

I build an authentication system where you can register, login, verify email address, tested locally
using [mailtrap](https://mailtrap.io/)

- view
  - login & registration page with server validation
  - showing validation errors in forms with @error
  - displaying custom error pages like 404
  - display session messages
- routing
  - used standard middleware like (auth, verified, guest)

#### the first expansion to the authentication system

After I had the basic authentication system with email verification, I wanted to limit the amount of emails sent to
protect against spammers. And while we're at it, I also limited the amount of login and registration attempts per ip
address to increase security.

- rate limiting
  - Limit the amount of verification emails
  - Limit login and registration attempts per ip address
  - show info about the remaining emails & attempts and wait time before you can send more
- middleware
  - made my own middleware to redirect if the user is already verified

#### the second expansion to the authentication system

To increase the performance of the site, and user experience I implemented queuing and made email sending a job.

## Where to go from here
