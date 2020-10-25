<?php

/*
   kbdownloader - a module for the xoops to allow registered users
   to upload files at will.

   Copyright (C) 2002 Kyle Buttress
   kyle@pchost.com.au
   www.pchost.com.au/kyle


   This program is free software; you can redistribute it and/or modify
   it under the terms of the GNU General Public License as published by
   the Free Software Foundation; either version 2 of the License, or
   (at your option) any later version.

   This program is distributed in the hope that it will be useful,
   but WITHOUT ANY WARRANTY; without even the implied warranty of
   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
   GNU General Public License for more details.

   You should have received a copy of the GNU General Public License
   along with this program; if not, write to the Free Software
   Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

require_once 'admin_header.php';
require_once $xoopsConfig['root_path'] . 'class/module.textsanitizer.php';

global $xoopsDB, $xoopsConfig, $xoopsTheme, $xoopsUser;
include($xoopsConfig['root_path'] . 'header.php');
$xoopsModule->printAdminMenu();

function EditKBDownloader()
{
    echo '<br><br>';

    //	echo "<a href=\"index.php?op=Configure\">" . _AM_KBDOWNLOADER_CONFIGURE . "</a>";

    //	echo "<br><br>";

    echo '<a href="index.php?op=Upload">' . _AM_KBDOWNLOADER_UPLOAD . '</a>';

    echo '<br><br>';

    echo '<a href="index.php?op=RemoveFiles">' . _AM_KBDOWNLOADER_REMOVE . '</a>';

    echo '<br><br>';
}

function Delete($filename)
{
    //remove the file from the server admins only

    global $xoopsDB, $xoopsConfig, $xoopsTheme, $xoopsUser;

    include($xoopsConfig['root_path'] . '/modules/kbdownloader/config-module.php');

    unlink($xoopsConfig['root_path'] . "modules/kbdownloader/files/$filename");

    echo '<br>';

    echo '<table align=center border=0>';

    echo '<tr>';

    echo '<td>';

    echo "Arquivo $filename foi removido corretamente<br><br>";

    echo 'Remover outros arquivos <a href="index.php?op=RemoveFiles"> Sim </a> <a href="' . $xoopsConfig['xoops_url'] . '/admin.php"> Não </a>';

    echo '</td>';

    echo '</tr>';

    echo '</table';
}

function RemoveFiles()
{
    echo '<br><center>';

    echo '<h2>';

    echo 'Downloader <img src="kbdownloader.jpg" border=0 valign=middle><br><br>';

    echo 'Listando Arquivos<br><br>';

    echo '</h2></center><br>';

    $fp = $xoopsConfig['root_path'] . 'modules/kbdownloader/files/';

    $handle = opendir($fp);

    while (false !== ($file = readdir($handle))) {
        if ('.' != $file && '..' != $file) {
            echo '<a href="' . $xoopsConfig['xoops_url'] . "index.php?op=Delete&filename=$file\"> $file </a> <br>";
        }
    }
}

function Upload()
{
    global $xoopsDB, $xoopsConfig, $xoopsTheme, $xoopsUser;

    include($xoopsConfig['root_path'] . '/modules/kbdownloader/config-module.php');

    echo '<form name="uploader" enctype="multipart/form-data" method=post action=index.php><br>';

    echo 'Por gentileza, selecione o arquivo para enviar.<br><br>';

    echo '<input type="file" name=ufn value=""><br><br>';

    echo 'Por gentileza, deixe um comentário.<br><br>';

    echo '<input type="text" name=ufn_comment value=""><br><br>';

    echo '<br>';

    echo '<br><input type="submit" name="submit" value="Arquivos enviados">';

    echo '<input type="hidden" name="op" value="FileUploader">';

    echo '</form>';
}

function Configure()
{
    global $xoopsDB, $xoopsConfig, $xoopsTheme, $xoopsUser;

    include($xoopsConfig['root_path'] . '/modules/kbdownloader/config-module.php');

    echo '<form name="formgaleria" method=post action=index.php ><br>';

    echo _AM_KBDOWNLOADER_ANCHOCARPETA . '<br>';

    echo '<input type="text" name="AnchoCarpeta" value = ' . $ANCHOCARPETA . ' ><br>';

    echo _AM_KBDOWNLOADER_ALTOCARPETA . '<br>';

    echo '<input type="text" name="AltoCarpeta" value = ' . $ALTOCARPETA . ' ><br>';

    echo _AM_KBDOWNLOADER_FOTOSANCHO . '<br>';

    echo '<input type="text" name="FotosAncho" value = ' . $FOTOSANCHO . ' ><br>';

    echo _AM_KBDOWNLOADER_FOTOSALTO . '<br>';

    echo '<input type="text" name="FotosAlto" value = ' . $FOTOSALTO . ' ><br>';

    echo _AM_KBDOWNLOADER_PERMISIONSFILES . '<br>';

    echo '<input type="text" name="PermitirFicheros" value = ' . $PERMITIRENVIARFICHEROS . ' ><br>';

    echo _AM_KBDOWNLOADER_PERMISIONSCOMMENT . '<br>';

    echo '<input type="text" name="PermitirComentarios" value = ' . $PERMITIRENVIARCOMENTARIOS . ' ><br>';

    echo _AM_KBDOWNLOADER_PERMISIONSVOTES . '<br>';

    echo '<input type="text" name="PermitirVotaciones" value = ' . $PERMITIRENVIARVOTACIONES . ' ><br>';

    echo _AM_KBDOWNLOADER_HEADERSTART . '<br>';

    echo '<textarea name="CabeceraInicio" cols="60" rows="3">' . $KBDOWNLOADERHEADERSTART . '</textarea><br>';

    echo _AM_KBDOWNLOADER_HEADEREND . '<br>';

    echo '<textarea name="CabeceraFin" cols="60" rows="3">' . $KBDOWNLOADERAHEADEREND . '</textarea><br>';

    echo _AM_KBDOWNLOADER_FOOTSTART . '<br>';

    echo '<textarea name="PieInicio" cols="60" rows="3">' . $KBDOWNLOADERFOOTSTART . '</textarea><br>';

    echo _AM_KBDOWNLOADER_FOOTEND . '<br>';

    echo '<textarea name="PieFin" cols="60" rows="3">' . $KBDOWNLOADERAFOOTEND . '</textarea><br>';

    echo _AM_KBDOWNLOADER_PREVIOUS . '<br>';

    echo '<input type="text" name="Anterior" value = ' . $KBDOWNLOADERAPREVIOUS . ' ><br>';

    echo _AM_KBDOWNLOADER_NEXT . '<br>';

    echo '<input type="text" name="Siguiente" value = ' . $KBDOWNLOADERANEXT . ' ><br>';

    echo _AM_KBDOWNLOADER_HEADERBACKGROUNDCOLOR . '<br>';

    echo '<input type="text" name="ColorEncabezado" value = ' . $COLORENCABEZADOCOMENTARIO . ' ><br>';

    echo _AM_KBDOWNLOADER_COMMENTBACKGROUNDCOLOR . '<br>';

    echo '<input type="text" name="ColorComentario" value = ' . $COLORCOMENTARIO . ' ><br>';

    echo '<br>';

    echo '<br><input type="submit" name="submit" value="' . _AM_KBDOWNLOADER_CHANGES . '">';

    echo '<input type="hidden" name="op" value="Changes">';

    echo '</form>';
}

function Changes($AnchoCarpeta, $AltoCarpeta, $FotosAncho, $FotosAlto, $PermitirFicheros, $PermitirComentarios, $PermitirVotaciones, $CabeceraInicio, $CabeceraFin, $PieInicio, $PieFin, $PieFin, $Anterior, $Siguiente, $ColorEncabezado, $ColorComentario)
{
    echo $Galeria;

    global $xoopsDB, $xoopsConfig, $xoopsTheme, $xoopsUser;

    $nombrefichero = '../config-module.php';

    fwrite($fichero, "<?php\n");

    fwrite($fichero, '$' . 'ANCHOCARPETA= "' . $AnchoCarpeta . "\";\n");

    fwrite($fichero, '$' . 'ALTOCARPETA= "' . $AltoCarpeta . "\";\n");

    fwrite($fichero, '$' . 'FOTOSANCHO= "' . $FotosAncho . "\";\n");

    fwrite($fichero, '$' . 'FOTOSALTO= "' . $FotosAlto . "\";\n");

    fwrite($fichero, '$' . 'PERMITIRENVIARFICHEROS= "' . $PermitirFicheros . "\";\n");

    fwrite($fichero, '$' . 'PERMITIRENVIARCOMENTARIOS= "' . $PermitirComentarios . "\";\n");

    fwrite($fichero, '$' . 'PERMITIRENVIARVOTACIONES= "' . $PermitirVotaciones . "\";\n");

    fwrite($fichero, '$' . 'KBDOWNLOADERHEADERSTART= "' . $CabeceraInicio . "\";\n");

    fwrite($fichero, '$' . 'KBDOWNLOADERAHEADEREND= "' . $CabeceraFin . "\";\n");

    fwrite($fichero, '$' . 'KBDOWNLOADERFOOTSTART= "' . $PieInicio . "\";\n");

    fwrite($fichero, '$' . 'KBDOWNLOADERAFOOTEND= "' . $PieFin . "\";\n");

    fwrite($fichero, '$' . 'KBDOWNLOADERAPREVIOUS= "' . $Anterior . "\";\n");

    fwrite($fichero, '$' . 'KBDOWNLOADERANEXT= "' . $Siguiente . "\";\n");

    fwrite($fichero, '$' . 'COLORENCABEZADOCOMENTARIO= "' . $ColorEncabezado . "\";\n");

    fwrite($fichero, '$' . 'COLORCOMENTARIO= "' . $ColorComentario . "\";\n");

    fwrite($fichero, '?' . ">\n");

    fclose($fichero);
}

function escribevacio($fichero, $carpeta)
{
    global $xoopsDB, $xoopsConfig, $xoopsTheme, $xoopsUser;

    if ($fp2 = fopen('../images/' . $carpeta . '/description/' . $fichero . '.txt', 'ab')) {
        fwrite($fp2, 'Descrição    	' . "\n");

        fwrite($fp2, 'Visitas    	0' . "\n");

        fwrite($fp2, 'Data' . date('j, m, Y') . "\n");

        fwrite($fp2, 'Comentários	0' . "\n");

        fwrite($fp2, 'Enviado	     ' . "\n");

        fwrite($fp2, 'Votos    	0' . "\n");

        fwrite($fp2, 'Classificação	0' . "\n");

        fclose($fp2);
    }
}

switch ($op) {
    case 'Upload':
        Upload();
        break;
    case 'FileUploader':
    if (copy($ufn, $xoopsConfig['root_path'] . "modules/kbdownloader/files/$ufn_name")) {
        echo '<br><br>';

        echo "Arquivos $ufn_name foi enviado corretamente<br><br>";

        echo 'Enviar outros arquivos <a href="index.php?op=Upload"> Sim </a> <a href="' . $xoopsConfig['xoops_url'] . '/admin.php"> Não </a>';
    } else {
        echo "Arquivo $ufn_name não foi enviado";

        echo 'Enviar outros arquivos <a href="index.php?op=Upload"> Sim </a> <a href="' . $xoopsConfig['xoops_url'] . '/admin.php"> Não </a>';
    }
        break;
    case 'ConfigureBlock':
        ConfigureBlock();
        break;
    case 'RemoveFiles':
        RemoveFiles();
        break;
    case 'Delete':
        Delete($filename);
        break;
    case 'Configure':
        Configure();
        break;
    default:
        EditKBDownloader();
        break;
}
OpenTable();
CloseTable();

include 'admin_footer.php';
