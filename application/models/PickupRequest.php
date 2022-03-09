<?php
class PickupRequest extends CI_Model
{
   function __construct()
   {
      parent::__construct();
   }



   function getSpecimenList($manifest_id)
   {
      $query = $this->db->get_where('specimens', array('manifest_id' => $manifest_id));
      return $query->result_array();
   }

   function getManifest($request_id)
   {
      $this->db->where('request_id', $request_id);
      $query = $this->db->get('pickup_requests');
      $row = $query->row_array();
      $manifest_id = $row['manifest_id'];
      $query1 = $this->db->get_where('specimens', array('manifest_id' => $manifest_id));

      return $query1->result_array();
   }

   function getRequestDetails($request_id)
   {
      $this->db->where('request_id',$request_id);
      $query = $this->db->get('pickup_requests');
      return $query->row_array();
   }
   
   function getRequests($user_id)
   {
      $this->db->where('user_id',$user_id);
      $query=$this->db->get('pickup_requests');
      return $query->result_array();
      
   }

   function getRequestId($manifest_id)
   {
      $this->db->where('manifest_id', $manifest_id);
      $query = $this->db->get('pickup_requests');
      $query = $query->row_array();
      return $query['request_id'];
      
   }

   function validate_specimen_pickup($qr_code)
   {
      $data = array(
         'status' => 'in_transit',
      );

      $this->db->where('specimen_id',(string) $qr_code);
      return $this->db->update('specimens', $data);
   }

   function fetch_specimen($id)
   {
      $this->db->where('specimen_id', $id);

      $query = $this->db->get('specimens');
      return $query->row_array();
   }

   function insert_data($data)
   {
      $this->db->insert('specimens', $data);
      return ($this->db->affected_rows());
   }



   /*
    |-------------------------------------------------------------------
    | Update Data
    |-------------------------------------------------------------------
    |
    | @param $id          ID Data
    | @param $old_file    Old QR Image File Path
    | @param $qr          Array New QR Data
    |
    */
   function update_data($id, $old_file, $data)
   {
      /* Delete Old QR Image from Directory */
      unlink($old_file);

      /* Update Data from Database */
      $this->db->trans_start();
      $this->db->where('specimen_id', $id);
      $this->db->update('specimens', $data);
      $this->db->trans_complete();

      return ($this->db->affected_rows() || $this->db->trans_status());
   }


   function save_request($manifest_id)
   {
      $data = array(
         'user_id' => $this->session->user_id,
         'manifest_id' => $manifest_id,
         'destination_facility' => $this->input->post('dest_facility'),
         'pickup_facility' => $this->input->post('pickup_facility'),
         'pickup_date_time' => $this->input->post('pickup_date_time'),
      );

      return $this->db->insert('pickup_requests', $data);
   }

   function delete_data($id, $qr_file)
   {
      /* Delete QR Code Image from Directory */
      unlink($qr_file);

      /* Delete QR Code from Database  */
      $this->db->where('specimen_id', $id);
      $this->db->delete('specimens');
      return ($this->db->affected_rows());
   }

   function getDestFacility($searchTerm = "")
   {

      // Fetch destination facilities
      $this->db->select('*');
      $this->db->where("fac_type", 'TEST');
      $this->db->where("fac_name like '%" . $searchTerm . "%' ");
      $fetched_records = $this->db->get('facilities');
      $users = $fetched_records->result_array();

      // Initialize Array with fetched data
      $data = array();
      foreach ($users as $user) {
         $data[] = array("id" => $user['fac_id'], "text" => $user['fac_name']);
      }
      return $data;
   }

   function getPickupFacility($searchTerm = "")
   {

      // Fetch pickup facilities
      $this->db->select('*');
      $this->db->where("fac_type", 'ISSUE');
      $this->db->where("fac_name like '%" . $searchTerm . "%' ");
      $fetched_records = $this->db->get('facilities');
      $users = $fetched_records->result_array();

      // Initialize Array with fetched data
      $data = array();
      foreach ($users as $user) {
         $data[] = array("id" => $user['fac_id'], "text" => $user['fac_name']);
      }
      return $data;
   }
}
