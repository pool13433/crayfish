<?php $baseUrl = Yii::app()->baseUrl; ?>
<!-- Following Menu -->
<div class="ui large top fixed menu transition hidden inverted">
    <div class="ui container mornitor">
        <?php $this->renderPartial('/layouts/me_menu-items'); ?>
    </div>
</div>



<div class="ui vertical inverted sidebar menu left mobile" style="overflow: visible !important;">
    <?php $this->renderPartial('/layouts/me_menu-items-sidebar'); ?>
</div>

<div class="mobile">
    <div class="ui inverted vertical masthead center aligned segment">
        <div class="ui container">
            <div class="ui large secondary inverted pointing menu">
                <a class="toc item">
                    <i class="sidebar icon"></i>
                </a>
            </div>
        </div>
    </div>
</div>


<div class="mornitor">
    <div class="ui inverted vertical masthead center aligned segment">
        <div class="ui container">
            <div class="ui large secondary inverted pointing menu">
                <a class="toc item">
                    <i class="sidebar icon"></i>
                </a>
                <?php $this->renderPartial('/layouts/me_menu-items'); ?>
            </div>
        </div>

    </div>
</div>
