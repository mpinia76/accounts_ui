<?php

namespace Accounts\UI\components\filter\pago;

use Accounts\UI\components\filter\model\UIPagoCriteria;

use Accounts\UI\components\grid\model\PagoGridModel;

use Rasty\Grid\filter\Filter;
use Rasty\utils\XTemplate;
use Rasty\utils\LinkBuilder;

/**
 * Filtro para buscar pagos
 *
 * @author Bernardo
 * @since 13-06-2014
 */
class PagoFilter extends Filter{

	public function getType(){

		return "PagoFilter";
	}


	public function __construct(){

		parent::__construct();

		$this->setGridModelClazz( get_class( new PagoGridModel() ));

		$this->setUicriteriaClazz( get_class( new UIPagoCriteria()) );

		//$this->setSelectRowCallback("seleccionarPago");

		//agregamos las propiedades a popular en el submit.
		$this->addProperty("fechaDesde");
		$this->addProperty("fechaHasta");
		$this->addProperty("filtroPredefinido");
	}


/*
	public function fill($defaultOrder="", $defaultOrderType=""){

		///si se eligió un filtro predefinido, seteamos al filtro de acuerdo a eso.

		//hacemos el fill del criteria.
		$this->fillEntity( $this->getCriteria() );

		//le agregramos el order y la paginación.
		$orderBy = RastyUtils::getParamPOST("orderBy", $defaultOrder);
		$orderByType = RastyUtils::getParamPOST("orderByType", $defaultOrderType);
		if(!empty($orderBy))
			$this->getCriteria()->addOrder($orderBy, $orderByType);

		$page = RastyUtils::getParamPOST("page");
		$this->getCriteria()->setPage($page);

	}

	*/

	protected function parseXTemplate(XTemplate $xtpl){

		//TODO rellenamos los campos del filtro predefinido
		//$this->fillInput("nombre", $this->getInitialText() );

		parent::parseXTemplate($xtpl);

		$xtpl->assign("lbl_fechaDesde",  $this->localize("criteria.fechaDesde") );
		$xtpl->assign("lbl_fechaHasta",  $this->localize("criteria.fechaHasta") );

		$xtpl->assign("lbl_predefinidos",  $this->localize("criteria.predefinidos") );

		//$xtpl->assign("linkSeleccionar",  LinkBuilder::getPageUrl( "HistoriaClinica") );
		$xtpl->assign("linkSeleccionar",  LinkBuilder::getPageUrl( "PagoModificar") );


	}

	public function getFiltrosPredefinidos(){

		$items = array();

		$items[ UIPagoCriteria::HOY ] = $this->localize("pago.filter.hoy");
		$items[ UIPagoCriteria::SEMANA_ACTUAL ] = $this->localize("pago.filter.semanaActual");
		$items[ UIPagoCriteria::MES_ACTUAL ] = $this->localize("pago.filter.mesActual");
		$items[ UIPagoCriteria::ANIO_ACTUAL ] = $this->localize("pago.filter.anioActual");
		$items[ UIPagoCriteria::IMPAGAS ] = $this->localize("pago.filter.impagas");
		$items[ UIPagoCriteria::ANULADAS ] = $this->localize("pago.filter.anuladas");

		return $items;

	}

}
?>
