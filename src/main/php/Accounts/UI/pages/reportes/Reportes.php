<?php
namespace Accounts\UI\pages\reportes;


use Accounts\UI\pages\AccountsPage;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\i18n\Locale;
use Rasty\utils\LinkBuilder;

use Rasty\Grid\filter\model\UICriteria;

use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

class Reportes extends AccountsPage{

	private $fecha;

	public function __construct(){

		$this->setFecha( new \Datetime() );
	}


	protected function parseXTemplate(XTemplate $xtpl){

		$xtpl->assign("reportes_legend", $this->localize("reportes.legend") );

		//reportes
// 		$this->parseReporte( $xtpl, $this->localize("reportes.balanceDia.legend"), "BalanceDia" );
// 		$this->parseReporte( $xtpl, $this->localize("reportes.balanceCajas.legend"), "BalanceCajas" );
		$this->parseReporte( $xtpl, $this->localize("stats.informeSemanal.porMes.legend"), "InformeSemanalPorMes" );
		$this->parseReporte( $xtpl, $this->localize("stats.informeSemanal.porSemana.legend"), "InformeSemanalPorSemana" );
		$this->parseReporte( $xtpl, $this->localize("stats.informeDiarioComision.porMes.legend"), "InformeDiarioComisionPorMes" );
		$this->parseReporte( $xtpl, $this->localize("reportes.gastos.gastosAnio.legend"), "GastosAnio" );



	}

	protected function parseReporte(XTemplate $xtpl, $titulo, $link){

		$xtpl->assign("titulo",  $titulo);
		$xtpl->assign("linkReporte",  $link);
		$xtpl->parse( "main.reporte" );

	}

	public function getTitle(){
		return  $this->localize("reportes.title")  ;
	}

	public function getMenuGroups(){

		$menuGroup = new MenuGroup();

		return array();
	}

	public function getType(){

		return "Reportes";

	}


	public function getFecha()
	{
	    return $this->fecha;
	}

	public function setFecha($fecha)
	{
	    $this->fecha = $fecha;
	}
}
?>
