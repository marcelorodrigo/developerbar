<?php defined('SYSPATH') or die('No direct script access.') ?>
<h1>Session</h1>
<table id="session">
	<theader>
		<tr>
			<th>Name</th>
			<th>Value</th>
		</tr>
	</theader>
	<tbody>
		<?php foreach($session as $name => $value): ?>
			<tr class="<?php echo text::alternate('odd','normal')?>">
				<td><?php echo $name ?></td>
				<td><?php var_export($value) ?></td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>