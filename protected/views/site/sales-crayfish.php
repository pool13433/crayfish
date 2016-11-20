<?php $baseUrl = Yii::app()->baseUrl; ?>
<div class="ui vertical segment" ng-controller="SalesCrayFishController as vm">   
    <div class="ui container">
        <div class="column">
            <div class="ui piled segment">
                <h4 class="ui header">ลงขาย Crayfish</h4>
                <form class="ui equal width form error" name="form-crayfish">
                    <div class="ui error message"></div>
                    <div class="fields">
                        <div class="field">
                            <label>โค๊ดสินค้า</label>
                            <div class="ui left corner labeled input">
                                <input placeholder="โค๊ดสินค้า" type="text" name="code">
                                <div class="ui left corner label">
                                    <i class="asterisk icon"></i>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <label>ชื่อสินค้า</label>
                            <div class="ui left corner labeled input">
                                <input placeholder="ชื่อสินค้า" type="text" name="name">
                                <div class="ui left corner label red">
                                    <i class="asterisk icon"></i>
                                </div>
                            </div>
                        </div>
                        <div class="field"></div>
                    </div>
                    <div class="fields">
                        <div class="field">
                            <label>ราคา</label>
                            <div class="ui left corner labeled input">
                                <input placeholder="ราคา" type="text" name="price">
                                <div class="ui basic label">บาท</div>
                                <div class="ui left corner label red">
                                    <i class="asterisk icon"></i>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <label>สี</label>
                            <div class="ui left corner labeled input">
                                <input placeholder="สี" type="text" name="color">
                                <div class="ui left corner label red">
                                    <i class="asterisk icon"></i>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <label>อายุ</label>
                            <div class="ui left corner labeled input">
                                <input placeholder="หน่วยเป็นเดือน เช่น 4 เดือน" type="text" name="age">
                                <div class="ui basic label">เดือน</div>
                                <div class="ui left corner label red">
                                    <i class="asterisk icon"></i>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="fields">
                        <div class="field">
                            <label>รายละเอียด</label>                            
                            <div class="ui left corner labeled input">
                                <textarea  rows="2" placeholder="โค๊ดสินค้า" name="desc"></textarea>
                                <div class="ui left corner label red">
                                    <i class="asterisk icon"></i>
                                </div>
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