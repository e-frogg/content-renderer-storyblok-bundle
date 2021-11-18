<?php

namespace Efrogg\Bundle\StoryblokBundle\Log;

use Psr\Log\LoggerInterface;
use Psr\Log\LoggerTrait;

class StoryblokLogger implements LoggerInterface
{
    use LoggerTrait;

    public function log($level, string|\Stringable $message, array $context = [])
    {
        // TODO : dataCollector + profiler bar....
        dump(sprintf('[%s] : %s',$level,$message));
        if(!empty($context)) {
            dump($context);
        }
    }
}
