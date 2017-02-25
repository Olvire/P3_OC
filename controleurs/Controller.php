<?php
class Controller 
{
	protected $articleManager;
	protected $commentManager;

	public function __construct()
	{
		$this->articleManager = new ArticleManager('blog_ecrivain');
		$this->commentManager = new CommentManager('blog_ecrivain');
	}

}