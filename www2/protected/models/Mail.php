<?php

/**
 * This is the model class for table "emails".
 *
 * The followings are the available columns in table 'emails':
 * @property integer $id
 * @property string $emisor
 * @property string $receptor
 * @property string $mensaje
 * @property string $fecha
 * @property string $estado
 */
use PHPMailer\PHPMailer\PHPMailer;
		use PHPMailer\PHPMailer\Exception; 
		require 'vendor/autoload.php';
class Mail extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Mail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	private function getMes($mes)
	{
		$arr=array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
		$restaMes=Settings::model()->getValorSistema('RESTA_MES_EXPENSAS')+0;
		$ind=$mes-$restaMes-1;
		if($ind<0)$ind=12+$ind;

		return $arr[($ind)];
	}
	private function getAno($fecha)
	{
		$arr=explode('-',$fecha);
		$ano=$arr[0];
		$restaMes=Settings::model()->getValorSistema('RESTA_MES_EXPENSAS')+0;
		$ind=$arr[1]-$restaMes-1;
		if($ind<0)$ano--;
		return $ano;
	}
	public function getImporteTotalDeuda($idEntidad)
	{
		$sum=0;
		$deuda= ParaCobrar::model()->moraEntidad($idEntidad,true);
		foreach ($deuda as $key => $item)
			foreach ($item as $key => $value){
				$importe=str_replace('%','',$value->punitorio);
				$porcInteres=$importe==""?0:$importe;
				  
				$dias=$value->getDiasVence()<0?-$value->getDiasVence():0;
				$importeInteres=(($porcInteres/100)*$value->importeSaldo)*$dias;
				$sum+=$value->importe+$importeInteres;
			}
		return $sum;
	}
	public function getTextoMail($idEntidad,$mensaje,$conLayout=null)
		{
			Yii::app()->controller->layout="//layouts/layoutSolo";
			$deuda= ParaCobrar::model()->moraEntidad($idEntidad,true);
			$importeTotal=$this->getImporteTotalDeuda($idEntidad);
			$fecha=Date("Y-m-d");
			$arrFecha=explode('-',$fecha);
			
			
			$param['mes']=$this->getMes($arrFecha[1]);
			$param['ano']=$this->getAno($fecha);
			
			$logo=Settings::model()->getValorSistema("LOGOEMPRESA")==""?null:Settings::model()->getValorSistema("LOGOEMPRESA");
			if($logo){
				$url="http://".Settings::model()->getValorSistema("DATOS_EMPRESA_URL")."/images/".Settings::model()->getValorSistema("LOGOEMPRESA");
				$logo="<img src='".$url."'></img>";
			}
			
             // alternatively specify an URL, if PHP settings allow
			
			$param['direccion']=Settings::model()->getValorSistema('DATOS_EMPRESA_DIRECCION');
			$param['nombreEmpresa']= Settings::model()->getValorSistema('DATOS_EMPRESA_RAZONSOCIAL');
			$param['cuit']= Settings::model()->getValorSistema('DATOS_EMPRESA_CUIT');
			$param['telefono']=Settings::model()->getValorSistema('DATOS_EMPRESA_TELEFONO');
			$param['localidad']=Settings::model()->getValorSistema('DATOS_EMPRESA_LOCALIDAD');
			$param['provincia']=Settings::model()->getValorSistema('DATOS_EMPRESA_PROVINCIA');
			$param['horarios']=Settings::model()->getValorSistema('DATOS_EMPRESA_HORARIOS');
			$param['email']=Settings::model()->getValorSistema('DATOS_EMPRESA_EMAILADMIN');
			$param['logo']=$logo;

			$param['fecha']=Date("d-m-Y");
			$param['titulo']=$param['nombreEmpresa'];
			$param['url']="http://".Settings::model()->getValorSistema('DATOS_EMPRESA_URL')."/index.php?r=site/notificarDeuda&idEntidad=".$idEntidad."&importe=".$importeTotal;
			$linkPago=$param['url'];
			
			$param['cuerpo']=Yii::app()->controller->renderPartial('/entidades/grillaDeuda',array('deuda'=>$deuda,"linkPago"=>$linkPago),true);
			$param['cuerpo'].="<br>".$mensaje;
			if($conLayout) return Settings::model()->getValorSistema('PLANTILLA_BASE',$param);
			return $param['cuerpo'];
			// return Yii::app()->controller->renderPartial('/entidades/mailDeuda',array('data'=>$t,"logo"=>$logo),true);
		}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'emails';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('emisor, receptor, estado', 'length', 'max'=>255),
			array('mensaje, fecha', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, emisor, receptor, mensaje, fecha, estado', 'safe', 'on'=>'search'),
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
			'emisor' => 'Emisor',
			'receptor' => 'Receptor',
			'mensaje' => 'Mensaje',
			'fecha' => 'Fecha',
			'estado' => 'Estado',
		);
	}

	public function enviarMensajeBase($destinatario,$cuerpoMensaje,$titulo,$remitente=null)
	{
		$parametros['cuerpo']=$cuerpoMensaje;
        if($remitente==null)$remitente= Settings::model()->getValorSistema('DATOS_EMPRESA_EMAILADMIN');
        $parametros['empresa']=Settings::model()->getValorSistema('DATOS_EMPRESA_FANTASIA');
        $parametros['direccion']=Settings::model()->getValorSistema('DATOS_EMPRESA_DIRECCION');
        $parametros['telefono']=Settings::model()->getValorSistema('DATOS_EMPRESA_TELEFONO');
        $parametros['horariosAtencion']= Settings::model()->getValorSistema('DATOS_EMPRESA_HORARIOS');
        $parametros['emailAdmin']= Settings::model()->getValorSistema('DATOS_EMPRESA_EMAILADMIN');
        $parametros['site']= Settings::model()->getValorSistema('DATOS_EMPRESA_SITE');
        $parametros['titulo']= $titulo;
        $parametros['fecha']= Date('d-m-Y H:i');
        self::model()->enviarMail ( $destinatario, Settings::model()->getValorSistema('PLANTILLA_BASE',$parametros,'impresiones'), $titulo, $remitente);
	}
	public function _enviarMensaje($mensaje,$_mail,$titulo,$desde,$attachs)
	{
		try {
    //Server settings
    $mail = new PHPMailer(true); // create a new object
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = false;
$mail->do_debug = 0; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = Settings::model()->getValorSistema('EMAIL_SECURE');//'ssl'; // secure transfer enabled REQUIRED for Gmail
$mail->Host = Settings::model()->getValorSistema('EMAIL_HOST');//"smtp.gmail.com";
$mail->Port = Settings::model()->getValorSistema('EMAIL_PORT'); // or 587
$mail->IsHTML(true);
$mail->Username = Settings::model()->getValorSistema('EMAIL_USUARIO');//"alejandronovillo1984@gmail.com";
$mail->Password = Settings::model()->getValorSistema('EMAIL_CLAVE');//"piteroski";
$mail->SetFrom($desde, 'ADMINISTRACION EXPENSAS');
$mail->Subject = $titulo;
$mail->Body = utf8_decode($mensaje);
$mails=explode(";",$_mail);
if(count($mails)>1){
	for($i=1;$i<count($mails);$i++)$mail->addCC($mails[$i]);
}
    $mail->addAddress($mails[0], '');     // Add a recipient
   // $mail->addAddress('ellen@example.com');               // Name is optional
   // $mail->addReplyTo('info@example.com', 'Information');
   // $mail->addCC('cc@example.com');
   // $mail->addBCC('bcc@example.com');

    //Attachments
			foreach($attachs as $arch)
    		$mail->addAttachment($arch);         // Add attachments
   // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //Content

    $mail->send();
    return "";
} catch (Exception $e) {
	return array("error"=>true,"info"=>$mail->ErrorInfo,"usuario"=>$mail->Username,"pass"=>$mail->Password);
   
}
	return "";
}
	public function crearPdf($contenido,$det="")
		{
			
			$fecha = new DateTime();
			$arch='files/'.$det.$fecha->getTimestamp().".pdf";
			$fileHtml="".$det.$fecha->getTimestamp().".html";
			file_put_contents($fileHtml,$contenido);
			$com='/usr/local/bin/wkhtmltopdf --encoding utf-8 '.$fileHtml.' '.$arch;
			file_put_contents("sal.txt",$com);
			$sal=shell_exec($com);
			//unlink($fileHtml);
			return $arch;
		}
	
	public function enviarMail($mail,$mensaje,$titulo,$desde,$attachs=null)
	{
		$estado="NO ENVIADO";
		$enviado=false;
		$error='';
		$res='';


		if(Settings::model()->getValorSistema('GENERALES_MAIL_ACTIVOGENERAL')!=0)
		{

			$mail=Settings::model()->getValorSistema('GENERALES_MAIL_ACTIVOGENERAL')==2?Settings::model()->getValorSistema('DATOS_EMPRESA_EMAILADMIN'):$mail;
   
			$res=$this->_enviarMensaje($mensaje,$mail,$titulo,$desde,$attachs);
			if($res==""){
				$estado="ENVIADO";
				$enviado=true;
				$error="";
			}else {
				$estado="NO ENVIADO";
				$enviado=false;
				$error=$res;
			}
			
}
$this->ingresa($estado,$mail,$mensaje,$titulo,$desde,Date("Y-m-d H:i:s"));

 $sal['error']=!$enviado;
 $sal['mensaje']=$error;
 return $sal;
	}
	private function ingresa($estado,$mail,$mensaje,$titulo,$desde,$fecha)
	{
		$model=new Mail;
		$model->emisor=$desde;
		$model->receptor=$mail;
		$model->estado=$estado;
		$model->fecha=$fecha;
		$model->mensaje=$mensaje;
		$model->save();
	}
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('emisor',$this->emisor,true);
		$criteria->compare('receptor',$this->receptor,true);
		$criteria->compare('mensaje',$this->mensaje,true);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('estado',$this->estado,true);
		$criteria->order='id desc';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}