<?php

namespace Accounts\UI\components\boxes\gasto;

use Accounts\UI\utils\AccountsUIUtils;

use Accounts\UI\service\UIServiceFactory;

use Rasty\components\RastyComponent;
use Rasty\utils\RastyUtils;

use Rasty\utils\XTemplate;

use Accounts\Core\model\Gasto;

use Rasty\utils\LinkBuilder;

/**
 * gasto.
 *
 * @author Bernardo
 * @since 11-06-2014
 */
class GastoBox extends RastyComponent{

	private $gasto;

	public function getType(){

		return "GastoBox";

	}

	public function __construct(){


	}

	protected function parseLabels(XTemplate $xtpl){

		$xtpl->assign("lbl_fechaHora",  $this->localize( "gasto.fechaHora" ) );
		$xtpl->assign("lbl_fechaVencimiento",  $this->localize( "gasto.fechaVencimiento" ) );
		$xtpl->assign("lbl_concepto",  $this->localize( "gasto.concepto" ) );
		$xtpl->assign("lbl_observaciones",  $this->localize( "gasto.observaciones" ) );
		$xtpl->assign("lbl_monto",  $this->localize( "gasto.monto" ) );

	}

	protected function parseXTemplate(XTemplate $xtpl){

		/*labels*/
		$this->parseLabels($xtpl);

		$gasto = $this->getGasto();


		$xtpl->assign( "concepto", $this->getGasto()->getConcepto() );
		$xtpl->assign( "monto", AccountsUIUtils::formatMontoToView( $this->getGasto()->getMonto() ) );
		$xtpl->assign( "observaciones", $this->getGasto()->getObservaciones() );
		$xtpl->assign( "fechaHora", AccountsUIUtils::formatDateTimeToView($this->getGasto()->getFechaHora()) );
		$xtpl->assign( "fechaVencimiento", AccountsUIUtils::formatDateTimeToView($this->getGasto()->getFechaVencimiento()) );

	}


	protected function initObserverEventType(){
		$this->addEventType( "Gasto" );
	}

	public function setGastoOid($oid){
		if( !empty($oid) ){
			$gasto = UIServiceFactory::getUIGastoService()->get($oid);
			$this->setGasto($gasto);
		}
	}


	public function getGasto()
	{
	    return $this->gasto;
	}

	public function setGasto($gasto)
	{
	    $this->gasto = $gasto;
	}
}
?>
