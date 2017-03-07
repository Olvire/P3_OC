<?php

class MentionsController {
	public function execute() {
		$viewMentions = new ViewMentions();
		$viewMentions->display();
	}
}