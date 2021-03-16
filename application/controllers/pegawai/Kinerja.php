<?php

class Kinerja extends CI_Controller{

    protected function is_loggedIn() {
        if (!isset($this->session->userdata['username'])){
            $this->session->set_flashdata('pesan','<div class="alert alert-warning alert-danger dismissible fade show" role="alert">
                Anda Belum Login!
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
                 </button>
                </div>');
            redirect('auth');
        }
    }

    protected function is_user() {
        if($this->session->userdata['level'] !== 'user'){
            $this->session->set_flashdata('pesan','<div class="alert alert-warning alert-danger dismissible fade show" role="alert">
                Anda tidak terdaftar sebagai user!
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
                 </button>
                </div>');
            redirect('auth');
        }
    }

	public function index()
	{
        /* check if truly a user */
        $this->is_loggedIn();
        $this->is_user();
        /* --------------------- */


        /* check if query doesn't return error & populate data*/
        $data = array();
		$data['title'] = "data kinerja";
        $kinerja = $this->kinerja_model->getNewKinerjaToday($this->session->userdata['uId'])->result();
        if (!$kinerja){
            $error = $this->db->error();
            $data['kinerja'] = null;
            $data['error'] = $error;
        } else {
            $data['error'] = null;
            $data['kinerja'] = $kinerja; 
        }
        /* --------------------- */

        /* load views */
		$this->load->view('template_pegawai/header');
		$this->load->view('template_pegawai/sidebar');
		$this->load->view('pegawai/kinerja',$data);
		$this->load->view('template_pegawai/footer');
        /* --------------------- */
	}

	public function input_form()
	{
        /* check if truly a user */
        $this->is_loggedIn();
        $this->is_user();
        /* --------------------- */

        $emp_name = $this->session->userdata['username'];
        $uid = $this->session->userdata['uId'];
        $jobRole = $this->JobRoleModel->getJobRole($this->session->userdata['uId'])->row();
        $jobList = array();
        $anyErrors = false;
        if(!$jobRole) {
            $anyErrors = true;
        } else {
            $jobList = $this->JobListModel->getJobList($jobRole->job_roleid)->result();
            if(!$jobList){
                $anyErrors = true;
            }
        }
		$data = array(
            'emp_name' => $emp_name,
            'uid' => $uid,
            'role_name' => (!$jobRole)?'error: no role':$jobRole->role_name,
            'role_id' => (!$jobRole)?'error: no role':$jobRole->job_roleid,
            'job_list'=> (!$jobList)?'error: no job list':$jobList,
			'job_date'  => set_value('job_date'),
            'job_start'  => set_value('job_start'),
            'job_end'  => set_value('job_end'),
            'anyErrors' => $anyErrors
		);
		$this->load->view('template_pegawai/header');
		$this->load->view('template_pegawai/sidebar');
		$this->load->view('pegawai/kinerja_form',$data);
		$this->load->view('template_pegawai/footer');
	}

	public function input_aksi()
	{
        /* check if truly a user */
        $this->is_loggedIn();
        $this->is_user();
        /* --------------------- */

        // rules loaded
		$this->_rules();

        // check if form not valid / return FALSE
		if($this->form_validation->run() == FALSE) {
			$this->input_form();
        }

        // form is valid
        else 
        {
            // assign form input values to variables
            $uid = $this->input->post('uid');
            $emp_name = $this->input->post('emp_name');
            $job_roleid = $this->input->post('job_roleid');
            $job_rolename = $this->input->post('job_rolename');
            $job_date = $this->input->post('job_date');
            $job_start = $this->input->post('job_start');
            $job_end = $this->input->post('job_end');
            $job_desc = $this->input->post('job_desc');
            $jobs= explode("|",$this->input->post('job'));
            $jobid = $jobs[0];
            $job= $jobs[1];


            // codeigniter's upload config
            $config['upload_path'] = './assets/upload/';
            $config['allowed_types'] = 'jpg|png';
            $config['max_size'] = 10000; 

            // initialize upload with predefined config
            $this->upload->initialize($config);

            // check if upload is successful
            if(!$this->upload->do_upload('documentation')) {
                $this->session->set_flashdata('pesan',
                    '<div 
                        class=" alert 
                                alert-warning 
                                alert-danger 
                                dismissible 
                                fade 
                                show
                                " 
                        role="alert">'.
                    $this->upload->display_errors().
                    '
                    <button 
                        type="button" 
                        class="close" 
                        data-dismiss="alert" 
                        aria-label="Close">
                    <span 
                        aria-hidden="true">
                    &times;
                    </span>
                    </button>
                    </div>');
                $this->input_form();
            }
            else {
                $documentation = $this->upload->data('file_name');
                $data = array(
                    'emp_name' => $emp_name,
                    'uid' => $uid,
                    'job_roleid' => $job_roleid,
                    'job_rolename' => $job_rolename,
                    'job_date' => $job_date,
                    'job_start' => $job_start,
                    'job_end' => $job_end,
                    'job' => $job,
                    'jobid' => $jobid,
                    'job_desc' => $job_desc,
                    'documentation' => $documentation,
                );
                $this->kinerja_model->postNewKinerja($data);
                $this->session->set_flashdata('pesan',
                    '<div 
                        class=" alert 
                                alert-success
                                dismissible 
                                fade 
                                show
                                " 
                        role="alert">
                    Kinerja Berhasil Diinput
                    <button 
                        type="button" 
                        class="close" 
                        data-dismiss="alert" 
                        aria-label="Close">
                    <span 
                        aria-hidden="true">
                    &times;
                    </span>
                    </button>
                    </div>');
                    redirect(base_URL('pegawai/kinerja'));
            }
		}
    }
	
	private function _rules()
	{
		$this->form_validation->set_rules('job_date','job_date','required',['required' => 'Tanggal Wajib Diisi']);
		$this->form_validation->set_rules('job_start','job_start','required',['required' => 'Waktu Awal Wajib Diisi']);
		$this->form_validation->set_rules('job_end','job_end','required',['required' => 'Waktu Akhir Wajib Diisi']);
        $this->form_validation->set_rules('job','job','required',['required' => 'Kegiatan Wajib Diisi']);
        $this->form_validation->set_rules('documentation','documentation','callback___file_selected_test');
	}

    public function __file_selected_test(){
        $this->form_validation->set_message('__file_selected_test','Dokumentasi Wajib Diisi');
        if(empty($_FILES['documentation']['name'])) {
            return false;
        } else {
            return true;
        }
    }

}
