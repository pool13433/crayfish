<?php

/**
 * This is the model class for table "crayfish_picture".
 *
 * The followings are the available columns in table 'crayfish_picture':
 * @property integer $pic_id
 * @property string $pic_name
 * @property integer $cray_id
 */
class CrayfishPicture extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'crayfish_picture';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pic_name, cray_id', 'required'),
			array('cray_id', 'numerical', 'integerOnly'=>true),
			array('pic_name', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('pic_id, pic_name, cray_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pic_id' => 'Pic',
			'pic_name' => 'Pic Name',
			'cray_id' => 'Cray',
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('pic_id',$this->pic_id);
		$criteria->compare('pic_name',$this->pic_name,true);
		$criteria->compare('cray_id',$this->cray_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CrayfishPicture the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
