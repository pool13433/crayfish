<?php $baseUrl = Yii::app()->baseUrl; ?>
<?php $crayfishUrl = Yii::app()->getRequest()->getHostInfo() . $baseUrl . '/site/crayfish/' . $crayfish['cray_id']; ?>
<div class="ui container" ng-controller="CrayfishController as vm">        
    <div id="fb-root"></div>
    <h5 class="ui top attached header">
        Dogs  
        <div class="fb-share-button" 
             data-href="<?= $crayfishUrl ?>" data-layout="button_count" data-size="small" data-mobile-iframe="true">
            <a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">แชร์</a>
        </div>
    </h5>
    <div class="ui attached segment">
        <div class="ui grid">
            <div class="five wide column">
                <div id="owl-demo" class="owl-carousel owl-theme">
                    <div class="item"><img class="ui image bordered" src="<?= $baseUrl ?>/images/crayfish-dummy.jpg"></div>
                    <div class="item"><img class="ui image bordered" src="<?= $baseUrl ?>/images/crayfish-dummy1.jpg"></div>
                    <div class="item"><img class="ui image bordered" src="<?= $baseUrl ?>/images/crayfish-dummy2.jpg"></div>
                    <div class="item"><img class="ui image bordered" src="<?= $baseUrl ?>/images/crayfish-dummy3.jpg"></div>
                    <div class="item"><img class="ui image bordered" src="<?= $baseUrl ?>/images/crayfish-dummy4.jpg"></div>
                </div>
            </div>
            <div class="eleven wide column">
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
    <h5 class="ui attached header">
        แสดงความคิดเห็น
    </h5>
    <div class="ui attached segment">
        <div class="fb-comments" data-href="<?= $crayfishUrl ?>" data-numposts="10" data-width="100%" ></div>
    </div>

</div>