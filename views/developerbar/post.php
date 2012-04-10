<?php defined('SYSPATH') or die('No direct script access.') ?>
<h1>POST Variables</h1>
<table id="post">
	<thead>
		<tr>
			<th>Name</th>
			<th>Value</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($post as $name => $value): ?>
			<tr class="<?php echo text::alternate('odd','normal')?>">
				<td><?php echo $name ?></td>
				<td><?php var_export($value) ?></td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>