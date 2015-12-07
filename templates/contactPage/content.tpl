{extends file=$conf->root_path|cat:"/templates/mainSkeleton.tpl"}


{block name=content}

	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" id="nav_top">
        {include file=$conf->root_path|cat:"/templates/navigation.tpl"}
    </nav>

    <div id="wrapper">

    <div id="page-wrapper" style="position:relative; z-index:0; background-color:#fff;">
      <div class="container-fluid" id="page_container">
      	<div class="row">
        	<div class="col-md-6 col-md-offset-3">
            	<img class="img-responsive" style="margin-top: 25vh; margin-bottom: 5vh;" src="{$conf->app_root}/images/favicon_logo.png" />
                <div class="text-center">
                	created by <br />
                    <span style="font-size:250%">Przemysław Hernik</span><br />
                    <span style="font-size:100%">przemek.hernik@hotmail.com</span><br />
                    <span style="font-size:100%">phernik.com</span>
                </div>
            </div>
        </div>
      </div>
    </div>

  </div>  

{/block}

{block name = modals}

    <!-- MODALS -->
        
    <!-- /MODALS -->

{/block}