<?$Parsedown = new Parsedown();?>
<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="/static/css/feedback.css">
<div class="container">
    <h1>Отзывы</h1>
    <div class="row">
        <div id="nav">
            <ul>
                <li>
                    <a href="/">Главная</a>
                </li>
                <?
                    if(CheckUser::isAccess()) :
                ?>
                    <li>
                        <a href="/adminpanel#no_accept_reviews">Админ панель</a>
                    </li>

                <?endif;?>
            </ul>
        </div>
        <div id="sorting_box">
            <ul>
                <li>
                    <button class='sortb' id='sort_by_name' onclick='Sort.byName();'>Имя</button>
                </li>
                <li>
                    <button class='sortb' id='sort_by_email' onclick='Sort.byEmail()'>Email</button>
                </li>
                <li>
                    <button class='sortb' id='sort_by_time' onclick='Sort.byTime()'>Время</button>
                </li>
            </ul>
        </div>
        <div id="wrap_reviews">
                <?
                    for ($i = 0; $i < count($data); $i++):
                        $attah_img = GetComIMG::get($data[$i]['rid']);
                ?>

                        <div class="col-sm" data-name="<?=$data[$i]['name']?>" data-email="<?=$data[$i]['email']?>" data-time="<?=strtotime($data[$i]['time'])?>" data-id="<?=$data[$i]['rid']?>">
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
                                <div class='is_admin_changed'><?=($data[$i]['changed'] ? 'изменено администратором' : '')?></div>
                            </div>
                        </div>
                <? endfor; ?>
            </div>
    </div>

    <div class='row comment'>
        <h3>Оставить отзыв</h3>
        <div id="add_comment">
            <form method='POST' enctype='multipart/form-data' name="send_com">
                <div>
                    <p>
                        <textarea oninput='UI.markdown(this)' class='inp' cols="45" placeholder='начните вводить...' name="txt"></textarea>
                        <div id="img_upload_box">
                                <input onchange='UI.uploadChange(this)' id='img_uploader' style='display: none' type='file' name='file' />
                                <img id='preview_upload_img' width='60' height='60' />
                                <button onclick='UI.uploadClick()' type="button" class="btn btn-default btn-sm">
                                    <span class="glyphicon glyphicon-picture"></span>
                                </button>
                        </div>
                        <ul id='info_comments'>
                            <li>
                                Отзыв будет доступен после проверки админа.
                                Если, конечно, Вы им не являетесь :)
                            </li>
                            <li>
                                Можно использовать Markdown
                            </li>
                        </ul>
                    </p>
                        <div id='markdown_preview'></div>
                </div>
                <p>
                    <input type="text" placeholder='Имя' class="inp name" name="name" />
                    <input type="text" placeholder='Email' class="inp email" name="email" />
                </p>
                <br />
                <p>
                    <input type="submit" name="sub" class="sub_b" value="Отправить отзыв" />
                </p>
            </form>
        </div>
    </div>
    <script type="text/javascript" src=/static/js/markdown.js></script>
    <script type="text/javascript" src=/static/js/feedbackUI.js></script>
    <script type="text/javascript" src=/static/js/sorting.js></script>

    <? if(CheckUser::isAccess()) { ?>
        <link rel="stylesheet" type="text/css" href="/static/css/adminUI.css">
        <script type="text/javascript" src=/static/js/adminUI.js></script>
        <script>Admin.init();</script>
        <script type="text/javascript" src=/static/js/to-markdown.js></script>
    <? } ?>
</div>
