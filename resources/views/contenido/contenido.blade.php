
<div id="app">
    <!-- CONTABILIDAD -->
    <template v-if="menu==0">
        <ingreso></ingreso>
    </template>
    <template v-if="menu==1">
        <egreso></egreso>
    </template>
    <template v-if="menu==2">
        <formapago></formapago>
    </template>
    <template v-if="menu==3">
        <tipocliente></tipocliente>
    </template>
    <template v-if="menu==4">
        <emisionderecibo></emisionderecibo>
    </template>
    <!-- ALMACEN -->
    <template v-if="menu==5">
        <tipoutensilio></tipoutensilio>
    </template>
    <template v-if="menu==6">
        <utensilio></utensilio>
    </template>
    <!-- TOUR -->
    <template v-if="menu==7">
        <empresa></empresa>
    </template>
    <template v-if="menu==8">
        <tour></tour>
    </template>
    <!-- HABITACIONES -->
    <template v-if="menu==9">
        <tipohabitacion></tipohabitacion>
    </template>
    <template v-if="menu==10">
        <habitacion></habitacion>
    </template>
    <!-- DISPENSA -->
    <template v-if="menu==11">
        <categoriadispensa></categoriadispensa>
    </template>
    <template v-if="menu==12">
        <dispensa></dispensa>
    </template>
    <!-- CLIENTE -->
    <template v-if="menu==13">
        <cliente></cliente>
    </template>
    <!-- RESERVACIONES -->
    <template v-if="menu==14">
        <reservacion></reservacion>
    </template>
    <template v-if="menu==15">
        <hospedaje></hospedaje>
    </template>

</div>
