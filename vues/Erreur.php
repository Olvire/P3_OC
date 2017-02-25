<?php
/**
 * Class for view home.
 */
class ViewError
{
	public function display()
	{
		?>
		<div class="error-container">
			<div class="container">
				<div class="not-found-header">
					<h1>404 - Page non trouvée</h1>
				</div>

				<div class="not-found-content">
					<p>
						C'est l'histoire d'une page qui n'existait pas... Un jour, un internaute, décidément passionné par son auteur préféré, avide de lecture, chercha la mythique page secrète de l'écrivain.
						Pendant plusieurs minutes, il crût l'avoir trouvée. Il se rendit rapidement compte qu'il venait d'attérir au mauvais endroit.

						Pris au dépourvu, attristé, bouleversé d'être arrivé dans un endroit si peu garni d'informations, il chercha une échappatoire.

						L'auteur décida, enthousiaste, d'écrire une phrase dôtée de magie qui lui permettrait de se remettre dans le droit chemin.
					</p>

					<p>&laquo; <a href="index.php">Ouvre cette porte</a>, dit-il, et si tu le peux, évite cette page à l'avenir. &raquo;</p>
				</div>
			</div>
		</div>
		<?php
	}
}