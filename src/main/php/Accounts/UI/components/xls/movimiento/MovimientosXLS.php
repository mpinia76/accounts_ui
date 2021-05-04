<?php

namespace Accounts\UI\components\xls\movimiento;

use Datetime;
use Accounts\UI\utils\AccountsUIUtils;

use Accounts\UI\service\UIServiceFactory;

use Rasty\components\RastyComponent;
use Rasty\utils\RastyUtils;

use Rasty\utils\XTemplate;

use Accounts\UI\components\filter\model\UIMovimientoCuentaCriteria;

use Rasty\utils\LinkBuilder;
use Rasty\render\DOMPDFRenderer;
use Rasty\conf\RastyConfig;
use Rasty\factory\PageFactory;

use Rasty\utils\Logger;


/**
 * para renderizar en xls los movimientos
 *
 * @author Marcos
 * @since 04-05-2021
 *
 */
class MovimientosXLS extends RastyComponent{



	public function getType(){

		return "MovimientosXLS";

	}

	public function __construct(){


	}

	public function getFileName(){
		"precios";

	}


	protected function parseXTemplate(XTemplate $xtpl){

        $page = PageFactory::build("MovimientosBanco");

        $movimientoCriteria = new UIMovimientoCuentaCriteria();

        $movimientoFilter = $page->getComponentById("movimientosFilter");

        $movimientoFilter->fillFromSaved($movimientoCriteria);
		$xtpl->assign( "APP_PATH", RastyConfig::getInstance()->getAppPath() );
		$xtpl->assign( "fecha", AccountsUIUtils::formatDateTimeToView(new Datetime()) );



        $xtpl->assign( "cuenta", $movimientoCriteria->getCuenta());
        if ($movimientoCriteria->getFechaDesde()&&$movimientoCriteria->getFechaHasta()){
            $xtpl->assign( "entreFechas", 'Entre las fechas '.AccountsUIUtils::formatDateToView($movimientoCriteria->getFechaDesde()).' y '.AccountsUIUtils::formatDateToView($movimientoCriteria->getFechaHasta()));
        }


        $xtpl->assign("lbl_fecha", $this->localize( "movimientoCuenta.fechaHora" ) );
        $xtpl->assign("lbl_concepto", $this->localize( "movimientoCuenta.concepto" ) );
        $xtpl->assign("lbl_debe", $this->localize( "movimientoCuenta.debe" ) );
        $xtpl->assign("lbl_haber", $this->localize( "movimientoCuenta.haber" ) );
        $xtpl->assign("lbl_saldo", $this->localize( "movimientoCuenta.saldo" ) );


        $movimientos = UIServiceFactory::getUIMovimientoCuentaService()->getList($movimientoCriteria);
        //print_r($movimientos);
        foreach ($movimientos as $movimiento) {
            echo $movimiento->getDebe();
            $xtpl->assign( "fechaHora", AccountsUIUtils::formatDateTimeToView($movimiento->getFechaHora()) );
            $xtpl->assign( "concepto", $movimiento->getDescripcion() );

            $xtpl->assign( "debe", AccountsUIUtils::formatMontoToView( $movimiento->getDebe() ) );
            $xtpl->assign( "haber", AccountsUIUtils::formatMontoToView( $movimiento->getHaber() ) );
            $xtpl->assign( "saldo", AccountsUIUtils::formatMontoToView( $movimiento->getSaldo() ) );

            $xtpl->parse( "main.movimientos.detalle" );


        }
        if ($movimientos) {
            $xtpl->parse( "main.movimientos" );
        }




	}








}
?>
