<div class="left">
    <h2>{$title}</h2>
   
		{if $restaurantList}
		
		<table border="1px">
			
			
	    	<tr>
				{foreach $restaurantList[0] as $key => $value}

    			<th class="col-md-1">{$key}</th>
    			{/foreach}
	    	</tr>
	
	    	
    	
		{foreach $restaurantList as $key => $value}
    	<tr class="product_id" data-id="{$restaurantList[$key]['product_id']}">
    		{foreach $restaurantList[$key] as $key2 => $value2}
    			
				{if $key2 == 'thumb'}
				<td><img width="100px" src="{$value2}"></td>
				{elseif $key2 == 'href'}
				<td><button onclick="toDetails({$restaurantList[$key]['product_id']},'restaurant')">链接</button></td>
				{else}
				<td>{$value2}</td>
				{/if}
    			
    		{/foreach}
    	</tr>

    	{/foreach}
    
		{/if}

</table>


      
</div>