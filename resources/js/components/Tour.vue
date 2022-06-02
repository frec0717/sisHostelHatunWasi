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
               
                <h4 class="page-title">Tour </h4>                
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <button type="button" class="btn btn-blue waves-effect waves-light" @click="abrirModal('tour','registrar')">
                                Nuevo
                                <span class="btn-label-right"><i class="mdi mdi-plus"></i></span>
                            </button>
                            <br>
                            <br>
                            <div class="col-12">
                                <div class="input-group">
                                    <select class="form-select col-lg-12 col-md-1 col-sm-1" v-model="criterio">
                                        <option value="nombre_tour">Nombre</option>                                        
                                        <option value="razonsocial_empresa">Empresa</option>                                        
                                    </select>                           
                                    <input type="text"  placeholder="Texto a buscar" v-model="buscar" @keyup.enter="listarTour(1,buscar,criterio)" class="form-control col-lg-12 col-md-12 col-sm-12 ">
                                    <div class="col-lg-7 col-md-6 col-sm-12">
                                        <button type="submit"  @click="listarTour(1,buscar,criterio)" class="btn btn-blue waves-effect waves-light">
                                            <span class="btn-label"><i class="mdi mdi-magnify"></i></span>Buscar
                                        </button>
                                    </div>
                                    <button type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Actualizar" class="btn btn-blue waves-effect waves-light" @click="listarTour(1,buscar,criterio)"><i class="mdi mdi-refresh"></i></button>
                                                    
                                </div>
                            </div>
                            <br>
                            
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped verticle-middle align-middle table-hover">
                                    <thead class="table-warning">
                                        <tr align="center">
                                            <th>Tour</th>
                                            <th>Feha de incio</th>
                                            <th>Fecha final</th>
                                            <th>Empresa</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="tour in arrayTour" :key="tour.id">                                                                                     
                                            <td v-text="tour.nombre_tour"></td>
                                            <td v-text="tour.fechai_tour"></td>
                                            <td v-text="tour.fechaf_tour"></td>
                                            <td v-text="tour.empresas[0].razonsocial_empresa"></td>
                                            
                                            
                                            <td align="center">
                                                <div class="button-list">
                                                    <button type="button" data-bs-toggle="tooltip" @click="abrirModal('tour','actualizar',tour)" data-bs-placement="top" title="Editar" class="btn btn-warning waves-effect waves-light"><i class="mdi mdi-pencil-outline"></i></button>
                                                    <button type="button" data-bs-toggle="tooltip" @click="eliminarTour(tour.id_tour)" data-bs-placement="top" title="Elimar" class="btn btn-danger waves-effect waves-light"><i class="mdi mdi-trash-can-outline"></i></button>
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
                                 <label class="form-label">Empresa*</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" v-model="razonsocial_empresa" placeholder="Empresa" aria-label="Recipient's username" disabled>
                                    <button class="btn input-group-text btn-blue waves-effect waves-light" @click="abrirModalEmpresa()" type="button">Buscar</button>
                                </div>
                            </div>
                        </div>
                    </div>                 
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="field-4" class="form-label">Fecha de inicio *</label>
                                <input type="date" class="form-control" v-model="fechai_tour" placeholder="Fecha de inicio">
                            </div>
                        </div>                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="field-4" class="form-label">Fecha final *</label>
                                <input type="date" class="form-control" v-model="fechaf_tour" placeholder="Fecha final">
                            </div>
                        </div>                        
                    </div>
                    <div class="row">                        
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="field-2" class="form-label">Tour *</label>
                                <input type="text" class="form-control" v-model="nombre_tour" placeholder="Nombre">
                            </div>
                        </div>
                    </div>     
                    <div class="row">
                        <div class="col-md-12">
                            <div class="">
                                <label for="field-7" class="form-label">Descripción</label>
                                <textarea class="form-control" v-model="descripcion_tour" placeholder="Descripción"></textarea>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div v-show="errorTour" class="form-group row div-error">
                        <div class="text-center" style="color: red;">
                            <li v-for="error in errorMostrarMsjTour" :key="error" v-text="error">

                            </li>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" @click="cerrarModal()">Cancelar</button>
                    <button type="button" v-if="tipoAccion==1" @click="registrarTour()" class="btn btn-blue waves-effect waves-light">Guardar</button>
                    <button type="button" v-if="tipoAccion==2" @click="actualizarTour()" class="btn btn-blue waves-effect waves-light">Actualizar</button>
                </div>
            </div>
        </div>
    </div><!-- /.modal -->

     <!--  Modal SEARCH TOURS -->
    <div class="modal fade" id="modalEmpresa" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Empresa</h4>
                    <button type="button" class="btn-close" @click="cerrarModalEmpresa()" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12">
                                       
                                        <div class="col-12">
                                            <div class="input-group">
                                                <select class="form-select col-lg-12 col-md-1 col-sm-1" v-model="criterioEmpresa">
                                                    <option value="razonsocial_empresa">Razón social</option>
                                                    <option value="ruc_empresa">RUC</option>
                                                </select>
                                                <input type="text"  placeholder="Texto a buscar" v-model="buscarEmpresa" @keyup.enter="listarEmpresa(1,buscarEmpresa,criterioEmpresa)" class="form-control col-lg-12 col-md-12 col-sm-12 ">
                                            
                                                <div class="col-lg-7 col-md-6 col-sm-12">
                                                    <button type="submit"  @click="listarEmpresa(1,buscarEmpresa,criterioEmpresa)" class="btn btn-blue waves-effect waves-light">
                                                        <span class="btn-label"><i class="mdi mdi-magnify"></i></span>Buscar
                                                    </button>
                                                </div>
                                                <button type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Actualizar" class="btn btn-blue waves-effect waves-light" @click="listarEmpresa(1,buscarEmpresa,criterioEmpresa)"><i class="mdi mdi-refresh"></i></button>
                                                                
                                            </div>
                                        </div>
                                        <br>
                                        
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped verticle-middle align-middle table-hover">
                                                <thead class="table-warning">
                                                    <tr align="center">
                                                        <th>RUC</th>                                            
                                                        <th>Empresa</th>                                            
                                                        <th>Dirección</th>                                            
                                                        <th>Celular</th>                                            
                                                        <th>Acción</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="empresa in arrayEmpresa" :key="empresa.id"> 
                                                        <td v-text="empresa.ruc_empresa"></td>
                                                        <td v-text="empresa.razonsocial_empresa"></td>
                                                        <td v-text="empresa.direccion_empresa"></td>
                                                        <td v-text="empresa.celular_empresa"></td>
                                                        <td align="center">
                                                            <div class="button-list">
                                                                <button type="button" data-bs-toggle="tooltip" @click="agregarEmpresa(empresa)" data-bs-placement="top" title="Agregar" class="btn btn-blue waves-effect waves-light"><i class="mdi mdi-check"></i></button>
                                                            </div>
                                                        </td>
                                                        
                                                    </tr>                                    
                                                                                
                                                </tbody>
                                            </table>
                                            <div class="bootstrap-pagination">
                                                <nav>
                                                    <ul class="pagination">
                                                        <li class="page-item" v-if="paginationEmpresa.current_page > 1">
                                                            <a class="page-link" href="#" @click.prevent="cambiarPaginaEmpresa(paginationEmpresa.current_page - 1,buscarEmpresa,criterioEmpresa)">Ant</a>
                                                        </li>
                                                        <li class="page-item" v-for="page in pagesNumberEmpresa" :key="page" :class="[page == isActivedEmpresa ? 'active' : '']">
                                                            <a class="page-link" href="#" @click.prevent="cambiarPaginaEmpresa(page,buscar,criterio)" v-text="page"></a>
                                                        </li>
                                                        <li class="page-item" v-if="paginationEmpresa.current_page < paginationEmpresa.last_page">
                                                            <a class="page-link" href="#" @click.prevent="cambiarPaginaEmpresa(paginationEmpresa.current_page + 1,buscarEmpresa,criterioEmpresa)">Sig</a>
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
                    <button type="button" class="btn btn-secondary waves-effect" @click="cerrarModalEmpresa()">Cancelar</button>
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
        fechai_tour:'',        
        fechaf_tour:'',        
        nombre_tour:'',            
        descripcion_tour:'',        
        arrayTour:[],
        arrayEmpresa:[],
        id_empresa:0,
        razonsocial_empresa:'',

        tituloModal:'',
        tipoAccion : 0,
        errorTour : 0,
        errorMostrarMsjTour : [],
        pagination : {
            'total' : 0,
            'current_page' : 0,
            'per_page' : 0,
            'last_page' : 0,
            'from' : 0,
            'to' : 0,
        },
        offset : 3,
        criterio : 'nombre_tour',
        buscar : '',
        
        isLoading: false,
        fullPage: true,


        paginationEmpresa : {
            'total' : 0,
            'current_page' : 0,
            'per_page' : 0,
            'last_page' : 0,
            'from' : 0,
            'to' : 0,
        },
        offsetEmpresa : 3,
        criterioEmpresa : 'razonsocial_empresa',
        buscarEmpresa : '',
       
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

        isActivedEmpresa: function(){
            return this.paginationEmpresa.current_page;
        },
        //Calcula los elementos de la paginación
        pagesNumberEmpresa: function() {
            if(!this.paginationEmpresa.to) {
                return [];
            }
            
            var from = this.paginationEmpresa.current_page - this.offsetEmpresa; 
            if(from < 1) {
                from = 1;
            }

            var to = from + (this.offsetEmpresa * 2); 
            if(to >= this.paginationEmpresa.last_page){
                to = this.paginationEmpresa.last_page;
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

    listarEmpresa(page,buscar,criterio){
        let me = this;
        me.isLoading = true;
        var url= 'api/empresa/?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
        axios.get(url).then(function (response) {            
            me.isLoading = false
            var respuesta= response.data;
            me.arrayEmpresa = respuesta.empresa.data;
            me.paginationEmpresa= respuesta.pagination;
        })
        .catch(function(error){
            Swal.fire({
                icon: 'error',
                title: 'Error...',
                text: 'Error en el servidro!'
            })
           
        });        
    }, 
    listarTour(page,buscar,criterio){
        let me = this;
        me.isLoading = true;
        var url= 'api/tour/?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
        axios.get(url).then(function (response) {   
            var respuesta= response.data;
            me.arrayTour = respuesta.tour.data;
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
    registrarTour(){
        if (this.validarTour()){
            return;
        }
        
        let me = this;

        axios.post('api/tour/insert',{
            'empresa_id': this.id_empresa,
            'fechai_tour': this.fechai_tour,
            'fechaf_tour': this.fechaf_tour,
            'nombre_tour': this.nombre_tour,
            'descripcion_tour': this.descripcion_tour,
        }).then(function (response) {
            me.cerrarModal();
            me.listarTour(1,'','nombre_tour');
            Swal.fire('¡Guardado!', 'El tour se registró correctamente', 'success')
        }).catch(function (error) {
            Swal.fire({
                icon: 'error',
                title: 'Error...',
                text: 'Error en el servidro!'
            })
        });
    }, 
    actualizarTour(){
        if (this.validarTour()){
            return;
        }
        
        let me = this;

        axios.put('api/tour/update',{
            'empresa_id': this.id_empresa,
            'fechai_tour': this.fechai_tour,
            'fechaf_tour': this.fechaf_tour,
            'nombre_tour': this.nombre_tour,
            'descripcion_tour': this.descripcion_tour,
            'id_tour': this.id
        }).then(function (response) {
            console.log(response);
            me.cerrarModal();
            me.listarTour(1,'','nombre_tour');
            Swal.fire('¡Actualizado!', 'El tour se actualizo correctamente', 'success')
        }).catch(function (error) {
            Swal.fire({
                icon: 'error',
                title: 'Error...',
                text: 'Error en el servidro!'
            })
        }); 
    }, 
    eliminarTour(id){
        const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
        title: '¿Desea eliminar este tour?',
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
            axios.delete('api/tour/delete/'+id).then(function (response) {
                console.log(response);               
                me.listarTour(1,'','nombre_tour');
                swalWithBootstrapButtons.fire(
                '¡Eliminado!',
                'El tour ha sido eliminado.',
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
            'No eliminó este tour',
            'error'
            )
        }
        });
    },
    limpiarText(){
        let me= this;
        me.nombre_tour='';        
        me.id_empresa=0;        
        me.razonsocial_empresa='';        
        me.fechai_tour='';        
        me.fechaf_tour='';        
        me.descripcion_tour='';  
        me.errorMostrarMsjTour = [];
    },
    abrirModalEmpresa(){
        $('#modalEmpresa').modal('show'); 
        this.listarEmpresa(1,'','razonsocial_empresa');
    },
    cerrarModalEmpresa(){
        let me = this;
        $('#modalEmpresa').modal('hide'); 
    },
    agregarEmpresa(data = []){
        this.id_empresa = data['id_empresa'];
        this.razonsocial_empresa = data['razonsocial_empresa'];
        this.cerrarModalEmpresa();
    },
    abrirModal(modelo, accion, data = []){
        $('#con-close-modal').modal('show');   
        switch(modelo){
            case "tour":
            {
                switch(accion){
                    case 'registrar':
                    {
                        this.tituloModal = 'Registrar Tour';
                        this.tipoAccion=1;
                        this.limpiarText();
                        break;
                    }
                    case 'actualizar':
                    {                       
                        this.tituloModal='Actualizar Tour';
                        this.tipoAccion=2;
                        this.id=data['id_tour'];
                        // var id = data['empresa_id'];
                        // this.empresa_ids = data['empresa_id']; .empresas[0].razonsocial_empresa
                        this.id_empresa =0;
                        this.id_empresa = data['empresas'][0].id_empresa;
                        // this.empresa_id = 'mrda';
                        console.log(data['empresa_id']);
                        this.nombre_tour = data['nombre_tour'];
                        this.fechai_tour= data['fechai_tour'];
                        this.fechaf_tour= data['fechaf_tour'];
                        this.razonsocial_empresa= data['empresas'][0].razonsocial_empresa;
                        this.descripcion_tour= data['descripcion_tour'];
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
    validarTour(){
        this.errorTour=0;
        this.errorMostrarMsjTour =[];

        if (!this.nombre_tour) this.errorMostrarMsjTour.push("La nombre del tour no puede estar vacío.");
        if (!this.id_empresa) this.errorMostrarMsjTour.push("La empresa no puede estar vacío.");
        if (!this.fechai_tour) this.errorMostrarMsjTour.push("La fecha inicial del tour no puede estar vacío.");
        if (!this.fechaf_tour) this.errorMostrarMsjTour.push("La fecha final del tour no puede estar vacío.");

        if (this.errorMostrarMsjTour.length) this.errorTour = 1;

        return this.errorTour;
    },

    
    
  },
  mounted() {
    this.listarTour(1,this.buscar,this.criterio);
  },
};
</script>
