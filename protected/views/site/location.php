<?php $baseUrl = Yii::app()->baseUrl; ?>
<style>
    #mapCrayfish {
        width: 100%;
        height: 450px;
    }
</style>
<div class="ui vertical segment" ng-controller="LocationController as vm">   
    <div class="ui container">
        <div class="column">
            <div class="ui piled segment">
                <h4 class="ui header">แหล่ซื้อขาย Crayfish</h4>
                <div class="ui grid">
                    <div class="sixteen wide column">
                        <a class="ui tag label red" ng-repeat="province in vm.provinceList"
                            ng-class="{'red' : vm.provinceId == province.pro_id,'blue' : vm.provinceId != province.pro_id}" ng-click="vm.focusLocation(province.pro_id)">
                            {{province.pro_name}}
                            <div class="floating ui red label">{{province.cnt_place}}</div>
                        </a>                         
                    </div>
                    <div class="sixteen wide column">
                        <div id="mapCrayfish"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>