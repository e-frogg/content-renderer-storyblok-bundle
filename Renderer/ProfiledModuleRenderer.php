<?php

declare(strict_types=1);

namespace Efrogg\Bundle\StoryblokBundle\Renderer;

use Efrogg\ContentRenderer\Module\ModuleInterface;
use Efrogg\ContentRenderer\ModuleRenderer\ModuleRendererInterface;
use Efrogg\ContentRenderer\Node;
use Shopware\Core\Profiling\Profiler;
use Symfony\Component\HttpFoundation\ParameterBag;

class ProfiledModuleRenderer implements ModuleRendererInterface
{

    public function __construct(
        private readonly ModuleRendererInterface $decorated
    ) {
    }

    public function render(ModuleInterface $module, Node $node): string
    {
        return Profiler::trace(
            'storyblok-module-' . $node->getType(),
            fn() => $this->decorated->render($module, $node)
        );
    }

    public function addParameter($key, $value): void
    {
        $this->decorated->addParameter($key, $value);
    }

    public function addParameters(array $keys): void
    {
        $this->decorated->addParameters($keys);
    }

    public function getParameters(): ?ParameterBag
    {
        return $this->decorated->getParameters();
    }

    public function setParameters(?ParameterBag $parameters): void
    {
        $this->decorated->setParameters($parameters);
    }

    public function canResolve($solvable, string $resolverName): bool
    {
        return $this->decorated->canResolve($solvable, $resolverName);
    }

    public function getPriority(): int
    {
        return $this->decorated->getPriority();
    }
}
