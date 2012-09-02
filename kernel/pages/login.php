<?php
$title = 'Connectez-vous';
	if ( APP_LOGO_PATH != '' ) {
?>
	<div class="logo">
		<img src="<?= APP_LOGO_PATH ?>" alt="Logo" />
	</div>
<?php
	}
?>
<form method="get" class="form-horizontal">
	<legend>Connectez-vous</legend>
	<div class="control-group">
		<label class="control-label" for="user">Identifiant</label>
		<div class="controls">
			<input type="text" id="user" name="user" value="<?= isset( $_GET[ 'user' ] ) ? $_GET[ 'user' ] : '' ?>" />
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="password">Mot de passe</label>
		<div class="controls">
			<input type="password" id="password" name="password" />
		</div>
	</div>
	<div class="control-group">
		<div class="controls">
			<button class="btn" type="submit">Se connecter</button>
		</div>
	</div>
</form>
