<?php
namespace Accounts\UI\pages\gastos;

use Accounts\UI\pages\AccountsPage;




use Accounts\UI\utils\AccountsUIUtils;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\i18n\Locale;
use Rasty\utils\LinkBuilder;



use Rasty\security\RastySecurityContext;

class GastosXLS extends AccountsPage{



	public function __construct(){



	}

	public function getTitle(){
		return date('YmdHis').'_gastos';
	}



	protected function parseXTemplate(XTemplate $xtpl){

		$title = $this->localize("admin_home.title");
		$subtitle = $this->localize("admin_home.subtitle");
		$xtpl->assign("app_title", $title );

	}




	public function getType(){

		return "GastosXLS";

	}



}
?>
