<?php
namespace Accounts\UI\pages\informes\comisiones;

use Accounts\UI\pages\AccountsPage;

use Accounts\UI\components\filter\model\UIInformeDiarioComisionCriteria;

use Accounts\UI\components\grid\model\InformeDiarioComisionGridModel;

use Accounts\UI\service\UIInformeDiarioComisionService;

use Accounts\UI\utils\AccountsUtils;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\i18n\Locale;

use Accounts\Core\model\InformeDiarioComision;
use Accounts\Core\criteria\InformeDiarioComisionCriteria;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;


/**
 * Página para consultar los informes diarios de comisión.
 *
 * @author Bernardo
 * @since 16/04/2015
 *
 */
class InformesDiariosComision extends AccountsPage{


	public function __construct(){

	}

	public function getTitle(){
		return $this->localize( "informesDiariosComision.title" );
	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario
		//y utilizando permisos

		$menuGroup = new MenuGroup();

		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "menu.informesDiariosComision.agregar") );
		$menuOption->setPageName("InformeDiarioComisionAgregar");
		$menuOption->setIconClass( "icon-agregar fg-green" );
		$menuGroup->addMenuOption( $menuOption );


		return array($menuGroup);
	}

	public function getType(){

		return "InformesDiariosComision";

	}

	public function getModelClazz(){
		return get_class( new InformeDiarioComisionGridModel() );
	}

	public function getUicriteriaClazz(){
		return get_class( new UIInformeDiarioComisionCriteria() );
	}

	protected function parseXTemplate(XTemplate $xtpl){

		$xtpl->assign("legend_operaciones", $this->localize("grid.operaciones") );
		$xtpl->assign("legend_resultados", $this->localize("grid.resultados") );

		$xtpl->assign("agregar_label", $this->localize("informeDiarioComision.agregar") );
	}

}
?>
