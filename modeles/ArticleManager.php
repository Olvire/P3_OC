<?php
class ArticleManager
{
	private $db_host;
	private $db_name;
	private $db_user;
	private $db_pass;
	private $db;

	public function __construct($db_name, $db_host = 'localhost', $db_user = 'root', $db_pass = 'root')
	{
		$this->db_host = $db_host;
		$this->db_name = $db_name;
		$this->db_user = $db_user;
		$this->db_pass = $db_pass;
		$this->db = new PDO('mysql:host=' . $db_host . ';dbname=' . $this->db_name . ';charset=utf8', $db_user, $db_pass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	}

	public function count()
	{
		return $this->db->query('SELECT COUNT(*) FROM articles')->fetchColumn();
	}

	public function add($title, $author, $content)
	{
		$request = $this->db->prepare('INSERT INTO articles(title, content, author, date_post) VALUES(:title, :content, :author, NOW())');
		$request->bindValue(':title', $title);
		$request->bindValue(':author', $author);
		$request->bindValue(':content', $content);
		$request->execute();
	}

	public function update($title, $author, $content, $id)
	{
		$request = $this->db->prepare('UPDATE articles SET title = :title, author = :author, content = :content, date_edit = NOW() WHERE id = :id');
		$request->bindValue(':title', $title);
		$request->bindValue(':author', $author);
		$request->bindValue(':content', $content);
		$request->bindValue(':id', (int) $id);
		$request->execute();
	}

	public function get_list($premier_article = -1, $articles_par_pages = -1) 
	{
		$sql = 'SELECT * FROM articles ORDER BY date_post DESC';
		
		// On vérifie l'intégrité des paramètres fournis.
		if($premier_article != -1 OR $articles_par_pages != -1)
		{
			$sql .= ' LIMIT ' . (int) $articles_par_pages . ' OFFSET ' . (int) $premier_article;
		}

		$request = $this->db->query($sql);
		$request->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Article');

		$liste_articles = $request->fetchAll();

		// On parcourt notre liste d'articles pour pouvoir placer des instances de DateTime en guise de dates d'ajout et de modification.
		foreach($liste_articles as $article)
		{
			$article->set_date_post(new DateTime($article->get_date_post()));
			$article->set_date_edit(new DateTime($article->get_date_edit()));
		}

		$request->closeCursor();

		return $liste_articles;
	}

	public function get_last_articles() {
		$result = $this->db->query('SELECT * FROM articles ORDER BY date_post DESC LIMIT 0, 5');
		$lastArticles = $result->fetchAll(PDO::FETCH_CLASS, 'Article');
		foreach($lastArticles as $article)
		{
			$article->set_date_post(new DateTime($article->get_date_post()));
			$article->set_date_edit(new DateTime($article->get_date_edit()));
		}
		$result->closeCursor();
		return $lastArticles;
	}

	public function get_unique($id)
	{
		$request = $this->db->prepare('SELECT * FROM articles WHERE id = :id');
		$request->bindValue(':id', (int) $id);
		$request->execute();
		$request->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Article');
		$article = $request->fetch();
		$article->set_date_post(new DateTime($article->get_date_post()));
		$article->set_date_edit(new DateTime($article->get_date_edit()));
		return $article;
	}

	public function delete_article()
	{
		$this->db->exec('DELETE FROM articles WHERE id = '. $_GET['id']);
	}

	public function delete_all()
	{
		$result = $this->db->exec('TRUNCATE TABLE articles');
		return $result;
	}
}