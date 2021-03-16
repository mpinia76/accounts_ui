<?php
namespace Accounts\UI\actions\sites;

use Accounts\UI\utils\AccountsUIUtils;

use Accounts\UI\components\form\site\SiteForm;

use Accounts\UI\service\UIServiceFactory;
use Accounts\Core\model\Site;

use Rasty\actions\Action;
use Rasty\actions\Forward;
use Rasty\utils\RastyUtils;
use Rasty\exception\RastyException;

use Rasty\security\RastySecurityContext;

use Rasty\i18n\Locale;
use Rasty\factory\PageFactory;
use Rasty\exception\RastyDuplicatedException;

use Rasty\utils\Logger;

/**
 * colabora para el upload del logo del sitio
 *
 * @author Marcos
 * @since 15/03/2021
 */
class SiteLogoHelper{


	public static function process(Site $site){

		$siteImage = $site->getLogo();

		if(empty($siteImage))
			return;

		//una vez que está todo ok, movemos la logo y el thumbnail desde
		//el directorio de uploads al directorio de imágenes
		$uploadPath = AccountsUIUtils::getUploadPathLogoSites();
		$imagePath = AccountsUIUtils::getPathLogoSites();




		//chequeamos si hay que crear el directorio de las imágenes
		if(!file_exists($imagePath)){
			mkdir ($imagePath);

		}

		//movemos las imágenes.
		$logoName = $site->getLogo();
		$thumbnailName = "thumbnail_" .$site->getLogo();

		$tmpImageUri = $uploadPath.$logoName;
		$tmpThumbnailUri = $uploadPath.$thumbnailName;

		$imageUri = $imagePath.$logoName;
		$thumbnailUri = $imagePath.$thumbnailName;


		if(file_exists($tmpImageUri)){
			if(!rename($tmpImageUri, $imageUri))
				throw new RastyException("upload.image.error");

		}

		if(file_exists($tmpThumbnailUri)){
			if(!rename($tmpThumbnailUri, $thumbnailUri))
				throw new RastyException("upload.image.thumbnail.error");
		}
	}

}
?>
