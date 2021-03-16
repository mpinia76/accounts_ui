<?php
namespace Accounts\UI\pages\pagos\anular;

use Accounts\UI\service\UIServiceFactory;

use Accounts\Core\utils\AccountsUtils;
use Accounts\UI\utils\AccountsUIUtils;

use Accounts\UI\pages\AccountsPage;

use Rasty\utils\XTemplate;
use Accounts\Core\model\Pago;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

class PagoAnular extends AccountsPage{

	/**
	 * pago a anular.
	 * @var Pago
	 */
	private $pago;

	private $error;

	public function __construct(){

		//inicializamos el pago.
		$pago = new Pago();


		$this->setPago($pago);


	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario
		//y utilizando permisos

		$menuGroup = new MenuGroup();

//		$menuOption = new MenuOption();
//		$menuOption->setLabel( $this->localize( "form.volver") );
//		$menuOption->setPageName("Pagos");
//		$menuGroup->addMenuOption( $menuOption );
//

		return array($menuGroup);
	}

	public function getTitle(){
		return $this->localize( "pago.anular.title" );
	}

	public function getType(){

		return "PagoAnular";

	}

	protected function parseXTemplate(XTemplate $xtpl){

		$xtpl->assign( "pago_legend", $this->localize( "anularPago.pago.legend") );

		$xtpl->assign( "pagoOid", $this->getPago()->getOid() );

		$xtpl->assign( "linkAnularPago", $this->getLinkActionAnularPago($this->getPago()) );

		$msg = $this->getError();

		if( !empty($msg) ){

			$xtpl->assign("msg", $msg);
			//$xtpl->assign("msg",  );
			$xtpl->parse("main.msg_error" );
		}

		$xtpl->assign( "lbl_submit", $this->localize("anularPago.confirm") );
		$xtpl->assign( "lbl_cancel", $this->localize("anularPago.cancel") );

	}


	public function getPago()
	{
	    return $this->pago;
	}

	public function setPago($pago)
	{
	    $this->pago = $pago;
	}

	public function setPagoOid($pagoOid)
	{
		if(!empty($pagoOid)){
			$pago = UIServiceFactory::getUIPagoService()->get($pagoOid);
			$this->setPago($pago);
		}


	}

	public function getMsgError(){
		return "";
	}

	public function getError()
	{
	    return $this->error;
	}

	public function setError($error)
	{
	    $this->error = $error;
	}
}
?>
