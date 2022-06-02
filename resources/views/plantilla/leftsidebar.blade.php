<div class="left-side-menu">

    <div class="h-100" data-simplebar>

        <!-- User box -->
        <div class="user-box text-center">
            <img src="{{ asset('dashboard/images/users/user-1.jpg') }}" alt="user-img" title="Mat Helme" class="rounded-circle avatar-md">
            <div class="dropdown">
                <a href="javascript: void(0);" class="text-dark dropdown-toggle h5 mt-2 mb-1 d-block" data-bs-toggle="dropdown">
                    @php
                    $apellidos = Auth::user()->surnames;
                    $posicion_espacio=strpos($apellidos, " ");
                    $apellido1=substr($apellidos,0,$posicion_espacio);
                    $nombres = Auth::user()->name;
                    $posicion_espacios=strpos($nombres, " ");
                    $nombre1=substr($nombres,0,$posicion_espacios);
                    echo $apellido1.' '.$nombre1;
                    @endphp
                    <!-- {{ Auth::user()->name }} -->
                </a>
                <div class="dropdown-menu user-pro-dropdown">

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-user me-1"></i>
                        <span>My Account</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-settings me-1"></i>
                        <span>Settings</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-lock me-1"></i>
                        <span>Lock Screen</span>
                    </a>

                    <!-- item-->
                    <a href="{{ route('logout') }}" class="dropdown-item notify-item" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="fe-log-out me-1"></i>
                        <span>Cerrar sesión</span>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
            @can('administrador')
            <p class="text-muted">Administrador</p>
            @endcan
            @can('recepcionista')
            <p class="text-muted">Recepcionista</p>
            @endcan
            @can('servicio')
            <p class="text-muted">Servicio</p>
            @endcan
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul id="side-menu">

                <li class="menu-title">Administrador</li>

                @can('administrador')
                <li>
                    <a href="#">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span> Dashboard </span>
                    </a>
                </li>
                <li>
                    <a href="#sidebarUsuarios" data-bs-toggle="collapse">
                        <i class="mdi mdi-badge-account-horizontal-outline"></i>
                        <span> Usuarios </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarUsuarios">
                        <ul class="nav-second-level">
                            <li>
                                <a href="#">Rol de usuario</a>
                            </li>
                            <li>
                                <a href="#">Usuario</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#sidebarContabilidad" data-bs-toggle="collapse">
                        <i class="mdi mdi-chart-line"></i>
                        <span> Contabilidad </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarContabilidad">
                        <ul class="nav-second-level">
                            <li @click="menu=0">
                                <a href="#">Ingresos</a>
                            </li>
                            <li @click="menu=1">
                                <a href="#">Egresos</a>
                            </li>
                            <li @click="menu=2">
                                <a href="#">Forma de pago</a>
                            </li>
                            <li @click="menu=3"> 
                                <a href="#">Tipo de cliente</a>
                            </li>
                            <li @click="menu=4">
                                <a href="#">Emisión de recibo</a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endcan
                <li class="menu-title mt-2">Mantenimiento</li>
                <li>
                    <a href="#sidebarAlmacen" data-bs-toggle="collapse">
                        <i class="mdi mdi-archive-outline"></i>
                        <span> Almacen </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarAlmacen">
                        <ul class="nav-second-level">
                            <li @click="menu=5">
                                <a href="#">Tipo de utensilio</a>
                            </li>
                            <li @click="menu=6">
                                <a href="#">Utensilio</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#sidebarTours" data-bs-toggle="collapse">
                        <i class="mdi mdi-map-marker-multiple-outline"></i>
                        <span> Tours </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarTours">
                        <ul class="nav-second-level">
                            <li @click="menu=7">
                                <a href="#">Empresa</a>
                            </li>
                            <li @click="menu=8">
                                <a href="#">Tour</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#sidebarHabitacion" data-bs-toggle="collapse">
                        <i class="mdi mdi-bed-king-outline"></i>
                        <span> Habitaciones </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarHabitacion">
                        <ul class="nav-second-level">
                            <li @click="menu=9">
                                <a href="#">Tipo de habitacion</a>
                            </li>
                            <li @click="menu=10">
                                <a href="#">habitacion</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#sidebarDisnpensa" data-bs-toggle="collapse">
                        <i class="mdi mdi-food-apple-outline"></i>
                        <span> Dispensa </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarDisnpensa">
                        <ul class="nav-second-level">
                            <li @click="menu=11">
                                <a href="#">Categoria de dispensa</a>
                            </li>
                            <li @click="menu=12">
                                <a href="#">dispensa</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#sidebarClientes" data-bs-toggle="collapse">                        
                        <i class="mdi mdi-account-multiple-outline"></i>
                        <span> Clientes </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarClientes">
                        <ul class="nav-second-level">
                            <li @click="menu=13">
                                <a href="#">Clientes</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="menu-title mt-2">Hostel</li>
                <li>
                    <a href="#sidebarReservacion" data-bs-toggle="collapse">
                        <i class="mdi mdi-home-city-outline"></i>
                        <span> Reservaciones </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarReservacion">
                        <ul class="nav-second-level">
                            <li @click="menu=14">
                                <a href="#">Reservación</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#sidebarHospedaje" data-bs-toggle="collapse">
                        <i class="mdi mdi-bed-outline"></i>
                        <span> Hospedajes </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarHospedaje">
                        <ul class="nav-second-level">
                            <li @click="menu=15">
                                <a href="#">Hospedaje</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="menu-title mt-2">Reportes</li>
                <li>
                    <a href="#sidebarRAdministracion" data-bs-toggle="collapse">
                        <i class="mdi mdi-chart-bell-curve"></i>
                        <span> Administración </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarRAdministracion">
                        <ul class="nav-second-level">
                            <li @click="menu=16">
                                <a href="#">R. Ingreso</a>
                            </li>
                            <li @click="menu=17">
                                <a href="#">R. Egreso</a>
                            </li>
                            <li @click="menu=18">
                                <a href="#">R. Factura</a>
                            </li>
                            <li @click="menu=19">
                                <a href="#">R. Boleta</a>
                            </li>
                            <li @click="menu=20">
                                <a href="#">R. General</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#sidebarRHospedaje" data-bs-toggle="collapse">
                        <i class="mdi mdi-bunk-bed-outline"></i>
                        <span> Hospedaje </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarRHospedaje">
                        <ul class="nav-second-level">
                            <li @click="menu=21">
                                <a href="#">R. Reservaciones</a>
                            </li>
                            <li @click="menu=22">
                                <a href="#">R. Hospedaje</a>
                            </li>                            
                            <li @click="menu=23">
                                <a href="#">R. Tour</a>
                            </li>                            
                            <li @click="menu=24">
                                <a href="#">R. Cliente</a>
                            </li>                            
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#sidebarRAlmacen" data-bs-toggle="collapse">
                        <i class="mdi mdi-warehouse"></i>
                        <span> Almacen </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarRAlmacen">
                        <ul class="nav-second-level">
                            <li @click="menu=25">
                                <a href="#">R. Inventario</a>
                            </li>
                            <li @click="menu=26">
                                <a href="#">R. Dispensa</a>
                            </li>                     
                        </ul>
                    </div>
                </li>
                <li class="menu-title mt-2">Configuración</li>
                <li>
                    <a href="#sidebarMicuenta" data-bs-toggle="collapse">
                        <i class="mdi mdi-badge-account-outline"></i>
                        <span> Mi cuenta </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarMicuenta">
                        <ul class="nav-second-level">
                            <li @click="menu=27">
                                <a href="#">Mi perfil</a>
                            </li>
                        </ul>
                        <ul class="nav-second-level">
                            <li @click="menu=28">
                                <a href="#">Cambiar contraseña</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="mdi mdi-logout"></i>
                        <span> Cerrar sesión </span>
                    </a>     
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>

            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>