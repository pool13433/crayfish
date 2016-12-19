<?php $baseUrl = Yii::app()->baseUrl; ?>
<div class="ui vertical segment" ng-controller="PasswordController as vm">   
    <div class="ui container">
        <div class="column">
            <div class="ui piled segment">
                <h2 class="ui header">ลงทะเบียน</h2>
                <?php if (Yii::app()->user->hasFlash('error')) { ?>
                    <div class="ui warning message">
                        <i class="close icon"></i>
                        <div class="header">
                            <?php echo Yii::app()->user->getFlash('error'); ?>
                        </div>                        
                    </div>
                <?php } ?>
                <form class="ui form error big" name="password" action="<?= Yii::app()->createUrl('/site/EditPassword') ?>" method="post">                   
                    <div class="ui error message"></div>           
                    <div class="fields">
                        <div class="four wide field">
                            <label>Password เดิม</label>
                            <div class="ui left corner labeled input">
                                <input type="hidden" name="password_old_0" value="<?= $member['mem_password'] ?>">
                                <input placeholder="Password เข้าใช้งานระบบ" type="password" name="password_old_1">
                                <div class="ui left corner label red">
                                    <i class="asterisk icon"></i>
                                </div>
                            </div>
                        </div>
                    </div>   
                    <div class="fields">
                        <div class="four wide field">
                            <label>Password ใหม่</label>
                            <div class="ui left corner labeled input">
                                <input placeholder="Password เข้าใช้งานระบบ" type="password" name="password_0">
                                <div class="ui left corner label red">
                                    <i class="asterisk icon"></i>
                                </div>
                            </div>
                        </div>
                        <div class="four wide field">
                            <label>Password ไหม่ อีกครั้ง</label>
                            <div class="ui left corner labeled input">
                                <input placeholder="Password เข้าใช้งานระบบ ยืนยัน" type="password" name="password_1">
                                <div class="ui left corner label red">
                                    <i class="asterisk icon"></i>
                                </div>
                            </div>
                        </div>
                    </div>   
                    <div class="field ui center aligned segment">
                        <button class="ui button green" type="submit">
                            <i class="save icon"></i>
                            เปลี่ยนรหัสผ่าน
                        </button>
                        <a href="<?= Yii::app()->createUrl('/site/profile') ?>" class="ui button orange">
                            <i class="sign in icon"></i>
                            ยกเลิก
                        </a>
                    </div>
                </form>                
            </div>
        </div>
    </div>
</div>