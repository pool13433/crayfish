<?php

class ServiceController extends Controller {

    public $default = '-- ทั้งหมด --';

    function __construct($id, $module = null) {
        header('Content-Type', 'application/json; charset=UTF-8');
        //Content-Type:"text/html; charset=UTF-8"
    }

    public function actionGetCrayfishs() {
        $command = Yii::app()->db->createCommand()
                ->select('c.*,FORMAT(cray_price,0) as cray_price,
                        DATE_FORMAT(cray_date_create,\'%d-%m-%Y\') as cray_date_create,
                        DATE_FORMAT(cray_date_tran,\'%d-%m-%Y\') as cray_date_tran
                        ')
                ->from('crayfish c')
                ->where('1=1');
        if (!empty($_POST['age'])) {
            $age = explode('-', $_POST['age']);
            $begin = $age[0];
            $end = $age[1];
            $command->andWhere('c.cray_age >:begin', array(':begin' => $begin));
            if ($end != 0) {
                $command->andWhere('c.cray_age <=:end', array(':end' => $end));
            }
        }
        if (!empty($_POST['price'])) {
            $price = explode('-', $_POST['price']);
            $begin = $price[0];
            $end = $price[1];
            $command->andWhere('c.cray_price >:begin', array(':begin' => $begin));
            if ($end != 0) {
                $command->andWhere('c.cray_price <=:end', array(':end' => $end));
            }
        }
        if (!empty($_POST['color']) && $_POST['color'] !== $this->default) {
            $command->andWhere('c.cray_color =:color', array(':color' => $_POST['color']));
        }
        if (empty($_POST['filter'])) {
            $command->order('c.cray_id DESC');
        } else {
            $filter = $_POST['filter'];
            $command->order("c.cray_$filter");
        }

        $crayfishs = $command->queryAll();
        echo CJSON::encode($crayfishs);
    }

    public function actionGetAccessories() {
        $command = Yii::app()->db->createCommand()
                ->select('a.*,t.*,DATE_FORMAT(a.acc_date_create,\'%d-%m-%Y\') as acc_date_create ')
                ->from('accessories a')
                ->join('accessories_type t', 'a.type_id = t.type_id')
                ->where('1=1');
        if (!empty($_POST['type'])) {
            $command->andWhere('a.type_id =:type', array(':type' => $_POST['type']));
        }
        if (!empty($_POST['price'])) {
            $price = explode('-', $_POST['price']);
            $begin = $price[0];
            $end = $price[1];
            $command->andWhere('a.acc_price >:begin', array(':begin' => $begin));
            if ($end != 0) {
                $command->andWhere('a.acc_price <=:end', array(':end' => $end));
            }
        }
        if (empty($_POST['filter'])) {
            $command->order('a.acc_id DESC');
        } else {
            $filter = $_POST['filter'];
            $command->order("a.acc_$filter");
        }
        $accessories = $command->queryAll();
        echo CJSON::encode($accessories);
    }

    public function actionGetAccessoryFilter() {
        $type = Yii::app()->db->createCommand()
                ->select('t.*')
                ->from('accessories_type t')
                ->queryAll();
        array_unshift($type, array('type_id' => '', 'type_name' => $this->default));
        $price = CriteriaData::prices();

        $filter = array(
            'type' => $type,
            'price' => $price
        );
        echo CJSON::encode($filter);
    }

    public function actionGetCrayfishFilter() {
        $colors = Yii::app()->db->createCommand()
                ->selectDistinct('c.cray_color')
                ->from('crayfish c')
                ->queryColumn();
        array_unshift($colors, $this->default);
        $age = CriteriaData::ages();
        $price = CriteriaData::prices();
        $filter = array(
            'ages' => $age,
            'colors' => $colors,
            'price' => $price
        );
        echo CJSON::encode($filter);
    }

    public function actionPostCrayfish() {
        if (!empty($_POST)) {
            $crayfish = new Crayfish();
            $crayfish->cray_age = $_POST['age'];
            $crayfish->cray_code = $_POST['code'];
            $crayfish->cray_color = $_POST['color'];
            $crayfish->cray_date_create = new CDbExpression('NOW()');
            $crayfish->cray_date_tran = new CDbExpression('NOW()');
            $crayfish->cray_desc = $_POST['desc'];
            $crayfish->cray_name = $_POST['name'];

            $crayfish->cray_price = $_POST['price'];
            $crayfish->cray_status = 'active';
            $crayfish->mem_id = 1;

            // Uplaod File 
            $renamePIC = 'xxxxxx';
            $crayfishPictures = array();
            $output_dir = Yii::getPathOfAlias('webroot') . '/uploads/crayfishs/';
            if (isset($_FILES["myfile"])) {
                $ret = array();
                $error = $_FILES["myfile"]["error"];

                $fileCount = count($_FILES["myfile"]["name"]);
                for ($i = 0; $i < $fileCount; $i++) {
                    $originPIC = $_FILES["myfile"]["name"][$i];
                    $extPIC = pathinfo($originPIC, PATHINFO_EXTENSION);
                    $renamePIC = date('Ymd_His') . '_' . $i . '.' . $extPIC;
                    move_uploaded_file($_FILES["myfile"]["tmp_name"][$i], $output_dir . $renamePIC);

                    $crayfishPictures[] = $renamePIC;
                    if ($i == 0) {
                        $crayfish->cray_picture = $renamePIC;
                    }
                }
            }
            if ($crayfish->save()) {
                foreach ($crayfishPictures as $index => $image) {
                    $picture = new CrayfishPicture();
                    $picture->cray_id = $crayfish->cray_id;
                    $picture->pic_name = $image;
                    $picture->save();
                }
                $status = array('status' => true, 'title' => 'สถานะการลงประกาศ', 'message' => 'ลงประกาศ สำเร็จ', 'redirect' => Yii::app()->baseUrl . '/site/crayfishs');
            } else {
                $status = array('status' => false, 'title' => 'สถานะการลงประกาศ', 'message' => 'ลงประกาศ ล้มเหลว');
            }
            echo CJSON::encode($status);
        }
    }

    public function actionPostAccessories() {
        if (!empty($_POST)) {
            $accessory = new Accessories();
            $accessory->acc_date_create = new CDbExpression('NOW()');
            $accessory->acc_date_update = new CDbExpression('NOW()');
            $accessory->acc_desc = $_POST['desc'];
            $accessory->acc_name = $_POST['name'];

            $accessory->acc_price = $_POST['price'];
            $accessory->acc_status = 'active';
            $accessory->type_id = $_POST['type'];
            $accessory->mem_id = 1;


            // Uplaod File 
            $renamePIC = 'xxxxxx';
            $crayfishPictures = array();
            $output_dir = Yii::getPathOfAlias('webroot') . '/uploads/accessory/';
            if (isset($_FILES["myfile"])) {
                $ret = array();
                $error = $_FILES["myfile"]["error"];
                $fileCount = count($_FILES["myfile"]["name"]);
                for ($i = 0; $i < $fileCount; $i++) {
                    $originPIC = $_FILES["myfile"]["name"][$i];
                    $extPIC = pathinfo($originPIC, PATHINFO_EXTENSION);
                    $renamePIC = date('Ymd_His') . '_' . $i . '.' . $extPIC;
                    move_uploaded_file($_FILES["myfile"]["tmp_name"][$i], $output_dir . $renamePIC);

                    $crayfishPictures[] = $renamePIC;
                    if ($i == 0) {
                        $accessory->acc_picture = $renamePIC;
                    }
                }
            }

            if ($accessory->save()) {

                foreach ($crayfishPictures as $index => $image) {
                    $picture = new AccessoriesPicture();
                    $picture->acc_id = $accessory->acc_id;
                    $picture->pic_name = $image;
                    $picture->save();
                }

                $status = array('status' => true, 'title' => 'สถานะการลงประกาศ', 'message' => 'ลงประกาศ สำเร็จ', 'redirect' => Yii::app()->baseUrl . '/site/accessories');
            } else {
                $status = array('status' => false, 'title' => 'สถานะการลงประกาศ', 'message' => 'ลงประกาศ ล้มเหลว');
            }
            echo CJSON::encode($status);
        }
    }

    public function actionGetMarketPlaceLocation() {
        $places = Yii::app()->db->createCommand()
                ->select('cp.*,p.*')
                ->from('crayfish_place cp ')
                ->join('province p', 'p.pro_id = cp.pro_id')
                ->where('cp.pla_status = \'active\' ')
                ->order('cp.pla_id')
                ->queryAll();
        echo CJSON::encode($places);
    }

    public function actionGetProvinceMinPlace() {
        $provinces = Yii::app()->db->createCommand()
                ->select('p.*,count(cp.pla_id) as cnt_place')
                ->from('province p')
                ->join('crayfish_place cp', 'cp.pro_id = p.pro_id')
                ->where('cp.pla_status = \'active\' ')
                ->group('p.pro_id')
                ->having('count(cp.pro_id)  > 0')
                ->queryAll();
        echo CJSON::encode($provinces);
    }

    public function actionCheckProfileSystem() {
        if (!empty($_POST)) {
            //{id: "10207509059435749", name: "Poolsawat Poolsawat Apin", first_name: "Poolsawat", last_name: "Apin", email: "poon_mp@hotmail.com"…}
            $facebookId = $_POST['id'];
            $fname = $_POST['first_name'];
            $lname = $_POST['last_name'];
            $email = $_POST['email'];
            $gender = $_POST['gender'];
            $picture = $_POST['picture'];
            $member = Yii::app()->db->createCommand()
                    ->select('m.*
                            ,(SELECT lev_name FROM member_level ml WHERE ml.lev_id = m.lev_id) as lev_name
                            ,DATE_FORMAT(mem_date_create,\'%d-%m-%Y\') as mem_date_create,DATE_FORMAT(mem_date_update,\'%d-%m-%Y\') as mem_date_update')
                    ->from('member m')
                    ->where('m.mem_facebook =:facebookId', array(':facebookId' => $facebookId))
                    ->queryRow();
            if (!$member) { // New User
                $member = new Member();
                $member->mem_date_create = new CDbExpression('NOW()');
                $member->mem_date_update = new CDbExpression('NOW()');
                $member->mem_email = $email;
                $member->mem_facebook = $facebookId;
                $member->mem_fname = $fname;
                $member->lev_id = 1;
                $member->mem_lname = $lname;
                $member->mem_privileg = "customer";
                $member->mem_status = "active";
                $member->mem_picture = $picture;
                $member->pro_id = 1;
                if (!$member->save()) {
                    $response = array('status' => false, 'message' => 'เกิดข้อผิดพลาด กรุณาติดต่อ ผู้ดูแลระบบ');
                    echo CJSON::encode($response);
                    exit();
                }
            }
            Yii::app()->session['member'] = Member::getMemberProfile($member['mem_id']);
            $response = array('status' => true, 'message' => 'เข้าระบบสำเร็จ', 'redirect' => Yii::app()->createUrl('/site/index'));
            echo CJSON::encode($response);
        } else {
            echo CJSON::encode(array('status' => false, 'message' => 'method not allows !!'));
        }
    }

    public function actionGetFilter() {
        echo CJSON::encode(array(
            'crayfish' => CriteriaData::crayFishFilters(),
            'accessory' => CriteriaData::accessoryFilters()
        ));
    }

}
