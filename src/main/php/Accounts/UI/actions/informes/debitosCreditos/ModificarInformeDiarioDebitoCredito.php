<?php
namespace Accounts\UI\actions\informes\debitosCreditos;

use Accounts\UI\components\form\informeDiarioDebitoCredito\InformeDiarioDebitoCreditoForm;

use Accounts\UI\service\UIServiceFactory;
use Accounts\UI\utils\AccountsUIUtils;

use Rasty\actions\Action;
use Rasty\actions\Forward;
use Rasty\utils\RastyUtils;
use Rasty\exception\RastyException;

use Rasty\security\RastySecurityContext;

use Accounts\Core\utils\AccountsUtils;
use Cose\Security\model\User;

use Rasty\factory\ComponentConfig;
use Rasty\factory\ComponentFactory;

use Rasty\i18n\Locale;

use Rasty\factory\PageFactory;

/**
 * se realiza la actualización de un InformeDiarioDebitoCredito.
 *
 * @author Bernardo
 * @since 14/04/2015
 */
class ModificarInformeDiarioDebitoCredito extends Action{


	public function execute(){

		$forward = new Forward();

		$page = PageFactory::build("InformeDiarioDebitoCreditoModificar");

		$informeDiarioDebitoCreditoForm = $page->getComponentById("informeDiarioDebitoCreditoForm");

		$oid = $informeDiarioDebitoCreditoForm->getOid();

		try {

			//obtenemos el informeDiarioDebitoCredito.
			$informeDiarioDebitoCredito = UIServiceFactory::getUIInformeDiarioDebitoCreditoService()->get($oid );

			//lo editamos con los datos del formulario.
			$informeDiarioDebitoCreditoForm->fillEntity($informeDiarioDebitoCredito);

			$user = RastySecurityContext::getUser();
			$user = AccountsUtils::getUserByUsername($user->getUsername());

			$informeDiarioDebitoCredito->setUser( $user );

			//guardamos los cambios.
			UIServiceFactory::getUIInformeDiarioDebitoCreditoService()->update( $informeDiarioDebitoCredito );

			$forward->setPageName( $informeDiarioDebitoCreditoForm->getBackToOnSuccess() );
			$forward->addParam( "informeDiarioDebitoCreditoOid", $informeDiarioDebitoCredito->getOid() );

			$informeDiarioDebitoCreditoForm->cleanSavedProperties();

		} catch (RastyException $e) {

			$forward->setPageName( "InformeDiarioDebitoCreditoModificar" );
			$forward->addError( Locale::localize($e->getMessage())  );
			$forward->addParam("oid", $oid );

			//guardamos lo ingresado en el form.
			$informeDiarioDebitoCreditoForm->save();

		}
		return $forward;

	}

}
?>
