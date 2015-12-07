{$imagesNumber = 22}
{$active = 'class="active"'}


<div class="modal fade" id="changeImage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        
        <!-- CAROUSEL ITEMS -->
        <div class="row">
          <div id="carousel-example-generic" class="carousel slide" data-wrap="false">
            
            <!-- Indicators -->
            <ol class="carousel-indicators">
            	{for $i=0 to ($imagesNumber-1)}
                    <li data-target="#carousel-example-generic" data-slide-to="{$i}"{if $i==0} class="active"{/if}></li>   	
                {/for}
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
            
            	{for $i=1 to $imagesNumber}
                    <div class="item{if $i==1} active{/if}">
                    	<img src="{$conf->app_root}/images/image{$i}.jpg" alt="..." />
                        <div class="carousel-caption">
                          <h3>Image {$i}</h3>
                        </div>
                    </div>  	
                {/for}
				
            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
              <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
              <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            </a>
          </div>
        </div>
        <!-- /CAROUSEL ITEMS -->
        
        <!-- CAROUSEL FORM -->
        <form action="{$conf->action_root}changeImage" method="post">
        <div class="row">
          <div class="form-group" style="margin-top: 15px;">
            <div class="col-xs-8">
              <div class="input-group">
                <div class="input-group-addon form-login">Wybierz zdjęcie:</div>
                <select class="form-control form-login" name="formImage">
                    {for $i=1 to $imagesNumber}
                        <option>{$i}</option>   	
                    {/for}
                </select>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Confirm</button>
          <!--button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button-->
        </div>
        </form>
        <!-- /CAROUSEL FORM -->
        
      </div>
    </div>
  </div>
</div>