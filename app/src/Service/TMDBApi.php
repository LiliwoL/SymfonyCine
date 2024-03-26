<?php

namespace App\Service;

class TMDBApi
{
    private string $TMDBApiKey;
    private string $TMDBToken;

    /**
     * @todo Gérer le cas où la variable TMDB_API_KEY n'existe pas dans le .env
     */
    public function __construct()
    {
        // Utilisation de la clé API définie dans le fichier .env
        $apiKey = $_ENV['TMDB_API_KEY'];
        $this->TMDBApiKey = $apiKey;

        $token = $_ENV['TMDB_TOKEN'];
        $this->TMDBToken = $token;
    }

    public function search( string $term )
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.themoviedb.org/3/search/movie?api_key=' . $this->TMDBApiKey . "&query=" . $term . "&language=fr");
        curl_setopt($ch,  CURLOPT_RETURNTRANSFER, true);

        $resultat_curl = curl_exec($ch);

        // On transforme le résultat de cURL en un objet JSON utilisable
        $json = json_decode ( $resultat_curl );

        //var_dump('https://api.themoviedb.org/3/search/movie?api_key=' . $this->themoviedbApiKey . "&query=" . $term);

        // Renvoi du JSON
        return $json->results;
    }

    public function searchById( int $id )
    {
        $endpoint = "https://api.themoviedb.org/3/movie/" . $id . "?language=fr-FR";
        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL => $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "Authorization: Bearer " . $this->TMDBToken,
                "accept: application/json"
            ],
        ]);

        $resultat_curl = curl_exec($ch);

        // On transforme le résultat de cURL en un objet JSON utilisable
        $json = json_decode ( $resultat_curl, true );

        // Renvoi du JSON transformé en tableau associatif
        return $json;
    }


    public function discover()
    {
        // Endpoint
        $endpoint = "https://api.themoviedb.org/3/discover/movie?include_adult=false&language=fr-FR";

        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL => $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "Authorization: Bearer " . $this->TMDBToken,
                "accept: application/json"
            ],
        ]);

        $resultat_curl = curl_exec($ch);

        // On transforme le résultat de cURL en un objet JSON utilisable
        $json = json_decode ( $resultat_curl );

        /**
         * @TODO: Gestion de l'erreur
         */

        // Renvoi du JSON
        return $json->results;
    }
}