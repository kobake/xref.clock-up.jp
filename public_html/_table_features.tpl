<!-- <div class="table-responsive"> -->
<div style="margin-bottom: 16px;">
	<table class="table table-striped">
		<!-- head -->
		<thead>
			<tr>
				<th></th>
				{foreach from=$features item=feature}
					<th>{$feature}</th>
				{/foreach}
			</tr>
		</thead>
		<!-- body -->
		<tbody>
			{foreach from=$engines item=engine}
				<tr class="engine-{$engine|lower}">
					<th>{$engine}</th>
					{foreach from=$features item=feature}
						<td>
							{if isset($contents["{$engine}_{$feature}"])}
							{$contents["{$engine}_{$feature}"]}
							{/if}
						</td>
					{/foreach}
				</tr>
			{/foreach}
		</tbody>
	</table>
</div>
