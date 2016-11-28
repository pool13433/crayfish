<?php

class SiteController extends Controller {

    public $default = '-- ทั้งหมด --';

    public function actionIndex() {
        $crayfishs = Yii::app()->db->createCommand()
                ->select('c.*,FORMAT(cray_price,0) as cray_price')
                ->from('crayfish c')
                ->order('cray_id DESC')
                ->limit('10')
                ->queryAll();
        $this->render('/site/index', array(
            'crayfishs' => $crayfishs
        ));
    }

    public function actionCrayfishs() {
        $this->render('/site/crayfishs');
    }

    public function actionLogin() {

        $this->render('/login', array(
        ));
    }

    public function actionAccessories() {
        $this->render('/site/accessories', array());
    }

    public function actionLocation() {
        $this->render('/site/location');
    }

    public function actionSalesCrayfish() {
        $this->render('/site/sales-crayfish');
    }

    public function actionRegister() {
        if (empty($_POST)) {
            $provinces = Yii::app()->db->createCommand()
                    ->select('p.*')
                    ->from('province p')
                    ->order('p.pro_name asc')
                    ->queryAll();
            $this->render('/register', array(
                'provinces' => $provinces
            ));
        } else {
            $name = $_POST['name'];
            $username = $_POST['username'];
            $password = $_POST['password_0'];
            $address = $_POST['address'];
            $province = $_POST['province'];
            $zipcode = $_POST['zipcode'];
            $email = $_POST['email'];
            $mobile = $_POST['mobile'];
            $member = new Member();
            $member->mem_address = $address;
            $member->mem_date_create = new CDbExpression('NOW()');
            $member->mem_date_update = new CDbExpression('NOW()');
            $member->mem_email = $email;
            $member->mem_fname = $name;
            $member->mem_lname = 'xxxx';
            $member->mem_username = $username;
            $member->mem_password = $password;
            $member->mem_mobile = $mobile;
            $member->mem_status = 'active';
            $member->mem_privileg = 'customer';
            $member->mem_facebook = '';
            $member->mem_zipcode = $zipcode;
            $member->pro_id = $province;
            $member->lev_id = 1;

            $file = CUploadedFile::getInstanceByName('picture');
            
            if ($file != NULL) {
                $fileNameNew = $member->pro_id . '_' . date('Ymd_His') . '.' . $file->extensionName;
                $isUpload = $file->saveAs(Yii::getPathOfAlias('webroot') . '/uploads/profile/' . $fileNameNew);
                $member->mem_picture = $fileNameNew;
            }

            if ($member->save()) {
                $member = Yii::app()->db->createCommand()
                        ->select('m.*
                            ,(SELECT lev_name FROM member_level ml WHERE ml.lev_id = m.lev_id) as lev_name
                            ,DATE_FORMAT(mem_date_create,\'%d-%m-%Y\') as mem_date_create,DATE_FORMAT(mem_date_update,\'%d-%m-%Y\') as mem_date_update')
                        ->from('member m')
                        ->where('m.mem_id =:memberId', array(':memberId' => $member->mem_id))
                        ->queryRow();
                Yii::app()->SESSION['member'] = $member;
                $this->redirect(array('/site/index'));
            } else {
                var_dump($member->getErrors());
                echo ' save fail';
            }
        }
    }

    public function actionProfile() {
        $member = Yii::app()->SESSION['member'];
        $this->render('/site/profile', array(
            'member' => $member
        ));
    }

    public function actionLogout() {
        unset(Yii::app()->SESSION['member']);
        $this->redirect(array('/site/index'));
    }

    public function actionSalesAccessories() {
        $type = Yii::app()->db->createCommand()
                ->select('t.*')
                ->from('accessories_type t')
                ->queryAll();
        array_unshift($type, array('type_id' => '', 'type_name' => $this->default));

        $this->render('/site/sales-accessories', array('type' => $type));
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

    public function actionDoAccesories($id) {
        
    }

}
