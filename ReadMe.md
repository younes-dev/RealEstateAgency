***
#####Connecte to php
* docker exec -it  RealEstateAgency -php-fpm bash

***
#####Connecte to Mysql
* docker exec -it RealEstateAgency -mysql mysql -uroot

***
#####Connecte to mariadb
*  docker exec -it RealEstateAgency -mariadb mysql -uroot -proot

***
* Create new user with host '%' rather than localhost. Below is works for me. It may useful to you.
````
* https://github.com/docker-library/mysql/issues/275
    mysql>     show databases;
    mysql>     use mysql;
    mysql>     SELECT user,authentication_string,plugin,host FROM user;
    mysql>     CREATE USER 'root'@'%' IDENTIFIED BY 'root';
    mysql>     grant all on *.* to 'root'@'%';
````
***
* this command to dump its default configuration.
````
    Syntax : php bin/console config:dump-reference FrameworkBundle
             php bin/console config:dump-reference security
````
***
[How to Debug the Service Container & List Services](https://symfony.com/doc/current/service_container/debug.html)
* you can find out what services are registered with the container using the console.
    To show all services (public and private) and their PHP classes, run:
    
````
   php bin/console debug:container
   php bin/console debug:container --show-hidden
````

* To see a list of all of the available types that can be used for autowiring, run:
````    
  php bin/console debug:autowiring
````
* Detailed Info about a Single Service
````   
  php bin/console debug:container 'App\Service\Mailer'
````    
 *  to show the service arguments:
````
  php bin/console debug:container 'App\Service\Mailer' --show-arguments
````
***
[Switches button : Toggle Element Bootstrap](https://symfony.com/blog/new-in-symfony-4-4-bootstrap-custom-switches)
***
[The Symfony Methods [GET,HEAD,POST,PUT,DELETE]](https://www.ionos.fr/digitalguide/hebergement/aspects-techniques/405-method-not-allowed/)
***

* A Very helpful website for devops and development 
````
https://dev.to/
````
***
[Mise en place des dates de création et mise à jour
](https://nouvelle-techno.fr/actualites/symfony-4-creer-un-blog-pas-a-pas-creer-une-interface-dadministration)
***
[Création des slugs
](https://nouvelle-techno.fr/actualites/symfony-4-creer-un-blog-pas-a-pas-creer-une-interface-dadministration)
***
[Création des slugs by cocur/slugify
](https://github.com/cocur/slugify)
***

[symfony modeles and components explaining](https://dev.to/brpaz/an-introduction-to-symfony--the-foundation-of-modern-php-applications-ehj)
[Integrate Oauth2 for Symfony 4](https://dev.to/_mertsimsek/integrate-oauth2-for-symfony-4-360c)

[Commands for Viewing and Sorting Files](https://dev.to/yashsugandh/commands-for-viewing-and-sorting-files-452j)


[Admin Dashboards - Open-Source and Free](https://dev.to/sm0ke/admin-dashboards-open-source-and-free-4aep)

[Symfony 5 development with Docker](https://dev.to/martinpham/symfony-5-development-with-docker-4hj8)
***
[les méthodes persist(), flush() et clear()](https://openclassrooms.com/forum/sujet/doctrine-persist-update-ou-insert)

