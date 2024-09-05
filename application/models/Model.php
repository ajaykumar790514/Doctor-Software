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

		  // BY AJAY KUMAR
      /*
     *  Select Records From Table
     */
    public function Select($Table, $Fields = '*', $Where = 1)
    {
        /*
         *  Select Fields
         */
        if ($Fields != '*') {
            $this->db->select($Fields);
        }
        /*
         *  IF Found Any Condition
         */
        if ($Where != 1) {
            $this->db->where($Where);
        }
        /*
         * Select Table
         */
        $query = $this->db->get($Table);

        /*
         * Fetch Records
         */

        return $query->result();
    }
   /*
     * Count No Rows in Table
     */
    public function Counter($Table, $Where = 1)
    {
        $rows = $this->Select($Table, '*', $Where);

        return count($rows);
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
	
	public function getPatSMS($search,$clinic)
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
		if ($clinic!='' && $clinic !='0') {
			$this->db->where('mtb.clinic_id',$clinic);
		}
		if ($search!='') {
			$this->db->like('mtb.name',$search);
			$this->db->or_like('mtb.mobile',$search);
			$this->db->or_like('mtb.code',$search);
		}
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
						WHEN mtb.appointment_type = 3 THEN 'Medicine Only'
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
	public function clinic_vocation($limit=null,$start=null)
	{
		$this->db->select("a.*,b.name,b.code");
		$this->db->from('clinic_vocation a');
		$this->db->join('clinics b','a.clinic_id=b.id','left');
		$this->db->where(['b.is_deleted'=>'NOT_DELETED']);
		$this->db->order_by('a.date','DESC');
		if (@$_POST['clinic_id']) {
			$this->db->where('b.clinic_id',$_POST['clinic_id']);
		}
		if ($limit!=null) {
			$this->db->limit($limit, $start);
		}
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

 	function Savevideo($tb,$data){
		if($this->db->insert($tb,$data)){
			return $this->db->insert_id();
		}
		return false; 
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

	 	echo $this->db->last_query();die();
	 	return false;
	}
function Update_data($tb,$cond,$data) {
		$this->db->where('id',$cond);
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


public function getvideos($vedio,$limit=null,$start=null)
	{
		$this->db->select("a.*,b.name");
		$this->db->from('se_videos a');
		$this->db->join('se_video_category b','a.cat_id=b.id');
		$this->db->where('a.is_deleted','NOT_DELETED');
		$this->db->order_by('a.id','DESC');
		if (@$_POST['clinic_id']) {
			$this->db->like('a.cat_id',$_POST['clinic_id']);
		}
		if ($limit!=null) {
			$this->db->limit($limit, $start);
		}
		return $this->db->get()->result();
	}

	public function patient_report($user,$limit=null,$start=null)
	{
		$this->db->select("a.name as clinic_name,a.code as clinic_code,b.*,c.name as state_name,d.name as city_name");
		$this->db->from('clinics a');
		$this->db->join('patients b','a.id=b.clinic_id','left');
		$this->db->join('states c','c.id=b.state','left');
		$this->db->join('cities d','d.id=b.city','left');
		$this->db->where(['a.active'=>'1','a.is_deleted'=>'NOT_DELETED','b.is_deleted'=>'NOT_DELETED']);
		$this->db->order_by('b.added','DESC');
			if (@$_POST['clinic_id']) {
				$this->db->where('a.id',$_POST['clinic_id']);
			}
		
		
		if (@$_POST['name']) {
			$this->db->like('b.name',$_POST['name']);
			$this->db->or_like('b.mobile',$_POST['name']);
			$this->db->or_like('b.code',$_POST['name']);
		}
		if ($limit!=null) {
			$this->db->limit($limit, $start);
		}
		return $this->db->get()->result();
	}
	
	public function patient_report_excel($clinic_id,$search)
	{
		$this->db->select("a.name as clinic_name,a.code as clinic_code,b.*,c.name as state_name,d.name as city_name");
		$this->db->from('clinics a');
		$this->db->join('patients b','a.id=b.clinic_id','left');
		$this->db->join('states c','c.id=b.state','left');
		$this->db->join('cities d','d.id=b.city','left');
		$this->db->where(['a.active'=>'1','a.is_deleted'=>'NOT_DELETED','b.is_deleted'=>'NOT_DELETED']);
		$this->db->order_by('b.added','DESC');
			if (@$clinic_id && $clinic_id!='0') {
				$this->db->where('a.id',$clinic_id);
			}
		
		
		if (@$search) {
			$this->db->like('b.name',$search);
			$this->db->or_like('b.mobile',$search);
			$this->db->or_like('b.code',$search);
		}
		return $this->db->get()->result();
	}
	

        public function getvideocategory($user,$limit=null,$start=null)
	{
		$this->db->select("mtb.*");
		$this->db->from('se_video_category mtb');
		$this->db->where('mtb.is_deleted','NOT_DELETED');
		$this->db->order_by('mtb.id','DESC');
		return $this->db->get()->result();
	}
	

	public function sms_master($limit=null,$start=null)
	{
		$this->db->select("a.*");
		$this->db->from('sms_master a');
		$this->db->where('a.is_static','1');
		$this->db->order_by('a.id','DESC');
		if ($limit!=null) {
			$this->db->limit($limit, $start);
		}
		return $this->db->get()->result();
	}
	public function getPatReminder()
	{
		$this->db->select("p.*,a.appointment_date");
		$this->db->from('patients p');
		$this->db->join('appointments a', 'a.patient_id = p.id', 'left');
		$this->db->where('p.is_deleted', 'NOT_DELETED');
		$this->db->where("(DATE(a.appointment_date) = CURDATE() OR DATE(a.appointment_date) = DATE_ADD(CURDATE(), INTERVAL 1 DAY))");
		return $this->db->get()->result();
	}
	
	public function treatment_master($user,$search,$limit=null,$start=null)
    {
        if ($limit!=null) {
            $this->db->limit($limit, $start);
        }
        $this->db
        ->from('treatment_master c')
		->select('c.*,v.name as clinic_name,v.code as clinic_code,t.img as photos')
		->join('clinics v', 'v.id = c.clinic_id', 'left')
		->join('treatment_photo t', 't.item_id = c.id', 'left')
		->where(['c.is_deleted'=>'NOT_DELETED','t.is_cover'=>'1','c.clinic_id' => $user])
		->order_by('c.added','desc');				
		if (@$_POST['search']) {
			$data['search'] = $_POST['search'];
			$this->db->group_start();
			$this->db->like('c.title',$_POST['search']);
			$this->db->group_end();
		}
        if($limit!=null)
            return $this->db->get()->result();
        else
		return $this->db->get()->result();
    }
	
    public function treatment_img_upload($id)
    {
        $imageCount = count($_FILES['img']['name']);
        if (!empty($imageCount)) {
            for ($i = 0; $i < $imageCount; $i++) {
                $config['file_name'] = date('Ymd') . rand(1000, 1000000);
                $config['upload_path'] = UPLOAD_PATH.'treatment/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|xlsx|xls|csv';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $_FILES['imgs']['name'] = $_FILES['img']['name'][$i];
                $_FILES['imgs']['type'] = $_FILES['img']['type'][$i];
                $_FILES['imgs']['tmp_name'] = $_FILES['img']['tmp_name'][$i];
                $_FILES['imgs']['size'] = $_FILES['img']['size'][$i];
                $_FILES['imgs']['error'] = $_FILES['img']['error'][$i];

                if ($this->upload->do_upload('imgs')) {
                    $imageData = $this->upload->data();
                    $images[] = "treatment/" . $imageData['file_name'];
                }
            }
        }

        if ($images != '') {            
            foreach ($images as $file) {
                $file_data = array(
                    'img' => $file,
                    'item_id' => $id
                );
                $this->db->insert('treatment_photo', $file_data);
            }
            $cover_image = $images[0];
            $cover_image_data = array(
                    'is_cover' => 1
                );
              $query=  $this->db->where('img', $cover_image)->update('treatment_photo', $cover_image_data);
        }


    }


	public function treatment_img($id)
	{
		return $this->db->get_where('treatment_photo',['item_id'=>$id])->result();
	}
	public function delete_treatment_image($id){
        $data1['prod_images'] = $this->model->getRow('treatment_photo',['id'=>$id]);
        $prod_image = @ltrim($data1['prod_images']->img, '/');
        $prod_thumb = @ltrim($data1['prod_images']->thumbnail, '/');
        if(is_file(DELETE_PATH.$prod_image))
        {
            unlink(DELETE_PATH.$prod_image);
        }
        if(is_file(DELETE_PATH.$prod_thumb))
        {
            unlink(DELETE_PATH.$prod_thumb);
        }
		return $this->db->where('id', $id)->delete('treatment_photo');
	}
	public function remove_treatment_cover($p1){
        $change_cover = array('is_cover' => '0');
        return $this->db->where('item_id', $p1)->update('treatment_photo', $change_cover);
	}
	public function make_treatment_cover($id){
        $is_cover = array('is_cover' => '1');
		return $this->db->where('id', $id)->update('treatment_photo', $is_cover);
	}
	public function update_prod_seq($id,$data){
		return $this->db->where('id', $id)->update('treatment_photo',$data);
	}
	public function getTreatmentDetail($id)
	{
		$this->db->select("t1.*,t2.img as photos");
		$this->db->from('treatment_master t1');
		$this->db->join('treatment_photo t2','t1.id=t2.item_id','left');
		$this->db->where(['t1.is_deleted'=>'NOT_DELETED','t2.is_cover'=>'1','t1.id'=>$id]);
		return $this->db->get()->row();
	}

	public function Update_treatment($data,$id)
    {
        $imageCount = count($_FILES['img']['name']);
        if (!empty($imageCount)) {
            
            for ($i = 0; $i < $imageCount; $i++) {
                
                $config['file_name'] = date('Ymd') . rand(1000, 1000000);
                $config['upload_path'] = UPLOAD_PATH.'treatment/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif|webp|svg';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $_FILES['imgs']['name'] = $_FILES['img']['name'][$i];
                $_FILES['imgs']['type'] = $_FILES['img']['type'][$i];
                $_FILES['imgs']['tmp_name'] = $_FILES['img']['tmp_name'][$i];
                $_FILES['imgs']['size'] = $_FILES['img']['size'][$i];
                $_FILES['imgs']['error'] = $_FILES['img']['error'][$i];
                if ($this->upload->do_upload('imgs')) {
                 
                    $imageData = $this->upload->data();
                     if($_FILES['imgs']['type']=='image/webp')
                        {
                                $img =  imagecreatefromwebp(UPLOAD_PATH.'treatment/'. $imageData['file_name']);

                                imagewebp($img, UPLOAD_PATH.'treatment/thumbnail/'. $imageData['file_name'],80);
                                imagedestroy($img);
                        }
                        else
                        {
                            $config2 = array(
                                'image_library' => 'gd2', //get original image
                                'source_image' =>   UPLOAD_PATH.'treatment/'. $imageData['file_name'],
                                'width' => 640,
                                'height' => 360,
                                'new_image' =>  UPLOAD_PATH.'treatment/thumbnail/'. $imageData['file_name'],
                            );
                            $this->load->library('image_lib');
                            $this->image_lib->initialize($config2);
                            $this->image_lib->resize();
                            $this->image_lib->clear();
                        }

                    $images[] = "treatment/" . $imageData['file_name'];
                    $images2[] = "treatment/thumbnail/" . $imageData['file_name'];
                }
            }
        }
        if (!empty($images))
        {     
           $insert_id = $this->model->Update('treatment_master', $data,['id'=>$id]);
		   $this->db->where(['item_id' =>$id])->delete('treatment_photo');
            foreach (array_combine($images, $images2) as $file => $file2) {
                    $file_data = array(
                        'img' => $file,
                        'thumbnail' => $file2,
                        'item_id' => $id
                    );
                    $this->db->insert('treatment_photo', $file_data);
                }
            $cover_image = $images[0];
            $cover_image_data = array(
                    'is_cover' => 1
                );
              $query=  $this->db->where('img', $cover_image)->update('treatment_photo', $cover_image_data);

        }else{
          $insert_id =  $this->model->Update('treatment_master', $data,['id'=>$id]);
		}
        if ($insert_id) {
            return $insert_id;
        } else {
            return false;
        }
    }
	public function filter_data($user,$search)
	{
		$this->db
		->select('t1.*')
		->from('patients t1')
		->where(['t1.is_deleted' => 'NOT_DELETED','t1.clinic_id'=>$user]) ;     
		$this->db->group_start();
		$this->db->like('t1.name' ,$search)
		->or_like('t1.code' ,$search)
		->or_like('t1.mobile' ,$search);
		$this->db->group_end();
	
		return $this->db->get()->result_array();
	}
	function getRowPat($tb, $data = array(), $returnType = '') {
		if (empty($data)) {
			$result = $this->db->get($tb)->row();
		} elseif (is_array($data)) {
			$result = $this->db->get_where($tb, $data)->row();
		} else {
			$result = $this->db->get_where($tb, array('id' => $data))->row();
		}
	
		if ($returnType == 'count') {
			return ($result) ? 1 : 0; // Count rows instead of accessing the 'count' property
		} else {
			return $result;
		}
	}
	
	
	

}
