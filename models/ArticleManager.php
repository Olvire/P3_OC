<?php
class ArticleManager
{
	private $db_host;
	private $db_name;
	private $db_user;
	private $db_pass;
	private $db;

	/**
	 * Use the parameters to instantiate the PDO
	 *
	 * @param string  $db_name  The database name
	 * @param string  $db_host  The database host
	 * @param string  $db_user  The database user
	 * @param string  $db_pass  The database pass
	 */
	public function __construct($db_name, $db_host = 'localhost', $db_user = 'root', $db_pass = 'root')
	{
		$this->db_host = $db_host;
		$this->db_name = $db_name;
		$this->db_user = $db_user;
		$this->db_pass = $db_pass;
		$this->db = new PDO('mysql:host=' . $db_host . ';dbname=' . $this->db_name . ';charset=utf8', $db_user, $db_pass);
	}

	/**
	 * Makes a query to count the total number of articles in the database
	 *
	 * @return int Number of articles in the database
	 */
	public function count()
	{
		return $this->db->query('SELECT COUNT(*) FROM articles')->fetchColumn();
	}

	/**
	 * Use MySQL to add an article in the database
	 *
	 * @param string  $title    The title
	 * @param string  $content  The content
	 * @param string  $author   The author
	 */
	public function add($title, $content, $author, $date_post)
	{
		$request = $this->db->prepare('INSERT INTO articles(title, content, author, $date_post) VALUES(:title, :content, :author, NOW())');
		$request->bindValue(':title', $title);
		$request->bindValue(':content', $content);
		$request->bindValue(':author', $author);

		$request->execute();
	}

	/**
	 * Gets the articles.
	 *
	 * @return Object The articles.
	 */
	public function get_articles() 
	{
		$result = $this->db->query('SELECT * FROM articles ORDER BY id');
		$listeArticles = $result->fetchAll(PDO::FETCH_CLASS, "Article");

		// TODO : vérifier le bon fonctionnement (ne fonctionne pas, le 04/02/2017)
		foreach($listeArticles as $article)
		{
			$article->set_date_post(new DateTime($article->get_date_post()));
		}

		$result->closeCursor();

		return $listeArticles;
	}

	/**
	 * Gets the article.
	 *
	 * @return Object The article.
	 */
	public function get_article()
	{
		$result = $this->db->query('SELECT * FROM articles WHERE id = ' . $_GET['id'])->fetchAll(PDO::FETCH_CLASS, "Article");
		return $result;
	}

	/**
	 * Delete an article
	 * 
	 * @return void
	 */
	public function delete_article()
	{
		$result = $this->db->exec('DELETE FROM articles WHERE id = ' . $_GET['id']);
		return $result;
	}

	/**
	 * Truncate the 'articles' table
	 *
	 * @return void
	 */
	public function delete_all()
	{
		$result = $this->db->exec('TRUNCATE TABLE articles');
		return $result;
	}
}