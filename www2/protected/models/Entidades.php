<?php

/**
 * This is the model class for table "entidades".
 *
 * The followings are the available columns in table 'entidades':
 * @property integer $id
 * @property string $nombre
 * @property string $razonSocial
 * @property integer $idCondicionIva
 * @property string $telefono
 * @property string $email
 * @property integer $idTipoEntidad
 * @property string $cuit
 *
 * The followings are the available model relations:
 * @property Comprobantes[] $comprobantes
 * @property CondicionesIva $idCondicionIva0
 * @property EntidadesTipos $idTipoEntidad0
 * @property LiquidacionesItems[] $liquidacionesItems
 * @property PropiedadesEntidades[] $propiedadesEntidades
 */
class Entidades extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Entidades the static model class
	 */
	 public $buscar;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function ingresarCreditos($idEntidad,$items,$idComprobante,$importePaga,$interes)
	{
		$sum=0;
		foreach($items as $item)$sum+=$item["saldo"]+$item["interes"];
		$importeResto=$sum+$interes-$importePaga;
		if($importeResto<0)Entidades::model()->ingresarCredito($idEntidad,$importeResto);
	}
		public function ingresarCredito($idEntidad,$importe)
	{
		$model=Entidades::model()->findByPk($idEntidad);
		if($model->importeFavor=='')$model->importeFavor=0;
		$model->importeFavor-=$importe;
		$model->save();
	}
	public function ingresarDebitos($idEntidad,$importeDebito)
	{
		$ent=Entidades::model()->findByPk($idEntidad);
		$ent->importeFavor=$ent->importeFavor-$importeDebito;
		$ent->save();
	}
	public function getTipoElectronico()
	{
		return ($this->condicionIva->tipoElectronico);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'entidades';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idCondicionIva, idTipoEntidad', 'numerical', 'integerOnly'=>true),
			array('nombre, claveWeb,provincia,localidad,razonSocial, telefono, email, cuit', 'length', 'max'=>255),
			array('razonSocial, idCondicionIva', 'required'),
			array('domicilio,provincia,localidad,importeFavor,claveWeb,detalle','safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id,importeFavor,claveWeb, nombre, razonSocial, idCondicionIva, telefono, email, idTipoEntidad, cuit', 'safe', 'on'=>'search'),
		);
	}
	public function validarUsuario ($usuario,$clave)
	{
		$criteria=new CDbCriteria;
		$criteria->compare('t.email', $usuario, false);
		$criteria->compare('t.claveWeb', $clave, false);
		
		return self::model()->findAll($criteria);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'comprobantes' => array(self::HAS_MANY, 'Comprobantes', 'idEntidad'),
			'condicionIva' => array(self::BELONGS_TO, 'CondicionesIva', 'idCondicionIva'),
			'tipoEntidad' => array(self::BELONGS_TO, 'EntidadesTipos', 'idTipoEntidad'),
			'liquidacionesItems' => array(self::HAS_MANY, 'LiquidacionesItems', 'idEntidad'),
			'propiedadesEntidades' => array(self::HAS_MANY, 'PropiedadesEntidades', 'idEntidad'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nombre' => 'Nombre',
			'razonSocial' => 'Nombres/Razon Social',
			'idCondicionIva' => 'Condicion Iva',
			'telefono' => 'Telefono',
			'email' => 'Email',
			'idTipoEntidad' => 'Tipo Entidad',
			'cuit' => 'Cuit/dni',
		);
	}


	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('nombre',$this->buscar,true,'OR');
		$criteria->compare('razonSocial',$this->buscar,true,'OR');
		$criteria->compare('idTipoEntidad',$this->idTipoEntidad);
		$criteria->compare('cuit',$this->buscar,true,'OR');

		$cantidadPorPagina=Settings::model()->getValorSistema('FORMATO_CANTPAGINA');
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,'pagination'=>array(
        'pageSize'=>$cantidadPorPagina,
    ),
		));
	}
}