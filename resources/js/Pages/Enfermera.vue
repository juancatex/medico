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
    <Head title="Enfermera" /> 
    <Menus :menuname="componentName"> 
    <div class="content">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"> <Link   :href="route('dashboard')"> Dashboard </Link></li>
                        <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                        <li class="breadcrumb-item active">Enfermera</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="good-morning-blk">
            <div class="row">
                <div class="col-md-6">
                    <div class="morning-user">
                        <p>Bienvenido</p>
                        <h2>{{time=='AM'?'Buenos dias':'Buenas tardes'}}<span class="m-3">{{ name }}</span></h2>
                    </div>
                </div>
                <div class="col-md-6 position-blk">
                    <div class="morning-img">
                        <img src="assets/img/morning-img-01.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    </Menus>
     
</template>
