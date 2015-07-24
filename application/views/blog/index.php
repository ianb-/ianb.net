<div class="row">
	<h1><a href="<?php echo base_url('blog/'.$blog['slug']); ?>"><?php echo $blog['title']; ?></a></h1>
	<em><?php echo $blog['date']; ?></em>
	<p>
		<?php echo auto_typography($blog['text']); ?>
	</p>
</div>