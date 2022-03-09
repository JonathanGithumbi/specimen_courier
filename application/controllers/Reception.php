<?php
include 'application\vendor\khanamiryan\qrcode-detector-decoder\lib\QrReader.php';
use Zxing\QrReader;

defined('BASEPATH') OR exit('No direct script access allowed');

class Reception extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('PickupRequest');
    }
    public function index()
    {
        $manifest_id  = $this->session->manifest_id;
        $request_id = $this->PickupRequest->getRequestId($manifest_id);
        $data['specimen_list']=$this->PickupRequest->getManifest($request_id);
        $this->load->view('header');
        $this->load->view('reception',$data);
        
    }

    public function validate_specimen_pickup($qr_code)
    {
        //switch
        
        if ($this->PickupRequest->validate_specimen_pickup($qr_code)) {
            echo json_encode('success');
        } else {
            echo json_encode('fail');
        }
      
    }

}

/* End of file Reception.php */
