# garage_parrot
Évaluation en cours de formation (ECF) - Graduate développeur web fullstack - Julien Nesme

Projet fictif de Garage Automobile pour un certain Vincent Parrot. Cette application expose plusieurs services types d'un garage automobile (vente de voitures, réparations...) ainsi qu'un back office pour permettre à Vincent Parrot de gérer et administrer son site.

<h3>PRÉREQUIS :</h3>

- Un serveur Web (Apache... etc)
- PHP 8.0 ou supérieur
- MySQL 8.0 ou supérieur
- Avoir une base de données MySQL prête et fonctionnelle.

<h3>EXÉCUTION EN LOCAL :</h3>

Faites un git clone de ce projet, ou téléchargez le zip.
Allez dans le dossier : garage_parrot<br>
Pour installer les dépendances exécutez la commande : <i>composer install</i>

<h3>CONNEXION A LA BASE DE DONNÉES :</h3>

A la racine du projet créez un fichier .env.local et configurez une ligne `DATABASE_URL` avec vos paramètres MySQL (en remplacant id et mdp par votre identifiant et mot de passe) : DATABASE_URL="mysql://id:mdp@127.0.0.1:8889/g-parrot?serverVersion=8.0.32&charset=utf8mb4"  

<h3>CRÉATION DES TABLES :</h3>

Exécutez dans le terminal, depuis la racine de ce projet, la commande :
<i>php bin/console doctrine:migrations:migrate</i>

<h3>JEU DE DONNÉES :</h3>

Pour remplir la base de données avec un jeu de données vous pouvez éxecuter la commande (à ne plus jamais faire ensuite sous risque d'effacer toutes les données existantes):
<i>php bin/console doctrine:fixtures:load</i>

<h3>CREATION DE L'ADMIN :</h3>

Connectez-vous à votre base de donnée (via PhpMyamdin, HeidiSQL...) et exécutez la requête ci-dessous :

INSERT INTO admin (email, roles, PASSWORD, first_name, last_name)
VALUES ('vincent.parrot@gmail.com', '["ROLE_ADMIN"]', '$2y$13$5vF3si3DPDEeljkD/ufxHO4t5D.G0uM61vRAMrgaTAALlYMaqAE62', 'vincent', 'parrot');

<h3>CONNEXION DE L'ADMIN :</h3>

Lancez l'application en exécutant la commande : <i>php bin/console server:run</i><br>
Depuis la page d'accueil du site, ajoutez /admin dans la barre d'adresse du navigateur. Cela vous permettra d'accéder au formulaire de connexion pour Vincent Parrot.<br>
identifiant : vincent.parrot@gmail.com<br>
mot de passe : parrotadmin

<h3>SECURITE :</h3>

Les identifiants et mot de passe ici présent sont à des fins de démonstration. Dans un environnement de production il faudra les mettre à jour.<br>
