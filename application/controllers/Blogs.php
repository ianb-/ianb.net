<?php
class Blogs extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('blog');
		$this->load->helper('url');
		$this->load->helper('typography');
	}

	public function index()
	{
		$data['blog'] = $this->blog->get_latest_blog();

		$this->load->view('templates/header');
		$this->load->view('blog/index.php', $data);
		$this->load->view('templates/footer');
	}

	public function archive()
	{
		$data['blogs'] = $this->blog->get_archive();

		$this->load->view('templates/header');
		$this->load->view('blog/article', $data);
		$this->load->view('templates/footer');
	}

	public function view($slug)
	{
		$data['blog'] = $this->blog->get_blog($slug);
		
		$this->load->view('templates/header');
		$this->load->view('blog/article', $data);
		$this->load->view('templates/footer');
	}
}