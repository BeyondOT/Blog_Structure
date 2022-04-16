# Readme

# Introduction

Ceci est mon projet de blog pour le module de "Programmation Web 2". J'ai eu un énorme plaisir à travailler sur ce projet.
Durant ce projet j'ai appris beaucoup de nouvelles choses et de nouvelles manières d'organiser mon code. Il faut croire que développer un site web en utilisant la structure MVC et la programmation orienté objet a été un clic pour moi car ça m'a permit de modularisier mon code, ce qui rend le code plus organisé et plus agréable à travailler dessus. 

# Organisation 

## Structure de code :
Ce projet est organisé en utilisant la structure MVC. 
Voici une explication de comment fonctionne mon site Web.

## Fonctionnement du site web :
<!-- TODO: INSERER LIEN SITE WEB -->
Lorsqu'on se rend sur le site <!-- INSERER LIEN ICI -->, on est redirigé directement vers la page d'accueil. Cela est fait grâce à:

### [Router.php](https://git.unistra.fr/chemaouelfihri/projet-web-2/-/tree/main/src/libraries)
Le Router s'occupe de la lecture du lien de le découper, l'analyser et d'appeler le controller nécessaire.
Si la page demandé n'existe pas le renvoie que la page est introuvable.

### [Les Controllers](https://git.unistra.fr/chemaouelfihri/projet-web-2/-/tree/main/src/controllers):
Les controllers s'occupent d'analyser la requête de l'utilisateur sur la page concérné puis de générer la vue approprié. Par exemple si l'utilisateur veut juste accéder à la page concérné alors le controller va appeller la méthode qui permet de générer la vue. 
Dans le cas ou il souhaite effectuer une action sur la page alors le controller va appeler la méthode qui va permettre d'executer cette action puis le rediriger vers la page ou il était. Et vu que la redirection à été faite alors le controller considere que l'utilisateur veut juste voir la page alors il génére la vue.

### [Model.php](https://git.unistra.fr/chemaouelfihri/projet-web-2/-/tree/main/src/libraries)
Le Model est une Classe qui va contenir toutes les méthodes "génériques" nécéssaires à toute interaction avec la base de données(Connexion, requetes...etc). C'est une classe qui va être hérité par les "~Manager" de chaque model.

### [Les Models:](https://git.unistra.fr/chemaouelfihri/projet-web-2/-/tree/main/src/models)
#### ModelName.php
Chaque model représente une table de la base de données, et chaque attribut de ce model représente une colonne de la table concérnée.

#### ModelNameManager.php
Les ModelManager sont des classes qui héritent de la classe Model.php. Ceux sont ces classes la que les controllers vont appeler pour intéragir avec la base de données.

### [View.php](https://git.unistra.fr/chemaouelfihri/projet-web-2/-/tree/main/src/libraries) 
Comme son nom l'indique cette classe permet de générer les vues demandés par les controllers en combinant les templates avec la vue spécifique demandé par le controller en y incluant les données nécessaires au fonctionnement de la page.

### [Les views:](https://git.unistra.fr/chemaouelfihri/projet-web-2/-/tree/main/src/views)
Ce sont les vues spécifiques à chaque pages.