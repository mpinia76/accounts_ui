<?php
namespace Accounts\UI\components\filter\model;


use Accounts\UI\components\filter\model\UIAccountsCriteria;

use Rasty\utils\RastyUtils;
use Accounts\Core\criteria\ConceptoGastoCriteria;

use Accounts\UI\utils\AccountsUIUtils;

/**
 * Representa un criterio de búsqueda
 * para Conceptos de gastos.
 *
 * @author Bernardo
 * @since 29/05/2014
 *
 */
class UIConceptoGastoCriteria extends UIAccountsCriteria{

	private $nombre;

	private $site;

	public function __construct(){

		parent::__construct();

        if (AccountsUIUtils::isAdminSiteLogged()){
            $this->setSite(AccountsUIUtils::getAdminSiteLogged());
        }

	}

	protected function newCoreCriteria(){
		return new ConceptoGastoCriteria();
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
