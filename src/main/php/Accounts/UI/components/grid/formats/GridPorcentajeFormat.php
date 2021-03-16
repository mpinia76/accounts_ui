<?php
namespace Accounts\UI\components\grid\formats;

use Accounts\UI\utils\AccountsUIUtils;

use Accounts\Core\model\Sucursal;
use Accounts\Core\model\Producto;
use Rasty\i18n\Locale;
use Rasty\Grid\entitygrid\model\GridValueFormat;

/**
 * Formato para porcentaje
 *
 * @author Bernardo
 * @since 10-06-2014
 *
 */

class GridPorcentajeFormat extends  GridValueFormat{

	public function __construct(){

	}

	public function format( $value, $item=null ){

		if( $value !=null )
			return  AccountsUIUtils::formatPorcentajeToView($value);
		else $value;
	}


}
