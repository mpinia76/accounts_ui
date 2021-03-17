<?php
namespace Accounts\UI\components\filter\model;


use Accounts\UI\components\filter\model\UIAccountsCriteria;

use Accounts\UI\utils\AccountsUIUtils;
use Rasty\utils\RastyUtils;
use Accounts\Core\criteria\BancoCriteria;

/**
 * Representa un criterio de búsqueda
 * para Banco.
 *
 * @author Bernardo
 * @since 09-06-2014
 *
 */
class UIBancoCriteria extends UIAccountsCriteria{


	private $nombre;

	private $site;


	public function __construct(){

		parent::__construct();


        if (AccountsUIUtils::isAdminSiteLogged()){
            $this->setSite(AccountsUIUtils::getAdminSiteLogged());
        }

	}

	protected function newCoreCriteria(){
		return new BancoCriteria();
	}

	public function buildCoreCriteria(){

		$criteria = parent::buildCoreCriteria();

		$criteria->setNombre( $this->getNombre() );
		$criteria->setSite( $this->getSite() );
		return $criteria;
	}




	public function getNombre()
	{
	    return $this->nombre;
	}

	public function setNombre($nombre)
	{
	    $this->nombre = $nombre;
	}

	public function getSite()
	{
	    return $this->site;
	}

	public function setSite($site)
	{
	    $this->site = $site;
	}
}
