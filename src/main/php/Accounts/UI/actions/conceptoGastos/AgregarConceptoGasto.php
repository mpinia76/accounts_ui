<?php
namespace Accounts\UI\actions\conceptoGastos;


use Accounts\UI\components\form\conceptoGasto\ConceptoGastoForm;

use Accounts\UI\service\UIServiceFactory;
use Accounts\Core\model\ConceptoGasto;

use Rasty\actions\Action;
use Rasty\actions\Forward;
use Rasty\utils\RastyUtils;
use Rasty\exception\RastyException;

use Rasty\security\RastySecurityContext;

use Rasty\i18n\Locale;
use Rasty\factory\PageFactory;
use Rasty\exception\RastyDuplicatedException;

use Accounts\UI\utils\AccountsUIUtils;


/**
 * se realiza el alta de una ConceptoGasto.
 *
 * @author Marcos
 * @since 09/03/2018
 */
class AgregarConceptoGasto extends Action{


	public function execute(){

		$forward = new Forward();

		$page = PageFactory::build("ConceptoGastoAgregar");

		$conceptoGastoForm = $page->getComponentById("conceptoGastoForm");

		try {

			//creamos una nueva conceptoGasto.
			$conceptoGasto = new ConceptoGasto();

			$conceptoGasto->setSite(AccountsUIUtils::getAdminSiteLogged());
			
			//completados con los datos del formulario.
			$conceptoGastoForm->fillEntity($conceptoGasto);

			//agregamos el conceptoGasto.
			UIServiceFactory::getUIConceptoGastoService()->add( $conceptoGasto );

			$forward->setPageName( $conceptoGastoForm->getBackToOnSuccess() );
			$forward->addParam( "conceptoGastoOid", $conceptoGasto->getOid() );

			$conceptoGastoForm->cleanSavedProperties();


		} catch (RastyException $e) {

			$forward->setPageName( "ConceptoGastoAgregar" );
			$forward->addError( Locale::localize($e->getMessage())  );

			//guardamos lo ingresado en el form.
			$conceptoGastoForm->save();
		}

		return $forward;

	}

}
?>
