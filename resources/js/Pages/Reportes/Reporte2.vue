<script setup> 
import { Head,Link,} from '@inertiajs/vue3';  
import Menus from '@/Layouts/Menus.vue'; 
import {getCurrentInstance,onMounted,ref} from 'vue';  
  
const datapdf=ref(''); 
const props =defineProps({ 
    pdf: {
        type: Object,
    } 
    
}); 
const componentName = getCurrentInstance()?.type.__name

 
onMounted(() => { 
      console.log(componentName); 
      datapdf.value=props.pdf;  
    });

</script>

<template>
    <Head title="Reportes" /> 
    <Menus :menuname="componentName"> 
    <div class="content">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"> <Link   :href="route('dashboard')"> Dashboard </Link></li>
                        <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                        <li class="breadcrumb-item active">Reportes</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
                    <div class="col-sm-12">
                        <div class="card card-table show-entire">
                            <div class="card-body"> 
                                <div class="page-table-header mb-2"> 
                                    <div   class="row align-items-center">
                                        <iframe v-if="datapdf.length>0" name="viewerpdf" id="viewerpdf" style="width:100%;height:100vh;" :src="`data:application/pdf;base64,${datapdf}`"></iframe>  
                                        <div v-else class="col">
                                            <div class="doctor-table-blk">
                                                <div class="col-12 m-3" style="text-align: center;font-size: xx-large;">
                                                    <i class="fa fa-cog rotatei m-3"></i><h3>Generando el documento...</h3>
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
