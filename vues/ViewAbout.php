<?php
/**
 * Classe pour la vue About
 */
class ViewAbout {

	private $aboutDescription;

	public function __construct($aboutDescription) {
		$this->aboutDescription = $aboutDescription;
	}
	
	/**
	 * Se charge d'afficher le contenu de la vue.
	 */
	public function display() {
	?>

	<div class="about-container">
		<div class="container">
			<div class="page-header">
				<h3>À propos</h3>
			</div>
			<?php
			// Si l'administrateur n'a pas encore fourni de description, on affiche un message.
			if(empty($this->aboutDescription)) {
				$message = '<p>Cette page n\'a pas encore été complétée.</p>';
				if(isset($_SESSION['username']) AND $_SESSION['username'] == 'Jean') {
					$message .= ' <p><a href="index.php?p=admin&amp;menu=settings">Le faire maintenant.</a></p>';
				}
				echo $message;

			// Sinon, on affiche la description fournie.
			} else {
				echo $this->aboutDescription;
			}
			?>
		</div>
	</div>
	<?php
	}

}