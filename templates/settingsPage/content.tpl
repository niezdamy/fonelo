{extends file=$conf->root_path|cat:"/templates/mainSkeleton.tpl"}


{block name=content}

	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" id="nav_top">
        {include file=$conf->root_path|cat:"/templates/navigation.tpl"}
    </nav>

    <div id="wrapper">

    <div id="page-wrapper" style="position:relative; z-index:0; background-color:#fff;">
      <div class="container-fluid" id="page_container">

        <div class="page-header">
          <h1>
            Twoje ustawienia <!--small>Subtext for header</small-->
          </h1>
        </div>

        <div class="row">
          <!-- SETTINGS -->
          <div class="col-md-6 col-md-offset-3">
            
            <form class="form-horizontal" data-toggle="validator" role="form" action="{$conf->action_root}changeSettings" method="post">

              <h4> Zmień hasło </h4>
              <div class="form-group">
                <div class="col-sm-12">
                  <input type="password" class="form-control form-login" id="inputPassword" name="formPassword" placeholder="New password" data-toggle="tooltip" data-placement="auto" title="Haslo musi zawierac od 6 do 20 znak�w." data-trigger="focus">
                  </div>
              </div>

              <div class="form-group">
                <div class="col-sm-12">
                  <input type="password" class="form-control form-login" id="inputPassword2" name="formPassword2" placeholder="Confirm password">
                  </div>
              </div>

              <h4> Zmień staż lub cel </h4>
              <div class="form-group">
                <div class="col-sm-6">
                  <div class="input-group">
                    <div class="input-group-addon form-login">Staż:</div>
                    <select class="form-control form-login" name="formSeniority">
                      {if $usr_data['seniority'] == 'Amateur'}<option selected="selected">Amateur</option>{else}<option>Amateur</option>{/if}
                      {if $usr_data['seniority'] == 'Semi-professional'}<option selected="selected">Semi-professional</option>{else}<option>Semi-professional</option>{/if}
                      {if $usr_data['seniority'] == 'Professional'}<option selected="selected">Professional</option>{else}<option>Professional</option>{/if}
                      {if $usr_data['seniority'] == 'World class'}<option selected="selected">World class</option>{else}<option>World class</option>{/if}
                      {if $usr_data['seniority'] == 'Legendary'}<option selected="selected">Legendary</option>{else}<option>Legendary</option>{/if}
                    </select>
                  </div>
                </div>

                <div class="col-sm-6">
                  <div class="input-group">
                    <div class="input-group-addon form-login">Cel:</div>
                    <select class="form-control form-login" name="formTarget">
                      {if $usr_data['target'] == 'Mass'}<option selected="selected">Mass</option>{else}<option>Mass</option>{/if}
                      {if $usr_data['target'] == 'Strength'}<option selected="selected">Strength</option>{else}<option>Strength</option>{/if}
                      {if $usr_data['target'] == 'Sculpture'}<option selected="selected">Sculpture</option>{else}<option>Sculpture</option>{/if}
                    </select>
                  </div>
                </div>
              </div>

              <h4> Coś o Tobie: </h4>
              <div class="form-group">
                <div class="col-sm-12">
                  <textarea class="form-control form-login" rows="4" name="formText">{$usr_data['text']}</textarea>
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-12">
                  <button type="button" class="btn btn-default" data-toggle="modal" data-target="#changeImage">
                    Zmień zdjęcie główne
                  </button>
                  </div>
              </div>

              <div class="form-group">
                <div class="col-sm-12">
                  <button type="submit" class="btn btn-default btn-primary" name="changeSettings">Potwierdź zmiany</button>
                </div>
              </div>

            </form>
            
          </div>
          <!-- /SETTINGS-->
        </div>

      </div>
    </div>

  </div>  

{/block}

{block name = modals}

    <!-- MODALS -->
        {include file=$conf->root_path|cat:"/templates/settingsPage/changeImage.tpl"}
    <!-- /MODALS -->

{/block}