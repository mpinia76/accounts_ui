<?php
namespace Accounts\UI\pages\sites\agregar;

use Accounts\UI\pages\AccountsPage;

use Rasty\utils\XTemplate;
use Accounts\Core\model\Site;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

class SiteAgregar extends AccountsPage{

	/**
	 * site a agregar.
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

		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "form.volver") );
		$menuOption->setPageName("Sites");
		$menuGroup->addMenuOption( $menuOption );


		return array($menuGroup);
	}

	public function getTitle(){
		return $this->localize( "site.agregar.title" );
	}

	public function getType(){

		return "SiteAgregar";

	}

	protected function parseXTemplate(XTemplate $xtpl){
		$siteForm = $this->getComponentById("siteForm");
		//$siteForm->fillFromSaved( $this->getSite() );

	}


	public function getSite()
	{
	    return $this->site;
	}

	public function setSite($site)
	{
	    $this->site = $site;
	}



	public function getMsgError(){
		return "";
	}
}
?>
