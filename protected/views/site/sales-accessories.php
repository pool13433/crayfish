<?php $baseUrl = Yii::app()->baseUrl; ?>
<div class="ui vertical segment" ng-controller="SalesAccessoriesController as vm">   
    <div class="ui container">
        <div class="column">
            <div class="ui piled segment">
                <h4 class="ui header">ลงขาย อุปกรณ์</h4>
                <form class="ui form error" name="form-accessories">
                    <div class="ui error message"></div>
                    <div class="fields">
                        <div class="four wide field">
                            <label>โค๊ดสินค้า</label>
                            <div class="ui left corner labeled input">
                                <input placeholder="โค๊ดสินค้า" type="text" name="code">
                                <div class="ui left corner label">
                                    <i class="asterisk icon"></i>
                                </div>
                            </div>
                        </div>
                        <div class="four wide field">
                            <label>ชื่อสินค้า</label>
                            <div class="ui left corner labeled input">
                                <input placeholder="ชื่อสินค้า" type="text" name="name">
                                <div class="ui left corner label red">
                                    <i class="asterisk icon"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="fields">
                        <div class="four wide field">
                            <label>ราคา</label>
                            <div class="ui left corner labeled input">
                                <input placeholder="ราคา" type="text" name="price">
                                <div class="ui basic label">บาท</div>
                                <div class="ui left corner label red">
                                    <i class="asterisk icon"></i>
                                </div>
                            </div>
                        </div>
                        <div class="four wide field">
                            <label>ประเภทอุปกรณ์</label>
                            <div class="ui fluid selection dropdown">
                                <input name="type" type="hidden">
                                <div class="default text">-- เลือก --</div>
                                <i class="dropdown icon"></i>
                                <div class="menu">
                                    <?php foreach ($type as $index => $value) { ?>
                                        <div class="item" data-value="<?= $value['type_id'] ?>"><?= $value['type_name'] ?></div>
                                    <?php } ?>                          
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <label>รายละเอียด</label>                            
                        <div class="ui left corner labeled input">
                            <textarea  rows="2" placeholder="โค๊ดสินค้า" name="desc"></textarea>
                            <div class="ui left corner label red">
                                <i class="asterisk icon"></i>
                            </div>
                        </div>
                    </div>
                    <button class="ui button fluid green" type="submit">
                        <i class="save icon"></i>
                        ประกาศขาย
                    </button>
                </form>                
            </div>
        </div>
    </div>
</div>