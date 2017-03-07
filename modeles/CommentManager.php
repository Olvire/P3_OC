<?php

class CommentManager
{
	private $db;

	public function __construct($db) {
		$this->db = $db;
	}

	/**
	 * Add a comment
	 * @param Comment $comment The comment
	 */
	public function add(Comment $comment) {
		$req = $this->db->prepare('INSERT INTO comments (articleId, parentId, author, content, datePost) VALUES(:articleId, :parentId, :author, :content, NOW())');
		$req->bindValue(':articleId', $comment->getArticleId());
		$req->bindValue(':parentId', $comment->getParentId());
		$req->bindValue(':author', $comment->getAuthor());
		$req->bindValue(':content', $comment->getContent());

		$req->execute();
	}

	/**
	 * Gets the total count of comments.
	 * @return int The total count.
	 */
	public function getTotalCount() {
		$result = $this->db->query('SELECT COUNT(*) FROM comments')->fetchColumn();
		return $result;
	}

	/**
	 * Gets the number of comments on a specific article.
	 * @param int $articleId The article identifier
	 * @return int The number of comments on this article
	 */
	public function count($articleId) {
		$request = $this->db->prepare('SELECT COUNT(*) FROM comments WHERE articleId = :articleId');
		$request->bindValue(':articleId', $articleId);
		$request->execute();

		return $request->fetchColumn();
	}

	/**
	 * Gets a specific comment.
	 * @param int $id The identifier
	 * @return The specific comment.
	 */
	public function getSpecificComment($id) {
		$request = $this->db->prepare('SELECT * FROM comments WHERE id = :id');
		$request->bindValue(':id', (int) $id);
		$request->execute();

		$request->setFetchMode(PDO::FETCH_CLASS, "Comment");
		$comment = $request->fetch();

		$request->closeCursor();

		return $comment;
	}

	/**
	 * Gets all comments.
	 * @return All comments.
	 */
	public function getAllComments() {
		$result = $this->db->query('SELECT * FROM comments ORDER BY articleId, datePost');
		$listComments = $result->fetchAll(PDO::FETCH_CLASS, "Comment");

		foreach($listComments as $comment) {
			$comment->setDatePost(new DateTime($comment->getDatePost()));
		}
		
		return $listComments;
	}

	public function getLastComments() {
		$result = $this->db->query('SELECT * FROM comments ORDER BY datePost LIMIT 0, 5');
		$lastComments = $result->fetchAll(PDO::FETCH_CLASS, "Comment");

		foreach($lastComments as $comment) {
			$comment->setDatePost(new DateTime($comment->getDatePost()));
		}

		return $lastComments;
	}

	/**
	 * Gets the comments on a specific article.
	 * @param id $articleId  The article identifier
	 * @return object The comments.
	 */
	public function getComments($articleId) {
		$request = $this->db->prepare('SELECT * FROM comments WHERE parentId = 0 AND articleId = :articleId ORDER BY datePost DESC');
		$request->bindValue(':articleId', $articleId);

		$request->execute();

		$listComments = $request->fetchAll(PDO::FETCH_CLASS, "Comment");

		foreach($listComments as $comment) {
			$this->getCommentsChildren($comment);
			$comment->setDatePost(new DateTime($comment->getDatePost()));
		}

		$request->closeCursor();

		return $listComments;
	}

	// Méthode récursive privée
	private function getCommentsChildren(Comment $comment) {
		$request = $this->db->prepare('SELECT * FROM comments WHERE parentId = :parentId ORDER BY datePost DESC');
		$request->bindValue(':parentId', $comment->getId());

		$request->execute();

		$listComments = $request->fetchAll(PDO::FETCH_CLASS, "Comment");

		foreach($listComments as $subComment) {
			$this->getCommentsChildren($subComment);
			$subComment->setDatePost(new DateTime($subComment->getDatePost()));
		}

		$request->closeCursor();

		$comment->setSubComments($listComments);
	}

	/**
	 * Signal a comment so it can be moderated in admin page
	 * @param $comment  The comment
	 */
	public function signal($comment) {
		$req = $this->db->prepare('UPDATE comments SET signaler = 1  WHERE id = :id ');
		$req->bindValue(':id', (int) $comment->getId());
		$req->execute();
	}

	/**
	 * Validate a signaled comment
	 * @param int $commentId The comment identifier
	 */
	public function validateComment($commentId) {
		$req = $this->db->prepare('UPDATE comments SET signaler = 0 WHERE id = :id');
		$req->bindValue(':id', (int) $commentId);
		$req->execute();
	}

	public function countSignaledComments() {
		$result = $this->db->query('SELECT COUNT(*) FROM comments WHERE signaler = 1')->fetchColumn();
		return $result;
	}

	/**
	 * Gets the signaled comment.
	 * @return The signaled comment.
	 */
	public function getSignaledComments() {
		$result = $this->db->query('SELECT * FROM comments WHERE signaler > 0 ORDER BY signaler DESC');
		$signaledComments = $result->fetchAll(PDO::FETCH_CLASS, "Comment");

		foreach($signaledComments as $comment) {
			$comment->setDatePost(new DateTime($comment->getDatePost()));
		}

		return $signaledComments;
	}

	/**
	 * Delete a specific comment
	 * @param int $id The identifier
	 */
	public function deleteComment($commentId) {
		$req = $this->db->prepare('DELETE FROM comments WHERE id = :id');
		$req->bindValue(':id', $commentId);
		$req->execute();
	}

	/**
	 * Delete all comments
	 */
	public function deleteAll() {
		$result = $this->db->exec('TRUNCATE TABLE comments');
		return $result;
	}
}