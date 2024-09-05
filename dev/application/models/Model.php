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
		$this->db->where('is_deleted','NOT_DELETED');
		return $this->db->get('products_category')->result();
	}

	public function units()
	{
		$this->db->order_by('name','asc');
		$this->db->where('is_deleted','NOT_DELETED');
		return $this->db->get('unit_master')->result();
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

	public function shops_inventory_row($id)
	{
		$this->db->select("mtb.*,
							pc.id as parent_cat_id,
							pc.name as category,
							psc.id as sub_cat_id,
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
		$this->db->where('mtb.id',$id);
		return $this->db->get()->row();
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

	public function appointments($user,$limit=null,$start=null)
	{
		$this->db->select("
					mtb.*,
					CONCAT(p.name,' ( ',p.code,' ) ') as patient_name,
					p.code as patient_code,
					p.mobile, p.gender, p.age, p.photo,
					city.name as city, s.name as state,
					p.pincode,p.address,
					CASE 
						WHEN p.marital_status = 1 THEN 'Married'
						WHEN p.marital_status = 2 THEN 'Unmarried'
						ELSE 'N/A'
					END as marital_status,
					CASE 
						WHEN mtb.appointment_type = 1 THEN 'Online'
						WHEN mtb.appointment_type = 2 THEN 'Face to Face'
						ELSE 'N/A'
					END as appointment_type,
					c.id as clinic_id, CONCAT(c.name,' ( ',c.code,' ) ') as clinic_name, 
					a_s.status as appointment_status
						")
		->from('appointments mtb')
		->join('patients p','p.id = mtb.patient_id','INNER')
		->join('clinics c','c.id = p.clinic_id','LEFT')
		->join('states s','s.id = p.state','left')
		->join('cities city','city.id = p.city','left')
		->join('appointment_status a_s','a_s.id = mtb.status','left')
		->where('p.active',1)
		->where('mtb.is_deleted','NOT_DELETED')
		->where('mtb.active',1)
		->where('p.is_deleted','NOT_DELETED')
		->where('c.is_deleted','NOT_DELETED');
		if ($user->user_role==8) {
			$this->db->having('p.clinic_id',$user->id);
		}
		else{
			if (@$_POST['clinic_id']) {
				$this->db->where('p.clinic_id',$_POST['clinic_id']);
			}
		}
		if(@$_POST['status']){
			$this->db->where('mtb.status',$_POST['status']);
		}
		if(@$_POST['state']){
			$this->db->where('p.state',$_POST['state']);
		}
		if(@$_POST['city']){
			$this->db->where('p.city',$_POST['city']);
		}
		if (@$_POST['name']) {
			$this->db->like('p.name',$_POST['name']);
			$this->db->or_like('p.mobile',$_POST['name']);
			$this->db->or_like('p.code',$_POST['name']);
		}

		if (@$_POST['appointment_date']) {
			$this->db->where('mtb.appointment_date',$_POST['appointment_date']);
		}
		else{
			$this->db->where('mtb.appointment_date >= ',date('Y-m-d'));
			// $this->db->where('mtb.appointment_date >= ','2023-02-02');
		}

		if ($limit!=null) {
			$this->db->limit($limit, $start);
		}
		$this->db->order_by('mtb.appointment_date','ASC');
		$this->db->order_by('mtb.appointment_start_time','ASC');
		return $this->db->get()->result();
	}

	public function appointment($id)
	{
		$this->db->select("
					mtb.*,
					CONCAT(p.name,' ( ',p.code,' ) ') as patient_name,
					p.code as patient_code,
					p.mobile, p.gender, p.age, p.photo,
					city.name as city, s.name as state,
					p.pincode,p.address,
					CASE 
						WHEN p.marital_status = 1 THEN 'Married'
						WHEN p.marital_status = 2 THEN 'Unmarried'
						ELSE 'N/A'
					END as marital_status,
					c.id as clinic_id, CONCAT(c.name,' ( ',c.code,' ) ') as clinic_name,
					a_s.status as appointment_status
						")
		->from('appointments mtb')
		->join('patients p','p.id = mtb.patient_id','INNER')
		->join('clinics c','c.id = p.clinic_id','LEFT')
		->join('states s','s.id = p.state','left')
		->join('cities city','city.id = p.city','left')
		->join('appointment_status a_s','a_s.id = mtb.status','left')
		->where('mtb.id',$id);
		return $this->db->get()->row();
	}

	public function appointment_medicines($appointment_id)
	{
		return $this->db->select("
					mtb.*,
					CONCAT(p.name,' ( ',p.unit_value,' ', u.name,' ) ') as medicine_name,
					si.qty as stock
					")
		->from('prescription mtb')
		->join('products_subcategory p','p.id = mtb.medicine_id','LEFT')	
		->join('unit_master u','u.id = p.unit_type_id','left')	
		->join('appointments app','app.id=mtb.appintment_id','left')
		->join('patients pa','pa.id = app.patient_id','INNER')
		->join('shops_inventory si','si.shop_id = pa.clinic_id AND si.product_id= mtb.medicine_id','LEFT')
		->where('appintment_id',$appointment_id)
		->get()->result();
	}

	public function appointment_transactions($appointment_id){
		return  $this->db->select("
					mtb.*,
					head.name as transaction_head,
					ps.status as payment_status
					")
		->from('transactions mtb')
		->join('transaction_heads head','head.id = mtb.transaction_head','LEFT')	
		// ->join('unit_master u','u.id = mtb.payment_mode','LEFT')	
		->join('payment_status_master ps','ps.id = mtb.payment_status','LEFT')
		->where('mtb.appointment_id',$appointment_id)
		->get()->result();
	}

	public function prescription_reports($user,$limit=null,$start=null)
	{
		$this->db->select("
						mtb.*,
						pa.name as patient_name, pa.code as patient_code, pa.mobile, pa.gender, pa.age,
						CONCAT(c.name,' ( ',c.code,' ) ') as clinic_name,
						a_s.status as appointment_status
							")
		->from('appointments mtb')
		->join('patients pa','pa.id = mtb.patient_id','INNER')
		->join('clinics c','c.id = pa.clinic_id','LEFT')
		->join('appointment_status a_s','a_s.id = mtb.status','left');
		if ($user->user_role==8) {
			$this->db->having('pa.clinic_id',$user->id);
		}
		else{
			if (@$_POST['clinic_id']) {
				$this->db->where('pa.clinic_id',$_POST['clinic_id']);
			}
		}
		if(@$_POST['status']){
			$this->db->where('mtb.status',$_POST['status']);
		}
		
		if (@$_POST['name']) {
			$this->db->like('pa.name',$_POST['name']);
			$this->db->or_like('pa.mobile',$_POST['name']);
			$this->db->or_like('pa.code',$_POST['name']);
		}
		if ($limit!=null) {
			$this->db->limit($limit, $start);
		}
		$this->db->order_by('mtb.id','DESC');
		$rows =$this->db->get()->result();
		// echo _prx($tmp_rows);
		// $rows = [];
		foreach ($rows as $key => $value) {
			$value->prescription = $this->db->select("
												mtb.*,
												CONCAT(p.name,' ( ',p.unit_value,' ', u.name,' ) ') as medicine_name
													")
								->from('prescription mtb')
								->join('products_subcategory p','p.id = mtb.medicine_id','LEFT')
								->join('unit_master u','u.id = p.unit_type_id','left')
								->where('mtb.appintment_id',$value->id)
								->get()->result();
			// $rows[] = $value;
		}

		// return $rows;
		return $rows;
	}

	function dashboard_content(){
		
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
