<?php

namespace GameZone;


use mPDF;
use MpdfException;

class PDF extends mPDF {

    /**
     * @param array $vars
     * @param string $path
     * @throws MpdfException
     */
	public function writeTemplate(string $path, array $vars){
		ob_start();
        extract($vars);
		include $path;
		$this->WriteHTML(ob_get_clean());
	}


}