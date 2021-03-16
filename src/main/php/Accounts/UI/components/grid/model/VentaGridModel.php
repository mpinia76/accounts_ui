<?php
namespace Accounts\UI\components\grid\model;

use Accounts\UI\utils\AccountsUIUtils;

use Accounts\UI\components\grid\formats\GridImporteFormat;

use Accounts\UI\components\grid\formats\GridEstadoVentaFormat;

use Accounts\UI\components\filter\model\UIVentaCriteria;

use Accounts\Core\model\EstadoVenta;

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
 * Model para la grilla de Ventas.
 *
 * @author Bernardo
 * @since 13-06-2014
 */
class VentaGridModel extends EntityGridModel{

	public function __construct() {

        parent::__construct();
        $this->initModel();

    }

    public function getService(){

    	return UIServiceFactory::getUIVentaService();
    }

    public function getFilter(){

    	$filter = new UIVentaCriteria();
		return $filter;
    }

	protected function initModel() {

		$this->setHasCheckboxes( false );

		$column = GridModelBuilder::buildColumn( "oid", "venta.oid", 20, EntityGrid::TEXT_ALIGN_RIGHT );
		$this->addColumn( $column );

		$column = GridModelBuilder::buildColumn( "fechaHora", "venta.fechaHora", 20, EntityGrid::TEXT_ALIGN_CENTER, new GridDatetimeFormat("d/m/Y H:i:s") );
		$this->addColumn( $column );

		$column = GridModelBuilder::buildColumn( "sucursal", "venta.sucursal", 20, EntityGrid::TEXT_ALIGN_LEFT );
		$this->addColumn( $column );

		$column = GridModelBuilder::buildColumn( "vendedor", "venta.vendedor", 20, EntityGrid::TEXT_ALIGN_LEFT );
		$this->addColumn( $column );

		$column = GridModelBuilder::buildColumn( "cliente", "venta.cliente", 20, EntityGrid::TEXT_ALIGN_LEFT );
		$this->addColumn( $column );

		$column = GridModelBuilder::buildColumn( "monto", "venta.monto", 20, EntityGrid::TEXT_ALIGN_RIGHT, new GridImporteFormat() );
		$column->setCssClass("importe");
		$this->addColumn( $column );

		$column = GridModelBuilder::buildColumn( "observaciones", "venta.observaciones", 20, EntityGrid::TEXT_ALIGN_LEFT );
		$this->addColumn( $column );

		$column = GridModelBuilder::buildColumn( "estado", "venta.estado", 20, EntityGrid::TEXT_ALIGN_LEFT, new GridEstadoVentaFormat() );
		$this->addColumn( $column );


	}

	public function getRowStyleClass($item){

		return AccountsUIUtils::getEstadoVentaCss($item->getEstado());

	}

	public function getDefaultFilterField() {
        return "fechaHora";
    }

	public function getDefaultOrderField(){
		return "fechaHora";
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

		if( $item->podesAnularte() ){
			$menuOption = new MenuOption();
			$menuOption->setLabel( $this->localize( "menu.ventas.anular") );
			$menuOption->setPageName( "VentaAnular" );
			$menuOption->addParam("ventaOid",$item->getOid());
			$menuOption->setIconClass( "icon-anular" );
			$options[] = $menuOption ;
		}

		if( $item->podesCobrarte() ){
			$menuOption = new MenuOption();
			$menuOption->setLabel( $this->localize( "menu.ventas.cobrar") );
			$menuOption->setPageName( "VentaCobrar" );
			$menuOption->addParam("ventaOid",$item->getOid());
			$menuOption->setIconClass( "icon-cobrar-venta fg-green" );
			$options[] = $menuOption ;
		}


		$group->setMenuOptions( $options );

		return array( $group );

	}

}
?>
