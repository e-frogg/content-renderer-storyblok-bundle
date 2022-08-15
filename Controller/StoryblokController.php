<?php

namespace Efrogg\Bundle\StoryblokBundle\Controller;

use Efrogg\ContentRenderer\CmsRenderer;
use Efrogg\ContentRenderer\Exception\NodeNotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class StoryblokController extends AbstractController
{

    protected CmsRenderer $cmsRenderer;
    protected string $pagePath;
    protected string $defaultHomePath = 'home';

    public function __construct(CmsRenderer $cmsRenderer, string $pagePath = '')
    {
        $this->cmsRenderer = $cmsRenderer;
        $this->pagePath = $pagePath;
    }


    /**
     * @Route("/_preview/{path}", requirements={"path"=".+"},priority=-5)
     * @param Request $request
     * @param string  $path
     *
     * @return Response
     */
    public function renderPreview(Request $request, string $path): Response
    {
        $response = new Response($this->cmsRenderer->renderNodeById($path));

        $response->headers->add([
            'Content-Security-Policy' => 'frame-ancestors app.storyblok.com;',
        ]);
        return $response;
    }

    /**
     * low priority to get after all other routes
     * @Route("/{path}", requirements={"path"=".*"},priority=-5)
     *
     * @param Request $request
     * @param string  $path
     *
     * @return Response
     */
    public function renderPage(Request $request, string $path): Response
    {
        if (empty($path)) {
            $path = $this->defaultHomePath;
        }
        try {
            $node = $this->cmsRenderer->getNodeProvider()->getNodeById($this->pagePath . $path);
            return new Response($this->cmsRenderer->render($node));
        } catch (NodeNotFoundException $e) {
            throw new NotFoundHttpException($e->getMessage(), $e);
        }
    }
}
