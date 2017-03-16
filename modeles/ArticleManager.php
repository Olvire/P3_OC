<?php
/**
 * Classe servant de Manager à la classe Article
 */
class ArticleManager
{	

	// Attribut nécessaire à la connexion avec la base de données.
	private $db;

	/**
	 * Permet de se connecter à la base de données dès l'instanciation de l'objet.
	 * @param PDO Object $db La base de données
	 */
	public function __construct($db)
	{
		$this->db = $db;
	}

	/**
	 * Compte le nombre d'articles dans la base de données.
	 * @return int Le nombre d'articles
	 */
	public function count()
	{
		$result = $this->db->query('SELECT COUNT(*) FROM articles')->fetchColumn();
		return $result;
	}

	/**
	 * Ajoute un article dans la base de données.
	 * @param Article $article L'article (object)
	 */
	public function add(Article $article)
	{
		$req = $this->db->prepare('INSERT INTO articles(title, content, author, datePost) VALUES(:title, :content, :author, NOW())');
		$req->bindValue(':title', $article->getTitle());
		$req->bindValue(':content', $article->getContent());
		$req->bindValue(':author', $article->getAuthor());

		$req->execute();
	}

	/**
	 * Met à jour les valeurs d'un article.
	 * @param string $title Le titre
	 * @param string $author L'auteur
	 * @param string $content Le contenu
	 * @param int $id L'id
	 */
	public function update($title, $author, $content, $id)
	{
		$request = $this->db->prepare('UPDATE articles SET title = :title, author = :author, content = :content, dateEdit = NOW() WHERE id = :id');
		$request->bindValue(':title', $title);
		$request->bindValue(':author', $author);
		$request->bindValue(':content', $content);
		$request->bindValue(':id', (int) $id);
		$request->execute();
	}

	/**
	 * Obtient la liste des articles.
	 * @param int $firstArticle Le premier article
	 * @param int $articlesPerPage Le nombre d'articles par page
	 * @return Article objects La liste
	 */
	public function getList($firstArticle = -1, $articlesPerPage = -1) 
	{
		$sql = 'SELECT * FROM articles ORDER BY datePost DESC';
		
		// Vérification de la validité des données reçues.
		if($firstArticle != -1 OR $articlesPerPage != -1)
		{
			$sql .= ' LIMIT ' . (int) $articlesPerPage . ' OFFSET ' . (int) $firstArticle;
		}

		$request = $this->db->query($sql);
		$request->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Article');

		$listOfArticles = $request->fetchAll();

		// On boucle sur la liste d'articles afin d'instancier des objets DateTime pour datePost et dateEdit.
		foreach($listOfArticles as $article)
		{
			$article->setDatePost(new DateTime($article->getDatePost()));
			$article->setDateEdit(new DateTime($article->getDateEdit()));
		}

		$request->closeCursor();

		return $listOfArticles;
	}

	/**
	 * Obtient la liste des 3 derniers articles.
	 * @return Article Objects Les 3 derniers articles
	 */
	public function getLastArticles() {
		$result = $this->db->query('SELECT * FROM articles ORDER BY datePost DESC LIMIT 0, 3');
		$lastArticles = $result->fetchAll(PDO::FETCH_CLASS, 'Article');
		foreach($lastArticles as $article)
		{
			$article->setDatePost(new DateTime($article->getDatePost()));
			$article->setDateEdit(new DateTime($article->getDateEdit()));
		}
		$result->closeCursor();
		return $lastArticles;
	}

	/**
	 * Obtient un article unique (pour la vue Single)
	 * @param int $id L'id de l'article
	 * @return Article Object L'article.
	 */
	public function getUnique($id)
	{
		$request = $this->db->prepare('SELECT * FROM articles WHERE id = :id');
		$request->bindValue(':id', (int) $id);
		$request->execute();
		$request->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Article');
		$article = $request->fetch();
		$article->setDatePost(new DateTime($article->getDatePost()));
		$article->setDateEdit(new DateTime($article->getDateEdit()));
		return $article;
	}

	/**
	 * Supprimer un article de la base de données.
	 */
	public function deleteArticle()
	{
		$this->db->exec('DELETE FROM articles WHERE id = '. $_GET['id']);
	}

	/**
	 * Supprime tous les articles de la base de données. Remet l'id de base à 0.
	 */
	public function deleteAll()
	{
		$result = $this->db->exec('TRUNCATE TABLE articles');
		return $result;
	}
}