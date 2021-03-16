<?php
namespace Accounts\UI\pages\balances;

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

class BalanceDia extends AccountsPage{

	private $fecha;

	public function __construct(){


		$this->fecha = new \DateTime();

	}

	protected function parseLabels(XTemplate $xtpl){

		$xtpl->assign("legend",  $this->localize( "balanceDia.legend" ) );


	}

	protected function parseXTemplate(XTemplate $xtpl){

		/*labels*/
		$this->parseLabels($xtpl);


	}

	public function getTitle(){
		return $this->localize("balanceDia.title") ;
	}

	public function getType(){

		return "BalanceDia";

	}


	public function getFecha()
	{
	    return $this->fecha;
	}

	public function setFecha($fecha)
	{
	    $this->fecha = $fecha;
	}

		public function setStrFecha($strFecha){
		if( !empty($strFecha) ){
			$fecha = AccountsUIUtils::newDateTime($strFecha) ;
			$this->setFecha($fecha);
		}
	}

}
?>
