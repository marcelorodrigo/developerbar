<?php defined('SYSPATH') or die('No direct script access.') ?>
<?php echo html::style('developerbar/media/css/developerbar.css') ?>
<div id="developerbarMain">
	<div id="developerbarToolbar">
		<div>
			<?php echo html::image('developerbar/media/img/k.png', array('alt' => 'Kohana DeveloperBar','id' => 'developerbarKohana')) ?>
			<?php echo html::image('developerbar/media/img/kohana.png', array('alt' => 'Kohana DeveloperBar','id' => 'developerbarKohanaFull')) ?>
		</div>
		<div class="tabbed">
			<ul class="tabs">
				<li class="t1"><a class="t1 tab" title="Queries">Queries</a></li>
				<li class="t2"><a class="t2 tab" title="Files">Files</a></li>
				<li class="t3"><a class="t3 tab" title="Modules">Modules</a></li>
				<li class="t4"><a class="t4 tab" title="Routes">Routes</a></li>
				<li class="t5"><a class="t5 tab" title="Session">Session</a></li>
				<li class="t6"><a class="t6 tab" title="GET">GET</a></li>
				<li class="t7"><a class="t7 tab" title="POST">POST</a></li>
			</ul>
			<div class="t1">
				<?php echo $queries ?>
			</div>
			<div class="t2">
				<?php echo $files ?>
			</div>
			<div class="t3">
				<?php echo $modules ?>
			</div>
			<div class="t4">
				<?php echo $routes ?>
			</div>
			<div class="t5">
				<?php echo $session ?>
			</div>
			<div class="t6">
				<?php echo $get ?>
			</div>
			<div class="t7">
				<?php echo $post ?>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">	
// Load jQuery only if needed
if(!(window.jQuery)){
	var s	= document.createElement("script");
	var h	= document.getElementsByTagName('HEAD').item(0);
	s.type	= "text/javascript";
	s.src	= "<?php echo Kohana_URL::site('developerbar/media/js/jquery.min.js')?>";
	h.appendChild(s);
	
}

window.onload = function(){
	$("#developerbarKohana").click(function(){
		$("#developerbarKohana").toggle();
		$("#developerbarMain").toggleClass('fullSize');
		$("#developerbarKohanaFull").toggle();
		$(".tabbed").toggle(300);
	});
	$("#developerbarKohanaFull").click(function(){
		$("#developerbarMain").toggleClass('fullSize');
		$("#developerbarKohana").toggle();
		$("#developerbarKohanaFull").toggle();
		$(".tabbed").toggle(300);
	});
	
	// setting the tabs in the sidebar hide and show, setting the current tab
	$('div.tabbed div').hide();
	$('div.t1').show();
	$('div.tabbed ul.tabs li.t1 a').addClass('tab-current');

	// SIDEBAR TABS
	$('div.tabbed ul li a').click(function(){
		var thisClass = this.className.slice(0,2);
		$('div.tabbed div').hide();
		$('div.' + thisClass).show();
		$('div.tabbed ul.tabs li a').removeClass('tab-current');
		$(this).addClass('tab-current');
		});
};
</script>