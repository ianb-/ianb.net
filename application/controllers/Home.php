<?php
class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('lastfm');
		$this->load->model('steam');
		$this->load->model('blog');
		$this->load->helper('url');
		$this->load->helper('typography');
	}

	public function index() 
	{
		$data['blog'] = $this->blog->get_latest_blog();

		$this->load->view('templates/header', $data);
		$this->load->view('frontpage.php');
		$this->load->view('templates/footer');
	}

	public function about()
	{
		$this->load->view('templates/header', $data);
		$this->load->view('about.php');
		$this->load->view('templates/footer');
	}
}