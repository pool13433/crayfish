<?php $baseUrl = Yii::app()->baseUrl; ?>
<div class="ui vertical segment" ng-controller="SalesAccessoriesController as vm">   
    <div class="ui container">
        <div class="column">
            <div class="ui piled segment">
                <h4 class="ui header">ลงขาย อุปกรณ์</h4>
                <form class="ui form error" name="accessories"                      
                      ng-model="vm.crayfish" ng-submit="vm.crayfishSubmit()">
                    <div class="ui error message"></div>
                    <div class="field">
                        <label>รูปภาพของคุณ</label>
                        <div class="ui pointing below red basic label" ng-if="vm.uploadSize == 0">
                            กรุณาgเลือก รูปภาพสินค้า
                        </div>
                        <div class="ui teal message">
                            <div class="dropzone" options="dzOptions" callbacks="dzCallbacks" methods="dzMethods" ng-dropzone></div>
                        </div>
                    </div>
                    <div class="fields">
                        <div class="four wide field">
                            <label>โค๊ดสินค้า</label>
                            <div class="ui pointing below red basic label" ng-if="!accessories.code.$valid">
                                กรุณากรอก รหัสสินค้า
                            </div>
                            <div class="ui left corner labeled input">
                                <input placeholder="โค๊ดสินค้า" type="text" name="code" ng-model="vm.accessories.code" required>
                                <div class="ui left corner label">
                                    <i class="asterisk icon"></i>
                                </div>
                            </div>
                        </div>
                        <div class="four wide field">
                            <label>ชื่อสินค้า</label>
                            <div class="ui pointing below red basic label" ng-if="!accessories.code.$valid">
                                กรุณากรอก ชื่อสินค้า
                            </div>
                            <div class="ui left corner labeled input">
                                <input placeholder="ชื่อสินค้า" type="text" name="name" ng-model="vm.accessories.name" required>
                                <div class="ui left corner label red">
                                    <i class="asterisk icon"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="fields">
                        <div class="four wide field">
                            <label>ราคา</label>
                            <div class="ui pointing below red basic label" ng-if="!accessories.price.$valid">
                                กรุณากรอก ราคาสินค้า เป็นตัวเลขเท่านั้น
                            </div>
                            <div class="ui left corner labeled input">
                                <input placeholder="ราคา" type="number" name="price" ng-model="vm.accessories.price" required>
                                <div class="ui basic label">บาท</div>
                                <div class="ui left corner label red">
                                    <i class="asterisk icon"></i>
                                </div>
                            </div>
                        </div>
                        <div class="four wide field">
                            <label>ประเภทอุปกรณ์</label>
                            <div class="ui pointing below red basic label" ng-if="!accessories.type.$valid">
                                กรุณากรอก ประเภทอุปกรณ์
                            </div>
                            <select class="ui fluid selection dropdown" name="type" ng-model="vm.accessories.type" required>
                                <option value="">-- เลือก --</option>
                                <?php foreach ($type as $index => $value) { ?>
                                    <option value="<?= $value['type_id'] ?>"><?= $value['type_name'] ?></option>
                                <?php } ?>                     
                            </select>
                        </div>
                    </div>
                    <div class="field">
                        <label>รายละเอียด</label>           
                        <div class="ui pointing below red basic label" ng-if="!accessories.desc.$valid">
                            กรุณากรอก รายละเอียด
                        </div>
                        <div class="ui left corner labeled input">
                            <textarea  rows="2" placeholder="โค๊ดสินค้า" name="desc" ng-model="vm.accessories.desc" required></textarea>
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