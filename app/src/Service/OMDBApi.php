<?php

namespace App\Service;

class OMDBApi
{
    private string $OMDBApiKey;

    /**
     * @todo Gérer le cas où la clé API n'est pas présente dans le .env
     */
    public function __construct()
    {
        // Utilisation de la clé API définie dans le fichier .env
        $apiKey = $_ENV['OMDB_API_KEY'];
        $this->OMDBApiKey = $apiKey;
    }


    public function search( string $term ) : array
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://www.omdbapi.com/?s=' . $term . '&apikey=' . $this->OMDBApiKey);
        curl_setopt($ch,  CURLOPT_RETURNTRANSFER, true);

        $resultat_curl = curl_exec($ch);

        // On transforme le résultat de cURL en un objet JSON utilisable
        $json = json_decode ( $resultat_curl );

        // Renvoi du JSON
        if ($json->Response == "False")
        {
            $output = [];
        }else{
            $output = $json->Search;
        }

        return $output;
    }
}