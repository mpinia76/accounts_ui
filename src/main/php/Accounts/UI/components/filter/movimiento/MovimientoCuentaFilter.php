<?php

namespace Accounts\UI\components\filter\movimiento;

use Accounts\UI\service\UIServiceFactory;

use Accounts\UI\utils\AccountsUIUtils;

use Accounts\UI\components\grid\model\MovimientoCuentaGridModel;

use Accounts\UI\components\filter\model\UIMovimientoCuentaCriteria;

use Accounts\UI\components\filter\model\UIMovimientoCriteria;

use Accounts\UI\components\grid\model\MovimientoGridModel;

use Rasty\Grid\filter\Filter;
use Rasty\utils\XTemplate;
use Rasty\utils\LinkBuilder;

/**
 * Filtro para buscar movimientos de Cuenta
 *
 * @author Bernardo
 * @since 05-06-2014
 */
class MovimientoCuentaFilter extends MovimientoFilter{


	public function getType(){

		return "MovimientoCuentaFilter";
	}


	protected function parseXTemplate(XTemplate $xtpl){

		//rellenamos el nombre con el texto inicial
		//$this->fillInput("cuenta", AccountsUIUtils::getCaja() );

		parent::parseXTemplate($xtpl);

		$xtpl->assign("lbl_saldo",  $this->localize( "cuenta.saldo" ) );


	}

}
?>
