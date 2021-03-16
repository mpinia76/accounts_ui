<?php
namespace Accounts\UI\pages\home;

use Accounts\UI\pages\AccountsPage;

use Accounts\UI\components\filter\model\UIBancoCriteria;

use Accounts\UI\service\UIServiceFactory;

use Accounts\Core\utils\AccountsUtils;

use Accounts\UI\utils\AccountsUIUtils;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\i18n\Locale;
use Rasty\utils\LinkBuilder;



use Rasty\Grid\filter\model\UICriteria;

use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;



class AdminHome extends AccountsPage{





	public function __construct(){

	}

	public function getTitle(){
		return $this->localize( "admin_home.title" );
	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario
		//y utilizando permisos

		$menuGroup = new MenuGroup();

		return array($menuGroup);
	}



	protected function parseXTemplate(XTemplate $xtpl){

		$title = $this->localize("admin_home.title");
		$subtitle = $this->localize("admin_home.subtitle");
		$xtpl->assign("app_title", $title );
		//$xtpl->assign("app_subtitle", $subtitle );



		$this->parseGastos($xtpl);



		$this->parseLinks($xtpl);

		$this->parseSaldos($xtpl);


	}

	public function parseLinks( XTemplate $xtpl){

		$xtpl->assign("menu_admin", $this->localize("menu.admin") );


		$xtpl->assign("menu_gastos", $this->localize("menu.gastos") );
		$xtpl->assign("linkGastos", $this->getLinkGastos() );
		$xtpl->assign("menu_gastos_agregar", $this->localize("menu.gastos.agregar") );
		$xtpl->assign("linkGastoAgregar", $this->getLinkGastoAgregar() );



		$xtpl->assign("menu_bancos", $this->localize("menu.total") );
		$xtpl->assign("linkBancos", $this->getLinkBancos() );




		$xtpl->assign("menu_balance_caja", $this->localize("menu.balances.caja") );
		$xtpl->assign("linkBalanceCaja", $this->getLinkBalanceCaja() );

		$xtpl->assign("menu_balance_dia", $this->localize("menu.balances.dia") );
		$xtpl->assign("linkBalanceDia", $this->getLinkBalanceDia() );

		$xtpl->assign("menu_balance_mes", $this->localize("menu.balances.mes") );
		$xtpl->assign("linkBalanceMes", $this->getLinkBalanceMes() );

		$xtpl->assign("menu_balance_anio", $this->localize("menu.balances.anio") );
		$xtpl->assign("linkBalanceAnio", $this->getLinkBalanceAnio() );

		$xtpl->assign("menu_cuentas", $this->localize("menu.cuentas") );
		$xtpl->assign("menu_caja", $this->localize("menu.caja") );
		$xtpl->assign("linkCaja", $this->getLinkCajaHome());




	}



	public function parseSaldos(XTemplate $xtpl){





		$xtpl->assign("saldo_bancos", AccountsUIUtils::formatMontoToView( UIServiceFactory::getUIBancoService()->getSaldoBancos() ) );
		$xtpl->assign("linkMovimientosBanco", $this->getLinkMovimientosBanco());
		$xtpl->assign("menu_baproctacte",'Cta. Cte.' );

        $bancos = UIServiceFactory::getUIBancoService()->getList( new UIBancoCriteria() );

        foreach ($bancos as $banco){
            $uiCriteria = new UIBancoCriteria();
            $uiCriteria->setNombre( $banco->getNombre());
            $xtpl->assign("saldo_cuenta", AccountsUIUtils::formatMontoToView( UIServiceFactory::getUIBancoService()->getSaldoBanco($uiCriteria) ) );
            $xtpl->assign("menu_cuenta",$banco->getNombre());
            $xtpl->assign("linkMovimientosBanco", $this->getLinkMovimientosBanco($banco));
            $xtpl->parse("main.cuenta_banco");



        }





	}



	public function parseMenuAdmin( XTemplate $xtpl){

		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "menu.admin_home") );
		//$menuOption->setIconClass( "icon-exit" );
		$menuOption->setPageName( "AdminHome");
		$menuOption->setImageSource( $this->getWebPath() . "css/images/empleado_home_48.png" );

		$this->parseMenuOption($xtpl, $menuOption, "main.menuOptionAdmin");

	}
	public function parseMenuProfile( XTemplate $xtpl, $user){

		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "menu.profile") );
		$menuOption->setIconClass( "icon-cog" );
		$menuOption->setPageName( "UserProfile");
		$menuOption->addParam("oid",$user->getOid());
		$menuOption->setImageSource( $this->getWebPath() . "css/images/profile.png" );
		$this->parseMenuOption($xtpl, $menuOption, "main.menuOptionProfile");

	}

	public function parseMenuOption( XTemplate $xtpl, MenuOption $menuOption, $blockName){
		$xtpl->assign("label", $menuOption->getLabel() );
		$xtpl->assign("onclick", $menuOption->getOnclick());
		$img = $menuOption->getImageSource();
		if(!empty($img)){
			$xtpl->assign("src", $img );
			$xtpl->parse("$blockName.image");
		}
		$xtpl->assign("iconClass", $menuOption->getIconClass());

		$xtpl->parse("$blockName");
	}

	public function parseGastos( XTemplate $xtpl){

		$gastos = UIServiceFactory::getUIGastoService()->getGastosPorVencer();

		if(count($gastos) == 0 ){
			$xtpl->assign("titulo", $this->localize("gastos.por_vencer.vacio") );
			$xtpl->parse("main.sin_gasto");
		}

		foreach ($gastos as $gasto) {
			$xtpl->assign("titulo", AccountsUIUtils::formatDateToView( $gasto->getFechaVencimiento()) );
			$xtpl->assign("subtitulo", AccountsUIUtils::formatMontoToView($gasto->getMonto()) );
			$xtpl->assign("descripcion", $gasto->getConcepto() );
			$xtpl->parse("main.gasto");
		}

		$xtpl->assign("total_gastos", count($gastos));

	}




	public function getType(){

		return "AdminHome";

	}









}
?>
