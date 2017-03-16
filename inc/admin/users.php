<div class="page-header">
	<h3>Utilisateurs</h3>
</div>

<h4 class="admin-inscrire">Inscrire un nouvel utilisateur</h4>

<form class="admin-add-user" action="" method="post">

	<p>
		<label for="username">Nom d'utilisateur </label>
		<input class="form-control" type="text" name="signupUsername" required />
	</p>
	
	<p>
		<label for="password">Mot de passe </label>
		<input class="form-control" type="password" name="signupPassword" required />
	</p>

	<p>
		<label for="email">Adresse e-mail </label>
		<input class="form-control" type="email" name="signupEmail">
	</p>
	
	<p>
		<label for="role">Role</label>
		<select class="form-control" name="role" id="role">
			<option value="admin">Administrateur</option>
			<option value="editor">Éditeur</option>
			<option value="author">Auteur</option>
			<option value="subscriber" selected>Abonné</option>
		</select>
	</p>
	
	<p>
		<input class="btn btn-default" type="submit" value="Ajouter" />
	</p>
</form>

<br>

<h4 class="users-list">Liste d'utilisateurs</h4>

<div class="users-list-table table-responsive">
	<table class="table table-striped table-condensed">
		<thead>
			<th>Nom d'utilisateur</th>
			<th>Email</th>
			<th>Rôle</th>
			<th>Date d'inscription</th>
			<th>Action</th>
		</thead>

		<tbody>
			<?php
			foreach($this->listeUsers as $user) {
			?>
				<tr>
					<td><?= $user->getUsername(); ?></td>
					<td><?= $user->getEmail(); ?></td>
					<td><?= $user->getRole(); ?></td>
					<td><?= $user->getDateInscription()->format('d/m/Y'); ?></td>
					<td><a href="">Supprimer</a></td>
				</tr>
			<?php
			}
			?>
		</tbody>
	</table>
</div>