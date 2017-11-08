Timber theme boilerplate
======================

BE/content architecture
-----------------------

The project repository contains a `wp-content` folder. A set of restrictive `.gitignore` rules (cloned [from here](https://gist.githubusercontent.com/salcode/b515f520d3f8207ecd04 "https://gist.githubusercontent.com/salcode/b515f520d3f8207ecd04")) tries to ignore everything in it except for a specific theme (`timber-theme`) and custom plugins (none so far, but if they appear they need to make its way into the `.gitignore`, otherwise they will be ignored).

The project may be developed locally with VVV (see below).

Wordpress is meant to be as clean as possible. All the plugins are handled by composer.

Frontend-wise the project is using [Timber](http://timber.github.io/timber/ "http://timber.github.io/timber/"), building the theme markup in Twig. Each template is having its logic in a usual Wordpress template (for example, `home.php`) with a Twig counterpart (usually of the same name) responsible for the actual markup, in `templates` folder. The main parent layout is located in `base.twig`. See the Timber documentation for more information.

FE architecture
---------------

CSS architecture of the project follows a set of rules to establish better maintainability, reusability, and organization of code. It borrows from several concepts including [BEM](https://bem.info "https://bem.info")/[7-1 pattern](https://sass-guidelin.es/#architecture "https://sass-guidelin.es/#architecture")/[ITCSS](https://speakerdeck.com/dafed/managing-css-projects-with-itcss "https://speakerdeck.com/dafed/managing-css-projects-with-itcss")/[Harry Roberts'namespaces](http://csswizardry.com/2015/03/more-transparent-ui-code-with-namespaces/#the-namespaces "http://csswizardry.com/2015/03/more-transparent-ui-code-with-namespaces/#the-namespaces").
Every class or mixin should be prefixed. Here's the types of
classes/mixins that are used throughout the project:

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

The local installation is meant to be done with VVV2, Wordpress-tailored Vagrant configuration. But as there're no hard dependencies except for `gulp`, it can also be installed in any other manner.

1. install [Varying Vagrant Vagrants, or VVV](https://github.com/Varying-Vagrant-Vagrants/VVV "https://github.com/Varying-Vagrant-Vagrants/VVV") (1.40 is ok) with all the required prerequisites

    1. (optionally) install [VV](https://github.com/bradp/vv "https://github.com/bradp/vv") and do `create vv` in VVV folder

    2. (optionally) in case you used VV, did `create vv` and a Wordpress installation hasn’t been downloaded automatically - `vagrant ssh` into the VVV virtual machine, go to folder with created local domain name (`/www/<localdomain>`), do `chmod +x vvv-init.sh`, then `./vvv-init.sh`

2. link the git repo with VVV:

    1. (Preferred way) if you used VV and want to reuse the VVV virtual machine we just installed to develop Wordpress sites from other projects — remove the contents of the `wp-content` folder in `<vvv-root>/www/<vv-sitename>`. Then add to `Customfile` in &lt;vvv-root&gt;:
        ```
        config.vm.synced_folder "<git-repo-on-local-disk>/wp-content/", "/srv/www/<vv-sitename>/htdocs/wp-content/", :owner => "www-data", :mount_options => [ "dmode=775", "fmode=774" ]
        ```
        . Then do a `vagrant reload`

    2. if you haven’t used VV — remove `wp-content` folder from the `wordpress-default` and rename `wordpress-default` to any name, `cd` to `<vvv-root>/www/`, clone the project repo there, rename the repo folder to `wordpress-default` and move all the files from the older, renamed folder to the repo directory

    3. If you did use VV, but want to develop the project inside the VVV folder — remove `wp-content` folder from the `<vvv-root>/www/<vv-sitename>/htdocs` and rename `htdocs` to any name, `cd` to `<vvv-root>/www/<vv-sitename>/`, clone the project repo there, rename the repo folder to `htdocs` and move all the files from the older, renamed folder to the repo directory

3. run `composer install` in the repo root to install the needed wordpress plugins

4. go to the `timber-theme` theme folder, run `npm install`

5. Create an `.env` file in the project root, and put `ENV=dev` there; this will generate files more adapted for local FE work. On staging/production it may contain anything except for `dev`.

6. run `gulp watch` to compile the themes


Build automation
----------------

Staging has a GIT hook that checks changed files on `git pull` and runs `composer update`, `npm install` & `gulp` as required. As there is no pull hook, the build tools are run on post-merge (`git pull` == `git fetch && git merge`). The hook file is in `<repo-root>/git-hooks/` and should be copied to `.git/hooks/` manually in order for the hook to work.

Development notes
-----------------

- If you create a native Wordpress custom page template — put the Twig file into the `templates/custom-templates` folder.

- The theme Javascript is separated into modules by each feature. Each module is merged into the main `scripts.min.js` file which is served on frontend upon gulp compilation. If you want to create a new feature —

    1. duplicate any existing module in the `js/modules` folder

    2. rename it appropriately

    3. open `js/main.js` file and make these changes inside the `jQuery(function($){` block:

        1. add a line `var searchform = require('./modules/searchform');` replacing `searchform` with the name of the module;

        2. add a line `searchform.init();` again replacing `searchform` with the name of the module.

- Always localize theme strings with `__` or `_e` using a theme specific localization domain.

- Theme functions are organized into several includes, if adding something try to find an appropriate include for that. Each file's purpose is described in its comment section.

- Functions should be prefixed with a theme specific prefix.


Ideas for future Development
----------------------------

1. stylelint check for raw pixel values excluding `rem-calc`-like functions with `certainlyakey/stylelint-no-px`
2. stylelint check for browser incompatibilities with `certainlyakey/stylelint-no-px`
3. stylelint check for incorrect imports with `certainlyakey/stylelint-at-rule-import-path`
