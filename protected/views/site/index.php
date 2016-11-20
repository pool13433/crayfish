<?php $baseUrl = Yii::app()->baseUrl; ?>
<div class="ui vertical segment">   
    <div class="ui container">        
        <h2 class="ui dividing header">
            สุดยอด Crayfish
        </h2>
        <div class="ui five cards stackable">
            <?php foreach ($crayfishs as $index => $cray) { ?>
                <div class="ui card">
                    <a class="image" href="<?=$baseUrl?>/site/doCrayFish/<?=$cray['cray_id']?>">
                        <div class="ui red ribbon label">
                            <i class="hotel icon"></i> Hotel
                        </div>
                        <img src="<?= $baseUrl ?>/images/crayfish-dummy.jpg">
                    </a>
                    <div class="content">
                        <a class="header" href="#"><?= $cray['cray_name'] ?></a>
                    </div>
                    <div class="extra content">
                        <span class="left floated like">
                            <i class="money icon"></i>
                            <?= $cray['cray_price'] ?>
                        </span>
                        <span class="right floated star">
                            <i class="calendar icon"></i>
                            <?= $cray['cray_date_create'] ?>
                        </span>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<div class="ui vertical segment">
    <div class="ui container">        
        <div class="ui stackable two column grid">
            <div class="column">
                <h2 class="ui dividing header">
                    Crayfish Top 10
                </h2>
                <div class="ui three cards stackable">
                    <?php foreach ($crayfishs as $index => $cray) { ?>
                        <div class="ui card">
                            <a class="image" href="#">
                                <div class="ui blue ribbon label">
                                    <i class="hotel icon"></i> Hotel
                                </div>
                                <img src="<?= $baseUrl ?>/images/crayfish-dummy.jpg">
                            </a>
                            <div class="content">
                                <a class="header" href="#"><?= $cray['cray_name'] ?></a>
                            </div>
                            <div class="extra content">
                                <span class="left floated like">
                                    <i class="money icon"></i>
                                    <?= $cray['cray_price'] ?>
                                </span>
                                <span class="right floated star">
                                    <i class="calendar icon"></i>
                                    <?= $cray['cray_date_create'] ?>
                                </span>
                            </div>
                        </div>
                    <?php } ?>
                </div>

            </div>
            <div class="column">
                <h2 class="ui dividing header">
                    Crayfish มาใหม่
                </h2>
                <div class="ui three cards stackable">
                    <?php foreach ($crayfishs as $index => $cray) { ?>
                        <div class="ui card">
                            <a class="image" href="#">
                                <div class="ui orange ribbon label">
                                    <i class="hotel icon"></i> Hotel
                                </div>
                                <img src="<?= $baseUrl ?>/images/crayfish-dummy.jpg">
                            </a>
                            <div class="content">
                                <a class="header" href="#"><?= $cray['cray_name'] ?></a>
                            </div>
                            <div class="extra content">
                                <span class="left floated like">
                                    <i class="money icon"></i>
                                    <?= $cray['cray_price'] ?>
                                </span>
                                <span class="right floated star">
                                    <i class="calendar icon"></i>
                                    <?= $cray['cray_date_create'] ?>
                                </span>
                            </div>
                        </div>
                    <?php } ?>
                </div>

            </div>
        </div>

    </div>
</div>