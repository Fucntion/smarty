<div class="left">
    <h2>{$title}</h2>
   
    {if $userDetails}
    {foreach $userDetails as $key => $value}
    	{if $key !== 'status'}
    		{$key} => {$value}<br />
    	{/if}
    	
    {/foreach}
    {else}
    
    {/if}
</div>
