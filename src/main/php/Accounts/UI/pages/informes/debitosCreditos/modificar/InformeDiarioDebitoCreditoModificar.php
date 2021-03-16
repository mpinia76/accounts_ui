<?php
namespace Accounts\UI\pages\informes\debitosCreditos\modificar;

use Accounts\UI\pages\AccountsPage;

use Accounts\UI\service\UIServiceFactory;

use Rasty\utils\XTemplate;
use Accounts\Core\model\InformeDiarioDebitoCredito;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

class InformeDiarioDebitoCreditoModificar extends AccountsPage{

	/**
	 * informeDiarioDebitoCredito a modificar.
	 * @var InformeDiarioDebitoCredito
	 */
	private $informeDiarioDebitoCredito;


	public function __construct(){

		//inicializamos el informeDiarioDebitoCredito.
		$informeDiarioDebitoCredito = new InformeDiarioDebitoCredito();
		$this->setInformeDiarioDebitoCredito($informeDiarioDebitoCredito);

	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario
		//y utilizando permisos

		$menuGroup = new MenuGroup();

		return array($menuGroup);
	}

	public function setInformeDiarioDebitoCreditoOid($oid){

		//a partir del id buscamos el informeDiarioDebitoCredito a modificar.
		$informeDiarioDebitoCredito = UIServiceFactory::getUIInformeDiarioDebitoCreditoService()->get($oid);

		$this->setInformeDiarioDebitoCredito($informeDiarioDebitoCredito);

	}

	public function getTitle(){
		return $this->localize( "informeDiarioDebitoCredito.modificar.title" );
	}

	public function getType(){

		return "InformeDiarioDebitoCreditoModificar";

	}

	protected function parseXTemplate(XTemplate $xtpl){

	}

	public function getInformeDiarioDebitoCredito(){

	    return $this->informeDiarioDebitoCredito;
	}

	public function setInformeDiarioDebitoCredito($informeDiarioDebitoCredito)
	{
	    $this->informeDiarioDebitoCredito = $informeDiarioDebitoCredito;
	}
}
?>
