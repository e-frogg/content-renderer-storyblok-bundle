<?php

namespace Efrogg\Bundle\StoryblokBundle\Routing;

use Efrogg\Bundle\StoryblokBundle\Controller\StoryblokController;
use Symfony\Bundle\FrameworkBundle\Routing\RouteLoaderInterface;
use Symfony\Component\Config\Loader\Loader;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

/**
 * @deprecated
 */
class RouteLoader extends Loader implements RouteLoaderInterface
{
    private $isLoaded = false;

    private $pageDirectory='';
    private $baseRoute='';

    public function load($resource, string $type = null)
    {
        if (true === $this->isLoaded) {
            throw new \RuntimeException('Do not add the "extra" loader twice');
        }

        $routes = new RouteCollection();

        // prepare a new route
        $path = '/'.$this->baseRoute.'{path}';
        $defaults = [
            '_controller' => StoryblokController::class.'::renderPage',
        ];
        $requirements = [
            'path' => '.+',
        ];
        $route = new Route($path, $defaults, $requirements);

        // add the new route to the route collection
        $routeName = 'storyblokRoute';
        $routes->add($routeName, $route);

        $this->isLoaded = true;

        return $routes;
    }

    public function supports($resource, string $type = null)
    {
        return 'extra' === $type;
    }

    /**
     * @param string $baseRoute
     */
    public function setBaseRoute(string $baseRoute): void
    {
        $this->baseRoute = $baseRoute;
    }

    /**
     * @param string $pageDirectory
     */
    public function setPageDirectory(string $pageDirectory): void
    {
        $this->pageDirectory = $pageDirectory;
    }
}
