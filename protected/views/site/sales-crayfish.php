<?php $baseUrl = Yii::app()->baseUrl; ?>
<div class="ui vertical segment" ng-controller="SalesCrayFishController as vm">   
    <div class="ui container">
        <div class="column">
            <div class="ui piled segment">
                <h4 class="ui header">ลงขาย Crayfish</h4>
                <form class="ui equal width form error" name="crayfish"  
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
                        <div class="field">
                            <label>โค๊ดสินค้า</label>
                            <div class="ui pointing below red basic label" ng-if="!crayfish.code.$valid">
                                กรุณากรอก รหัสสินค้า
                            </div>
                            <div class="ui left corner labeled input">
                                <input placeholder="โค๊ดสินค้า" type="text" name="code" ng-model="vm.crayfish.code" required>
                                <div class="ui left corner label">
                                    <i class="asterisk icon"></i>
                                </div>
                            </div>                        
                        </div>
                        <div class="field">
                            <label>ชื่อสินค้า</label>
                            <div class="ui pointing below red basic label" ng-if="!crayfish.name.$valid">
                                กรุณากรอก ชื่อสินค้า
                            </div>
                            <div class="ui left corner labeled input">
                                <input placeholder="ชื่อสินค้า" type="text" name="name" ng-model="vm.crayfish.name" required>
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
                            <div class="ui pointing below red basic label" ng-if="!crayfish.price.$valid">
                                กรุณากรอก ราคาสินค้า เป็นตัวเลขเท่านั้น
                            </div>
                            <div class="ui left corner labeled input">
                                <input placeholder="ราคา" type="number" name="price" ng-model="vm.crayfish.price" required>
                                <div class="ui basic label">บาท</div>
                                <div class="ui left corner label red">
                                    <i class="asterisk icon"></i>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <label>สี</label>
                            <div class="ui pointing below red basic label" ng-if="!crayfish.color.$valid">
                                กรุณากรอก สีสินค้า
                            </div>
                            <div class="ui left corner labeled input">
                                <input placeholder="สี" type="text" name="color" ng-model="vm.crayfish.color" required>
                                <div class="ui left corner label red">
                                    <i class="asterisk icon"></i>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <label>อายุ</label>
                            <div class="ui pointing below red basic label" ng-if="!crayfish.age.$valid">
                                กรุณากรอก อายุสินค้า เป็นตัวเลขเท่านั้น
                            </div>
                            <div class="ui left corner labeled input">
                                <input placeholder="หน่วยเป็นเดือน เช่น 4 เดือน" type="number" name="age" ng-model="vm.crayfish.age" required>
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
                            <div class="ui pointing below red basic label" ng-if="!crayfish.desc.$valid">
                                กรุณากรอก รายละเอียดสินค้า
                            </div>
                            <div class="ui left corner labeled input">
                                <textarea  rows="2" placeholder="โค๊ดสินค้า" name="desc" ng-model="vm.crayfish.desc" required></textarea>
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