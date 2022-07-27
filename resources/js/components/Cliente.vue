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

                <h4 class="page-title">Clientes</h4>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <button type="button" class="btn btn-blue waves-effect waves-light" @click="abrirModal('cliente','registrar')">
                                Nuevo
                                <span class="btn-label-right"><i class="mdi mdi-plus"></i></span>
                            </button>
                            <br>
                            <br>
                            <div class="col-12">
                                <div class="input-group">
                                    <select class="form-select col-lg-12 col-md-1 col-sm-1" v-model="criterio">
                                        <option value="nombre_cliente">Nombres</option>
                                        <option value="dniruc_cliente">N° de identidad</option>
                                        <option value="nombre_tipocliente">Tipo de cliente</option>
                                    </select>
                                    <input type="text"  placeholder="Texto a buscar" v-model="buscar" @keyup.enter="listarCliente(1,buscar,criterio)" class="form-control col-lg-12 col-md-12 col-sm-12 ">
                                    <div class="col-lg-7 col-md-6 col-sm-12">
                                        <button type="submit"  @click="listarCliente(1,buscar,criterio)" class="btn btn-blue waves-effect waves-light">
                                            <span class="btn-label"><i class="mdi mdi-magnify"></i></span>Buscar
                                        </button>
                                    </div>
                                    <button type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Actualizar" class="btn btn-blue waves-effect waves-light" @click="listarCliente(1,buscar,criterio)"><i class="mdi mdi-refresh"></i></button>

                                </div>
                            </div>
                            <br>

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped verticle-middle align-middle table-hover">
                                    <thead class="table-warning">
                                        <tr align="center">
                                            <th>Tipo de cliente</th>
                                            <th>Identificación</th>
                                            <th>Nombres</th>
                                            <th>Celular</th>
                                            <th>Extranjero</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="cliente in arrayCliente" :key="cliente.id">
                                            <td align="center" v-text="cliente.tipoclientes[0].nombre_tipocliente"></td>
                                            <td align="center" v-text="cliente.dniruc_cliente"></td>
                                            <td v-text="cliente.nombre_cliente"></td>
                                            <td v-text="cliente.celular_cliente"></td>
                                            <td>
                                                <template v-if="cliente.estranjero_cliente == 1">
                                                    <div class="d-flex justify-content-center">
                                                        <div class="form-check mb-2 form-check-blue">
                                                            <input class="form-check-input" type="checkbox" checked="" disabled>
                                                        </div>
                                                    </div>
                                                </template>
                                                <template v-else>
                                                    <div class="d-flex justify-content-center">
                                                        <div class="form-check mb-2 form-check-blue" >
                                                            <input class="form-check-input" type="checkbox" disabled>
                                                        </div>
                                                    </div>
                                                </template>

                                            </td>
                                            <td align="center">
                                                <div class="button-list">
                                                    <button type="button" data-bs-toggle="tooltip" @click="abrirModal('cliente','actualizar',cliente)" data-bs-placement="top" title="Editar" class="btn btn-warning waves-effect waves-light"><i class="mdi mdi-pencil-outline"></i></button>
                                                    <button type="button" data-bs-toggle="tooltip" @click="eliminarCliente(cliente.id_cliente)" data-bs-placement="top" title="Elimar" class="btn btn-danger waves-effect waves-light"><i class="mdi mdi-trash-can-outline"></i></button>
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
                        <div class="col-md-6">
                            <div class="mb-3">
                                 <label class="form-label">Tipo de cliente*</label>
                                <select class="form-select" v-model="id_tipocliente">
                                    <option v-for="tipocliente in arrayTipocliente" v-bind:value="tipocliente.id_tipocliente" :key="tipocliente.id_tipocliente" >{{ tipocliente.nombre_tipocliente }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="field-2" class="form-label">Extranjero*</label>
                                <div class="form-check mb-2 form-check-blue">
                                    <input class="form-check-input" type="checkbox" v-bind:value="estranjero_cliente" v-model="estranjero_cliente">
                                    <label class="form-check-label" for="customckeck7">Extranjero</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="field-2" class="form-label">N° de Identidad*</label>
                                <input type="number" class="form-control" v-model="dniruc_cliente" placeholder="N° de Identidad*">
                            </div>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="field-2" class="form-label">Nombres*</label>
                                <input type="text" class="form-control" v-model="nombre_cliente" placeholder="Nombres">
                            </div>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="field-2" class="form-label">Dirección*</label>
                                <input type="text" class="form-control" v-model="direccion_cliente" placeholder="Dirección">
                            </div>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="field-2" class="form-label">Celular*</label>
                                <input type="number" class="form-control" v-model="celular_cliente" placeholder="Celular">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="field-2" class="form-label">Teléfono</label>
                                <input type="number" class="form-control" v-model="telefono_cliente" placeholder="Teléfono">
                            </div>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="field-2" class="form-label">Correo electrónico</label>
                                <input type="text" class="form-control" v-model="correo_cliente" placeholder="Correo electrónico">
                            </div>
                        </div>
                    </div>

                    <br>
                    <div v-show="errorCliente" class="form-group row div-error">
                        <div class="text-center" style="color: red;">
                            <li v-for="error in errorMostrarMsjCliente" :key="error" v-text="error">

                            </li>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" @click="cerrarModal()">Cancelar</button>
                    <button type="button" v-if="tipoAccion==1" @click="registrarCliente()" class="btn btn-blue waves-effect waves-light">Guardar</button>
                    <button type="button" v-if="tipoAccion==2" @click="actualizarCliente()" class="btn btn-blue waves-effect waves-light">Actualizar</button>
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
        dniruc_cliente:'',
        nombre_cliente:'',
        direccion_cliente:'',
        celular_cliente:'',
        telefono_cliente:'',
        correo_cliente:'',
        estranjero_cliente:0,
        arrayCliente:[],
        arrayTipocliente:[],
        id_tipocliente: 1,
        nombre_tipocliente:'',

        tituloModal:'',
        tipoAccion : 0,
        errorCliente : 0,
        errorMostrarMsjCliente : [],
        pagination : {
            'total' : 0,
            'current_page' : 0,
            'per_page' : 0,
            'last_page' : 0,
            'from' : 0,
            'to' : 0,
        },
        offset : 3,
        criterio : 'nombre_cliente',
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

    listarTipocliente(){
        let me = this;
        var url= 'api/tipocliente/';
        axios.get(url).then(function (response) {
            var respuesta= response.data;
            me.arrayTipocliente = respuesta.tipocliente.data;
        })
        .catch(function(error){
            Swal.fire({
                icon: 'error',
                title: 'Error...',
                text: 'Error en el servidrossss!'
            })

        });
    },
    listarCliente(page,buscar,criterio){
        let me = this;
        me.isLoading = true;
        var url= 'api/cliente/?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
        axios.get(url).then(function (response) {
            var respuesta= response.data;
            me.arrayCliente = respuesta.cliente.data;
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
    registrarCliente(){
        if (this.validarCliente()){
            return;
        }

        let me = this;

        axios.post('api/cliente/insert',{
            'tipocliente_id': this.id_tipocliente,
            'dniruc_cliente': this.dniruc_cliente,
            'nombre_cliente': this.nombre_cliente,
            'direccion_cliente': this.direccion_cliente,
            'celular_cliente': this.celular_cliente,
            'telefono_cliente': this.telefono_cliente,
            'correo_cliente': this.correo_cliente,
            'estranjero_cliente': this.estranjero_cliente
        }).then(function (response) {
            me.cerrarModal();
            me.listarCliente(1,'','nombre_cliente');
            Swal.fire('¡Guardado!', 'El cliente se registró correctamente', 'success')
        }).catch(function (error) {
            Swal.fire({
                icon: 'error',
                title: 'Error...',
                text: 'Error en el servidro!'
            })
        });
    },
    actualizarCliente(){
        if (this.validarCliente()){
            return;
        }

        let me = this;

        axios.put('api/cliente/update',{
            'tipocliente_id': this.id_tipocliente,
            'dniruc_cliente': this.dniruc_cliente,
            'nombre_cliente': this.nombre_cliente,
            'direccion_cliente': this.direccion_cliente,
            'celular_cliente': this.celular_cliente,
            'telefono_cliente': this.telefono_cliente,
            'correo_cliente': this.correo_cliente,
            'estranjero_cliente': this.estranjero_cliente,
            'id_cliente': this.id
        }).then(function (response) {
            console.log(response);
            me.cerrarModal();
            me.listarCliente(1,'','nombre_cliente');
            Swal.fire('¡Actualizado!', 'El cliente se actualizo correctamente', 'success')
        }).catch(function (error) {
            Swal.fire({
                icon: 'error',
                title: 'Error...',
                text: 'Error en el servidro!'
            })
        });
    },
    eliminarCliente(id){
        const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
        title: '¿Desea eliminar este cliente?',
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
            axios.delete('api/cliente/delete/'+id).then(function (response) {
                console.log(response);
                me.listarCliente(1,'','nombre_cliente');
                swalWithBootstrapButtons.fire(
                '¡Eliminado!',
                'la cliente ha sido eliminado.',
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
            'No eliminó este cliente',
            'error'
            )
        }
        });
    },
    limpiarText(){
        let me= this;
        me.nombre_cliente='';
        me.id_tipocliente=1;
        me.dniruc_cliente='',
        me.nombre_cliente='',
        me.direccion_cliente='',
        me.celular_cliente='',
        me.telefono_cliente='',
        me.correo_cliente='',
        me.estranjero_cliente=0,
        me.errorMostrarMsjCliente = [];
    },
    abrirModalTipocliente(){
        $('#modalTipocliente').modal('show');
        this.listarTipocliente(1,'','nombre_tipocliente');
    },
    cerrarModalTipocliente(){
        let me = this;
        $('#modalTipocliente').modal('hide');
    },
    agregarTipocliente(data = []){
        this.id_tipocliente = data['id_tipocliente'];
        this.nombre_tipocliente = data['nombre_tipocliente'];
        this.cerrarModalTipocliente();
    },
    abrirModal(modelo, accion, data = []){
        $('#con-close-modal').modal('show');
        switch(modelo){
            case "cliente":
            {
                switch(accion){
                    case 'registrar':
                    {
                        this.tituloModal = 'Registrar Cliente';
                        this.tipoAccion=1;
                        this.limpiarText();
                        break;
                    }
                    case 'actualizar':
                    {
                        this.tituloModal='Actualizar Cliente';
                        this.tipoAccion=2;
                        this.id=data['id_cliente'];

                        this.id_tipocliente = data['tipoclientes'][0].id_tipocliente;
                        this.dniruc_cliente= data['dniruc_cliente'];
                        this.nombre_cliente = data['nombre_cliente'];
                        this.direccion_cliente= data['direccion_cliente'];
                        this.celular_cliente= data['celular_cliente'];
                        this.telefono_cliente= data['telefono_cliente'];
                        this.correo_cliente= data['correo_cliente'];
                        this.estranjero_cliente= parseFloat(data['estranjero_cliente']);
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
    validarCliente(){
        this.errorCliente=0;
        this.errorMostrarMsjCliente =[];

        if (!this.nombre_cliente) this.errorMostrarMsjCliente.push("El nombre del cliente no puede estar vacío.");
        if (!this.id_tipocliente) this.errorMostrarMsjCliente.push("El tipo de cliente no puede estar vacío.");
        if (!this.dniruc_cliente) this.errorMostrarMsjCliente.push("La identificación del cliente no puede estar vacío.");
        if (!this.direccion_cliente) this.errorMostrarMsjCliente.push("La dirección del cliente no puede estar vacío.");
        if (!this.celular_cliente) this.errorMostrarMsjCliente.push("El celular del cliente no puede estar vacío.");

        if (this.errorMostrarMsjCliente.length) this.errorCliente = 1;

        return this.errorCliente;
    },



  },
  mounted() {
    this.listarCliente(1,this.buscar,this.criterio);
    this.listarTipocliente();
  },
};
</script>
