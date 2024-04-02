<?php

namespace App\Controller;

use App\Service\OMDBApi;
use App\Service\TMDBApi;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route(
     *     "/",
     *     name="app_home"
     * )
     *
     * @return Response
     */
    #[Route(
        '/',
        name: 'app_home'
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
