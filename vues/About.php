<?php
class ViewAbout {
	
	public function display()
	{
	?>
	<div class="about-container">
		<div class="container">
			<h2>À propos</h2>
			<?php
			if(!isset($_POST['about'])) {
				$message = 'Cette page n\'a pas encore été complétée.';
				if(isset($_SESSION['username'])) {
					$message .= ' <a href="index.php?p=admin&amp;menu=settings">Le faire maintenant.</a>';
				}
				echo $message;
			}
			?>
		</div>
	</div>
	<?php
	}

}