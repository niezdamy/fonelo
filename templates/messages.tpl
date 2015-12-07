<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                
                {if $msgs->isError()}
                    <p>	
                    	<h4>Błędy:</h4> 
                    	<ol>
                        {foreach $msgs->getErrors() as $err}
                        {strip}
                            <li>{$err}</li>
                        {/strip}
                        {/foreach}
                        </ol>
                    </p>
                {/if}

                {if $msgs->isInfo()}
                    <p>
                    	<h4>Informacje:</h4>
                    	<ol>
                        {foreach $msgs->getInfos() as $inf}
                        {strip}
                            <li>{$inf}</li>
                        {/strip}
                        {/foreach}
                        </ol>
                    </p>
                {/if}

            </div>
        </div>
    </div>
</div>