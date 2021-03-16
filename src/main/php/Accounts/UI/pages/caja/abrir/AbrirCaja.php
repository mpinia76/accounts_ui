<?php
namespace Accounts\UI\pages\caja\abrir;

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

class AbrirCaja extends AccountsPage{

	private $caja;

	public function __construct(){


		$this->caja = new Caja();

		$this->caja->setCajero( AccountsUIUtils::getEmpleadoLogged() );
		$this->caja->setSucursal( AccountsUIUtils::getSucursal() );
		$this->caja->setFecha ( new \DateTime() );
		$this->caja->setHoraApertura( new \DateTime() );
		$this->caja->setNumero( 1 );


	}


	protected function parseXTemplate(XTemplate $xtpl){

	}

	public function getTitle(){
		return $this->localize("caja.abrir.title") ;
	}

	public function getType(){

		return "AbrirCaja";

	}


	public function getCaja()
	{
	    return $this->caja;
	}

	public function setCaja($caja)
	{
	    $this->caja = $caja;
	}
}
?>
