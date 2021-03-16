<?php
namespace Accounts\UI\actions\pagos;

use Accounts\UI\utils\AccountsUIUtils;

use Accounts\UI\service\UIServiceFactory;
use Accounts\Core\model\Pago;
use Accounts\Core\utils\AccountsUtils;

use Rasty\actions\Action;
use Rasty\actions\Forward;
use Rasty\utils\RastyUtils;
use Rasty\exception\RastyException;

use Rasty\security\RastySecurityContext;

use Rasty\i18n\Locale;
use Rasty\factory\PageFactory;
use Rasty\exception\RastyDuplicatedException;


/**
 * se anula un pago
 *
 * @author Bernardo
 * @since 13/06/2016
 */
class AnularPago extends Action{


	public function execute(){

		$forward = new Forward();


		//tomamos el pago
		$pagoOid = RastyUtils::getParamPOST("pagoOid");
		$forward->addParam( "pagoOid", $pagoOid );
		try {

			//la recuperamos el pago.
			$pago = UIServiceFactory::getUIPagoService()->get( $pagoOid );

			$user = RastySecurityContext::getUser();
			$user = AccountsUtils::getUserByUsername($user->getUsername());

			UIServiceFactory::getUIPagoService()->anular($pago, $user);

			$forward->setPageName( "CajaHome" );


		} catch (RastyException $e) {

			$forward->setPageName( "PagoAnular" );
			$forward->addError( Locale::localize($e->getMessage())  );

		}

		return $forward;

	}

}
?>
