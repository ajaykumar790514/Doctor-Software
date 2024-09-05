<?php
/**
 * 
 */
class Model extends CI_Model
{
	
	public function admin_menus($parent_menu=00)
	{
		$this->db->order_by('indexing','asc');
		if ($parent_menu!=00) {
			$this->db->where('parent',$parent_menu);
		}
		return $this->db->get('tb_admin_menu')->result();
	}

	public function categories($parent_menu=00)
	{
		$this->db->order_by('order','asc');
		if ($parent_menu!=00) {
			$this->db->where('is_parent',$parent_menu);
		}
		return $this->db->get('products_category')->result();
	}

	public function products($limit=null,$start=null)
	{
		$this->db->select("mtb.*,
							pc.name as category,
							psc.name as sub_category,
							CONCAT(mtb.name,' ( ',mtb.unit_value,' ', u.name,' ) ') as name
							");
		$this->db->from('products_subcategory mtb');
		$this->db->join('products_category pc','pc.id = mtb.parent_cat_id','left');
		$this->db->join('products_category psc','psc.id = mtb.sub_cat_id','left');
		$this->db->join('unit_master u','u.id = mtb.unit_type_id','left');
		$this->db->where('mtb.is_deleted','NOT_DELETED');
		if (@$_POST['parent_cat_id']) {
			$this->db->where('mtb.parent_cat_id',$_POST['parent_cat_id']);
		}
		if (@$_POST['sub_cat_id']) {
			$this->db->where('mtb.sub_cat_id',$_POST['sub_cat_id']);
		}
		if (@$_POST['name']) {
			$this->db->like('mtb.name',$_POST['name']);
			$this->db->or_like('mtb.description',$_POST['name']);
		}
		if ($limit!=null) {
			$this->db->limit($limit, $start);
		}
		return $this->db->get()->result();
	}

	public function shops_inventory($user,$limit=null,$start=null)
	{
		$this->db->select("mtb.*,
							pc.name as category,
							psc.name as sub_category,
							CONCAT(p.name,' ( ',p.unit_value,' ', u.name,' ) ') as name,
							CONCAT(c.name,' ( ',c.code,' ) ') as clinic
							");
		$this->db->from('shops_inventory mtb');
		$this->db->join('products_subcategory p','p.id = mtb.product_id','INNER');
		$this->db->join('products_category pc','pc.id = p.parent_cat_id','left');
		$this->db->join('products_category psc','psc.id = p.sub_cat_id','left');
		$this->db->join('unit_master u','u.id = p.unit_type_id','left');
		$this->db->join('clinics c','c.id = mtb.shop_id','left');
		$this->db->where('mtb.is_deleted','NOT_DELETED');
		$this->db->where('p.is_deleted','NOT_DELETED');
		
		
		if (@$_POST['name']) {
			$this->db->like('p.name',$_POST['name'],'after');
			// $this->db->or_like('p.description',$_POST['name']);
		}
		if (@$_POST['parent_cat_id']) {
			$this->db->where('p.parent_cat_id',$_POST['parent_cat_id']);
		}
		if (@$_POST['sub_cat_id']) {
			$this->db->where('p.sub_cat_id',$_POST['sub_cat_id']);
		}
		if ($user->user_role==8) {
			$this->db->having('mtb.shop_id',$user->id);
		}
		else{
			if (@$_POST['clinic_id']) {
				$this->db->where('mtb.shop_id',$_POST['clinic_id']);
			}
		}
		if ($limit!=null) {
			$this->db->limit($limit, $start);
		}
		return $this->db->get()->result();
	}

	public function clinics()
	{
		$this->db->select("mtb.*,
							s.name as state_name,
							c.name as city_name");
		$this->db->from('clinics mtb');
		$this->db->join('states s','s.id = mtb.state','left');
		$this->db->join('cities c','c.id = mtb.city','left');
		$this->db->where('mtb.is_deleted','NOT_DELETED');
		$this->db->order_by('mtb.user_role','ASC');
		$this->db->order_by('mtb.id','ASC');
		return $this->db->get()->result();
	}

	public function patients($user,$limit=null,$start=null)
	{
		$this->db->select("mtb.*,
							s.name as state_name,
							c.name as city_name,
							CONCAT(cl.name,' ( ',cl.code,' ) ') as clinic_name");
		$this->db->from('patients mtb');
		$this->db->join('states s','s.id = mtb.state','left');
		$this->db->join('cities c','c.id = mtb.city','left');
		$this->db->join('clinics cl','cl.id = mtb.clinic_id','left');
		$this->db->where('mtb.is_deleted','NOT_DELETED');
		if ($user->user_role==8) {
			$this->db->where('mtb.clinic_id',$user->id);
		}
		if (@$_POST['clinic_id']) {
			$this->db->where('mtb.clinic_id',$_POST['clinic_id']);
		}
		if (@$_POST['name']) {
			$this->db->like('mtb.name',$_POST['name']);
			$this->db->or_like('mtb.mobile',$_POST['name']);
			$this->db->or_like('mtb.code',$_POST['name']);
		}
		if ($limit!=null) {
			$this->db->limit($limit, $start);
		}
		$this->db->order_by('mtb.id','DESC');
		return $this->db->get()->result();
	}

	public function timings($clinic_id)
	{
		$timings = [];
		$result = $this->db->get_where('clinic_timings',['clinic_id'=>$clinic_id])->result();
		if (@$result) {
			foreach ($result as $key => $value) {
				$timings[$value->day] = $value;
			}
		}
		return $timings;		
	}


	public function total_app_users()
	{
		return $this->db->get('users')->num_rows();
	}






	// main functions

 	function Save($tb,$data){
		if($this->db->insert($tb,$data)){
			return $this->db->insert_id();
		}
		return false; 
	}

	function SaveGetId($tb,$data){
	 	if($this->db->insert($tb,$data)){
	 		return $this->db->insert_id();
	 	}
	 	return false;
	}



	function getData($tb,$data=0,$order=null,$order_by=null,$limit=null,$start=null) {

		if ($order!=null) {
			if ($order_by!=null) {
				$this->db->order_by($order_by,$order);
			}
			else{
				$this->db->order_by('id',$order);
			}
		}

		if ($limit!=null) {
			$this->db->limit($limit, $start);
		}

		if ($data==0 or $data==null) {
			return $this->db->get($tb)->result();
		}
		if (@$data['search']) {
			$search = $data['search'];
			unset($data['search']);
		}
		return $this->db->get_where($tb,$data)->result();
	}



	function getRow($tb,$data=0) {
		if ($data==0) {
			if($data=$this->db->get($tb)->row()){
				return $data;
			}
			else {
				return false;
			}
		}
		elseif(is_array($data)) {
			if($data=$this->db->get_where($tb, $data)){
				return $data->row();
			}
			else {
				return false;
			}
		}
		else {
			if($data=$this->db->get_where($tb,array('id'=>$data))){
				return $data->row();
			}
			else {
				return false;
			}
		}
	}

	function Update($tb,$data,$cond) {
		$this->db->where($cond);
	 	if($this->db->update($tb,$data)) {
	 		return true;
	 	}
	 	return false;
	}



	function Delete($tb,$data) {
		if (is_array($data)){
			$this->db->where($data);
			if($this->db->delete($tb)){
				return true;
			}
		}
		else{
			$this->db->where('id',$data);
			if($this->db->delete($tb)){
				return true;
			}
		}
		return false;
	}

	function _delete($tb,$data) {
		if (is_array($data)){
			$this->db->where($data);
			if($this->db->update($tb,['is_deleted'=>'DELETED'])){
				return true;
			}
		}
		else{
			$this->db->where('id',$data);
			if($this->db->update($tb,['is_deleted'=>'DELETED'])){
				return true;
			}
		}
		return false;
	}
	// main functions

	



}
