<?php

namespace Efrogg\Bundle\StoryblokBundle\Log;

use Efrogg\Bundle\StoryblokBundle\Log\LogEntry;
use Psr\Log\LoggerInterface;
use Psr\Log\LoggerTrait;

class StoryblokLogger implements LoggerInterface
{
    use LoggerTrait;

    /**
     * @var array
     */
    private $logs=[];

    public function log($level, $message, array $context = array())
    {
        $this->logs[]=new LogEntry($level,$message,$context);
    }

    /**
     * @return array
     */
    public function getLogs(): array
    {
        return $this->logs;
    }
}
