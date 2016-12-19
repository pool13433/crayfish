<?php

/**
 * This is the model class for table "crayfish_place".
 *
 * The followings are the available columns in table 'crayfish_place':
 * @property integer $pla_id
 * @property string $pla_title
 * @property string $pla_desc
 * @property string $pla_latitude
 * @property string $pla_longitude
 * @property string $pla_date_create
 * @property string $pla_status
 * @property integer $pro_id
 */
class CrayfishPlace extends CActiveRecord {

    public $province_search;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'crayfish_place';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('pla_title, pla_desc, pla_latitude, pla_longitude, pla_date_create, pla_status, pro_id', 'required'),
            array('pro_id', 'numerical', 'integerOnly' => true),
            array('pla_title', 'length', 'max' => 150),
            array('pla_latitude, pla_longitude', 'length', 'max' => 50),
            array('pla_status', 'length', 'max' => 8),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('pla_id, pla_title, pla_desc, pla_latitude, pla_longitude, pla_date_create, pla_status, pro_id,province_search', 'safe', 'on' => 'search'),
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
            'pla_id' => 'Pla',
            'pla_title' => 'Pla Title',
            'pla_desc' => 'Pla Desc',
            'pla_latitude' => 'Pla Latitude',
            'pla_longitude' => 'Pla Longitude',
            'pla_date_create' => 'Pla Date Create',
            'pla_status' => 'Pla Status',
            'pro_id' => 'Pro',
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
        $criteria->with = array('province');
        $criteria->compare('pla_id', $this->pla_id);
        $criteria->compare('pla_title', $this->pla_title, true);
        $criteria->compare('pla_desc', $this->pla_desc, true);
        $criteria->compare('pla_latitude', $this->pla_latitude, true);
        $criteria->compare('pla_longitude', $this->pla_longitude, true);
        $criteria->compare('pla_date_create', $this->pla_date_create, true);
        $criteria->compare('pla_status', $this->pla_status, true);
        $criteria->compare('pro_id', $this->pro_id);
        $criteria->compare('province.pro_name', $this->province_search, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'route' => 'admin/Locations',
                'attributes' => array(
                    'province_search' => array(
                        'asc' => 'province.pro_name',
                        'desc' => 'province.pro_name DESC',
                    ),
                    '*',
                ),
            ),
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return CrayfishPlace the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
