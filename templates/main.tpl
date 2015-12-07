{include file=$conf->root_path|cat:"/templates/head.tpl"}

<body style="margin-top: 0;">

    <div id="wrapper_index">

        <div id="login_wrapper" class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-lg-offset-1 fit-all-screen">
                    <div id="first-content" class="jumbotron jumbotron-login" style="overflow:hidden">
                        
                    	{block name=content} Błąd przy wczytywaniu szablonu tpl. {/block}
                        
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    
    {literal}
		<script>
        	$(function () {
			  $('[data-toggle="tooltip"]').tooltip()
			});
        </script>
    {/literal}
    
</body>

</html>
