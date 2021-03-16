<?php
namespace Accounts\UI\components\filter\model;


use Accounts\UI\components\filter\model\UIAccountsCriteria;

use Rasty\utils\RastyUtils;
use Accounts\Core\criteria\InformeSemanalCriteria;

/**
 * Representa un criterio de búsqueda
 * para informes semanales.
 *
 * @author Bernardo
 * @since 14/04/2015
 *
 */
class UIInformeSemanalCriteria extends UIAccountsCriteria{

	private $mes;

	public function __construct(){

		parent::__construct();

	}

	protected function newCoreCriteria(){
		return new InformeSemanalCriteria();
	}

	public function buildCoreCriteria(){

		$criteria = parent::buildCoreCriteria();

		$criteria->setMes( $this->getMes() );

		return $criteria;
	}



	public function getMes()
	{
	    return $this->mes;
	}

	public function setMes($mes)
	{
	    $this->mes = $mes;
	}
}
