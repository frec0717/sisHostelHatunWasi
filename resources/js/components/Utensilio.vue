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
               
                <h4 class="page-title">Utensilio </h4>                
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <button type="button" class="btn btn-blue waves-effect waves-light" @click="abrirModal('utensilio','registrar')">
                                Nuevo
                                <span class="btn-label-right"><i class="mdi mdi-plus"></i></span>
                            </button>
                            <br>
                            <br>
                            <div class="col-12">
                                <div class="input-group">
                                    <select class="form-select col-lg-12 col-md-1 col-sm-1" v-model="criterio">
                                        <option value="nombre_utensilio">Nombre</option>   
                                        <option value="nombre_tipoutensilio">Categoría</option>                                     
                                    </select>                           
                                    <input type="text"  placeholder="Texto a buscar" v-model="buscar" @keyup.enter="listarUtensilio(1,buscar,criterio)" class="form-control col-lg-12 col-md-12 col-sm-12 ">
                                    <div class="col-lg-7 col-md-6 col-sm-12">
                                        <button type="submit"  @click="listarUtensilio(1,buscar,criterio)" class="btn btn-blue waves-effect waves-light">
                                            <span class="btn-label"><i class="mdi mdi-magnify"></i></span>Buscar
                                        </button>
                                    </div>
                                    <button type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Actualizar" class="btn btn-blue waves-effect waves-light" @click="listarUtensilio(1,buscar,criterio)"><i class="mdi mdi-refresh"></i></button>
                                                    
                                </div>
                            </div>
                            <br>
                            
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped verticle-middle align-middle table-hover">
                                    <thead class="table-warning">
                                        <tr align="center">
                                            <th>Nombre</th>
                                            <th>Categoría</th>
                                            <th>Cantidad</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="utensilio in arrayUtensilio" :key="utensilio.id">                                                                                     
                                            <td v-text="utensilio.nombre_utensilio"></td>
                                            <td v-text="utensilio.tipoutensilios[0].nombre_tipoutensilio"></td>
                                            <td align="right" v-text="utensilio.cantidad_utensilio"></td>
                                            
                                            
                                            <td align="center">
                                                <div class="button-list">
                                                    <button type="button" data-bs-toggle="tooltip" @click="abrirModal('utensilio','actualizar',utensilio)" data-bs-placement="top" title="Editar" class="btn btn-warning waves-effect waves-light"><i class="mdi mdi-pencil-outline"></i></button>
                                                    <button type="button" data-bs-toggle="tooltip" @click="eliminarUtensilio(utensilio.id_utensilio)" data-bs-placement="top" title="Elimar" class="btn btn-danger waves-effect waves-light"><i class="mdi mdi-trash-can-outline"></i></button>
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
                                <label for="field-3" class="form-label">Categoría *</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" v-model="nombre_tipoutensilio" placeholder="Tipo de utensilio" aria-label="Recipient's username" disabled>
                                    <button class="btn input-group-text btn-blue waves-effect waves-light" @click="abrirModalTipoutensilio()" type="button">Buscar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">                        
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="field-2" class="form-label">Utensilio *</label>
                                <input type="text" class="form-control" v-model="nombre_utensilio" placeholder="Nombre">
                            </div>
                        </div>
                    </div>                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="field-4" class="form-label">Cantidad *</label>
                                <input type="number" class="form-control" v-model="cantidad_utensilio" placeholder="Monto">
                            </div>
                        </div>                        
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="">
                                <label for="field-7" class="form-label">Descripción</label>
                                <textarea class="form-control" v-model="descripcion_utensilio" placeholder="Descripción"></textarea>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div v-show="errorUtensilio" class="form-group row div-error">
                        <div class="text-center" style="color: red;">
                            <li v-for="error in errorMostrarMsjUtensilio" :key="error" v-text="error">

                            </li>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" @click="cerrarModal()">Cancelar</button>
                    <button type="button" v-if="tipoAccion==1" @click="registrarUtensilio()" class="btn btn-blue waves-effect waves-light">Guardar</button>
                    <button type="button" v-if="tipoAccion==2" @click="actualizarUtensilio()" class="btn btn-blue waves-effect waves-light">Actualizar</button>
                </div>
            </div>
        </div>
    </div><!-- /.modal -->

      <!--  Modal SEARCH TIPO UTENSILIO -->
    <div class="modal fade" id="modalTipoutensilio" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Tipo de utensilio</h4>
                    <button type="button" class="btn-close" @click="cerrarModalTipoutensilio()" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-12">
                        <div class="row">

                            <div class="col-12">
                                <div class="input-group">
                                    <select class="form-select col-lg-12 col-md-1 col-sm-1" v-model="criterioTipoutensilio">
                                        <option value="nombre_tipoutensilio">Nombre</option>
                                    </select>
                                    <input type="text"  placeholder="Texto a buscar" v-model="buscarTipoutensilio" @keyup.enter="listarTipoutensilio(1,buscarTipoutensilio,criterioTipoutensilio)" class="form-control col-lg-12 col-md-12 col-sm-12 ">
                                   
                                    <div class="col-lg-7 col-md-6 col-sm-12">
                                        <button type="submit"  @click="listarTipoutensilio(1,buscarTipoutensilio,criterioTipoutensilio)" class="btn btn-blue waves-effect waves-light">
                                            <span class="btn-label"><i class="mdi mdi-magnify"></i></span>Buscar
                                        </button>
                                    </div>
                                    <button type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Actualizar" class="btn btn-blue waves-effect waves-light" @click="listarTipoutensilio(1,buscarTipoutensilio,criterioTipoutensilio)"><i class="mdi mdi-refresh"></i></button>
                                                    
                                </div>
                            </div>
                            <br>
                            <br>
                            <br>
                            
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped verticle-middle align-middle table-hover">
                                    <thead class="table-warning">
                                        <tr align="center">
                                            <th>Tipo de utensilio</th>                                            
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="tipoutensilio in arrayTipoutensilio" :key="tipoutensilio.id"> 
                                            <td v-text="tipoutensilio.nombre_tipoutensilio"></td>
                                            <td align="center">
                                                <div class="button-list">
                                                    <button type="button" data-bs-toggle="tooltip" @click="agregarTipoutensilio(tipoutensilio)" data-bs-placement="top" title="Agregar" class="btn btn-blue waves-effect waves-light"><i class="mdi mdi-check"></i></button>
                                                </div>
                                            </td>
                                            
                                        </tr>                                    
                                                                     
                                    </tbody>
                                </table>
                                <div class="bootstrap-pagination">
                                    <nav>
                                        <ul class="pagination">
                                            <li class="page-item" v-if="paginationTipoutensilio.current_page > 1">
                                                <a class="page-link" href="#" @click.prevent="cambiarPaginaTipoutensilio(paginationTipoutensilio.current_page - 1,buscarTipoutensilio,criterioTipoutensilio)">Ant</a>
                                            </li>
                                            <li class="page-item" v-for="page in pagesNumberTipoutensilio" :key="page" :class="[page == isActivedTipoutensilio ? 'active' : '']">
                                                <a class="page-link" href="#" @click.prevent="cambiarPaginaTipoutensilio(page,buscarTipoutensilio,criterioTipoutensilio)" v-text="page"></a>
                                            </li>
                                            <li class="page-item" v-if="paginationTipoutensilio.current_page < paginationTipoutensilio.last_page">
                                                <a class="page-link" href="#" @click.prevent="cambiarPaginaTipoutensilio(paginationTipoutensilio.current_page + 1,buscarTipoutensilio,criterioTipoutensilio)">Sig</a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>           
                                
                                   
                        </div>
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" @click="cerrarModalTipoutensilio()">Cancelar</button>
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
        descripcion_utensilio:'',        
        nombre_utensilio:'',            
        cantidad_utensilio:'',        
        arrayUtensilio:[],
        arrayTipoutensilio:[],
        id_tipoutensilio:'',
        nombre_tipoutensilio:'',

        
        tituloModal:'',
        tipoAccion : 0,
        errorUtensilio : 0,
        errorMostrarMsjUtensilio : [],
        pagination : {
            'total' : 0,
            'current_page' : 0,
            'per_page' : 0,
            'last_page' : 0,
            'from' : 0,
            'to' : 0,
        },
        offset : 3,
        criterio : 'nombre_utensilio',

        buscar : '',

        paginationTipoutensilio : {
            'total' : 0,
            'current_page' : 0,
            'per_page' : 0,
            'last_page' : 0,
            'from' : 0,
            'to' : 0,
        },
        offsetTipoutensilio : 3,
        criterioTipoutensilio : 'nombre_tipoutensilio',
        buscarTipoutensilio : '',
        
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
        isActivedTipoutensilio: function(){
            return this.paginationTipoutensilio.current_page;
        },
        //Calcula los elementos de la paginación
        pagesNumberTipoutensilio: function() {
            if(!this.paginationTipoutensilio.to) {
                return [];
            }
            
            var from = this.paginationTipoutensilio.current_page - this.offsetTipoutensilio; 
            if(from < 1) {
                from = 1;
            }

            var to = from + (this.offsetTipoutensilio * 2); 
            if(to >= this.paginationTipoutensilio.last_page){
                to = this.paginationTipoutensilio.last_page;
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
    listarTipoutensilio(page,buscar,criterio){
        let me = this;
        me.isLoading = true;
        var url= 'api/tipoutensilio/?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
        axios.get(url).then(function (response) {            
            me.isLoading = false
            var respuesta= response.data;
            me.arrayTipoutensilio = respuesta.tipoutensilio.data;
            me.paginationTipoutensilio= respuesta.pagination;
        })
        .catch(function(error){
            Swal.fire({
                icon: 'error',
                title: 'Error...',
                text: 'Error en el servidro!'
            })
           
        });        
    }, 
    listarUtensilio(page,buscar,criterio){
        let me = this;
        me.isLoading = true;
        var url= 'api/utensilio/?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
        axios.get(url).then(function (response) {   
            var respuesta= response.data;
            me.arrayUtensilio = respuesta.utensilio.data;
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
    registrarUtensilio(){
        if (this.validarUtensilio()){
            return;
        }
        
        let me = this;

        axios.post('api/utensilio/insert',{
            'tipoutensilio_id': this.id_tipoutensilio,
            'nombre_utensilio': this.nombre_utensilio,
            'cantidad_utensilio': this.cantidad_utensilio,
            'descripcion_utensilio': this.descripcion_utensilio,
        }).then(function (response) {
            me.cerrarModal();
            me.listarUtensilio(1,'','nombre_utensilio');
            Swal.fire('¡Guardado!', 'El utensilio se registró correctamente', 'success')
        }).catch(function (error) {
            Swal.fire({
                icon: 'error',
                title: 'Error...',
                text: 'Error en el servidro!'
            })
        });
    }, 
    actualizarUtensilio(){
        if (this.validarUtensilio()){
            return;
        }
        
        let me = this;

        axios.put('api/utensilio/update',{
            'tipoutensilio_id': this.id_tipoutensilio,
            'nombre_utensilio': this.nombre_utensilio,
            'cantidad_utensilio': this.cantidad_utensilio,
            'descripcion_utensilio': this.descripcion_utensilio,
            'id_utensilio': this.id
        }).then(function (response) {
            me.cerrarModal();
            me.listarUtensilio(1,'','nombre_utensilio');
            Swal.fire('¡Actualizado!', 'El utensilio se actualizo correctamente', 'success')
        }).catch(function (error) {
            Swal.fire({
                icon: 'error',
                title: 'Error...',
                text: 'Error en el servidro!'
            })
        }); 
    }, 
    eliminarUtensilio(id){
        const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
        title: '¿Desea eliminar este utensilio?',
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
            axios.delete('api/utensilio/delete/'+id).then(function (response) {
                console.log(response);               
                me.listarUtensilio(1,'','nombre_utensilio');
                swalWithBootstrapButtons.fire(
                '¡Eliminado!',
                'El utensilio ha sido eliminado.',
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
            'No eliminó este utensilio',
            'error'
            )
        }
        });
    },
    limpiarText(){
        let me= this;
        me.nombre_utensilio='';        
        me.cantidad_utensilio='';        
        me.id_tipoutensilio='';        
        me.nombre_tipoutensilio='';        
        me.descripcion_utensilio='';  
        me.errorMostrarMsjUtensilio = [];
    },
    abrirModalTipoutensilio(){
        $('#modalTipoutensilio').modal('show'); 
        this.listarTipoutensilio(1,'','nombre_tipoutensilio');
    },
    cerrarModalTipoutensilio(){
        let me = this;
        $('#modalTipoutensilio').modal('hide'); 
    },
    agregarTipoutensilio(data = []){
        this.id_tipoutensilio = data['id_tipoutensilio'];
        this.nombre_tipoutensilio = data['nombre_tipoutensilio'];
        this.cerrarModalTipoutensilio();
    },
    abrirModal(modelo, accion, data = []){
        $('#con-close-modal').modal('show');   
        switch(modelo){
            case "utensilio":
            {
                switch(accion){
                    case 'registrar':
                    {
                        this.tituloModal = 'Registrar Utensilio';
                        this.tipoAccion=1;
                        this.limpiarText();
                        break;
                    }
                    case 'actualizar':
                    {                       
                        this.tituloModal='Actualizar Utensilio';
                        this.tipoAccion=2;
                        this.id=data['id_utensilio'];
                        this.id_tipoutensilio = data['tipoutensilio_id'];
                        this.nombre_utensilio= data['nombre_utensilio'];
                        this.nombre_tipoutensilio= data['tipoutensilios'][0].nombre_tipoutensilio;
                        this.cantidad_utensilio= data['cantidad_utensilio'];
                        this.descripcion_utensilio= data['descripcion_utensilio'];
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
    validarUtensilio(){
        this.errorUtensilio=0;
        this.errorMostrarMsjUtensilio =[];

        if (!this.nombre_utensilio) this.errorMostrarMsjUtensilio.push("La nombre del utensilio no puede estar vacío.");
        if (!this.id_tipoutensilio) this.errorMostrarMsjUtensilio.push("La categoría del utensilio no puede estar vacío.");
        if (!this.cantidad_utensilio) this.errorMostrarMsjUtensilio.push("La cantidad del utensilio no puede estar vacío.");

        if (this.errorMostrarMsjUtensilio.length) this.errorUtensilio = 1;

        return this.errorUtensilio;
    },

    
    
  },
  mounted() {
    this.listarUtensilio(1,this.buscar,this.criterio);
  },
};
</script>
