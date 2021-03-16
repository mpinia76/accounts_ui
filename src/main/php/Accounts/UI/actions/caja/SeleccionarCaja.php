<?php
namespace Accounts\UI\actions\caja;

use Accounts\UI\utils\AccountsUIUtils;
use Accounts\Core\utils\AccountsUtils;

use Accounts\UI\service\UIServiceFactory;

use Accounts\Core\model\Caja;

use Rasty\actions\Action;
use Rasty\actions\Forward;
use Rasty\utils\RastyUtils;
use Rasty\exception\RastyException;
use Rasty\exception\RastyDuplicatedException;
use Rasty\security\RastySecurityContext;

use Rasty\i18n\Locale;
use Rasty\factory\PageFactory;

/**
 * se selecciona una caja
 *
 * @author Bernardo
 * @since 12-06-2014
 */
class SeleccionarCaja extends Action{


	public function execute(){

		$forward = new Forward();

		try {

			//obtenemos la caja a seleccionar.
			$cajaOid = RastyUtils::getParamPOST("caja");

			if(!empty($cajaOid)){
				$caja = UIServiceFactory::getUICajaService()->get( $cajaOid );

				AccountsUIUtils::setCaja( $caja );
			}else{

				AccountsUIUtils::setCaja( null );
			}



			$forward->setPageName( "CajaHome" );

		} catch (RastyDuplicatedException $e) {

			$forward->setPageName( "SeleccionarCaja" );
			$forward->addError( $e->getMessage() );

		} catch (RastyException $e) {

			$forward->setPageName( "SeleccionarCaja" );
			$forward->addError(Locale::localize($e->getMessage()) );

		}

		return $forward;

	}

}
?>
