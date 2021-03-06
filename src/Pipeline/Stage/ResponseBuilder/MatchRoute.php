<?php
namespace Pipeline\Stage\ResponseBuilder;

use FastRoute\Dispatcher;
use League\Pipeline\StageInterface;

/**
 * Class MatchRoute
 *
 * @package Pipeline\Stage\ResponseBuilder
 */
class MatchRoute implements StageInterface
{
    /**
     * @var \FastRoute\Dispatcher
     */
    protected $dispatcher;

    /**
     * @param \FastRoute\Dispatcher $dispatcher
     */
    public function __construct(Dispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * Process the payload.
     *
     * @param \Pipeline\Payload\WebRequest $payload
     *
     * @return mixed
     */
    public function process($payload)
    {
        $payload->setRoute(
            $this->dispatcher->dispatch(
                $payload->getRequest()->getMethod(), $payload->getRequest()->getPathInfo()
            )
        );

        return $payload;
    }
}