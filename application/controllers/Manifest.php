<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Manifest extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('ciqrcode');
        $this->load->model('PickupRequest');
        $this->load->database();
        
        
    }

    public function index()
    {
        $manifest_id  = $this->session->manifest_id;
        $request_id = $this->PickupRequest->getRequestId($manifest_id);
        $data['request_id'] = $request_id;
        
        $data['specimen_list'] = $this->PickupRequest->getSpecimenList($manifest_id);
        
        $this->load->view('header');
        $this->load->view('manifest_builder',$data);
        $this->load->view('frontend/footer',$data);
    }

    public function summary($request_id)
    {
        $data['request_id'] = $request_id;
        $data['specimen_list']=$this->PickupRequest->getManifest($request_id);
        $data['request_details']=$this->PickupRequest->getRequestDetails($request_id);
        
        $this->load->view('header');
        $this->load->view('request_summary',$data);
        
    }

    function generate_qrcode($data)
	{
        /* Load QR Code Library */
        $this->load->library('ciqrcode');
        
        /* Data */
        $hex_data   = bin2hex($data);
        $save_name  = $hex_data.'.png';

        /* QR Code File Directory Initialize */
        $dir = 'resources/media/qrcode/';
        if (!file_exists($dir)) {
            mkdir($dir, 0775, true);
        }

        /* QR Configuration  */
        $config['cacheable']    = true;
        $config['imagedir']     = $dir;
        $config['quality']      = true;
        $config['size']         = '1024';
        $config['black']        = array(255,255,255);
        $config['white']        = array(255,255,255);
        $this->ciqrcode->initialize($config);
  
        /* QR Data  */
        $params['data']     = $data;
        $params['level']    = 'L';
        $params['size']     = 10;
        $params['savename'] = FCPATH.$config['imagedir']. $save_name;
        
        $this->ciqrcode->generate($params);

        /* Return Data */
        $return = array(
            'file'    => $dir. $save_name
        );
        return $return;
    }

    function add_specimen()
	{
        /* Generate QR Code */
       
        $qr   = $this->generate_qrcode($this->input->post('specimen_id'));
        $data = array(
            'specimen_id'=>$this->input->post('specimen_id'),
            'manifest_id'=>$this->input->post('manifest_id'),
            'name'=>$this->input->post('name'),
            'patient_number'=>$this->input->post('patient_number'),
            'transport_condition'=>$this->input->post('transport_condition'),
            'file'=> $qr['file'],
            'status'=>'pending_delivery'
        );

        /* Add Data */
        if($this->PickupRequest->insert_data($data)) {
            $this->modal_feedback('success', 'Success', 'Add Specimen Success', 'OK');
        } else {
            $this->modal_feedback('error', 'Error', 'Add Specimen Failed', 'Try again');
        }
        redirect('Manifest/');

    }

    function edit_data($id)
	{
        /* Old QR Data */
        $old_data = $this->PickupRequest->fetch_specimen($id);
        $old_file = $old_data['file'];

        /* Generate New QR Code */
       
        $qr   = $this->generate_qrcode($this->input->post('specimen_id'));
        $data = array(
            'specimen_id'=>$this->input->post('specimen_id'),
            'transport_condition'=>$this->input->post('transport_condition'),
            'file'=> $qr['file']
        );

        /* Edit Data */
        if($this->PickupRequest->update_data($id, $old_file, $data)) {
            $this->modal_feedback('success', 'Success', 'Edit Data Success', 'OK');
        } else {
            $this->modal_feedback('error', 'Error', 'Edit Data Failed', 'Try again');
        }
        redirect('Manifest/');
    }

    function remove_data($id)
	{
        /* Current QR Data */
        $qr_data = $this->PickupRequest->fetch_specimen($id);
        $qr_file = $qr_data['file'];

        /* Delete Data */
        if($this->PickupRequest->delete_data($id, $qr_file)) {
            $this->modal_feedback('success', 'Success', 'Delete Data Success', 'OK');
        } else {
            $this->modal_feedback('error', 'Error', 'Delete Data Failed', 'Try again');
        }
        redirect('Manifest/');
	}

    function done()
    {
        echo 'Where to Next ?';
    }
    
    function print_qr($id)
    {
        echo "printing $id";
    }

}

/* End of file Manifest.php */
