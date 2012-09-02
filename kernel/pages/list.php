<ul class="breadcrumb">
<?php 
	$uri = URI;
	\UString\must_not_ends_with( $uri, '/' );
	$parts = explode( '/', $uri );
	foreach ( $parts as $key => $part ) {
		$name = $part ? $part : 'Racine';
		if ( $key == count( $parts ) - 1 ) {
?>
	<li class="active"><?= $name ?></li>
<?php
		} else {
?>
	<li>
		<a href="/<?= implode( '/', array_slice( $parts, 1, $key ) ) ?>"><?= $name ?></a>
		<span class="divider">/</span>
	</li>
<?php
		}
	}
?>
</ul>
<table class="table">
	<thead>
		<tr>
			<th width="20"></th>
			<th>Nom du fichier</th>
			<th>Taille</th>
			<th>Date</th>
		</tr>
	</thead>
	<tbody>
<?php
if ( count( $parts ) > 1 ) {
?>
	<tr>
		<td><img src="/icon/folder.png" alt="folder icon" /></td>
		<td><a href="/<?= implode( '/', array_slice( $parts, 1, count( $parts ) - 2 ) ) ?>">..</a></td>
		<td></td>
		<td></td>
	</tr>
<?php
}
$title = 'Liste des fichiers';
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
