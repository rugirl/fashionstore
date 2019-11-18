<?php

/**
 * Class Clothes_model
 */
class Clothes_model extends CI_Model
{
	var $records_per_page = 10;
	var $start_from = 0;
	var $current_page_number = 1;

	/**
	 * @return mixed
	 * query to fetch all records
	 */
	public function make_query()
	{
		if(isset($_POST["rowCount"]))
		{
			$this->records_per_page = $_POST["rowCount"];
		}
		else
		{
			$this->records_per_page = 10;
		}
		if(isset($_POST["current"]))
		{
			$this->current_page_number = $_POST["current"];
		}
		$this->start_from = ($this->current_page_number - 1) * $this->records_per_page;
		$this->db->select('clothes.*, brands.name as brand_name')
			->from('clothes')
			->join('brands', 'brands.brand_id = clothes.brand_id');
		if($this->records_per_page != -1)
		{
			$this->db->limit($this->records_per_page, $this->start_from);
		}
		$query = $this->db->get();
		return $query->result_array();
	}

	/**
	 * @return mixed
	 */
	public function count_all_data()
	{
		$this->db->select('clothes.*, brands.name as brand_name')
			->from('clothes')
			->join('brands', 'brands.brand_id = clothes.brand_id');
		$query = $this->db->get();
		return $query->num_rows();
	}

	/**
	 * @param $data
	 */
	public function insert($data)
	{
		$this->db->insert('clothes', $data);
	}

	/**
	 * @param $id
	 * @return mixed
	 */
	public function fetch_single_data($id)
	{
		$this->db->select('clothes.*, brands.name as brand_name')
			->from('clothes')
			->join('brands', 'brands.brand_id = clothes.brand_id')
			->where('product_id', $id);
		$query = $this->db->get();
		return $query->result_array();
	}

	/**
	 * @param $data
	 * @param $id
	 */
	public function update($data, $id)
	{
		$this->db->where('product_id', $id);
		if($this->db->update('clothes', $data)){
			return;
		}
		else{
			return $this->db->error();
		}

	}

	/**
	 * @param $id
	 */
	public function delete($id)
	{
		$this->db->where('product_id', $id);
		if($this->db->delete('clothes')){
			return;
		}
		else{
			return $this->db->error();
		}
	}

	/**
	 * @param null $brand_id
	 * @return mixed
	 */
	public function getBrandName($brand_id = NULL){
		if(isset($brand_id)) {
			$this->db->where('brand_id', $brand_id);
		}
		$query = $this->db->get('brands');
		return $query->result_array();
	}
}
?>
