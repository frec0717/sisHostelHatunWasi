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
               
                <h4 class="page-title">Reservaciones </h4>                
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-3">
                                    <button class="btn btn-lg font-16 btn-blue w-100" ><i class="mdi mdi-plus"></i> Nueva reservación</button>
                                    <br><br>
                                   
                                <div class="col-12">
                                    <div class="input-group">
                                        <select class="form-select" v-model="criterio">
                                            <option value="nombre_ingreso">Cliente</option>
                                            <option value="fecha_ingreso">Fecha</option>
                                            <option value="nrecibo_ingreso">N° Recibo</option>
                                        </select>
                                        <!-- <select class="form-control  col-lg-2 col-md-2 col-sm-3 input-default" v-model="criterio">
                                            <option value="nombre_cargo">Cargo</option> 
                                        </select> -->
                                        <template v-if="buscarReturn">
                                        <input type="date"  placeholder="Texto a buscar" v-model="buscar"  class="form-control">                                    
                                        </template>
                                        <template v-else>
                                            <input type="text"  placeholder="Texto a buscar" v-model="buscar" @keyup.enter="listarIngreso(1,buscar,criterio)" class="form-control col-lg-12 col-md-12 col-sm-12 ">
                                        </template>                                        
                                        <button type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Buscar" class="btn btn-blue waves-effect waves-light" @click="listarIngreso(1,buscar,criterio)"><i class="mdi mdi-magnify"></i></button>
                                        <button type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Actualizar" class="btn btn-blue waves-effect waves-light" @click="listarIngreso(1,buscar,criterio)"><i class="mdi mdi-refresh"></i></button>
                                                        
                                    </div>
                                </div>
                                <br>
                                <div class="table-responsive" >
                                    <table class="table table-bordered table-striped verticle-middle align-middle table-hover" >
                                        <thead class="table-warning">
                                            <tr align="center">
                                                <th>Fecha</th>
                                                <th>Cliente</th>
                                                <th>Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="ingreso in arrayIngreso" :key="ingreso.id">                                                                                     
                                                <td align="center" v-text="ingreso.fecha_ingreso"></td>
                                                <td v-text="ingreso.nombre_ingreso"></td>
                                                
                                                
                                                <td align="center">
                                                    <div class="button-list">
                                                        <button type="button" data-bs-toggle="tooltip" @click="abrirModal('ingreso','ver',ingreso)" data-bs-placement="top" title="Ver detalle" class="btn btn-blue waves-effect waves-light" ><i class="mdi mdi-eye"></i></button>
                                                        <button type="button" data-bs-toggle="tooltip" @click="abrirModal('ingreso','actualizar',ingreso)" data-bs-placement="top" title="Editar" class="btn btn-warning waves-effect waves-light"><i class="mdi mdi-pencil-outline"></i></button>
                                                        <button type="button" data-bs-toggle="tooltip" @click="eliminarIngreso(ingreso.id_ingreso)" data-bs-placement="top" title="Elimar" class="btn btn-danger waves-effect waves-light"><i class="mdi mdi-trash-can-outline"></i></button>
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
                                </div> <!-- end col-->

                                <div class="col-lg-9">
                                    <!-- <div id="calendar"></div> -->
                                    
                                    <FullCalendar :options="calendarOptions"></FullCalendar>
                                </div> <!-- end col -->

                            </div>  <!-- end row -->
                        </div> <!-- end card-body -->
                    </div> <!-- end card -->
                    <!-- Add New Event MODAL -->
                    <div class="modal fade" id="event-modal" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header py-3 px-4 border-bottom-0 d-block">
                                    <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                                    <h5 class="modal-title" id="modal-title">Event</h5>
                                </div>
                                <div class="modal-body px-4 pb-4 pt-0">
                                    <form class="needs-validation" name="event-form" id="form-event" novalidate>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Event Name</label>
                                                    <input class="form-control" placeholder="Insert Event Name"
                                                        type="text" name="title" id="event-title" required />
                                                    <div class="invalid-feedback">Please provide a valid event name</div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Category</label>
                                                    <select class="form-select" name="category" id="event-category" required>
                                                        <option value="bg-danger" selected>Danger</option>
                                                        <option value="bg-success">Success</option>
                                                        <option value="bg-primary">Primary</option>
                                                        <option value="bg-info">Info</option>
                                                        <option value="bg-dark">Dark</option>
                                                        <option value="bg-warning">Warning</option>
                                                    </select>
                                                    <div class="invalid-feedback">Please select a valid event category</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-6 col-4">
                                                <button type="button" class="btn btn-danger" id="btn-delete-event">Delete</button>
                                            </div>
                                            <div class="col-md-6 col-8 text-end">
                                                <button type="button" class="btn btn-light me-1" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-success" id="btn-save-event">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div> <!-- end modal-content-->
                        </div> <!-- end modal dialog-->
                    </div>
                    <!-- end modal-->
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

import '@fullcalendar/core/vdom' // solves problem with Vite
import FullCalendar from '@fullcalendar/vue'
import interactionPlugin, { Draggable } from '@fullcalendar/interaction'

import dayGridPlugin from '@fullcalendar/daygrid'
import timeGridPlugin from '@fullcalendar/timegrid';
import listPlugin from '@fullcalendar/list';

import esLocale from '@fullcalendar/core/locales/es';

 
export default {  
    components:{
        Loading,FullCalendar
    },
  data () {
    return {

        calendarOptions: {
        plugins: [ dayGridPlugin, interactionPlugin,timeGridPlugin,listPlugin ],
        headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay,dayGridWeek,listWeek'
      },
        droppable: true,
        drop: function(info) {
        // is the "remove after drop" checkbox checked?
        if (checkbox.checked) {
          // if so, remove the element from the "Draggable Events" list
          info.draggedEl.parentNode.removeChild(info.draggedEl);
        }
      },
        // height:'100%',
        height:'auto',
        dayMaxEvents: true,
        editable: true,
        weekNumbers: true,
        dateClick: this.handleDateClick,
        eventClick: this.mostrarClick,        
        initialView: 'dayGridMonth',
        themeSystem: 'bootstrap',
        select: this.handleDateClick,
        timeZone: 'local',
        locale: esLocale,
        events: [
          { 
            id:'1',
            title: 'event 1', 
            start: '2021-12-07T07:30:00',
            end: '2021-12-07T10:30:00',
            className: "bg-warning", 
          },
          { 
            id:'1',
            title: 'event 2', 
            start: '2021-12-08T07:30:00',
            end: '2021-12-08T10:30:00',
            className: "bg-warning",
          },
          
        ]
      },

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
     
      handleDateClick: function(arg) {
           var dt = datetime.create(arg.dateStr);
            var fh = dt.format('Y/m/d H:M:S');
            var d = new Date();
            d.setDate(d.getDate()-1);
           var dtc = datetime.create(d);
            var fhc = dtc.format('Y/m/d H:M:S');
    //       var check = moment(arg.dateStr).format('YYYY-MM-DD');
    //   var today = moment(new Date()).format('YYYY-MM-DD');
       
      // si el inicio de evento ocurre hoy o en el futuro mostramos el modal
      if (fh >= fhc) {

          // éste es el código que tenías originalmente en el select
        //   $('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD'));
        //   $('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD'));
        //   $('#ModalAdd').modal('show');
          alert('date click! ' + arg.dateStr)
      }
      // si no, mostramos una alerta de error
      else {
          alert("No se pueden crear eventos en el pasado!");
      }
      

    },
      mostrarClick: function(arg) {
           var dtc = datetime.create(arg.event.start);
            var fhc = dtc.format('Y/m/d H:M:S');
           var dtcs = datetime.create(arg.event.end);
            var fhcs = dtcs.format('Y/m/d H:M:S');
      alert('inicio! ' + fhc +' ---- '+'final! ' + fhcs );
    },
    
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
       console.log(new Date());
    },
};
</script>
