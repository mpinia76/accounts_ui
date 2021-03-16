<?php
namespace Accounts\UI\pages\caja\ingresarEfectivo;

use Accounts\UI\service\UICajaService;

use Accounts\UI\pages\AccountsPage;

use Accounts\UI\service\UIServiceFactory;

use Accounts\UI\utils\AccountsUIUtils;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\i18n\Locale;
use Rasty\utils\LinkBuilder;

use Accounts\Core\model\Caja;

use Rasty\Grid\filter\model\UICriteria;

use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

class IngresarEfectivo extends AccountsPage{

	private $caja;

	private $monto;
	private $observaciones;

	private $error;

	public function __construct(){


		$this->caja = UIServiceFactory::getUICajaService()->get( AccountsUIUtils::getCaja()->getOid() );

	}

	protected function parseLabels(XTemplate $xtpl){

		$xtpl->assign("legend",  $this->localize( "caja.ingresarEfectivo.legend" ) );

		$xtpl->assign("lbl_montoIngresar",  $this->localize( "ingresarEfectivo.montoIngresar" ) );
		$xtpl->assign("lbl_observaciones",  $this->localize( "ingresarEfectivo.observaciones" ) );

		$xtpl->assign("caja_legend",  $this->localize( "caja.ingresarEfectivo.caja_legend" ) );

		$xtpl->assign("lbl_submit",  $this->localize( "form.aceptar" ) );
		$xtpl->assign("lbl_cancel",  $this->localize( "form.cancelar" ) );

	}

	protected function parseXTemplate(XTemplate $xtpl){

		/*labels*/
		$this->parseLabels($xtpl);


		$caja = $this->getCaja();

		if( !empty($caja) ){

			$xtpl->assign("action", $this->getLinkActionIngresarEfectivo() );
			$xtpl->assign("cancel",  $this->getLinkCajaHome() );

		}else{
		}

		$msg = $this->getError();

		if( !empty($msg) ){

			$xtpl->assign("msg", $msg);
			//$xtpl->assign("msg",  );
			$xtpl->parse("main.msg_error" );
		}
	}

	public function getTitle(){
		return $this->localize("caja.ingresarEfectivo.title") ;
	}

	public function getType(){

		return "IngresarEfectivo";

	}


	public function getCaja()
	{
	    return $this->caja;
	}

	public function setCaja($caja)
	{
	    $this->caja = $caja;
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
}
?>
