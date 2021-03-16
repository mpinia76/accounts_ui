<?php
namespace Accounts\UI\components\grid\model;

use Accounts\UI\utils\AccountsUIUtils;

use Accounts\UI\components\grid\formats\GridImporteFormat;

use Accounts\UI\components\grid\formats\GridEstadoInformeSemanalFormat;

use Accounts\UI\components\filter\model\UIInformeSemanalCriteria;

use Rasty\Grid\entitygrid\EntityGrid;
use Rasty\Grid\entitygrid\model\EntityGridModel;
use Rasty\Grid\entitygrid\model\GridModelBuilder;
use Rasty\Grid\filter\model\UICriteria;
use Rasty\Grid\entitygrid\model\GridDatetimeFormat;
use Accounts\UI\service\UIServiceFactory;
use Rasty\utils\RastyUtils;
use Rasty\utils\Logger;

use Rasty\Menu\menu\model\MenuOption;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuActionOption;
use Rasty\Menu\menu\model\MenuActionAjaxOption;

/**
 * Model para la grilla de Informes Semanales.
 *
 * @author Bernardo
 * @since 14/04/2015
 */
class InformeSemanalGridModel extends EntityGridModel{

	public function __construct() {

        parent::__construct();
        $this->initModel();

    }

    public function getService(){

    	return UIServiceFactory::getUIInformeSemanalService();
    }

    public function getFilter(){

    	$filter = new UIInformeSemanalCriteria();
		return $filter;
    }

	protected function initModel() {

		$this->setHasCheckboxes( false );

		$column = GridModelBuilder::buildColumn( "oid", "informeSemanal.oid", 20, EntityGrid::TEXT_ALIGN_RIGHT );
		$this->addColumn( $column );

		$column = GridModelBuilder::buildColumn( "fechaDesde", "informeSemanal.fechaDesde", 20, EntityGrid::TEXT_ALIGN_CENTER, new GridDatetimeFormat("d/m/Y") );
		$this->addColumn( $column );

		$column = GridModelBuilder::buildColumn( "fechaHasta", "informeSemanal.fechaHasta", 20, EntityGrid::TEXT_ALIGN_CENTER, new GridDatetimeFormat("d/m/Y") );
		$this->addColumn( $column );

		$column = GridModelBuilder::buildColumn( "ventas", "informeSemanal.ventas", 20, EntityGrid::TEXT_ALIGN_RIGHT, new GridImporteFormat() );
		$this->addColumn( $column );

		$column = GridModelBuilder::buildColumn( "cancelaciones", "informeSemanal.cancelaciones", 20, EntityGrid::TEXT_ALIGN_RIGHT, new GridImporteFormat() );
		$this->addColumn( $column );

		$column = GridModelBuilder::buildColumn( "pagos", "informeSemanal.pagos", 20, EntityGrid::TEXT_ALIGN_RIGHT, new GridImporteFormat() );
		$this->addColumn( $column );

		$column = GridModelBuilder::buildColumn( "pagoPorLoteria", "informeSemanal.pagoPorLoteria", 20, EntityGrid::TEXT_ALIGN_RIGHT, new GridImporteFormat() );
		$this->addColumn( $column );

		$column = GridModelBuilder::buildColumn( "comision", "informeSemanal.comision", 20, EntityGrid::TEXT_ALIGN_RIGHT, new GridImporteFormat() );
		$this->addColumn( $column );

		$column = GridModelBuilder::buildColumn( "ajustes", "informeSemanal.ajustes", 20, EntityGrid::TEXT_ALIGN_RIGHT, new GridImporteFormat() );
		$this->addColumn( $column );

		$column = GridModelBuilder::buildColumn( "deuda", "informeSemanal.deuda", 20, EntityGrid::TEXT_ALIGN_RIGHT, new GridImporteFormat() );
		$this->addColumn( $column );

	}

	public function getDefaultFilterField() {
        return "fechaDesde";
    }

	public function getDefaultOrderField(){
		return "fechaDesde";
	}

	public function getDefaultOrderType(){
		return "DESC";
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
		$menuOption->setLabel( $this->localize( "menu.informesSemanales.modificar") );
		$menuOption->setPageName( "InformeSemanalModificar" );
		$menuOption->addParam("oid",$item->getOid());
		//$menuOption->setImageSource( $this->getWebPath() . "css/images/pagar_32.png" );
		$menuOption->setIconClass( "icon-editar" );
		$options[] = $menuOption ;

		$group->setMenuOptions( $options );

		return array( $group );

	}

	public function getRowStyleClass($item){

		//return AccountsUIUtils::getEstadoInformeSemanalCss($item->getEstado());

	}

}
?>
