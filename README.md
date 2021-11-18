# story blok bundle
## install
    composer require efrogg/content-renderer-storyblok-bundle

or composer.json

    "efrogg/content-renderer-storyblok-bundle": "^0.1"

## add routes
create `config/routes.yaml` file and add following content :

    # config/routes.yaml
    storyblok:
        # loads routes from the given routing file stored in some bundle
        resource: '@StoryblokBundle/Resources/config/routes.yaml'

