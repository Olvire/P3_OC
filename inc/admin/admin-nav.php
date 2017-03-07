<ul class="nav nav-tabs admin-nav">
	<li role="presentation" <?php if($this->selectedTab == 'dashboard') echo 'class="active"' ?>>
		<a href="index.php?p=admin"><i class="fa fa-tachometer" aria-hidden="true"></i> Tableau de bord</a>
	</li>
	<li role="presentation" <?php if($this->selectedTab == 'list') echo 'class="active"' ?>>
		<a href="index.php?p=admin&amp;menu=list"><i class="fa fa-file-text-o" aria-hidden="true"></i> Mes articles</a>
	</li>
	<li role="presentation" <?php if($this->selectedTab == 'write')  echo 'class="active"' ?>>
		<a href="index.php?p=admin&amp;menu=write"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Écrire</a>
	</li>
	<li role="presentation" <?php if($this->selectedTab == 'comments') echo 'class="active"' ?>>
		<a href="index.php?p=admin&amp;menu=comments"><i class="fa fa-comments-o" aria-hidden="true"></i> Commentaires</a>
	</li>
	<li role="presentation" <?php if($this->selectedTab == 'settings') echo 'class="active"' ?>>
		<a href="index.php?p=admin&amp;menu=settings"><i class="fa fa-wrench" aria-hidden="true"></i> Réglages</a>
	</li>
</ul>