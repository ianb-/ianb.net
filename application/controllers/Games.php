<?php
class Games extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('steam');
		$this->load->model('lastfm');
		$this->load->helper('url');
		$this->load->helper('form');
	}

	public function index()
	{
		$this->load->view('templates/header');
		$this->load->view('templates/games');
		$this->load->view('games/index');
		$this->load->view('templates/footer');
	}

	public function csgo()
	{
		$this->load->view('templates/header');
		$this->load->view('templates/games');
		$this->load->view('games/csgo');
		$this->load->view('templates/footer');
	}

	public function tf2()
	{
		$this->load->view('templates/header');
		$this->load->view('templates/games');
		$this->load->view('games/tf2');
		$this->load->view('templates/footer');
	}

	public function l4d2()
	{
		$this->load->view('templates/header');
		$this->load->view('templates/games');
		$this->load->view('games/l4d2');
		$this->load->view('templates/footer');
	}

	public function get_steam_status()
	{
		$steam = $this->steam->my_profile();
		echo json_encode($steam);
	}

	public function get_csgo_stats()
	{
		$html = $this->steam->csgo_stats();
		echo json_encode($html);
	}

	public function compare_csgo()
	{
		$html = $this->steam->csgo_stats();
		echo json_encode($html);
	}

	public function get_l4d2_stats()
	{
		$html = $this->steam->l4d2_stats();
		echo json_encode($html);
	}

	public function compare_l4d2()
	{
		$html = $this->steam->l4d2_stats();
		echo json_encode($html);
	}

	public function get_tf2_stats()
	{
		$html = $this->steam->tf2_stats();
		echo json_encode($html);
	}

	public function compare_tf2()
	{
		$html = $this->steam->tf2_stats();
		echo json_encode($html);
	}
}