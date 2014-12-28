<!-- <div class="table-responsive"> -->
<div style="margin-bottom: 16px;">
	<table class="table table-striped">
		<!-- head -->
		<thead>
			<tr>
				<th></th>
				<?php foreach ($engines as $engine): ?>
					<th><?php echo r($engine); ?></th>
				<?php endforeach; ?>
			</tr>
		</thead>
		<!-- body -->
		<tbody>
			<?php foreach ($features as $feature): ?>
				<tr>
					<td><?php echo r($feature); ?></td>
					<?php foreach ($engines as $engine): ?>
						<td>
							<?php
							if(isset($contents["{$engine}_{$feature}"])){
								echo r($contents["{$engine}_{$feature}"]);
							}
							?>
						</td>
					<?php endforeach; ?>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
