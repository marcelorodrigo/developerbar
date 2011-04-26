<?php defined('SYSPATH') or die('No direct script access.') ?>
<h1>Benchmarks</h1>
<table id="benchmarks">
	<thead>
		<tr>
			<th>Benchmark</th>
			<th class="right">Count</th>
			<th class="right">Avg time</th>
			<th class="right">Total time</th>
			<th class="right">Avg memory</th>
			<th class="right">Total memory</th>
		</tr>
	</thead>
	<tbody>
		<?php if (count($benchmarks)):
			$application = array_pop($benchmarks);?>
			<?php foreach ((array)$benchmarks as $group => $marks): ?>
				<tr>
					<th colspan="6"><h2><?php echo ucfirst($group)?></h2></th>
				</tr>
				<?php foreach($marks as $benchmark): ?>
				<tr class="<?php echo text::alternate('odd','even')?>">
					<td><?php echo $benchmark['name'] ?></td>
					<td class="right"><?php echo $benchmark['count'] ?></td>
					<td class="right"><?php echo sprintf('%.2f', $benchmark['avg_time'] * 1000) ?> ms</td>
					<td class="right"><?php echo sprintf('%.2f', $benchmark['total_time'] * 1000) ?> ms</td>
					<td class="right"><?php echo text::bytes($benchmark['avg_memory']) ?></td>
					<td class="right"><?php echo text::bytes($benchmark['total_memory']) ?></td>
				</tr>
				<?php endforeach; ?>
			<?php endforeach; ?>
		<?php else: ?>
			<tr class="<?php echo text::alternate('odd','even') ?>">
				<td colspan="6">no benchmarks to display</td>
			</tr>
		<?php endif ?>
	</tbody>
	<tfoot>
		<tr class="benchmark_footer">
			<th colspan="2">APPLICATION</th>
			<th class="right"><?php echo sprintf('%.2f', $application['avg_time'] * 1000) ?> ms</th>
			<th class="right"><?php echo sprintf('%.2f', $application['total_time'] * 1000) ?> ms</th>
			<th class="right"><?php echo text::bytes($application['avg_memory']) ?></th>
			<th class="right"><?php echo text::bytes($application['total_memory']) ?></th>
		</tr>
	</tfoot>
</table>