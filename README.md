# symfony cine

# Services

Les services sont seulement des classes utiles que l'on peut **injecter** facilement dans les controllers.

Pour créer un nouveau service (pas de **maker** disponible).

- Créez un dossier **src\Service**
- Créer une classe avec un nom pertinent

## Exemple avec un service d'appel à une API externe

> Il faut au préalable disposer d'une clé API Tmdb et la placer dans le fichier **.env**

**.env.local**
```dotenv
...


# OMDB clé API
OMDB_API_KEY=""

# TMDB clé API
TMDB_API_KEY=""
```

**src\Service\TMDBApi.php**
```php
<?php

namespace App\Service;

class TMDBApi
{
    private string $themoviedbApiKey;

    /**
     * @todo Gérer le cas où la variable TMDB_API_KEY n'existe pas dans le .env
     */
    public function __construct()
    {
        // Utilisation de la clé API définie dans le fichier .env
        $apiKey = $_ENV['TMDB_API_KEY'];
        $this->themoviedbApiKey = $apiKey;
    }

    public function search( string $term )
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.themoviedb.org/3/search/movie?api_key=' . $this->themoviedbApiKey . "&query=" . $term . "&language=fr");
        curl_setopt($ch,  CURLOPT_RETURNTRANSFER, true);

        $resultat_curl = curl_exec($ch);

        // On transforme le résultat de cURL en un objet JSON utilisable
        $json = json_decode ( $resultat_curl );

        //var_dump('https://api.themoviedb.org/3/search/movie?api_key=' . $this->themoviedbApiKey . "&query=" . $term);

        // Renvoi du JSON
        return $json->results;
    }



    public function searchByMovieId( int $id )
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.themoviedb.org/3/movie/' . $id .'?api_key=' . $this->themoviedbApiKey . "&language=fr");
        curl_setopt($ch,  CURLOPT_RETURNTRANSFER, true);

        $resultat_curl = curl_exec($ch);

        // On transforme le résultat de cURL en un objet JSON utilisable
        $json = json_decode ( $resultat_curl );

        // Renvoi du JSON
        // https://developers.themoviedb.org/3/movies/get-movie-details
        return $json;
    }
}
```

Ces services font des requêtes HTTP et ont besoin de dépendances spéciales.
Pour les installer:

```bash
composer require symfony/http-client
```


---

# Liens

- Application
http://localhost:807
- PHPMyAdmin
http://localhost:8081
- MailHog
http://localhost:8025


# Modèle

## Notes

### Objectif

Permettre aux utilisateurs de laisser une note sur les films.

Une note est associée à un film et à un utilisateur.
La note est comprise entre 0 et 5.

> Pour faire simple, l'utilisateur est représenté par son pseudo. Aucune vérification n'est pour le moment demandée.

### Entité

---

## Films

### Objectif

On souhaite conserver en base de données certains films.
Sur la **page de détail** d'un film, on doit disposer d'un bouton qui va permettre d'enregistrer en base le film en question.

### Description de l'Entité

MOVIE
id
title
overview
poster_path

### Déroulé

#### Création de l'entité

Créer une nouvelle entité **Movie**

```bash
symfony console make:entity Movie
```

Saisissez les différents champs demandés plus haut.
_id, title, overview, poster_path_

#### Mettre à jour la base de données 

Créer une migration pour mettre à jour la base de données

```bash
symfony console make:migration
```

Appliquer la migration créée.

```bash
symfony console doctrine:migrations:migrate
```

---

#### Création du formulaire

Créer un formulaire pour enregistrer un film en base de données.

```bash
symfony console make:form MovieType
```

Ajustez le formulaire en spécifiant les champs à afficher et les types de champs.

---

#### Modification de la page de détail

La page de détail doit disposer d'un bouton pour enregistrer le film en base de données.

---




