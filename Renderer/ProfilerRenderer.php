<?php

declare(strict_types=1);

namespace Efrogg\Bundle\StoryblokBundle\Renderer;

use Efrogg\ContentRenderer\CmsRendererInterface;
use Efrogg\ContentRenderer\Node;
use Shopware\Core\Profiling\Profiler;

class ProfilerRenderer implements CmsRendererInterface
{
    public function __construct(
        private readonly CmsRendererInterface $decorated,
    ) {
    }


    public function renderNodeById(string $nodeId, string $subNode = null): string
    {
        return $this->decorated->renderNodeById($nodeId, $subNode);
    }

    public function render(Node $node): string
    {
        return Profiler::trace('storyblok-render-'.$node->getType(), fn () => $this->decorated->render($node));
    }

    public function isUseCache(): bool
    {
        return $this->decorated->isUseCache();
    }

    public function setUseCache(bool $useCache): void
    {
        $this->decorated->setUseCache($useCache);
    }

    public function isUpdateCache(): bool
    {
        return $this->decorated->isUpdateCache();
    }

    public function setUpdateCache(bool $updateCache, bool $isTemporaryChange = false): void
    {
        $this->decorated->setUpdateCache($updateCache, $isTemporaryChange);
    }

    public function restoreUpdateCache(): void
    {
        $this->decorated->restoreUpdateCache();
    }

    public function convertAndRender($data): ?string
    {
        return $this->decorated->convertAndRender($data);
    }

    public function convertAndRenderMultiple($data): ?string
    {
        return $this->decorated->convertAndRenderMultiple($data);
    }
}
