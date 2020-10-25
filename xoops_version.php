<?php

$modversion['name'] = _MI_KBDOWNLOADER_NAME;
$modversion['version'] = 0.1;
$modversion['description'] = _MI_KBDOWNLOADER_DESC;
$modversion['credits'] = 'Kyle Buttress<br>( http://www.pchost.com.au/kyle )';
$modversion['author'] = 'Kyle Buttress<br>( http://www.pchost.com.au/kyle )';
$modversion['help'] = '../modules/kbdownloader/kbdownloader.html';
$modversion['license'] = 'GPL see LICENSE';
$modversion['official'] = 1;
$modversion['image'] = 'kbdownloader.jpg';
$modversion['dirname'] = 'kbdownloader';

// Admin things
$modversion['hasAdmin'] = 1;
$modversion['adminpath'] = 'admin/index.php';

// Blocks
$modversion['blocks'][1]['file'] = 'gallery.php';
$modversion['blocks'][1]['name'] = _MI_KBDOWNLOADER_NAME;
$modversion['blocks'][1]['description'] = _MB_KBDOWNLOADER_DESC;
$modversion['blocks'][1]['show_func'] = 'showallb';

// Menu
$modversion['hasMain'] = 1;
