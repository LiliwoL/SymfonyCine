<?php

namespace App\Controller;

use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(
 *      "/movie",
 *      name="Movie_"
 * )
 */
class MovieController extends AbstractController
{
    /**
     * Affichage de la liste des films
     * 
     * > Injection de la dépendance MovieRepository
     * 
     * @Route(
     *      "s",
     *      name="List"
     * )
     */
    public function list(MovieRepository $movieRepository): Response
    {
        // Récupération de la liste des films grâce au MovieRepository
        $movies = $movieRepository->findAll();

        // Rendu d'une vue affichant la liste des films
        return $this->render(
            'movie/list.html.twig', 
            [
                'movies' => $movies
            ]
        );
    }
}
