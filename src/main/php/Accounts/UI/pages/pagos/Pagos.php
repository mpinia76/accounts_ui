<?php
namespace Accounts\UI\pages\pagos;

use Accounts\UI\pages\AccountsPage;

use Accounts\UI\components\filter\model\UIPagoCriteria;

use Accounts\UI\components\grid\model\PagoGridModel;

use Accounts\UI\service\UIPagoService;

use Accounts\UI\utils\AccountsUtils;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\i18n\Locale;

use Accounts\Core\model\Pago;
use Accounts\Core\criteria\PagoCriteria;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;


/**
 * Página para consultar los pagos.
 *
 * @author Bernardo
 * @since 13-06-2014
 *
 */
class Pagos extends AccountsPage{


	public function __construct(){

	}

	public function getTitle(){
		return $this->localize( "pagos.title" );
	}

	public function getMenuGroups(){

		$menuGroup = new MenuGroup();


		return array($menuGroup);
	}

	public function getType(){

		return "Pagos";

	}

	public function getModelClazz(){
		return get_class( new PagoGridModel() );
	}

	public function getUicriteriaClazz(){
		return get_class( new UIPagoCriteria() );
	}

	protected function parseXTemplate(XTemplate $xtpl){

		$xtpl->assign("legend_operaciones", $this->localize("grid.operaciones") );
		$xtpl->assign("legend_resultados", $this->localize("grid.resultados") );

	}

}
?>
