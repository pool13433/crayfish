<?php

/**
 * This is the model class for table "member".
 *
 * The followings are the available columns in table 'member':
 * @property integer $mem_id
 * @property string $mem_facebook
 * @property string $mem_fname
 * @property string $mem_lname
 * @property string $mem_username
 * @property string $mem_password
 * @property string $mem_address
 * @property integer $pro_id
 * @property string $mem_zipcode
 * @property string $mem_mobile
 * @property string $mem_email
 * @property string $mem_picture
 * @property string $mem_date_create
 * @property string $mem_date_update
 * @property string $mem_status
 * @property string $mem_privileg
 * @property integer $lev_id
 */
class Member extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'member';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('mem_fname, mem_lname, pro_id, mem_email, mem_date_create, mem_date_update, mem_status, mem_privileg, lev_id', 'required'),
            array('pro_id, lev_id', 'numerical', 'integerOnly' => true),
            array('mem_facebook', 'length', 'max' => 25),
            array('mem_fname, mem_lname', 'length', 'max' => 100),
            array('mem_username, mem_password, mem_email', 'length', 'max' => 50),
            array('mem_zipcode, mem_status, mem_privileg', 'length', 'max' => 8),
            array('mem_mobile', 'length', 'max' => 15),
            array('mem_picture', 'length', 'max' => 150),
            array('mem_address', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('mem_id, mem_facebook, mem_fname, mem_lname, mem_username, mem_password, mem_address, pro_id, mem_zipcode, mem_mobile, mem_email, mem_picture, mem_date_create, mem_date_update, mem_status, mem_privileg, lev_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'province' => array(self::BELONGS_TO, 'Province', 'pro_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'mem_id' => 'รหัส',
            'mem_facebook' => 'Facebook',
            'mem_fname' => 'ชื่อ',
            'mem_lname' => 'สกุล',
            'mem_username' => 'Username',
            'mem_password' => 'Password',
            'mem_address' => 'Address',
            'pro_id' => 'จังหวัด',
            'mem_zipcode' => 'zipcode',
            'mem_mobile' => 'mobile',
            'mem_email' => 'email',
            'mem_picture' => 'picture',
            'mem_date_create' => 'Date Create',
            'mem_date_update' => 'Date Update',
            'mem_status' => 'status',
            'mem_privileg' => 'privileg',
            'lev_id' => 'level',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('mem_id', $this->mem_id);
        $criteria->compare('mem_facebook', $this->mem_facebook, true);
        $criteria->compare('mem_fname', $this->mem_fname, true);
        $criteria->compare('mem_lname', $this->mem_lname, true);
        $criteria->compare('mem_username', $this->mem_username, true);
        $criteria->compare('mem_password', $this->mem_password, true);
        $criteria->compare('mem_address', $this->mem_address, true);
        $criteria->compare('pro_id', $this->pro_id);
        $criteria->compare('mem_zipcode', $this->mem_zipcode, true);
        $criteria->compare('mem_mobile', $this->mem_mobile, true);
        $criteria->compare('mem_email', $this->mem_email, true);
        $criteria->compare('mem_picture', $this->mem_picture, true);
        $criteria->compare('mem_date_create', $this->mem_date_create, true);
        $criteria->compare('mem_date_update', $this->mem_date_update, true);
        $criteria->compare('mem_status', $this->mem_status, true);
        $criteria->compare('mem_privileg', $this->mem_privileg, true);
        $criteria->compare('lev_id', $this->lev_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Member the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function beforeSave() {
        $this->mem_password = md5($this->mem_password);
        return true;
    }

    public static function getMemberProfile($mem_id) {
        return Yii::app()->db->createCommand()
                        ->select('m.*
                            ,(SELECT lev_name FROM member_level ml WHERE ml.lev_id = m.lev_id) as lev_name
                            ,DATE_FORMAT(mem_date_create,\'%d-%m-%Y\') as mem_date_create,DATE_FORMAT(mem_date_update,\'%d-%m-%Y\') as mem_date_update')
                        ->from('member m')
                        ->where('m.mem_id =:mem_id', array(':mem_id' => $mem_id))
                        ->queryRow();
    }

}
