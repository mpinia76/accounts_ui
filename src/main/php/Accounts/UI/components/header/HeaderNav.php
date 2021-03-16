<?php

namespace Accounts\UI\components\header;

use Accounts\UI\utils\AccountsUIUtils;

use Rasty\components\RastyComponent;
use Rasty\utils\RastyUtils;
use Rasty\utils\XTemplate;

use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;
use Rasty\Menu\menu\model\MenuActionOption;
use Rasty\Menu\menu\model\SubmenuOption;

class HeaderNav extends RastyComponent{

	private $title;

	private $pageMenuGroups;

	private $uri;

    /**
     * @return mixed
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @param mixed $uri
     */
    public function setUri($uri)
    {
        $this->uri = $uri;
    }

	public function __construct(){
		$this->pageMenuGroups = array();
        $this->setUri($_SERVER['REQUEST_URI']);


		//$this->setTitle($this->localize("app.title"));
	}

	public function getType(){

		return "HeaderNav";

	}

	protected function parseXTemplate(XTemplate $xtpl){


		//$xtpl->assign("accounts_titulo", $this->localize("app.title"));
		$titles = array();
		$titles[] = $this->localize("app.title");
		$titles[] = $this->getTitle();

		$xtpl->assign("accounts_titulo", implode(" / ", $titles));

		$xtpl->assign("menu_page", $this->localize("menu.page"));
		$xtpl->assign("menu_main", $this->localize("menu.main"));

	}

	public function getMainMenuGroups(){

		//TODO construirlo a partir del usuario
		//y utilizando permisos

		//$menuGroup = new MenuGroup();
		$menuGroups=array();
		if( AccountsUIUtils::isAdminLogged()) {

			$menuOption = new MenuOption();
			$menuOption->setLabel( $this->localize( "menu.admin_home") );
			$menuOption->setPageName( "AdminHome" );
			//$menuOption->setImageSource( $this->getWebPath() . "css/images/empleado_home_48.png" );
			$menuOption->setIconClass("icon-admin_home");

			//$menuGroup->addMenuOption( $menuOption );
//			$menuGroups[] = $menuOption;


            $menuGroups[] = $this->getMenuHome() ;
			$menu = $this->getMenuSeguridad() ;
			if($menu)
				$menuGroups[] =  $menu;


			


		}elseif (AccountsUIUtils::isAdminSiteLogged()){
			$menuGroups[] =  $this->getMenuAdmin() ;
			$menuGroups[] =  $this->getMenuCuentas() ;
		}


		//return array($menuGroup);
		return $menuGroups;
	}


    public function getMenuHome(){


        $menuGroup = new MenuGroup();
        $menuGroup->setLabel( $this->localize( "menu.principal") );

        $menuOption = new MenuOption();
        $menuOption->setLabel( $this->localize( "menu.home") );
        $menuOption->setIconClass("home");
        $menuOption->setPageName( "AdminHome" );
        $selected=0;
        if (strpos($this->getUri(), 'home')){
            $selected=1;
        }
        $menuOption->setSelected( $selected);
        $submenuOption = new MenuOption();
        $submenuOption->setLabel( $this->localize( "menu.home") );
        $submenuOption->setPageName("AdminHome");
        $selected=0;
        if (strpos($this->getUri(), 'home.html')){
            $selected=1;
        }
        $submenuOption->setSelected( $selected);


        $menuOption->addSubMenuOption($submenuOption);




        $menuGroup->addMenuOption( $menuOption );







        $submenu = new SubmenuOption($menuGroup);

        return $submenu;
    }


    public function getMenuAdmin(){


    $menuGroup = new MenuGroup();
    $menuGroup->setLabel( $this->localize( "menu.admin") );

    $menuOption = new MenuOption();
    $menuOption->setLabel( $this->localize( "menu.conceptoGastos") );
    $menuOption->setIconClass("card-list");
    $menuOption->setPageName( "ConceptoGastos" );
    $selected=0;
    if (strpos($this->getUri(), 'conceptoGastos')){
        $selected=1;
    }
    $menuOption->setSelected( $selected);
    $submenuOption = new MenuOption();
    $submenuOption->setLabel( $this->localize( "menu.todos") );
    $submenuOption->setPageName("ConceptoGastos");
    $selected=0;
    if (strpos($this->getUri(), 'conceptoGastos.html')){
        $selected=1;
    }
    $submenuOption->setSelected( $selected);


    $menuOption->addSubMenuOption($submenuOption);

    $submenuOption = new MenuOption();
    $submenuOption->setLabel( $this->localize( "menu.agregar") );
    $submenuOption->setPageName("ConceptoGastoAgregar");

    $selected=0;
    if (strpos($this->getUri(), 'conceptoGastos/agregar.html')){
        $selected=1;
    }
    $submenuOption->setSelected( $selected);
    $menuOption->addSubMenuOption($submenuOption);

    //print_r($menuOption);

    $menuGroup->addMenuOption( $menuOption );


    $menuOption = new MenuOption();
    $menuOption->setLabel( $this->localize( "menu.bancos") );
    $menuOption->setIconClass("cash");
    $menuOption->setPageName( "Bancos" );


    $selected=0;
    if (strpos($this->getUri(), 'cuentas')){
        $selected=1;
    }
    $menuOption->setSelected( $selected);
    $submenuOption = new MenuOption();
    $submenuOption->setLabel( $this->localize( "menu.todos") );
    $submenuOption->setPageName("Bancos");
    $selected=0;
    if (strpos($this->getUri(), 'cuentas.html')){
        $selected=1;
    }
    $submenuOption->setSelected( $selected);


    $menuOption->addSubMenuOption($submenuOption);

    $submenuOption = new MenuOption();
    $submenuOption->setLabel( $this->localize( "menu.agregar") );
    $submenuOption->setPageName("BancoAgregar");
    $menuOption->addSubMenuOption($submenuOption);
    $selected=0;
    if (strpos($this->getUri(), 'cuentas/agregar.html')){
        $selected=1;
    }
    $submenuOption->setSelected( $selected);


    $menuGroup->addMenuOption( $menuOption );







		$submenu = new SubmenuOption($menuGroup);

		return $submenu;
	}

	public function getPageMenuGroups(){

		return $this->pageMenuGroups;
	}

	public function setPageMenuGroups($pageMenuGroups)
	{
	    $this->pageMenuGroups = $pageMenuGroups;
	}

	public function getTitle()
	{
	    return $this->title;
	}

	public function setTitle($title)
	{
		if(!empty($title))
	    	$this->title = $title;
	}

	public function getMenuSeguridad(){

		$menuGroup = new MenuGroup();
		$menuGroup->setLabel( $this->localize( "menu.seguridad") );

		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "menu.usuarios") );
		$menuOption->setPageName( "Usuarios" );
		//$menuOption->setImageSource( $this->getWebPath() . "css/images/movimientos_32.png" );
		$menuOption->setIconClass("users");

        $selected=0;
        if (strpos($this->getUri(), 'usuarios')){
            $selected=1;
        }
        $menuOption->setSelected( $selected);

        $submenuOption = new MenuOption();
        $submenuOption->setLabel( $this->localize( "menu.todos") );
        $submenuOption->setPageName("Usuarios");
        $selected=0;
        if (strpos($this->getUri(), 'usuarios.html')){
            $selected=1;
        }
        $submenuOption->setSelected( $selected);


        $menuOption->addSubMenuOption($submenuOption);

        $submenuOption = new MenuOption();
        $submenuOption->setLabel( $this->localize( "menu.agregar") );
        $submenuOption->setPageName("UsuarioAgregar");

        $selected=0;
        if (strpos($this->getUri(), 'usuarios/agregar.html')){
            $selected=1;
        }
        $submenuOption->setSelected( $selected);
        $menuOption->addSubMenuOption($submenuOption);



		$menuGroup->addMenuOption($menuOption);


		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "menu.roles") );
		$menuOption->setIconClass("roles");
		$menuOption->setPageName( "Roles");

        $selected=0;
        if (strpos($this->getUri(), 'roles')){
            $selected=1;
        }
        $menuOption->setSelected( $selected);

        $submenuOption = new MenuOption();
        $submenuOption->setLabel( $this->localize( "menu.todos") );
        $submenuOption->setPageName("Roles");
        $selected=0;
        if (strpos($this->getUri(), 'roles.html')){
            $selected=1;
        }
        $submenuOption->setSelected( $selected);


        $menuOption->addSubMenuOption($submenuOption);

        $submenuOption = new MenuOption();
        $submenuOption->setLabel( $this->localize( "menu.agregar") );
        $submenuOption->setPageName("RolAgregar");

        $selected=0;
        if (strpos($this->getUri(), 'roles/agregar.html')){
            $selected=1;
        }
        $submenuOption->setSelected( $selected);
        $menuOption->addSubMenuOption($submenuOption);

		$menuGroup->addMenuOption($menuOption);

		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "menu.permisos") );
		$menuOption->setPageName( "Permisos" );
		$menuOption->setIconClass("unlock");

        $selected=0;
        if (strpos($this->getUri(), 'permisos')){
            $selected=1;
        }
        $menuOption->setSelected( $selected);

        $submenuOption = new MenuOption();
        $submenuOption->setLabel( $this->localize( "menu.todos") );
        $submenuOption->setPageName("Permisos");
        $selected=0;
        if (strpos($this->getUri(), 'permisos.html')){
            $selected=1;
        }
        $submenuOption->setSelected( $selected);


        $menuOption->addSubMenuOption($submenuOption);

        $submenuOption = new MenuOption();
        $submenuOption->setLabel( $this->localize( "menu.agregar") );
        $submenuOption->setPageName("PermisoAgregar");

        $selected=0;
        if (strpos($this->getUri(), 'permisos/agregar.html')){
            $selected=1;
        }
        $submenuOption->setSelected( $selected);
        $menuOption->addSubMenuOption($submenuOption);


		$menuGroup->addMenuOption($menuOption);

        $menuOption = new MenuOption();
        $menuOption->setLabel( $this->localize( "menu.sites") );
        $menuOption->setPageName( "Sites" );
        $menuOption->setIconClass("collection");

        $selected=0;
        if (strpos($this->getUri(), 'sites')){
            $selected=1;
        }
        $menuOption->setSelected( $selected);

        $submenuOption = new MenuOption();
        $submenuOption->setLabel( $this->localize( "menu.todos") );
        $submenuOption->setPageName("Sites");
        $selected=0;
        if (strpos($this->getUri(), 'sites.html')){
            $selected=1;
        }
        $submenuOption->setSelected( $selected);


        $menuOption->addSubMenuOption($submenuOption);

        $submenuOption = new MenuOption();
        $submenuOption->setLabel( $this->localize( "menu.agregar") );
        $submenuOption->setPageName("SiteAgregar");

        $selected=0;
        if (strpos($this->getUri(), 'sites/agregar.html')){
            $selected=1;
        }
        $submenuOption->setSelected( $selected);
        $menuOption->addSubMenuOption($submenuOption);


        $menuGroup->addMenuOption($menuOption);



			$submenu = new SubmenuOption($menuGroup);
			$submenu->setIconClass("icon-seguridad");
			return $submenu;




	}





	public function getMenuCuentas(){

		$menuGroup = new MenuGroup();
		$menuGroup->setLabel( $this->localize( "menu.cuentas") );



        $menuOption = new MenuOption();
        $menuOption->setLabel( $this->localize( "menu.gastos.listar") );
        $menuOption->setPageName( "Gastos" );
        $menuOption->setIconClass("cart-dash");
        $menuGroup->addMenuOption( $menuOption );

        $selected=0;
        if (strpos($this->getUri(), 'gastos')){
            $selected=1;
        }
        $menuOption->setSelected( $selected);
        $submenuOption = new MenuOption();
        $submenuOption->setLabel( $this->localize( "menu.todos") );
        $submenuOption->setPageName("Gastos");
        $selected=0;
        if (strpos($this->getUri(), 'gastos.html')){
            $selected=1;
        }
        $submenuOption->setSelected( $selected);


        $menuOption->addSubMenuOption($submenuOption);

        $submenuOption = new MenuOption();
        $submenuOption->setLabel( $this->localize( "menu.agregar") );
        $submenuOption->setPageName("GastoAgregar");

        $selected=0;
        if (strpos($this->getUri(), 'gastos/agregar.html')){
            $selected=1;
        }

        $submenuOption->setSelected( $selected);


        $menuOption->addSubMenuOption($submenuOption);



		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "banco.depositar") );
		$menuOption->setPageName( "DepositarEfectivo" );
		$menuOption->setIconClass("cart-plus");

        $selected=0;
        if (strpos($this->getUri(), 'depositar')){
            $selected=1;
        }
        $menuOption->setSelected( $selected);

        $submenuOption = new MenuOption();
        $submenuOption->setLabel( $this->localize( "banco.depositar") );
        $submenuOption->setPageName("DepositarEfectivo");

        $selected=0;
        if (strpos($this->getUri(), 'depositar.html')){
            $selected=1;
        }

        $submenuOption->setSelected( $selected);

        $menuOption->addSubMenuOption($submenuOption);
		$menuGroup->addMenuOption( $menuOption );

		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "menu.transferir") );
		$menuOption->setIconClass("arrow-left-right");
		$menuOption->setPageName( "Transferir");

        $selected=0;
        if (strpos($this->getUri(), 'transferir')){
            $selected=1;
        }
        $menuOption->setSelected( $selected);

        $submenuOption = new MenuOption();
        $submenuOption->setLabel( $this->localize( "menu.transferir") );
        $submenuOption->setPageName("Transferir");

        $selected=0;
        if (strpos($this->getUri(), 'transferir.html')){
            $selected=1;
        }

        $submenuOption->setSelected( $selected);

        $menuOption->addSubMenuOption($submenuOption);


		$menuGroup->addMenuOption( $menuOption );

        $menuOption = new MenuOption();
        $menuOption->setLabel( $this->localize( "menu.movimientos_banco") );
        $menuOption->setPageName( "MovimientosBanco" );
        //$menuOption->setImageSource( $this->getWebPath() . "css/images/movimientos_32.png" );
        $menuOption->setIconClass("settings");

        $selected=0;
        if (strpos($this->getUri(), 'movimientos')){
            $selected=1;
        }
        $menuOption->setSelected( $selected);

        $submenuOption = new MenuOption();
        $submenuOption->setLabel( $this->localize( "menu.movimientos_banco") );
        $submenuOption->setPageName("MovimientosBanco");

        $selected=0;
        if (strpos($this->getUri(), 'movimientos.html')){
            $selected=1;
        }

        $submenuOption->setSelected( $selected);

        $menuOption->addSubMenuOption($submenuOption);


        $menuGroup->addMenuOption( $menuOption );


		$submenu = new SubmenuOption($menuGroup);
		$submenu->setIconClass("icon-empleados");
		return $submenu;
	}




}
?>
