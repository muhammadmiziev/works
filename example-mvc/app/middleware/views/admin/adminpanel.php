<?$Parsedown = new Parsedown();?>
<link rel="stylesheet" href="/static/css/admin-panel.css">

<div class="admin-panel clearfix">
    <div class="slidebar">
        <div class="logo">
            <a href=""></a>
        </div>
        <ul>
            <li><a href="#no_accept_reviews" id="targeted">Непринятые</a></li>
        </ul>
        <!-- <hr> -->
        <br><br>
        <ul>
            <li style="text-align: center;"><b>Навигация</b></li>
            <li><a href="/">Главная</a></li>
            <li><a href="/feedback">Отзывы</a></li>
        </ul>

    </div>
    <div class="main">
        <div class="mainContent clearfix">
            <div class='slider' id="no_accept_reviews">
                <h2 class="header">Не принятые отзывы</h2>

                <div id="review_box">
                        <?
                            for ($i = 0; $i < count($data); $i++):
                                $attah_img = GetComIMG::get($data[$i]['rid']);
                        ?>
                            <div class="col-sm" data-id="<?=$data[$i]['rid']?>">
                                <button onclick="Admin.acceptReview(this)" class="accept_review">Принять!</button>
                                <div class="panel panel-white post panel-shadow">
                                    <div class="post-heading">
                                        <div class="pull-left image">
                                            <img src="http://gravatar.com/avatar/<?=md5($data[$i]['email'])?>?s=60&d=identicon" class="img-circle avatar" alt="user profile image">
                                        </div>
                                        <div class="pull-left meta">
                                            <div class="title h5">
                                                <a href="#"><b><?=$data[$i]['name']?></b></a>
                                            </div>
                                            <h6 class="text-muted time"><?=$data[$i]['time']?></h6>
                                        </div>
                                    </div>
                                    <div class="post-description">
                                            <?=$Parsedown->text(htmlspecialchars($data[$i]['txt']))?>
                                    </div>
                                    <div class="attah">
                                        <?=($attah_img) ? "<img src={$attah_img} />" : ''?>
                                    </div>
                                    <div class='is_admin_changed'><?=($data[$i]['changed'] ? 'изменен Вами' : '')?></div>
                                </div>
                            </div>
                        <? endfor; ?>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <link rel="stylesheet" type="text/css" href="/static/css/adminUI.css">
    <script type="text/javascript" src=/static/js/adminUI.js></script>
    <script>Admin.init();</script>
    <script type="text/javascript" src=/static/js/to-markdown.js></script>
