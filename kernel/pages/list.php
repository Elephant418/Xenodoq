<ul>
<?php
$title = 'Liste des fichiers';
$files = \UFile\list_relative( User::$data_path );
foreach ( $files as $file ) {
	echo '<li><a href="' . $file . '">' . \UFile\name( $file ) . '</a></li>';
}
?>
</ul>
