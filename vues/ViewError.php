<?php
/**
 * Classe pour la vue Error
 */
class ViewError {
	
	/**
	 * Se charge d'afficher le contenu de la vue.
	 */
	public function display() {
		?>

		<div class="error-container">
			<div class="container">
				<div class="page-header">
					<h4>Cette page n'a pas encore été écrite.</h4>
				</div>

				<p>Je me demande quelle page du livre vous vous attendiez à découvrir en cherchant "<strong><?= $_GET['p']; ?></strong>".</p>
			</div>
		</div>
		
		<?php
	}
}