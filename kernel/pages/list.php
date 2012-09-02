<table class="table">
	<thead>
		<tr>
			<th></th>
			<th>Nom du fichier</th>
			<th>Taille</th>
			<th>Date</th>
		</tr>
	</thead>
	<tbody>
<?php
$title = 'Liste des fichiers';
if ( URI != '/' ) {
?>
	<tr>
		<td><img src="/icon/folder.png" alt="folder icon" /></td>
		<td><a href="<?= dirname( URI ) ?>"><i>Dossier parent</i></a></td>
		<td></td>
		<td></td>
	</tr>
<?php
}
$files = \UFile\list_folder( User::$data_path );
$today = gmdate( 'd M Y', time( ) );
foreach ( $files as $file ) {
	$type = \UFile\type( $file );
	$href = substr( $file, strlen( User::$root_path ) );
	if ( $type == 'folder' ) {
		$date = '';
		$size = '';
	} else {
		$date = gmdate( 'd M Y', filemtime( $file ) );
		if ( $date == $today ) {
			$date = gmdate( 'H:i:s', filemtime( $file ) );
		}
		$size = \UFile\format_size( $file );
	}
?>
	<tr>
		<td><img src="/icon/<?= $type ?>.png" alt="<?= $type ?> icon" /></td>
		<td><a href="<?= $href ?>"><?= \UFile\name( $file ) ?></a></td>
		<td><?= $size ?></td>
		<td><?= $date ?></td>
	</tr>
<?php
}
?>
	</tbody>
</table>
