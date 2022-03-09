<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Landing extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->session->set_userdata('user_id',7);
        $this->load->model('PickupRequest');
        
    }

    public function index()
    {
        $this->load->view('header');
        $this->load->view('landing');
    }

    public function my_requests()
    {
        $user_id = $this->session->user_id;
        $data['my_requests']=$this->PickupRequest->getRequests($user_id);
        
        $this->load->view('header');
        $this->load->view('my_requests', $data);
        
    }

}

/* End of file Landing.php */
