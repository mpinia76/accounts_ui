<?php
namespace Accounts\UI\pages\conceptoGastos\agregar;

use Accounts\UI\pages\AccountsPage;

use Rasty\utils\XTemplate;
use Accounts\Core\model\ConceptoGasto;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

class ConceptoGastoAgregar extends AccountsPage{

	/**
	 * ConceptoGasto a agregar.
	 * @var ConceptoGasto
	 */
	private $ConceptoGasto;


	public function __construct(){

		//inicializamos el ConceptoGasto.
		$conceptoGasto = new ConceptoGasto();

		//$ConceptoGasto->setNombre("Bernardo");
		//$ConceptoGasto->setEmail("ber@mail.com");
		$this->setConceptoGasto($conceptoGasto);


	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario
		//y utilizando permisos

		$menuGroup = new MenuGroup();

		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "form.volver") );
		$menuOption->setPageName("ConceptoGastos");
		$menuGroup->addMenuOption( $menuOption );


		return array($menuGroup);
	}

	public function getTitle(){
		return $this->localize( "conceptoGasto.agregar.title" );
	}

	public function getType(){

		return "ConceptoGastoAgregar";

	}

	protected function parseXTemplate(XTemplate $xtpl){
		$conceptoGastoForm = $this->getComponentById("conceptoGastoForm");
		$conceptoGastoForm->fillFromSaved( $this->getConceptoGasto() );

	}


	public function getConceptoGasto()
	{
	    return $this->ConceptoGasto;
	}

	public function setConceptoGasto($ConceptoGasto)
	{
	    $this->ConceptoGasto = $ConceptoGasto;
	}



	public function getMsgError(){
		return "";
	}
}
?>
