<?php

namespace Efrogg\Bundle\StoryblokBundle\Controller;

use Efrogg\ContentRenderer\CmsRenderer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class StoryblokController extends AbstractController
{

    /**
     * @var CmsRenderer
     */
    protected $cmsRenderer;
    /**
     * @var string
     */
    protected $pagePath;

    public function __construct(CmsRenderer $cmsRenderer, string $pagePath = '')
    {
        $this->cmsRenderer = $cmsRenderer;
        $this->pagePath = $pagePath;
    }



    /**
     * @param Request $request
     * @param string  $path
     *
     * @return Response
     */
    #[Route('/_preview/{path}', requirements: ['path' => '.+'])]
    public function renderPreview(Request $request, string $path): Response
    {
        $response = $this->render('cmsBase.html.twig', [
            'pageContent' => $this->cmsRenderer->renderNodeById($path)
        ]);

        $response->headers->add([
            'Content-Security-Policy' => 'frame-ancestors app.storyblok.com;',
        ]);
        return $response;
    }

    /**
     * @param Request $request
     * @param string  $path
     *
     * @return Response
     */
    #[Route('/{path}', requirements: ['path' => '.+'])]
    public function renderPage(Request $request, string $path): Response
    {
        return $this->render('cmsBase.html.twig', [
            'pageContent' => $this->cmsRenderer->renderNodeById($this->pagePath . $path)
        ]);
    }
}
