<aside class="main-sidebar">
	<section class="sidebar">
		<ul class="sidebar-menu" data-widget="tree">
			<li class="header">NAVEGACIÓN PRINCIPAL</li>
			

			@if(\Auth::user()->Administrador())
			<li><a href="/"><i class="fa fa-home"></i> <span>Home</span></a></li>
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

			<li class="treeview">
				<a href="#">
					<i class="fa fa-users"></i> <span>Estudiantes</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="#"><i class="fa fa-eye"></i> Formulación</a></li>
					<li><a href="#"><i class="fa fa-eye"></i> Proyecto</a></li>
					<li><a href="#"><i class="fa fa-eye"></i> Egresados</a></li>
					<li><a href="#"><i class="fa fa-eye"></i> Congelados</a></li>
				</ul>
			</li>

			<li class="treeview">
				<a href="#">
					<i class="fa fa-lightbulb-o"></i> <span>Proyectos</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="/index"><i class="fa fa-eye"></i> Ver todos</a></li>
					<li><a href="/index"><i class="fa fa-eye"></i> Buscar por</a></li>
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
					<li><a href="#"><i class="fa fa-eye"></i> Avance Proyectos</a></li>
					<li><a href="#"><i class="fa fa-eye"></i> Egresados</a></li>
					<li><a href="#"><i class="fa fa-eye"></i> Formulación</a></li>
					<li><a href="#"><i class="fa fa-eye"></i> Proyecto</a></li>
				</ul>
			</li>

			<li class="treeview">
				<a href="#">
					<i class="fa fa-lightbulb-o"></i> <span> Información Extra</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li class="treeview"><a href="#"><i class="fa fa-eye"></i> Empresas </a></li>
					
				</ul>
			</li>



			@elseif(\Auth::user()->ProfesorGuia())

			<li class="treeview">
				<a href="#">
					<i class="fa fa-users"></i> <span>Estudiantes</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="profesorguia/estudiantes"><i class="fa fa-eye"></i> Ver todos</a></li>
					<li><a href="#"><i class="fa fa-plus"></i> Agregar</a></li>
				</ul>
			</li>

			<li class="treeview">
				<a href="#">
					<i class="fa fa-lightbulb-o"></i> <span>Proyectos</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="/indexProfesorGuia"><i class="fa fa-eye"></i> Ver todos</a></li>
					<li><a href="proyecto/create"><i class="fa fa-plus"></i> Agregar</a></li>
				</ul>
			</li>
			<li><a href="#"><i class="fa fa-calendar"></i><span> Calendario </span></a></li>

			@elseif(\Auth::user()->ProfesorCurso())

			<li class="treeview">
				<a href="#">
					<i class="fa fa-users"></i> <span>Estudiantes</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="#"><i class="fa fa-eye"></i> Ver todos</a></li>
					<li><a href="#"><i class="fa fa-plus"></i> Agregar</a></li>
				</ul>
			</li>

			<li><a href="#"><i class="fa fa-calendar"></i><span> Proyectos </span></a></li>

			@elseif(\Auth::user()->Estudiante())
			<li><a href="/estudiante/index"><i class="fa fa-home"></i> <span>Home</span></a></li>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-map-signs"></i> <span>Hitos</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="/indexHito"><i class="fa fa-eye"></i> Ver todos</a></li>
					<li><a href="/hito/create"><i class="fa fa-plus"></i> Agregar</a></li>
				</ul>
			</li>

			<li class="treeview">
				<a href="#">
					<i class="fa fa-tasks"></i> <span>Tareas</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="/indexTarea"><i class="fa fa-eye"></i> Ver todos</a></li>
					<li><a href="/tarea/create"><i class="fa fa-plus"></i> Agregar</a></li>
				</ul>
			</li>

			<li class="treeview">
				<a href="#">
					<i class="fa fa-hand-pointer-o"></i> <span>Entregables</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="/indexEntregable"><i class="fa fa-eye"></i> Ver todos</a></li>
					<li><a href="/entregable/create2"><i class="fa fa-plus"></i> Agregar</a></li>
				</ul>
			</li>

			<li class="treeview">
				<a href="#">
					<i class="fa fa-archive"></i> <span>Documentos</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="#"><i class="fa fa-eye"></i> Ver todos</a></li>
					<li><a href="#"><i class="fa fa-plus"></i> Agregar</a></li>
				</ul>
			</li>

			<li class="treeview">
				<a href="#">
					<i class="fa fa-bar-chart"></i> <span>Estadistica</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="#"><i class="fa fa-eye"></i> Semanal </a></li>
					<li><a href="#"><i class="fa fa-eye"></i> Mensual </a></li>
				</ul>
			</li>

			<li><a href="#"><i class="fa fa-calendar"></i><span> Calendario </span></a></li>
			<li><a href="#"><i class="fa fa-users"></i><span> Participantes </span></a></li>

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