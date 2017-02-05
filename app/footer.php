<footer>
	<div class="container">
		<p><?php echo 'Jérôme Butel &copy; ' . date('Y'); ?></p>
		<p class="nothing"></p>
		<?php
		if(isset($_GET['p']) AND $_GET['p'] == 'admin') {
			echo '<p><a href=".?p=home">Home</a></p>';
		} else {
			echo '<p><a href=".?p=admin">Administration</a></p>';
		}
		?> 
	</div>
</footer>