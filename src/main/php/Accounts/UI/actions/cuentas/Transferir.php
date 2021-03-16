<?php
namespace Accounts\UI\actions\cuentas;

use Accounts\UI\conf\AccountsUISetup;

use Accounts\UI\utils\AccountsUIUtils;
use Accounts\Core\utils\AccountsUtils;

use Accounts\Core\model\Cuenta;

use Accounts\UI\service\UIServiceFactory;

use Rasty\actions\Action;
use Rasty\actions\Forward;
use Rasty\utils\RastyUtils;
use Rasty\exception\RastyException;

use Rasty\security\RastySecurityContext;

use Rasty\i18n\Locale;
use Rasty\factory\PageFactory;
use Rasty\exception\RastyDuplicatedException;

use Rasty\Forms\input\InputNumber;

/**
 * se realiza una transferencia entre accounts
 *
 * @author Bernardo
 * @since 25-06-2014
 */
class Transferir extends Action{


	public function execute(){

		$forward = new Forward();
		$fechaHora = AccountsUIUtils::newDateTime( RastyUtils::getParamPOST("fechaHora").' '.date('H:i') );




		//tomamos el monto a depositar
		$number = new InputNumber();
		$monto = $number->formatValue( RastyUtils::getParamPOST("monto") );
		$observaciones = RastyUtils::getParamPOST("observaciones");
		$origenOid = RastyUtils::getParamPOST("origen");
		$destinoOid = RastyUtils::getParamPOST("destino");

		try {

			$origen = UIServiceFactory::getUICuentaService()->get($origenOid);
			$destino = UIServiceFactory::getUICuentaService()->get($destinoOid);

			UIServiceFactory::getUICuentaService()->transferir($origen, $destino, $monto, $observaciones, $fechaHora);
			$forward->setPageName( "AdminHome" );


		} catch (RastyException $e) {

			$forward->setPageName( "Transferir" );
			$forward->addParam( "monto", $monto );
			$forward->addParam( "observaciones", $observaciones );

			$forward->addError( Locale::localize($e->getMessage())  );

		}

		return $forward;

	}

}
?>
