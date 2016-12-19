<?php $baseUrl = Yii::app()->baseUrl; ?>
<div class="ui vertical segment" ng-controller="AccessoriesController as vm">   
    <div class="ui container">        
        <div class="ui column grid stackable">
            <div class="three wide column">
                <div class="ui vertical accordion menu fluid">
                    <div class="item">
                        <a class="title">
                            <i class="dropdown icon"></i>
                            ค้นหาด้วย ประเภทอุปกรณ์ 
                            <span class="ui blue basic label">{{vm.findCriteriaName().typeName(vm.type)}}</span>
                        </a>
                        <div class="content">
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
                    </div>
                    <div class="item">
                        <a class="title">
                            <i class="dropdown icon"></i>
                            ค้นหาด้วย ช่วงราคา 
                            <span class="ui blue basic label">{{vm.findCriteriaName().priceName(vm.price)}}</span>
                        </a>
                        <div class="content">
                            <div class="ui form">
                                <div class="grouped fields">
                                    <div class="field" ng-repeat="(key, value) in vm.priceList">
                                        <div class="ui radio checkbox">
                                            <input name="price" tabindex="0" type="radio" value="{{key}}" 
                                                   ng-model="vm.price" ng-click="vm.filterEvent()" ng-checked="key === ''">
                                            <label>{{value}}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="thirteen wide column">
                <div class="ui clearing segment top attached">
                    <div class="ui left floated">
                        <h2>อุปกรณ์เลี้ยงกุ้ง</h2>
                    </div>
                    <div class="ui right floated">
                        <div class="ui floating labeled icon dropdown button basic blue" id="ddFilter">
                            <i class="filter icon"></i>
                            <span class="text">เรียงข้อมูล</span>
                            <div class="menu">
                                <div class="header">
                                    <i class="tags icon"></i>
                                    จัดเรียงข้อมูลด้วย
                                </div>
                                <div class="item" ng-repeat="(key,value) in vm.filterCrayfishList" 
                                     data-value="{{key}}" data-text="{{value}}">
                                    {{value}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ui attached segment">
                    <div class="ui four cards stackable">           

                        <div class="ui card" ng-repeat="accesory in vm.accessoryList" ng-cloak>
                            <a class="image" href="<?= $baseUrl ?>/site/AccessoryDetail/{{accesory.acc_id}}" target="_blank">
                                <img src="<?= $baseUrl ?>/uploads/accessory/{{accesory.acc_picture}}">
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
</div>