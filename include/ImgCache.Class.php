<?php
Class ImgCache extends Config{

	const ALLOW_IMAGE_TYPE = [IMAGETYPE_GIF,IMAGETYPE_JPEG,IMAGETYPE_PNG,IMAGETYPE_BMP];


	/**
	 *
	 *
	 * @author jakkrokk
	 * @copyright jakkrokk
	 */
	public function __construct() {
		$this->domain = $_SERVER['HTTP_HOST'];
	}


	/**
	 *
	 *
	 * @author jakkrokk
	 * @copyright jakkrokk
	 */
	public function attach() {
		//Allow uid=string name=string AND bin=binary
		if (isset($_POST['uid']) && isset($_POST['name']) && isset($_POST['bin'])) {
			$f = $this->createFileName($_POST['uid'],$_POST['name']);
			//Tmp insert for checking mime.
			file_put_contents(parent::IMG_SAVE_DIR.$f,$_POST['bin']);

			//Check file is image.
			if ($this->isImage(parent::IMG_SAVE_DIR.$f)) {
				//If image then deflate.
				//$bin = gzdeflate($_POST['bin']);
				//file_put_contents(parent::IMG_SAVE_DIR.$f,$bin);
				echo "{$this->domain}/images/{$f}";
				die;
			} else {
				//If non image then unlink.
				unlink(parent::IMG_SAVE_DIR.$f);
			}
		}
		echo 0;
	}


	/**
	 *
	 *
	 * @author jakkrokk
	 * @copyright jakkrokk
	 */
	public function detach($f) {
		$ff = explode('/',$f);
		$f = end($ff);
		if (file_exists(parent::IMG_SAVE_DIR.$f)) {
			unlink(parent::IMG_SAVE_DIR.$f);
			echo 1;
			die;
		}
		echo 0;
	}


	/**
	 *
	 *
	 * @author jakkrokk
	 * @copyright jakkrokk
	 */
	private function createFileName($uid,$fname) {
		//Create filename.
		$c = explode('.',$fname);
		$d = md5(date('U')).$uid;
		return $d.'.'.end($c);
	}


	/**
	 *
	 *
	 * @author jakkrokk
	 * @copyright jakkrokk
	 */
	private function isImage($path) {
		return in_array(exif_imagetype($path),self::ALLOW_IMAGE_TYPE);
	}
}
