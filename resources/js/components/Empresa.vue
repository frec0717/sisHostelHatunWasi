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
               
                <h4 class="page-title">Empresa </h4>                
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <button type="button" class="btn btn-blue waves-effect waves-light" @click="abrirModal('empresa','registrar')">
                                Nuevo
                                <span class="btn-label-right"><i class="mdi mdi-plus"></i></span>
                            </button>
                            <br>
                            <br>
                            <div class="col-12">
                                <div class="input-group">
                                    <select class="form-select col-lg-12 col-md-1 col-sm-1" v-model="criterio">
                                        <option value="razonsocial_empresa">Razón social</option>
                                        <option value="ruc_empresa">RUC</option>
                                    </select>
                                    <input type="text"  placeholder="Texto a buscar" v-model="buscar" @keyup.enter="listarEmpresa(1,buscar,criterio)" class="form-control col-lg-12 col-md-12 col-sm-12 ">
                                   
                                    <div class="col-lg-7 col-md-6 col-sm-12">
                                        <button type="submit"  @click="listarEmpresa(1,buscar,criterio)" class="btn btn-blue waves-effect waves-light">
                                            <span class="btn-label"><i class="mdi mdi-magnify"></i></span>Buscar
                                        </button>
                                    </div>
                                    <button type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Actualizar" class="btn btn-blue waves-effect waves-light" @click="listarEmpresa(1,buscar,criterio)"><i class="mdi mdi-refresh"></i></button>
                                                    
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
                                                    <button type="button" data-bs-toggle="tooltip" @click="abrirModal('empresa','actualizar',empresa)" data-bs-placement="top" title="Editar" class="btn btn-warning waves-effect waves-light"><i class="mdi mdi-pencil-outline"></i></button>
                                                    <button type="button" data-bs-toggle="tooltip" @click="eliminarEmpresa(empresa.id_empresa)" data-bs-placement="top" title="Elimar" class="btn btn-danger waves-effect waves-light"><i class="mdi mdi-trash-can-outline"></i></button>
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
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="field-3" class="form-label">RUC*</label>
                                <input type="text" class="form-control" v-model="ruc_empresa" placeholder="RUC">
                            </div>
                        </div>
                    </div>                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="field-3" class="form-label">Razon social*</label>
                                <input type="text" class="form-control" v-model="razonsocial_empresa" placeholder="Razon social">
                            </div>
                        </div>
                    </div>                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="field-3" class="form-label">Dirección*</label>
                                <input type="text" class="form-control" v-model="direccion_empresa" placeholder="Dirección">
                            </div>
                        </div>
                    </div>  
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="field-3" class="form-label">Celular*</label>
                                <input type="text" class="form-control" v-model="celular_empresa" placeholder="Celular">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="field-3" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" v-model="telefono_empresa" placeholder="Teléfono">
                            </div>
                        </div>
                    </div>  
                    <div class="row">
                        <div class="col-md-12">
                            <div class="">
                                <label for="field-7" class="form-label">Descripción</label>
                                <textarea class="form-control" v-model="descripcion_empresa" placeholder="Descripción"></textarea>
                            </div>
                        </div>
                    </div>                  
                    <br>
                    <div v-show="errorEmpresa" class="form-group row div-error">
                        <div class="text-center" style="color: red;">
                            <li v-for="error in errorMostrarMsjEmpresa" :key="error" v-text="error">

                            </li>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" @click="cerrarModal()">Cancelar</button>
                    <button type="button" v-if="tipoAccion==1" @click="registrarEmpresa()" class="btn btn-blue waves-effect waves-light">Guardar</button>
                    <button type="button" v-if="tipoAccion==2" @click="actualizarEmpresa()" class="btn btn-blue waves-effect waves-light">Actualizar</button>
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
        ruc_empresa:'',  
        razonsocial_empresa:'',  
        direccion_empresa:'',  
        celular_empresa:'',  
        telefono_empresa:'',  
        descripcion_empresa:'',  
        arrayEmpresa:[],        
        
        tituloModal:'',
        tipoAccion : 0,
        errorEmpresa : 0,
        errorMostrarMsjEmpresa : [],
        pagination : {
            'total' : 0,
            'current_page' : 0,
            'per_page' : 0,
            'last_page' : 0,
            'from' : 0,
            'to' : 0,
        },
        offset : 3,
        criterio : 'razonsocial_empresa',
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
    listarEmpresa(page,buscar,criterio){
        let me = this;
        me.isLoading = true;
        var url= 'api/empresa/?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
        axios.get(url).then(function (response) {            
            me.isLoading = false
            var respuesta= response.data;
            me.arrayEmpresa = respuesta.empresa.data;
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
    registrarEmpresa(){
        if (this.validarEmpresa()){
            return;
        }
        
        let me = this;

        axios.post('api/empresa/insert',{            
            'ruc_empresa': this.ruc_empresa,     
            'razonsocial_empresa': this.razonsocial_empresa,     
            'direccion_empresa': this.direccion_empresa,     
            'celular_empresa': this.celular_empresa,     
            'telefono_empresa': this.telefono_empresa,     
            'descripcion_empresa': this.descripcion_empresa
        }).then(function (response) {
            me.cerrarModal();
            me.listarEmpresa(1,'','razonsocial_empresa');
            Swal.fire('¡Guardado!', 'La empresa se registró correctamente', 'success')
        }).catch(function (error) {
            Swal.fire({
                icon: 'error',
                title: 'Error...',
                text: 'Error en el servidro!'
            })
        });
    }, 
    actualizarEmpresa(){
        if (this.validarEmpresa()){
            return;
        }
        
        let me = this;

        axios.put('api/empresa/update',{            
            'ruc_empresa': this.ruc_empresa,     
            'razonsocial_empresa': this.razonsocial_empresa,     
            'direccion_empresa': this.direccion_empresa,     
            'celular_empresa': this.celular_empresa,     
            'telefono_empresa': this.telefono_empresa,     
            'descripcion_empresa': this.descripcion_empresa,
            'id_empresa': this.id
        }).then(function (response) {
            me.cerrarModal();
            me.listarEmpresa(1,'','razonsocial_empresa');
            Swal.fire('¡Actualizado!', 'La empresa se actualizo correctamente', 'success')
        }).catch(function (error) {
            Swal.fire({
                icon: 'error',
                title: 'Error...',
                text: 'Error en el servidro!'
            })
        }); 
    }, 
    eliminarEmpresa(id){
        const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
        title: '¿Desea eliminar esta empresa?',
        text: "¡SE ELIMINARA LOS REGISTROS DE LOS TOURS RELACIONADO A LA EMPRESA!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: '¡Sí, eliminar!',
        cancelButtonText: '¡No, cancelar!',
        reverseButtons: true
        }).then((result) => {
        if (result.isConfirmed) {

            let me = this;
            console.log(id);
            axios.delete('api/empresa/delete/'+id).then(function (response) {
                console.log(response);               
                me.listarEmpresa(1,'','razonsocial_empresa');
                swalWithBootstrapButtons.fire(
                '¡Eliminado!',
                'La empresa ha sido eliminado.',
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
            'No eliminó esta empresa',
            'error'
            )
        }
        });
    },
    limpiarText(){
        let me= this; 
        me.ruc_empresa='';       
        me.razonsocial_empresa='';       
        me.direccion_empresa='';       
        me.celular_empresa='';       
        me.telefono_empresa='';       
        me.descripcion_empresa='';        
        me.errorMostrarMsjEmpresa = [];
    },
    abrirModal(modelo, accion, data = []){
        $('#con-close-modal').modal('show');   
        switch(modelo){
            case "empresa":
            {
                switch(accion){
                    case 'registrar':
                    {
                        this.tituloModal = 'Registrar Empresa';
                        this.tipoAccion=1;
                        this.limpiarText();
                        break;
                    }
                    case 'actualizar':
                    {                       
                        this.tituloModal='Actualizar Empresa';
                        this.tipoAccion=2;
                        this.id=data['id_empresa'];
                        this.ruc_empresa= data['ruc_empresa'];
                        this.razonsocial_empresa= data['razonsocial_empresa'];
                        this.direccion_empresa= data['direccion_empresa'];
                        this.celular_empresa= data['celular_empresa'];
                        this.telefono_empresa= data['telefono_empresa'];
                        this.descripcion_empresa= data['descripcion_empresa'];
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
    validarEmpresa(){
        this.errorEmpresa=0;
        this.errorMostrarMsjEmpresa =[];

        if (!this.ruc_empresa) this.errorMostrarMsjEmpresa.push("El RUC de la empresa no puede estar vacío.");
        if (!this.razonsocial_empresa) this.errorMostrarMsjEmpresa.push("La razon social de la empresa no puede estar vacío.");
        if (!this.direccion_empresa) this.errorMostrarMsjEmpresa.push("La dirección de la empresa no puede estar vacío.");
        if (!this.celular_empresa) this.errorMostrarMsjEmpresa.push("EL npumero celular de la empresa no puede estar vacío.");

        if (this.errorMostrarMsjEmpresa.length) this.errorEmpresa = 1;

        return this.errorEmpresa;
    },

    
    
  },
  mounted() {
    this.listarEmpresa(1,this.buscar,this.criterio);
  },
};
</script>
