<?php
namespace Accounts\UI\actions\gastos;

use Accounts\UI\utils\AccountsUIUtils;

use Accounts\UI\service\UIServiceFactory;
use Accounts\Core\model\Gasto;
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
 * se anula un Gasto
 *
 * @author Bernardo
 * @since 30/05/2014
 */
class AnularGasto extends Action{


	public function execute(){

		$forward = new Forward();


		//tomamos la gasto
		$gastoOid = RastyUtils::getParamPOST("gastoOid");
		$forward->addParam( "gastoOid", $gastoOid );
		try {

			//la recuperamos la gasto.
			$gasto = UIServiceFactory::getUIGastoService()->get( $gastoOid );

			$user = RastySecurityContext::getUser();
			$user = AccountsUtils::getUserByUsername($user->getUsername());

			UIServiceFactory::getUIGastoService()->anular($gasto, $user);

			$forward->setPageName( "AdminHome" );


		} catch (RastyException $e) {

			$forward->setPageName( "GastoAnular" );
			$forward->addError( Locale::localize($e->getMessage())  );

		}

		return $forward;

	}

}
?>
