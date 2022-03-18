<?php

namespace Accounts\UI\components\stats\balance;

use Accounts\UI\components\filter\model\UIMovimientoCuentaCriteria;
use Accounts\UI\service\UIMovimientoCuentaService;

use Accounts\UI\utils\AccountsUIUtils;

use Accounts\UI\service\UIServiceFactory;

use Rasty\components\RastyComponent;
use Rasty\utils\RastyUtils;

use Rasty\utils\XTemplate;

use Accounts\Core\model\Caja;

use Rasty\utils\LinkBuilder;

use Accounts\Core\utils\AccountsUtils;



use Rasty\factory\ComponentConfig;

use Rasty\factory\ComponentFactory;

use Rasty\utils\Logger;

/**
 * Balance de un mes.
 *
 * @author Marcos
 * @since 18-03-2022
 */
class BalanceMes extends RastyComponent{

	private $fecha;

	private $filter;

	private $filterType;

	public function getType(){

		return "BalanceMes";

	}

	public function __construct(){


	}

	protected function parseLabels(XTemplate $xtpl){

		$xtpl->assign("lbl_mes",  $this->localize( "balanceMes.mes" ) );
		$xtpl->assign("lbl_cuentas",  $this->localize( "balanceDia.cuentas" ) );
		$xtpl->assign("lbl_haber",  $this->localize( "balanceDia.haber" ) );
		$xtpl->assign("lbl_debe",  $this->localize( "balanceDia.debe" ) );
		$xtpl->assign("lbl_total",  $this->localize( "balanceDia.total" ) );
	}

	protected function parseXTemplate(XTemplate $xtpl){


		$componentConfig = new ComponentConfig();
	    $componentConfig->setId( "filter" );
		$componentConfig->setType( $this->getFilterType() );

	    $this->filter = ComponentFactory::buildByType($componentConfig, $this);



		$this->filter->fill( );

		$criteria = $this->filter->getCriteria();

		/*labels*/
		$this->parseLabels($xtpl);


		$fecha = $criteria->getFecha();
		if(empty($fecha)){
			$fecha = new DateTime();
		}

		$meses = AccountsUIUtils::getMeses();
		$mes = $fecha->format("n");







		$xtpl->assign("mes",  $meses[$mes] . " " . $fecha->format("Y") );

		$serviceMovimiento = UIServiceFactory::getUIMovimientoCuentaService();
		$criteriaMovimiento = new UIMovimientoCuentaCriteria();


		$fecha= AccountsUIUtils::formatDateToPersist($criteria->getFecha());

		$nuevafecha = new \DateTime($fecha);


		//$fechaHasta->modify('+1 day');
		//Logger::log($nuevafecha);

		$fechaDesde = AccountsUtils::getFirstDayOfMonth( $nuevafecha );
		$fechaHasta = AccountsUtils::getLastDayOfMonth( $nuevafecha);


		$criteriaMovimiento->setFechaDesde( $fechaDesde);
		$criteriaMovimiento->setFechaHasta(  $fechaHasta);

		if ($criteria->getCuenta()){
			$criteriaMovimiento->setCuenta($criteria->getCuenta());
		}

		$movimientoHaber = $serviceMovimiento->getTotalesHaber($criteriaMovimiento);
		$movimientoDebe = $serviceMovimiento->getTotalesDebe($criteriaMovimiento);

		$total = $movimientoHaber-$movimientoDebe;

		$xtpl->assign("haber", AccountsUIUtils::formatMontoToView($movimientoHaber)  );
		$xtpl->assign("debe", AccountsUIUtils::formatMontoToView((-1)*$movimientoDebe)  );
		$xtpl->assign("total", AccountsUIUtils::formatMontoToView($total)  );



	}


	public function getFecha()
	{
	    return $this->fecha;
	}

	public function setFecha($fecha)
	{
	    $this->fecha = $fecha;
	}

	protected function initObserverEventType(){
		//TODO $this->addEventType( "Venta" );
	}

	public function getFilterType()
	{
	    return $this->filterType;
	}

	public function setFilterType($filterType)
	{
	    $this->filterType = $filterType;
	}
}
?>
