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
 * Balance del anio.
 *
 * @author Marcos
 * @since 18-03-2022
 */
class BalanceAnio extends RastyComponent{

	private $fecha;

	private $filter;

	private $filterType;


	public function getType(){

		return "BalanceDia";

	}

	public function __construct(){


	}

	protected function parseLabels(XTemplate $xtpl){

		$xtpl->assign("lbl_anio",  $this->localize( "balanceAnio.anio" ) );
		$xtpl->assign("lbl_mes",  $this->localize( "balanceAnio.mes" ) );
		$xtpl->assign("lbl_cuentas",  $this->localize( "balanceDia.cuentas" ) );
		$xtpl->assign("lbl_haber",  $this->localize( "balanceDia.haber" ) );
		$xtpl->assign("lbl_debe",  $this->localize( "balanceDia.debe" ) );
		$xtpl->assign("lbl_total",  $this->localize( "balanceDia.total" ) );
		$xtpl->assign("detalle_mes_legend",  $this->localize( "balanceAnio.detalle_mes.legend" ) );


	}

	protected function parseXTemplate(XTemplate $xtpl){
		ini_set('max_execution_time', '0');
		$componentConfig = new ComponentConfig();
	    $componentConfig->setId( "filter" );
		$componentConfig->setType( $this->getFilterType() );

	    $this->filter = ComponentFactory::buildByType($componentConfig, $this);



		$this->filter->fill( );

		$criteria = $this->filter->getCriteria();

		/*labels*/
		$this->parseLabels($xtpl);

		$fecha = $criteria->getFecha();
		if(empty($fecha))
			$fecha = new DateTime();




		$balances = array();

		$anio = $fecha->format("Y");

		$meses = AccountsUIUtils::getMeses();

		for ($mes = 1; $mes <=12; $mes++) {
			$balances[$mes] = array( "ventas" => 0,

										"ganancias" => 0,
										"mes_nombre" => $meses[$mes]);
		}


		$xtpl->assign("anio",  $fecha->format("Y"));
		$serviceMovimiento = UIServiceFactory::getUIMovimientoCuentaService();
		$criteriaMovimiento = new UIMovimientoCuentaCriteria();


		$fecha= AccountsUIUtils::formatDateToPersist($criteria->getFecha());

		$nuevafecha = new \DateTime($fecha);


		//$fechaHasta->modify('+1 day');
		//Logger::log($nuevafecha);

		$fechaDesde = AccountsUtils::getFirstDayOfYear( $nuevafecha );
		$fechaHasta = AccountsUtils::getLastDayOfYear( $nuevafecha);


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


		$detalles = $balances;

		for ($mes = 1; $mes <=12; $mes++) {

			$xtpl->assign("mes",  $detalles[$mes]["mes_nombre"] );

            $year = AccountsUIUtils::yearOfDate($criteria->getFecha());

            $fechames = new \DateTime($year.'-'.$mes.'-01');

			$fechaDesdemes = AccountsUtils::getFirstDayOfMonth( $fechames );
			$fechaHastames = AccountsUtils::getLastDayOfMonth( $fechames);


			$serviceMovimientoMes = UIServiceFactory::getUIMovimientoCuentaService();
			$criteriaMovimientoMes = new UIMovimientoCuentaCriteria();

			$criteriaMovimientoMes->setFechaDesde( $fechaDesdemes);
			$criteriaMovimientoMes->setFechaHasta(  $fechaHastames);

			if ($criteria->getCuenta()){
				$criteriaMovimientoMes->setCuenta($criteria->getCuenta());
			}

			$movimientoHabermes = $serviceMovimientoMes->getTotalesHaber($criteriaMovimientoMes);
			$movimientoDebemes = $serviceMovimientoMes->getTotalesDebe($criteriaMovimientoMes);

			$totalmes = $movimientoHabermes-$movimientoDebemes;

			$xtpl->assign("habermes", AccountsUIUtils::formatMontoToView($movimientoHabermes)  );
			$xtpl->assign("debemes", AccountsUIUtils::formatMontoToView((-1)*$movimientoDebemes)  );
			$xtpl->assign("totalmes", AccountsUIUtils::formatMontoToView($totalmes)  );

			$xtpl->parse("main.detalle_mes.mes");

		}

		$xtpl->parse("main.detalle_mes");

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
