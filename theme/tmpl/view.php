<!--这里采用不规范命名是因为避免和view类冲突-->
<div class="left">
    <h2>{$title}</h2>
   

		{comment}           
			options是商品类别,info是商品基本信息,featureService是相关服务关服务-->
	    {/comment}    
	<h4>基本资料</h4>
	<table border="1px">
		{foreach $info as $key => $value}
			<tr>
				<td>
					{$key}
				</td>
				<td>
					{$value}
				</td>
			</tr>
    		
    	{/foreach}	
	 
	</table>
	  
	<h4>周边服务</h4>
	
		{foreach $featureService as $key => $value}
			<div style="border:1px;margin: 10px;float:left ;">
    			<a href="javascript:void(0)" onclick="toDetails({$featureService[$key]['product_id']},'view')">
    				<img src="{$featureService[$key]['thumb']}">
    				<h6>{$featureService[$key]['name']}</h6>	
    			</a>
    			
			</div>
    		
    	{/foreach}		 

   
</div>