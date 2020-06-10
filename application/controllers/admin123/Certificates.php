<?php
class Certificates extends Admin_Controller{
	public $_table_names = 'certificates';		//set table name
	public $_subView = 'admin/certificates/';	//set subview load 
	public $_redirect = '/certificates';			//set link with controller file name

	public function __construct(){
		parent::__construct();
 		$this->checkPermissions('program_manage');//permission
		//set left menu active on admin dashboard
		$this->data['active'] = 'Certificates';

        $this->data['_cancel'] = $this->data['admin_link'].$this->_redirect;
        $this->data['_add'] = $this->data['admin_link'].$this->_redirect.'/create';
        $this->data['_edit'] = $this->data['admin_link'].$this->_redirect.'/edit';
        $this->data['_delete'] = $this->data['admin_link'].$this->_redirect.'/delete';
        $this->perPage = 20;
	}
    
    public function index(){
		//set title
		$this->data['name'] = 'Certificates';
		$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

		//set lead view		
        $this->data['subview'] = $this->_subView.'index';	
		$this->load->view('admin/_layout_main',$this->data);
	}

	function ajax_get_list(){
		if (!$this->input->is_ajax_request()) {//only call in ajax
		//	exit('No direct script access allowed');
		}
		$output = array();
		$output['result']= 'error';
		$this->data['total'] = $output['total'] = 0;

		//$msg = 0;
		$url = $this->data['_cancel'].'/ajax_get_list?';
		$where_clause = '';
        $name = $this->input->get('q');
        $g_s_date = $this->input->get('s_date');
        $g_e_date = $this->input->get('e_date');
		
		$this->data['list_data'] = $this->perPage;
		
		if($g_s_date){
			$where_clause .= 'on_date >= (\''.h_dateFormat($g_s_date,'Y-m-d').'\') and';
			$url .= 's_date='.$g_s_date.'&';
		}

		if($g_e_date){
			$where_clause .= ' on_date <= (\''.h_dateFormat($g_e_date,'Y-m-d').'\') and';
			$url .= 's_date='.$g_e_date.'&';
		}		
		if($name){
			$url .= 'q='.$name.'&';
			$where_clause .= " (first_name like '%".$this->input->get('q')."%' or last_name like '%".$this->input->get('q')."%') and";
		}
		else{			
			$url .= 'q=&';
		}
		
        $page = $this->input->get('page');
        if(!$page){
			$this->data['page_number'] =1;
            $offset = 0;
        }else{
			$offset = $page*$this->perPage-$this->perPage;
			//$offset = $page*2-2;
			$this->data['page_number'] = $page;
        }


		$sort_by = ' ORDER BY id desc ';
		
		$output['result']= 'ok';
		$stringQuery = "SELECT * From ".$this->_table_names;	

		$where_clause = rtrim($where_clause,'and');
		
		if($where_clause){
			//	echo $stringQuery." ORDER BY job_id desc limit $offset, ".$this->perPage;
			$this->data['all_data'] = $this->comman_model->get_query($stringQuery." where ".$where_clause." ".$sort_by." limit $offset, ".$this->perPage,false);
		}
		else{
			//	echo $stringQuery." ORDER BY job_id desc limit $offset, ".$this->perPage;
			$this->data['all_data'] = $this->comman_model->get_query($stringQuery." ".$sort_by." limit $offset, ".$this->perPage,false);
		}
		//echo $this->db->last_query();die;

		$output['html'] = $this->load->view($this->_subView.'ajax_list',$this->data,true);
		if(empty($output['html'])){
			$output['html'] ='';
		}
		$output['url']= $url;
		if($where_clause){
			$this->data['total'] = $output['total'] = print_count_query($stringQuery." where ".$where_clause."  ".$sort_by." ");
		}
		else{
			$this->data['total'] = $output['total'] = print_count_query($stringQuery." ".$sort_by." ");
		}
		echo json_encode($output);
		//echo $msg;	
	}

	public function create(){
		
		$rules = array(
        		'first_name' 	=> array('field'=>'first_name', 'label'=>'Name', 'rules'=>'trim'),
			   );

    
	    $this->form_validation->set_rules($rules);

        // Process the form
        if($this->form_validation->run() == TRUE){
            $data 	= array();
//			$post1 =array('certificate_no','first_name','last_name','company_name','email','address','city','state','country','zip','phone','phone_2','website','gps');
			$post1 =array('first_name','last_name','employer','address','city','state','zip','gps');
        	$data = $this->comman_model->array_from_post($post1);

			$data['admin_id'] 		= $this->data['admin_details']->id;
			$data['created_by'] 	= 'admin';
			$data['confirm'] 		= 1;
			$data['on_date'] 		= date('Y-m-d H:i:s');


			$id = $this->comman_model->save($this->_table_names,$data);
			$this->session->set_flashdata('success','Data has successfully created.');
			redirect($this->data['_cancel']);
			die;
        }

	    $this->data['name'] = 'Create';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
    	$this->data['subview'] = $this->_subView.'create';
       	$this->load->view('admin/_layout_main',$this->data);
	}
	
	public function edit($id=false){
		if(!$id){
			redirect($this->data['_cancel']);
		}

		$form_data = $this->data['form_data']= $this->comman_model->get_by($this->_table_names,array('id'=>$id),false,true);
		if(!$this->data['form_data'])
			redirect($this->data['_cancel']);
		
		$rules = array(
	        		'first_name' 	=> array('field'=>'first_name', 'label'=>'Name', 'rules'=>'trim|required'),
			   );

    
	    $this->form_validation->set_rules($rules);

        // Process the form
        if($this->form_validation->run() == TRUE){
            $data 	= array();
//			$post1 =array('certificate_no','first_name','last_name','company_name','email','address','city','state','country','zip','phone','phone_2','website','gps');
			$post1 =array('first_name','last_name','employer','address','city','state','zip','gps');
        	$data = $this->comman_model->array_from_post($post1);

			$this->comman_model->save($this->_table_names,$data,$id);
			$this->session->set_flashdata('success','Data has successfully updated.');
			redirect($this->data['_cancel']);
        }

	    $this->data['name'] = 'Edit';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
    	$this->data['subview'] = $this->_subView.'edit';
       	$this->load->view('admin/_layout_main',$this->data);
	}
	
	
	public function view($id=false){
		if(!$id){
			redirect($this->data['_cancel']);
		}
	    $this->data['name'] = 'View';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

		$view_data = $this->data['view_data']= $this->comman_model->get_by($this->_table_names,array('id'=>$id),false,true);
		if(!$this->data['view_data'])
			redirect($this->data['_cancel']);

    	$this->data['subview'] = $this->_subView.'view';	
       	$this->load->view('admin/_layout_main',$this->data);
	}
	


	function delete($id = false){
		if($this->data['admin_details']->default=='0'){
            $this->session->set_flashdata('error','Sorry ! You have no permission.');
	        redirect($this->data['_cancel']);
		}
		if(!$id){
			redirect($this->data['_cancel']);
		}

		$this->db->delete($this->_table_names,array('id'=>$id));

		$this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],297)); 
		redirect($this->data['_cancel']);		

	}


  	function checkPermissions($type= false,$is_redirect=false){
		$redirect = 0;
		if($this->data['admin_details']->default=='0'){
			$redirect = checkPermission('admin_permission',array('user_id'=>$this->data['admin_details']->id,'type'=>$type,'value'=>1));	
		}
		else{
			$redirect = 1;
		}
		
		if($redirect==0){
            $this->session->set_flashdata('error','Sorry ! You have no permission.');
			if($redirect){
				redirect($redirect);
			}
			redirect($this->data['admin_link'].'');
		}		
	}
}