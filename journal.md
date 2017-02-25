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

#### Dimanche 05/02/2017

Tout a été manipulé aujourd'hui : classes, vues, contrôleurs, modèles, pages ainsi que la partie publique.

**La page '*home*'**
Ajout d'une image décorative (ajoutée en background pour ne pas gêner l'accessibilité), au-dessus de la liste des articles présents en base de données. Ajout d'un `<hr>` personnalisé.

**La partie "*admin*"**
Une image décorative (elle aussi en background) a été ajoutée. Le formulaire (avec un `textarea` géré par *TinyMCE*), la liste des articles ainsi que la zone dangereuse peuvent désormais être désactivés et réactivés grâce à `jQuery`.

**La *single page*** 
Elle s'est vue agrémentée d'un design amélioré. Les articles apparaissent désormais dans un cadre, le contenu espacé un peu à l'intérieur (*padding*).

La prochaine étape du développement a été amorcée, à savoir l'espace de commentaires. Il n'est pas encore fonctionnel. En vue d'effectuer des tests d'affichage, un clic sur le mot "Commentaires" active une zone où seront prochainement affichés lesdits commentaires.

**Côté code**
*Les ajouts et autres modifications*

 > - Ajout des méthodes `get_articles_header()`, `get_extract` et `get_url()` dans la classe `Article`, toujours dans l'optique de respecter un peu plus l'architecture MVC.
 > - Les classes `ViewAdmin`, `ViewHome` et `ViewSingle` ont été étoffées. Hélas, beaucoup (trop) de `echo` là-dedans (surtout dans la classe `ViewAdmin`). **Cela peut sûrement être amélioré. Comment ?**
 > Ajout du CDN `jQuery` et création d'un fichier `script.js` pour la gestion des évènements.
 > Prise en considération de la page demandée pour l'affichage (ou non) du script concernant TinyMCE. S'il s'agit de la page '*admin*' ou '*single*', le script existe. En effet, il sera à l'avenir nécessaire pour les commentaires laissés sur les articles (uniquement (pour le moment) sur la page 'single').

*Les suppressions*

> - Suppression de la page `homeHeader.php`

*Les doutes*

> - Léger doute en ce qui concerne les contrôleurs. En effet, `HomeController`, `SingleController` et `AdminController` font tous trois appel au modèle `ArticleManager`, qui s'occupe de la connexion à la base de données. **N'y a-t-il pas plus efficace ?**
> -  Le modèle `ArticleManager` permet maintenant d'obtenir la date du post d'un article. **Cependant, la façon de faire est-elle la bonne ?**
> - La page `index.php` DOIT être amélioré. Mais comment ? Et surtout, les contrôles (`isset`) pour la publication, l'édition et la suppression d'articles sont-ils à leur place ?

#### *Samedi 25/02/2017*

Plusieurs semaines ont passé depuis la dernière mise à jour de ce document. Il est temps de faire un point sur le projet. J'ai été un peu surpris par la quantité de code requise pour ce projet, c'est pourquoi j'ai pris un peu de retard.

**La page '*home*'**
Elle affiche les articles dans l'ordre décroissant. Le contenu n'est pas affiché entièrement (utilisation de la fonction `substr()`, suivi de points de suspension. Un bouton "Lire la suite" se trouve sous chaque article. Un délimiteur (`<hr />`) est placé sous chacun d'eux. L'affichage est limité à 3 articles. Un système de pagination a été mis en place pour ne pas surcharger la page. Grâce à Twitter Bootstrap, la page semble entièrement responsive (testée sous *Chrome*, *Firefox* et *Safari*).

**La page '*Single*'**
En cliquant sur le bouton "Lire la suite" de la page *home*, on se retrouve sur la page *single*. Elle se charge d'afficher l'article (complet) sur la partie gauche de la page, tandis qu'un `<aside>`, à droite, se charge d'afficher la liste des cinq derniers articles en date.
L'affichage de l'article complet comprend :

 - Le titre (bien mis en avant) ;
 - La date de publication (affichée entre balises `<small></small>` ;
 - Un bouton *Modifier* (si l'utilisateur est connecté au compte administrateur) ;
 - L'article complet.

Sous chaque article, un espace 'Commentaire'. Celui-ci affiche le total de commentaires de l'article, puis les affiche s'il y en a. Les commentaires ne peuvent tenir que sur un niveau pour le moment : le but étant d'atteindre trois niveaux de commentaires à la fin de ce projet.
Sous l'affichage des commentaires se trouve un formulaire pour en publier un.
Enfin, un lien permet de retourner vers la page d'accueil.

**La page '*Admin*'**
L'image décorative précédemment ajoutée a été retirée (pour le moment). L'espace d'administration se compose de plusieurs onglets : tableau de bord, mes articles, écrire, commentaires et réglages. Je n'entre pas dans les détails, car l'espace d'administration est encore en travaux.

Les pages *About* et *Contact* ont été ajoutées au projet, mais ne sont pas encore fonctionnelles.
Une page d'erreur *404 Page Not Found* a été créée et est fonctionnelle, mais reste à être améliorée.

####Les questions à poser au mentor à la prochaine session :

 1. À propos des messages flash
Dans `vues/Admin.php` (ligne 122), `app/admin/admin-list-articles` (ligne 6) et `app/admin/admin-write` (ligne 27), y a-t-il une meilleure solution pour faire apparaître des messages de confirmation ? J'ai essayé de faire la même chose que dans le TP Système de News sur OpenClassrooms, mais je n'ai pas réussi.
 
 2. À propos de certaines classes
Pourrait-on vérifier ensemble les classes `modeles/Comment.php`, `modeles/CommentManager.php`, `modeles/User.php` et `modeles/UserManager.php` ? J'aimerais savoir si elles peuvent (doivent ?) être améliorées ou modifier. J'aimerais également m'attarder sur l'ajout d'utilisateurs, mais également la vérification qu'une personne se trouve en base de données pour la connexion à l'espace d'administration, par exemple.

 3. À propos des 'require'
 Comment simplifier les '*require*' dans `public/index.php` ?
 
 4. À propos de la rédaction de la présentation de la page *About*
J'aimerais permettre à l'administrateur de rédiger sa présentation '*À propos*' dans l'espace d'administration. Est-ce possible ? Si oui, comment s'y prendre ?

 5. À propos de la sécurité
Y a-t-il, selon toi, des problèmes de sécurités évidents ?