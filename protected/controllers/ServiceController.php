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
            $command->andWhere('c.cray_age >:begin AND c.cray_age <=:end', array(':begin' => $begin, ':end' => $end));
        }
        if (!empty($_POST['price'])) {
            $price = explode('-', $_POST['price']);
            $begin = $price[0];
            $end = $price[1];
            $command->andWhere('c.cray_price >:begin AND c.cray_price <=:end', array(':begin' => $begin, ':end' => $end));
        }
        if (!empty($_POST['color']) && $_POST['color'] !== $this->default) {
            $command->andWhere('c.cray_color =:color', array(':color' => $_POST['color']));
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
            $command->andWhere('a.acc_price >:begin AND a.acc_price <=:end', array(':begin' => $begin, ':end' => $end));
        }
        $accessories = $command->order('a.acc_id DESC')->queryAll();
        echo CJSON::encode($accessories);
    }

    public function actionGetAccessoryFilter() {
        $type = Yii::app()->db->createCommand()
                ->select('t.*')
                ->from('accessories_type t')
                ->queryAll();
        array_unshift($type, array('type_id' => '', 'type_name' => $this->default));
        $price = array(
            '' => $this->default,
            '100-1000' => '100-1000 บาท',
            '1001-2000' => '1001-2000 บาท',
            '2001-3000' => '2001-3000 บาท',
            '3001-4000' => '3001-4000 บาท',
            '4001-5000' => '4001-5000 บาท',
        );

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
        $age = array(
            '' => $this->default,
            '0-3' => '0-3 เดือน',
            '4-6' => '4-6 เดือน',
            '7-9' => '7-9 เดือน',
            '10-13' => '10-13 เดือน',
            '14-16' => '14-16 เดือน',
            '17-19' => '17-19 เดือน',
        );
        $price = array(
            '' => $this->default,
            '100-1000' => '100-1000 บาท',
            '1001-2000' => '1001-2000 บาท',
            '2001-3000' => '2001-3000 บาท',
            '3001-4000' => '3001-4000 บาท',
            '4001-5000' => '4001-5000 บาท',
        );
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
            $accessory->acc_picture = 'xxxxx';
            $accessory->acc_price = $_POST['price'];
            $accessory->acc_status = 'active';
            $accessory->type_id = $_POST['type'];
            $accessory->mem_id = 1;
            if ($accessory->save()) {
                $status = array('status' => true, 'title' => 'สถานะการลงประกาศ', 'message' => 'ลงประกาศ สำเร็จ', 'redirect' => Yii::app()->baseUrl . '/site/accessories');
            } else {
                $status = array('status' => false, 'title' => 'สถานะการลงประกาศ', 'message' => 'ลงประกาศ ล้มเหลว');
            }
            echo CJSON::encode($status);
        }
    }

}
