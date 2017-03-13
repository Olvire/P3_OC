<?php
class ViewAbout {

	private $aboutDescription;

	public function __construct($aboutDescription) {
		$this->aboutDescription = $aboutDescription;
	}
	
	public function display() {
	?>
	<div class="about-container">
		<div class="container">
			<div class="page-header">
				<h2>À propos</h2>
			</div>
			<?php
			if(empty($this->aboutDescription)) {
				$message = 'Cette page n\'a pas encore été complétée.';
				if(isset($_SESSION['username'])) {
					$message .= ' <a href="index.php?p=admin&amp;menu=settings">Le faire maintenant.</a>';
				}
				echo $message;
			} else {
				echo '<p>' . htmlspecialchars($this->aboutDescription) . '</p>';
			}
			?>
		</div>
	</div>
	<?php
	}

}