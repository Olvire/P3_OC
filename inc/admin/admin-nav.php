<!-- Menu de navigation interne à l'administration -->
<ul class="nav nav-tabs admin-nav">

	<!-- Tableau de bord -->
	<li role="presentation" <?php if($this->selectedTab == 'dashboard') echo 'class="active"' ?>>
		<a title="Tableau de bord" href="index.php?p=admin"><i class="fa fa-tachometer fa-lg" aria-hidden="true"></i></a>
	</li>
	
	<!-- Mes articles -->
	<li role="presentation" <?php if($this->selectedTab == 'list') echo 'class="active"' ?>>
		<a title="Mes articles" href="index.php?p=admin&amp;menu=list"><i class="fa fa-file-text-o fa-lg" aria-hidden="true"></i></a>
	</li>
	
	<!-- Écrire -->
	<li role="presentation" <?php if($this->selectedTab == 'write')  echo 'class="active"' ?>>
		<a title="Écrire" href="index.php?p=admin&amp;menu=write"><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></a>
	</li>

	<!-- Commentaires -->
	<li role="presentation" <?php if($this->selectedTab == 'comments') echo 'class="active"' ?>>
		<a title="Commentaires" href="index.php?p=admin&amp;menu=comments"><i class="fa fa-comments-o fa-lg" aria-hidden="true"></i></a>
	</li>

	<!-- Settings -->
	<li role="presentation" <?php if($this->selectedTab == 'settings') echo 'class="active"' ?>>
		<a title="Réglages" href="index.php?p=admin&amp;menu=settings"><i class="fa fa-wrench fa-lg" aria-hidden="true"></i></a>
	</li>
</ul>