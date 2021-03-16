<?php
namespace Accounts\UI\pages\sites\modificar;

use Accounts\UI\pages\AccountsPage;

use Accounts\UI\service\UIServiceFactory;

use Rasty\utils\XTemplate;
use Accounts\Core\model\Site;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

class SiteModificar extends AccountsPage{

	/**
	 * site a modificar.
	 * @var Site
	 */
	private $site;


	public function __construct(){

		//inicializamos el site.
		$site = new Site();
		$this->setSite($site);

	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario
		//y utilizando permisos

		$menuGroup = new MenuGroup();

		return array($menuGroup);
	}

	public function setSiteOid($oid){

		//a partir del id buscamos el site a modificar.
		$site = UIServiceFactory::getUISiteService()->get($oid);

		$this->setSite($site);

	}

	public function getTitle(){
		return $this->localize( "site.modificar.title" );
	}

	public function getType(){

		return "SiteModificar";

	}

	protected function parseXTemplate(XTemplate $xtpl){

	}

	public function getSite(){

	    return $this->site;
	}

	public function setSite($site)
	{
	    $this->site = $site;
	}
}
?>
