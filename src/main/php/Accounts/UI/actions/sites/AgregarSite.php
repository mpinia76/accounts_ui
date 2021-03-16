<?php
namespace Accounts\UI\actions\sites;


use Accounts\UI\components\form\site\SiteForm;

use Accounts\UI\service\UIServiceFactory;
use Accounts\Core\model\Site;

use Rasty\actions\Action;
use Rasty\actions\Forward;
use Rasty\utils\RastyUtils;
use Rasty\exception\RastyException;

use Rasty\security\RastySecurityContext;

use Rasty\i18n\Locale;
use Rasty\factory\PageFactory;
use Rasty\exception\RastyDuplicatedException;


/**
 * se realiza el alta de una Site.
 *
 * @author Marcos
 * @since 15/03/2021
 */
class AgregarSite extends Action{


	public function execute(){

		$forward = new Forward();

		$page = PageFactory::build("SiteAgregar");

		$siteForm = $page->getComponentById("siteForm");

		try {

			//creamos una nueva site.
			$site = new Site();

			//completados con los datos del formulario.
			$siteForm->fillEntity($site);

			//agregamos el site.
			UIServiceFactory::getUISiteService()->add( $site );

            SiteLogoHelper::process($site);

            $forward->setPageName( $siteForm->getBackToOnSuccess() );
			$forward->addParam( "siteOid", $site->getOid() );

			$siteForm->cleanSavedProperties();


		} catch (RastyException $e) {

			$forward->setPageName( "SiteAgregar" );
			$forward->addError( Locale::localize($e->getMessage())  );

			//guardamos lo ingresado en el form.
			$siteForm->save();
		}

		return $forward;

	}

}
?>
