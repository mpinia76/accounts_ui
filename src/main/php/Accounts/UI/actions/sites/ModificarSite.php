<?php
namespace Accounts\UI\actions\sites;

use Accounts\UI\components\form\site\SiteForm;

use Accounts\UI\service\UIServiceFactory;

use Rasty\actions\Action;
use Rasty\actions\Forward;
use Rasty\utils\RastyUtils;
use Rasty\exception\RastyException;

use Rasty\security\RastySecurityContext;

use Rasty\factory\ComponentConfig;
use Rasty\factory\ComponentFactory;

use Rasty\i18n\Locale;

use Rasty\factory\PageFactory;

/**
 * se realiza la actualización de una site.
 *
 * @author Marcos
 * @since 15/03/2021
 */
class ModificarSite extends Action{


	public function execute(){

		$forward = new Forward();

		$page = PageFactory::build("SiteModificar");

		$siteForm = $page->getComponentById("siteForm");

		$oid = $siteForm->getOid();

		try {

			//obtenemos la site.
			$site = UIServiceFactory::getUISiteService()->get($oid );

			//lo editamos con los datos del formulario.
			$siteForm->fillEntity($site);

			//guardamos los cambios.
			UIServiceFactory::getUISiteService()->update( $site );

            SiteLogoHelper::process($site);

			$forward->setPageName( $siteForm->getBackToOnSuccess() );
			$forward->addParam( "siteOid", $site->getOid() );

			$siteForm->cleanSavedProperties();

		} catch (RastyException $e) {

			$forward->setPageName( "SiteModificar" );
			$forward->addError( Locale::localize($e->getMessage())  );
			$forward->addParam("oid", $oid );

			//guardamos lo ingresado en el form.
			$siteForm->save();

		}
		return $forward;

	}

}
?>
