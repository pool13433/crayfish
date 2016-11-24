<?php $baseUrl = Yii::app()->baseUrl; ?>
<div class="ui vertical segment" ng-controller="CrayfishsController as vm">   
    <div class="ui container">        
        <div class="ui column grid stackable">
            <div class="three wide column">
                <h5 class="ui top attached header">
                    ค้นหาด้วย อายุกุ้ง
                </h5>
                <div class="ui attached segment">
                    <div class="ui form">
                        <div class="grouped fields">
                            <div class="field" ng-repeat="(key, value) in vm.ageList">
                                <div class="ui radio checkbox">
                                    <input name="age" tabindex="0" type="radio" value="{{key}}" 
                                           ng-model="vm.age" ng-click="vm.filterEvent()" ng-checked="key == ''">
                                    <label>{{value}}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <h5 class="ui attached header">
                    ค้นหาด้วย ช่วงราคา
                </h5>
                <div class="ui attached segment">
                    <div class="ui form">
                        <div class="grouped fields">
                            <div class="field" ng-repeat="(key,value) in vm.priceList">
                                <div class="ui radio checkbox">
                                    <input name="price" tabindex="0" type="radio" value="{{key}}" 
                                           ng-model="vm.price" ng-click="vm.filterEvent()" ng-checked="key === ''">
                                    <label>{{value}}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <h5 class="ui attached header">
                    ค้นหาด้วย สีกุ้ง
                </h5>
                <div class="ui attached segment">
                    <div class="ui form">
                        <div class="grouped fields">
                            <div class="field" ng-repeat="(key, value) in vm.colorList">
                                <div class="ui radio checkbox">
                                    <input name="color" tabindex="0" type="radio" value="{{value}}" 
                                           ng-model="vm.color" ng-click="vm.filterEvent()" ng-checked="key == '0'">
                                    <label>{{value}}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="thirteen wide column">
                <h2 class="ui dividing header">
                    Crayfish
                </h2>
                <div class="ui four cards stackable">           

                    <div class="ui card" ng-repeat="crayfish in vm.crayfishList">
                        <a class="image" href="<?= $baseUrl ?>/site/doCrayFish/{{crayfish.cray_id}}">
                            <img src="<?= $baseUrl ?>/uploads/crayfishs/{{crayfish.cray_picture}}">
                        </a>
                        <div class="content">
                            <a class="header" href="#">{{crayfish.cray_name}}</a>
                        </div>
                        <div class="extra content">
                            <span class="left floated like">
                                <i class="money icon"></i>
                                {{crayfish.cray_price}}
                            </span>
                            <span class="right floated star">
                                <i class="calendar icon"></i>
                                {{crayfish.cray_date_create}}
                            </span>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>