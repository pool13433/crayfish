<?php

class AdminController extends Controller {

    public $status = array('active' => 'เปิดการใช้งาน', 'inactive' => 'ปิดการใช้งาน');

    public function actionDashboard() {
        $menus = array(
            array('code' => 'member', 'name' => 'ผู้ใช้งาน', 'desc' => 'จัดการ Member', 'href' => '/admin/members', 'color' => 'green', 'icon' => 'users icon'),
            array('code' => 'accessory', 'name' => 'อุปกรณ์', 'desc' => 'จัดการ อุปกรณ์', 'href' => '/admin/accessories', 'color' => 'red', 'icon' => 'archive icon'),
            array('code' => 'accessory type', 'name' => 'ประเภทอุปกรณ์', 'desc' => 'จัดการ ประเภทอุปกรณ์', 'href' => '/admin/accessoriesType', 'color' => 'blue', 'icon' => 'sitemap icon'),
            array('code' => 'crayfish', 'name' => 'crayfish', 'desc' => 'จัดการ กุ้ง Crayfish', 'href' => '/admin/crayfishs', 'color' => 'pink', 'icon' => 'shopping bag icon'),
            array('code' => 'location', 'name' => 'สถานที่', 'desc' => 'จัดการ Location', 'href' => '/admin/locations', 'color' => 'orange', 'icon' => 'marker icon'),
            array('code' => 'member level', 'name' => 'ระดับผู้ใช้งาน', 'desc' => 'จัดการ Member Level', 'href' => '/admin/membersLevel', 'color' => 'teal', 'icon' => 'line chart icon'),
        );
        $this->render('/admin/dashboard', array(
            'menus' => $menus
        ));
    }

    public function actionMembers() {
        $dataProvider = new CActiveDataProvider('Member');
        $this->render('/admin/members', array(
            'dataProvider' => $dataProvider
        ));
    }

    public function actionMember($id = null) {
        if (empty($id)) {
            $model = new Member();
        } else {
            $model = Member::model()->findByPk($id);
        }
        $provinces = Province::model()->findAll(array('order' => 'pro_name asc'));
        $status = $this->status;
        $privilegs = array('admin' => 'Administrator', 'customer' => 'ลูกค้า', 'employee' => 'พนักงาน');
        $this->render('/admin/member', array(
            'member' => $model,
            'provinces' => $provinces,
            'status' => $status,
            'privilegs' => $privilegs
        ));
    }

    public function actionMemberSave() {
        
    }

    public function actionMemberDelete($id) {
        if (!empty($id)) {
            if (Member::model()->deleteByPk($id)) {
                $this->redirect(array('/admin/members'));
            }
        }
    }

    public function actionAccessories() {
        $criteria = new CDbCriteria;
        $criteria->with = array('accessoriesType');
        $dataProvider = new CActiveDataProvider('Accessories', array(
            'criteria' => array(
                'with' => array('accessoriesType')
            ),
            'sort' => array(
                'attributes' => array(
                    'accessoriesType.type_name' => array(
                        'asc' => 'accessoriesType.type_name',
                        'desc' => 'accessoriesType.type_name DESC',
                    ),
                    '*',
                ),
            ),
        ));
        $this->render('/admin/accessories', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAccessory($id = null) {
        if (empty($id)) {
            $accessory = new Accessories();
        } else {
            $accessory = Accessories::model()->findByPk($id);
        }
        $status = $this->status;
        $types = AccessoriesType::model()->findAll(array('order' => 'type_name ASC'));
        $this->render('/admin/accessory', array(
            'accessory' => $accessory,
            'status' => $status,
            'types' => $types
        ));
    }

    public function actionAccessorySave() {
        if (!empty($_POST)) {
            $model = $_POST['model'];
            if (empty($model['id'])) {
                $acc = new Accessories();
            } else {
                $acc = Accessories::model()->findByPk($model['id']);
            }
            $acc->acc_name = $model['name'];
            $acc->acc_status = $model['status'];
            $acc->acc_desc = $model['desc'];
            //$acc->acc_picture = 'zxxx';
            $acc->acc_price = $model['price'];
            $acc->type_id = $model['type'];
            $acc->acc_date_create = new CDbExpression('NOW()');
            $acc->acc_date_update = new CDbExpression('NOW()');
            $acc->mem_id = Yii::app()->SESSION['member']['mem_id'];
            if ($acc->save()) {
                Yii::app()->user->setFlash('success', "บันทึกข้อมูล เรียบร้อยแล้ว");
            } else {
                Yii::app()->user->setFlash('error', "ไม่สามารถ บันทึกข้อมูลได้ กรุณาติดต่อเจ้าหน้าที่ดูแลระบบ");
            }
            $this->redirect(array('/admin/accessories'));
        }
    }

    public function actionAccessoryDelete($id) {
        if (Accessories::model()->deleteByPk($id)) {
            Yii::app()->user->setFlash('success', "ลบข้อมูล เรียบร้อยแล้ว");
        } else {
            Yii::app()->user->setFlash('error', "ไม่สามารถ ลบข้อมูลได้ กรุณาติดต่อเจ้าหน้าที่ดูแลระบบ");
        }
        $this->redirect(array('/admin/Accessories'));
    }

    public function actionAccessoriesType() {
        $dataProvider = new CActiveDataProvider('AccessoriesType');
        $this->render('/admin/accessoriesType', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAccessoryType($id = null) {
        if (empty($id)) {
            $type = new AccessoriesType();
        } else {
            $type = AccessoriesType::model()->findByPk($id);
        }
        $status = $this->status;
        $this->render('/admin/accessoryType', array(
            'type' => $type,
            'status' => $status,
        ));
    }

    public function actionAccessoryTypeSave() {
        if (!empty($_POST)) {
            $model = $_POST['model'];
            if (empty($model['id'])) {
                $type = new AccessoriesType();
            } else {
                $type = AccessoriesType::model()->findByPk($model['id']);
            }
            $type->type_name = $model['name'];
            $type->type_status = $model['status'];
            $type->type_desc = $model['desc'];
            $type->type_date_create = new CDbExpression('NOW()');
            if ($type->save()) {
                Yii::app()->user->setFlash('success', "บันทึกข้อมูล เรียบร้อยแล้ว");
            } else {
                Yii::app()->user->setFlash('error', "ไม่สามารถ บันทึกข้อมูลได้ กรุณาติดต่อเจ้าหน้าที่ดูแลระบบ");
            }
            $this->redirect(array('/admin/accessoriesType'));
        }
    }

    public function actionAccessoryTypeDelete($id) {
        if (AccessoriesType::model()->deleteByPk($id)) {
            Yii::app()->user->setFlash('success', "ลบข้อมูล เรียบร้อยแล้ว");
        } else {
            Yii::app()->user->setFlash('error', "ไม่สามารถ ลบข้อมูลได้ กรุณาติดต่อเจ้าหน้าที่ดูแลระบบ");
        }
        $this->redirect(array('/admin/MembersLevel'));
    }

    public function actionCrayfishs() {
        $dataProvider = new CActiveDataProvider('Crayfish');
        $this->render('/admin/Crayfishs', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionCrayfish($id = null) {
        if (empty($id)) {
            $crayfish = new Crayfish();
        } else {
            $crayfish = Crayfish::model()->findByPk($id);
        }
        $status = $this->status;
        $this->render('/admin/Crayfish', array(
            'crayfish' => $crayfish,
            'status' => $status
        ));
    }

    public function actionCrayfishSave() {
        if (!empty($_POST)) {
            $model = $_POST['model'];
            if (empty($model['id'])) {
                $crayfish = new Crayfish();
            } else {
                $crayfish = Crayfish::model()->findByPk($model['id']);
            }
            $crayfish->cray_age = $model['age'];
            $crayfish->cray_code = $model['code'];
            $crayfish->cray_color = $model['color'];
            $crayfish->cray_date_create = new CDbExpression('NOW()');
            $crayfish->cray_date_tran = new CDbExpression('NOW()');
            $crayfish->cray_desc = $model['desc'];
            $crayfish->cray_name = $model['name'];
            //$crayfish->cray_picture = 'xxx';
            $crayfish->cray_price = $model['price'];
            $crayfish->cray_status = $model['status'];
            $crayfish->mem_id = Yii::app()->SESSION['member']['mem_id'];
            if ($crayfish->save()) {
                Yii::app()->user->setFlash('success', "บันทึกข้อมูล เรียบร้อยแล้ว");
            } else {
                Yii::app()->user->setFlash('error', "ไม่สามารถ บันทึกข้อมูลได้ กรุณาติดต่อเจ้าหน้าที่ดูแลระบบ");
            }
            $this->redirect(array('/admin/crayfishs'));
        }
    }

    public function actionCrayfishDelete($id) {
        if (Crayfish::model()->deleteByPk($id)) {
            Yii::app()->user->setFlash('success', "ลบข้อมูล เรียบร้อยแล้ว");
        } else {
            Yii::app()->user->setFlash('error', "ไม่สามารถ ลบข้อมูลได้ กรุณาติดต่อเจ้าหน้าที่ดูแลระบบ");
        }
        $this->redirect(array('/admin/Crayfishs'));
    }

    public function actionLocations() {
        $criteria = new CDbCriteria;
        $criteria->with = array('province');
        $dataProvider = new CActiveDataProvider('CrayfishPlace', array(
            'criteria' => array(
                'with' => array('province')
            ),
            'sort' => array(
                'attributes' => array(
                    'province.pro_name' => array(
                        'asc' => 'province.pro_name',
                        'desc' => 'province.pro_name DESC',
                    ),
                    '*',
                ),
            ),
        ));
        $this->render('/admin/locations', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionLocation($id = null) {
        if (empty($id)) {
            $location = new CrayfishPlace();
        } else {
            $location = CrayfishPlace::model()->findByPk($id);
        }
        $status = $this->status;
        $provinces = Province::model()->findAll(array('order' => 'pro_name ASC'));
        $this->render('/admin/location', array(
            'location' => $location,
            'status' => $status,
            'provinces' => $provinces
        ));
    }

    public function actionLocationSave() {
        if (!empty($_POST)) {
            $model = $_POST['model'];
            if (empty($model['id'])) {
                $location = new CrayfishPlace();
            } else {
                $location = CrayfishPlace::model()->findByPk($model['id']);
            }
            $location->pla_desc = $model['desc'];
            $location->pla_title = $model['name'];
            $location->pla_latitude = $model['latitude'];
            $location->pla_longitude = $model['longitude'];
            $location->pla_status = $model['status'];
            $location->pro_id = $model['province'];
            $location->pla_date_create = new CDbExpression('NOW()');
            if ($location->save()) {
                Yii::app()->user->setFlash('success', "บันทึกข้อมูล เรียบร้อยแล้ว");
            } else {
                Yii::app()->user->setFlash('error', "ไม่สามารถ บันทึกข้อมูลได้ กรุณาติดต่อเจ้าหน้าที่ดูแลระบบ");
            }
            $this->redirect(array('/admin/Locations'));
        }
    }

    public function actionLocationDelete($id) {
        if (CrayfishPlace::model()->deleteByPk($id)) {
            Yii::app()->user->setFlash('success', "ลบข้อมูล เรียบร้อยแล้ว");
        } else {
            Yii::app()->user->setFlash('error', "ไม่สามารถ ลบข้อมูลได้ กรุณาติดต่อเจ้าหน้าที่ดูแลระบบ");
        }
        $this->redirect(array('/admin/Locations'));
    }

    public function actionMembersLevel() {
        $dataProvider = new CActiveDataProvider('MemberLevel');
        $this->render('/admin/membesLevel', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionMemberLevel($id = null) {
        if (empty($id)) {
            $level = new MemberLevel();
        } else {
            $level = MemberLevel::model()->findByPk($id);
        }
        $status = $this->status;
        $this->render('/admin/memberLevel', array(
            'level' => $level,
            'status' => $status
        ));
    }

    public function actionmemberLevelSave() {
        if (!empty($_POST)) {
            $model = $_POST['model'];
            if (empty($model['id'])) {
                $level = new MemberLevel();
            } else {
                $level = MemberLevel::model()->findByPk($model['id']);
            }
            $level->lev_name = $model['name'];
            $level->lev_status = $model['status'];
            $level->lev_date_create = new CDbExpression('NOW()');
            if ($level->save()) {
                Yii::app()->user->setFlash('success', "บันทึกข้อมูล เรียบร้อยแล้ว");
            } else {
                Yii::app()->user->setFlash('error', "ไม่สามารถ บันทึกข้อมูลได้ กรุณาติดต่อเจ้าหน้าที่ดูแลระบบ");
            }
            $this->redirect(array('/admin/MembersLevel'));
        }
    }

    public function actionMemberLevelDelete($id) {
        if (MemberLevel::model()->deleteByPk($id)) {
            Yii::app()->user->setFlash('success', "ลบข้อมูล เรียบร้อยแล้ว");
        } else {
            Yii::app()->user->setFlash('error', "ไม่สามารถ ลบข้อมูลได้ กรุณาติดต่อเจ้าหน้าที่ดูแลระบบ");
        }
        $this->redirect(array('/admin/MembersLevel'));
    }

}
