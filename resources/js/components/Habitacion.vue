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
               
                <h4 class="page-title">Habitación </h4>                
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <button type="button" class="btn btn-blue waves-effect waves-light" @click="abrirModal('habitaciones','registrar')">
                                Nuevo
                                <span class="btn-label-right"><i class="mdi mdi-plus"></i></span>
                            </button>
                            <br>
                            <br>
                            <div class="col-12">
                                <div class="input-group">
                                    <select class="form-select col-lg-12 col-md-1 col-sm-1" v-model="criterio">
                                        <option value="numero_habitacion">N° de habitación</option>     
                                        <option value="nombre_tipohabitacion">Tipo de habitación</option>                                   
                                        <option value="numero_piso">N° de piso</option>                                   
                                    </select>                           
                                    <input type="text"  placeholder="Texto a buscar" v-model="buscar" @keyup.enter="listarHabitaciones(1,buscar,criterio)" class="form-control col-lg-12 col-md-12 col-sm-12 ">
                                    <div class="col-lg-7 col-md-6 col-sm-12">
                                        <button type="submit"  @click="listarHabitaciones(1,buscar,criterio)" class="btn btn-blue waves-effect waves-light">
                                            <span class="btn-label"><i class="mdi mdi-magnify"></i></span>Buscar
                                        </button>
                                    </div>
                                    <button type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Actualizar" class="btn btn-blue waves-effect waves-light" @click="listarHabitaciones(1,buscar,criterio)"><i class="mdi mdi-refresh"></i></button>
                                                    
                                </div>
                            </div>
                            <br>
                            
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped verticle-middle align-middle table-hover">
                                    <thead class="table-warning">
                                        <tr align="center">
                                            <th>N° de Piso</th>
                                            <th>Tipo de Habitación</th>
                                            <th>N° de Habitación</th>
                                            <th>Precio</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="habitaciones in arrayHabitaciones" :key="habitaciones.id">                                                                                     
                                            <td align="center" v-text="'Piso N° '+habitaciones.piso[0].numero_piso"></td>
                                            <td v-text="habitaciones.tipo_habitacion[0].nombre_tipohabitacion"></td>                                            
                                            <td align="center" v-text="'N° '+habitaciones.numero_habitacion"></td>
                                            <td align="right" v-text="'S/. '+habitaciones.precio_habitacion"></td>
                                            <td align="center">
                                                <div class="button-list">
                                                    <button type="button" data-bs-toggle="tooltip" @click="abrirModal('habitaciones','actualizar',habitaciones)" data-bs-placement="top" title="Editar" class="btn btn-warning waves-effect waves-light"><i class="mdi mdi-pencil-outline"></i></button>
                                                    <button type="button" data-bs-toggle="tooltip" @click="eliminarHabitaciones(habitaciones.id_habitacion)" data-bs-placement="top" title="Elimar" class="btn btn-danger waves-effect waves-light"><i class="mdi mdi-trash-can-outline"></i></button>
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
                                 <label class="form-label">Tipo de habitación*</label>                                
                                <select class="form-select" v-model="id_tipohabitacion">
                                    <option v-for="tipohabitacion in arrayTipohabitacion" v-bind:value="tipohabitacion.id_tipohabitacion" :key="tipohabitacion.id_tipohabitacion" >{{ tipohabitacion.nombre_tipohabitacion }}</option>
                                </select>
                            </div>
                        </div>
                    </div> 
                    <div class="row">                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="field-2" class="form-label">N° de piso*</label>
                                <select class="form-select" v-model="id_piso">
                                    <option v-for="piso in arrayPiso" v-bind:value="piso.id_piso" :key="piso.id_piso" >{{ piso.numero_piso }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="field-2" class="form-label">N° Habitaciones*</label>
                                <input type="number" class="form-control" v-model="numero_habitacion" placeholder="N° Habitaciones">
                            </div>
                        </div>
                    </div>     
                    <div class="row">  
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="field-2" class="form-label">Precio*</label>
                                <input type="number" class="form-control" v-model="precio_habitacion" placeholder="Precio">
                            </div>
                        </div>
                    </div>     
                    <div class="row">
                        <div class="col-md-12">
                            <div class="">
                                <label for="field-7" class="form-label">Descripción</label>
                                <textarea class="form-control" v-model="descripcion_habitacion" placeholder="Descripción"></textarea>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div v-show="errorHabitaciones" class="form-group row div-error">
                        <div class="text-center" style="color: red;">
                            <li v-for="error in errorMostrarMsjHabitaciones" :key="error" v-text="error">

                            </li>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" @click="cerrarModal()">Cancelar</button>
                    <button type="button" v-if="tipoAccion==1" @click="registrarHabitaciones()" class="btn btn-blue waves-effect waves-light">Guardar</button>
                    <button type="button" v-if="tipoAccion==2" @click="actualizarHabitaciones()" class="btn btn-blue waves-effect waves-light">Actualizar</button>
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
        numero_habitacion:'',            
        precio_habitacion:'',               
        descripcion_habitacion:'',        
        arrayHabitaciones:[],
        arrayTipohabitacion:[],
        id_tipohabitacion:1,
        arrayPiso:[],
        id_piso:1,

        tituloModal:'',
        tipoAccion : 0,
        errorHabitaciones : 0,
        errorMostrarMsjHabitaciones : [],
        pagination : {
            'total' : 0,
            'current_page' : 0,
            'per_page' : 0,
            'last_page' : 0,
            'from' : 0,
            'to' : 0,
        },
        offset : 3,
        criterio : 'numero_habitacion',
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
       
  },
  methods: {     

    listarTipohabitaciones(){
        let me = this;
        me.isLoading = true;
        var url= 'api/tipohabitacion';
        axios.get(url).then(function (response) {            
            me.isLoading = false
            var respuesta= response.data;
            me.arrayTipohabitacion = respuesta.tipohabitaciones.data;            
        })
        .catch(function(error){
            Swal.fire({
                icon: 'error',
                title: 'Error...',
                text: 'Error en el servidro!'
            })
           
        });        
    }, 
    listarPiso(){
        let me = this;
        me.isLoading = true;
        var url= 'api/piso';
        axios.get(url).then(function (response) {            
            me.isLoading = false
            var respuesta= response.data;
            me.arrayPiso = respuesta.piso.data;            
        })
        .catch(function(error){
            Swal.fire({
                icon: 'error',
                title: 'Error...',
                text: 'Error en el servidro!'
            })
           
        });        
    }, 
    listarHabitaciones(page,buscar,criterio){
        let me = this;
        me.isLoading = true;
        var url= 'api/habitacion/?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
        axios.get(url).then(function (response) {   
            var respuesta= response.data;
            me.arrayHabitaciones = respuesta.habitaciones.data;
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
    registrarHabitaciones(){
        if (this.validarHabitaciones()){
            return;
        }
        
        let me = this;

        axios.post('api/habitacion/insert',{
            'tipohabitacion_id': this.id_tipohabitacion,
            'piso_id': this.id_piso,
            'numero_habitacion': this.numero_habitacion,
            'precio_habitacion': this.precio_habitacion,
            'descripcion_habitacion': this.descripcion_habitacion,
        }).then(function (response) {
            me.cerrarModal();
            me.listarHabitaciones(1,'','numero_habitacion');
            Swal.fire('¡Guardado!', 'La habitacion se registró correctamente', 'success')
        }).catch(function (error) {
            Swal.fire({
                icon: 'error',
                title: 'Error...',
                text: 'Error en el servidro!'
            })
        });
    }, 
    actualizarHabitaciones(){
        if (this.validarHabitaciones()){
            return;
        }
        
        let me = this;

        axios.put('api/habitacion/update',{
            'tipohabitacion_id': this.id_tipohabitacion,
            'piso_id': this.id_piso,
            'numero_habitacion': this.numero_habitacion,
            'precio_habitacion': this.precio_habitacion,
            'descripcion_habitacion': this.descripcion_habitacion,
            'id_habitacion': this.id
        }).then(function (response) {
            console.log(response);
            me.cerrarModal();
            me.listarHabitaciones(1,'','numero_habitacion');
            Swal.fire('¡Actualizado!', 'La habitacion se actualizo correctamente', 'success')
        }).catch(function (error) {
            Swal.fire({
                icon: 'error',
                title: 'Error...',
                text: 'Error en el servidro!'
            })
        }); 
    }, 
    eliminarHabitaciones(id){
        const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
        title: '¿Desea eliminar este habitaciones?',
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
            axios.delete('api/habitacion/delete/'+id).then(function (response) {
                console.log(response);               
                me.listarHabitaciones(1,'','numero_habitacion');
                swalWithBootstrapButtons.fire(
                '¡Eliminado!',
                'la habitacion ha sido eliminado.',
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
            'No eliminó este habitaciones',
            'error'
            )
        }
        });
    },
    limpiarText(){
        let me= this;
        me.numero_habitacion='';        
        me.id_tipohabitacion=1;        
        me.nombre_tipohabitacion='';  
        me.descripcion_habitacion='';  
        me.errorMostrarMsjHabitaciones = [];
    },
    abrirModalTipohabitaciones(){
        $('#modalTipohabitaciones').modal('show'); 
        this.listarTipohabitaciones(1,'','nombre_tipohabitacion');
    },
    cerrarModalTipohabitaciones(){
        let me = this;
        $('#modalTipohabitaciones').modal('hide'); 
    },
    agregarTipohabitaciones(data = []){
        this.id_tipohabitacion = data['id_tipohabitacion'];
        this.nombre_tipohabitacion = data['nombre_tipohabitacion'];
        this.cerrarModalTipohabitaciones();
    },
    abrirModal(modelo, accion, data = []){
        $('#con-close-modal').modal('show');   
        switch(modelo){
            case "habitaciones":
            {
                switch(accion){
                    case 'registrar':
                    {
                        this.tituloModal = 'Registrar Habitaciones';
                        this.tipoAccion=1;
                        this.limpiarText();
                        break;
                    }
                    case 'actualizar':
                    {                       
                        this.tituloModal='Actualizar Habitaciones';
                        this.tipoAccion=2;
                        this.id=data['id_habitacion'];
                        
                        this.id_tipohabitacion = data['tipo_habitacion'][0].id_tipohabitacion;
                        this.id_piso = data['piso'][0].id_piso;
                        this.numero_habitacion = data['numero_habitacion'];
                        this.precio_habitacion = data['precio_habitacion'];
                        this.descripcion_habitacion= data['descripcion_habitacion'];
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
    validarHabitaciones(){
        this.errorHabitaciones=0;
        this.errorMostrarMsjHabitaciones =[];

        if (!this.numero_habitacion) this.errorMostrarMsjHabitaciones.push("El número del habitacion no puede estar vacío.");
        if (!this.precio_habitacion) this.errorMostrarMsjHabitaciones.push("El precio del habitacion no puede estar vacío.");
        if (!this.id_tipohabitacion) this.errorMostrarMsjHabitaciones.push("El tipo de habitación no puede estar vacío.");
        if (!this.id_piso) this.errorMostrarMsjHabitaciones.push("El número del piso de la habitación no puede estar vacío.");

        if (this.errorMostrarMsjHabitaciones.length) this.errorHabitaciones = 1;

        return this.errorHabitaciones;
    },

    
    
  },
  mounted() {
    this.listarHabitaciones(1,this.buscar,this.criterio);
    this.listarTipohabitaciones();
    this.listarPiso();
  },
};
</script>
