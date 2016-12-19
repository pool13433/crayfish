<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController {

    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '//layouts/me_column';

    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();

    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();

    protected function beforeAction($action) {
        $baseUrl = Yii::app()->baseUrl;
        if (parent::beforeAction($action)) {

            $cs = Yii::app()->clientScript;
            $cs->registerCssFile($baseUrl . '/plugins/semantic-ui-css/semantic.css');               
            $cs->registerCssFile($baseUrl . '/css/crayfish.css');               
            $cs->registerCssFile($baseUrl . '/plugins/owl-carousel-1.3.3/owl.carousel.min.css');
            $cs->registerCssFile($baseUrl . '/plugins/owl-carousel-1.3.3/owl.theme.min.css');
            $cs->registerCssFile($baseUrl . '/plugins/owl-carousel-1.3.3/owl.transitions.min.css');         
            $cs->registerCssFile($baseUrl . '/node_modules/dropzone/dist/dropzone.css');            
            $cs->registerCssFile($baseUrl . '/node_modules/ngdropzone/dist/ng-dropzone.min.css');                        
            $cs->registerCssFile($baseUrl . '/node_modules/easyzoom-mp/css/easyzoom.css');     
            
            $cs->registerScriptFile($baseUrl . '/node_modules/jquery/dist/jquery.min.js', CClientScript::POS_END);            
            $cs->registerScriptFile($baseUrl . '/node_modules/angular/angular.min.js', CClientScript::POS_END);            
            $cs->registerScriptFile($baseUrl . '/plugins/semantic-ui-css/semantic.min.js', CClientScript::POS_END);
            
            $cs->registerScriptFile($baseUrl . '/plugins/owl-carousel-1.3.3/owl.carousel.min.js', CClientScript::POS_END);
            $cs->registerScriptFile($baseUrl . '/node_modules/lodash/lodash.min.js', CClientScript::POS_END);
            $cs->registerScriptFile($baseUrl . '/node_modules/ng-facebook/ngFacebook.js', CClientScript::POS_END);
            $cs->registerScriptFile($baseUrl . '/node_modules/dropzone/dist/dropzone.js', CClientScript::POS_END);
            $cs->registerScriptFile($baseUrl . '/node_modules/ngdropzone/dist/ng-dropzone.min.js', CClientScript::POS_END);     
            $cs->registerScriptFile($baseUrl . '/node_modules/easyzoom-mp/dist/easyzoom.js', CClientScript::POS_END);     
            $cs->registerScriptFile('https://maps.googleapis.com/maps/api/js?key='.Yii::app()->params['API_KEY'], CClientScript::POS_END);            
            
            $cs->registerScriptFile($baseUrl . '/js/app.js', CClientScript::POS_END);
            $cs->registerScriptFile($baseUrl . '/js/app.factory.js', CClientScript::POS_END);
            $cs->registerScriptFile($baseUrl . '/js/app.service.js', CClientScript::POS_END);
            $cs->registerScriptFile($baseUrl . '/js/app.controller.js', CClientScript::POS_END);


            return true;
        }
        return false;
    }

}

