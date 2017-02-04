Journal de bord
=======

#### *Mercredi 01/02/2017*

Pour cette première journée sur le P3, j'ai été très motivé. J'ai créé les dossiers **/app**, **/pages** et **/public** pour faire la distinction entre les fichiers. Malheureusement, il semblerait que ça n'ait pas servi à grand chose.

**Dans le dossier /app :**

>  - J'ai commencé par créé l'autoloader (*app/autoloader.php*). (**Amélioration ?** *Créer une classe pour rester en POO ?*)
>  - Ensuite, j'ai créé les classes Article (*app/classes/Article.php*) et ArticleManager (*app/classes/ArticleManager.php*). (**Amélioration
> ?** *Se pencher sur la fonction d'édition d'article. Je ne sais pas
> encore comment m'y prendre !*)
>  - Puis la classe AdminForm (*app/classes/AdminForm.php*), destinée à créer le formulaire d'ajout d'article dans la page d'administration du
> blog. (**Amélioration ?** *Est-ce réellement optimisé ? N'est-il pas
> possible de faire mieux ?*)

**Dans le dossier /pages :**

> - En m'aidant [d'une des vidéos](https://www.youtube.com/watch?v=sqiP39cH5K4) de Graphikart,
> j'ai essayé de créer un template, une page par défaut, mais force est
> de constater que je ne sais pas comment m'y prendre pour la faire
> fonctionner.
>  - Du coup, cela se ressent sur les autres pages ! La page admin (*pages/admin.php*) est blindée de HTML, ce que je ne souhaite pas !
> J'aimerais que seul la page défaut (*pages/template/default.php*)
> contienne le HTML essentiel aux pages et que je n'aie plus à le
> recopier.
>  - J'ai créé les pages home (*pages/home.php*) et single (*pages/singles.php*) dans l'optique d'avoir un système de route
> (comme le permet Symfony), mais là encore, cela dépasse mes
> connaissances actuelles en la matière.

**Dans le dossier /public :**

>  - Je sais que le ce dossier est censé contenir les fichiers pouvant être vus par le visiteur, mais c'est là que j'ai eu ma plus grande
> confusion, car j'y ai mis ma page d'index (*public/index.php*) alors
> que je sais qu'elle ne devrait pas être là.
>  - Enfin, la feuille de style (*public/style.css*) vient compléter celle du Twitter Bootstrap !

Bref, encore beaucoup de choses à corriger et à améliorer. Si vous voyez ce journal et que vous souhaitez m'aider, n'hésitez pas à me contacter.

#### *Jeudi 02/02/2017*

Aujourd'hui, j'ai effectué quelques modifications de style, rien de plus. Je me suis surtout attelé à pousser les fichiers sur ce repository.

**À faire :**

 - Programmer au maximum en orienté objet
	 - Un minimum de HTML !
 - Respecter l'architecture MVC (pas simple !)
	 - Organisation des dossiers !
	 - Organisation des fichiers !
 - Protéger la page d'administration par mot de passe
	 - Créer un utilisateur admin en base de données ?
 - Travailler sur l'édition des articles (*Comment faire ?*)
 - Demander confirmation lors de la suppression (*TRUNCATE*) de tous les articles
	 - JS ?

#### Samedi 04/02/2017

Une grosse tentative, aujourd'hui, de faire les modifications nécessaires pour respecter l'architecture MVC. Je me suis appuyé sur un exemple fourni par mon mentor pour lesdites modifications et espère avoir fait un pas vers la bonne direction. J'en appelle à mon mentor et à toutes les personnes pouvant apporter leurs bons conseils ! ;)

Pour le dernier commit, j'ai tenté d'ajouter la date d'ajout du post (*$date_post*), mais sans succès. Cela reste à faire dans les prochaines mises à jour. 