{extends file=$conf->root_path|cat:"/templates/mainSkeleton.tpl"}


{block name=content}

	<nav class="navbar navbar-default navbar-fixed-top" role="navigation" id="nav_top">
    	{include file=$conf->root_path|cat:"/templates/navigation.tpl"}
    </nav>

    <div id="wrapper">
    
        <!-- MAIN IMAGE -->
        <div class="mainPageImage" style="background: url('{$conf->app_root}/images/main1.jpg');">
            <div class="row search-wrap-row">
                <div class="col-md-12 search-wrap-col">
                    <div class="search-content">
                        <form action="">
                            <div class="form-group">
                                <input type="search" class="form-control" id="fast-live-search" placeholder="Wyszukaj kontakt">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="search-result">
                            
        </div>
        <!-- /MAIN IMAGE -->

        <!-- PAGE WRAPPER -->
        <div id="page-wrapper" style="margin-top: 50vh; position:relative; z-index:1; background-color:#fff;">
            <div class="container">
 
                <!-- MAIN -->
                <div class="row">
                    <div class="col-md-4 profile_relative" id="profile_widget">
                        <div class="thumbnail">
                            <img src="{$conf->app_url}/images/profile_photos/1.jpg" alt="" class="img-responsive">
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
                            <h1>Witaj w Twojej książce telefonicznej.</h1>
                        </div>
                                
                        <h4>Objętość Twojej książki:</h4>
                            
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {$contact_data|@count}%;">
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
                                    <span data-toggle="modal" data-target="#addContact" style="cursor:pointer;"> Dodaj kontakt </span>
                                </div>
                            </div>
                        </div>
                        <!-- OTHER WORKOUT -->
                        <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-body">
                            <span class="glyphicon glyphicon-eye-close" aria-hidden="true" style="margin-right:10px;"></span>
                            <span style="cursor:pointer;" href="#contacts" 
                            	onclick="{literal}$('html, body').animate({scrollTop: $($(this).attr('href')).offset().top - 70}, 750);{/literal}"> 
                                Zobacz kontakty.
                            </span>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                <!-- /MAIN -->

                <!-- Contact Listing -->
                <div class="row" style="transform: translateY(-20px);" id="contacts">
                    <div class="col-lg-12">
                        <div class="page-header" style="margin-top:0;">
                            <h1>To są Twoje kontakty</h1>
                        </div>
                        <div style="margin: 20px auto;">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="">
                                        <div class="form-group" style="margin:auto;">
                                            <input type="search" class="form-control" id="live-search" placeholder="Wpisz kontakt do wyszukania">
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 10px;">
                                <div class="col-md-12">
                                    <div class="btn-group" role="group" id="group-wrap">
                                        {if isset($groups)}
                                            {foreach $groups as $wiersz}
                                                <button type="button" class="btn btn-default select-group" data-group="{$wiersz}">{$wiersz}</button>
                                            {/foreach}
                                        {/if}
                                        <button type="button" class="btn btn-default clear-query">Wszystkie</button>
                                    </div>
                                    <button type="button" id="del-group" class="btn btn-warning">Zarządzaj grupami</button>
                                </div>
                            </div>
                        </div>
                        
                        {include file=$conf->root_path|cat:"/templates/mainPage/contact.tpl"}
                    </div>
                </div>
                <!-- end Contact Listing -->

            </div>
            
        </div>
        <!-- /PAGE WRAPPER -->
    
    </div>
    
{/block}

{block name = modals}

    <!-- MODALS -->
        {include file=$conf->root_path|cat:"/templates/mainPage/add_contact.tpl"}
        {include file=$conf->root_path|cat:"/templates/mainPage/del_contact.tpl"}
        {include file=$conf->root_path|cat:"/templates/mainPage/edit_contact.tpl"}
        {include file=$conf->root_path|cat:"/templates/mainPage/del_group.tpl"}
    <!-- /MODALS -->

{/block}