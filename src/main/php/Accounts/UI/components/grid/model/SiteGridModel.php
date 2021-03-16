<?php
namespace Accounts\UI\components\grid\model;


use Accounts\UI\utils\AccountsUIUtils;

use Accounts\UI\components\filter\model\UISiteCriteria;

use Rasty\Grid\entitygrid\EntityGrid;
use Rasty\Grid\entitygrid\model\EntityGridModel;
use Rasty\Grid\entitygrid\model\GridModelBuilder;
use Rasty\Grid\filter\model\UICriteria;

use Accounts\Core\utils\AccountsUtils;

use Accounts\UI\service\UIServiceFactory;
use Rasty\utils\RastyUtils;
use Rasty\utils\Logger;
use Rasty\security\RastySecurityContext;

use Rasty\Menu\menu\model\MenuOption;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuActionOption;
use Rasty\Menu\menu\model\MenuActionAjaxOption;

/**
 * Model para la grilla de sites.
 *
 * @author Marcos
 * @since 15/03/2021
 */
class SiteGridModel extends EntityGridModel{

	public function __construct() {

        parent::__construct();
        $this->initModel();

    }

    public function getService(){

    	return UIServiceFactory::getUISiteService();
    }

    public function getFilter(){

    	$filter = new UISiteCriteria();
		return $filter;
    }

	protected function initModel() {

		$this->setHasCheckboxes( false );

		$column = GridModelBuilder::buildColumn( "oid", "site.oid", 20, EntityGrid::TEXT_ALIGN_RIGHT );
		$this->addColumn( $column );

		$column = GridModelBuilder::buildColumn( "nombre", "site.nombre", 30, EntityGrid::TEXT_ALIGN_LEFT ) ;
		$this->addColumn( $column );




	}

	public function getDefaultFilterField() {
        return "nombre";
    }

	public function getDefaultOrderField(){
		return "nombre";
	}


    /**
	 * opciones de menú dado el item
	 * @param unknown_type $item
	 */
	public function getMenuGroups( $item ){

		$group = new MenuGroup();
		$group->setLabel("grupo");
		$options = array();

		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "menu.sites.modificar") );
		$menuOption->setPageName( "SiteModificar" );
		$menuOption->addParam("oid",$item->getOid());
		$menuOption->setImageSource( $this->getWebPath() . "css/images/editar_32.png" );
		$options[] = $menuOption ;






		$menuOption = new MenuActionAjaxOption();
		$menuOption->setLabel( $this->localize( "menu.site.eliminar") );
		$menuOption->setActionName( "EliminarSite" );
		$menuOption->setConfirmMessage( $this->localize( "site.eliminar.confirm.msg") );
		$menuOption->setConfirmTitle( $this->localize( "site.eliminar.confirm.title") );
		$menuOption->setOnSuccessCallback( "eliminarCallback" );
		$menuOption->addParam("siteOid",$item->getOid());
		$menuOption->setImageSource( $this->getWebPath() . "css/images/eliminar_32.png" );
		$options[] = $menuOption ;


        $menuOption = new MenuOption();
        $menuOption->setLabel( $this->localize( "menu.site.asignarUsuarios") );
        $menuOption->setPageName( "UsuarioAsignar" );
        $menuOption->addParam("oid",$item->getOid());
        //$menuOption->setIconClass( "icon-roles" );
        $options[] = $menuOption ;

        $menuOption = new MenuOption();
        $menuOption->setLabel( $this->localize( "menu.site.consultarUsuarios") );
        $menuOption->setPageName( "UsuarioConsultar" );
        $menuOption->addParam("oid",$item->getOid());
        //$menuOption->setIconClass( "icon-consultar" );
        $options[] = $menuOption ;

		$group->setMenuOptions( $options );

		return array( $group );

	}

}
?>
