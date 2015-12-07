﻿	
	<!-- NABAR HEADER -->
    <div class="navbar-header">
      <a class="navbar-brand" id="trigger">Elomondo</a>
    </div>
  
    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">
      
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
                <span class="pull-left">
                  <img class="media-object" src="http://placehold.it/50x50" alt="">
                                      </span>
                <div class="media-body">
                  <h5 class="media-heading">
                    <strong>John Smith</strong>
                  </h5>
                  <p class="small text-muted">
                    <i class="fa fa-clock-o"></i> Yesterday at 4:32 PM
                  </p>
                  <p>Lorem ipsum dolor sit amet, consectetur...</p>
                </div>
              </div>
            </a>
          </li>
          <li class="message-preview">
            <a href="#">
              <div class="media">
                <span class="pull-left">
                  <img class="media-object" src="http://placehold.it/50x50" alt="">
                                      </span>
                <div class="media-body">
                  <h5 class="media-heading">
                    <strong>John Smith</strong>
                  </h5>
                  <p class="small text-muted">
                    <i class="fa fa-clock-o"></i> Yesterday at 4:32 PM
                  </p>
                  <p>Lorem ipsum dolor sit amet, consectetur...</p>
                </div>
              </div>
            </a>
          </li>
          <li class="message-preview">
            <a href="#">
              <div class="media">
                <span class="pull-left">
                  <img class="media-object" src="http://placehold.it/50x50" alt="">
                                      </span>
                <div class="media-body">
                  <h5 class="media-heading">
                    <strong>John Smith</strong>
                  </h5>
                  <p class="small text-muted">
                    <i class="fa fa-clock-o"></i> Yesterday at 4:32 PM
                  </p>
                  <p>Lorem ipsum dolor sit amet, consectetur...</p>
                </div>
              </div>
            </a>
          </li>
          <li class="message-footer">
            <a href="#">Read All New Messages</a>
          </li>
        </ul>
      </li>

      <!-- ALERT -->
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
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
              Alert Name <span class="label label-primary">Alert Badge</span>
            </a>
          </li>
          <li>
            <a href="#">
              Alert Name <span class="label label-success">Alert Badge</span>
            </a>
          </li>
          <li>
            <a href="#">
              Alert Name <span class="label label-info">Alert Badge</span>
            </a>
          </li>
          <li>
            <a href="#">
              Alert Name <span class="label label-warning">Alert Badge</span>
            </a>
          </li>
          <li>
            <a href="#">
              Alert Name <span class="label label-danger">Alert Badge</span>
            </a>
          </li>
          <li class="divider"></li>
          <li>
            <a href="#">View All</a>
          </li>
        </ul>
      </li>

      <!-- USER MENU -->
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <i class="fa fa-user"></i> {$usr_data['username']} <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
          <li>
            <a href="{$conf->action_root}main">
              <i class="fa fa-fw fa-envelope"></i> Home
            </a>
          </li>
          <li>
            <a href="{$conf->action_root}viewProfile">
              <i class="fa fa-fw fa-user"></i> Profile
            </a>
          </li>
          <li>
            <a href="{$conf->action_root}viewSettings">
              <i class="fa fa-fw fa-gear"></i> Settings
            </a>
          </li>
          <li class="divider"></li>
          <li>
            <a href="/Trening/app/ctrl.php?action=wyloguj">
              <i class="fa fa-fw fa-power-off"></i> Log Out
            </a>
          </li>
        </ul>
      </li>
    </ul>
  
    <!-- LEFT SLIDE MENU -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
      <ul class="nav navbar-nav side-nav navbar_hide" id="nav_right">
        
        <li class="active">
          <a href="index.html">
            <i class="fa fa-fw fa-dashboard"></i> Dashboard
          </a>
        </li>
        
        <li>
          <a href="charts.html">
            <i class="fa fa-fw fa-bar-chart-o"></i> Charts
          </a>
        </li>
        
        <li>
          <a href="tables.html">
            <i class="fa fa-fw fa-table"></i> Tables
          </a>
        </li>
        
        <li>
          <a href="forms.html">
            <i class="fa fa-fw fa-edit"></i> Forms
          </a>
        </li>
        
        <li>
          <a href="bootstrap-elements.html">
            <i class="fa fa-fw fa-desktop"></i> Bootstrap Elements
          </a>
        </li>
        
        <li>
          <a href="bootstrap-grid.html">
            <i class="fa fa-fw fa-wrench"></i> Bootstrap Grid
          </a>
        </li>
        
        <li>
          <a href="javascript:;" data-toggle="collapse" data-target="#demo">
            <i class="fa fa-fw fa-arrows-v"></i> Dropdown <i class="fa fa-fw fa-caret-down"></i>
          </a>
          <ul id="demo" class="collapse">
            <li>
              <a href="#">Dropdown Item</a>
            </li>
            <li>
              <a href="#">Dropdown Item</a>
            </li>
          </ul>
        </li>
        
        <li>
          <a href="blank-page.html">
            <i class="fa fa-fw fa-file"></i> Blank Page
          </a>
        </li>
        
        <li>
          <a href="index-rtl.html">
            <i class="fa fa-fw fa-dashboard"></i> RTL Dashboard
          </a>
        </li>
        
      </ul>
    </div> 