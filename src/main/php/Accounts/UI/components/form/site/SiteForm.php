<?php

namespace Accounts\UI\components\form\site;





use Accounts\UI\utils\AccountsUIUtils;

use Accounts\UI\service\UIServiceFactory;


use Rasty\Forms\form\Form;

use Rasty\components\RastyComponent;
use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;



use Rasty\utils\LinkBuilder;

/**
 * Formulario para site

 * @author Marcos
 * @since 15/03/2021
 */
class SiteForm extends Form{



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


    public function __construct(){

        parent::__construct();
        $this->setLabelCancel("form.cancelar");

        $this->addProperty("nombre");
        $this->addProperty("mail");
        $this->addProperty("description");
        $this->addProperty("logo");

        $this->setBackToOnSuccess("Sites");
        $this->setBackToOnCancel("Sites");


    }

    public function getOid(){

        return $this->getComponentById("oid")->getPopulatedValue( $this->getMethod() );
    }


    public function getType(){

        return "SiteForm";

    }

    public function fillEntity($entity){

        parent::fillEntity($entity);




    }

    protected function parseXTemplate(XTemplate $xtpl){

        parent::parseXTemplate($xtpl);


        $xtpl->assign("cancel", $this->getLinkCancel() );
        $xtpl->assign("lbl_cancel", $this->localize( $this->getLabelCancel() ) );

        $xtpl->assign("lbl_nombre", $this->localize("site.nombre") );
        $xtpl->assign("lbl_mail", $this->localize("site.mail") );
        $xtpl->assign("lbl_description", $this->localize("site.description") );

        $xtpl->assign("lbl_logo", $this->localize("site.logo") );


        if ($this->getSite()->getLogo()) {



            $mostrarLogo = 'var img = "<img id=\"uploadedImageuploadImage\" src=\"'.AccountsUIUtils::getLogoSite( $this->getSite() ).'\" width=\"80px\" height=\"\">";
			$("#uploadedImageContaineruploadImage").html(img);
			$("#uploadedImageDivuploadImage").show();';

            $xtpl->assign("mostrarLogo",$mostrarLogo);
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



    public function getSite()
    {
        return $this->site;
    }

    public function setSite($site)
    {
        $this->site = $site;

    }

    public function getLinkCancel(){
        $params = array();

        return LinkBuilder::getPageUrl( $this->getBackToOnCancel() , $params) ;
    }


    public function getUploadPath(){
        return AccountsUIUtils::getUploadPathLogoSites();
    }

    public function getUploadWebPath(){
        return AccountsUIUtils::getUploadWebPathLogoSites();
    }



}
?>
