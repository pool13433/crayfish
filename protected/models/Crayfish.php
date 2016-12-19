<?php

/**
 * This is the model class for table "crayfish".
 *
 * The followings are the available columns in table 'crayfish':
 * @property integer $cray_id
 * @property string $cray_code
 * @property string $cray_name
 * @property string $cray_desc
 * @property integer $cray_price
 * @property string $cray_color
 * @property integer $cray_age
 * @property string $cray_picture
 * @property string $cray_date_create
 * @property string $cray_date_tran
 * @property string $cray_status
 * @property integer $mem_id
 */
class Crayfish extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'crayfish';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('cray_code, cray_name, cray_desc, cray_price, cray_color, cray_age, cray_date_create, cray_date_tran, cray_status, mem_id', 'required'),
            array('cray_price, cray_age, mem_id', 'numerical', 'integerOnly' => true),
            array('cray_code', 'length', 'max' => 15),
            array('cray_name', 'length', 'max' => 150),
            array('cray_color', 'length', 'max' => 100),
            array('cray_picture', 'length', 'max' => 255),
            array('cray_status', 'length', 'max' => 8),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('cray_id, cray_code, cray_name, cray_desc, cray_price, cray_color, cray_age, cray_picture, cray_date_create, cray_date_tran, cray_status, mem_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'cray_id' => 'Cray',
            'cray_code' => 'Cray Code',
            'cray_name' => 'Cray Name',
            'cray_desc' => 'Cray Desc',
            'cray_price' => 'Cray Price',
            'cray_color' => 'Cray Color',
            'cray_age' => 'Cray Age',
            'cray_picture' => 'Cray Picture',
            'cray_date_create' => 'Cray Date Create',
            'cray_date_tran' => 'Cray Date Tran',
            'cray_status' => 'Cray Status',
            'mem_id' => 'Mem',
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

        $criteria->compare('cray_id', $this->cray_id);
        $criteria->compare('cray_code', $this->cray_code, true);
        $criteria->compare('cray_name', $this->cray_name, true);
        $criteria->compare('cray_desc', $this->cray_desc, true);
        $criteria->compare('cray_price', $this->cray_price);
        $criteria->compare('cray_color', $this->cray_color, true);
        $criteria->compare('cray_age', $this->cray_age);
        $criteria->compare('cray_picture', $this->cray_picture, true);
        $criteria->compare('cray_date_create', $this->cray_date_create, true);
        $criteria->compare('cray_date_tran', $this->cray_date_tran, true);
        $criteria->compare('cray_status', $this->cray_status, true);
        $criteria->compare('mem_id', $this->mem_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Crayfish the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
