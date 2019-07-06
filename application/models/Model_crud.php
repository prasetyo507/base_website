<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_crud extends CI_Model {


	function getDetail($tbl, $field, $id)
	{
		return $this->db->where($field, $id)->get($tbl);
	}

	function getData($tbl,$key,$sort)
	{
		return $this->db->order_by($key, $sort)->get($tbl)->result();
	}

	function insertData($tbl,$data)
	{
		$this->db->insert($tbl, $data);
	}
	
	function delData($tbl,$field,$key)
	{
		$this->db->where($field, $key);
		$hasil = $this->db->delete($tbl);
		return $hasil;
	}

	function updateData($tbl,$field,$key,$data)
	{
		$this->db->where($field, $key);
		$hasil=$this->db->update($tbl, $data);
	}

	function updateDataStok($tbl,$field1,$key1,$field2,$key2,$data)
	{
		$this->db->where($field1, $key1);
		$this->db->where($field2, $key2);
		$hasil=$this->db->update($tbl, $data);
	}

	function updateMoreWhere($tbl,$arrField,$data)
	{
		$num = count($arrField);
		for ($i = 0; $i < $num; $i++) {
			$this->db->where(array_keys($arrField)[$i], array_values($arrField)[$i]);
		}
		$this->db->update($tbl, $data);
	}

	function getMoreWhere($tbl,$arr)
	{
		$num = count($arr);

		for ($i = 0; $i < $num; $i++) {

			$this->db->where(array_keys($arr)[$i], array_values($arr)[$i]);	
		}
		return $this->db->get($tbl);
	}

}
/* End of file Crud_model.php */
/* Location: ./application/models/Crud_model.php */