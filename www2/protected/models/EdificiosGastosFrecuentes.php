<?php

/**
 * This is the model class for table "edificios_gastosFrecuentes".
 *
 * The followings are the available columns in table 'edificios_gastosFrecuentes':
 * @property integer $id
 * @property integer $idEdificio
 * @property integer $idTipoGasto
 * @property integer $idEntidad
 * @property integer $idTipoComprobante
 * @property string $detalle
 *
 * The followings are the available model relations:
 * @property ComprobantesTipos $idTipoComprobante0
 * @property Edificios $idEdificio0
 * @property Gastos $idTipoGasto0
 * @property Entidades $idEntidad0
 */
class EdificiosGastosFrecuentes extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EdificiosGastosFrecuentes the static model class
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
		return 'edificios_gastosFrecuentes';
	}
	public function getLabelPorcentajes()
	{
		$lab="";
		foreach($this->porcentajes as $porc){
			$lab.=''.$porc->tipoPropiedad->nombreTipoPropiedad.' <strong> '.$porc->porcentaje.' %</strong><br>';
		}
		return $lab;
	}
	public function getValores($porcentajes,$idGasto=null)
	{
		$arr=array();

		if($idGasto==null){
			$arr[]=100;
			for($i=1;$i<count($porcentajes);$i++)$arr[]=0;

		}
		else
		for($i=0;$i<count($porcentajes);$i++)$arr[]=EdificiosGastosFrecuentesPorcentajes::model()->getValor($idGasto,$porcentajes[$i]->id);
		return $arr;
	}
	public function getPorcentajeTipoPropiedad($idTipoProp)
	{
		foreach($this->porcentajes as $porc)
			if($porc->idTipoPropiedad==$idTipoProp)return $porc->porcentaje;
		return 0;
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idEdificio,  idTipoGasto, idEntidad, idTipoComprobante', 'numerical', 'integerOnly'=>true),
			array('detalle,importe,idEdificio,idTipoGasto,idEntidad', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id, idEdificio, idTipoGasto, idEntidad, idTipoComprobante, detalle', 'safe', 'on'=>'search'),
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
			'tipoComprobante' => array(self::BELONGS_TO, 'ComprobantesTipos', 'idTipoComprobante'),
			'edificio' => array(self::BELONGS_TO, 'Edificios', 'idEdificio'),
			'tipoGasto' => array(self::BELONGS_TO, 'GastosTipos', 'idTipoGasto'),
			'entidad' => array(self::BELONGS_TO, 'Entidades', 'idEntidad'),
			'porcentajes' => array(self::HAS_MANY, 'EdificiosGastosFrecuentesPorcentajes', 'idGastoFrecuente'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idEdificio' => 'Edificio',
			'idTipoGasto' => 'Tipo Gasto',
			'idEntidad' => 'Entidad',
			'idTipoComprobante' => 'Tipo Comprobante',
			'detalle' => 'Detalle',
			'importe' => 'Importe',
		);
	}

	public function porEdificio($idEdificio)
	{
		$criteria=new CDbCriteria;
		$criteria->compare('idEdificio',$idEdificio,false);

		return self::model()->findAll($criteria);
	}
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		$criteria->with=array('entidad');
		$criteria->compare('entidad.razonSocial',$this->buscar,'OR');
		$criteria->compare('t.detalle',$this->buscar,true,'OR');
		$criteria->compare('idEdificio',$this->idEdificio,true,'OR');
		$cantidadPorPagina=Settings::model()->getValorSistema('FORMATO_CANTPAGINA');
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,'pagination'=>array(
        'pageSize'=>$cantidadPorPagina,
    ),
		));
	}
}