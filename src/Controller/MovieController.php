<?php

namespace App\Controller;

use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
* @Route("/movie", name="Movie")
*/
class MovieController extends AbstractController
{
    /**
     * @Route("s", name="_List")
     */
    public function list(MovieRepository $movieRepository): Response
    {
        // Récupération de TOUS les films
        $movies = $movieRepository->findAll();

        return $this->render(
            'movie/list.html.twig', 
            [
                'movies' => $movies,
            ]
        );
    }
}
