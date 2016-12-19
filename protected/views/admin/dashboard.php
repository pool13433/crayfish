
<div class="ui vertical segment">   
    <div class="ui container">        
        <h5 class="ui top attached header">
            Dashboard
        </h5>
        <div class="ui attached segment">
            <div class="ui four cards stackable">
                <?php foreach ($menus as $index => $menu) { ?>
                    <div class="ui card <?= $menu['color'] ?>">
                        <div class="content">
                            <div class="header"><?= $menu['name'] ?></div>
                        </div>
                        <div class="content">
                            <div class="ui small feed">
                                <div class="event">
                                    <div class="content">
                                        <p><?= $menu['desc'] ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="extra content">
                            <a class="ui button fluid <?= $menu['color'] ?>" href="<?= Yii::app()->createUrl($menu['href']) ?>">จัดการ</a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>