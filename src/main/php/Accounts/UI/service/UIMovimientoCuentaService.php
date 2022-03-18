<?php
namespace Accounts\UI\service;

use Accounts\UI\components\filter\model\UIMovimientoCuentaCriteria;

use Rasty\components\RastyPage;
use Rasty\utils\XTemplate;
use Rasty\i18n\Locale;
use Rasty\exception\RastyException;
use Cose\criteria\impl\Criteria;

use Accounts\Core\model\Caja;

use Accounts\Core\service\ServiceFactory;
use Cose\Security\model\User;
use Rasty\Grid\entitygrid\model\IEntityGridService;
use Rasty\Grid\filter\model\UICriteria;

/**
 *
 * UI service para movimientos de Cuenta.
 *
 * @author Bernardo
 * @since 28/05/2014
 */
class UIMovimientoCuentaService  implements IEntityGridService{

	private static $instance;

	private function __construct() {}

	public static function getInstance() {

		if( self::$instance == null ) {

			self::$instance = new UIMovimientoCuentaService();

		}
		return self::$instance;
	}



	public function getList( UIMovimientoCuentaCriteria $uiCriteria){

		try{
			$criteria = $uiCriteria->buildCoreCriteria() ;

			$service = ServiceFactory::getMovimientoCuentaService();

			$movimientos = $service->getList( $criteria );

			return $movimientos;
		} catch (\Exception $e) {

			throw new RastyException($e->getMessage());

		}
	}

	public function get( $oid ){

		try{

			$service = ServiceFactory::getMovimientoCuentaService();

			return $service->get( $oid );

		} catch (\Exception $e) {

			throw new RastyException($e->getMessage());

		}

	}



	function getEntitiesCount($uiCriteria){

		try{

			$criteria = $uiCriteria->buildCoreCriteria() ;

			$service = ServiceFactory::getMovimientoCuentaService();
			$movimientos = $service->getCount( $criteria );

			return $movimientos;

		} catch (\Exception $e) {

			throw new RastyException($e->getMessage());

		}
	}

	function getEntities($uiCriteria){

		return $this->getList($uiCriteria);
	}

	public function getTotalesHaber( UIMovimientoCuentaCriteria $uiCriteria){

		try{

			$criteria = $uiCriteria->buildCoreCriteria() ;

			//$criteria->addOrder("fechaHora", "ASC");

			$service = ServiceFactory::getMovimientoCuentaService();

			$movimetos = $service->getList( $criteria );

			$saldo = 0;
			foreach ($movimetos as $movimeto) {

				//if($movimeto->podesAnularte()){
				$saldo += $movimeto->getHaber();
				//}
			}
			return $saldo;


		} catch (Exception $e) {

			throw new RastyException($e->getMessage());

		}
	}
	public function getTotalesDebe( UIMovimientoCuentaCriteria $uiCriteria){

		try{

			$criteria = $uiCriteria->buildCoreCriteria() ;

			//$criteria->addOrder("fechaHora", "ASC");

			$service = ServiceFactory::getMovimientoCuentaService();

			$movimetos = $service->getList( $criteria );

			$saldo = 0;
			foreach ($movimetos as $movimeto) {

				//if($movimeto->podesAnularte()){
				$saldo += $movimeto->getDebe();
				//}
			}
			return $saldo;


		} catch (Exception $e) {

			throw new RastyException($e->getMessage());

		}
	}
}
?>
