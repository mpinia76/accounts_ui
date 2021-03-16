<?php

namespace Accounts\UI\components\form\site;

use Accounts\UI\service\UIServiceFactory;

use Rasty\Forms\form\Form;

use Rasty\components\RastyComponent;
use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;

use Rasty\Security\components\filter\model\UIUsuarioCriteria;


use Rasty\utils\LinkBuilder;

/**
 * Formulario para asignar usuarios a un sitio

 * @author Marcos
 * @since 16/03/2021
 */
class SiteUsuariosForm extends Form
{


    /**
     * label para el cancel
     * @var string
     */
    private $labelCancel;


    /**
     *
     * @var Site
     */
    private $site;

    /**
     * @return Site
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * @param Site $site
     */
    public function setSite($site)
    {
        $this->site = $site;
    }


    public function __construct()
    {

        parent::__construct();
        $this->setLabelCancel("form.cancelar");

        $this->setBackToOnSuccess("Sites");
        $this->setBackToOnCancel("Sites");

    }

    public function getOid()
    {

        return $this->getComponentById("oid")->getPopulatedValue($this->getMethod());
    }

    public function fillEntity($entity)
    {

        parent::fillEntity($entity);

        //agregamos los usuarios.
        $usuarios_oids = RastyUtils::getParamPOST('usuarios');
        $usuarios = array();
        foreach ($usuarios_oids as $usuarioOid) {
            $usuarios[] = UIServiceFactory::getUIUserService()->get($usuarioOid);

        }
        $entity->setUsers($usuarios);

    }

    public function getType()
    {

        return "SiteUsuariosForm";

    }

    protected function parseXTemplate(XTemplate $xtpl)
    {

        parent::parseXTemplate($xtpl);


        $xtpl->assign("cancel", $this->getLinkCancel());
        $xtpl->assign("lbl_cancel", $this->localize($this->getLabelCancel()));

        $xtpl->assign("lbl_name", $this->localize("usuario.name"));

        $legend = $this->localize("site.asignarUsuarios.legend");
        $legend = RastyUtils::formatMessage($legend, array($this->getSite()->getNombre()));

        $xtpl->assign("legend", $legend);

        //mostrar todos los usuarios marcando los asignados al site.

        $uiCriteria = new UIUsuarioCriteria();
        $usuarios = UIServiceFactory::getUIUserService()->getUsers($uiCriteria);


        foreach ($usuarios as $usuario) {
            $xtpl->assign("usuario_oid", $usuario->getOid());
            $xtpl->assign("usuario_name", $usuario->__toString());

            if ($this->getSite()->hasSiteuserByName($usuario->getUsername()))
                $xtpl->assign('checked', "checked");
            else
                $xtpl->assign('checked', "");

            $xtpl->parse("main.usuario");
        }

    }


    public function getLabelCancel()
    {
        return $this->labelCancel;
    }

    public function setLabelCancel($labelCancel)
    {
        $this->labelCancel = $labelCancel;
    }


    public function getLinkCancel()
    {
        $params = array();

        return LinkBuilder::getPageUrl($this->getBackToOnCancel(), $params);
    }


}
?>
