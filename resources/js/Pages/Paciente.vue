<script setup> 
import { Head,Link } from '@inertiajs/vue3';  
import Menus from '@/Layouts/Menus.vue';
import {getCurrentInstance,onMounted} from 'vue'; 
const props =defineProps({ 
    lista: {
        type: Object,
    }  
});
const componentName = getCurrentInstance()?.type.__name

onMounted(() => { 
      console.log(componentName);
    });

</script>

<template>
    <Head title="Paciente" /> 
    <Menus :menuname="componentName"> 
    <div class="content">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"> <Link   :href="route('dashboard')"> Dashboard </Link></li>
                        <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                        <li class="breadcrumb-item active">Paciente</li>
                    </ul>
                </div>
            </div>
        </div>
         
    </div>
    </Menus>
     
</template>
