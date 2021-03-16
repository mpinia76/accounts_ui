<?php
namespace Accounts\UI\pages\sites\usuarios;

use Accounts\UI\pages\AccountsPage;

use Accounts\UI\service\UIServiceFactory;

use Accounts\Core\model\Site;

use Rasty\utils\XTemplate;

use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

/**
 * Página para asignar usuarios a un sitio
 *
 * @author Marcos
 * @since 15-03-2021
 *
 * @Rasty\security\annotations\Secured( permission='ASIGNAR USUARIO' )
 */
class UsuarioAsignar extends AccountsPage{

	/**
	 * site a asignar usuarios.
	 * @var Site
	 */
	private $site;

    /**
     * @return Site
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * @param Site $site
     */
    public function setSite($site)
    {
        $this->site = $site;
    }


	public function __construct(){

		//inicializamos el rol.
		$site = new Site();
		$this->setSite($site);

	}

	public function getMenuGroups(){

		//TODO construirlo a partir del rol
		//y utilizando permisos

		$menuGroup = new MenuGroup();

		return array($menuGroup);
	}

	public function setSiteOid($oid){

		//a partir del id buscamos el rol a modificar.
		$site = UIServiceFactory::getUISiteService()->get($oid);

		$this->setSite($site);

	}

	public function getTitle(){
		return $this->localize( "site.asignarUsuarios.title" );
	}

	public function getType(){

		return "UsuarioAsignar";

	}

	protected function parseXTemplate(XTemplate $xtpl){

	}



}
?>
