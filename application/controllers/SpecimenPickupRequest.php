<?php

class SpecimenPickupRequest extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->database();
        
    }

    public function index()
    {
        $this->load->view('header');
        $this->load->view('pickuprequest');
    }
    public function getDestFacility()
    {
        if (!empty($this->input->post('searchTerm'))) {

            $searchTerm = $this->input->post('searchTerm');
            $this->load->model('PickupRequest');

            $response = $this->PickupRequest->getDestFacility($searchTerm);

            echo json_encode($response);
        } else {
            echo json_encode('Start Typing');
        }
    }
    public function getPickupFacility()
    {
        if (!empty($this->input->post('searchTerm'))) {

            $searchTerm = $this->input->post('searchTerm');
            $this->load->model('PickupRequest');

            $response = $this->PickupRequest->getPickupFacility($searchTerm);

            echo json_encode($response);
        } else {
            echo json_encode('Start Typing');
        }
    }
    public function process_request()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('dest_facility','Destination Facility','required');
        $this->form_validation->set_rules('pickup_facility','Pickup Facility','required');
        $this->form_validation->set_rules('pickup_date_time','Pickup Date and Time','required');


        if($this->form_validation->run()===FALSE)
        {
            $this->load->view('pickuprequest');
        }
        else{
            $this->load->model('pickuprequest');
            $this->load->helper('string');
            $manifest_id = random_string('alnum',5);


            $this->pickuprequest->save_request($manifest_id);
            
            $array = array(
                'manifest_id' => $manifest_id
            );
            
            $this->session->set_userdata( $array );
            ;
            redirect('Manifest/');
        
        }
        
    }
}
