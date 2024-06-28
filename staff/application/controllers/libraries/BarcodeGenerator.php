<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Picqer\Barcode\BarcodeGeneratorHTML;

class BarcodeGenerator {

    protected $ci;
    protected $generator;

    public function __construct()
    {
        $this->ci =& get_instance();
        $this->ci->load->library('barcode');

        $this->generator = new BarcodeGeneratorHTML();
    }

    public function generate($code, $type = 'code128', $width = 200, $height = 50)
    {
        return $this->generator->getBarcode($code, $type, $width, $height);
    }
}
