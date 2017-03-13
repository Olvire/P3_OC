<?php

class ProfileController extends Controller {
	public function execute() {
		
		
		$viewProfile = new Profile();
		$viewProfile->display();
	}
}