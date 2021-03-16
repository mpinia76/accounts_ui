<?php
namespace Accounts\UI\actions\login;

use Accounts\UI\utils\AccountsUIUtils;

use Accounts\UI\service\UIServiceFactory;

use Accounts\Core\utils\AccountsUtils;


use Rasty\actions\Action;
use Rasty\actions\Forward;
use Rasty\utils\RastyUtils;
use Rasty\exception\RastyException;

use Rasty\security\RastySecurityContext;

use Rasty\i18n\Locale;



/**
 * se realiza el login contra el core.
 *
 * @author Bernardo
 * @since 24/05/2014
 */
class Login extends Action{

	public function isSecure(){
		return false;
	}

	public function execute(){

		$forward = new Forward();
		try {


			$username = RastyUtils::getParamPOST("username");
			$password = RastyUtils::getParamPOST("password");
			$site_oid = RastyUtils::getParamPOST("site_oid");
			
			if(empty($username))
				throw new RastyException("username.required");
			
			if(empty($password))
				throw new RastyException("password.required");
			
			
			RastySecurityContext::login( RastyUtils::getParamPOST("username"), RastyUtils::getParamPOST("password") );



			$user = RastySecurityContext::getUser();

			$user = AccountsUtils::getUserByUsername($user->getUsername());

			if( AccountsUtils::isAdmin($user)){


				AccountsUIUtils::loginAdmin($user);

			}else{

				AccountsUIUtils::loginAdminSite($user,$site_oid);
			}

			/*AccountsUIUtils::login( $empleado );
			//buscamos la caja que esté abierta para el empleado
			$caja = UIServiceFactory::getUICajaService()->getCajaAbiertaByEmpleado($empleado);
			AccountsUIUtils::setCaja($caja);*/

			/*if( AccountsUIUtils::isAdminLogged() )
				$forward->setPageName( $this->getForwardAdmin() );

			else //si no hay caja abierta, lo enviamos a abrir una nueva.
				$forward->setPageName( $this->getForwardAdmin() );*/
			
			$forward->setPageName( $this->getForwardAdmin() );

		} catch (RastyException $e) {

			$forward->setPageName( $this->getErrorForward() );
			$forward->addError( $e->getMessage() );

		}

		return $forward;

	}



	protected function getForwardAdmin(){
		return "AdminHome";
	}

	

	protected function getErrorForward(){
		return "Login";
	}
}
?>
