<?php
namespace Accounts\UI\components\grid\formats;

use Accounts\UI\utils\AccountsUIUtils;
use Rasty\Grid\entitygrid\model\GridValueFormat;

use Accounts\Core\model\Sucursal;
use Accounts\Core\model\Producto;
use Rasty\i18n\Locale;

/**
 * Formato para imprte
 *
 * @author Bernardo
 * @since 04-06-2014
 *
 */

class GridImporteFormat extends  GridValueFormat{

	public function __construct(){

	}

	public function format( $value, $item=null ){

		if( $value !=null )
			return  AccountsUIUtils::formatMontoToView($value);
		else $value;
	}


}
