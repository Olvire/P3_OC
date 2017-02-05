<?php

class CommentManager
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
	 * Makes a query to count the total number of comments in the database
	 *
	 * @return int Number of comments in the database
	 */
	public function count()
	{
		return $this->db->query('SELECT COUNT(*) FROM comments')->fetchColumn();
	}

	public function add($title, $author, $content, $article_id)
	{
		$request = $this->db->prepare('INSERT INTO comments(title, content, author, date_post, article_id) VALUES(:title, :content, :author, NOW(), :article_id)');
		$request->bindValue(':title', $title);
		$request->bindValue(':author', $author);
		$request->bindValue(':content', $content);
		$request->bindValue(':article_id', $article_id);

		$request->execute();
	}

	/**
	 * Gets the comments.
	 *
	 * @return Object The comments.
	 */
	public function get_comments() 
	{
		$result = $this->db->query('SELECT * FROM comments ORDER BY date_post');
		$listeComments = $result->fetchAll(PDO::FETCH_CLASS, "Comment");

		foreach($listeComments as $comment)
		{
			$comment->set_date_post(new DateTime($comment->get_date_post()));
		}

		$result->closeCursor();

		return $listeComments;
	}

	/**
	 * Gets the comment.
	 *
	 * @return Object The comment.
	 */
	public function get_comment()
	{
		$result = $this->db->query('SELECT * FROM comments WHERE id = ' . $_GET['id'])->fetchAll(PDO::FETCH_CLASS, "Comment");
		return $result;
	}

	/**
	 * Delete an comment
	 * 
	 * @return void
	 */
	public function delete_comment()
	{
		$result = $this->db->exec('DELETE FROM comments WHERE id = ' . $_GET['id']);
		return $result;
	}

	/**
	 * Truncate the 'comments' table
	 *
	 * @return void
	 */
	public function delete_all()
	{
		$result = $this->db->exec('TRUNCATE TABLE comments');
		return $result;
	}
}