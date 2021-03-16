<?php
namespace Accounts\UI\service;

use Accounts\UI\components\filter\model\UIPagoCriteria;

use Rasty\components\RastyPage;
use Rasty\utils\XTemplate;
use Rasty\i18n\Locale;
use Rasty\exception\RastyException;
use Cose\criteria\impl\Criteria;

use Accounts\Core\model\Pago;
use Accounts\Core\model\Cuenta;
use Accounts\Core\model\Caja;

use Accounts\Core\service\ServiceFactory;
use Cose\Security\model\User;

use Rasty\Grid\entitygrid\model\IEntityGridService;
use Rasty\Grid\filter\model\UICriteria;

/**
 *
 * UI service para Pago.
 *
 * @author Bernardo
 * @since 11/06/2016
 */
class UIPagoService  implements IEntityGridService{

	private static $instance;

	private function __construct() {}

	public static function getInstance() {

		if( self::$instance == null ) {

			self::$instance = new UIPagoService();

		}
		return self::$instance;
	}



	public function getList( UIPagoCriteria $uiCriteria){

		try{

			$criteria = $uiCriteria->buildCoreCriteria() ;

			$service = ServiceFactory::getPagoService();

			$pagos = $service->getList( $criteria );

			return $pagos;

		} catch (\Exception $e) {

			throw new RastyException($e->getMessage());

		}
	}


	public function get( $oid ){

		try{

			$service = ServiceFactory::getPagoService();

			return $service->get( $oid );

		} catch (\Exception $e) {

			throw new RastyException($e->getMessage());

		}
	}

	function getEntitiesCount($uiCriteria){

		try{

			$criteria = $uiCriteria->buildCoreCriteria() ;

			$service = ServiceFactory::getPagoService();
			$pagos = $service->getCount( $criteria );

			return $pagos;

		} catch (\Exception $e) {

			throw new RastyException($e->getMessage());

		}
	}

	function getEntities($uiCriteria){

		return $this->getList($uiCriteria);
	}


	public function anular(Pago $pago, User $user){

		try {

			$service = ServiceFactory::getPagoService();

			return $service->anular($pago, $user);

		} catch (\Exception $e) {

			throw new RastyException( $e->getMessage() );

		}

	}

}
?>
