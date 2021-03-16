<?php
namespace Accounts\UI\pages\gastos\agregar;

use Accounts\Core\utils\AccountsUtils;
use Accounts\UI\utils\AccountsUIUtils;

use Accounts\UI\pages\AccountsPage;

use Rasty\utils\XTemplate;
use Accounts\Core\model\Gasto;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

class GastoAgregar extends AccountsPage{

	/**
	 * gasto a agregar.
	 * @var Gasto
	 */
	private $gasto;


	public function __construct(){

		//inicializamos el gasto.
		$gasto = new Gasto();

		$gasto->setFechaHora( new \Datetime() );
		//$gasto->setSucursal( AccountsUIUtils::getSucursal() );
		//$gasto->setConcepto( AccountsUtils::getConceptoGastoVarios() );

		$this->setGasto($gasto);


	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario
		//y utilizando permisos

		$menuGroup = new MenuGroup();

//		$menuOption = new MenuOption();
//		$menuOption->setLabel( $this->localize( "form.volver") );
//		$menuOption->setPageName("Gastos");
//		$menuGroup->addMenuOption( $menuOption );
//

		return array($menuGroup);
	}

	public function getTitle(){
		return $this->localize( "gasto.agregar.title" );
	}

	public function getType(){

		return "GastoAgregar";

	}

	protected function parseXTemplate(XTemplate $xtpl){
		$gastoForm = $this->getComponentById("gastoForm");
		$gastoForm->fillFromSaved( $this->getGasto() );

	}


	public function getGasto()
	{
	    return $this->gasto;
	}

	public function setGasto($gasto)
	{
	    $this->gasto = $gasto;
	}



	public function getMsgError(){
		return "";
	}
}
?>
