<div class="left">
    <h2>{$title}</h2>
   
    {if $userDetails}
    <form method="post" action="CtrlUserEdit.php">
    	 {foreach $userDetails as $key => $value}
    	{if $key !== 'status'}
    	<p>
    		<label for="{$key}">{$key}</label>
    		<input id="{$key}" name="{$key}" value="{$value}" />
    	</p>
    	{/if}	
    {/foreach}
    {else}
    {/if}
    <button>提交</button>
    </form>
   
    
</div>