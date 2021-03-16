<?php
namespace Accounts\UI\actions\sites;


use Accounts\UI\service\UIServiceFactory;

use Rasty\actions\Action;
use Rasty\actions\Forward;
use Rasty\utils\RastyUtils;
use Rasty\exception\RastyException;

use Rasty\security\RastySecurityContext;

use Rasty\factory\ComponentConfig;
use Rasty\factory\ComponentFactory;

use Rasty\i18n\Locale;

use Rasty\factory\PageFactory;

/**
 * se asignan usuarios a un sitio.
 *
 * @author Marcos
 * @since 16/03/2021
 */
class AsignarUsuariosSite extends Action{


    public function execute(){

        $forward = new Forward();

        $page = PageFactory::build("UsuarioAsignar");

        $siteUsuariosForm = $page->getComponentById("siteUsuariosForm");

        $oid = $siteUsuariosForm->getOid();

        try {

            //obtenemos el usuario.
            $site = UIServiceFactory::getUISiteService()->get($oid );

            //lo editamos con los datos del formulario.
            $siteUsuariosForm->fillEntity($site);

            //guardamos los cambios.
            UIServiceFactory::getUISiteService()->update( $site );

            $forward->setPageName( $siteUsuariosForm->getBackToOnSuccess() );
            $forward->addParam( "siteOid", $site->getOid() );

            $siteUsuariosForm->cleanSavedProperties();

        } catch (RastyException $e) {

            $forward->setPageName( "UsuarioAsignar" );
            $forward->addError( Locale::localize($e->getMessage())  );
            $forward->addParam("oid", $oid );

            //guardamos lo ingresado en el form.
            $siteUsuariosForm->save();

        }
        return $forward;

    }

}
?>
