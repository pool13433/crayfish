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
<?php if (empty(Yii::app()->SESSION['member'])) { ?>
    <div class="right item">
        <a class="ui inverted button" href="<?= $baseUrl ?>/site/login">Log in</a>
        <a class="ui inverted button" href="<?= $baseUrl ?>/site/register">Sign Up</a>    
    </div>
<?php } else { ?>
    <?php $member = Yii::app()->SESSION['member']; ?>
    <div class="ui right dropdown item">
        <?= $member['mem_fname'] ?> <i class="dropdown icon"></i>
        <div class="menu">
            <a class="item" href="<?= Yii::app()->createUrl('/site/profile') ?>"><i class="user icon"></i> Profile</a>
            <div class="divider"></div>
            <a class="item" href="<?= Yii::app()->createUrl('/site/logout') ?>" onclick="return confirm('ยืนยันการออกจากระบบ')"><i class="sign out icon"></i> Logout</a>
        </div>
    </div>
<?php } ?>
