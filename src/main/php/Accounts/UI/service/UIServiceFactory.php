<?php

namespace Accounts\UI\service;


/**
 * Factory de servicios de UI
 *
 * @author Marcos
 * @since 02/08/2018
 *
 */
class UIServiceFactory {


    /**
     * @return UISiteService
     */
    public static function getUISiteService(){

        return UISiteService::getInstance();
    }

	/**
	 * @return UIBalanceService
	 */
	public static function getUIBalanceService(){

		return UIBalanceService::getInstance();
	}

	/**
	 * @return UIBancoService
	 */
	public static function getUIBancoService(){

		return UIBancoService::getInstance();
	}

	/**
	 * @return UICajaService
	 */
	public static function getUICajaService(){

		return UICajaService::getInstance();
	}




	/**
	 * @return UIConceptoGastoService
	 */
	public static function getUIConceptoGastoService(){

		return UIConceptoGastoService::getInstance();
	}



	/**
	 * @return UICuentaService
	 */
	public static function getUICuentaService(){

		return UICuentaService::getInstance();
	}







	/**
	 * @return UIGastoService
	 */
	public static function getUIGastoService(){

		return UIGastoService::getInstance();
	}


	/**
	 * @return UIInformeSemanalService
	 */
	public static function getUIInformeSemanalService(){

		return UIInformeSemanalService::getInstance();
	}


	/**
	 * @return UIMovimientoCuentaService
	 */
	public static function getUIMovimientoCuentaService(){

		return UIMovimientoCuentaService::getInstance();
	}





	/**
	 * @return UITransferenciaService
	 */
	public static function getUITransferenciaService(){

		return UITransferenciaService::getInstance();
	}

	/**
	 * @return UIUserService
	 */
	public static function getUIUserService(){

		return UIUserService::getInstance();
	}



	/**
	 * @return UIPagoService
	 */
	public static function getUIPagoService(){

		return UIPagoService::getInstance();
	}

}
