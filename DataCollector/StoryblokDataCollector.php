<?php

namespace Efrogg\Bundle\StoryblokBundle\DataCollector;

use Efrogg\Bundle\StoryblokBundle\Log\StoryblokLogger;
use Symfony\Bundle\FrameworkBundle\DataCollector\AbstractDataCollector;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class StoryblokDataCollector extends AbstractDataCollector
{

    /** @var StoryblokLogger */
    private $storybloklogger;

    /**
     * @param StoryblokLogger $storybloklogger
     */
    public function __construct(StoryblokLogger $storybloklogger)
    {
        $this->storybloklogger = $storybloklogger;
    }


    public function collect(Request $request, Response $response, \Throwable $exception = null)
    {
        $this->data = [
            'logs' => $this->storybloklogger->getLogs()
        ];
    }

    public function getLogs()
    {
        return $this->data['logs'];
    }
}
