<?php defined('SYSPATH') or die('No direct script access.') ?>
<?php foreach($queries['data'] as $dbInstance => $data): ?>
	<h1>Database <?php echo $dbInstance ?></h1>
	<table id="queries">
		<thead>
			<tr>
				<th>SQL</th>
				<th>Time</th>
				<th>Memory</th>
			</tr>
		</thead>
		<tbody>
		<?php for ($i = 0; $i < $data['total']['count'] ; $i++): ?>
			<tr class='<?php echo text::alternate('odd','normal')?>'>
				<td><?php echo $data[$i]['name'] ?></td>
				<td><?php echo number_format($data[$i]['time'] * 1000, 3) ?> ms</td>
				<td><?php echo number_format($data[$i]['memory'] / 1024, 3) ?> kb</td>
			</tr>
		<?php endfor ?>
		</tbody>
		<tfoot>
			<tr>
				<th><?php echo $data['total']['count'] ?> SQL performed</th>
				<th><?php echo number_format($data['total']['time'] * 1000, 3) ?> ms</th>
				<th><?php echo number_format($data['total']['memory'] / 1024, 3) ?> kb</th>
			</tr>
		</tfoot>
	</table>
<?php endforeach ?>