<template>
  <div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Extras Pages</a></li>
                        <li class="breadcrumb-item active">Starter</li>
                    </ol>
                </div>
                <h4 class="page-title">DASHBOARD </h4>
                <a href="mailto:rafa@gmail.com?Subject=Interesado%20en%20el%20curso">Contactar por correo</a>
            </div>
        </div>
    </div>
    <!-- end page title -->

</div> <!-- container -->
</template>

<script>
export default {
  data () {
    return {
        hola:'hola',
    }
  },
  mounted() {
    console.log("Component mounted.");
  },
};
</script>
