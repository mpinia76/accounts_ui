<?php

namespace Accounts\UI\components\filter\site;

use Accounts\UI\components\filter\model\UISiteCriteria;

use Accounts\UI\components\grid\model\SiteGridModel;

use Rasty\Grid\filter\Filter;
use Rasty\utils\XTemplate;
use Rasty\utils\LinkBuilder;

/**
 * Filtro para buscar sites
 *
 * @author Marcos
 * @since 15/03/2021
 */
class SiteFilter extends Filter{

	public function getType(){

		return "SiteFilter";
	}


	public function __construct(){

		parent::__construct();

		$this->setGridModelClazz( get_class( new SiteGridModel() ));

		$this->setUicriteriaClazz( get_class( new UISiteCriteria()) );

		//$this->setSelectRowCallback("seleccionarSite");

		//agregamos las propiedades a popular en el submit.
		$this->addProperty("nombre");

	}

	protected function parseXTemplate(XTemplate $xtpl){

		//rellenamos el nombre con el texto inicial
		$this->fillInput("nombre", $this->getInitialText() );

		parent::parseXTemplate($xtpl);

		$xtpl->assign("lbl_nombre",  $this->localize("site.nombre") );

		//$xtpl->assign("linkSeleccionar",  LinkBuilder::getPageUrl( "HistoriaClinica") );
		$xtpl->assign("linkSeleccionar",  LinkBuilder::getPageUrl( "SiteModificar") );


	}
}
?>
