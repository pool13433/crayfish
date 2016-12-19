<?php $baseUrl = Yii::app()->baseUrl; ?>
<div class="ui vertical segment" ng-controller="EditProfileController as vm">   
    <div class="ui container">
        <div class="column">
            <div class="ui piled segment">
                <h2 class="ui header">แก้ไขข้อมูลส่วนตัว</h2>
                <?php if (Yii::app()->user->hasFlash('error')) { ?>
                    <div class="ui warning message">
                        <i class="close icon"></i>
                        <div class="header">
                            <?php echo Yii::app()->user->getFlash('error'); ?>
                        </div>                        
                    </div>
                <?php } ?>
                <form class="ui form error big" name="profile" action="<?= Yii::app()->createUrl('/site/EditProfile') ?>" method="post" enctype="multipart/form-data">                   
                    <div class="ui error message"></div>                    
                    <div class="fields">
                        <div class="four wide field">
                            <label>ชื่อของคุณ</label>
                            <div class="ui left corner labeled input">
                                <input placeholder="ชื่อของคุณ" type="text" name="name" value="<?= $member['mem_fname'] ?>">
                                <div class="ui left corner label red">
                                    <i class="asterisk icon"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="fields">
                        <div class="four wide field">
                            <label>อีเมลล์</label>
                            <div class="ui left corner labeled input">
                                <input placeholder="อีเมลล์" type="text" name="email" value="<?= $member['mem_email'] ?>">
                                <div class="ui left corner label red">
                                    <i class="asterisk icon"></i>
                                </div>
                            </div>
                        </div>
                        <div class="four wide field">
                            <label>โทรศัพท์</label>
                            <div class="ui left corner labeled input">
                                <input placeholder="โทรศัพท์" type="text" name="mobile" value="<?= $member['mem_mobile'] ?>">
                                <div class="ui left corner label red">
                                    <i class="asterisk icon"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <label>ที่อยู่</label>       
                        <div class="ui left corner labeled input">
                            <textarea  rows="3" placeholder="ที่อยู่" name="address"><?= $member['mem_address'] ?></textarea>
                            <div class="ui left corner label red">
                                <i class="asterisk icon"></i>
                            </div>
                        </div>
                    </div>
                    <div class="fields">
                        <div class="four wide field">
                            <label>จังหวัด</label>
                            <div class="ui left corner labeled input">
                                <select class="ui dropdown" name="province">
                                    <?php foreach ($provinces as $index => $province) { ?>
                                        <?php if ($province['pro_id'] == $member['pro_id']) { ?>
                                            <option value="<?= $province['pro_id'] ?>" selected><?= $province['pro_name'] ?></option>   
                                        <?php } else { ?>
                                            <option value="<?= $province['pro_id'] ?>"><?= $province['pro_name'] ?></option>   
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                                <div class="ui left corner label red">
                                    <i class="asterisk icon"></i>
                                </div>
                            </div>
                        </div>
                        <div class="four wide field">
                            <label>รหัสไปรษณีย์</label>
                            <div class="ui left corner labeled input">
                                <input placeholder="รหัสไปรษณีย์" type="text" name="zipcode" value="<?= $member['mem_zipcode'] ?>">
                                <div class="ui left corner label red">
                                    <i class="asterisk icon"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="field ui center aligned segment">
                        <button class="ui button green" type="submit">
                            <i class="save icon"></i>
                            แก้ไขข้อมูล
                        </button>
                        <a href="<?= Yii::app()->createUrl('/site/profile') ?>" class="ui button orange">
                            <i class="sign in icon"></i>
                            กลับไปหน้าข้อมูลส่วนตัว
                        </a>
                    </div>
                </form>                
            </div>
        </div>
    </div>
</div>