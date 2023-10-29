<script setup> 
import { Head,Link } from '@inertiajs/vue3';  
import Menus from '@/Layouts/Menus.vue'; 
import {getCurrentInstance,onMounted,watch,ref} from 'vue'; 
import Pdfgen from '../pdf.js';  
import Swal from 'sweetalert2';
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
    embarazopla: {
        type: Object,
    },
    embarazonopla: {
        type: Object,
    },
    metodos: {
        type: Object,
    },
    totaldoctor: {
        type: Number,
    },
    totalenfer: {
        type: Number,
    },
    totalpaci: {
        type: Number,
    },
});
const componentName = getCurrentInstance()?.type.__name
const datapdf=ref(''); 
function charts(){
    console.log(props.embarazopla);
    if ($('#patient-chart').length > 0) {
        var sColStacked = {
            chart: {
                height: 230,
                type: 'bar',
                stacked: true,
                toolbar: {
                    show: false,
                }
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    legend: {
                        position: 'bottom',
                        offsetX: -10,
                        offsetY: 0
                    }
                }
            }],
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '15%'
                },
            },
            dataLabels: {
                enabled: false
            },
            series: [{
                name: 'Planeado',
                color: '#2E37A4',
                data: props.embarazopla
            }, {
                name: 'No planeado',
                color: '#00D3C7',
                data: props.embarazonopla
            }],
            xaxis: {
                categories: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
            },
        }
        var chart = new ApexCharts(document.querySelector("#patient-chart"), sColStacked);
        chart.render();
    }
    if ($('#donut-chart-dash').length > 0) {
        var donutChart = {
            chart: {
                height: 290,
                type: 'donut',
                toolbar: {
                    show: false,
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '50%'
                },
            },
            dataLabels: {
                enabled: false
            },
            series: props.metodos,
            labels: ['No usaba', 'Barrera', 'DIU', 'Hormonal', 'Emergencia','Tradicional'],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }],
            legend: {
                position: 'bottom',
            }
        }
        var donut = new ApexCharts(document.querySelector("#donut-chart-dash"), donutChart);
        donut.render();
    }
}
onMounted(() => { 
      console.log(componentName);
      datapdf.value='';
        if(props.paciente){
            Pdfgen(props.paciente,props.ante,props.gest,props.controles,(data)=>{
                datapdf.value=data;
            });
        } 
      if(props.paciente!=null){ 
        if(props.paciente.getmayor instanceof Object){ 
            setTimeout(function(){
                Swal.fire({title: 'Atencion!!!!!',
                icon: 'warning',
                    text:"Tiene cita programada: "+props.paciente.getmayor.proximacita,icon:'success'});
            }, 2000);
        }
      }
      charts();
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
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
                        <div class="dash-widget">
                            <div class="dash-boxs comman-flex-center">
                                <img src="assets/img/icons/health-img.svg" alt="">
                            </div>
                            <div class="dash-content dash-count">
                                <h4>Doctores</h4>
                                <h2><span class="counter-up">{{totaldoctor}}</span></h2>
                               
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
                        <div class="dash-widget">
                            <div class="dash-boxs comman-flex-center">
                                <img src="assets/img/icons/profile-add.svg" alt="">
                            </div>
                            <div class="dash-content dash-count">
                                <h4>Enfermeros</h4>
                                <h2><span class="counter-up">{{totalenfer}}</span></h2>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
                        <div class="dash-widget">
                            <div class="dash-boxs comman-flex-center">
                                <img src="assets/img/icons/profile-user.svg" alt="">
                            </div>
                            <div class="dash-content dash-count">
                                <h4>Pacientes</h4>
                                <h2><span class="counter-up">{{totalpaci}}</span></h2>
                              
                            </div>
                        </div>
                    </div>
                   
        </div>
        <div v-if="user.idrol<4" class="row">
                    <div class="col-12 col-md-12 col-lg-6 col-xl-9">
                        <div class="card">
                            <div class="card-body">
                                <div class="chart-title patient-visit">
                                    <h4>Embarazos planeados</h4> 
                                </div>
                                <div id="patient-chart"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-6 col-xl-3 d-flex">
                        <div class="card">
                            <div class="card-body">
                                <div class="chart-title">
                                    <h4>Metodo con mas fracasos</h4>
                                </div>
                                <div id="donut-chart-dash" class="chart-user-icon">
                                    <img src="assets/img/icons/user-icon.svg" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <div v-if="user.idrol==4" class="row">
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
