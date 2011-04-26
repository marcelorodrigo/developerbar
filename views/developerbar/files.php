<?php defined('SYSPATH') or die('No direct script access.') ?>
<h1>Files</h1>
<table id="files">
	<theader>
		<tr>
			<th>Path</th>
		</tr>
	</theader>
	<tbody>
		<?php foreach($files as $f): ?>
			<tr class="<?php echo text::alternate('odd','normal')?>">
				<td><?php echo $f ?></td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>