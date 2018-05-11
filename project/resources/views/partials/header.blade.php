<header class="main-header">
	<a href="#" class="logo">
		<span class="logo-mini"><b>SGC</b></span>
		<span class="logo-lg"><b>SGC</b> Proyectos</span>
	</a>
	<nav class="navbar navbar-static-top">
		<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
			<span class="sr-only">Toggle navigation</span>
		</a>

		<div class="navbar-custom-menu">
			<ul class="nav navbar-nav">

				<li class="dropdown notifications-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-bell-o"></i>
						<span class="label label-warning">10</span>
					</a>
					<ul class="dropdown-menu">
						<li class="header">You have 10 notifications</li>
						<li>
							<ul class="menu">
								<li>
									<a href="#">
										<i class="fa fa-users text-aqua"></i> 5 new members joined today
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
										page and may cause design problems
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fa fa-users text-red"></i> 5 new members joined
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fa fa-shopping-cart text-green"></i> 25 sales made
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fa fa-user text-red"></i> You changed your username
									</a>
								</li>
							</ul>
						</li>
						<li class="footer"><a href="#">View all</a></li>
					</ul>
				</li>

				<li class="dropdown notifications-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						
						@if(Auth::user()->rol_id == 1)
						<div class="avatar-circle in-purple">
							<span class="initials">A</span>
						</div>
						@elseif(Auth::user()->rol_id == 2)
						<div class="avatar-circle in-green">
							<span class="initials">F</span>
						</div>
						@elseif(Auth::user()->rol_id == 3)
						<div class="avatar-circle in-orange">
							<span class="initials">PG</span>
						</div>
						@elseif(Auth::user()->rol_id == 4)
						<div class="avatar-circle in-red">
							<span class="initials">PC</span>
						</div>
						@elseif(Auth::user()->rol_id == 5)
						<div class="avatar-circle in-yellow">
							<span class="initials">E</span>
						</div>
						@elseif(Auth::user()->rol_id == 6)
						<div class="avatar-circle in-pink">
							<span class="initials">I</span>
						</div>
						@endif
						<span class="hidden-xs"> {{ Auth::user()->email }}</span>
					</a>
					<ul class="dropdown-menu">
						<li class="header text-center">
							@if(Auth::user()->rol_id == 1)
								<span class="hidden-xs">Administrador</span>
							@elseif(Auth::user()->rol_id == 2)
								<span class="hidden-xs">Funcionario</span>
							@elseif(Auth::user()->rol_id == 3)
								<span class="hidden-xs">Profesor Guía</span>
							@elseif(Auth::user()->rol_id == 4)
								<span class="hidden-xs">Profesor Curso</span>
							@elseif(Auth::user()->rol_id == 5)
								<span class="hidden-xs">Estudiante</span>
							@elseif(Auth::user()->rol_id == 6)
								<span class="hidden-xs">Invitado</span>
							@endif
						</li>
						<li style="height: auto;">
							<ul class="menu" style="height: auto;">
								@if(Auth::user()->roles->count() > 1)
								<li>
									<a href="/pick_role"><i class="fa fa-vcard-o"></i> Seleccionar Rol</a>
								</li>
								@endif
                            	<li>
                                    <a href="#"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-out"></i> Cerrar Sesión
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
							</ul>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>
</header>