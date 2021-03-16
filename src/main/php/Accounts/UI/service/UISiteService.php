<?php
namespace Accounts\UI\service;

use Accounts\UI\components\filter\model\UISiteCriteria;

use Rasty\components\RastyPage;
use Rasty\utils\XTemplate;
use Rasty\i18n\Locale;
use Rasty\exception\RastyException;
use Cose\criteria\impl\Criteria;

use Accounts\Core\model\Site;

use Accounts\Core\service\ServiceFactory;
use Cose\Security\model\User;
use Rasty\Grid\entitygrid\model\IEntityGridService;
use Rasty\Grid\filter\model\UICriteria;

/**
 *
 * UI service para sites.
 *
 * @author Marcos
 * @since 15/03/2021
 */
class UISiteService  implements IEntityGridService{

	private static $instance;

	private function __construct() {}

	public static function getInstance() {

		if( self::$instance == null ) {

			self::$instance = new UISiteService();

		}
		return self::$instance;
	}



	public function getList( UISiteCriteria $uiCriteria){

		try{
			$criteria = $uiCriteria->buildCoreCriteria() ;

			$service = ServiceFactory::getSiteService();

			$sites = $service->getList( $criteria );

			return $sites;
		} catch (\Exception $e) {

			throw new RastyException($e->getMessage());

		}
	}

	public function get( $oid ){

		try{

			$service = ServiceFactory::getSiteService();

			return $service->get( $oid );

		} catch (\Exception $e) {

			throw new RastyException($e->getMessage());

		}

	}


	public function add( Site $site ){

		try{

			$service = ServiceFactory::getSiteService();

			return $service->add( $site );

		} catch (\Exception $e) {

			throw new RastyException($e->getMessage());

		}

	}

	public function update( Site $site ){

		try{

			$service = ServiceFactory::getSiteService();

			return $service->update( $site );

		} catch (\Exception $e) {

			throw new RastyException($e->getMessage());

		}

	}

	function getEntitiesCount($uiCriteria){

		try{

			$criteria = $uiCriteria->buildCoreCriteria() ;

			$service = ServiceFactory::getSiteService();
			$sites = $service->getCount( $criteria );

			return $sites;

		} catch (\Exception $e) {

			throw new RastyException($e->getMessage());

		}
	}

	function getEntities($uiCriteria){

		return $this->getList($uiCriteria);
	}


	public function delete(Site $site){

		try {

			$service = ServiceFactory::getSiteService();

			return $service->delete($site->getOid());

		} catch (\Exception $e) {

			throw new RastyException( $e->getMessage() );

		}

	}
}
?>
