<?php
namespace Rasty\Security\pages\usuarios\roles;

use Rasty\Security\utils\Rasty\SecurityUIUtils;

use Rasty\Security\pages\RastySecurityPage;

use Rasty\Security\service\UIServiceFactory;

use Rasty\utils\XTemplate;
use Cose\Security\model\User;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

use Rasty\utils\RastyUtils;

/**
 * Página para consultar los roles asignados a un usuario
 *
 * @author bernardo
 * @since 30-01-2015
 *
 * @Rasty\security\annotations\Secured( permission='CONSULTAR ROLES' )
 */
class RolConsultar extends RastySecurityPage{

	/**
	 * usuario a asignar roles.
	 * @var User
	 */
	private $usuario;


	public function __construct(){

		//inicializamos el rol.
		$usuario = new User();
		$this->setUsuario($usuario);

	}

	public function getMenuGroups(){

		//TODO construirlo a partir del rol
		//y utilizando permisos

		$menuGroup = new MenuGroup();


		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "form.volver") );
		$menuOption->setPageName("Usuarios");
		$menuOption->setIconClass( "icon-volver" );
		$menuGroup->addMenuOption( $menuOption );


		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "menu.usuarios.asignarRoles") );
		$menuOption->setPageName( "RolAsignar" );
		$menuOption->addParam("oid",$this->getUsuario()->getOid());
		$menuOption->setIconClass( "icon-roles" );
		$menuGroup->addMenuOption( $menuOption );


		return array($menuGroup);
	}

	public function setUsuarioOid($oid){

		//a partir del id buscamos el rol a modificar.
		$usuario = UIServiceFactory::getUIUsuarioService()->get($oid);

		$this->setUsuario($usuario);

	}

	public function getTitle(){
		return $this->localize( "usuario.consultarRoles.title" );
	}

	public function getType(){

		return "RolConsultar";

	}

	protected function parseXTemplate(XTemplate $xtpl){

		$legend = $this->localize("usuario.consultarRoles.legend");
		$legend = RastyUtils::formatMessage($legend, array($this->getUsuario()->getName()));
		$xtpl->assign("legend", $legend );

		$roles = $this->getUsuario()->getGroups();
		foreach ($roles as $rol) {
			$xtpl->assign("rol_oid", $rol->getOid() );
			$xtpl->assign("rol_name", $rol->__toString() );

			$xtpl->parse("main.rol" );
		}
	}


	public function getUsuario()
	{
	    return $this->usuario;
	}

	public function setUsuario($usuario)
	{
	    $this->usuario = $usuario;
	}
}
?>
