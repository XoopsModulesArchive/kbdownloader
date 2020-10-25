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

function showallb()
{
    //show the files in the list upto 10 items

    global $xoopsDB, $xoopsConfig, $xoopsTheme, $xoopsUser;

    include $xoopsConfig['root_path'] . 'modules/kbdownloader/config-block.php';

    $block = [];

    $block['title'] = _MB_KBDOWNLOADER_NAME;

    $myts = new MyTextSanitizer();

    $block['content'] = '<div align="left">';

    $handle = opendir($xoopsConfig['root_path'] . 'modules/kbdownloader/files/');

    $num = 0;

    while (false !== ($file = readdir($handle))) {
        if ('.' != $file && '..' != $file) {
            if (mb_strlen($file) > 20) {
                $file_o = mb_substr((string)$file, 0, 20);
            } else {
                $file_o = $file;
            }

            $block['content'] .= "<a href=\"javascript:openWithSelfMain('" . $xoopsConfig['xoops_url'] . "/modules/kbdownloader/files/$file','File',450,350);\"> $file_o </a> <br>";
        }

        if (_MB_KBDOWNLOADER_NUMFILESDIS == $num) {
            break;
        }

        $num++;
    }

    closedir($handle);

    $block['content'] .= '</div><br><br>';

    return $block;
}
