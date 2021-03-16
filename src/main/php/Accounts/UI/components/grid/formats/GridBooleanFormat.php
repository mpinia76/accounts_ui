<?php
namespace Accounts\UI\components\grid\formats;

use Accounts\UI\utils\AccountsUIUtils;
use Rasty\Grid\entitygrid\model\GridValueFormat;

use Accounts\Core\model\Sucursal;
use Accounts\Core\model\Producto;
use Rasty\i18n\Locale;

/**
 * Formato para boolean
 *
 * @author Bernardo
 * @since 01-12-2014
 *
 */

class GridBooleanFormat extends  GridValueFormat{

	public function __construct(){

	}

	public function format( $value, $item=null ){

		if( $value )
			return  "si";
		else $value;
	}


}
