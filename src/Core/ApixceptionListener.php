<?php
namespace Pccomponentes\Apixception\Core;

use Pccomponentes\Apixception\Core\Handlers\ApixceptionHandler;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ApixceptionListener implements EventSubscriberInterface
{
    private $handlers;

    public function __construct(ApixceptionListener ...$handlers)
    {
        $this->handlers = $handlers;
    }

    public static function getSubscribedEvents(): array
    {
        return [KernelEvents::EXCEPTION => ['onKernelException']];
    }

    public function onKernelException(GetResponseForExceptionEvent $event): void
    {
        $exception = $event->getException();

        $response = null;

        foreach ($this->handlers as $handler) {
            if ($handler->match($exception)) {
                $event->setResponse(
                    $handler->execute($exception)
                );
                return;
            }
        }
    }

}