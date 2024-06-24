<?php

namespace App\Controller;

use App\Service\OMDBApi;
use App\Service\TMDBApi;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[\Symfony\Component\Routing\Attribute\Route(
    '/',
    name: 'home')
]
class HomeController extends AbstractController
{
    #[Route(
        'home',
        name: '_first'  # Cette route ne sert que pour l'exemple, elle disparaitra par la suite
    )]
    public function home(): Response
    {
        // Message de bienvenue déclarée en variable dans le contrôleur
        $welcomeMessage = 'Bienvenue sur le site de recherche de films !';

        // Rendu du template
        // On passe la variable $welcomeMessage au template
        return $this->render('home/home.html.twig',
            [
                'welcomeMessage' => $welcomeMessage
            ]
        );
    }

    #[Route(
        '',
        name: '_real'   # Cette route est celle qui sera utilisée pour la page d'accueil
    )]
    public function index(): Response
    {
        // Message de bienvenue déclarée en variable dans le contrôleur
        $welcomeMessage = 'Bienvenue sur le site de recherche de films !';

        // Rendu du template
        // On passe la variable $welcomeMessage au template
        return $this->render('home/index.html.twig',
            [
                'welcomeMessage' => $welcomeMessage
            ]
        );
    }
}
