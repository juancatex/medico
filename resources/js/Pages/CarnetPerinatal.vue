<script setup> 
import { Head,Link,useForm,router} from '@inertiajs/vue3';  
import Menus from '@/Layouts/Menus.vue'; 
import {getCurrentInstance,onMounted,watch,ref} from 'vue'; 
import Swal from 'sweetalert2';
import Pdfgen from '../pdf.js';  

const datapdf=ref(''); 
const props =defineProps({ 
    paciente: {
        type: Object,
    },
    ante: {
        type: Object,
    },
    gest: {
        type: Object,
    },
    controles: {
        type: Object,
    },
    
}); 
const componentName = getCurrentInstance()?.type.__name

 
onMounted(() => { 
      console.log(componentName); 
      datapdf.value='';
     Pdfgen(props.paciente,props.ante,props.gest,props.controles,(data)=>{
        datapdf.value=data;
      });
     
    });

</script>

<template>
    <Head title="Carnet Perinatal" /> 
    <Menus :menuname="componentName"> 
    <div class="content">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"> <Link   :href="route('dashboard')"> Dashboard </Link></li>
                        <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                        <li class="breadcrumb-item active">Carnet Perinatal</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
                    <div class="col-sm-12">
                        <div class="card card-table show-entire">
                            <div class="card-body"> 
                                <div class="page-table-header mb-2"> 
                                    <div v-if="paciente" class="row align-items-center">
                                        <iframe v-if="datapdf.length>0" name="viewerpdf" id="viewerpdf" style="width:100%;height:100vh;" :src="datapdf"></iframe>  
                                        <div v-else class="col">
                                            <div class="doctor-table-blk">
                                                <div class="col-12 m-3" style="text-align: center;font-size: xx-large;">
                                                    <i class="fa fa-cog rotatei m-3"></i><h3>Generando el documento...</h3>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                    <div v-else class="row align-items-center">
                                        <div class="col">
                                            <div class="doctor-table-blk">
                                                <div class="col-12 m-3">
                                                      <h3>No cuenta con registro para la impresion del carnet</h3>
                                                </div> 
                                            </div>
                                        </div> 
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
        </div>
    </div>
  
    </Menus>
     
</template>
