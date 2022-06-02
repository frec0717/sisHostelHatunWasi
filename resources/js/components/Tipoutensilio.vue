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
               
                <h4 class="page-title">Tipo de utensilio </h4>                
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <button type="button" class="btn btn-blue waves-effect waves-light" @click="abrirModal('tipoutensilio','registrar')">
                                Nuevo
                                <span class="btn-label-right"><i class="mdi mdi-plus"></i></span>
                            </button>
                            <br>
                            <br>
                            <div class="col-12">
                                <div class="input-group">
                                    <select class="form-select col-lg-12 col-md-1 col-sm-1" v-model="criterio">
                                        <option value="nombre_tipoutensilio">Nombre</option>
                                    </select>
                                    <input type="text"  placeholder="Texto a buscar" v-model="buscar" @keyup.enter="listarTipoutensilio(1,buscar,criterio)" class="form-control col-lg-12 col-md-12 col-sm-12 ">
                                   
                                    <div class="col-lg-7 col-md-6 col-sm-12">
                                        <button type="submit"  @click="listarTipoutensilio(1,buscar,criterio)" class="btn btn-blue waves-effect waves-light">
                                            <span class="btn-label"><i class="mdi mdi-magnify"></i></span>Buscar
                                        </button>
                                    </div>
                                    <button type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Actualizar" class="btn btn-blue waves-effect waves-light" @click="listarTipoutensilio(1,buscar,criterio)"><i class="mdi mdi-refresh"></i></button>
                                                    
                                </div>
                            </div>
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
                                                    <button type="button" data-bs-toggle="tooltip" @click="abrirModal('tipoutensilio','actualizar',tipoutensilio)" data-bs-placement="top" title="Editar" class="btn btn-warning waves-effect waves-light"><i class="mdi mdi-pencil-outline"></i></button>
                                                    <button type="button" data-bs-toggle="tooltip" @click="eliminarTipoutensilio(tipoutensilio.id_tipoutensilio)" data-bs-placement="top" title="Elimar" class="btn btn-danger waves-effect waves-light"><i class="mdi mdi-trash-can-outline"></i></button>
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

    <div id="con-close-modal" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalElbel" aria-hidden="true" style="display: none;">
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
                                <label for="field-3" class="form-label">Tipo de utensilio *</label>
                                <input type="text" class="form-control" v-model="nombre_tipoutensilio" placeholder="Tipo de utensilio">
                            </div>
                        </div>
                    </div>                    
                    <br>
                    <div v-show="errorTipoutensilio" class="form-group row div-error">
                        <div class="text-center" style="color: red;">
                            <li v-for="error in errorMostrarMsjTipoutensilio" :key="error" v-text="error">

                            </li>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" @click="cerrarModal()">Cancelar</button>
                    <button type="button" v-if="tipoAccion==1" @click="registrarTipoutensilio()" class="btn btn-blue waves-effect waves-light">Guardar</button>
                    <button type="button" v-if="tipoAccion==2" @click="actualizarTipoutensilio()" class="btn btn-blue waves-effect waves-light">Actualizar</button>
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
        nombre_tipoutensilio:'',  
        arrayTipoutensilio:[],        
        
        tituloModal:'',
        tipoAccion : 0,
        errorTipoutensilio : 0,
        errorMostrarMsjTipoutensilio : [],
        pagination : {
            'total' : 0,
            'current_page' : 0,
            'per_page' : 0,
            'last_page' : 0,
            'from' : 0,
            'to' : 0,
        },
        offset : 3,
        criterio : 'nombre_tipoutensilio',
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
    listarTipoutensilio(page,buscar,criterio){
        let me = this;
        me.isLoading = true;
        var url= 'api/tipoutensilio/?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
        axios.get(url).then(function (response) {            
            me.isLoading = false
            var respuesta= response.data;
            me.arrayTipoutensilio = respuesta.tipoutensilio.data;
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
    registrarTipoutensilio(){
        if (this.validarTipoutensilio()){
            return;
        }
        
        let me = this;

        axios.post('api/tipoutensilio/insert',{            
            'nombre_tipoutensilio': this.nombre_tipoutensilio            
        }).then(function (response) {
            me.cerrarModal();
            me.listarTipoutensilio(1,'','nombre_tipoutensilio');
            Swal.fire('¡Guardado!', 'El tipo de utensilio se registró correctamente', 'success')
        }).catch(function (error) {
            Swal.fire({
                icon: 'error',
                title: 'Error...',
                text: 'Error en el servidro!'
            })
        });
    }, 
    actualizarTipoutensilio(){
        if (this.validarTipoutensilio()){
            return;
        }
        
        let me = this;

        axios.put('api/tipoutensilio/update',{
            'nombre_tipoutensilio': this.nombre_tipoutensilio,
            'id_tipoutensilio': this.id
        }).then(function (response) {
            me.cerrarModal();
            me.listarTipoutensilio(1,'','nombre_tipoutensilio');
            Swal.fire('¡Actualizado!', 'El tipo de utensilio se actualizo correctamente', 'success')
        }).catch(function (error) {
            Swal.fire({
                icon: 'error',
                title: 'Error...',
                text: 'Error en el servidro!'
            })
        }); 
    }, 
    eliminarTipoutensilio(id){
        const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
        title: '¿Desea eliminar este tipo de utensilio?',
        text: "¡SE ELIMINARA LOS REGISTROS DE UTENSILIOS RELACIONADO AL TIPO DE UTENSILIO!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: '¡Sí, eliminar!',
        cancelButtonText: '¡No, cancelar!',
        reverseButtons: true
        }).then((result) => {
        if (result.isConfirmed) {

            let me = this;
            console.log(id);
            axios.delete('api/tipoutensilio/delete/'+id).then(function (response) {
                console.log(response);               
                me.listarTipoutensilio(1,'','nombre_tipoutensilio');
                swalWithBootstrapButtons.fire(
                '¡Eliminado!',
                'El tipo de utensilio ha sido eliminado.',
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
            'No eliminó este tipo de utensilio',
            'error'
            )
        }
        });
    },
    limpiarText(){
        let me= this; 
        me.nombre_tipoutensilio='';       
        me.errorMostrarMsjTipoutensilio = [];
    },
    abrirModal(modelo, accion, data = []){
        $('#con-close-modal').modal('show');   
        switch(modelo){
            case "tipoutensilio":
            {
                switch(accion){
                    case 'registrar':
                    {
                        this.tituloModal = 'Registrar Tipo de utensilio';
                        this.tipoAccion=1;
                        this.limpiarText();
                        break;
                    }
                    case 'actualizar':
                    {                       
                        this.tituloModal='Actualizar Tipo de utensilio';
                        this.tipoAccion=2;
                        this.id=data['id_tipoutensilio'];
                        this.nombre_tipoutensilio= data['nombre_tipoutensilio'];
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
    validarTipoutensilio(){
        this.errorTipoutensilio=0;
        this.errorMostrarMsjTipoutensilio =[];

        if (!this.nombre_tipoutensilio) this.errorMostrarMsjTipoutensilio.push("El tipo de utensilio no puede estar vacío.");

        if (this.errorMostrarMsjTipoutensilio.length) this.errorTipoutensilio = 1;

        return this.errorTipoutensilio;
    },

    
    
  },
  mounted() {
    this.listarTipoutensilio(1,this.buscar,this.criterio);
  },
};
</script>
