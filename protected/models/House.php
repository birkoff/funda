<?php

/** SINCE THIS APP USES LOW DB LOAD I'LL USE ACTIVE RECORD INSTEAD OF DAO 
 * 
 * This is the model class for table "houses".
 *
 * The followings are the available columns in table 'houses':
 * @property integer $id
 * @property string $adres
 * @property integer $aantalkamers
 * @property string $foto
 * @property integer $koopprijstot
 * @property string $makelaarnaam
 * @property string $postcode
 * @property string $url
 * @property string $create_time
 * @property integer $user_id
 * @property string $woonoppervlakte
 * @property string $woonplats
 * @property string $wgs84_y
 * @property string $wgs84_x
 */
class House extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return House the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'houses';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('adres, aantalkamers, foto, koopprijstot, makelaarnaam, postcode, url, user_id, woonoppervlakte, woonplats, wgs84_y, wgs84_x', 'required'),
			//array('aantalkamers, koopprijstot, user_id', 'numerical', 'integerOnly'=>true),
			//array('adres, foto, makelaarnaam, url, woonoppervlakte, woonplats, wgs84_y, wgs84_x', 'length', 'max'=>88),
			//array('postcode', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			//array('id, adres, aantalkamers, foto, koopprijstot, makelaarnaam, postcode, url, create_time, user_id, woonoppervlakte, woonplats, wgs84_y, wgs84_x', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'adres' => 'Adres',
			'aantalkamers' => 'Aantalkamers',
			'foto' => 'Foto',
			'koopprijstot' => 'Koopprijstot',
			'makelaarnaam' => 'Makelaarnaam',
			'postcode' => 'Postcode',
			'url' => 'Url',
			'create_time' => 'Create Time',
			'user_id' => 'User',
			'woonoppervlakte' => 'Woonoppervlakte',
			'woonplats' => 'Woonplats',
			'wgs84_y' => 'Wgs84 Y',
			'wgs84_x' => 'Wgs84 X',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('adres',$this->adres,true);
		$criteria->compare('aantalkamers',$this->aantalkamers);
		$criteria->compare('foto',$this->foto,true);
		$criteria->compare('koopprijstot',$this->koopprijstot);
		$criteria->compare('makelaarnaam',$this->makelaarnaam,true);
		$criteria->compare('postcode',$this->postcode,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('woonoppervlakte',$this->woonoppervlakte,true);
		$criteria->compare('woonplats',$this->woonplats,true);
		$criteria->compare('wgs84_y',$this->wgs84_y,true);
		$criteria->compare('wgs84_x',$this->wgs84_x,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	protected function beforeSave()
	{
	    //if($this->isNewRecord) // It always will be a new record
        //{
            $this->user_id=Yii::app()->user->id;
        //}
        return true;
	}
	
	protected function afterSave()
	{
		$cacheID = $this->getHousesURLCacheID(); // get the cache id 
		Yii::app()->cache->delete($cacheID);
		return true;
	}
	
	protected function afterDelete()
	{
		$cacheID = $this->getHousesURLCacheID(); // get the cache id 
		Yii::app()->cache->delete($cacheID);
		return true;
	}
	
	public function getHousesURLCacheID()
	{
		return 'myhousesurllist-'.Yii::app()->user->id;
	}
	
	public function getCacheID()
	{
		return 'myhouses-'.Yii::app()->user->id;
	}
	
	/* 
	 * this returns a list of unique URL's of the houses from the user 
	 */
	public function getMyHouses()
	{
		$cacheID = self::getHousesURLCacheID(); // get the cache id 
		$myhouses=Yii::app()->cache->get($cacheID);
		if($myhouses===false)
		{
			$criteria=new CDbCriteria;
			$criteria->select='url';  // only select the 'title' column
			$criteria->condition='user_id=:userID';
			$criteria->params=array(':userID'=>Yii::app()->user->id);
			$houses=House::model()->findAll($criteria);
			
			$myhouses = array(); // declaring $myhouses will prevent the case when there is no houses
			foreach ($houses as $house) $myhouses[]=$house->url;
			Yii::app()->cache->set($cacheID, $myhouses);
		}
		return $myhouses;
	}
}