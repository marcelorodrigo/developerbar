<?php defined('SYSPATH') or die('No direct script access.') ?>
<?php echo html::style('developerbar/media/css/developerbar.css') ?>
<?php echo html::style('developerbar/media/css/simpletabs.css') ?>
<?php echo html::script('developerbar/media/js/simpletabs_1.3.packed.js') ?>
<div id="developerbar" class="fullsize">
	<?php echo html::image('developerbar/media/img/kohana.png', array('alt' => 'Kohana DeveloperBar','id' => 'developerbarKohana')) ?>
	<div class="simpleTabs">
		<ul class="simpleTabsNavigation">
			<li><a href="#">Queries</a></li>
			<li><a href="#">Files</a></li>
		</ul>
		<div class="simpleTabsContent">
			<?php echo $queries ?>
		</div>
		<div class="simpleTabsContent">
			<?php echo $files ?>
		</div>
	</div>
</div>
<script>
	$("#developerbarKohana").click(function(){
		//$("#developerbar").toggleClass('minsize')
		$(".simpleTabs").toggle();
	});
</script>