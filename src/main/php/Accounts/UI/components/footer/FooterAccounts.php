<?php

namespace Accounts\UI\components\footer;

use Rasty\components\RastyComponent;
use Rasty\utils\XTemplate;


class FooterAccounts extends RastyComponent{


	public function __construct(){
	}

	public function getType(){

		return "FooterAccounts";

	}

	protected function parseXTemplate(XTemplate $xtpl){
        $xtpl->assign('year', date('Y'));

	}

}
?>
