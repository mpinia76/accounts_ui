<?php
namespace Accounts\UI\actions\sites;

use Accounts\UI\utils\AccountsUIUtils;

use Accounts\UI\service\UIServiceFactory;
use Accounts\Core\model\Site;
use Accounts\Core\utils\AccountsUtils;

use Rasty\actions\JsonAction;
use Rasty\actions\Forward;
use Rasty\utils\RastyUtils;
use Rasty\exception\RastyException;

use Rasty\security\RastySecurityContext;

use Rasty\i18n\Locale;
use Rasty\factory\PageFactory;
use Rasty\exception\RastyDuplicatedException;


/**
 * se eliminar un concepto de gasto
 *
 * @author Marcos
 * @since 15/03/2021
 */
class EliminarSite extends JsonAction{


	public function execute(){

		try {

			$siteOid = RastyUtils::getParamGET("siteOid");

			//obtenemos la site
			$site = UIServiceFactory::getUISiteService()->get($siteOid);

			UIServiceFactory::getUISiteService()->delete($site);

			$result["info"] = Locale::localize("site.borrar.success")  ;

		} catch (RastyException $e) {

			$result["error"] = Locale::localize($e->getMessage())  ;

		}

		return $result;

	}
}
?>
