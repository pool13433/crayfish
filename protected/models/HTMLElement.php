<?php
class HTMLElement{
    
    public static function dialog($id,$data,$redirect){
        return '
                <div class="ui modal" id="'.$id.'">
                    <i class="close icon"></i>
                    <div class="header">
                      '.$data['title'].'
                    </div>
                    <div class="content">
                        '.$data['message'].'
                    </div>
                    <div class="actions">                      
                      <div class="ui button" ng-click="">ปิด</div>
                    </div>
                  </div>
        ';
    }
    
}