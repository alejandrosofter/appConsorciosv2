<?php

/**
 * This is the model class for table "certificadosElectronicos".
 *
 * The followings are the available columns in table 'certificadosElectronicos':
 * @property integer $id
 * @property string $nombreCertificado
 * @property string $fechaCreacion
 * @property string $fechaExpira
 * @property string $archivoCertificado
 * @property string $archivoCsr
 * @property string $archivoKey
 *
 * The followings are the available model relations:
 * @property Talonarios[] $talonarioses
 */
class CertificadosElectronicos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CertificadosElectronicos the static model class
	 */
	 public $buscar;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'certificadosElectronicos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombreCertificado, archivoCertificado, archivoCsr, archivoKey', 'length', 'max'=>255),
			array('fechaCreacion, fechaExpira', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id, nombreCertificado, fechaCreacion, fechaExpira, archivoCertificado, archivoCsr, archivoKey', 'safe', 'on'=>'search'),
		);
	}

	public function getRutaArchivos()
	{
		return dirname(__FILE__).'/../../certificadosElectronicos/';
	}
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'talonarioses' => array(self::HAS_MANY, 'Talonarios', 'idCertificadoElectronico'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nombreCertificado' => 'Nombre Certificado',
			'fechaCreacion' => 'Fecha Creacion',
			'fechaExpira' => 'Fecha Expira',
			'archivoCertificado' => 'Archivo Certificado',
			'archivoCsr' => 'Archivo Csr',
			'archivoKey' => 'Archivo Key',
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

		$criteria->compare('id',$this->buscar,'OR');
		$criteria->compare('nombreCertificado',$this->buscar,true,'OR');
		$criteria->compare('fechaCreacion',$this->buscar,true,'OR');
		$criteria->compare('fechaExpira',$this->buscar,true,'OR');
		$criteria->compare('archivoCertificado',$this->buscar,true,'OR');
		$criteria->compare('archivoCsr',$this->buscar,true,'OR');
		$criteria->compare('archivoKey',$this->buscar,true,'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}