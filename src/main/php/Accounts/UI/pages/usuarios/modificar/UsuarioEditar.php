<?php
namespace Accounts\UI\pages\usuarios\modificar;

use Accounts\UI\pages\AccountsPage;

use Rasty\Security\service\UIServiceFactory;

use Rasty\utils\XTemplate;
use Cose\Security\model\User;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;


/**
 * Página para modificar usuarios
 *
 * @author Marcos
 * @since 17/03/2021
 *
 *
 */
class UsuarioEditar extends AccountsPage{

	/**
	 * usuario a modificar.
	 * @var Usuario
	 */
	private $usuario;


	public function __construct(){

		//inicializamos el usuario.
		$usuario = new User();
		$this->setUsuario($usuario);

	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario
		//y utilizando permisos

		$menuGroup = new MenuGroup();

		return array($menuGroup);
	}

	public function setUsuarioOid($oid){

		//a partir del id buscamos el usuario a modificar.
		$usuario = UIServiceFactory::getUIUsuarioService()->get($oid);

		$this->setUsuario($usuario);

	}

	public function getTitle(){
		return $this->localize( "usuario.modificar.title" );
	}

	public function getType(){

		return "UsuarioEditar";

	}

	protected function parseXTemplate(XTemplate $xtpl){

	}

	public function getUsuario(){

	    return $this->usuario;
	}

	public function setUsuario($usuario)
	{
	    $this->usuario = $usuario;
	}
}
?>
