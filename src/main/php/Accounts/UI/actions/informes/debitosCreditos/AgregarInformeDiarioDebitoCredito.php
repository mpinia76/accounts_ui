<?php
namespace Accounts\UI\actions\informes\debitosCreditos;


use Accounts\UI\components\form\informeDiarioDebitoCredito\InformeDiarioDebitoCreditoForm;

use Accounts\UI\service\UIServiceFactory;
use Accounts\Core\model\InformeDiarioDebitoCredito;

use Rasty\actions\Action;
use Rasty\actions\Forward;
use Rasty\utils\RastyUtils;
use Rasty\exception\RastyException;

use Rasty\security\RastySecurityContext;

use Rasty\i18n\Locale;
use Rasty\factory\PageFactory;
use Rasty\exception\RastyDuplicatedException;

use Accounts\Core\utils\AccountsUtils;
use Cose\Security\model\User;


/**
 * se realiza el alta de un InformeDiarioDebitoCredito.
 *
 * @author Bernardo
 * @since 14/04/2015
 */
class AgregarInformeDiarioDebitoCredito extends Action{


	public function execute(){

		$forward = new Forward();

		$page = PageFactory::build("InformeDiarioDebitoCreditoAgregar");

		$informeDiarioDebitoCreditoForm = $page->getComponentById("informeDiarioDebitoCreditoForm");

		try {

			//creamos un nuevo informeDiarioDebitoCredito.
			$informeDiarioDebitoCredito = new InformeDiarioDebitoCredito();

			//completados con los datos del formulario.
			$informeDiarioDebitoCreditoForm->fillEntity($informeDiarioDebitoCredito);

			$user = RastySecurityContext::getUser();
			$user = AccountsUtils::getUserByUsername($user->getUsername());

			$informeDiarioDebitoCredito->setUser( $user );

			//agregamos el informeDiarioDebitoCredito.
			UIServiceFactory::getUIInformeDiarioDebitoCreditoService()->add( $informeDiarioDebitoCredito );

			$forward->setPageName( $informeDiarioDebitoCreditoForm->getBackToOnSuccess() );
			$forward->addParam( "informeDiarioDebitoCreditoOid", $informeDiarioDebitoCredito->getOid() );

			$informeDiarioDebitoCreditoForm->cleanSavedProperties();


		} catch (RastyException $e) {

			$forward->setPageName( "InformeDiarioDebitoCreditoAgregar" );
			$forward->addError( Locale::localize($e->getMessage())  );

			//guardamos lo ingresado en el form.
			$informeDiarioDebitoCreditoForm->save();
		}

		return $forward;

	}

}
?>
