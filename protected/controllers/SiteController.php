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
        if (empty($_POST)) {
            $this->render('/login');
        } else {
            $member = Member::model()->findByAttributes(array(
                'mem_username' => $_POST['username'],
                'mem_password' => md5($_POST['password'])
            ));
            if ($member) {
                Yii::app()->SESSION['member'] = Member::getMemberProfile($member['mem_id']);
                $this->redirect(array('site/index'));
            } else {
                Yii::app()->user->setFlash('error', "ไม่พบข้อมูลผู้เข้าใช้งานในระบบ");
                $this->render('/login');
            }
        }
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
            $member = new Member();
            $member->mem_address = $_POST['address'];
            $member->mem_date_create = new CDbExpression('NOW()');
            $member->mem_date_update = new CDbExpression('NOW()');
            $member->mem_email = $_POST['email'];
            $member->mem_fname = $_POST['name'];
            $member->mem_lname = 'xxxx';
            $member->mem_username = $_POST['username'];
            $member->mem_password = $_POST['password_0'];
            $member->mem_mobile = $_POST['mobile'];
            $member->mem_status = 'active';
            $member->mem_privileg = 'customer';
            $member->mem_facebook = '';
            $member->mem_zipcode = $_POST['zipcode'];
            $member->pro_id = $_POST['province'];
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

    public function actionEditPassword() {
        $session = Yii::app()->session['member'];
        if (empty($_POST)) {
            $this->render('/site/password_form', array(
                'member' => $session
            ));
        } else {
            $mem_id = $session['mem_id'];
            $member = Member::model()->findByPk($mem_id);
            $member->mem_password = $_POST['password_0'];
            if ($member->save()) {
                $member = Member::getMemberProfile($mem_id);
                Yii::app()->session['member'] = $member;
                $this->redirect(array('/site/profile'));
            } else {
                Yii::app()->user->setFlash('error', "ไม่สามารถแก้ไขรหัสผ่านได้ กรุณาติดต่อเจ้าหน้าที่ดูแลระบบ");
                $this->render('/site/password_form', array(
                    'member' => $session
                ));
            }
        }
    }

    public function actionEditProfile() {
        $provinces = Yii::app()->db->createCommand()
                ->select('p.*')
                ->from('province p')
                ->order('p.pro_name asc')
                ->queryAll();
        if (empty($_POST)) {
            $this->render('/site/profile_form', array(
                'member' => Yii::app()->session['member'],
                'provinces' => $provinces
            ));
        } else {
            $session = Yii::app()->session['member'];
            $mem_id = $session['mem_id'];

            $member = Member::model()->findByPk($mem_id);
            $member->mem_address = $_POST['address'];
            $member->mem_date_update = new CDbExpression('NOW()');
            $member->mem_email = $_POST['email'];
            $member->mem_fname = $_POST['name'];
            $member->mem_mobile = $_POST['mobile'];
            $member->mem_zipcode = $_POST['zipcode'];
            $member->pro_id = $_POST['province'];
            if ($member->save()) {
                $member = Member::getMemberProfile($mem_id);
                Yii::app()->session['member'] = $member;
                $this->redirect(array('/site/profile'));
            } else {
                Yii::app()->user->setFlash('error', "ไม่สามารถแก้ไขข้อมูลส่วนตัวได้ กรุณาติดต่อเจ้าหน้าที่ดูแลระบบ");
                $this->render('/site/profile_form', array(
                    'member' => Yii::app()->session['member'],
                    'provinces' => $provinces
                ));
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

    public function actionCrayFishDetail($id) {
        $crayfish = Yii::app()->db->createCommand()
                ->select('c.*,FORMAT(cray_price,0) as cray_price,
                        DATE_FORMAT(cray_date_create,\'%d-%m-%Y\') as cray_date_create,
                        DATE_FORMAT(cray_date_tran,\'%d-%m-%Y\') as cray_date_tran
                        ')
                ->from('crayfish c')
                ->where('c.cray_id =:id', array(':id' => $id))
                ->queryRow();

        $pictures = Yii::app()->db->createCommand()
                ->select('p.*')
                ->from('crayfish_picture p')
                ->where('p.cray_id =:crayId', array(':crayId' => $id))
                ->queryAll();

        $this->render('/site/crayfish-detail', array(
            'crayfish' => $crayfish,
            'pictures' => $pictures
        ));
    }

    public function actionAccessoryDetail($id) {
        $accessosy = Yii::app()->db->createCommand()
                ->select('a.*')
                ->from('accessories a')
                ->where('a.acc_id =:id', array(':id' => $id))
                ->queryRow();

        $pictures = Yii::app()->db->createCommand()
                ->select('p.*')
                ->from('accessories_picture p')
                ->where('p.acc_id =:accId', array(':accId' => $id))
                ->queryAll();

        $this->render('/site/accessories-detail', array(
            'accessosy' => $accessosy,
            'pictures' => $pictures
        ));
    }

    public function actionFanpage() {
        $this->render('/site/fanpage');
    }

}
