<?php
namespace Accounts\UI\components\filter\model;


use Accounts\UI\components\filter\model\UIAccountsCriteria;

use Rasty\utils\RastyUtils;
use Accounts\Core\criteria\CajaCriteria;

/**
 * Representa un criterio de búsqueda
 * para cajas.
 *
 * @author Bernardo
 * @since 25/05/2014
 *
 */
class UICajaCriteria extends UIAccountsCriteria{


	private $numero;

	private $cajero;

	private $sucursal;

	private $fecha;

	public function __construct(){

		parent::__construct();

	}

	protected function newCoreCriteria(){
		return new CajaCriteria();
	}

	public function buildCoreCriteria(){

		$criteria = parent::buildCoreCriteria();

		$criteria->setNumero( $this->getNumero() );
		$criteria->setCajero( $this->getCajero() );
		$criteria->setFecha( $this->getFecha() );
		$criteria->setSucursal( $this->getSucursal() );
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

    public function getCajero()
    {
        return $this->cajero;
    }

    public function setCajero($cajero)
    {
        $this->cajero = $cajero;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    public function getSucursal()
    {
        return $this->sucursal;
    }

    public function setSucursal($sucursal)
    {
        $this->sucursal = $sucursal;
    }
}
