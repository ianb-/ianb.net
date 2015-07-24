<?php
class Lastfm extends CI_Model {

	private $url = null;

	public function __construct()
	{
		$this->url = "http://ws.audioscrobbler.com/2.0/?api_key=[MY API KEY HERE]&format=json";
		$this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
	}

	public function last_fm_cache($request, $key)
	{
		if ( !$json = $this->cache->get($key)) {
			$json = json_decode(file_get_contents($request), true);
			$this->cache->save($key, $json, 60);
		}
		return $json;
	}

	public function get_currently_playing()
	{
		$request = $this->url . "";
	}

	public function get_similar($artist)
	{
		$request = $this->url . "&method=artist.getsimilar&artist=" . $artist . "&limit=10";
		return $this->last_fm_cache($request, 'similar_artists');
	}

	public function get_recent_tracks($user="Zephdawg")
	{
		$request = $this->url . "&method=user.getrecenttracks&user=" . $user . "&limit=9";
		return $this->last_fm_cache($request, 'recent_tracks');
	}

	public function get_albums_of_the_month()
	{
		$request = $this->url . "&method=user.gettopalbums&user=Zephdawg&limit=9&period=1month";
		$albums = $this->last_fm_cache($request, 'weekly_chart')['topalbums']['album'];
		//return $this->last_fm_cache($request, 'weekly_chart')['topalbums']['album'];
		$html = '<div class="row">';
		foreach ($albums as $album)
		{
			$html .= '<div class="album-tile"><img src="' . $album['image'][3]['#text'] . '"/><p>';
			$html .= '<h4>' . $album['artist']['name'] . '<br>' . $album['name'] . '<br>' . $album['playcount'] . ' Plays</h4></p></div>';
		}
		$html .= '</div>';
		return $html;
	}
}
