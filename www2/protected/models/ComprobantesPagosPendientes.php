<?php

/**
 * This is the model class for table "comprobantes_pagosPendientes".
 *
 * The followings are the available columns in table 'comprobantes_pagosPendientes':
 * @property integer $id
 * @property double $importe
 */
class ComprobantesPagosPendientes extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ComprobantesPagosPendientes the static model class
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
		return 'comprobantes_pagosPendientes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idComprobante,idPago', 'numerical'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id,idComprobante,idPago', 'safe', 'on'=>'search'),
		);
	}
	public function ingresar($items)
	{
		$arr=array();
		foreach($items as $item)
			if($item['tipo']=="comp")$arr[]=$this->_ingresa($item);
		return $arr;
	}
	private function _ingresa($item)
	{
		$idPago=Pagos::model()->procesarPago($item["id"],$item["saldo"],0,$item["interes"]);
		$model=new ComprobantesPagosPendientes();
		$model->idComprobante=$item["id"];
		$model->idPago=$idPago;
		if($model->save())return $item["id"];

	}
	public function desSaldar()
	{
		$model=Comprobantes::model()->findByPk($this->idComprobante);
		foreach($model->pagos as $pago)
				if($pago->importe==$model->importe){
					$pago->delete();
					$pagar=$model->importeTotal-$model->importePagado;
					if($pagar==0){
					$model->estado=Comprobantes::CANCELADO;
					$model->save();
				}else{
					$model->estado=Comprobantes::PENDIENTE;
					$model->save();
				}
			}
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
			'pago' => array(self::BELONGS_TO, 'Pagos', 'idPago'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idPago' => 'Pago',
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
		$criteria->compare('idPago',$this->buscar,'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}