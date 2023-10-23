<script setup> 
import { Head,Link,router} from '@inertiajs/vue3';  
import Menus from '@/Layouts/Menus.vue'; 
import Pagination from '@/Components/Paginations.vue';
import {getCurrentInstance,onMounted,watch,ref} from 'vue'; 
import Swal from 'sweetalert2';
import { debounce } from 'lodash';
import Pdfgen from '../pdf.js';
const searchField=ref('');  
const props =defineProps({ 
    lista: {
        type: Object,
    } 
});
 
watch(searchField, debounce(() => { 
    router.get('/CarnetperinatalLista', {search: searchField.value}, {preserveState: true, preserveScroll: true, only: ['lista']})
}, 300));

function openlistado(paciente){ 
    Swal.fire({
            title: "Obteniendo los datos...",
            allowOutsideClick: () => false,
            allowEscapeKey: () => false,
            showConfirmButton: false, 
            showCancelButton: false, 
            willOpen: function() {
                Swal.showLoading();
            }
        });
    var url= '/pdflistadoin?id='+paciente.id;
    axios.get(url).then(function (response) {   
         
       if(response.data instanceof Object){
        modallistado(response.data);
       }else{
        Swal.close();
        Swal.fire({
        icon: 'error', 
        text: 'El usuario no cuenta con registros previos.' 
        });
       }
    })
    .catch(function (error) {
        console.log(error);
    });
}

 
function modallistado(props){ 
    Pdfgen(props.paciente,props.ante,props.gest,props.controles,(data)=>{
         Swal.fire({
        html:' <iframe style="width:100%;height:70vh;" src="'+data+'"></iframe>',
        customClass: {
            popup:'swal-pdf'
        } 
        });
      });
    
}
  
const componentName = getCurrentInstance()?.type.__name 
onMounted(() => { 
      console.log(componentName); 
    });

</script>

<template>
    <Head title="Carnet perinatal" /> 
    <Menus :menuname="componentName"> 
    <div class="content">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"> <Link   :href="route('dashboard')"> Dashboard </Link></li>
                        <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                        <li class="breadcrumb-item active">Carnet perinatal</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
                    <div class="col-sm-12">
                        <div class="card card-table show-entire">
                            <div class="card-body">

                                <div class="page-table-header mb-2">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <div class="doctor-table-blk">
                                                <div class="col-12 m-3">
                                                      <h3>Listado general de pacientes</h3>
                                                </div>
                                                <div class="doctor-search-blk">
                                                    <div class="top-nav-search table-search-blk">
                                                        <form>
                                                            <input type="text" class="form-control" v-model="searchField"
                                                                placeholder="Buscar">
                                                            <a class="btn"><img src="assets/img/icons/search-normal.svg"
                                                                    ></a>
                                                        </form>
                                                    </div>
                                                 
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table border-0 custom-table comman-table datatable mb-0">
                                        <thead>
                                            <tr>
                                                 
                                                <th class="align-middle" style="text-align: center;">Nombre completo</th>
                                                <th class="align-middle" style="text-align: center;">C.I.</th> 
                                                <th class="align-middle" style="text-align: center;">N° Historial Clinico</th>
                                                <th class="align-middle" style="text-align: center;">Control prenatal</th>   
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody> 
                                            <tr v-for="paciente in lista.data" :key="paciente.id"> 

                                                <td class="profile-image"><img width="28"
                                                                                height="28" :src="paciente.foto?paciente.foto:'assets/img/user.jpg'"
                                                                                class="rounded-circle m-r-5" alt="">{{ paciente.name}}</td> 
                                                <td class="align-middle" style="text-align: center;">{{ paciente.cip }}</td> 
                                                <td class="align-middle" style="text-align: center;">{{ paciente.numhisclinico }}</td>
                                                <td class="align-middle" style="text-align: center;">{{ paciente.controlprenatalen }}</td>  
                                                

                                                <td class="text-end">
                                                                        <button @click="openlistado(paciente)"
                                                                            class="btn btn-sm  btn-primary submit-form  me-2"><i
                                                                                class="fa-solid fa-search me-1"></i>Ver carnet</button>
                                                                             
                                                                         
                                                </td>
                                            </tr> 
                                        </tbody>
                                    </table>

                                    
                                </div><pagination class="m-3" :links="lista.links" />
                            </div>
                        </div>
                    </div>
        </div>
    </div>
    
    </Menus>
     
</template>
