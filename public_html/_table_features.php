<div class="table-responsive">
	<table class="table table-striped">
		<!-- head -->
		<thead>
			<tr>
				<th></th>
				<?php foreach ($features as $feature): ?>
					<th><?php echo r($feature); ?></th>
				<?php endforeach; ?>
			</tr>
		</thead>
		<!-- body -->
		<tbody>
			<?php foreach ($engines as $engine): ?>
				<tr>
					<td><?php echo r($engine); ?></td>
					<?php foreach ($features as $feature): ?>
						<td><?php echo r($contents["{$engine}_{$feature}"]); ?></td>
					<?php endforeach; ?>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
