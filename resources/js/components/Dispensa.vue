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

                <h4 class="page-title">Dispensa </h4>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <button type="button" class="btn btn-blue waves-effect waves-light" @click="abrirModal('dispensa','registrar')">
                                Nuevo
                                <span class="btn-label-right"><i class="mdi mdi-plus"></i></span>
                            </button>
                            <br>
                            <br>
                            <div class="col-12">
                                <div class="input-group">
                                    <select class="form-select col-lg-12 col-md-1 col-sm-1" v-model="criterio">
                                        <option value="nombre_dispensa">Nombre</option>
                                    </select>
                                    <input type="text"  placeholder="Texto a buscar" v-model="buscar" @keyup.enter="listarDispensa(1,buscar,criterio)" class="form-control col-lg-12 col-md-12 col-sm-12 ">
                                    <div class="col-lg-7 col-md-6 col-sm-12">
                                        <button type="submit"  @click="listarDispensa(1,buscar,criterio)" class="btn btn-blue waves-effect waves-light">
                                            <span class="btn-label"><i class="mdi mdi-magnify"></i></span>Buscar
                                        </button>
                                    </div>
                                    <button type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Actualizar" class="btn btn-blue waves-effect waves-light" @click="listarDispensa(1,buscar,criterio)"><i class="mdi mdi-refresh"></i></button>

                                </div>
                            </div>
                            <br>

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped verticle-middle align-middle table-hover">
                                    <thead class="table-warning">
                                        <tr align="center">
                                            <th>Categoría</th>
                                            <th>Dispensa</th>
                                            <th>Cantidad</th>
                                            <th>Precio Compra</th>
                                            <th>Precio Venta</th>
                                            <th>Fecha vencimiento</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="dispensa in arrayDispensa" :key="dispensa.id">
                                            <td v-text="dispensa.categoriadispensas[0].nombre_categoriadispensa"></td>
                                            <td v-text="dispensa.nombre_dispensa"></td>
                                            <td align="right" v-text="dispensa.cantidad_dispensa"></td>
                                            <td align="right" v-text="'S/. '+dispensa.precioc_dispensa"></td>
                                            <td align="right" v-text="'S/. '+dispensa.preciov_dispensa"></td>
                                            <td v-text="dispensa.fechav_dispensa"></td>


                                            <td align="center">
                                                <div class="button-list">
                                                    <button type="button" data-bs-toggle="tooltip" @click="abrirModal('dispensa','actualizar',dispensa)" data-bs-placement="top" title="Editar" class="btn btn-warning waves-effect waves-light"><i class="mdi mdi-pencil-outline"></i></button>
                                                    <button type="button" data-bs-toggle="tooltip" @click="eliminarDispensa(dispensa.id_dispensa)" data-bs-placement="top" title="Elimar" class="btn btn-danger waves-effect waves-light"><i class="mdi mdi-trash-can-outline"></i></button>
                                                </div>
                                            </td>

                                        </tr>

                                    </tbody>
                                </table>
                                <div class="bootstrap-pagination">
                                    <nav>
                                        <ul class="pagination">
                                            <li class="page-item" v-if="pagination.current_page > 1">
                                                <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Ant</a>
                                            </li>
                                            <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                                <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                                            </li>
                                            <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                                <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Sig</a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                 <label class="form-label">Categoría dispensa*</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" v-model="nombre_categoriadispensa" placeholder="Categoría dispensa" aria-label="Recipient's username" disabled>
                                    <button class="btn input-group-text btn-blue waves-effect waves-light" @click="abrirModalCategoriadispensa()" type="button">Buscar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="field-2" class="form-label">Dispensa *</label>
                                <input type="text" class="form-control" v-model="nombre_dispensa" placeholder="Dispensa">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="field-2" class="form-label">Cantidad *</label>
                                <input type="number" class="form-control" v-model="cantidad_dispensa" placeholder="Cantidad">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="field-4" class="form-label">Precio compra *</label>
                                <input type="number" class="form-control" v-model="precioc_dispensa" placeholder="Precio compra">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="field-4" class="form-label">Precio venta *</label>
                                <input type="number" class="form-control" v-model="preciov_dispensa" placeholder="Precio venta">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="field-4" class="form-label">Fecha vencimiento</label>
                                <input type="date" class="form-control" v-model="fechav_dispensa" placeholder="Fecha vencimiento">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="">
                                <label for="field-7" class="form-label">Descripción</label>
                                <textarea class="form-control" v-model="descripcion_dispensa" placeholder="Descripción"></textarea>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div v-show="errorDispensa" class="form-group row div-error">
                        <div class="text-center" style="color: red;">
                            <li v-for="error in errorMostrarMsjDispensa" :key="error" v-text="error">

                            </li>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" @click="cerrarModal()">Cancelar</button>
                    <button type="button" v-if="tipoAccion==1" @click="registrarDispensa()" class="btn btn-blue waves-effect waves-light">Guardar</button>
                    <button type="button" v-if="tipoAccion==2" @click="actualizarDispensa()" class="btn btn-blue waves-effect waves-light">Actualizar</button>
                </div>
            </div>
        </div>
    </div><!-- /.modal -->

     <!--  Modal SEARCH TOURS -->
    <div class="modal fade" id="modalCategoriadispensa" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Categoría dispensa</h4>
                    <button type="button" class="btn-close" @click="cerrarModalCategoriadispensa()" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12">

                                        <div class="col-12">
                                <div class="input-group">
                                    <select class="form-select col-lg-12 col-md-1 col-sm-1" v-model="criterioCategoriadispensa">
                                        <option value="nombre_categoriadispensa">Nombre</option>
                                    </select>
                                    <input type="text"  placeholder="Texto a buscar" v-model="buscarCategoriadispensa" @keyup.enter="listarCategoriadispensa(1,buscarCategoriadispensa,criterioCategoriadispensa)" class="form-control col-lg-12 col-md-12 col-sm-12 ">

                                    <div class="col-lg-7 col-md-6 col-sm-12">
                                        <button type="submit"  @click="listarCategoriadispensa(1,buscarCategoriadispensa,criterioCategoriadispensa)" class="btn btn-blue waves-effect waves-light">
                                            <span class="btn-label"><i class="mdi mdi-magnify"></i></span>Buscar
                                        </button>
                                    </div>
                                    <button type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Actualizar" class="btn btn-blue waves-effect waves-light" @click="listarCategoriadispensa(1,buscarCategoriadispensa,criterioCategoriadispensa)"><i class="mdi mdi-refresh"></i></button>

                                </div>
                            </div>
                            <br>

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped verticle-middle align-middle table-hover">
                                    <thead class="table-warning">
                                        <tr align="center">
                                            <th>Categoría dispensa</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="categoriadispensa in arrayCategoriadispensa" :key="categoriadispensa.id">
                                            <td v-text="categoriadispensa.nombre_categoriadispensa"></td>
                                            <td align="center">
                                                <div class="button-list">
                                                    <button type="button" data-bs-toggle="tooltip" @click="agregarEmpresa(categoriadispensa)" data-bs-placement="top" title="Agregar" class="btn btn-blue waves-effect waves-light"><i class="mdi mdi-check"></i></button>
                                                </div>
                                            </td>

                                        </tr>

                                    </tbody>
                                </table>
                                <div class="bootstrap-pagination">
                                    <nav>
                                        <ul class="pagination">
                                            <li class="page-item" v-if="paginationCategoriadispensa.current_page > 1">
                                                <a class="page-link" href="#" @click.prevent="cambiarPaginaCategoriadispensa(paginationCategoriadispensa.current_page - 1,buscarCategoriadispensa,criterioCategoriadispensa)">Ant</a>
                                            </li>
                                            <li class="page-item" v-for="page in pagesNumberCategoriadispensa" :key="page" :class="[page == isActivedCategoriadispensa ? 'active' : '']">
                                                <a class="page-link" href="#" @click.prevent="cambiarPaginaCategoriadispensa(page,buscar,criterio)" v-text="page"></a>
                                            </li>
                                            <li class="page-item" v-if="paginationCategoriadispensa.current_page < paginationCategoriadispensa.last_page">
                                                <a class="page-link" href="#" @click.prevent="cambiarPaginaCategoriadispensa(paginationCategoriadispensa.current_page + 1,buscarCategoriadispensa,criterioCategoriadispensa)">Sig</a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>

                            </div><!-- end col -->
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" @click="cerrarModalCategoriadispensa()">Cancelar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
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
        nombre_dispensa:'',
        cantidad_dispensa:'',
        precioc_dispensa:'',
        preciov_dispensa:'',
        fechav_dispensa:'',
        descripcion_dispensa:'',
        arrayDispensa:[],
        arrayCategoriadispensa:[],
        id_categoriadispensa:0,
        nombre_categoriadispensa:'',

        tituloModal:'',
        tipoAccion : 0,
        errorDispensa : 0,
        errorMostrarMsjDispensa : [],
        pagination : {
            'total' : 0,
            'current_page' : 0,
            'per_page' : 0,
            'last_page' : 0,
            'from' : 0,
            'to' : 0,
        },
        offset : 3,
        criterio : 'nombre_dispensa',
        buscar : '',

        isLoading: false,
        fullPage: true,


        paginationCategoriadispensa : {
            'total' : 0,
            'current_page' : 0,
            'per_page' : 0,
            'last_page' : 0,
            'from' : 0,
            'to' : 0,
        },
        offsetCategoriadispensa : 3,
        criterioCategoriadispensa : 'nombre_categoriadispensa',
        buscarCategoriadispensa : '',

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

        isActivedCategoriadispensa: function(){
            return this.paginationCategoriadispensa.current_page;
        },
        //Calcula los elementos de la paginación
        pagesNumberCategoriadispensa: function() {
            if(!this.paginationCategoriadispensa.to) {
                return [];
            }

            var from = this.paginationCategoriadispensa.current_page - this.offsetCategoriadispensa;
            if(from < 1) {
                from = 1;
            }

            var to = from + (this.offsetCategoriadispensa * 2);
            if(to >= this.paginationCategoriadispensa.last_page){
                to = this.paginationCategoriadispensa.last_page;
            }

            var pagesArray = [];
            while(from <= to) {
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
        },


  },
  methods: {

    listarCategoriadispensa(page,buscar,criterio){
        let me = this;
        me.isLoading = true;
        var url= 'api/categoriadispensa/?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
        axios.get(url).then(function (response) {
            me.isLoading = false
            var respuesta= response.data;
            me.arrayCategoriadispensa = respuesta.categoriadispensas.data;
            me.paginationCategoriadispensa= respuesta.pagination;
        })
        .catch(function(error){
            Swal.fire({
                icon: 'error',
                title: 'Error...',
                text: 'Error en el servidro!'
            })

        });
    },
    listarDispensa(page,buscar,criterio){
        let me = this;
        me.isLoading = true;
        var url= 'api/dispensa/?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
        axios.get(url).then(function (response) {
            var respuesta= response.data;
            me.arrayDispensa = respuesta.dispensas.data;
            me.pagination= respuesta.pagination;
            me.isLoading = false;
        })
        .catch(function(error){
            Swal.fire({
                icon: 'error',
                title: 'Error...',
                text: 'Error en el servidro!'
            })

        });
    },
    registrarDispensa(){
        if (this.validarDispensa()){
            return;
        }

        let me = this;

        axios.post('api/dispensa/insert',{
            'categoriadispensa_id': this.id_categoriadispensa,
            'nombre_dispensa': this.nombre_dispensa,
            'cantidad_dispensa': this.cantidad_dispensa,
            'precioc_dispensa': this.precioc_dispensa,
            'preciov_dispensa': this.preciov_dispensa,
            'fechav_dispensa': this.fechav_dispensa,
            'descripcion_dispensa': this.descripcion_dispensa,
        }).then(function (response) {
            me.cerrarModal();
            me.listarDispensa(1,'','nombre_dispensa');
            Swal.fire('¡Guardado!', 'La dispensa se registró correctamente', 'success')
        }).catch(function (error) {
            Swal.fire({
                icon: 'error',
                title: 'Error...',
                text: 'Error en el servidro!'
            })
        });
    },
    actualizarDispensa(){
        if (this.validarDispensa()){
            return;
        }

        let me = this;

        axios.put('api/dispensa/update',{
            'categoriadispensa_id': this.id_categoriadispensa,
            'nombre_dispensa': this.nombre_dispensa,
            'cantidad_dispensa': this.cantidad_dispensa,
            'precioc_dispensa': this.precioc_dispensa,
            'preciov_dispensa': this.preciov_dispensa,
            'fechav_dispensa': this.fechav_dispensa,
            'descripcion_dispensa': this.descripcion_dispensa,
            'id_dispensa': this.id
        }).then(function (response) {
            console.log(response);
            me.cerrarModal();
            me.listarDispensa(1,'','nombre_dispensa');
            Swal.fire('¡Actualizado!', 'La dispensa se actualizo correctamente', 'success')
        }).catch(function (error) {
            Swal.fire({
                icon: 'error',
                title: 'Error...',
                text: 'Error en el servidro!'
            })
        });
    },
    eliminarDispensa(id){
        const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
        title: '¿Desea eliminar este dispensa?',
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
            axios.delete('api/dispensa/delete/'+id).then(function (response) {
                console.log(response);
                me.listarDispensa(1,'','nombre_dispensa');
                swalWithBootstrapButtons.fire(
                '¡Eliminado!',
                'La dispensa ha sido eliminado.',
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
            'No eliminó este dispensa',
            'error'
            )
        }
        });
    },
    limpiarText(){
        let me= this;
        me.nombre_dispensa='';
        me.cantidad_dispensa='';
        me.precioc_dispensa='';
        me.preciov_dispensa='';
        me.fechav_dispensa='';
        me.descripcion_dispensa='';
        me.id_categoriadispensa=0,
        me.nombre_categoriadispensa='',
        me.errorMostrarMsjDispensa = [];
    },
    abrirModalCategoriadispensa(){
        $('#modalCategoriadispensa').modal('show');
        this.listarCategoriadispensa(1,'','nombre_categoriadispensa');
    },
    cerrarModalCategoriadispensa(){
        let me = this;
        $('#modalCategoriadispensa').modal('hide');
    },
    agregarEmpresa(data = []){
        this.id_categoriadispensa = data['id_categoriadispensa'];
        this.nombre_categoriadispensa = data['nombre_categoriadispensa'];
        this.cerrarModalCategoriadispensa();
    },
    abrirModal(modelo, accion, data = []){
        $('#con-close-modal').modal('show');
        switch(modelo){
            case "dispensa":
            {
                switch(accion){
                    case 'registrar':
                    {
                        this.tituloModal = 'Registrar Dispensa';
                        this.tipoAccion=1;
                        this.limpiarText();
                        break;
                    }
                    case 'actualizar':
                    {
                        this.tituloModal='Actualizar Dispensa';
                        this.tipoAccion=2;
                        this.id=data['id_dispensa'];
                        this.id_categoriadispensa = data['categoriadispensas'][0].id_categoriadispensa;
                        this.nombre_categoriadispensa = data['categoriadispensas'][0].nombre_categoriadispensa;
                        this.nombre_dispensa = data['nombre_dispensa'];
                        this.cantidad_dispensa= data['cantidad_dispensa'];
                        this.precioc_dispensa= data['precioc_dispensa'];
                        this.preciov_dispensa= data['preciov_dispensa'];
                        this.fechav_dispensa= data['fechav_dispensa'];
                        this.descripcion_dispensa= data['descripcion_dispensa'];
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
    validarDispensa(){
        this.errorDispensa=0;
        this.errorMostrarMsjDispensa =[];

        if (!this.id_categoriadispensa) this.errorMostrarMsjDispensa.push("La nombre de la categoría no puede estar vacío.");
        if (!this.nombre_dispensa) this.errorMostrarMsjDispensa.push("El nombre de la dispensa no puede estar vacío.");
        if (!this.cantidad_dispensa) this.errorMostrarMsjDispensa.push("La cantidad de la dispensa no puede estar vacío.");
        if (!this.precioc_dispensa) this.errorMostrarMsjDispensa.push("El precio de compra final de la dispensa no puede estar vacío.");
        if (!this.preciov_dispensa) this.errorMostrarMsjDispensa.push("El precio de venta final de la dispensa no puede estar vacío.");

        if (this.errorMostrarMsjDispensa.length) this.errorDispensa = 1;

        return this.errorDispensa;
    },



  },
  mounted() {
    this.listarDispensa(1,this.buscar,this.criterio);
  },
};
</script>
