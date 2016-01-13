    <div class="container" id="container_navigation">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="{$conf->app_url}">Fonelo</a>
        </div>
        <div style="height: 1px;" aria-expanded="false" id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">

            <!-- ALERT -->
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    {$messages = 0}
                    {if $messages!=0}<span class="badge">{$messages}</span>{/if}
                    <i class="fa fa-bell"></i>
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu alert-dropdown">
                    <li>
                        <a href="#">
                            Alert Name <span class="label label-default">Alert Badge</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            Alert Name <span class="label label-default">Alert Badge</span>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">View All</a>
                    </li>
                </ul>
            </li>

            <!-- MESSAGES -->
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-envelope"></i>
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu message-dropdown">
                    <li class="message-preview">
                        <a href="#">
                            <div class="media">
                                <div class="media-body">
                                    <h5 class="media-heading">
                                        @<strong>hera04</strong>
                                    </h5>
                                    <p class="small text-muted">
                                        <i class="fa fa-clock-o"></i> Wczoraj, 13:45
                                    </p>
                                    <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="message-preview">
                        <a href="#">
                            <div class="media">
                                <div class="media-body">
                                    <h5 class="media-heading">
                                        @<strong>hera04</strong>
                                    </h5>
                                    <p class="small text-muted">
                                        <i class="fa fa-clock-o"></i> Wczoraj, 13:45
                                    </p>
                                    <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="message-footer">
                        <a href="#">Przeczytaj wszystkie wiadomości</a>
                    </li>
                </ul>
            </li>

            <!-- USER DATA -->
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{$usr_data['username']} <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="{$conf->action_root}main"><i class="fa fa-home"></i> Home</a></li>
                <li><a href="{$conf->action_root}viewProfile"><i class="fa fa-user"></i> Profil</a></li>
                <li><a href="{$conf->action_root}viewSettings"><i class="fa fa-cog"></i> Ustawienia</a></li>
                <li class="divider"></li>
                <li><a href="{$conf->action_root}wyloguj"><i class="fa fa-power-off"></i> Wyloguj się</a></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>