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
               
                <h4 class="page-title">Egresos </h4>                
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <button type="button" class="btn btn-blue waves-effect waves-light" @click="abrirModal('egreso','registrar')">
                                Nuevo
                                <span class="btn-label-right"><i class="mdi mdi-plus"></i></span>
                            </button>
                            <br>
                            <br>
                            <div class="col-12">
                                <div class="input-group">
                                    <select class="form-select col-lg-12 col-md-1 col-sm-1" v-model="criterio">
                                        <option value="nombre_egreso">Egreso</option>
                                        <option value="fecha_egreso">Fecha</option>
                                        <option value="nrecibo_egreso">N° Recibo</option>
                                    </select>
                                    <!-- <select class="form-control  col-lg-2 col-md-2 col-sm-3 input-default" v-model="criterio">
                                        <option value="nombre_cargo">Cargo</option> 
                                    </select> -->
                                    <template v-if="buscarReturn">
                                       <input type="date"  placeholder="Texto a buscar" v-model="buscar"  class="form-control col-lg-12 col-md-12 col-sm-12 ">                                    
                                    </template>
                                    <template v-else>
                                        <input type="text"  placeholder="Texto a buscar" v-model="buscar" @keyup.enter="listarEgreso(1,buscar,criterio)" class="form-control col-lg-12 col-md-12 col-sm-12 ">
                                    </template>
                                    <div class="col-lg-7 col-md-6 col-sm-12">
                                        <button type="submit"  @click="listarEgreso(1,buscar,criterio)" class="btn btn-blue waves-effect waves-light">
                                            <span class="btn-label"><i class="mdi mdi-magnify"></i></span>Buscar
                                        </button>
                                    </div>
                                    <button type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Actualizar" class="btn btn-blue waves-effect waves-light" @click="listarEgreso(1,buscar,criterio)"><i class="mdi mdi-refresh"></i></button>
                                                    
                                </div>
                            </div>
                            <br>
                            
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped verticle-middle align-middle table-hover">
                                    <thead class="table-warning">
                                        <tr align="center">
                                            <th>Fecha</th>
                                            <th>Egreso</th>
                                            <th>Monto</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="egreso in arrayEgreso" :key="egreso.id">                                                                                     
                                            <td align="center" v-text="egreso.fecha_egreso"></td>
                                            <td v-text="egreso.nombre_egreso"></td>
                                            <td align="right" v-text="'S/. '+egreso.monto_egreso"></td>
                                            
                                            
                                            <td align="center">
                                                <div class="button-list">
                                                    <button type="button" data-bs-toggle="tooltip" @click="abrirModal('egreso','ver',egreso)" data-bs-placement="top" title="Ver detalle" class="btn btn-blue waves-effect waves-light" ><i class="mdi mdi-eye"></i></button>
                                                    <button type="button" data-bs-toggle="tooltip" @click="abrirModal('egreso','actualizar',egreso)" data-bs-placement="top" title="Editar" class="btn btn-warning waves-effect waves-light"><i class="mdi mdi-pencil-outline"></i></button>
                                                    <button type="button" data-bs-toggle="tooltip" @click="eliminarEgreso(egreso.id_egreso)" data-bs-placement="top" title="Elimar" class="btn btn-danger waves-effect waves-light"><i class="mdi mdi-trash-can-outline"></i></button>
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
                                <input type="date" class="form-control" v-model="fecha_egreso" placeholder="Fecha">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="field-2" class="form-label">N° de Recibo</label>
                                <input type="text" class="form-control" v-model="nrecibo_egreso" placeholder="N° de Recibo">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="field-3" class="form-label">Egreso *</label>
                                <input type="text" class="form-control" v-model="nombre_egreso" placeholder="Egreso">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="field-4" class="form-label">Monto *</label>
                                <input type="number" class="form-control" v-model="monto_egreso" placeholder="Monto">
                            </div>
                        </div>                        
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="">
                                <label for="field-7" class="form-label">Descripción</label>
                                <textarea class="form-control" v-model="descripcion_egreso" placeholder="Descripción"></textarea>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div v-show="errorEgreso" class="form-group row div-error">
                        <div class="text-center" style="color: red;">
                            <li v-for="error in errorMostrarMsjEgreso" :key="error" v-text="error">

                            </li>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" @click="cerrarModal()">Cancelar</button>
                    <button type="button" v-if="tipoAccion==1" @click="registrarEgreso()" class="btn btn-blue waves-effect waves-light">Guardar</button>
                    <button type="button" v-if="tipoAccion==2" @click="actualizarEgreso()" class="btn btn-blue waves-effect waves-light">Actualizar</button>
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
        fecha_egreso:'',        
        nombre_egreso:'',        
        descripcion_egreso:'',        
        nrecibo_egreso:'',        
        monto_egreso:'',        
        arrayEgreso:[],

        apnom:'',
        correo:'',
        fhorac:'',
        fhorae:'',
        
        tituloModal:'',
        tipoAccion : 0,
        errorEgreso : 0,
        errorMostrarMsjEgreso : [],
        pagination : {
            'total' : 0,
            'current_page' : 0,
            'per_page' : 0,
            'last_page' : 0,
            'from' : 0,
            'to' : 0,
        },
        offset : 3,
        criterio : 'nombre_egreso',
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
            if(me.criterio=="fecha_egreso"){
                
                me.buscar="";
               
                return 1;
            }else{
                
                me.buscar="";
                return 0;
            }           
              
        }
        
  },
  methods: {
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
    listarEgreso(page,buscar,criterio){
        let me = this;
        me.isLoading = true;
        var url= 'api/egreso/?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
        axios.get(url).then(function (response) {            
            me.isLoading = false
            var respuesta= response.data;
            me.arrayEgreso = respuesta.egreso.data;
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
    registrarEgreso(){
        if (this.validarEgreso()){
            return;
        }
        
        let me = this;

        axios.post('api/egreso/insert',{
            'id_user': this.id_user,
            'fecha_egreso': this.fecha_egreso,
            'nombre_egreso': this.nombre_egreso,
            'descripcion_egreso': this.descripcion_egreso,
            'nrecibo_egreso': this.nrecibo_egreso,
            'monto_egreso': this.monto_egreso
        }).then(function (response) {
            me.cerrarModal();
            me.listarEgreso(1,'','nombre_cargo');
            Swal.fire('¡Guardado!', 'El egreso se registró correctamente', 'success')
        }).catch(function (error) {
            Swal.fire({
                icon: 'error',
                title: 'Error...',
                text: 'Error en el servidro!'
            })
        });
    }, 
    actualizarEgreso(){
        if (this.validarEgreso()){
            return;
        }
        
        let me = this;

        axios.put('api/egreso/update',{
            'id_user': this.id_user,
            'fecha_egreso': this.fecha_egreso,
            'nombre_egreso': this.nombre_egreso,
            'descripcion_egreso': this.descripcion_egreso,
            'nrecibo_egreso': this.nrecibo_egreso,
            'monto_egreso': this.monto_egreso,
            'id_egreso': this.id
        }).then(function (response) {
            me.cerrarModal();
            me.listarEgreso(1,'','nombre_cargo');
            Swal.fire('¡Actualizado!', 'El egreso se actualizo correctamente', 'success')
        }).catch(function (error) {
            Swal.fire({
                icon: 'error',
                title: 'Error...',
                text: 'Error en el servidro!'
            })
        }); 
    }, 
    eliminarEgreso(id){
        const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
        title: '¿Desea eliminar este egreso?',
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
            axios.delete('api/egreso/delete/'+id).then(function (response) {
                console.log(response);               
                me.listarEgreso(1,'','nombre_cargo');
                swalWithBootstrapButtons.fire(
                '¡Eliminado!',
                'El egreso ha sido eliminado.',
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
            'No eliminó este egreso',
            'error'
            )
        }
        });
    },
    limpiarText(){
        let me= this;
        me.fecha_egreso='';        
        me.nombre_egreso='';        
        me.descripcion_egreso='';        
        me.nrecibo_egreso='';        
        me.monto_egreso='';
        me.errorMostrarMsjEgreso = [];
    },
    abrirModal(modelo, accion, data = []){
        $('#con-close-modal').modal('show');   
        switch(modelo){
            case "egreso":
            {
                switch(accion){
                    case 'registrar':
                    {
                        this.tituloModal = 'Registrar Egreso';
                        this.tipoAccion=1;
                        this.limpiarText();
                        break;
                    }
                    case 'actualizar':
                    {                       
                        this.tituloModal='Actualizar Egreso';
                        this.tipoAccion=2;
                        this.id=data['id_egreso'];
                        this.fecha_egreso = data['fecha_egreso'];
                        this.nombre_egreso= data['nombre_egreso'];
                        this.descripcion_egreso= data['descripcion_egreso'];
                        this.nrecibo_egreso= data['nrecibo_egreso'];
                        this.monto_egreso= data['monto_egreso'];
                        break;
                    }
                    case 'ver':
                    {                  
                        
                        this.tituloModal='Ver Egreso';
                        this.tipoAccion=3;
                        this.apnom=data.user[0].surnames+' '+data.user[0].name;
                        this.correo=data.user[0].email;                        
                        var dtc = datetime.create(data['created_at']);
                        var fhc = dtc.format('Y/m/d H:M:S');
                        var dte = datetime.create(data['updated_at']);
                        var fhe = dte.format('Y/m/d H:M:S');
                        this.fhorac=fhc;
                        this.fhorae=fhe;
                        this.id=data['id_egreso'];
                        this.fecha_egreso = data['fecha_egreso'];
                        this.nombre_egreso= data['nombre_egreso'];
                        this.descripcion_egreso= data['descripcion_egreso'];
                        this.nrecibo_egreso= data['nrecibo_egreso'];
                        this.monto_egreso= data['monto_egreso'];
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
    validarEgreso(){
        this.errorEgreso=0;
        this.errorMostrarMsjEgreso =[];

        if (!this.fecha_egreso) this.errorMostrarMsjEgreso.push("La fecha del egreso no puede estar vacío.");
        if (!this.nombre_egreso) this.errorMostrarMsjEgreso.push("El egreso no puede estar vacío.");
        if (!this.monto_egreso) this.errorMostrarMsjEgreso.push("El monto del egreso no puede estar vacío.");

        if (this.errorMostrarMsjEgreso.length) this.errorEgreso = 1;

        return this.errorEgreso;
    },

    
    
  },
  mounted() {
    this.listarEgreso(1,this.buscar,this.criterio);
    this.me();
  },
};
</script>
