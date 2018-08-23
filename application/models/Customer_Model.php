<?php

Class Customer_Model extends CI_Model {

public function listCustomers() {

		$this->db->select('*');
		$this->db->from('customers');
		$this->db->order_by('Cust_CreatedDate', 'desc');
		$query = $this->db->get();
		$data=array();
		$data['result']=$query->result_array();
		return $data;

	}


public function getCustomers($id='') {
		$this->db->select('*');
		$this->db->from('customers');
		if(!empty($id))
		{
			$this->db->where('Cust_Id',$id);
		}
		$this->db->order_by('Cust_CreatedDate', 'desc');
		$query = $this->db->get();
		$data=array();
		$data['result']=$query->result_array();
		return $data;

	}


public function deleteCustomer($id) {


		$this->db->where('Cust_Id', $id);
		$this->db->delete('customers');
		if ($this->db->affected_rows() > 0) {
				return true;
				}
				return false;

	}


public function addCategory($data) {


	// Query to insert data in database
	$this->db->insert('category', $data);
	if ($this->db->affected_rows() > 0) {
	return true;
	}
	return false;

}

public function updateCustomer($id,$data) {


$this->db->where('Cust_Id', $id);
$this->db->update('customers', $data);

	if ($this->db->affected_rows() > 0) {
	return true;
	}
	return false;

}
	public function record_count() {
		$this->db->select('*');
		$this->db->from('customers');
		$query = $this->db->get();
        return $query->num_rows();;
    }

	 public function fetch_request($limit, $start) {

       $this->db->select('*');
		$this->db->from('customers');
		$this->db->order_by("Cust_CreatedDate", "desc");
		$this->db->limit($limit, $start);
		$query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }

}

?>