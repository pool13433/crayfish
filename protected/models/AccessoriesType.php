<?php

/**
 * This is the model class for table "accessories_type".
 *
 * The followings are the available columns in table 'accessories_type':
 * @property integer $type_id
 * @property string $type_name
 * @property string $type_desc
 * @property string $type_date_create
 * @property string $type_status
 */
class AccessoriesType extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'accessories_type';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('type_name, type_desc, type_date_create, type_status', 'required'),
            array('type_name', 'length', 'max' => 150),
            array('type_status', 'length', 'max' => 8),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('type_id, type_name, type_desc, type_date_create, type_status', 'safe', 'on' => 'search'),
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
            'type_id' => 'Type',
            'type_name' => 'Type Name',
            'type_desc' => 'Type Desc',
            'type_date_create' => 'Type Date Create',
            'type_status' => 'Type Status',
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

        $criteria->compare('type_id', $this->type_id);
        $criteria->compare('type_name', $this->type_name, true);
        $criteria->compare('type_desc', $this->type_desc, true);
        $criteria->compare('type_date_create', $this->type_date_create, true);
        $criteria->compare('type_status', $this->type_status, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return AccessoriesType the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
