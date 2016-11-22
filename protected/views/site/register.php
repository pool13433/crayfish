<?php $baseUrl = Yii::app()->baseUrl; ?>
<div class="ui vertical segment" ng-controller="AccessoriesController as vm">   
    <div class="ui container">        
        <div class="ui column grid stackable">
            <div class="three wide column">
                <h5 class="ui top attached header">
                    ค้นหาด้วย ประเภทอุปกรณ์
                </h5>
                <div class="ui attached segment">
                    <div class="ui form">
                        <div class="grouped fields">
                            <div class="field" ng-repeat="type in vm.typeList">
                                <div class="ui radio checkbox">
                                    <input name="type" tabindex="0" type="radio" value="{{type.type_id}}" 
                                           ng-model="vm.type" ng-click="vm.filterEvent()" ng-checked="type.type_id === ''">
                                    <label>{{type.type_name}}</label>
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
                                           ng-model="vm.price" ng-click="vm.filterEvent()" ng-checked="key === '' ">
                                    <label>{{value}}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="thirteen wide column">
                <h2 class="ui dividing header">
                    อุปกรณ์
                </h2>
                <div class="ui four cards stackable">           

                    <div class="ui card" ng-repeat="accesory in vm.accessoryList">
                        <a class="image" href="<?= $baseUrl ?>/site/doAccesories/{{accesory.acc_id}}">
                            <img src="<?= $baseUrl ?>/images/crayfish-dummy.jpg">
                        </a>
                        <div class="content">
                            <a class="header" href="#">{{accesory.acc_name}}</a>
                        </div>
                        <div class="extra content">
                            <span class="left floated like">
                                <i class="money icon"></i>
                                {{accesory.acc_price}}
                            </span>
                            <span class="right floated star">
                                <i class="calendar icon"></i>
                                {{accesory.acc_date_create}}
                            </span>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>