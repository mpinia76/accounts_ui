<?php
namespace Accounts\UI\actions\usuarios;

use Accounts\UI\components\form\usuario\ProfileForm;

use Rasty\Security\service\UIServiceFactory;

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
 * se realiza la actualización de un Usuario.
 *
 * @author Marcos
 * @since 17/03/2021
 */
class EditarUsuario extends Action{


    public function execute(){

        $forward = new Forward();

        $page = PageFactory::build("UsuarioEditar");

        $usuarioForm = $page->getComponentById("profileForm");

        $oid = $usuarioForm->getOid();

        try {

            //obtenemos el usuario.
            $usuario = UIServiceFactory::getUIUsuarioService()->get($oid );
            $usuario->decrypt();

            //lo editamos con los datos del formulario.
            $usuarioForm->fillEntity($usuario);
            $usuario->encrypt();

            //guardamos los cambios.
            UIServiceFactory::getUIUsuarioService()->update( $usuario );

            $forward->setPageName( $usuarioForm->getBackToOnSuccess() );
            $forward->addParam( "usuarioOid", $usuario->getOid() );

            $usuarioForm->cleanSavedProperties();

        } catch (RastyException $e) {

            $forward->setPageName( "UsuarioModificar" );
            $forward->addError( Locale::localize($e->getMessage())  );
            $forward->addParam("oid", $oid );

            //guardamos lo ingresado en el form.
            $usuarioForm->save();

        }
        return $forward;

    }

}
?>
