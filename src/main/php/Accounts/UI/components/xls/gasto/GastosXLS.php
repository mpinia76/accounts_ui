<?php

namespace Accounts\UI\components\xls\gasto;

use Datetime;
use Accounts\UI\utils\AccountsUIUtils;

use Accounts\UI\service\UIServiceFactory;

use Rasty\components\RastyComponent;
use Rasty\utils\RastyUtils;

use Rasty\utils\XTemplate;

use Accounts\UI\components\filter\model\UIGastoCriteria;

use Rasty\utils\LinkBuilder;
use Rasty\render\DOMPDFRenderer;
use Rasty\conf\RastyConfig;
use Rasty\factory\PageFactory;

use Rasty\utils\Logger;

use Accounts\Core\model\EstadoGasto;


/**
 * para renderizar en xls los gastos
 *
 * @author Marcos
 * @since 23-07-2021
 *
 */
class GastosXLS extends RastyComponent{



	public function getType(){

		return "GastosXLS";

	}

	public function __construct(){


	}

	public function getFileName(){
		"precios";

	}


	protected function parseXTemplate(XTemplate $xtpl){

        $page = PageFactory::build("Gastos");

        $gastoCriteria = new UIGastoCriteria();

        $gastoFilter = $page->getComponentById("gastosFilter");

        $gastoFilter->fillFromSaved($gastoCriteria);
		$xtpl->assign( "APP_PATH", RastyConfig::getInstance()->getAppPath() );
		$xtpl->assign( "fecha", AccountsUIUtils::formatDateTimeToView(new Datetime()) );




        if ($gastoCriteria->getFechaDesde()&&$gastoCriteria->getFechaHasta()){
            $xtpl->assign( "entreFechas", 'Entre las fechas '.AccountsUIUtils::formatDateToView($gastoCriteria->getFechaDesde()).' y '.AccountsUIUtils::formatDateToView($gastoCriteria->getFechaHasta()));
        }


        $xtpl->assign("lbl_fecha", $this->localize( "gasto.fechaHora" ) );
        $xtpl->assign("lbl_fechaVencimiento", $this->localize( "gasto.fechaVencimiento" ) );
        $xtpl->assign("lbl_concepto", $this->localize( "gasto.concepto" ) );
        $xtpl->assign("lbl_monto", $this->localize( "gasto.monto" ) );
        $xtpl->assign("lbl_observaciones", $this->localize( "gasto.observaciones" ) );
        $xtpl->assign("lbl_estado", $this->localize( "gasto.estado" ) );




        $gastos = UIServiceFactory::getUIGastoService()->getList($gastoCriteria);
        //print_r($gastos);
        foreach ($gastos as $gasto) {

            $xtpl->assign( "fechaHora", AccountsUIUtils::formatDateTimeToView($gasto->getFechaHora()) );
            $xtpl->assign( "fechaVencimiento", AccountsUIUtils::formatDateTimeToView($gasto->getFechaVencimiento()) );
            $xtpl->assign( "concepto", $gasto->getConcepto() );

            $xtpl->assign( "monto", AccountsUIUtils::formatMontoToView( $gasto->getMonto() ) );
            $xtpl->assign( "observaciones", $gasto->getObservaciones() );
            $xtpl->assign( "estado", $this->localize( EstadoGasto::getLabel($gasto->getEstado()) ) );



            $xtpl->parse( "main.gastos.detalle" );


        }
        if ($gastos) {
            $xtpl->parse( "main.gastos" );
        }




	}








}
?>
