<?php

class LoginController extends Controller {
	
	public function execute() {

		$viewLogin = new ViewLogin();
		$viewLogin->display();
	}

}