<?php
namespace Accounts\UI\pages\cuentas\transferir;


use Accounts\UI\components\filter\model\UICuentaCorrienteCriteria;

use Accounts\UI\service\UICuentaCorrienteService;

use Accounts\UI\components\filter\model\UIBancoCriteria;

use Accounts\UI\components\filter\model\UICuentaSocioCriteria;

use Accounts\UI\service\UISucursalService;

use Accounts\UI\components\filter\model\UICuentaCriteria;

use Accounts\UI\service\finder\CuentaFinder;

use Accounts\UI\pages\AccountsPage;

use Accounts\UI\service\UIServiceFactory;

use Accounts\UI\utils\AccountsUIUtils;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\i18n\Locale;
use Rasty\utils\LinkBuilder;

use Rasty\Grid\filter\model\UICriteria;

use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

class Transferir extends AccountsPage{

	private $fechaHora;

	private $origen;
	private $destino;

	private $monto;
	private $observaciones;

	private $error;

	public function __construct(){

		$this->setFechaHora( new \Datetime() );

	}

	protected function parseLabels(XTemplate $xtpl){

		$xtpl->assign("legend",  $this->localize( "accounts.transferir.legend" ) );

		$xtpl->assign("lbl_fechaHora",  $this->localize( "transferir.fechaHora" ) );
		$xtpl->assign("lbl_monto",  $this->localize( "transferir.monto" ) );
		$xtpl->assign("lbl_observaciones",  $this->localize( "transferir.observaciones" ) );
		$xtpl->assign("lbl_origen",  $this->localize( "transferir.origen" ) );
		$xtpl->assign("lbl_destino",  $this->localize( "transferir.destino" ) );

		$xtpl->assign("lbl_submit",  $this->localize( "form.aceptar" ) );
		$xtpl->assign("lbl_cancel",  $this->localize( "form.cancelar" ) );

	}

	protected function parseXTemplate(XTemplate $xtpl){

		/*labels*/
		$this->parseLabels($xtpl);


		$xtpl->assign("action", $this->getLinkActionTransferir() );
		$xtpl->assign("cancel",  $this->getLinkCajaHome() );


		$msg = $this->getError();

		if( !empty($msg) ){

			$xtpl->assign("msg", $msg);
			//$xtpl->assign("msg",  );
			$xtpl->parse("main.msg_error" );
		}
	}

	public function getTitle(){
		return $this->localize("accounts.transferir.title") ;
	}

	public function getType(){

		return "Transferir";

	}


	public function getMonto()
	{
	    return $this->monto;
	}

	public function setMonto($monto)
	{
	    $this->monto = $monto;
	}

	public function getObservaciones()
	{
	    return $this->observaciones;
	}

	public function setObservaciones($observaciones)
	{
	    $this->observaciones = $observaciones;
	}

	public function getError()
	{
	    return $this->error;
	}

	public function setError($error)
	{
	    $this->error = $error;
	}


	public function getOrigenes(){

		//$cajaChica = UIServiceFactory::getUICuentaService()->getCajaChica();
		$bancos = UIServiceFactory::getUIBancoService()->getList( new UIBancoCriteria() );
		//$socios = UIServiceFactory::getUICuentaSocioService()->getList( new UICuentaSocioCriteria() );
		//cajas abiertas
		//$cajas = UIServiceFactory::getUICajaService()->getCajasAbiertas();

		$origenes = array( ) ;
		$origenes = array_merge($origenes, $bancos);
		/*$origenes = array_merge($origenes, $socios);
		$origenes = array_merge($origenes, $cajas);*/

		return $origenes;

	}

	public function getDestinos(){

		//$cajaChica = UIServiceFactory::getUICuentaService()->getCajaChica();
		$bancos = UIServiceFactory::getUIBancoService()->getList( new UIBancoCriteria() );
		/*$socios = UIServiceFactory::getUICuentaSocioService()->getList( new UICuentaSocioCriteria() );

		$accountsCorrientes = UIServiceFactory::getUICuentaCorrienteService()->getList( new UICuentaCorrienteCriteria());

		//cajas abiertas
		$cajas = UIServiceFactory::getUICajaService()->getCajasAbiertas();*/

		$destinos = array( ) ;
		//$destinos = array_merge($destinos, $cajas);
		$destinos = array_merge($destinos, $bancos);
		/*$destinos = array_merge($destinos, $socios);
		$destinos = array_merge($destinos, $accountsCorrientes);*/

		return $destinos;

	}
	public function getCuentaFinderClazz(){

		return get_class( new CuentaFinder() );

	}

	public function setOrigenOid( $origenOid ){

		if(!empty($origenOid)){

			$origen = UIServiceFactory::getUICuentaService()->get($origenOid);
			$this->origen = $origen;
		}

	}

	public function setDestinoOid( $destinoOid ){

		if(!empty($destinoOid)){

			$destino = UIServiceFactory::getUICuentaService()->get($destinoOid);
			$this->destino = $destino;
		}

	}

	public function getOrigen()
	{
	    return $this->origen;
	}

	public function setOrigen($origen)
	{
	    $this->origen = $origen;
	}

	public function getDestino()
	{
	    return $this->destino;
	}

	public function setDestino($destino)
	{
	    $this->destino = $destino;
	}

	public function getFechaHora()
	{
	    return $this->fechaHora;
	}

	public function setFechaHora($fechaHora)
	{
	    $this->fechaHora = $fechaHora;
	}
}
?>
