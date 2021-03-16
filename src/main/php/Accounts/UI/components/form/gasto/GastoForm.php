<?php

namespace Accounts\UI\components\form\gasto;

use Accounts\UI\service\finder\ConceptoGastoFinder;

use Accounts\UI\components\filter\model\UIConceptoGastoCriteria;

use Accounts\UI\components\filter\model\UICategoriaGastoCriteria;

use Accounts\UI\service\finder\CategoriaGastoFinder;







use Accounts\UI\utils\AccountsUIUtils;

use Accounts\UI\service\UIServiceFactory;

use Accounts\Core\model\EstadoGasto;

use Rasty\Forms\form\Form;

use Rasty\components\RastyComponent;
use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;


use Accounts\Core\model\Gasto;

use Rasty\utils\LinkBuilder;

/**
 * Formulario para gasto

 * @author Bernardo
 * @since 29/05/2014
 */
class GastoForm extends Form{



	/**
	 * label para el cancel
	 * @var string
	 */
	private $labelCancel;


	/**
	 *
	 * @var Gasto
	 */
	private $gasto;


	public function __construct(){

		parent::__construct();
		$this->setLabelCancel("form.cancelar");

		$this->addProperty("fechaHora");
		$this->addProperty("fechaVencimiento");
		$this->addProperty("concepto");
		$this->addProperty("monto");
		$this->addProperty("observaciones");


		$this->setBackToOnSuccess("GastoPagar");
		$this->setBackToOnCancel("Gastos");

	}

	public function getOid(){

		return $this->getComponentById("oid")->getPopulatedValue( $this->getMethod() );
	}


	public function getType(){

		return "GastoForm";

	}

	public function fillEntity($entity){

		parent::fillEntity($entity);


	}

	protected function parseXTemplate(XTemplate $xtpl){

		parent::parseXTemplate($xtpl);


		$xtpl->assign("cancel", $this->getLinkCancel() );
		$xtpl->assign("lbl_cancel", $this->localize( $this->getLabelCancel() ) );

		$xtpl->assign("lbl_fechaHora", $this->localize("gasto.fechaHora") );
		$xtpl->assign("lbl_fechaVencimiento", $this->localize("gasto.fechaVencimiento") );
		$xtpl->assign("lbl_concepto", $this->localize("gasto.concepto") );
		$xtpl->assign("lbl_monto", $this->localize("gasto.monto") );
		$xtpl->assign("lbl_observaciones", $this->localize("gasto.observaciones") );


	}


	public function getLabelCancel()
	{
	    return $this->labelCancel;
	}

	public function setLabelCancel($labelCancel)
	{
	    $this->labelCancel = $labelCancel;
	}

	public function getConceptos(){

		$conceptos = UIServiceFactory::getUIConceptoGastoService()->getList( new UIConceptoGastoCriteria() );

		return $conceptos;

	}

	public function getConceptoGastoFinderClazz(){

		return get_class( new ConceptoGastoFinder() );

	}





	public function getLinkCancel(){
		$params = array();

		return LinkBuilder::getPageUrl( $this->getBackToOnCancel() , $params) ;
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
