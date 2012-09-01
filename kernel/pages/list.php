<?php

/* This file is part of the KissFile project.
 * KissFile is a free and unencumbered software released into the public domain.
 * For more information, please refer to <http://unlicense.org/>
 */

$files = \UFile\list_relative( DATA_PATH );
echo $file_path . HTML_EOL;
echo '<ul>';
foreach ( $files as $file ) {
	echo '<li><a href="' . $file . '">' . \UFile\name( $file ) . '</a></li>';
}
echo '</ul>';
