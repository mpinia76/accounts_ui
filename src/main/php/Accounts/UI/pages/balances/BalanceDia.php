<?php
namespace Accounts\UI\pages\balances;

use Accounts\UI\components\filter\model\UIMovimientoCuentaCriteria;
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

use Accounts\Core\criteria\MovimientoCuentaCriteria;

class BalanceDia extends AccountsPage{



	public function __construct(){


		//$this->fecha = new \DateTime();

	}

	public function getUicriteriaClazz(){
		return get_class( new UIMovimientoCuentaCriteria() );
	}

	protected function parseXTemplate(XTemplate $xtpl){

		$xtpl->assign("legend_operaciones", $this->localize("grid.operaciones") );
		$xtpl->assign("legend_resultados", $this->localize("grid.resultados") );


	}

	public function getTitle(){
		return $this->localize("balanceDia.title") ;
	}

	public function getType(){

		return "BalanceDia";

	}




}
?>
