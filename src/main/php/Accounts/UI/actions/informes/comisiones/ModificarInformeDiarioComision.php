<?php
namespace Accounts\UI\actions\informes\comisiones;

use Accounts\UI\components\form\informeDiarioComision\InformeDiarioComisionForm;

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
 * se realiza la actualización de un InformeDiarioComision.
 *
 * @author Bernardo
 * @since 16/04/2015
 */
class ModificarInformeDiarioComision extends Action{


	public function execute(){

		$forward = new Forward();

		$page = PageFactory::build("InformeDiarioComisionModificar");

		$informeDiarioComisionForm = $page->getComponentById("informeDiarioComisionForm");

		$oid = $informeDiarioComisionForm->getOid();

		try {

			//obtenemos el informeDiarioComision.
			$informeDiarioComision = UIServiceFactory::getUIInformeDiarioComisionService()->get($oid );

			//lo editamos con los datos del formulario.
			$informeDiarioComisionForm->fillEntity($informeDiarioComision);

			$user = RastySecurityContext::getUser();
			$user = AccountsUtils::getUserByUsername($user->getUsername());

			$informeDiarioComision->setUser( $user );

			//guardamos los cambios.
			UIServiceFactory::getUIInformeDiarioComisionService()->update( $informeDiarioComision );

			$forward->setPageName( $informeDiarioComisionForm->getBackToOnSuccess() );
			$forward->addParam( "informeDiarioComisionOid", $informeDiarioComision->getOid() );

			$informeDiarioComisionForm->cleanSavedProperties();

		} catch (RastyException $e) {

			$forward->setPageName( "InformeDiarioComisionModificar" );
			$forward->addError( Locale::localize($e->getMessage())  );
			$forward->addParam("oid", $oid );

			//guardamos lo ingresado en el form.
			$informeDiarioComisionForm->save();

		}
		return $forward;

	}

}
?>
