<form method="get">
	<input type="text" name="user" value="<?= isset( $_GET[ 'user' ] ) ? $_GET[ 'user' ] : '' ?>" /><br>
	<input type="password" name="password" /><br>
	<button type="submit">Se connecter</button>
</form>
