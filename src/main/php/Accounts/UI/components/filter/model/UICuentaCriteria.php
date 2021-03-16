<?php
namespace Accounts\UI\components\filter\model;


use Accounts\UI\components\filter\model\UIAccountsCriteria;

use Rasty\utils\RastyUtils;
use Accounts\Core\criteria\CuentaCriteria;

/**
 * Representa un criterio de búsqueda
 * para cuenta.
 *
 * @author Bernardo
 * @since 06-06-2014
 *
 */
class UICuentaCriteria extends UIAccountsCriteria{


	private $numero;


	public function __construct(){

		parent::__construct();

	}

	protected function newCoreCriteria(){
		return new CuentaCriteria();
	}

	public function buildCoreCriteria(){

		$criteria = parent::buildCoreCriteria();

		$criteria->setNumero( $this->getNumero() );
		return $criteria;
	}


    public function getNumero()
    {
        return $this->numero;
    }

    public function setNumero($numero)
    {
        $this->numero = $numero;
    }

}
