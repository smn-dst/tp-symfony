<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{

    #[Route('/', name: 'app_home')]
    public function home(): Response
    {
        return $this->render('home/index.html.twig');
    }

    #[Route('/about', name: 'app_about')]
    public function about(): Response
    {
        return $this->render('home/about.html.twig');
    }

    #[Route('/hello/{name}', name: 'app_hello')]
    public function hello(string $name): Response
    {
        return $this->render('home/hello.html.twig', ['name' => $name]);
    }

    #[Route('/random', name: 'app_random', defaults: ['quote' => null])]
    public function random(): Response
    {
        $quotes = [
            'Le code est poésie.',
            'Symfony simplifie la complexité.',
            'Toujours tester, jamais supposer.',
            'Refactoriser, c\'est aimé son futur soi.'
        ];

        // retourne une phrase aléatoire du tableau (car c'est un array)
        // $quote = $quotes[array_rand($quotes)];
        $quote = $this->json(['quote'=>$quotes]);

        return $this->render('home/random.html.twig', ['quote' => $quote]);
    }

    #[Route('/redirect', name:'app_redirect')]
    public function redirectToRandom(): Response 
    {
        return $this->redirectToRoute("app_random");
    }
}
