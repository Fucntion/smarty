<!--这里采用不规范命名是因为避免和view类冲突-->
<div class="left">
    <h2>{$title}</h2>
   
   
	<table border="1px">
		{foreach $shopinfo as $key => $value}
			<tr>
				<td>{$key}</td>
				<td>
					{if $key == 'thumb'}
					<img width="100px" data-popup="{$shopinfo['popup']}" src="{$value}" />
					{else}
					{$value}
					{/if}
				</td>
			</tr>
    		
    	{/foreach}		 
	</table>     	   	
选择数量
<p>
	<button style="width: 40px;"> + </button>
	<input readonly="readonly" type="number">
	<button style="width: 40px;"> - </button>
</p>
	      
</div>