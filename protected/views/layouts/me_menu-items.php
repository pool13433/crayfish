<?php $baseUrl = Yii::app()->baseUrl; ?>
<a class="active item" href="<?= $baseUrl ?>/site/index">หน้าหลัก</a>
<a class="item" href="<?= $baseUrl ?>/site/crayfishs">กุ้ง</a>
<a class="item" href="<?= $baseUrl ?>/site/accessories">อุปกรณ์</a>        
<a class="item" href="<?= $baseUrl ?>/site/location">แหล่งซื้อ-ขาย</a>     
<div class="ui dropdown item">
    ลงขายกับเราสิ
    <i class="dropdown icon"></i>
    <div class="menu">
        <a class="item" href="<?= $baseUrl ?>/site/salesCrayfish">ขาย Crayfish</a>
        <a class="item" href="<?= $baseUrl ?>/site/salesAccessories">ขาย อุปกรณ์</a>
    </div>
</div>
<a class="item">ติดต่อเรา</a>
<a class="item">ลงโฆษณากับเราสิครับบบบบ</a>
<div class="right item">
    <a class="ui inverted button" href="<?= $baseUrl ?>/site/login">Log in</a>
    <a class="ui inverted button" href="<?= $baseUrl ?>/site/register">Sign Up</a>
</div>