<?php
namespace Accounts\UI\pages\home;

use Accounts\UI\pages\AccountsPage;



use Accounts\UI\service\UIServiceFactory;



use Accounts\UI\utils\AccountsUIUtils;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\i18n\Locale;
use Rasty\utils\LinkBuilder;


use Accounts\Core\model\Caja;

use Rasty\Grid\filter\model\UICriteria;

use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;
use Rasty\Menu\menu\model\MenuActionOption;

use Rasty\security\RastySecurityContext;

class CajaHome extends AdminHome{


	private $fecha;
	private $caja;


	public function __construct(){


		$this->setFecha( new \Datetime() );

		if( AccountsUIUtils::isCajaSelected() )
			$this->setCaja(  UIServiceFactory::getUICajaService()->get(  AccountsUIUtils::getCaja()->getOid()) );



	}



	protected function parseXTemplate(XTemplate $xtpl){

		$title = $this->localize("admin_home.title");
		$subtitle = $this->localize("admin_home.subtitle");
		$xtpl->assign("app_title", $title );
		//$xtpl->assign("app_subtitle", $subtitle );

		$this->parseMenuUser($xtpl);



		$this->parseLinks($xtpl);


		$xtpl->assign("movimientosCaja_legend", $this->localize("empleado_home.movimientosCaja.legend") );
		$xtpl->assign("movimientosCaja_todos", $this->localize("empleado_home.movimientosCaja.todos") );
		$xtpl->assign("linkMovimientosCaja", $this->getLinkMovimientosCajaActual() );

		if( AccountsUIUtils::isCajaSelected() ){
			$caja = AccountsUIUtils::getCaja();
			//$xtpl->assign("caja_legend", AccountsUIUtils::formatMessage( $this->localize("empleado_home.caja.legend"), array($caja->getNumero())) );
			$xtpl->parse("main.movimientos_ver_todos");
			$xtpl->assign("linkRendirCaja", $this->getLinkRendirCaja( $caja ) );
		}else{
			//$xtpl->assign("caja_legend", $this->localize("empleado_home.caja_abrir.legend") );
		}






		if( AccountsUIUtils::isAdminLogged() ){
			$this->parseMenuAdmin($xtpl);
		}

	}

	public function parseLinks( XTemplate $xtpl){

		parent::parseLinks($xtpl);

		$xtpl->assign("lbl_abrir",  $this->localize( "caja.abrir" ) );
		$xtpl->assign("lbl_cerrar",  $this->localize( "caja.cerrar" ) );
		$xtpl->assign("lbl_retirarEfectivo",  $this->localize( "caja.retirarEfectivo" ) );
		$xtpl->assign("lbl_ingresarEfectivo",  $this->localize( "caja.ingresarEfectivo" ) );
		$xtpl->assign("lbl_depositarBanco",  $this->localize( "caja.depositarBanco" ) );
		$xtpl->assign("lbl_seleccionar",  $this->localize( "caja.seleccionar" ) );

		$xtpl->assign("linkSeleccionarCaja", $this->getLinkSeleccionarCaja() );
		$xtpl->assign("linkIngresarEfectivo", $this->getLinkIngresarEfectivo() );
		$xtpl->assign("linkDepositarBanco", $this->getLinkDepositarBanco() );
		$xtpl->assign("linkRetirarEfectivo", $this->getLinkRetirarEfectivo() );
		$xtpl->assign("linkAbrirCaja", $this->getLinkAbrirCaja() );


		$caja = $this->getCaja();
		if( !empty($caja) ){
			$xtpl->assign("linkCerrarCaja", $this->getLinkCerrarCaja( $this->getCaja() ) );

			if( AccountsUIUtils::isAdminLogged() ){
				$xtpl->assign("boton_cerrar_width", "" );
				$xtpl->parse("main.caja.retirarEfectivo");
				$xtpl->parse("main.caja.ingresarEfectivo");
				$xtpl->parse("main.caja.seleccionar");
			}else{
				$xtpl->assign("boton_cerrar_width", " double " );
				$xtpl->parse("main.caja.retirarEfectivo");
				$xtpl->parse("main.caja.ingresarEfectivo");
			}
			$xtpl->parse("main.caja" );
		}else{
			$xtpl->parse("main.sinCaja");
		}


	}

	public function getLinkCerrarCaja( Caja $caja ){

		$link = LinkBuilder::getPageUrl( "CerrarCaja", array("cajaOid"=>$caja->getOid(), "detalle"=>1)) ;

		return $link;
	}

	public function getLinkAbrirCaja( ){

		$link = LinkBuilder::getPageUrl( "AbrirCaja" ) ;

		return $link;
	}

	public function getLinkSeleccionarCaja( ){

		$link = LinkBuilder::getPageUrl( "SeleccionarCaja" ) ;

		return $link;
	}

	public function getLinkDepositarBanco(){

		$link = LinkBuilder::getPageUrl( "DepositarEfectivo" ) ;

		return $link;
	}

	public function getLinkIngresarEfectivo(){

		$link = LinkBuilder::getPageUrl( "IngresarEfectivo" ) ;

		return $link;
	}

	public function getLinkRetirarEfectivo(){

		$link = LinkBuilder::getPageUrl( "RetirarEfectivo" ) ;

		return $link;
	}

	public function getTitle(){

			$nombre ="";
		return AccountsUIUtils::formatMessage( $this->localize("empleado_home.title"), array($nombre)) ;
	}

	public function getMenuGroups(){

		$menuGroup = new MenuGroup();

		//		$menuOption = new MenuOption();
		//		$menuOption->setLabel( $this->localize( "ausencia.agregar" ) );
		//		$menuOption->setPageName("AusenciaAgregar");
		//		$menuOption->setImageSource( $this->getWebPath() . "css/images/ausencias_48.png" );
		//		$menuGroup->addMenuOption( $menuOption );
		//
		//		$menuOption = new MenuOption();
		//		$menuOption->setLabel( $this->localize( "horario.definir" ) );
		//		$menuOption->setPageName("HorariosProfesional");
		//		$menuOption->setImageSource( $this->getWebPath() . "css/images/horarios_48.png" );
		//		$menuGroup->addMenuOption( $menuOption );

		return array();
	}

	public function getType(){

		return "CajaHome";

	}



	public function getFecha()
	{
		return $this->fecha;
	}

	public function setFecha($fecha)
	{
		$this->fecha = $fecha;
	}

	public function getCaja()
	{
		return $this->caja;
	}

	public function setCaja($caja)
	{
		$this->caja = $caja;
	}






}
?>
