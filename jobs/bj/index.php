<?php
    define('ROOT', dirname(__FILE__));

    # вывел все настройки в один файл
    define('CONFIG', require_once(ROOT.'/app/components/config.php'));

    require_once(ROOT.'/app/components/iniSettings.php');

    require_once(ROOT.'/app/core/Model.php');
    require_once(ROOT.'/app/core/View.php');
    require_once(ROOT.'/app/core/Controller.php');
    require_once(ROOT.'/app/core/Router.php');


    require_once(ROOT.'/app/components/database.php');
    require_once(ROOT.'/app/components/escaping.php');
    require_once(ROOT.'/app/components/sessionsManage.php');
    require_once(ROOT.'/app/components/isAccess.php');
    require_once(ROOT.'/app/components/Parsedown.php');
    require_once(ROOT.'/app/components/generateUniqID.php');
    require_once(ROOT.'/app/components/getCommentImage.php');
    require_once(ROOT.'/app/components/httpHandler.php');

    SessionsManage::Set();
    Router::start();
?>
