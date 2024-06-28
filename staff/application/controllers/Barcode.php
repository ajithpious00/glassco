<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Picqer\Barcode\BarcodeGeneratorHTML;

class Barcode extends CI_Controller {

    public function index()
    {
        // Load the barcode generator library
        $this->load->helper('barcode');

        // Generate a barcode
       $barcode = $this->barcodegenerator->generate('123456789');
    }
}