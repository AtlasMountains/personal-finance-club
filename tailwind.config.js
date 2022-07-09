module.exports = {
  presets: [require("./vendor/wireui/wireui/tailwind.config.js")],

  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./app/Http/Livewire/**/*Table.php",
    "./vendor/power-components/livewire-powergrid/resources/views/**/*.php",
    "./vendor/power-components/livewire-powergrid/src/Themes/Tailwind.php",
    "./vendor/wireui/wireui/resources/**/*.blade.php",
    "./vendor/wireui/wireui/ts/**/*.ts",
    "./vendor/wireui/wireui/src/View/**/*.php",
  ],

  theme: {
    extend: {},
  },

  corePlugins: {
    aspectRatio: false,
  },

  plugins: [
    // require("./plugin"),
    require("@tailwindcss/typography"),
    require("@tailwindcss/aspect-ratio"),
    require("@tailwindcss/forms")({
      strategy: "class",
    }),
  ],

  darkMode: "class",
};
