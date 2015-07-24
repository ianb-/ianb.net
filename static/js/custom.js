$(document).ready(function() {
	var url = 'http://ianb.net/';
	$.getJSON(url+'music/get_recent_music', function(data) {
		$('#recent-music').html(data);
	});
	$.getJSON(url+'games/get_steam_status', function(data) {
		$('#steam_avatar').html(data);
	});
	if ($('#csgo').length) {
		$('#compared-stats').css('display', 'none');
		$.getJSON(url+'games/get_csgo_stats', function(data) {
			$('#csgo').html(data);
			$('#compared-stats').css('display', 'block');
		});
	}
	if ($('#tf2').length) {
		$('#compared-stats').css('display', 'none');
		$.getJSON(url+'games/get_tf2_stats', function(data) {
			$('#tf2').html(data);
			$('#compared-stats').css('display', 'block');
		});
	}
	if ($('#l4d2').length) {
		$('#compared-stats').css('display', 'none');
		$.getJSON(url+'games/get_l4d2_stats', function(data) {
			$('#l4d2').html(data);
			$('#compared-stats').css('display', 'block');
		});
	}
	if ($('#albumsofthemonth').length) {
		$('#albumsofthemonth').html('<i class="fa fa-2x fa-spinner fa-spin"></i>');
		$.getJSON(url+'music/albums_month', function(data) {
			$('#albumsofthemonth').html(data);
		});
	}

	$('#csgo-comparison').submit(function(e) {
	var form = $(this);
	e.preventDefault();
	$('#compared-stats').html('<i class="fa fa-2x fa-spinner fa-spin"></i>');
	$.ajax({
		method: 'POST',
		url: url+'games/compare_csgo',
		data: form.serialize(),
        dataType: "json",
		processData: false,
		success: function(data) {
			$('#compared-stats').html(data);
		},
	});
	});
	$('#tf2-comparison').submit(function(e) {
		var form = $(this);
		e.preventDefault();
		$('#compared-stats').html('<i class="fa fa-2x fa-spinner fa-spin"></i>');
		$.ajax({
			method: 'POST',
			url: url+'games/compare_tf2',
			data: form.serialize(),
	        dataType: "json",
			processData: false,
			success: function(data) {
				$('#compared-stats').html(data);
			},
		});
	});
	$('#l4d2-comparison').submit(function(e) {
		var form = $(this);
		e.preventDefault();
		$('#compared-stats').html('<i class="fa fa-2x fa-spinner fa-spin"></i>');
		$.ajax({
			method: 'POST',
			url: url+'games/compare_l4d2',
			data: form.serialize(),
	        dataType: "json",
			processData: false,
			success: function(data) {
				$('#compared-stats').html(data);
			},
		});
	});
});