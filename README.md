# Projet SymfonyCine

Projet de base

## Installation

```
symfony new SymfonyCine --full
```

Installation avec le client *symfony*.

## Configuration de la base de données

On utilise Sqlite, donc on doit modifier le fichier **.env**

```
# .env

# Base de données en SQLITE
DATABASE_URL="sqlite:///%kernel.project_dir%/DATAS/SymfonyCine.db"

# DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=5.7"
# DATABASE_URL="postgresql://db_user:db_password@127.0.0.1:5432/db_name?serverVersion=13&charset=utf8"
###< doctrine/doctrine-bundle ###
```

## Import de la base de données en Entity

```
php bin/console doctrine:mapping:import "App\Entity" annotation --path=src/Entity
```


***



## Création de l'entité Movie

Pour créer une entité, on utilise la commande *make:entity*:

```
➜  SymfonyCine git:(master) ✗ sc make:entity

 Class name of the entity to create or update (e.g. FierceElephant):
 > Movie

 created: src/Entity/Movie.php
 created: src/Repository/MovieRepository.php
 
 Entity generated! Now let's add some fields!
 You can always add more fields later manually or by re-running this command.

 New property name (press <return> to stop adding fields):
 > 
 ```

Il faut ensuite *mapper* la classe *Entity/Movie* avec la base de données.

```
➜  SymfonyCine git:(master) ✗ sc doctrine:schema:create  

 !                                                                                                                      
 ! [CAUTION] This operation should not be executed in a production environment!                                         
 !                                                                                                                      

 Creating database schema...

                                                                                                                        
 [OK] Database schema created successfully!
```

On a désormais une correspondance entre la base et les classes entités dans notre application.

## Controller pour afficher les Films

On crée ensuite un controller pour afficher les films:

```
➜  SymfonyCine git:(master) ✗ sc make:controller         

 Choose a name for your controller class (e.g. OrangeChefController):
 > MovieController

 created: src/Controller/MovieController.php
 created: templates/movie/index.html.twig

           
  Success! 
           

 Next: Open your new controller class and add some pages!
 ```

> Injection de dépendance du MovieRepository
> Préfixe de route
> Paramètres de route
> Param Converter