# Symfony Cine

## Objectifs

On souhaite développer une application similaire à AlloCiné.
En faisant, on va découvrir les bases de Symfony, le framework PHP le plus utilisé.
De plus on va découvrir le développement en utilisant le modèle MVC.

## Rappels des compétences à acquérir

- Développement en PHP
- Utilisation de Symfony
- Utilisation de Composer
- Utilisation de Twig
- Utilisation de Doctrine
- Utilisation de Bootstrap
- Utilisation de Git
- Utilisation de Docker
- Utilisation de MySQL
- Utilisation de l'API TMDb
- Utilisation de l'API OMDB
- Utilisation de l'API MailHog

---

# Etapes

## Installation et configuration de la WSL



## Installation de Symfony et de Composer

## Premier pas avec Symfony

- Découverte des routes et contrôleurs
- Découverte du langage de template twig

### Mission 1 - Découverte des routes et contrôleurs

- Modifier le contrôleur **HomeController** pour créer un message de bienvenue dans la méthode **index**.
- Modifier le fichier twig de la vue pour afficher le message de bienvenue.
- Passer la variable au fichier twig.

> Pour passer une variable à un fichier twig, il suffit de la passer en second paramètre de la méthode **render**.

```php
return $this->render('home/index.html.twig', [
    'message' => 'Bienvenue sur Symfony Cine'
]);
```

```twig
<h1>{{ message }}</h1>
```

> Travail à faire:
> - Créer un nouveau contrôleur **HomeController**
> - Créer une nouvelle route **/** pour afficher un message de bienvenue
> - Créer un fichier twig pour afficher le message de bienvenue
> - Passer la variable **message** au fichier twig
> - Afficher le message de bienvenue dans le fichier twig
> - Tester le résultat dans le navigateur


---

### Mission 2 - Créer des routes avec des paramètres

- Créer une nouvelle **route** dans le HomeController.
  - /bienvenue
- Cette route doit utiliser un autre fichier template.
  - bienvenue.html.twig
- Cette route doit prendre en paramètre un nom.
  - /bienvenue/{nom}
- Le template doit afficher un message de bienvenue personnalisé.

### Mission 3 - Créer un nouveau contrôleur et afficher toutes les routes

- Créer un nouveau contrôleur **ContactController**.
- Créer une nouvelle **route** dans le ContactController.
  - /contact
- Cette route doit afficher un formulaire de contact.
  - Le formulaire doit contenir les champs suivants:
    - Nom
    - Prénom
    - Email
    - Message

- Afficher en console la liste de toutes les routes de l'application


---

## Création d'un service pour aller chercher des informations sur un autre site

### Mission 4 - Création d'un service et Injection de dépendances

- Créer un service pour aller chercher des informations sur l'API TMDb.
- Créer un nouveau controller pour utiliser ce service. (Plus tard, ce service sera utilisé n'importe où dans l'application)
  - /service/film/{id}
- Cette route doit afficher les informations d'un film en fonction de son id.
  - Utiliser le service pour récupérer les informations du film.
- Créer une nouvelle route dans le HomeController.
  - /service/film/recherche/{titre}
  - Cette route doit afficher les informations d'un film en fonction de son titre.
  - Utiliser le service pour récupérer les informations du film.

> Ce controleur ne servait que d'illustration à l'injection de dépendance et la vérification que l'appel au service rfocntionnait bien.
> On va désormais l'utiliser pour de vrai.
>

### Mission 5 - Contrôleur métier Movie controller

A partir d'un schéma, créez les routes, les méthodes et les vues nécessaires.

MovieController
- index
  - Affiche une liste de films
    - La liste est soit une liste globale, soit le résultat d'une recherche
- show
  - Affiche les détails d'un film à partir de son id



## Création d'un service

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




