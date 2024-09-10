<?php
function lsdir()   //affiche le contenu du répertoire courant 
{   $chemin = "./"; 
    $rep = opendir( $chemin ); 
    chdir( $chemin ); 
    echo " Cliquez sur le fichier à dézipper <BR>\n"; 
    while ( $file = readdir( $rep ) ) { 
        if ( $file != '..' && $file != '.' && $file != '' ) { 
            if ( ( $file ) ) { 
                echo "<a href=./unzip.php?action=$file target=_blank>$file</a><br>"; 
            } 
        } 
    } 
    closedir( $rep ); 
} 

function unzip ( $file )  //dézippe le fichier passé en paramètre 
{   $zip = new ZipArchive; 
    $zip->open( $file ); 
    $zip->extractTo( './' ); 
    $zip->close(); 
    echo "Ok! $file dézipper <br>"; 
} 
//////////////////     main    ///////////////// 
if ( $_GET['action'] ) { 
    unzip ( $_GET['action'] ) ; 
    lsdir(); 
}else 
    lsdir ();