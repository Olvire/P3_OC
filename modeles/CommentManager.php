<?php

class CommentManager
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

	public function add($author, $article_id, $content)
	{
		$request = $this->db->prepare('INSERT INTO comments(author, article_id, content, date_post) VALUES(:author, :article_id, :content, NOW())');
		$request->bindValue(':author', $author);
		$request->bindValue(':article_id', $article_id);
		$request->bindValue(':content', $content);

		$request->execute();
	}

	public function get_total_count()
	{
		$result = $this->db->query('SELECT COUNT(*) FROM comments')->fetchColumn();
		return $result;
	}

	public function count($article_id)
	{
		$request = $this->db->prepare('SELECT COUNT(*) FROM comments WHERE article_id = :article_id');
		$request->bindValue(':article_id', $article_id);
		$request->execute();

		return $request->fetchColumn();
	}

	public function get_specific_comment($signaled_id)
	{
		$request = $this->db->prepare('SELECT * FROM comments WHERE id = :signaled_id');
		$request->bindValue(':signaled_id', (int) $signaled_id);
		$request->execute();

		$comment = $request->fetch();

		$request->closeCursor();

		return $comment;
	}

	public function get_all_comments()
	{
		$result = $this->db->query('SELECT * FROM comments ORDER BY article_id');
		$listComments = $result->fetchAll(PDO::FETCH_CLASS, "Comment");

		foreach($listComments as $comment) {
			$comment->set_date_post(new DateTime($comment->get_date_post()));
		}
		
		return $listComments;
	}

	public function get_comments($article_id)
	{
		$request = $this->db->prepare('SELECT * FROM comments WHERE parent_id = 0 AND article_id = :article_id ORDER BY date_post');
		$request->bindValue(':article_id', $article_id);

		$request->execute();

		$listComments = $request->fetchAll(PDO::FETCH_CLASS, "Comment");

		foreach($listComments as $comment) {
			$comment->set_date_post(new DateTime($comment->get_date_post()));
		}

		$request->closeCursor();

		return $listComments;
	}

	public function update_signal($comment_id)
	{
		$req = $this->db->prepare('UPDATE comments SET `signaler` = `signaler` + 1 WHERE id = :id');
		$req->bindValue(':id', (int) $comment_id);
		$req->execute();
	}

	public function reset_signal($comment_id)
	{
		$req = $this->db->prepare('UPDATE comments SET `signaler` = 0 WHERE id = :id');
		$req->bindValue(':id', (int) $comment_id);
		$req->execute();
	}

	public function get_signaled()
	{
		$result = $this->db->query('SELECT * FROM comments WHERE signaler > 0 ORDER BY signaler DESC');
		$signaled = $result->fetchAll(PDO::FETCH_CLASS, "Comment");

		foreach($signaled as $comment) {
			$comment->set_date_post(new DateTime($comment->get_date_post()));
		}

		return $signaled;
	}

	// public function get_sub_comments()
	// {
		// TODO
	// }

	public function delete_comment($id)
	{
		$request = $this->db->prepare('DELETE FROM comments WHERE id = :id');
		$request->bindValue(':id', $id);
		
		$request->execute();
	}

	public function delete_all()
	{
		$result = $this->db->exec('TRUNCATE TABLE comments');
		return $result;
	}
}