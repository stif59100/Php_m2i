<?php

/**
 * Description of StagiaireDeProvince
 *
 * @author kalan
 */
require_once './Stagiaire.php';

class StagiaireDeProvince extends Stagiaire {

    //put your code here
    private $province;

    public function __construct($province) {
        $this->province = $province;
    }

    public function getProvince() {
        return $this->province;
    }

    public function setProvince($province): void {
        $this->province = $province;
    }

}
