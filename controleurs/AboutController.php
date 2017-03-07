<?php
class AboutController extends Controller {
	public function execute() {
		$viewAbout = new ViewAbout();
		$viewAbout->display();
	}
}