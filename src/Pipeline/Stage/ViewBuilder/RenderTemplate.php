<?php
namespace Pipeline\Stage\ViewBuilder;

use League\Pipeline\StageInterface;
use League\Plates\Engine;

/**
 * Class RenderTemplate
 *
 * @package Pipeline\Stage\ViewBuilder
 */
class RenderTemplate implements StageInterface
{
    /**
     * @var \League\Plates\Engine
     */
    protected $templates;

    /**
     * @param \League\Plates\Engine $templates
     */
    public function __construct(Engine $templates)
    {
        $this->templates = $templates;
    }

    /**
     * Process the payload.
     *
     * @param \Pipeline\Payload\Resource $payload
     *
     * @return mixed
     */
    public function process($payload)
    {
        $template      = $payload->getMeta('template');
        $templatedData = [
            'meta'    => $payload->getMeta(),
            'content' => $payload->getContent(),
        ];

        $payload->setOutput($this->templates->render($template, $templatedData));

        return $payload;
    }
}