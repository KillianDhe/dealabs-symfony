Pour travailler sur ce projet, nous avons utililser votre configuration docker.

Vous pouvez ainsi build l'image en tapant `docker-compose up --build` à la racine du projet.

Cela créera les différents containers nécessaires, vous pouvez y accéder avec les liens ci-dessous.

Apache : `http://localhost:8081`
PhpMyAdmin : `http://localhost:8090`
Mailcatcher : `http://localhost:1081`

Une fois celà fait, vous pouvez lancer la commande `composer install` dans le container apache pour installer tous les modules nécessaires à notre projet.

Pour entrer dans le container apache afin d'y executer la commande:
- `docker exec -it -u root lpa_sf4_php bash`
- `cd /var/www/lpa_sf4`
- `composer install`
- `chown -R www-data:www-data public`

Afin de build tout ce qui est js, css (les assets), vous devez tapez la commande `yarn install` puis `yarn encore dev` (yarn n'est pas intallé dans le container, vous pouvez sur votre machine).

A ce stade, la seule chose qui devrait vous manquer est la base de données.
Nous n'avons pas (encore) crée de fixture, vous pouvez donc soit:
 -  repartir d'une base neuve et sans données en tapant la commande `bin/console doctrine:migrations:migrate` dans le container apache.
 
 -  utiliser la base de données que je vous joins en copie (le dossier db), qui est à copier/coller dans le dossier .docker/data  celle-ci contient déjà quelques données et vous évitera de les créer à la main. (finalement j'ai pas réussi, désolé)

