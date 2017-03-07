<?php
class Controller 
{
	protected $articleManager;
	protected $commentManager;
	private $db_host;
	private $db_name;
	private $db_user;
	private $db_pass;

	public function __construct() {
		$this->db_host = 'localhost';
		$this->db_name = 'blog_ecrivain';
		$this->db_user = 'root';
		$this->db_pass = 'root';
		$db = new PDO('mysql:host=' . $this->db_host . ';dbname=' . $this->db_name . ';charset=utf8', $this->db_user, $this->db_pass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		$this->articleManager = new ArticleManager($db);
		$this->commentManager = new CommentManager($db);
		$this->userManager = new UserManager($db);
	}

}