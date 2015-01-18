<!-- <div class="table-responsive"> -->
<div style="margin-bottom: 16px;">
	<table class="table table-bordered">
		<!-- head -->
		<thead>
			<tr>
				<th></th>
				{foreach from=$engines item=engine}
				<th class="engine-{$engine|enginekey}">{$engine}</th>
				{/foreach}
			</tr>
		</thead>
		<!-- body -->
		<tbody>
			{foreach from=$features item=feature}
				<tr>
					<th>{$feature}</th>
					{foreach from=$engines item=engine}
						<td class="engine-{$engine|enginekey}">
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
