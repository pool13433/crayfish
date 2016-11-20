<?php

/**
 * This is the model class for table "accessories".
 *
 * The followings are the available columns in table 'accessories':
 * @property integer $acc_id
 * @property string $acc_name
 * @property string $acc_desc
 * @property integer $acc_price
 * @property string $acc_picture
 * @property string $acc_date_create
 * @property string $acc_date_update
 * @property string $acc_status
 * @property integer $type_id
 * @property integer $mem_id
 */
class Accessories extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'accessories';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('acc_name, acc_desc, acc_price, acc_picture, acc_date_create, acc_date_update, acc_status, type_id, mem_id', 'required'),
			array('acc_price, type_id, mem_id', 'numerical', 'integerOnly'=>true),
			array('acc_name, acc_picture', 'length', 'max'=>150),
			array('acc_status', 'length', 'max'=>8),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('acc_id, acc_name, acc_desc, acc_price, acc_picture, acc_date_create, acc_date_update, acc_status, type_id, mem_id', 'safe', 'on'=>'search'),
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
			'acc_id' => 'Acc',
			'acc_name' => 'Acc Name',
			'acc_desc' => 'Acc Desc',
			'acc_price' => 'Acc Price',
			'acc_picture' => 'Acc Picture',
			'acc_date_create' => 'Acc Date Create',
			'acc_date_update' => 'Acc Date Update',
			'acc_status' => 'Acc Status',
			'type_id' => 'Type',
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('acc_id',$this->acc_id);
		$criteria->compare('acc_name',$this->acc_name,true);
		$criteria->compare('acc_desc',$this->acc_desc,true);
		$criteria->compare('acc_price',$this->acc_price);
		$criteria->compare('acc_picture',$this->acc_picture,true);
		$criteria->compare('acc_date_create',$this->acc_date_create,true);
		$criteria->compare('acc_date_update',$this->acc_date_update,true);
		$criteria->compare('acc_status',$this->acc_status,true);
		$criteria->compare('type_id',$this->type_id);
		$criteria->compare('mem_id',$this->mem_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Accessories the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
