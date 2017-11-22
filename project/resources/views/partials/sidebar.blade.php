<aside class="main-sidebar">
	<section class="sidebar">
		<ul class="sidebar-menu" data-widget="tree">
			<li class="header">NAVEGACIÓN PRINCIPAL</li>
			<li><a href="/"><i class="fa fa-home"></i> <span>Home</span></a></li>

			@if(\Auth::user()->Administrador())

			<li class="treeview">
				<a href="#">
					<i class="fa fa-search"></i> <span>Buscar</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="#"><i class="fa fa-archive"></i>Proyectos</a></li>
					<li><a href="#"><i class="fa fa-users"></i>Usuarios</a></li>
				</ul>
			</li>

			<li class="treeview">
				<a href="#">
					<i class="fa fa-users"></i> <span>Usuarios</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="persona/index"><i class="fa fa-eye"></i> Ver todos</a></li>
					<li><a href="persona/create"><i class="fa fa-plus"></i> Agregar</a></li>
					<li><a href="#"><i class="fa fa-plus"></i> Cargar Masivamente</a></li>
				</ul>
			</li>

			<li class="treeview">
				<a href="#">
					<i class="fa fa-bar-chart"></i> <span>Estadisticas</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="#"><i class="fa fa-eye"></i> Ver todas</a></li>
				</ul>
			</li>

			@elseif(\Auth::user()->Funcionario())

			@elseif(\Auth::user()->ProfesorGuia())

			<li class="treeview">
				<a href="#">
					<i class="fa fa-lightbulb-o"></i> <span>Proyectos</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="/index"><i class="fa fa-eye"></i> Ver todos</a></li>
					<li><a href="proyecto/create"><i class="fa fa-plus"></i> Agregar</a></li>
				</ul>
			</li>

			<li class="treeview">
				<a href="#">
					<i class="fa fa-users"></i> <span>Usuarios</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="#"><i class="fa fa-eye"></i> Ver todos</a></li>
					<li><a href="#"><i class="fa fa-plus"></i> Agregar</a></li>
				</ul>
			</li>

			@elseif(\Auth::user()->ProfesorCurso())

			@elseif(\Auth::user()->Estudiante())

			@elseif(\Auth::user()->Invitado())
			<li >
				<a href="#">
					<i class="fa fa-lightbulb-o"></i> <span>Proyecto</span>
					<span class="pull-right-container">
						
					</span>
				</a>

			</li>

			<li class="treeview">
				<a href="#">
					<i class="fa fa-users"></i> <span>Avance</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="#"><i class="fa fa-object-group"></i> Mockups </a></li>
					<li><a href="#"><i class="fa fa-archive"></i> Documentos </a></li>
				</ul>
			</li>
			@endif

			

		</ul>
	</section>
</aside>