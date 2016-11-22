<?php

class SiteController extends Controller {
    
     public $default = '-- ทั้งหมด --';

    public function actionIndex() {
        $crayfishs = Yii::app()->db->createCommand()
                ->select('c.*,FORMAT(cray_price,0) as cray_price')
                ->from('crayfish c')
                ->order('cray_id DESC')
                ->limit('5')
                ->queryAll();
        $this->render('/site/index', array(
            'crayfishs' => $crayfishs
        ));
    }

    public function actionCrayfishs() {
        
        $this->render('/site/crayfishs', array(                        
        ));
    }
    
    public function actionAccessories(){
        $this->render('/site/accessories',array());
    }
    
    public function actionSalesCrayfish(){
        $this->render('/site/sales-crayfish',array());
    }

    public function actionRegister(){
        $this->render('/site/register',array());
    }
    
    public function actionSalesAccessories(){
         $type = Yii::app()->db->createCommand()
                ->select('t.*')
                ->from('accessories_type t')
                ->queryAll();
         array_unshift($type, array('type_id' => '', 'type_name' => $this->default));
         
        $this->render('/site/sales-accessories',array('type' => $type));
    }

    public function actionDoCrayFish($id) {
        $crayfish = Yii::app()->db->createCommand()
                ->select('c.*,FORMAT(cray_price,0) as cray_price,
                        DATE_FORMAT(cray_date_create,\'%d-%m-%Y\') as cray_date_create,
                        DATE_FORMAT(cray_date_tran,\'%d-%m-%Y\') as cray_date_tran
                        ')
                ->from('crayfish c')
                ->where('c.cray_id =:id', array(':id' => $id))                
                ->queryRow();
        $this->render('/site/docrayfish', array(
            'crayfish' => $crayfish
        ));
    }
    
    public function actionDoAccesories($id){
        
    }

}
