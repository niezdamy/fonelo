{extends file=$conf->root_path|cat:"/templates/mainSkeleton.tpl"}


{block name=content}

	<nav class="navbar navbar-inverse navbar-fixed-top nav_transparent" role="navigation" id="nav_top">
    	{include file=$conf->root_path|cat:"/templates/navigation.tpl"}
    </nav>

    <div id="wrapper">
    
        <!-- MAIN IMAGE -->
        <div class="mainPageImage" style="background: url('{$conf->app_root}/images/image{$usr_data['main_image']}.jpg');">
            
        </div>
        <!-- /MAIN IMAGE -->

        <!-- MAIN TITLE -->
        <div class="page-header mainPageTitle">
            <div class="container-fluid">
            <div class="jumbotron mainPageJumbotron">
                <h1>Witaj {$usr_data['username']}!</h1>
                <p>
                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                </p>
                <p>
                <a class="btn btn-primary btn-lg" role="button" onclick="{literal}$('html, body').animate({scrollTop: 380}, 750);{/literal}">Zacznij tutaj!</a>
                </p>
            </div>
            </div>
        </div>
        <!-- /MAIN TITLE -->

        <!-- PAGE WRAPPER -->
        <div id="page-wrapper" style="margin-top: 100vh; position:relative; z-index:1; background-color:#fff;">
            <div class="container-fluid">
 
            <!-- MAIN -->
            <div class="row">
                <div class="col-md-4 profile_relative" id="profile_widget">
                <div class="thumbnail">
                    <img src="{$conf->app_url}/images/profile_photos/{$usr_data['avatar']}.jpg" alt="..." class="img-responsive">
                    <div class="caption">
                    <h3>{$usr_data['username']}</h3>
                    <p>Ostatnie logowanie: {$usr_data['last_visit']}</p>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#uploadModal">Zmień zdjęcie</button>
                    <a href="{$conf->action_root}viewProfile" class="btn btn-default" role="button">Profil</a></p>
                    </div>
                </div>
				        </div>
                <div class="col-md-8">
                <!-- PAGE TITLE -->
                <div class="page-header">
                    <h1>Witaj w dzienniku treningowym. <!--small>Subtext for header</small--></h1>
                </div>
                        
                <h4>To jest Twój postęp w osiągnięciu celu:</h4>
                        
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {$usr_data['progress']}%;">
                            <span class="sr-only">60% Complete</span>
                        </div>
                    </div>
              
                    <p class="text-justify">
                        {$usr_data['text']}
                        It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum
                        passages, and more recently with desktop publishing software like Aldus PageMaker
                        including versions of Lorem Ipsum.
                    </p>
                
                <!-- BUTTONS -->
                <div class="row">
                    <!-- ADD WORKOUT -->
                    <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <span class="glyphicon glyphicon-plus" aria-hidden="true" style="margin-right:10px;"></span>
                            <span data-toggle="modal" data-target="#addWorkout" style="cursor:pointer;"> Dodaj Trening </span>
                        </div>
                    </div>
                    </div>
                    <!-- OTHER WORKOUT -->
                    <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-body">
                        <span class="glyphicon glyphicon-eye-close" aria-hidden="true" style="margin-right:10px;"></span>
                        <span style="cursor:pointer;" href="#trainings" 
                        	onclick="{literal}$('html, body').animate({scrollTop: $($(this).attr('href')).offset().top - 70}, 750);{/literal}"> 
                        Zobacz swoje treningi.
                        </span>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            <!-- /MAIN -->

            <!-- MAIN TRAINING -->
            <div class="row">
                <div class="col-lg-12">
                    
                <div class="page-header" id="trainings">
                    <h1>To są Twoje treningi</h1>
                </div>
                    {include file=$conf->root_path|cat:"/templates/mainPage/timeline.tpl"}
                    
            </div>
            </div>
            <!-- /MAIN TRAINING -->

            </div>
            
        </div>
        <!-- /PAGE WRAPPER -->
    
    </div>
    
{/block}

{block name = modals}

    <!-- MODALS -->
        {include file=$conf->root_path|cat:"/templates/mainPage/add_workout.tpl"}
        {include file=$conf->root_path|cat:"/templates/mainPage/del_workout.tpl"}
        {include file=$conf->root_path|cat:"/templates/mainPage/upload_photo.tpl"}
    <!-- /MODALS -->

{/block}