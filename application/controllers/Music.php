<?php
class Music extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('lastfm');
		$this->load->model('steam');
		$this->load->helper('url');
	}

	public function index()
	{
		$this->load->view('templates/header');
		$this->load->view('music/index');
		$this->load->view('templates/footer');
	}

	public function get_recent_music() //clean this up and move logic to model...
	{
		$recent = $this->lastfm->get_recent_tracks()['recenttracks']['track'];
		$html = '<a href="' . $recent[0]['url'] . '">';
		$html .= '<i class="fa fa-lg fa-headphones"></i> ';
		$html .= '<span>' . $recent[0]['artist']['#text'] . ' - ' . $recent[0]['name'] . '</span></a>';
		if (!array_key_exists('date',$recent[0])) {
			$html .= '<br><span class="u-pull-right"><em>Now playing!</em></span>';
		} else {
			$html .= '<br><span class="u-pull-right"><em>' . $recent[0]['date']['#text'] . '</em></span>';
		}
		echo json_encode($html);
	}

	public function albums_month()
	{
		$html = $this->lastfm->get_albums_of_the_month();
		echo json_encode($html);
	}
}
