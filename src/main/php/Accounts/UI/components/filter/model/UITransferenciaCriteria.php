<?php
namespace Accounts\UI\components\filter\model;


use Accounts\UI\components\filter\model\UIAccountsCriteria;

use Accounts\UI\utils\AccountsUIUtils;
use Rasty\utils\RastyUtils;
use Accounts\Core\criteria\TransferenciaCriteria;

/**
 * Representa un criterio de búsqueda
 * para Transferencias
 *
 * @author Bernardo
 * @since 03/06/2014
 *
 */
class UITransferenciaCriteria extends UIAccountsCriteria{


	private $origen;

	private $destino;

	private $fechaDesde;

	private $fechaHasta;

    private $site;

    /**
     * @return mixed
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * @param mixed $site
     */
    public function setSite($site)
    {
        $this->site = $site;
    }

	public function __construct(){

		parent::__construct();
        if (AccountsUIUtils::isAdminSiteLogged()){
            $this->setSite(AccountsUIUtils::getAdminSiteLogged());
        }
	}

	protected function newCoreCriteria(){
		return new TransferenciaCriteria();
	}

	public function buildCoreCriteria(){

		$criteria = parent::buildCoreCriteria();

		$criteria->setOrigen( $this->getOrigen() );
		$criteria->setDestino( $this->getDestino() );
		$criteria->setFechaDesde( $this->getFechaDesde() );
		$criteria->setFechaHasta( $this->getFechaHasta() );
		return $criteria;
	}


	public function getOrigen()
	{
	    return $this->origen;
	}

	public function setOrigen($origen)
	{
	    $this->origen = $origen;
	}

	public function getDestino()
	{
	    return $this->destino;
	}

	public function setDestino($destino)
	{
	    $this->destino = $destino;
	}

	public function getFechaDesde()
	{
	    return $this->fechaDesde;
	}

	public function setFechaDesde($fechaDesde)
	{
	    $this->fechaDesde = $fechaDesde;
	}

	public function getFechaHasta()
	{
	    return $this->fechaHasta;
	}

	public function setFechaHasta($fechaHasta)
	{
	    $this->fechaHasta = $fechaHasta;
	}
}
