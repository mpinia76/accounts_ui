<?php

namespace Accounts\UI\components\boxes\pago;

use Accounts\UI\utils\AccountsUIUtils;

use Accounts\UI\service\UIServiceFactory;

use Rasty\components\RastyComponent;
use Rasty\utils\RastyUtils;

use Rasty\utils\XTemplate;

use Accounts\Core\model\Pago;
use Accounts\Core\model\EstadoPago;

use Rasty\utils\LinkBuilder;

/**
 * pago.
 *
 * @author Bernardo
 * @since 11-06-2014
 */
class PagoBox extends RastyComponent{

	private $pago;

	public function getType(){

		return "PagoBox";

	}

	public function __construct(){


	}

	protected function parseLabels(XTemplate $xtpl){

		$xtpl->assign("lbl_fechaHora",  $this->localize( "pago.fechaHora" ) );
		$xtpl->assign("lbl_sucursal",  $this->localize( "pago.sucursal" ) );
		$xtpl->assign("lbl_cobrador",  $this->localize( "pago.cobrador" ) );
		$xtpl->assign("lbl_cliente",  $this->localize( "pago.cliente" ) );
		$xtpl->assign("lbl_observaciones",  $this->localize( "pago.observaciones" ) );
		$xtpl->assign("lbl_monto",  $this->localize( "pago.monto" ) );
		$xtpl->assign("lbl_estado",  $this->localize( "pago.estado" ) );

	}

	protected function parseXTemplate(XTemplate $xtpl){

		/*labels*/
		$this->parseLabels($xtpl);

		$pago = $this->getPago();


		$xtpl->assign( "cobrador", $this->getPago()->getCobrador() );
		$xtpl->assign( "cliente", $this->getPago()->getCliente() );
		$xtpl->assign( "sucursal", $this->getPago()->getSucursal() );
		$xtpl->assign( "monto", AccountsUIUtils::formatMontoToView( $this->getPago()->getMonto() ) );
		$xtpl->assign( "observaciones", $this->getPago()->getObservaciones() );
		$xtpl->assign( "fechaHora", AccountsUIUtils::formatDateTimeToView($this->getPago()->getFechaHora()) );
		$xtpl->assign( "estado", $this->localize( EstadoPago::getLabel( $pago->getEstado()) ) );

	}


	protected function initObserverEventType(){
		$this->addEventType( "Pago" );
	}

	public function setPagoOid($oid){
		if( !empty($oid) ){
			$pago = UIServiceFactory::getUIPagoService()->get($oid);
			$this->setPago($pago);
		}
	}


	public function getPago()
	{
	    return $this->pago;
	}

	public function setPago($pago)
	{
	    $this->pago = $pago;
	}
}
?>
