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
     * @param OMDBApi $OMDBApiService
     * @param TMDBApi $TheMovieDBApiService
     * @return Response
     */
    #[Route(
        '/',
        name: 'app_home'
    )]
    public function index( OMDBApi $OMDBApiService, TMDBApi $TMDBApiService): Response
    {
        // Appel du service OMDB avec le terme de recherche "running"
        $J_movieList = $OMDBApiService->search( "running" );

        // Appel du service TMDB avec le terme de recherche "running"
        $J_movieList2 = $TMDBApiService->search( "running" );

        // Rendu du template
        return $this->render('home/index.html.twig',
            [
                'omdb_list' => $J_movieList,
                'tmdb_list' => $J_movieList2
            ]
        );
    }
}
