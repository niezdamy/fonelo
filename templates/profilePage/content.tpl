{extends file=$conf->root_path|cat:"/templates/mainSkeleton.tpl"}


{block name=content}

  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" id="nav_top">
    {include file=$conf->root_path|cat:"/templates/navigation.tpl"}
  </nav>

  {include file=$conf->root_path|cat:"/templates/profilePage/chartScript.tpl"}

  <div id="wrapper">

    <div id="page-wrapper" style="position:relative; z-index:0; background-color:#fff;">
      <div class="container-fluid" id="page_container">
        <!-- PROFILE WRAPPER -->
        <div class="row">

          <!-- PROFILE PHOTO -->
          <div class="col-md-6 hidden-xs hidden-sm">
            <div class="thumbnail">
              <img src="{$conf->app_url}/images/profile_photos/{$usr_data['avatar']}.jpg" alt="..." class="img-responsive">
              <div class="caption">
                <h3>Witaj {$usr_data['username']}!</h3>
                <p>Ostatnie logowanie: {$usr_data['last_visit']}</p>
                <p>
                  <a href="{$conf->action_root}main" class="btn btn-primary" role="button">Strona główna</a>
                  <a href="{$conf->action_root}viewSettings" class="btn btn-default" role="button">Ustawienia</a>
                </p>
              </div>
            </div>
          </div>
          <!-- /PROFILE PHOTO-->

          <!-- STATS -->
          <div class="col-md-6 statistic_font_size">

            <div class="page-header">
              <h1>
                Twoje statystyki <!--small>Subtext for header</small-->
              </h1>
            </div>

            <div class="text-justify">
              {$usr_data['text']}
            </div>

            <table class="table" style="margin-top:20px;">
              <thead>
                <tr>
                  <th>Atrybuty</th>
                  <th>Wartość:</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">Dzień rejestracji:</th>
                  <td>{$usr_data['register_date']}</td>
                </tr>
                <tr>
                  <th scope="row">Ilość treningów:</th>
                  <td>{$usr_data['total_trainings']}</td>
                </tr>
                <tr>
                  <th scope="row">Spalone kalorie:</th>
                  <td>{$usr_data['total_kcal']}</td>
                </tr>
                <tr>
                  <th scope="row">Ilość kalorii na trening:</th>
                  <td>{$usr_data['kcal_per_workout']}</td>
                </tr>
                <tr>
                  <th scope="row">Spalone hamburgery:</th>
                  <td>{$usr_data['burned_hamb']}</td>
                </tr>
              </tbody>
            </table>
            
          </div>
          <!-- /STATS-->
          
        </div>
        <!-- /PROFILE WRAPPER -->
        
        <!-- INFOS -->
        <div class="row">
                    
          <div class="col-sm-3">
            <div class="panel panel-default">
              <div class="panel-body">
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                Płeć: {$usr_data['sex']}
              </div>
            </div>
          </div>
                    
          <div class="col-sm-3">
            <div class="panel panel-default">
              <div class="panel-body">
                <span class="glyphicon glyphicon-sort-by-attributes" aria-hidden="true"></span>
                Waga: {$usr_data['weight']}kg
              </div>
            </div>
          </div>
                    
          <div class="col-sm-3">
            <div class="panel panel-default">
              <div class="panel-body">
                <span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span>
                Cel: {$usr_data['target']}
              </div>
            </div>
          </div>
                    
          <div class="col-sm-3">
            <div class="panel panel-default">
              <div class="panel-body">
                <span class="glyphicon glyphicon-scale" aria-hidden="true"></span>
                Staż: {$usr_data['seniority']}
              </div>
            </div>
          </div>

        </div>
        <!-- /INFOS-->

        <!-- CHARTS -->
        <div class="row">
          <div class="col-sm-6">
            <h4>Rozmiar Twojego bica:</h4>
            <div id="curve_chart" style="width: 100%; height: 200%"></div>
          </div>
          <div class="col-sm-6">
            <h4>Twoja waga:</h4>
            <div id="curve_chartt" style="width: 100%; height: 200%"></div>
          </div>
        </div>
        <!-- /CHARTS -->
        
      </div>
    </div>
    
  </div>

{/block}

{block name = modals}

    <!-- MODALS -->
        
    <!-- /MODALS -->

{/block}