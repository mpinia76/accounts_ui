<?php
namespace Accounts\UI\components\filter\model;


use Accounts\UI\components\filter\model\UIAccountsCriteria;

use Rasty\utils\RastyUtils;
use Accounts\Core\criteria\SiteCriteria;

/**
 * Representa un criterio de búsqueda
 * para Conceptos de gastos.
 *
 * @author Marcos
 * @since 15/03/2021
 *
 */
class UISiteCriteria extends UIAccountsCriteria{

	private $nombre;

	public function __construct(){

		parent::__construct();

	}

	protected function newCoreCriteria(){
		return new SiteCriteria();
	}

	public function buildCoreCriteria(){

		$criteria = parent::buildCoreCriteria();

		$criteria->setNombre( $this->getNombre() );

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
}
