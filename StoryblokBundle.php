<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Efrogg\Bundle\StoryblokBundle;

use Efrogg\Bundle\StoryblokBundle\DependencyInjection\StoryblokExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * @author Jordi Boggiano <j.boggiano@seld.be>
 */
class StoryblokBundle extends Bundle
{

//    public function build(ContainerBuilder $container)
//    {
//        parent::build($container);
//        $container->addCompilerPass($channelPass = new LoggerChannelPass());
//    }

    public function getContainerExtension()
    {
        return new StoryblokExtension();
    }

}
