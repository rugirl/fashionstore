<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Clothes
 */
Class Clothes extends CI_Controller
{
	/**
	 * Clothes constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('clothes_model');
	}

	/**
	 * default path of clothes
	 */
	public function index()
	{
		if ($this->session->userdata('username')) {
			$this->showListing();
		} else {
			redirect('admin/login');
		}
	}

	/**
	 * show listing page
	 * loads create view as modal
	 */
	public function showListing()
	{
		$brandList = $this->clothes_model->getBrandName();
		$data['brands'] = array();
		foreach ($brandList as $row) {
			$data['brands'][$row['brand_id']] = $row['name'];
		}
		$data['create_clothes'] = $this->load->view('create_clothes', $data, TRUE);
		$this->load->view('listing', $data);
	}

	/**
	 * creating new cloth items
	 */
	public function create()
	{
		$this->load->view('create_clothes');
	}

	/**
	 * getting cloth data
	 */
	public function fetch_data()
	{
		$data = $this->clothes_model->make_query();
		$array = array();
		foreach ($data as $row) {
			$array[] = $row;
		}
		$output = array(
			'current' => intval($_POST["current"]),
			'rowCount' => 10,
			'total' => intval($this->clothes_model->count_all_data()),
			'rows' => $array
		);
		echo json_encode($output);
	}

	/**
	 * handles create, edit, delete
	 */
	public function action()
	{
		if ($this->input->post('operation')) {
			$sellingPrice = $this->calcSellingPrice($this->input->post('brand_id'), $this->input->post('cost'));

			$data = array(
				'name' => $this->input->post('name'),
				'product_code' => $this->input->post('product_code'),
				'short_description' => $this->input->post('short_description'),
				'cost' => $this->input->post('cost'),
				'selling_price' => $sellingPrice,
				'brand_id' => $this->input->post('brand_id'),
				'color' => $this->input->post('color'),
				'size' => $this->input->post('size')
			);
			if ($this->input->post('operation') == 'Add') {
				$this->clothes_model->insert($data);
				echo 'New Cloth Item created';
			}
			if ($this->input->post('operation') == 'Edit') {
				$this->clothes_model->update($data, $this->input->post('product_id'));
				echo 'Changes are updated';
			}
		}
	}

	/**
	 * fetching single rows
	 */
	public function fetch_single_data()
	{
		if ($this->input->post('id')) {
			$data = $this->clothes_model->fetch_single_data($this->input->post('id'));
			foreach ($data as $row) {
				$output['name'] = $row['name'];
				$output['product_code'] = $row['product_code'];
				$output['short_description'] = $row['short_description'];
				$output['cost'] = $row['cost'];
				$output['selling_price'] = $row['selling_price'];
				$output['brand_id'] = $row['brand_id'];
				$output['brand_name'] = $row['brand_name'];
				$output['color'] = $row['color'];
				$output['size'] = $row['size'];
			}
			echo json_encode($output);
		}
	}

	/**
	 * deleting cloth items
	 */
	function delete_data()
	{
		if ($this->input->post('id')) {
			$this->clothes_model->delete($this->input->post('id'));
			echo 'Cloth Item Deleted';
		}
	}

	/**
	 * @param $brand_id
	 * @param $cost
	 * @return string
	 */
	public function calcSellingPrice($brand_id, $cost)
	{
		$data = $this->clothes_model->getBrandName($brand_id);
		foreach ($data as $row) {
			switch (strtolower(trim($row['name']))) {
				case 'adidas':
					$add = number_format($cost * 15 / 100, 2);
					break;
				case 'nike':
					$add = number_format($cost * 15 / 100, 2);
					$add = number_format($add + 100, 2);
					break;
				default:
					$add = $cost * 10 / 100;
			}
			$selling_price = number_format($cost + $add, 2);
			return $selling_price;
		}
	}

}
