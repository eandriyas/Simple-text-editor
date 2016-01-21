<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Text extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct(){
		parent::__construct();
		$this->load->model('image');
	}
	public function index()
	{
		$data['posts'] = $this->image->get_with_post();

		$this->load->view('home', $data);
	}
	public function editor(){
		$this->load->view('text/editor');
	}
	public function modal(){
		$data['images'] = $this->image->get_all_image(12);

		$this->load->view('text/modal_image');
	}
	public function get_image(){
		$data = $this->image->get_all_image(12);
		echo json_encode($data);
	}
	public function get_one_image($id){
		$data = $this->image->get_one($id);
		echo json_encode($data);
	}
	public function upload(){
		$name_array = [];
		$mk_dir = './assets/uploads/image/'.date('Y'.'/'.date('m').'/'.date('d'));
		
		if(file_exists($mk_dir)){
			$dir = $mk_dir;

		} else {
			mkdir($mk_dir, 0755, true);
			$dir=$mk_dir;
		}
		if(!empty($_FILES)){
			$count = count($_FILES['userfile']['size']);
				foreach ($_FILES as $key => $value) {
					for($s=0; $s<=$count-1; $s++){
	                    $_FILES['userfile']['name']=$value['name'][$s];
	                    $_FILES['userfile']['type']    = $value['type'][$s];
	                    $_FILES['userfile']['tmp_name'] = $value['tmp_name'][$s];
	                    $_FILES['userfile']['error']       = $value['error'][$s];
	                    $_FILES['userfile']['size']    = $value['size'][$s];


	                    $config['upload_path'] = './assets/uploads/image/'.date('Y'.'/'.date('m').'/'.date('d'));
	                    $config['allowed_types'] = 'gif|jpg|png';
	                    // $config['max_size']	= '100';
	                    // $config['max_width']  = '1024';
	                    // $config['max_height']  = '768';
	                    $this->load->library('upload', $config);
	                    $this->upload->do_upload();
	                    $data = $this->upload->data();
	                    $name_array[] = $data['file_name'];
					}
				}
				$names = implode(',', $name_array);
				$dire= base_url('assets/uploads/image/').'/'.date('Y'.'/'.date('m').'/'.date('d'));
		
				$data = array(
					'title' => $names ,
					'url' => $dire.'/'.$names
					);
				$this->image->add_image($data);
				$id = $this->db->insert_id();

				$data_image = $this->image->get_image($id);

				// echo "<div>
				// <input type='checkbox' class='checkbox' value='".$data_image->url."' />
				// <img style='max-width:100px;' src='".$data_image->url."'>
				// </div>";
				
		}

	}
	public function simpan(){
		$data = [
			'title' => $this->input->post('title'),
			'content' => $this->input->post('content')
		];
		$tambah = $this->image->tambah($data);
		if($tambah){
			redirect('text', 'refresh');
		}
	}
	public function detail($id){
		$data = $this->image->get_one_post($id);

		echo json_encode($data);
	}
}
