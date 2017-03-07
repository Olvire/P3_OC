<?php
class ArticleManager
{
	private $db;

	public function __construct($db)
	{
		$this->db = $db;
	}

	/**
	 * Counts the number of articles in the database
	 * @return int The number of articles
	 */
	public function count()
	{
		$result = $this->db->query('SELECT COUNT(*) FROM articles')->fetchColumn();
		return $result;
	}

	/**
	 * Add an article into the database
	 * @param Article $article The article (object)
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
	 * Updates articles values
	 * @param string $title The articles title
	 * @param string $author The articles author
	 * @param string $content The articles content
	 * @param int $id The aticles identifier
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
	 * Gets the list of articles.
	 * @param int $firstArticle The first article
	 * @param int $articlesPerPage The number of articles per page
	 * @return The list.
	 */
	public function getList($firstArticle = -1, $articlesPerPage = -1) 
	{
		$sql = 'SELECT * FROM articles ORDER BY datePost DESC';
		
		// Cheching the integrity of the given data
		if($firstArticle != -1 OR $articlesPerPage != -1)
		{
			$sql .= ' LIMIT ' . (int) $articlesPerPage . ' OFFSET ' . (int) $firstArticle;
		}

		$request = $this->db->query($sql);
		$request->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Article');

		$listOfArticles = $request->fetchAll();

		// Loop on the articles list in order to put DateTime as datePost and dateEdit.
		foreach($listOfArticles as $article)
		{
			$article->setDatePost(new DateTime($article->getDatePost()));
			$article->setDateEdit(new DateTime($article->getDateEdit()));
		}

		$request->closeCursor();

		return $listOfArticles;
	}

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
	 * Gets a unique article (for single page).
	 * @param int $id The identifier of the article
	 * @return The article.
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
	 * Delete an article
	 */
	public function deleteArticle()
	{
		$this->db->exec('DELETE FROM articles WHERE id = '. $_GET['id']);
	}

	/**
	 * Delete all articles
	 */
	public function deleteAll()
	{
		$result = $this->db->exec('TRUNCATE TABLE articles');
		return $result;
	}
}