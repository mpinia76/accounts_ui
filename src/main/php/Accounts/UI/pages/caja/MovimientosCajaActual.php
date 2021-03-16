<?php
namespace Accounts\UI\pages\caja;

use Accounts\UI\service\UIServiceFactory;

use Accounts\UI\utils\AccountsUIUtils;

use Accounts\UI\components\filter\model\UIMovimientoCuentaCriteria;

use Accounts\UI\components\grid\model\MovimientoCuentaGridModel;

use Accounts\UI\pages\AccountsPage;

use Accounts\UI\utils\AccountsUtils;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\i18n\Locale;

use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;


/**
 * Página para consultar los movimientos de la caja actual.
 *
 * @author Bernardo
 * @since 28/05/2014
 *
 */
class MovimientosCajaActual extends AccountsPage{


	public function __construct(){

	}

	public function getTitle(){
		return $this->localize( "caja.movimientos.title" );
	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario
		//y utilizando permisos

		$menuGroup = new MenuGroup();

//		$menuOption = new MenuOption();
//		$menuOption->setLabel( $this->localize( "cliente.agregar") );
//		$menuOption->setPageName("ClienteAgregar");
//		$menuOption->setImageSource( $this->getWebPath() . "css/images/add_over_48.png" );
//		$menuGroup->addMenuOption( $menuOption );


		return array($menuGroup);
	}

	public function getType(){

		return "MovimientosCajaActual";

	}

	public function getModelClazz(){
		return get_class( new MovimientoCuentaGridModel() );
	}

	public function getUicriteriaClazz(){
		return get_class( new UIMovimientoCuentaCriteria() );
	}

	protected function parseXTemplate(XTemplate $xtpl){

		$xtpl->assign("legend_operaciones", $this->localize("grid.operaciones") );
		$xtpl->assign("legend_resultados", $this->localize("grid.resultados") );

		//$xtpl->assign("agregar_label", $this->localize("cliente.agregar") );
	}

	public function getCaja(){
		$caja = AccountsUIUtils::getCaja();
		$caja = UIServiceFactory::getUICajaService()->get( $caja->getOid() );
		return $caja;
	}
}
?>
