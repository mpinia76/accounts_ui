<?php
namespace Accounts\UI\actions\login;

use Accounts\UI\service\UIServiceFactory;
use Accounts\UI\utils\AccountsUtils;

use Rasty\actions\Action;
use Rasty\actions\Forward;
use Rasty\utils\RastyUtils;
use Rasty\exception\RastyException;

use Rasty\security\RastySecurityContext;

use Rasty\i18n\Locale;

/**
 * se realiza el logout del sistema.
 *
 * @author Bernardo
 * @since 24/05/2014
 */
class Logout extends Action{

	public function isSecure(){
		return false;
	}

	public function execute(){

		$forward = new Forward();
		try {

			RastySecurityContext::logout();

			$forward->setPageName( "Login" );


		} catch (RastyException $e) {

			$forward->setPageName( "Login" );
			$forward->addError( $e->getMessage() );

		}

		return $forward;

	}

}
?>
