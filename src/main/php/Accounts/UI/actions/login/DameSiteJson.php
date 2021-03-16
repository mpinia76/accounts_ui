<?php
namespace Accounts\UI\actions\login;

use Accounts\UI\utils\AccountsUIUtils;

use Accounts\UI\service\UIServiceFactory;
//use Accounts\UI\utils\AccountsUtils;

use Accounts\Core\utils\AccountsUtils;

use Accounts\UI\components\filter\model\UISiteCriteria;

use Rasty\actions\JsonAction;
use Rasty\actions\Forward;
use Rasty\utils\RastyUtils;
use Rasty\exception\RastyException;

use Rasty\security\RastySecurityContext;

use Rasty\factory\ComponentConfig;
use Rasty\factory\ComponentFactory;

use Rasty\i18n\Locale;

use Rasty\factory\PageFactory;

/**
 * 
 * 
 * @author Marcos
 * @since 16/03/2021
 */
class DameSiteJson extends JsonAction{

	
	public function execute(){

		$forward = new Forward();
		
		try {

			$userName = RastyUtils::getParamPOST("username") ;
			
			$user = AccountsUtils::getUserByUsername($userName);
			$sitios = array();
			if( AccountsUtils::isAdmin($user)){
				$sitio = array();
				$sitio["cd"]=0 ;
				$sitio["ds"]='Todos';
				$sitios[]=$sitio;
			}
			
			
			$uiCriteria = new UISiteCriteria();
	        $sites = UIServiceFactory::getUISiteService()->getList($uiCriteria);
	
			
	        foreach ($sites as $site) {
	            
	
	            if ($site->hasSiteuserByName($userName)){
	            	$sitio = array();
					$sitio["cd"]=$site->getOid() ;
					$sitio["ds"]=$site->__toString();
					$sitios[]=$sitio;
	            	
	            }
	                
	        }
			
			
			
			
			$result['sites'] = $sitios;
			
			$result["info"] = "success";
			
		} catch (RastyException $e) {
			
			$result["error"] =$this->localize( $e->getMessage() );
			
		}
		
		return $result;
		
	}

}
?>