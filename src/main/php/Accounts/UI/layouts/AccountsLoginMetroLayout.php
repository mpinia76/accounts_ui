<?php

namespace Accounts\UI\layouts;

use Rasty\Layout\layout\Rasty\Layout;

use Rasty\utils\XTemplate;


class AccountsLoginMetroLayout extends AccountsMetroLayout{

	public function getXTemplate($file_template=null){
		return parent::getXTemplate( dirname(__DIR__) . "/layouts/AccountsLoginMetroLayout.htm" );
	}

	public function getType(){

		return "AccountsLoginMetroLayout";

	}

}
?>
