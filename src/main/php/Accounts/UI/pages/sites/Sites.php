<?php
namespace Accounts\UI\pages\sites;

use Accounts\UI\service\UIServiceFactory;

use Accounts\UI\components\filter\model\UISiteCriteria;

use Accounts\UI\components\grid\model\SiteGridModel;

use Accounts\UI\pages\AccountsPage;

use Accounts\UI\utils\AccountsUtils;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\i18n\Locale;

use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;


/**
 * Página para consultar los movimientos de banco.
 *
 * @author Marcos
 * @since 15-03-2021
 *
 */
class Sites extends AccountsPage{


	public function __construct(){

	}

	public function getTitle(){
		return $this->localize( "site.title" );
	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario
		//y utilizando permisos

		$menuGroup = new MenuGroup();

		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "site.agregar") );
		$menuOption->setPageName("SiteAgregar");
		$menuOption->setImageSource( $this->getWebPath() . "css/images/add_over_48.png" );
		$menuGroup->addMenuOption( $menuOption );


		return array($menuGroup);
	}

	public function getType(){

		return "Sites";

	}

	public function getModelClazz(){
		return get_class( new SiteGridModel() );
	}

	public function getUicriteriaClazz(){
		return get_class( new UISiteCriteria() );
	}

	protected function parseXTemplate(XTemplate $xtpl){

		$xtpl->assign("legend_operaciones", $this->localize("grid.operaciones") );
		$xtpl->assign("legend_resultados", $this->localize("grid.resultados") );

		$xtpl->assign("agregar_label", $this->localize("site.agregar") );
	}


}
?>
