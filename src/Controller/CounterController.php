<?php

namespace App\Controller;

use App\Counter;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

final class CounterController
{
    private Environment $twig;
    private Counter $counter;

    public function __construct(Environment $twig, Counter $counter)
    {
        $this->twig = $twig;
        $this->counter = $counter;
    }

    public function __invoke(): Response
    {
        return new Response($this->twig->render('counter.html.twig', ['counter' => $this->counter->getCounter()]));
    }
}
