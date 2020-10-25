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
/*

TRADUÇÃO: COMUNIDADE XOOPERS TOTAL
      WWW.XOOPERS.COM.BR
*/

include '../../mainfile.php';
include '../../header.php';
global $xoopsDB, $xoopsConfig, $xoopsTheme, $xoopsUser;

require_once 'admin_header.php';
require_once $xoopsConfig['root_path'] . 'class/module.textsanitizer.php';

include($xoopsConfig['root_path'] . 'header.php');

include 'header.php';

function showall()
{
    global $xoopsDB, $xoopsConfig, $xoopsTheme, $xoopsUser;

    //get a dirlisting from the preselected download directory

    echo '<br><center>';

    echo '<h2>';

    echo 'Downloads <img src="kbdownloader.jpg" border=0 valign=middle><br><br>';

    echo 'Listando Arquivos<br><br>';

    echo '</h2></center><br>';

    $fp = $xoopsConfig['root_path'] . 'modules/kbdownloader/files/';

    $handle = opendir($fp);

    while (false !== ($file = readdir($handle))) {
        if ('.' != $file && '..' != $file) {
            echo "<a href=\"files/$file\"> $file </a> <br>";
        }
    }

    echo '<table align=center border=0>';

    echo '<tr>';

    echo '<td>';

    echo '<form name="uploader" enctype="multipart/form-data" method=post action=index.php><br>';

    echo 'Please select a file to upload.<br><br>';

    echo '<input type="file" name=ufn value=""><br><br>';

    echo 'Please leave a suitable comment.<br><br>';

    echo '<input type="text" name=ufn_comment value=""><br><br>';

    echo '<br>';

    echo '<br><input type="submit" name="submit" value="Upload File">';

    echo '<input type="hidden" name="op" value="FileUploader">';

    echo '</form>';

    echo '</td>';

    echo '</tr>';

    echo '</table>';
}

function showsingle($kbdownid)
{
    echo "show all files --> $kbdownid <--";
}

function main($kbdownid)
{
    global $xoopsDB, $xoopsConfig, $xoopsTheme, $xoopsUser;

    echo '<br>';

    OpenTable();

    if ('' == $kbdownid) {
        showall();
    } else {
        showsingle($kbdownid);
    }

    CloseTable();
}

switch ($op) {
        case 'FileUploader':
        if (copy($ufn, $xoopsConfig['root_path'] . "modules/kbdownloader/files/$ufn_name")) {
            echo '<br><br>';

            echo "Arquivo $ufn_name foi enviado corretamente<br><br>";

            echo 'Enviar outros arquivos <a href="index.php?op=Upload"> Sim </a> <a href="' . $xoopsConfig['xoops_url'] . '/admin.php"> Não </a>';
        } else {
            echo "Arquivo $ufn_name não foi enviado";

            echo 'Enviar outros arquivos <a href="index.php?op=Upload"> Sim </a> <a href="' . $xoopsConfig['xoops_url'] . '/admin.php"> Não </a>';
        }
                break;
    default:
                main($kbdownid);
                break;
}

include '../../footer.php';



