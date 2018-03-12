# Timber theme boilerplate

## Theme highlights

- [Timber](https://timber.github.io/docs/) (Twig) based templates. Put logic in usual wordpress PHP templates, relate it to a Twig template by assigning to the `$context[]` variable, add corresponding templates in `<themename>/templates` folder;
- BEM methodology for markup/CSS. The project frontend consists of self-contained components. BEM naming convention is `component__element_modifier`. Avoid all the things that you would avoid in a typical BEM-like project. See below for more information;
- namespaces for CSS classes aka prefixes. Read below on what prefixes can be used, and see here [why namespacing is cool](https://csswizardry.com/2015/08/bemit-taking-the-bem-naming-convention-a-step-further/);
- stylelint linting. Comments starting from words "todo"/"hack" appear as warnings to bring attention to them;
- `dotenv` for doing different things depending on local/stg/prod environment;
- shared variables inside the theme (a variable added to `common_config.json` can be reused in JS/Gulp/SASS/PHP/Twig);
- npm packages for theme usage;
- ES2015-enabled modular JS. See below on how to use it;
- SVG spriting. Put new SVG files to be found in the sprite to `<themename>/img/svg-sprite-source` folder, invoke them with the `image-svg-sprite.twig` partial;
- Automated Modernizr build based on actually used features only;
- custom fields registered in code for faster deployment to other environments. 

The theme is best employed with VVV Wordpress project boilerplate but is perfectly fine when used standalone.

## CSS architecture

CSS architecture of the project follows a set of rules to establish better maintainability, reusability, and organization of code. It borrows from several concepts including [BEM](https://bem.info)/[7-1 pattern](https://sass-guidelin.es/#architecture)/[ITCSS](https://speakerdeck.com/dafed/managing-css-projects-with-itcss)/[Harry Roberts'namespaces](http://csswizardry.com/2015/03/more-transparent-ui-code-with-namespaces/#the-namespaces).
Every class or mixin should be prefixed. Here's the types of classes/mixins that are used throughout the project:

1. Components (prefixed with `c-`) are potentially reusable mixins that represent independent, fully styled blocks within a page. Where to place: `components/_component-name.scss`.
    1. The concept of components is fully compatible with the BEM methodology. They may contain `__elements` and `_modifiers`. Components may itself have a modifier, but a component cannot have a subcomponent — only 1 level of nesting elements inside a component is allowed;
    2. They are applied to the class of the same name in `_main.scss` but also can be applied to other classes as well, without having to add the original class in the markup explicitly and allowing for easy extension (any component can be extended with another component — without drawbacks of `@extend`s). That's why the first argument in the component mixin should always be `$base_class` and its inner elements definitions should start with `#{$base_class}`. See the example component in the `components` folder;
2. Objects (prefixed `o-`) are structure-related mixins. They usually are not used alone and never applied directly as classes. Where to place: `abstracts/_mixins.scss` for smaller ones or `abstracts/objects/_object-name.scss`;
3. Theming mixins (`t-`) — almost same as objects, but these are only related to appearance. Usually are not used alone as well. Where to place: `abstracts/_mixins.scss`;
4. Utilities are “does one thing”-style mixins. Prefix: `u-`. Where to place: `abstracts/_mixins.scss`;
5. Scoped mixins (`s-`) - define a separate styling context inside which tag selectors may be used (usually we can only use classes). Only for styling user edited rich content areas (articles body etc.). Where to place: `abstracts/_mixins.scss`;
6. `p-` — specific page related styling, dependent on Wordpress body classes. Use ONLY if it doesn't make sense to apply any of the existing components or create a new component. Where to place: `pages/_page-name.scss`.

The project also makes use of context dependent prefixes such as `js-`, `has-` and others.

When styling a new piece of markup, it's important to see if there's already a component mixin that fits its design, and if there's, would it be more appropriate to add some new elements to that mixin and then apply it or to create a new component that includes it and add up the difference in styling to the latter.

When styling a group of repeated items (such as a section of teasers) it's preferable to separate the group's own styling and item's inner styling into two different components. This way we can always reapply the item's styling independently somewhere else.

Don't use extends unless they're provided by an external tool (such as `svg-sprite`). [Here's some explanation why this project avoids them](http://csswizardry.com/2016/02/mixins-better-for-performance/).

## Installation

The theme is dependent on ACF and Timber Library plugins. Make sure they're installed and activated before activating the theme.
The theme can also make use of an `.env` file if it exists in the project. The path to the `.env` file is specified in `gulpfile.js`.

1. Replace all the instances of `themeprefix` in boilerplate `*.php` files with any prefix wanted;
2. replace all the instances of `theme_domain` in boilerplate `*.php`, `*.twig`, `style.scss`, `loco.xml` files with your theme's localisation domain;
3. go to the `timber-theme` theme folder, run `npm install`;
4. run `gulp` to compile theme, `gulp watch` to compile and watch for changes.

You may wish to add `style.css` in the root after first `gulp` execution to the theme's `.gitignore` file (though it's not mandatory).

## Development notes

- If you create a native Wordpress custom page template — put the Twig file into the `templates/custom-templates` folder. It is a good idea to keep PHP files for custom page templates prefixed uniformly (for example with `template-` prefix).
- The theme Javascript is separated into modules. Each module is merged into the main `scripts.min.js` file which is served on frontend upon gulp compilation. Each time you need to introduce a new script that is not related to others, you will want to create a new module.
    1. duplicate any existing module in the `js/modules` folder (or the provided `example-module.js` file);
    2. rename it appropriately;
    3. open `js/main.js` file and make these changes inside the `jQuery(function($){` block:
        1. add a line `var example_module = require('./modules/example-module');` replacing `example_module` with a name of the module;
        2. add a line `example_module.init();` again replacing `example_module` with the name of the module.
- Theme functions are organized into several includes, if adding something try to find an appropriate include for that or create a new one. Each file's purpose is described in its comment section.
- When registering new custom fields you can follow the naming convention of `{posttypename}_{fieldname}` for post custom fields and post-type-wide fields (stored in the `option` table) and `{taxname}_{fieldname}` for term meta fields. This will allow you to use the fields in various smart ways.
- You can use Loco Translate plugin for translation of the English theme strings into another languages (no setup needed, just install it on your local). The plugin will automatically discover all the English strings of the theme and will let you translate them right in the admin. After doing some translations make a commit. The translation file `<theme-path>/languages/<lang-slug>.po` is compiled into the `.mo` file when you save your translation in Loco Translate admin interface and also by a `gulp watch` task.
- You may put `ENV=dev` in `.env` file if it exists; this will generate files more adapted for local FE work (CSS source maps, non minified CSS/JS, pixels instead of rems). On staging/production it may contain anything except for `dev`.
- You can use a `@z-index space: XX-XX` comment in the beginning of a SCSS file of an object or component to indicate the range of `z-index` values to be used here to other developers. This helps to prevent clashes between different components. Obviously, other components should have `z-index` values assigned in another range. For example, a component `c-a` will have `@z-index space: 20-30` comment while a component `c-b` will have `@z-index space: 30-40`.

## Ideas for future development

1. add a stylelint check for raw pixel values excluding `rem-calc`-like functions with `certainlyakey/stylelint-no-px`
2. add a stylelint check for browser incompatibilities with `certainlyakey/stylelint-no-px`
3. add a stylelint check for incorrect imports with `certainlyakey/stylelint-at-rule-import-path`
