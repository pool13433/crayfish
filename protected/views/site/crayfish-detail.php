<?php $baseUrl = Yii::app()->baseUrl; ?>
<?php $crayfishUrl = Yii::app()->getRequest()->getHostInfo() . $baseUrl . '/site/CrayFishDetail/' . $crayfish['cray_id']; ?>
<div class="ui container" ng-controller="CrayFishDetailController as vm">        
    <div id="fb-root"></div>
    <h3 class="ui top attached header">
        <?= $crayfish['cray_name'] ?>
        <div class="fb-like" data-href="<?= $crayfishUrl ?>" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
    </h3>
    <div class="ui attached segment">
        <div class="ui grid">
            <div class="seven wide column">
                <div class="owl-demo">
                    <?php foreach ($pictures as $index => $picture) { ?>
                        <div>
                            <div class="easyzoom easyzoom--overlay">
                                <a href="<?= $baseUrl ?>/uploads/crayfishs/<?= $picture['pic_name'] ?>">
                                    <img src="<?= $baseUrl ?>/uploads/crayfishs/<?= $picture['pic_name'] ?>" alt="" class="normal ui image bordered"/>
                                </a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="nine wide column">
                <h3 class="ui top attached header">
                    <?= $crayfish['cray_name'] ?>
                </h3>
                <div class="ui attached segment">
                    <div class="ui stackable three column grid">
                        <div class="column">
                            <h3>ชื่อ</h3>
                            <p> <?= $crayfish['cray_name'] ?></p>
                            <h3>ราคา</h3>
                            <p> <?= $crayfish['cray_price'] ?> บาท</p>
                            <h3>สี</h3>
                            <p> <?= $crayfish['cray_color'] ?></p>
                        </div>
                        <div class="column">                            
                            <h3>อายุ</h3>
                            <p> <?= $crayfish['cray_age'] ?> เดือน</p>
                            <h3>อธิบาย</h3>
                            <p> <?= $crayfish['cray_desc'] ?></p>
                            <h3>ลงขายเมื่อ</h3>
                            <p> <?= $crayfish['cray_date_create'] ?></p>             
                        </div>
                        <div class="column">
                            <h3>สถานะ</h3>
                            <p> <?= $crayfish['cray_status'] ?></p>
                            <h3>จบการขายเมื่อ</h3>
                            <p> <?= $crayfish['cray_date_tran'] ?></p>             
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>   
    <h3 class="ui attached header">
        แสดงความคิดเห็น
    </h3>
    <div class="ui attached segment">
        <div class="fb-comments" data-href="<?= $crayfishUrl ?>" data-numposts="10" data-width="100%" ></div>
    </div>

</div>