<!--if logged in-->

<div class="navbar navbar-default" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Menu</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">SkillQuest</a>
    </div>
    <div class="collapse navbar-collapse">
       <ul class="nav navbar-nav navbar-right">
        <li><a href="#">About</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Hi, <span>{{ Session::get('user.name')[0] }}</span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="/profile">My Profile</a></li>
            <li><a href="#">Settings</a></li>
            <li class="divider"></li>
            <li><a href="/logout">Log out</a></li>
          </ul>
        </li>
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</div>