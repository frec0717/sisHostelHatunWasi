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
               
                <h4 class="page-title">Emisión de recibo </h4>                
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <button type="button" class="btn btn-blue waves-effect waves-light" @click="abrirModal('emisionderecibo','registrar')">
                                Nuevo
                                <span class="btn-label-right"><i class="mdi mdi-plus"></i></span>
                            </button>
                            <br>
                            <br>
                            <div class="col-12">
                                <div class="input-group">
                                    <select class="form-select col-lg-12 col-md-1 col-sm-1" v-model="criterio">
                                        <option value="nombre_emisionderecibo">Nombre</option>
                                    </select>
                                    <!-- <select class="form-control  col-lg-2 col-md-2 col-sm-3 input-default" v-model="criterio">
                                        <option value="nombre_emisionderecibo">Cargo</option> 
                                    </select> --> 
                                    <input type="text"  placeholder="Texto a buscar" v-model="buscar" @keyup.enter="listarEmisionderecibo(1,buscar,criterio)" class="form-control col-lg-12 col-md-12 col-sm-12 ">
                                   
                                    <div class="col-lg-7 col-md-6 col-sm-12">
                                        <button type="submit"  @click="listarEmisionderecibo(1,buscar,criterio)" class="btn btn-blue waves-effect waves-light">
                                            <span class="btn-label"><i class="mdi mdi-magnify"></i></span>Buscar
                                        </button>
                                    </div>
                                    <button type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Actualizar" class="btn btn-blue waves-effect waves-light" @click="listarEmisionderecibo(1,buscar,criterio)"><i class="mdi mdi-refresh"></i></button>
                                                    
                                </div>
                            </div>
                            <br>
                            
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped verticle-middle align-middle table-hover">
                                    <thead class="table-warning">
                                        <tr align="center">
                                            <th>Emision de recibo</th>                                            
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="emisionderecibo in arrayEmisionderecibo" :key="emisionderecibo.id"> 
                                            <td v-text="emisionderecibo.nombre_emisionderecibo"></td>
                                            <td align="center">
                                                <div class="button-list">
                                                    <button type="button" data-bs-toggle="tooltip" @click="abrirModal('emisionderecibo','actualizar',emisionderecibo)" data-bs-placement="top" title="Editar" class="btn btn-warning waves-effect waves-light"><i class="mdi mdi-pencil-outline"></i></button>
                                                    <button type="button" data-bs-toggle="tooltip" @click="eliminarIngreso(emisionderecibo.id_emisionderecibo)" data-bs-placement="top" title="Elimar" class="btn btn-danger waves-effect waves-light"><i class="mdi mdi-trash-can-outline"></i></button>
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
                                <label for="field-3" class="form-label">Emisión de recibo *</label>
                                <input type="text" class="form-control" v-model="nombre_emisionderecibo" placeholder="Emisión de recibo">
                            </div>
                        </div>
                    </div>                    
                    <br>
                    <div v-show="errorEmisionderecibo" class="form-group row div-error">
                        <div class="text-center" style="color: red;">
                            <li v-for="error in errorMostrarMsjEmisionderecibo" :key="error" v-text="error">

                            </li>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" @click="cerrarModal()">Cancelar</button>
                    <button type="button" v-if="tipoAccion==1" @click="registrarEmisionderecibo()" class="btn btn-blue waves-effect waves-light">Guardar</button>
                    <button type="button" v-if="tipoAccion==2" @click="actualizarEmisionderecibo()" class="btn btn-blue waves-effect waves-light">Actualizar</button>
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
        nombre_emisionderecibo:'',  
        arrayEmisionderecibo:[],        
        
        tituloModal:'',
        tipoAccion : 0,
        errorEmisionderecibo : 0,
        errorMostrarMsjEmisionderecibo : [],
        pagination : {
            'total' : 0,
            'current_page' : 0,
            'per_page' : 0,
            'last_page' : 0,
            'from' : 0,
            'to' : 0,
        },
        offset : 3,
        criterio : 'nombre_emisionderecibo',
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
    listarEmisionderecibo(page,buscar,criterio){
        let me = this;
        me.isLoading = true;
        var url= 'api/emisionderecibo/?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
        axios.get(url).then(function (response) {            
            me.isLoading = false
            var respuesta= response.data;
            me.arrayEmisionderecibo = respuesta.emisionderecibo.data;
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
    registrarEmisionderecibo(){
        if (this.validarEmisionderecibo()){
            return;
        }
        
        let me = this;

        axios.post('api/emisionderecibo/insert',{            
            'nombre_emisionderecibo': this.nombre_emisionderecibo            
        }).then(function (response) {
            me.cerrarModal();
            me.listarEmisionderecibo(1,'','nombre_emisionderecibo');
            Swal.fire('¡Guardado!', 'El Emisión de recibo se registró correctamente', 'success')
        }).catch(function (error) {
            Swal.fire({
                icon: 'error',
                title: 'Error...',
                text: 'Error en el servidro!'
            })
        });
    }, 
    actualizarEmisionderecibo(){
        if (this.validarEmisionderecibo()){
            return;
        }
        
        let me = this;

        axios.put('api/emisionderecibo/update',{
            'nombre_emisionderecibo': this.nombre_emisionderecibo,
            'id_emisionderecibo': this.id
        }).then(function (response) {
            me.cerrarModal();
            me.listarEmisionderecibo(1,'','nombre_emisionderecibo');
            Swal.fire('¡Actualizado!', 'El Emisión de recibo se actualizo correctamente', 'success')
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
        title: '¿Desea eliminar este emisión de recibo?',
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
            axios.delete('api/emisionderecibo/delete/'+id).then(function (response) {
                console.log(response);               
                me.listarEmisionderecibo(1,'','nombre_emisionderecibo');
                swalWithBootstrapButtons.fire(
                '¡Eliminado!',
                'El emisión de recibo ha sido eliminado.',
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
            'No eliminó este emisión de recibo',
            'error'
            )
        }
        });
    },
    limpiarText(){
        let me= this;
        me.fecha_ingreso='';        
        me.nombre_emisionderecibo='';        
        me.descripcion_ingreso='';        
        me.nrecibo_ingreso='';        
        me.monto_ingreso='';
        me.errorMostrarMsjEmisionderecibo = [];
    },
    abrirModal(modelo, accion, data = []){
        $('#con-close-modal').modal('show');   
        switch(modelo){
            case "emisionderecibo":
            {
                switch(accion){
                    case 'registrar':
                    {
                        this.tituloModal = 'Registrar Emisión de recibo';
                        this.tipoAccion=1;
                        this.limpiarText();
                        break;
                    }
                    case 'actualizar':
                    {                       
                        this.tituloModal='Actualizar Emisión de recibo';
                        this.tipoAccion=2;
                        this.id=data['id_emisionderecibo'];
                        this.nombre_emisionderecibo= data['nombre_emisionderecibo'];
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
    validarEmisionderecibo(){
        this.errorEmisionderecibo=0;
        this.errorMostrarMsjEmisionderecibo =[];

        if (!this.nombre_emisionderecibo) this.errorMostrarMsjEmisionderecibo.push("El emisión de recibo no puede estar vacío.");

        if (this.errorMostrarMsjEmisionderecibo.length) this.errorEmisionderecibo = 1;

        return this.errorEmisionderecibo;
    },

    
    
  },
  mounted() {
    this.listarEmisionderecibo(1,this.buscar,this.criterio);
  },
};
</script>
