<?php $baseUrl = Yii::app()->baseUrl; ?>
<div class="ui vertical segment" ng-controller="RegisterController as vm">   
    <div class="ui container">
        <div class="column">
            <div class="ui piled segment">
                <h2 class="ui header">ลงทะเบียน</h2>
                <form class="ui form error big" name="register" action="<?= Yii::app()->createUrl('/site/register') ?>" method="post" enctype="multipart/form-data">                   
                    <div class="fields">
                        <div class="four wide field">
                            <label>รูปภาพของคุณ</label>             
                            <img class="ui image" src="<?= $baseUrl ?>/uploads/profile/default.png" id="imageProfile"/>
                            <input type="file" id="inputProfile" name="picture" accept="image/*" style="display: none;"/>
                            <button  type="button" class="ui button fluid green" id="btnBrowsProfile">เลือกรูปโปรไฟล์ของคุณ</button>
                        </div>
                    </div>
                    <div class="ui error message"></div>                    
                    <div class="fields">
                        <div class="four wide field">
                            <label>ชื่อของคุณ</label>
                            <div class="ui left corner labeled input">
                                <input placeholder="ชื่อของคุณ" type="text" name="name">
                                <div class="ui left corner label red">
                                    <i class="asterisk icon"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="fields">
                        <div class="four wide field">
                            <label>Username เข้าใช้งานระบบ</label>
                            <div class="ui left corner labeled input">
                                <input placeholder="Username เข้าใช้งานระบบ" type="text" name="username">
                                <div class="ui left corner label red">
                                    <i class="asterisk icon"></i>
                                </div>
                            </div>
                        </div>
                        <div class="four wide field">
                            <label>Password เข้าใช้งานระบบ</label>
                            <div class="ui left corner labeled input">
                                <input placeholder="Password เข้าใช้งานระบบ" type="password" name="password_0">
                                <div class="ui left corner label red">
                                    <i class="asterisk icon"></i>
                                </div>
                            </div>
                        </div>
                        <div class="four wide field">
                            <label>Password เข้าใช้งานระบบ ยืนยัน</label>
                            <div class="ui left corner labeled input">
                                <input placeholder="Password เข้าใช้งานระบบ ยืนยัน" type="password" name="password_1">
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
                                <input placeholder="อีเมลล์" type="text" name="email">
                                <div class="ui left corner label red">
                                    <i class="asterisk icon"></i>
                                </div>
                            </div>
                        </div>
                        <div class="four wide field">
                            <label>โทรศัพท์</label>
                            <div class="ui left corner labeled input">
                                <input placeholder="โทรศัพท์" type="text" name="mobile">
                                <div class="ui left corner label red">
                                    <i class="asterisk icon"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <label>ที่อยู่</label>       
                        <div class="ui left corner labeled input">
                            <textarea  rows="3" placeholder="ที่อยู่" name="address"></textarea>
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
                                        <option value="<?= $province['pro_id'] ?>"><?= $province['pro_name'] ?></option>    
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
                                <input placeholder="รหัสไปรษณีย์" type="text" name="zipcode">
                                <div class="ui left corner label red">
                                    <i class="asterisk icon"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="field ui center aligned segment">
                        <button class="ui button green" type="submit">
                            <i class="save icon"></i>
                            ลงทะเบียน
                        </button>
                        <a href="<?= Yii::app()->createUrl('/site/login') ?>" class="ui button orange">
                            <i class="sign in icon"></i>
                            เข้าระบบ
                        </a>
                    </div>
                </form>                
            </div>
        </div>
    </div>
</div>