<?php

/**
 * This is the model class for table "pagos".
 *
 * The followings are the available columns in table 'pagos':
 * @property integer $id
 * @property integer $idComprobante
 * @property string $fecha
 * @property double $importe
 *
 * The followings are the available model relations:
 * @property Comprobantes $idComprobante0
 */
class Pagos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Pagos the static model class
	 */
	 public $buscar;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function procesarPago($id,$importePago,$credito,$importeInteres=0,$idPropiedad=null)
	{
    //ALTER TABLE  `pagos` ADD  `idPropiedad` INT( 10 ) NOT NULL ;
		$modelCom=Comprobantes::model()->findByPk($id);
		$importeResto=$credito;
		$id=$this->ingresaPago($id,$importePago,$credito,$importeInteres,$idPropiedad);

		if($importeResto<=0)$modelCom->cancelar();else $modelCom->pendiente();
		
		return $id;
			
	}
  public function devolverSaldo()
  {
    $prop=Propiedades::model()->findByPk($this->idPropiedad);
    if($prop)
      if($this->credito<0){
        $prop->importeFavor-=$this->credito;
        $prop->save();
      }
      
    
  }
	public function ingresaPago($idComp,$importe,$credito=0,$importeInteres=0,$idPropiedad=null)
	{
    if($credito>0)$credito=0;
		$modelCom=Comprobantes::model()->findByPk($idComp);
		$model=new Pagos;
		$model->idComprobante=$idComp;
		$model->credito=$credito;
		$model->importeInteres=$importeInteres;
		$model->fecha=Date("Y-m-d");
		$model->importe=$importe;
    $model->idPropiedad=$idPropiedad;
		$model->save();
		return $model->id;
		
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pagos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idComprobante', 'numerical', 'integerOnly'=>true),
			array('importe', 'numerical'),
			array('fecha,credito', 'safe'),
			array('fecha,importe', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id, idComprobante, fecha, importe', 'safe', 'on'=>'search'),
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
			'comprobante' => array(self::BELONGS_TO, 'Comprobantes', 'idComprobante'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idComprobante' => 'Comprobante',
			'fecha' => 'Fecha',
			'importe' => 'Importe',
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

		$criteria->compare('idComprobante',$this->idComprobante,false);
		$criteria->compare('fecha',$this->buscar,true,'OR');
		$criteria->compare('importe',$this->buscar,'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}