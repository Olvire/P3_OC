<?php

class AdminController
{
	public function execute()
	{
		$viewAdmin = new ViewAdmin();
		$viewAdmin->display();
	}
}