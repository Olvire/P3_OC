<?php
/**
 * Classe servant de Manager à la classe Comment.
 */
class CommentManager
{	

	// Attribut nécessaire à la connexion avec la base de données.
	private $db;

	/**
	 * Permet de se connecter à la base de données dès l'instanciation de l'objet.
	 * @param PDO Object $db La base de données
	 */
	public function __construct($db) {
		$this->db = $db;
	}

	/**
	 * Ajoute un commentaire en base de données.
	 * @param Comment $comment Le commentaire
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
	 * Obtient le nombre total de commentaires.
	 * @return int Total.
	 */
	public function getTotalCount() {
		$result = $this->db->query('SELECT COUNT(*) FROM comments')->fetchColumn();
		return $result;
	}

	/**
	 * Obtient le nombre de commentaires sur un article spécifique.
	 * @param int $articleId L'id de l'article
	 * @return int Le nombre de commentaires sur cet article
	 */
	public function count($articleId) {
		$request = $this->db->prepare('SELECT COUNT(*) FROM comments WHERE articleId = :articleId');
		$request->bindValue(':articleId', $articleId);
		$request->execute();

		return $request->fetchColumn();
	}

	/**
	 * Obtient un commentaire spécifique.
	 * @param int $id L'id du commentaire
	 * @return Comment Object Le commentaire.
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
	 * Obtient tous les commentaires, triés par id d'article et date de publication.
	 * @return Comment objects Les commentaires.
	 */
	public function getAllComments() {
		$result = $this->db->query('SELECT * FROM comments ORDER BY articleId, datePost');
		$listComments = $result->fetchAll(PDO::FETCH_CLASS, "Comment");

		foreach($listComments as $comment) {
			$comment->setDatePost(new DateTime($comment->getDatePost()));
		}
		
		return $listComments;
	}

	/**
	 * Obtient les 5 derniers commentaires, triés par date de publication.
	 * @return Comment objects Les derniers commentaires.
	 */
	public function getLastComments() {
		$result = $this->db->query('SELECT * FROM comments ORDER BY datePost LIMIT 0, 5');
		$lastComments = $result->fetchAll(PDO::FETCH_CLASS, "Comment");

		foreach($lastComments as $comment) {
			$comment->setDatePost(new DateTime($comment->getDatePost()));
		}

		return $lastComments;
	}

	/**
	 * Obtient les commentaires d'un article spécifique, triés par date de publication dans l'ordre décroissant.
	 * @param id $articleId L'id de l'article
	 * @return Comment Objects Les commentaires.
	 */
	public function getComments($articleId) {
		$request = $this->db->prepare('SELECT * FROM comments WHERE parentId = 0 AND articleId = :articleId ORDER BY datePost DESC');
		$request->bindValue(':articleId', $articleId);

		$request->execute();

		$listComments = $request->fetchAll(PDO::FETCH_CLASS, "Comment");

		// On boucle pour obtenir les commentaires enfants et leur assigner une date de publication formatable (DateTime Object).
		foreach($listComments as $comment) {
			$this->getCommentsChildren($comment);
			$comment->setDatePost(new DateTime($comment->getDatePost()));
		}

		$request->closeCursor();

		return $listComments;
	}

	// Méthode récursive privée
	private function getCommentsChildren(Comment $comment) {
		$request = $this->db->prepare('SELECT * FROM comments WHERE parentId = :parentId ORDER BY datePost');
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

	public function deleteAllWithArticle($articleId)
    {
        // 1st level
        $comments = $this->getComments($articleId);
        foreach($comments as $comment) {
            $this->getCommentsChildren($comment);
            
            // 2nd level
            $children = $comment->getSubComments();
            if($children !== null ) {
                foreach ($children as $child) {
                    $this->getCommentsChildren($child);
                    
                    // 3rd level
                    $thirdLevelComs = $child->getSubComments();
                    if($thirdLevelComs !== null) {
                        foreach ($thirdLevelComs as $com) {
                            $this->deleteComment($com->getId());
                        }
                    }
                    $this->deleteComment($child->getId());
                }
            }
            $this->deleteComment($comment->getId());
        }
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