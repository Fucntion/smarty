<div class="left">
    <h2>{$title}</h2>
   
		{if $shopList}
		
		<table border="1px">
			
			
	    	<tr>
				{foreach $shopList[0] as $key => $value}

    			<th class="col-md-1">{$key}</th>
    			{/foreach}
	    	</tr>
	
    	
		{foreach $shopList as $key => $value}
    	<tr class="product_id" >
    		{foreach $shopList[$key] as $key2 => $value2}
    			
				{if $key2 == 'thumb'}
				<td><img width="100px" src="{$value2}"></td>
				{elseif $key2 == 'href'}
				<td><button onclick="toDetails({$shopList[$key]['product_id']},'shop')">链接</button></td>
				{else}
				<td>{$value2}</td>
				{/if}
    			
    		{/foreach}
    	</tr>

    	{/foreach}
    
		{/if}

</table>


      
</div>