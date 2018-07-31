<div class="container">
    <div class="row">
        <section class="col-md-8 col-md-offset-0 g-module">
        
		<?php foreach($news as $post): ?>
			<h2><?php echo $post['Title'] ?></h2>
			<pre> <?php echo $post['Content'] ?></pre>

		<?php endforeach; ?>



		</section>
    </div>
</div> <!-- /container -->
