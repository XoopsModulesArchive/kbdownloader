<?php

include '../../mainfile.php';
require_once $xoopsConfig['root_path'] . 'class/xoopsmodule.php';
require_once $xoopsConfig['root_path'] . 'class/xoopsgroup.php';
$xoopsModule = XoopsModule::getByDirname('kbdownloader');
if (!$xoopsModule) {
    redirect_header($xoopsConfig['xoops_url'] . '/', 2, _MODULENOEXIST);

    exit();
}
if ($xoopsUser) {
    if (!XoopsGroup::hasAccessRight($xoopsModule->mid(), $xoopsUser->groups())) {
        redirect_header($xoopsConfig['xoops_url'] . '/', 2, _NOPERM);

        exit();
    }
} else {
    if (!XoopsGroup::hasAccessRight($xoopsModule->mid(), 0)) {
        redirect_header($xoopsConfig['xoops_url'] . '/', 2, _NOPERM);

        exit();
    }
}

if (file_exists($xoopsConfig['root_path'] . 'modules/kbdownloader/language/' . $xoopsConfig['language'] . '/modinfo.php')) {
    include $xoopsConfig['root_path'] . 'modules/kbdownloader/language/' . $xoopsConfig['language'] . '/modinfo.php';
} else {
    include $xoopsConfig['root_path'] . 'modules/kbdownloader/language/english/modinfo.php';
}

echo ' <center><strong><a href="' . $xoopsConfig['xoops_url'] . '/admin.php"> Menu da Administração </a></strong></center> ';
