<?php

/**
 * This is the model class for table "talonarios".
 *
 * The followings are the available columns in table 'talonarios':
 * @property integer $id
 * @property integer $desde
 * @property integer $hasta
 * @property integer $serie
 * @property integer $proximo
 * @property integer $idTipoTalonario
 * @property string $letraTalonario
 * @property integer $esPedeterminado
 * @property integer $esElectronico
 * @property integer $idCertificadoElectronico
 *
 * The followings are the available model relations:
 * @property Comprobantes[] $comprobantes
 * @property CertificadosElectronicos $idCertificadoElectronico0
 * @property TalonariosTipos $idTipoTalonario0
 */
class Talonarios extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Talonarios the static model class
	 */
	 public $buscar;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function getTipoElectronico()
	{
		return $this->tipoTalonario->tipoElectronico;
	}
	public function getEtiqueta()
	{
		$elect=$this->esElectronico?' (Electronico)':'';
		return $this->nombreTalonario.$elect;
	}
	public static function getPredeterminado()
	{
		$res=Talonarios::model()->findAll();
		foreach($res as $item)
			if($item->esPedeterminado) return $item;
		return null;
	}
	public function predeterminar()
	{
		$res=Talonarios::model()->findAll();
		foreach($res as $item){
			$item->esPedeterminado=0;
			$item->save();
		}
		$this->esPedeterminado=1;
		$this->save();
	}
	public function incrementaProximo()
	{
		$this->proximo++;
		$this->save();

	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'talonarios';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('desde, hasta, serie, proximo, idTipoTalonario, esPedeterminado, esElectronico, idCertificadoElectronico', 'numerical', 'integerOnly'=>true),
			array('letraTalonario', 'length', 'max'=>2),
			array('desde,hasta,serie,proximo,nombreTalonario', 'required'),
			array('idPlantilla','safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id, desde, hasta, serie, proximo, idTipoTalonario, letraTalonario, esPedeterminado, esElectronico, idCertificadoElectronico', 'safe', 'on'=>'search'),
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
			'comprobantes' => array(self::HAS_MANY, 'Comprobantes', 'idComprobante'),
			'plantilla' => array(self::BELONGS_TO, 'Plantillas', 'idPlantilla'),
			'certificadoElectronico' => array(self::BELONGS_TO, 'CertificadosElectronicos', 'idCertificadoElectronico'),
			'tipoTalonario' => array(self::BELONGS_TO, 'TalonariosTipos', 'idTipoTalonario'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'desde' => 'Desde',
			'hasta' => 'Hasta',
			'serie' => 'Serie',
			'proximo' => 'Próximo',
			'idTipoTalonario' => 'Tipo Talonario',
			'letraTalonario' => 'Letra Talonario',
			'esPedeterminado' => 'Es Pedeterminado',
			'esElectronico' => 'Es Electronico',
			'idPlantilla' => 'Plantilla',
			'idCertificadoElectronico' => 'Certificado Electronico',
		);
	}
	public function getProximoNro($idTalonario)
	{
		$t=Talonarios::model()->findByPk($idTalonario);
		return $t->proximo;
	}
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->buscar,'OR');
		$criteria->compare('desde',$this->buscar,'OR');
		$criteria->compare('hasta',$this->buscar,'OR');
		$criteria->compare('serie',$this->buscar,'OR');
		$criteria->compare('proximo',$this->buscar,'OR');
		$criteria->compare('idTipoTalonario',$this->buscar,'OR');
		$criteria->compare('letraTalonario',$this->buscar,true,'OR');
		$criteria->compare('esPedeterminado',$this->buscar,'OR');
		$criteria->compare('esElectronico',$this->buscar,'OR');
		$criteria->compare('idCertificadoElectronico',$this->buscar,'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}