<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Form\MovieType;
use App\Repository\RatingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\TMDBApi;
use App\Entity\Rating;
use App\Form\RatingType;

#[Route(
    '/movie',
    name: 'movie')
]
class MovieController extends AbstractController
{
    /**
     * Affiche la liste de tous les films
     *
     * @param TMDBApi $TMDBApiService
     * @return Response
     */
    #[Route('s', name: '_list')]
    public function index(TMDBApi $TMDBApiService): Response
    {
        // Appel du service TMDB pour récupérer une liste de films
        $T_movies = $TMDBApiService->discover();
        $urlImageMoviePrefix = $_ENV['TMDB_URL_IMAGE_PREFIX'];

        return $this->render('movie/index.html.twig', [
            'movies' => $T_movies,
            'urlImageMoviePrefix' => $urlImageMoviePrefix
        ]);
    }


    /**
     * Affiche les détails d'un film à partir de l'id passé en paramètre
     *
     * @param int $id
     * @param TMDBApi $TMDBApiService
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param RatingRepository $ratingRepository
     * @param LoggerInterface $logger
     * @return Response
     */
    #[Route(
        '/{id}',
        name: '_show'
    )]
    public function show(
        int $id,                                    // Paramètre de la route (id du film)
        TMDBApi $TMDBApiService,                    // Injection du service TMDBApi
        Request $request,                           // Injection du service Request
        EntityManagerInterface $entityManager,      // Injection du service EntityManager
        RatingRepository $ratingRepository,         // Injection du repository Rating
        LoggerInterface $logger                     // Injection du service Logger
    ): Response
    {
        // Appel du service TMDB pour récupérer les informations d'un film
        $T_movie = $TMDBApiService->searchById($id);
        $urlImageMoviePrefix = $_ENV['TMDB_URL_IMAGE_PREFIX'];

        // =============================
        // Création du formulaire Rating
        // =============================
        // Instance de l'entité Rating
        $rating = new Rating();
        // On renseigne l'identifiant du film à partir de l'id fourni dans la route
        $rating->setIdMovie($id);

        // Création du formulaire Rating qui utilisera l'instance créée plus haut
        $ratingForm = $this->createForm(RatingType::class, $rating);




        // =============================
        // Traitement du formulaire Rating depuis la requête (POST)
        $ratingForm->handleRequest($request);

        // Vérification que le formulaire a été soumis et est valide
        if ($ratingForm->isSubmitted() && $ratingForm->isValid()) {
            // Ecriture en base de la nouvelle note
            $entityManager->persist($rating);
            $entityManager->flush();

            // Log
            $logger->info('----------------------------------------------------------');
            $logger->info('Nouvelle note enregistrée pour le film ' . $id . ' : ' . $rating->getRate() . ' / 5 par '
                . $rating->getNickname());
            $logger->info('----------------------------------------------------------');
        }

        // Chercher toutes les notes pour CE film
        $ratingList = $ratingRepository->findBy(['idMovie' => $id]);




        // =============================
        // Création du formulaire Movie
        // =============================
        // Instance de l'entité Movie
        $movie = new Movie();
        // On renseigne l'identifiant du film à partir de l'id fourni dans la route
        $movie->setId($id);

        // On renseigne le titre, la description et l'image du film à partir des données récupérées
        $movie->setTitle($T_movie['title']);
        $movie->setOverview($T_movie['overview']);
        $movie->setPosterPath($T_movie['poster_path']);


        // Création du formulaire Movie qui utilisera l'instance créée plus haut
        $movieForm = $this->createForm(MovieType::class, $movie);

        // =============================
        // Traitement du formulaire Movie depuis la requête (POST)
        $movieForm->handleRequest($request);

        // Vérification que le formulaire a été soumis et est valide
        if ($movieForm->isSubmitted() && $movieForm->isValid()) {
            // Ecriture en base du nouveau film
            $entityManager->persist($movie);
            $entityManager->flush();

            // Log
            $logger->info('----------------------------------------------------------');
            $logger->info('Nouveau film enregistré en base ' . $id . ' : ' . $movie->getTitle());
            $logger->info('----------------------------------------------------------');
        }



        return $this->render('movie/show.html.twig', [
            'movie' => $T_movie,
            'urlImageMoviePrefix' => $urlImageMoviePrefix,

            // Formulaire de notation
            'ratingForm' => $ratingForm->createView(),

            // Formulaire de création de film
            'movieForm' => $movieForm->createView(),

            // Liste des notes pour CE film
            'ratingList' => $ratingList
        ]);
    }
}
