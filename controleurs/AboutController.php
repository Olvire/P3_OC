<?php
class AboutController extends Controller {
	public function execute() {
		$aboutDescription = $this->aboutManager->getDescription();

		$viewAbout = new ViewAbout($aboutDescription);
		$viewAbout->display();
	}
}