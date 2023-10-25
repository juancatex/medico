<script setup> 
import { Head,Link } from '@inertiajs/vue3';  
import Menus from '@/Layouts/Menus.vue'; 
import {getCurrentInstance,onMounted,watch,ref} from 'vue'; 
import Pdfgen from '../pdf.js';  
const props =defineProps({ 
    time: {
        type: String,
    },  
    user: {
        type: Object,
    }  ,
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
const datapdf=ref(''); 
onMounted(() => { 
      console.log(componentName);
      datapdf.value='';
        if(props.paciente){
            Pdfgen(props.paciente,props.ante,props.gest,props.controles,(data)=>{
                datapdf.value=data;
            });
        } 
    });

</script>

<template>
    <Head title="Dashboard" /> 
    <Menus :menuname="componentName"> 
    <div class="content">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"> <Link   :href="route('dashboard')"> Dashboard </Link></li>
                        <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                        <li class="breadcrumb-item active">Admin Dashboard</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="good-morning-blk">
            <div class="row">
                <div class="col-md-6">
                    <div class="morning-user">
                        <p>Bienvenido</p>
                        <h2>{{time=='AM'?'Buenos dias':'Buenas tardes'}}<span class="m-3">{{ user.name }}</span></h2>
                    </div>
                </div>
                <div class="col-md-6 position-blk">
                    <div class="morning-img">
                        <img src="assets/img/morning-img-01.png" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div v-if="user.idrol<4" class="row">
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <div class="dash-widget">
                            <div class="dash-boxs comman-flex-center">
                                <img src="assets/img/icons/calendar.svg" alt="">
                            </div>
                            <div class="dash-content dash-count">
                                <h4>Appointments</h4>
                                <h2><span class="counter-up">250</span></h2>
                                <p><span class="passive-view"><i class="feather-arrow-up-right me-1"></i>40%</span> vs
                                    last month</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <div class="dash-widget">
                            <div class="dash-boxs comman-flex-center">
                                <img src="assets/img/icons/profile-add.svg" alt="">
                            </div>
                            <div class="dash-content dash-count">
                                <h4>New Patients</h4>
                                <h2><span class="counter-up">140</span></h2>
                                <p><span class="passive-view"><i class="feather-arrow-up-right me-1"></i>20%</span> vs
                                    last month</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <div class="dash-widget">
                            <div class="dash-boxs comman-flex-center">
                                <img src="assets/img/icons/scissor.svg" alt="">
                            </div>
                            <div class="dash-content dash-count">
                                <h4>Operations</h4>
                                <h2><span class="counter-up">56</span></h2>
                                <p><span class="negative-view"><i class="feather-arrow-down-right me-1"></i>15%</span>
                                    vs last month</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <div class="dash-widget">
                            <div class="dash-boxs comman-flex-center">
                                <img src="assets/img/icons/empty-wallet.svg" alt="">
                            </div>
                            <div class="dash-content dash-count">
                                <h4>Earnings</h4>
                                <h2>$<span class="counter-up"> 20,250</span></h2>
                                <p><span class="passive-view"><i class="feather-arrow-up-right me-1"></i>30%</span> vs
                                    last month</p>
                            </div>
                        </div>
                    </div>
        </div>
        <div v-else class="row">
                    <div class="col-sm-12">
                        <div class="card card-table show-entire">
                            <div class="card-body"> 
                                <div class="page-table-header mb-2"> 
                                    <div class="row align-items-center">
                                        <iframe v-if="datapdf.length>0" name="viewerpdf" id="viewerpdf" style="width:100%;height:100vh;" :src="datapdf"></iframe>  
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
