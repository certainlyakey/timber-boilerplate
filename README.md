Timber theme boilerplate
======================

Project architecture
---------------

The project is using [Timber](http://timber.github.io/timber/ "http://timber.github.io/timber/"), building theme markup in Twig. Each template has its logic in a usual Wordpress template (for example, `home.php`) with a Twig counterpart (usually of the same name) responsible for the actual markup, in `templates` folder. The main parent layout is located in `base.twig`. See the Timber documentation for more information.

CSS architecture of the project follows a set of rules to establish better maintainability, reusability, and organization of code. It borrows from several concepts including [BEM](https://bem.info "https://bem.info")/[7-1 pattern](https://sass-guidelin.es/#architecture "https://sass-guidelin.es/#architecture")/[ITCSS](https://speakerdeck.com/dafed/managing-css-projects-with-itcss "https://speakerdeck.com/dafed/managing-css-projects-with-itcss")/[Harry Roberts'namespaces](http://csswizardry.com/2015/03/more-transparent-ui-code-with-namespaces/#the-namespaces "http://csswizardry.com/2015/03/more-transparent-ui-code-with-namespaces/#the-namespaces").
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

Don't use extends unless they're provided by an external tool (such as `svg-sprite`). [Here's some explanation why this project avoids them](http://csswizardry.com/2016/02/mixins-better-for-performance/ "http://csswizardry.com/2016/02/mixins-better-for-performance/").


Installation
------------

The theme is dependent on ACF and Timber Library plugins. Make sure they're installed before activating the theme.
It can also make use of an `.env` file if it exists in the project. The path to the `.env` file is specified in `gulpfile.js`.

1. Replace all the instances of `themeprefix` in boilerplate `*.php` files with any prefix wanted;

2. replace all the instances of `theme_domain` in boilerplate `*.php` and `*.twig` files with your theme's localisation domain;

3. go to the `timber-theme` theme folder, run `npm install`;

4. run `gulp` to compile theme, `gulp watch` to compile and watch for changes;

5. (Optionally) put `ENV=dev` in `.env` file if it exists; this will generate files more adapted for local FE work. On staging/production it may contain anything except for `dev`.


Development notes
-----------------

- If you create a native Wordpress custom page template — put the Twig file into the `templates/custom-templates` folder. It is a good idea to keep PHP files for custom page templates prefixed uniformly (for example with `template-` prefix).

- The theme Javascript is separated into modules. Each module is merged into the main `scripts.min.js` file which is served on frontend upon gulp compilation. Each time you need to introduce a new script that is not related to others, you will want to create a new module.

    1. duplicate any existing module in the `js/modules` folder (or the provided `example-module.js` file)

    2. rename it appropriately

    3. open `js/main.js` file and make these changes inside the `jQuery(function($){` block:

        1. add a line `var example_module = require('./modules/example-module');` replacing `example_module` with a name of the module;

        2. add a line `example_module.init();` again replacing `example_module` with the name of the module.

- Theme functions are organized into several includes, if adding something try to find an appropriate include for that or create a new one. Each file's purpose is described in its comment section.


Ideas for future development
----------------------------

1. add a stylelint check for raw pixel values excluding `rem-calc`-like functions with `certainlyakey/stylelint-no-px`
2. add a stylelint check for browser incompatibilities with `certainlyakey/stylelint-no-px`
3. add a stylelint check for incorrect imports with `certainlyakey/stylelint-at-rule-import-path`
