<?php

/**
 * This is the model class for table "province".
 *
 * The followings are the available columns in table 'province':
 * @property integer $pro_id
 * @property string $pro_name
 * @property string $pro_updatedate
 * @property integer $pro_updateby
 */
class Province extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'province';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('pro_name, pro_updatedate, pro_updateby', 'required'),
            array('pro_updateby', 'numerical', 'integerOnly' => true),
            array('pro_name', 'length', 'max' => 150),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('pro_id, pro_name, pro_updatedate, pro_updateby', 'safe', 'on' => 'search'),
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
            'pro_id' => 'รหัสจังหวัด',
            'pro_name' => 'ชื่อจังหวัด',
            'pro_updatedate' => 'Pro Updatedate',
            'pro_updateby' => 'Pro Updateby',
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

        $criteria->compare('pro_id', $this->pro_id);
        $criteria->compare('pro_name', $this->pro_name, true);
        $criteria->compare('pro_updatedate', $this->pro_updatedate, true);
        $criteria->compare('pro_updateby', $this->pro_updateby);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Province the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
