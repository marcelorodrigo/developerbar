<?php defined('SYSPATH') or die('No direct script access.') ?>
<?php echo html::style('developerbar/media/css/developerbar.css') ?>
<script type="text/javascript">
// Load jQuery only if needed
if(!(window.jQuery)){
	var s = document.createElement('script');
	s.setAttribute('src', '<?php echo url::site('developerbar/media/js/jquery.min.js')?>');
	s.setAttribute('type', 'text/javascript');
	document.write(s);
}
</script>
<?php echo html::script('developerbar/media/js/simpletabs_1.3.packed.js') ?>
<div id="developerbarMain">
	<div id="developerbarToolbar">
		<div>
			<?php echo html::image('developerbar/media/img/k.png', array('alt' => 'Kohana DeveloperBar','id' => 'developerbarKohana')) ?>
			<?php echo html::image('developerbar/media/img/kohana.png', array('alt' => 'Kohana DeveloperBar','id' => 'developerbarKohanaFull')) ?>
		</div>
		<div class="simpleTabs">
			<ul class="simpleTabsNavigation">
				<li><a href="#">Queries</a></li>
				<li><a href="#">Files</a></li>
				<li><a href="#">Modules</a></li>
				<li><a href="#">Routes</a></li>
			</ul>
			<div class="simpleTabsContent">
				<?php echo $queries ?>
			</div>
			<div class="simpleTabsContent">
				<?php echo $files ?>
			</div>
			<div class="simpleTabsContent">
				<?php echo $modules ?>
			</div>
			<div class="simpleTabsContent">
				<?php echo $routes ?>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$("#developerbarKohana").click(function(){
	$("#developerbarKohana").toggle();
	$("#developerbarMain").toggleClass('fullSize');
	$("#developerbarKohanaFull").toggle();
	$(".simpleTabs").toggle(300);
});
$("#developerbarKohanaFull").click(function(){
	$("#developerbarMain").toggleClass('fullSize');
	$("#developerbarKohana").toggle();
	$("#developerbarKohanaFull").toggle();
	$(".simpleTabs").toggle(300);
});
</script>