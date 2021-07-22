<?php
class ValidadorContrato extends CValidator {



	/**
	 * Validates the attribute of the object.
	 * If there is any error, the error message is added to the object.
	 * @param CModel $object the object being validated
	 * @param string $attribute the attribute being validated
	 */
	protected function validateAttribute($object,$attribute) {
		$value=$object->$attribute;

		$className=Yii::import("Contratos");
		$model=CActiveRecord::model($className);
		
		if(!$this->apta($value))$this->addError($object,$attribute,$this->message,array('{value}'=>$value));
	}
	private function apta($idPropiedad)
	{
		$criteria=new CDbCriteria;
		$criteria->with=array('inmueble');
		$criteria->addCondition("idDominio=".$idPropiedad.' AND inmueble.estado="ACTIVA"');
		
		$res=Contratos::model()->exists($criteria);
		return count($res)>0?true:false;
	}

}