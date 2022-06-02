<template>

  <div class="container-fluid">
    <loading :active.sync="isLoading"
    :can-cancel="true"
    :is-full-page="fullPage">
    </loading>
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">

                <h4 class="page-title">Hospedaje </h4>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-md-flex justify-content-between align-items-center">
                                <h4 class="page-title">Habitaciones </h4>
                                <div class="mt-2 mt-md-0">
                                    <button type="submit" class="btn btn-sm btn-white"><i class="mdi mdi-view-grid"></i></button>
                                    <button type="submit" class="btn btn-sm btn-white"><i class="mdi mdi-format-list-bulleted"></i></button>
                                </div>
                            </div>

                            <br>
                            <br>
                            <div class="col-12">

                                <!-- Filter -->
                                <div class="row">
                                    <div class="col-12">
                                        <div class="text-center filter-menu">
                                            <a href="javascript: void(0);" :class="{'filter-menu-item active' : ac_todos}" data-rel="all" @click="menuHabitacion(1)">Todos</a>
                                            <a href="javascript: void(0);" :class="{'filter-menu-item active' : ac_disponible}" data-rel="web" @click="menuHabitacion(2)">Disponible</a>
                                            <a href="javascript: void(0);" :class="{'filter-menu-item active' : ac_ocupado}" data-rel="graphic" @click="menuHabitacion(3)">Ocupado</a>
                                            <a href="javascript: void(0);" :class="{'filter-menu-item active' : ac_limpieza}" data-rel="illustrator" @click="menuHabitacion(4)">Limpieza</a>
                                            <a href="javascript: void(0);" :class="{'filter-menu-item active' : ac_mantenimiento}" data-rel="photography" @click="menuHabitacion(5)">Mantenimiento</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="row filterable-content">

                                        <div v-if="acn_todos || acn_ocupado" class="col-sm-6 col-xl-3" >
                                            <div class="card project-box" :style="{ backgroundColor: acc_ocupado}">
                                                <div class="card-body">
                                                    <div class="dropdown float-end">
                                                        <a href="#" class="dropdown-toggle card-drop arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="mdi mdi-dots-horizontal m-0 text-muted h3"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle"></i> Nuevo</a>
                                                            <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle"></i> Editar</a>
                                                            <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle"></i> Detalle</a>
                                                            <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle"></i> Dispensa</a>
                                                            <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle"></i> Estado</a>
                                                        </div>
                                                    </div> <!-- end dropdown -->
                                                    <!-- Title-->
                                                    <h4 class="mt-0"><a href="project-detail.html" class="text-dark">Habitación N° 202</a></h4>
                                                    <p class="text-muted text-uppercase"><i class="mdi mdi-account-circle"></i> <small>Matrimonial</small></p>
                                                    <div class="badge bg-soft-success text-success mb-3">Ocupado</div>
                                                    <div class="dropdown-divider"></div>
                                                    <br>
                                                    <div class="d-flex justify-content-between">
                                                        <!-- Desc-->
                                                        <div class="text-center">
                                                            <p class="fw-bold text-muted">Pagó</p>
                                                            <p class="text-muted font-13 mb-3 sp-line-2">
                                                                S/. 200.00
                                                            </p>
                                                        </div>
                                                        <div class="text-center">
                                                            <p class="fw-bold text-muted">Vuelto</p>
                                                            <p class="text-muted font-13 mb-3 sp-line-2">
                                                                S/. 30.00
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="dropdown-divider"></div>
                                                    <br>
                                                    <div class="d-flex justify-content-between">
                                                        <!-- Desc-->
                                                        <div class="text-center">
                                                            <p class="fw-bold text-muted">Debe</p>
                                                            <p class="text-muted font-13 mb-3 sp-line-2">
                                                                S/. 50.00
                                                            </p>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div> <!-- end card box-->
                                        </div><!-- end col-->

                                        <div v-if="acn_todos || acn_disponible" class="col-sm-6 col-xl-3 filter-item all web illustrator">
                                             <div class="card project-box" :style="{ backgroundColor: acc_disponible}">
                                                <div class="card-body">
                                                    <div class="dropdown float-end">
                                                        <a href="#" class="dropdown-toggle card-drop arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="mdi mdi-dots-horizontal m-0 text-muted h3"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle"></i> Nuevo</a>
                                                            <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle"></i> Editar</a>
                                                            <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle"></i> Detalle</a>
                                                            <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle"></i> Dispensa</a>
                                                            <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle"></i> Estado</a>
                                                        </div>
                                                    </div> <!-- end dropdown -->
                                                    <!-- Title-->
                                                    <h4 class="mt-0"><a href="project-detail.html" class="text-dark">Habitación N° 202</a></h4>
                                                    <p class="text-muted text-uppercase"><i class="mdi mdi-account-circle"></i> <small>Matrimonial</small></p>
                                                    <div class="badge bg-soft-success text-success mb-3">Ocupado</div>
                                                    <div class="dropdown-divider"></div>
                                                    <br>
                                                    <div class="d-flex justify-content-between">
                                                        <!-- Desc-->
                                                        <div class="text-center">
                                                            <p class="fw-bold text-muted">Pagó</p>
                                                            <p class="text-muted font-13 mb-3 sp-line-2">
                                                                S/. 200.00
                                                            </p>
                                                        </div>
                                                        <div class="text-center">
                                                            <p class="fw-bold text-muted">Vuelto</p>
                                                            <p class="text-muted font-13 mb-3 sp-line-2">
                                                                S/. 30.00
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="dropdown-divider"></div>
                                                    <br>
                                                    <div class="d-flex justify-content-between">
                                                        <!-- Desc-->
                                                        <div class="text-center">
                                                            <p class="fw-bold text-muted">Debe</p>
                                                            <p class="text-muted font-13 mb-3 sp-line-2">
                                                                S/. 50.00
                                                            </p>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div> <!-- end card box-->
                                        </div> <!-- end col -->

                                        <div v-if="acn_todos || acn_disponible" class="col-sm-6 col-xl-3 filter-item all web illustrator">
                                             <div class="card project-box" :style="{ backgroundColor: acc_disponible}">
                                                <div class="card-body">
                                                    <div class="dropdown float-end">
                                                        <a href="#" class="dropdown-toggle card-drop arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="mdi mdi-dots-horizontal m-0 text-muted h3"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle"></i> Nuevo</a>
                                                            <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle"></i> Editar</a>
                                                            <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle"></i> Detalle</a>
                                                            <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle"></i> Dispensa</a>
                                                            <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle"></i> Estado</a>
                                                        </div>
                                                    </div> <!-- end dropdown -->
                                                    <!-- Title-->
                                                    <h4 class="mt-0"><a href="project-detail.html" class="text-dark">Habitación N° 202</a></h4>
                                                    <p class="text-muted text-uppercase"><i class="mdi mdi-account-circle"></i> <small>Matrimonial</small></p>
                                                    <div class="badge bg-soft-success text-success mb-3">Ocupado</div>
                                                    <div class="dropdown-divider"></div>
                                                    <br>
                                                    <div class="d-flex justify-content-between">
                                                        <!-- Desc-->
                                                        <div class="text-center">
                                                            <p class="fw-bold text-muted">Pagó</p>
                                                            <p class="text-muted font-13 mb-3 sp-line-2">
                                                                S/. 200.00
                                                            </p>
                                                        </div>
                                                        <div class="text-center">
                                                            <p class="fw-bold text-muted">Vuelto</p>
                                                            <p class="text-muted font-13 mb-3 sp-line-2">
                                                                S/. 30.00
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="dropdown-divider"></div>
                                                    <br>
                                                    <div class="d-flex justify-content-between">
                                                        <!-- Desc-->
                                                        <div class="text-center">
                                                            <p class="fw-bold text-muted">Debe</p>
                                                            <p class="text-muted font-13 mb-3 sp-line-2">
                                                                S/. 50.00
                                                            </p>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div> <!-- end card box-->
                                        </div> <!-- end col -->

                                        <div v-if="acn_todos || acn_ocupado" class="col-sm-6 col-xl-3 filter-item all web illustrator">
                                             <div class="card project-box" :style="{ backgroundColor: acc_ocupado}">
                                                <div class="card-body">
                                                    <div class="dropdown float-end">
                                                        <a href="#" class="dropdown-toggle card-drop arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="mdi mdi-dots-horizontal m-0 text-muted h3"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle"></i> Nuevo</a>
                                                            <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle"></i> Editar</a>
                                                            <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle"></i> Detalle</a>
                                                            <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle"></i> Dispensa</a>
                                                            <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle"></i> Estado</a>
                                                        </div>
                                                    </div> <!-- end dropdown -->
                                                    <!-- Title-->
                                                    <h4 class="mt-0"><a href="project-detail.html" class="text-dark">Habitación N° 202</a></h4>
                                                    <p class="text-muted text-uppercase"><i class="mdi mdi-account-circle"></i> <small>Matrimonial</small></p>
                                                    <div class="badge bg-soft-success text-success mb-3">Ocupado</div>
                                                    <div class="dropdown-divider"></div>
                                                    <br>
                                                    <div class="d-flex justify-content-between">
                                                        <!-- Desc-->
                                                        <div class="text-center">
                                                            <p class="fw-bold text-muted">Pagó</p>
                                                            <p class="text-muted font-13 mb-3 sp-line-2">
                                                                S/. 200.00
                                                            </p>
                                                        </div>
                                                        <div class="text-center">
                                                            <p class="fw-bold text-muted">Vuelto</p>
                                                            <p class="text-muted font-13 mb-3 sp-line-2">
                                                                S/. 30.00
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="dropdown-divider"></div>
                                                    <br>
                                                    <div class="d-flex justify-content-between">
                                                        <!-- Desc-->
                                                        <div class="text-center">
                                                            <p class="fw-bold text-muted">Debe</p>
                                                            <p class="text-muted font-13 mb-3 sp-line-2">
                                                                S/. 50.00
                                                            </p>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div> <!-- end card box-->
                                        </div> <!-- end col -->

                                        <div v-if="acn_todos || acn_ocupado" class="col-sm-6 col-xl-3 filter-item all web illustrator">
                                             <div class="card project-box" :style="{ backgroundColor: acc_ocupado}">
                                                <div class="card-body">
                                                    <div class="dropdown float-end">
                                                        <a href="#" class="dropdown-toggle card-drop arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="mdi mdi-dots-horizontal m-0 text-muted h3"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle"></i> Nuevo</a>
                                                            <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle"></i> Editar</a>
                                                            <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle"></i> Detalle</a>
                                                            <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle"></i> Dispensa</a>
                                                            <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle"></i> Estado</a>
                                                        </div>
                                                    </div> <!-- end dropdown -->
                                                    <!-- Title-->
                                                    <h4 class="mt-0"><a href="project-detail.html" class="text-dark">Habitación N° 202</a></h4>
                                                    <p class="text-muted text-uppercase"><i class="mdi mdi-account-circle"></i> <small>Matrimonial</small></p>
                                                    <div class="badge bg-soft-success text-success mb-3">Ocupado</div>
                                                    <div class="dropdown-divider"></div>
                                                    <br>
                                                    <div class="d-flex justify-content-between">
                                                        <!-- Desc-->
                                                        <div class="text-center">
                                                            <p class="fw-bold text-muted">Pagó</p>
                                                            <p class="text-muted font-13 mb-3 sp-line-2">
                                                                S/. 200.00
                                                            </p>
                                                        </div>
                                                        <div class="text-center">
                                                            <p class="fw-bold text-muted">Vuelto</p>
                                                            <p class="text-muted font-13 mb-3 sp-line-2">
                                                                S/. 30.00
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="dropdown-divider"></div>
                                                    <br>
                                                    <div class="d-flex justify-content-between">
                                                        <!-- Desc-->
                                                        <div class="text-center">
                                                            <p class="fw-bold text-muted">Debe</p>
                                                            <p class="text-muted font-13 mb-3 sp-line-2">
                                                                S/. 50.00
                                                            </p>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div> <!-- end card box-->
                                        </div> <!-- end col -->

                                        <div v-if="acn_todos || acn_limpieza" class="col-sm-6 col-xl-3 filter-item all web illustrator">
                                             <div class="card project-box" :style="{ backgroundColor: acc_limpieza}">
                                                <div class="card-body">
                                                    <div class="dropdown float-end">
                                                        <a href="#" class="dropdown-toggle card-drop arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="mdi mdi-dots-horizontal m-0 text-muted h3"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle"></i> Nuevo</a>
                                                            <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle"></i> Editar</a>
                                                            <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle"></i> Detalle</a>
                                                            <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle"></i> Dispensa</a>
                                                            <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle"></i> Estado</a>
                                                        </div>
                                                    </div> <!-- end dropdown -->
                                                    <!-- Title-->
                                                    <h4 class="mt-0"><a href="project-detail.html" class="text-dark">Habitación N° 202</a></h4>
                                                    <p class="text-muted text-uppercase"><i class="mdi mdi-account-circle"></i> <small>Matrimonial</small></p>
                                                    <div class="badge bg-soft-success text-success mb-3">Ocupado</div>
                                                    <div class="dropdown-divider"></div>
                                                    <br>
                                                    <div class="d-flex justify-content-between">
                                                        <!-- Desc-->
                                                        <div class="text-center">
                                                            <p class="fw-bold text-muted">Pagó</p>
                                                            <p class="text-muted font-13 mb-3 sp-line-2">
                                                                S/. 200.00
                                                            </p>
                                                        </div>
                                                        <div class="text-center">
                                                            <p class="fw-bold text-muted">Vuelto</p>
                                                            <p class="text-muted font-13 mb-3 sp-line-2">
                                                                S/. 30.00
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="dropdown-divider"></div>
                                                    <br>
                                                    <div class="d-flex justify-content-between">
                                                        <!-- Desc-->
                                                        <div class="text-center">
                                                            <p class="fw-bold text-muted">Debe</p>
                                                            <p class="text-muted font-13 mb-3 sp-line-2">
                                                                S/. 50.00
                                                            </p>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div> <!-- end card box-->
                                        </div> <!-- end col -->

                                        <div v-if="acn_todos || acn_limpieza" class="col-sm-6 col-xl-3 filter-item all web illustrator">
                                             <div class="card project-box" :style="{ backgroundColor: acc_limpieza}">
                                                <div class="card-body">
                                                    <div class="dropdown float-end">
                                                        <a href="#" class="dropdown-toggle card-drop arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="mdi mdi-dots-horizontal m-0 text-muted h3"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle"></i> Nuevo</a>
                                                            <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle"></i> Editar</a>
                                                            <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle"></i> Detalle</a>
                                                            <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle"></i> Dispensa</a>
                                                            <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle"></i> Estado</a>
                                                        </div>
                                                    </div> <!-- end dropdown -->
                                                    <!-- Title-->
                                                    <h4 class="mt-0"><a href="project-detail.html" class="text-dark">Habitación N° 202</a></h4>
                                                    <p class="text-muted text-uppercase"><i class="mdi mdi-account-circle"></i> <small>Matrimonial</small></p>
                                                    <div class="badge bg-soft-success text-success mb-3">Ocupado</div>
                                                    <div class="dropdown-divider"></div>
                                                    <br>
                                                    <div class="d-flex justify-content-between">
                                                        <!-- Desc-->
                                                        <div class="text-center">
                                                            <p class="fw-bold text-muted">Pagó</p>
                                                            <p class="text-muted font-13 mb-3 sp-line-2">
                                                                S/. 200.00
                                                            </p>
                                                        </div>
                                                        <div class="text-center">
                                                            <p class="fw-bold text-muted">Vuelto</p>
                                                            <p class="text-muted font-13 mb-3 sp-line-2">
                                                                S/. 30.00
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="dropdown-divider"></div>
                                                    <br>
                                                    <div class="d-flex justify-content-between">
                                                        <!-- Desc-->
                                                        <div class="text-center">
                                                            <p class="fw-bold text-muted">Debe</p>
                                                            <p class="text-muted font-13 mb-3 sp-line-2">
                                                                S/. 50.00
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- end card box-->
                                        </div> <!-- end col -->

                                        <div v-if="acn_todos || acn_mantenimiento" class="col-sm-6 col-xl-3 filter-item all web illustrator">
                                             <div class="card project-box" :style="{ backgroundColor: acc_mantenimiento}">
                                                <div class="card-body">
                                                    <div class="dropdown float-end">
                                                        <a href="#" class="dropdown-toggle card-drop arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="mdi mdi-dots-horizontal m-0 text-muted h3"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle"></i> Nuevo</a>
                                                            <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle"></i> Editar</a>
                                                            <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle"></i> Detalle</a>
                                                            <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle"></i> Dispensa</a>
                                                            <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle"></i> Estado</a>
                                                        </div>
                                                    </div> <!-- end dropdown -->
                                                    <!-- Title-->
                                                    <h4 class="mt-0"><a href="project-detail.html" class="text-dark">Habitación N° 202</a></h4>
                                                    <p class="text-muted text-uppercase"><i class="mdi mdi-account-circle"></i> <small>Matrimonial</small></p>
                                                    <div class="badge bg-soft-success text-success mb-3">Ocupado</div>
                                                    <div class="dropdown-divider"></div>
                                                    <br>
                                                    <div class="d-flex justify-content-between">
                                                        <!-- Desc-->
                                                        <div class="text-center">
                                                            <p class="fw-bold text-muted">Pagó</p>
                                                            <p class="text-muted font-13 mb-3 sp-line-2">
                                                                S/. 200.00
                                                            </p>
                                                        </div>
                                                        <div class="text-center">
                                                            <p class="fw-bold text-muted">Vuelto</p>
                                                            <p class="text-muted font-13 mb-3 sp-line-2">
                                                                S/. 30.00
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="dropdown-divider"></div>
                                                    <br>
                                                    <div class="d-flex justify-content-between">
                                                        <!-- Desc-->
                                                        <div class="text-center">
                                                            <p class="fw-bold text-muted">Debe</p>
                                                            <p class="text-muted font-13 mb-3 sp-line-2">
                                                                S/. 50.00
                                                            </p>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div> <!-- end card box-->
                                        </div> <!-- end col -->

                                        <div v-if="acn_todos || acn_mantenimiento" class="col-sm-6 col-xl-3 filter-item all web illustrator">
                                             <div class="card project-box" :style="{ backgroundColor: acc_mantenimiento}">
                                                <div class="card-body">
                                                    <div class="dropdown float-end">
                                                        <a href="#" class="dropdown-toggle card-drop arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="mdi mdi-dots-horizontal m-0 text-muted h3"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle"></i> Nuevo</a>
                                                            <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle"></i> Editar</a>
                                                            <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle"></i> Detalle</a>
                                                            <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle"></i> Dispensa</a>
                                                            <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle"></i> Estado</a>
                                                        </div>
                                                    </div> <!-- end dropdown -->
                                                    <!-- Title-->
                                                    <h4 class="mt-0"><a href="project-detail.html" class="text-dark">Habitación N° 202</a></h4>
                                                    <p class="text-muted text-uppercase"><i class="mdi mdi-account-circle"></i> <small>Matrimonial</small></p>
                                                    <div class="badge bg-soft-success text-success mb-3">Ocupado</div>
                                                    <div class="dropdown-divider"></div>
                                                    <br>
                                                    <div class="d-flex justify-content-between">
                                                        <!-- Desc-->
                                                        <div class="text-center">
                                                            <p class="fw-bold text-muted">Pagó</p>
                                                            <p class="text-muted font-13 mb-3 sp-line-2">
                                                                S/. 200.00
                                                            </p>
                                                        </div>
                                                        <div class="text-center">
                                                            <p class="fw-bold text-muted">Vuelto</p>
                                                            <p class="text-muted font-13 mb-3 sp-line-2">
                                                                S/. 30.00
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="dropdown-divider"></div>
                                                    <br>
                                                    <div class="d-flex justify-content-between">
                                                        <!-- Desc-->
                                                        <div class="text-center">
                                                            <p class="fw-bold text-muted">Debe</p>
                                                            <p class="text-muted font-13 mb-3 sp-line-2">
                                                                S/. 50.00
                                                            </p>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div> <!-- end card box-->
                                        </div> <!-- end col -->


                            </div>


                                <!-- end row-->


                            </div>
                            <br>


                        </div> <!-- end card-body -->
                    </div> <!-- end card -->
                </div><!-- end col -->
            </div>

        </div>
    </div>        <!-- end page title -->

    <!-- sample modal content -->

    <div id="con-close-modal" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" v-text="tituloModal"></h4>
                    <button type="button" class="btn-close"  @click="cerrarModal()" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <template v-if="tipoAccion==3">
                       <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="field-1" class="form-label">Apellidos y Nombres(Creador)</label>
                                    <input type="text" class="form-control" v-model="apnom" placeholder="Apellidos y nombres">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="field-1" class="form-label">Correo electrónico(Creador)</label>
                                    <input type="text" class="form-control" v-model="correo" placeholder="Correo Electrónico">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="field-4" class="form-label">Fecha y Hora(creación)</label>
                                    <input type="text" id="datetime-datepicker" class="form-control flatpickr-input active" v-model="fhorac" placeholder="Fecha y Hora">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="field-4" class="form-label">Fecha y Hora(editada)</label>
                                    <input type="text" id="datetime-datepicker" class="form-control flatpickr-input active" v-model="fhorae" placeholder="Fecha y Hora">
                                </div>
                            </div>
                            <hr>
                        </div>

                    </template>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="field-1" class="form-label">Fecha *</label>
                                <input type="date" class="form-control" v-model="fecha_ingreso" placeholder="Fecha">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="field-2" class="form-label">N° de Recibo</label>
                                <input type="text" class="form-control" v-model="nrecibo_ingreso" placeholder="N° de Recibo">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="field-3" class="form-label">Ingreso *</label>
                                <input type="text" class="form-control" v-model="nombre_ingreso" placeholder="Ingreso">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="field-4" class="form-label">Monto *</label>
                                <input type="number" class="form-control" v-model="monto_ingreso" placeholder="Monto">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="">
                                <label for="field-7" class="form-label">Descripción</label>
                                <textarea class="form-control" v-model="descripcion_ingreso" placeholder="Descripción"></textarea>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div v-show="errorIngreso" class="form-group row div-error">
                        <div class="text-center" style="color: red;">
                            <li v-for="error in errorMostrarMsjIngreso" :key="error" v-text="error">

                            </li>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" @click="cerrarModal()">Cancelar</button>
                    <button type="button" v-if="tipoAccion==1" @click="registrarIngreso()" class="btn btn-blue waves-effect waves-light">Guardar</button>
                    <button type="button" v-if="tipoAccion==2" @click="actualizarIngreso()" class="btn btn-blue waves-effect waves-light">Actualizar</button>
                </div>
            </div>
        </div>
    </div><!-- /.modal -->

</div> <!-- container -->

</template>

<script>
import Loading from 'vue-loading-overlay';
import datetime from 'node-datetime';
    import 'vue-loading-overlay/dist/vue-loading.css';
export default {
    components:{
        Loading
    },
  data () {
    return {
        id:0,
        id_user:0,
        fecha_ingreso:'',
        nombre_ingreso:'',
        descripcion_ingreso:'',
        nrecibo_ingreso:'',
        monto_ingreso:'',
        arrayIngreso:[],

        apnom:'',
        correo:'',
        fhorac:'',
        fhorae:'',

        ac_todos: true,
        ac_disponible: false,
        ac_ocupado: false,
        ac_limpieza: false,
        ac_mantenimiento: false,

        acn_todos: true,
        acn_disponible: false,
        acn_ocupado: false,
        acn_limpieza: false,
        acn_mantenimiento: false,

        acc_disponible: 'green',
        acc_ocupado: 'red',
        acc_limpieza: 'orange',
        acc_mantenimiento: 'yellow',

        tituloModal:'',
        tipoAccion : 0,
        errorIngreso : 0,
        errorMostrarMsjIngreso : [],
        pagination : {
            'total' : 0,
            'current_page' : 0,
            'per_page' : 0,
            'last_page' : 0,
            'from' : 0,
            'to' : 0,
        },
        offset : 3,
        criterio : 'nombre_ingreso',
        buscar : '',

        isLoading: false,
        fullPage: true,
    }
  },
  computed:{

        isActived: function(){
            return this.pagination.current_page;
        },
        //Calcula los elementos de la paginación
        pagesNumber: function() {
            if(!this.pagination.to) {
                return [];
            }

            var from = this.pagination.current_page - this.offset;
            if(from < 1) {
                from = 1;
            }

            var to = from + (this.offset * 2);
            if(to >= this.pagination.last_page){
                to = this.pagination.last_page;
            }

            var pagesArray = [];
            while(from <= to) {
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
        },
        buscarReturn(){
            let me= this;
            if(me.criterio=="fecha_ingreso"){

                me.buscar="";

                return 1;
            }else{

                me.buscar="";
                return 0;
            }

        }

  },
  methods: {
    menuHabitacion(condicion){
        let me=this;

        switch (condicion) {
  case 1:
        me.ac_todos = true;
        me.ac_disponible = false;
        me.ac_ocupado = false;
        me.ac_limpieza = false;
        me.ac_mantenimiento = false;

        me.acn_todos = true;
        me.acn_disponible = false;
        me.acn_ocupado = false;
        me.acn_limpieza = false;
        me.acn_mantenimiento = false;

    break;
  case 2:
        me.ac_todos = false;
        me.ac_disponible = true;
        me.ac_ocupado = false;
        me.ac_limpieza = false;
        me.ac_mantenimiento = false;

        me.acn_todos = false;
        me.acn_disponible = true;
        me.acn_ocupado = false;
        me.acn_limpieza = false;
        me.acn_mantenimiento = false;
    break;
  case 3:
        me.ac_todos = false;
        me.ac_disponible = false;
        me.ac_ocupado = true;
        me.ac_limpieza = false;
        me.ac_mantenimiento = false;

        me.acn_todos = false;
        me.acn_disponible = false;
        me.acn_ocupado = true;
        me.acn_limpieza = false;
        me.acn_mantenimiento = false;
    break;
  case 4:
        me.ac_todos = false;
        me.ac_disponible = false;
        me.ac_ocupado = false;
        me.ac_limpieza = true;
        me.ac_mantenimiento = false;

        me.acn_todos = false;
        me.acn_disponible = false;
        me.acn_ocupado = false;
        me.acn_limpieza = true;
        me.acn_mantenimiento = false;
    break;
  case 5:
        me.ac_todos = false;
        me.ac_disponible = false;
        me.ac_ocupado = false;
        me.ac_limpieza = false;
        me.ac_mantenimiento = true;

        me.acn_todos = false;
        me.acn_disponible = false;
        me.acn_ocupado = false;
        me.acn_limpieza = false;
        me.acn_mantenimiento = true;
    break;
}

    },
    me(){
        let me=this;
        var url= 'me';
        axios.get(url).then(function (response) {

            var respuesta= response.data;
            me.id_user=respuesta.id;
        })
        .catch(function(error){
            console.log(error);
            Swal.fire({
                icon: 'error',
                title: 'Error...',
                text: 'Error en el servidro!'+error
            })
        });
    },
    listarIngreso(page,buscar,criterio){
        let me = this;
        me.isLoading = true;
        var url= 'api/ingreso/?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
        axios.get(url).then(function (response) {
            me.isLoading = false
            var respuesta= response.data;
            me.arrayIngreso = respuesta.ingreso.data;
            me.pagination= respuesta.pagination;
        })
        .catch(function(error){
            Swal.fire({
                icon: 'error',
                title: 'Error...',
                text: 'Error en el servidro!'
            })

        });
    },
    registrarIngreso(){
        if (this.validarIngreso()){
            return;
        }

        let me = this;

        axios.post('api/ingreso/insert',{
            'id_user': this.id_user,
            'fecha_ingreso': this.fecha_ingreso,
            'nombre_ingreso': this.nombre_ingreso,
            'descripcion_ingreso': this.descripcion_ingreso,
            'nrecibo_ingreso': this.nrecibo_ingreso,
            'monto_ingreso': this.monto_ingreso
        }).then(function (response) {
            me.cerrarModal();
            me.listarIngreso(1,'','nombre_cargo');
            Swal.fire('¡Guardado!', 'El ingreso se registró correctamente', 'success')
        }).catch(function (error) {
            Swal.fire({
                icon: 'error',
                title: 'Error...',
                text: 'Error en el servidro!'
            })
        });
    },
    actualizarIngreso(){
        if (this.validarIngreso()){
            return;
        }

        let me = this;

        axios.put('api/ingreso/update',{
            'id_user': this.id_user,
            'fecha_ingreso': this.fecha_ingreso,
            'nombre_ingreso': this.nombre_ingreso,
            'descripcion_ingreso': this.descripcion_ingreso,
            'nrecibo_ingreso': this.nrecibo_ingreso,
            'monto_ingreso': this.monto_ingreso,
            'id_ingreso': this.id
        }).then(function (response) {
            me.cerrarModal();
            me.listarIngreso(1,'','nombre_cargo');
            Swal.fire('¡Actualizado!', 'El ingreso se actualizo correctamente', 'success')
        }).catch(function (error) {
            Swal.fire({
                icon: 'error',
                title: 'Error...',
                text: 'Error en el servidro!'
            })
        });
    },
    eliminarIngreso(id){
        const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
        title: '¿Desea eliminar este ingreso?',
        text: "¡No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: '¡Sí, eliminar!',
        cancelButtonText: '¡No, cancelar!',
        reverseButtons: true
        }).then((result) => {
        if (result.isConfirmed) {

            let me = this;
            console.log(id);
            axios.delete('api/ingreso/delete/'+id).then(function (response) {
                console.log(response);
                me.listarIngreso(1,'','nombre_cargo');
                swalWithBootstrapButtons.fire(
                '¡Eliminado!',
                'El ingreso ha sido eliminado.',
                'success'
                )
            }).catch(function (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error...',
                    text: 'Error en el servidro!'
                })
            });


        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
            'Cancelado',
            'No eliminó este ingreso',
            'error'
            )
        }
        });
    },
    limpiarText(){
        let me= this;
        me.fecha_ingreso='';
        me.nombre_ingreso='';
        me.descripcion_ingreso='';
        me.nrecibo_ingreso='';
        me.monto_ingreso='';
        me.errorMostrarMsjIngreso = [];
    },
    abrirModal(modelo, accion, data = []){
        $('#con-close-modal').modal('show');
        switch(modelo){
            case "ingreso":
            {
                switch(accion){
                    case 'registrar':
                    {
                        this.tituloModal = 'Registrar Ingreso';
                        this.tipoAccion=1;
                        this.limpiarText();
                        break;
                    }
                    case 'actualizar':
                    {
                        this.tituloModal='Actualizar Ingreso';
                        this.tipoAccion=2;
                        this.id=data['id_ingreso'];
                        this.fecha_ingreso = data['fecha_ingreso'];
                        this.nombre_ingreso= data['nombre_ingreso'];
                        this.descripcion_ingreso= data['descripcion_ingreso'];
                        this.nrecibo_ingreso= data['nrecibo_ingreso'];
                        this.monto_ingreso= data['monto_ingreso'];
                        break;
                    }
                    case 'ver':
                    {

                        this.tituloModal='Ver Ingreso';
                        this.tipoAccion=3;
                        this.apnom=data.user[0].surnames+' '+data.user[0].name;
                        this.correo=data.user[0].email;
                        var dtc = datetime.create(data['created_at']);
                        var fhc = dtc.format('Y/m/d H:M:S');
                        var dte = datetime.create(data['updated_at']);
                        var fhe = dte.format('Y/m/d H:M:S');
                        this.fhorac=fhc;
                        this.fhorae=fhe;
                        this.id=data['id_ingreso'];
                        this.fecha_ingreso = data['fecha_ingreso'];
                        this.nombre_ingreso= data['nombre_ingreso'];
                        this.descripcion_ingreso= data['descripcion_ingreso'];
                        this.nrecibo_ingreso= data['nrecibo_ingreso'];
                        this.monto_ingreso= data['monto_ingreso'];
                        break;
                    }
                }
            }
        }
    },
    cerrarModal(){
        let me = this;
        $('#con-close-modal').modal('hide');
        me.limpiarText();
    },
    validarIngreso(){
        this.errorIngreso=0;
        this.errorMostrarMsjIngreso =[];

        if (!this.fecha_ingreso) this.errorMostrarMsjIngreso.push("La fecha del ingreso no puede estar vacío.");
        if (!this.nombre_ingreso) this.errorMostrarMsjIngreso.push("El ingreso no puede estar vacío.");
        if (!this.monto_ingreso) this.errorMostrarMsjIngreso.push("El monto del ingreso no puede estar vacío.");

        if (this.errorMostrarMsjIngreso.length) this.errorIngreso = 1;

        return this.errorIngreso;
    },



  },
  mounted() {
    this.listarIngreso(1,this.buscar,this.criterio);
    this.me();
    this.menuHabitacion(1);
  },
};
</script>
