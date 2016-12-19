<?php $baseUrl = Yii::app()->baseUrl; ?>
<?php $accessosyUrl = Yii::app()->getRequest()->getHostInfo() . $baseUrl . '/site/AccessoryDetail/' . $accessosy['acc_id']; ?>
<div class="ui container" ng-controller="AccessoryDetailController as vm">        
    <div id="fb-root"></div>
    <h3 class="ui top attached header">
        <?= $accessosy['acc_name'] ?>
        <div class="fb-like" data-href="<?= $accessosyUrl ?>" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
    </h3>
    <div class="ui attached segment">
        <div class="ui grid">
            <div class="seven wide column">
                <div class="owl-demo">
                    <?php foreach ($pictures as $index => $picture) { ?>
                        <div>
                            <div class="easyzoom easyzoom--overlay">
                                <a href="<?= $baseUrl ?>/uploads/accessory/<?= $picture['pic_name'] ?>">
                                    <img src="<?= $baseUrl ?>/uploads/accessory/<?= $picture['pic_name'] ?>" alt="" class="normal ui image bordered"/>
                                </a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="nine wide column">
                <h3 class="ui top attached header">
                    <?= $accessosy['acc_name'] ?>
                </h3>
                <div class="ui attached segment">
                    <div class="ui stackable two column grid">
                        <div class="column">
                            <h3>ชื่อ</h3>
                            <p> <?= $accessosy['acc_name'] ?></p>
                            <h3>ราคา</h3>
                            <p> <?= $accessosy['acc_price'] ?> บาท</p>
                            <h3>อธิบาย</h3>
                            <p> <?= $accessosy['acc_desc'] ?></p>
                        </div>
                        <div class="column">                            
                            <h3>สถานะ</h3>
                            <p> <?= $accessosy['acc_status'] ?></p>
                            <h3>ลงขายเมื่อ</h3>
                            <p> <?= $accessosy['acc_date_create'] ?></p>          
                            <h3>จบการขายเมื่อ</h3>
                            <p> <?= $accessosy['acc_date_update'] ?></p>          
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
        <div class="fb-comments" data-href="<?= $accessosyUrl ?>" data-numposts="10" data-width="100%" ></div>
    </div>

</div>