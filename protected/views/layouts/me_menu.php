<?php $baseUrl = Yii::app()->baseUrl; ?>
<!-- Following Menu -->
<div class="ui large top fixed menu transition hidden inverted">
    <div class="ui container">
        <?php $this->renderPartial('/layouts/me_menu-items');?>
    </div>
</div>



<div class="ui vertical inverted sidebar menu left">
    <?php $this->renderPartial('/layouts/me_menu-items');?>
</div>

<div class="ui inverted vertical masthead center aligned segment">

    <div class="ui container">
        <div class="ui large secondary inverted pointing menu">
            <a class="toc item">
                <i class="sidebar icon"></i>
            </a>
            <?php $this->renderPartial('/layouts/me_menu-items');?>
        </div>
    </div>

    <!--    <div class="ui text container">
            <h1 class="ui inverted header">
                Imagine-a-ลงขายกับเราสิ
            </h1>
            <h2>Do whatever you want when you want to.</h2>
            <div class="ui huge primary button">Get Started <i class="right arrow icon"></i></div>
        </div>-->

</div>