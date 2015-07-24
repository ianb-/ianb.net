<?php
class Steam extends CI_Model
{
	private $key = null;
	private $steamid = null;
	//defunct steamid 76561197969704117

	public function __construct()
	{
		$this->key = "[MY API KEY HERE]"; //my steamworks api key
		$this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
	}

	// Steam returns a huge data object, so this function grabs the specific lines we feed it
	private function search_steam_stats($array, $key, $value)
	{
		$results = array();

		if (is_array($array)) {
			if (isset($array[$key]) && $array[$key] == $value) {
				$results[] = $array;
			}

			foreach ($array as $subarray) {
				$results = array_merge($results, $this->search_steam_stats($subarray, $key, $value));
			}
		}

		return $results;
	}

	private function url($game=null, $method, $steamid)
	{
		if (!is_null($game)) {
			$url = "http://api.steampowered.com/" . $method . "?appid=" . $game . "&key=" . $this->key . "&steamid=" . $steamid . "&format=json";
		}
		else {
			$url = "http://api.steampowered.com/" . $method . "?key=" . $this->key . "&steamids=" . $steamid . "&format=json";
		}
		return $url;
		//example URL
		//http://api.steampowered.com/ISteamUserStats/GetUserStatsForGame/v0002/?appid=440&key=XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX&steamid=76561197972495328
	}

	// Pass all queries through this function, and return the cached results if they exist.
	private function steam_cache($request, $key)
	{
		if ( !$json = $this->cache->get($key)) {
			$json = json_decode(file_get_contents($request), true);
			$this->cache->save($key, $json, 180);
		}
		return $json;
	}

	public function my_profile()
	{
		//http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=XXXXXXXXXXXXXXXXXXXXXXX&steamids=76561197960435530
		$method = "ISteamUser/GetPlayerSummaries/v0002/";
		$steamid = "76561197970405199";
		$req = $this->url(null, $method, $steamid);
		$steam = $this->steam_cache($req, 'my_profile')['response']['players'][0];
		$html = '<img id="steam_avatar" src="' . $steam['avatar'];
		if ($steam['personastate'] == 1) {
			$html .= ' class="online';
		}
		$html .= '"/>';
		$html .= '<span class="tooltip">';
		if (array_key_exists('gameextrainfo', $steam)) {
			$html .= 'In game: ' . $steam['gameextrainfo'];
		}
		else {
			if ($steam['personastate'] == 0) {
				$html .= 'Offline';
			}
			elseif ($steam['personastate'] == 1) {
				$html .= 'Online';
			}
			elseif ($steam['personastate'] == 2) {
				$html .= 'Busy';
			}
			elseif ($steam['personastate'] == 3 || $steam['personastate'] == 4) {
				$html .= 'Away From Keyboard';
			}
		}
		$html .= '</span>';
		return $html;
	}

	public function csgo_stats()
	{
		$steamid = $this->input->post('steamid');
		if (is_null($steamid)) {
			$steamid = "76561197970405199";
		}
		$method = "ISteamUserStats/GetUserStatsForGame/v0002/";
		$game = "730";
		$stats = [
			'total_kills'			=> 'Total Kills',
			'total_deaths'			=> 'Total Deaths',
			'total_kills_headshot'	=> 'Total Headshots',
			'total_kills_knife'		=> 'Total Knife Kills',
			'total_kills_awp'		=> 'Total AWP Kills',
			'total_kills_ak47'		=> 'Total AK47 Kills',
			'total_kills_m4a1'		=> 'Total M4A1 Kills',
			];

		$request = $this->url($game, $method, $steamid);
		$data = $this->steam_cache($request, $game.'-'.$steamid)['playerstats']['stats'];

		$results = array();
		foreach (array_keys($stats) as $stat) {
			$results = array_merge($results, $this->search_steam_stats($data, 'name', $stat));
		}

		$html = '<table>';
		foreach ($results as $result) {
			$html .= '<tr><td>' . $stats[$result['name']] . '</td><td>' . $result['value'] . '</td></tr>';
		}
		$html .= '</table>';
		return $html;
	}

	public function tf2_stats()
	{
		$steamid = $this->input->post('steamid');
		if (is_null($steamid)) {
			$steamid = "76561197970405199";
		}
		$method = "ISteamUserStats/GetUserStatsForGame/v0002/";
		$game = "440";
		$stats = [
			'Scout.accum.iNumberOfKills'						=> 'Scout Kills',
			'Scout.accum.iPointCaptures'						=> 'Scout Captures',
			'Soldier.accum.iNumberOfKills'						=> 'Soldier Kills',
			'TF_SOLDIER_KILL_AIRBORNE_WITH_DIRECT_HIT_STAT'		=> 'Mid-air Rocket Kills',
			'Medic.accum.iNumberOfKills'						=> 'Medic Kills',
			'Medic.accum.iHealthPointsHealed'					=> 'Health Healed',
			'Spy.accum.iNumberOfKills'							=> 'Spy Kills',
			'Spy.accum.iBackstabs'								=> 'Spy Backstabs',
			'Sniper.accum.iNumberOfKills'						=> 'Sniper Kills',
			'Sniper.accum.iHeadshots'							=> 'Sniper Headshots',
			'Pyro.accum.iNumberOfKills'							=> 'Pyro Kills',
			'Heavy.accum.iNumberOfKills'						=> 'Heavy Kills',
			'Demoman.accum.iNumberOfKills'						=> 'Demoman Kills',
			'Engineer.accum.iNumberOfKills'						=> 'Engineer Kills',
		];

		$request = $this->url($game, $method, $steamid);
		$data = $this->steam_cache($request, $game.'-'.$steamid)['playerstats']['stats'];
		//return array_slice($data, 127);

		$results = array();
		foreach (array_keys($stats) as $stat) {
			$results = array_merge($results, $this->search_steam_stats($data, 'name', $stat));
		}

		$html = '<table>';
		foreach ($results as $result) {
			$html .= '<tr><td>' . $stats[$result['name']] . '</td><td>' . $result['value'] . '</td></tr>';
		}
		$html .= '</table>';
		return $html;
	}

	public function l4d2_stats()
	{
		$steamid = $this->input->post('steamid');
		if (is_null($steamid)) {
			$steamid = "76561197970405199";
		}
		$method = "ISteamUserStats/GetUserStatsForGame/v0002/";
		$game = "550";

		$stats = [
			'Stat.InfectedKilled.Total'		=> 'Total Infected Kills',
			'Stat.KitsUsed.Total'			=> 'Health Kits Used',
			'Stat.molotov.Shots.Total'		=> 'Molly Ollys Thrown',
			'Stat.pipe_bomb.Shots.Total'	=> 'Rowdy Roddys Thrown',
			'Stat.vomitjar.Shots.Total'		=> 'Bile Jars Thrown',
			'Stat.GamesWon.Versus'			=> 'Versus Mode Wins',
			'Stat.GamesLost.Versus'			=> 'Versus Mode Losses',
			/*
				The following stats are returned as integer IDs but I'm not sure
				which characters and weapons the IDs correspond to.
			*/
			//'Stat.CampaignID.Fav'			=> 'Most Played Campaign',
			//'Stat.CharacterID.Fav'			=> 'Most Played Character',
			//'Stat.WeaponIDLvl1.Fav'			=> 'Most Used Level 1 Weapon',
			//'Stat.WeaponIDLvl2.Fav'			=> 'Most Used Level 2 Weapon',
			'Stat.MostDamage1Life.Boomer'	=> 'Most Damage as Boomer',
			'Stat.MostDamage1Life.Hunter'	=> 'Most Damage as Hunter',
			'Stat.MostDamage1Life.Smoker'	=> 'Most Damage as Smoker',
			'Stat.MostDamage1Life.Tank'		=> 'Most Damage as Tank',
			'Stat.MostDamage1Life.Spitter'	=> 'Most Damage as Spitter',
			'Stat.MostDamage1Life.Jockey'	=> 'Most Damage as Jockey',
			'Stat.MostDamage1Life.Charger'	=> 'Most Damage as Charger',

		];

		$request = $this->url($game, $method, $steamid);
		$data = $this->steam_cache($request, $game.'-'.$steamid);//['playerstats']['stats'];

		$results = array();
		foreach (array_keys($stats) as $stat) {
			$results = array_merge($results, $this->search_steam_stats($data, 'name', $stat));
		}

		$html = '<table>';
		foreach ($results as $result) {
			$html .= '<tr><td>' . $stats[$result['name']] . '</td><td>' . $result['value'] . '</td></tr>';
		}
		$html .= '</table>';
		return $html;
	}
}
