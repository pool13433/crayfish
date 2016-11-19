<?php

class SiteController extends Controller {

    public function actionIndex() {
        $crayfishs = Yii::app()->db->createCommand()
                ->select('c.*,FORMAT(cray_price,0) as cray_price')
                ->from('crayfish c')
                ->order('cray_id DESC')
                ->queryAll();
        $this->render('/site/index', array(
            'crayfishs' => $crayfishs
        ));
    }

    public function actionCrayfish($id) {
        $crayfish = Yii::app()->db->createCommand()
                ->select('c.*,FORMAT(cray_price,0) as cray_price,
                        DATE_FORMAT(cray_date_create,\'%d-%m-%Y\') as cray_date_create,
                        DATE_FORMAT(cray_date_tran,\'%d-%m-%Y\') as cray_date_tran
                        ')
                ->from('crayfish c')
                ->where('c.cray_id =:id', array(':id' => $id))
                ->queryRow();
        $this->render('/site/crayfish', array(
            'crayfish' => $crayfish
        ));
    }

}
