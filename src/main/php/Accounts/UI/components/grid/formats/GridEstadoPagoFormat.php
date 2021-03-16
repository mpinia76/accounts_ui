<?php
namespace Accounts\UI\components\grid\formats;

use Accounts\Core\model\EstadoPago;
use Rasty\Grid\entitygrid\model\GridValueFormat;
use Rasty\i18n\Locale;

/**
 * Formato para renderizar el estado de un pago
 *
 * @author Bernardo
 * @since 02-06-2014
 *
 */

class GridEstadoPagoFormat extends  GridValueFormat{

	private $pattern;

	public function format( $value, $item=null ){

		if( !empty($value))
			return  Locale::localize( EstadoPago::getLabel( $value ) );
		else $value;
	}

	public function getPattern(){
		return $this->pattern;
	}

}
