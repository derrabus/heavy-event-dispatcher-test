<?php

use App\Controller\CounterController;
use App\Counter;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\KernelEvents;

return static function (ContainerConfigurator $configurator): void {
    $services = $configurator->services();

    $services->set(CounterController::class)
        ->autowire()
        ->public()
    ;

    $counter = $services->set(Counter::class);

    for ($i = 0; $i < 1000; ++$i) {
        $counter->tag('kernel.event_listener', ['event' => KernelEvents::REQUEST, 'method' => 'increment', 'priority' => (int) (sin($i) * 100)]);
    }
};
