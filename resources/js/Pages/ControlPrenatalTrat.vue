<script setup> 
import { Head,Link,useForm,router} from '@inertiajs/vue3';  
import Menus from '@/Layouts/Menus.vue';
import TextInput from '@/Components/TextInput.vue'; 
import Pagination from '@/Components/Paginations.vue';
import {getCurrentInstance,onMounted,watch,ref} from 'vue'; 
import Swal from 'sweetalert2';
import { debounce } from 'lodash';
const searchField=ref('');
const modalname=ref('');  
const props =defineProps({ 
    lista: {
        type: Object,
    } 
});
const form = useForm({ 
    idprenat: null,   
    tratamientos: null,     
    proximacita: null,    
});
watch(searchField, debounce(() => { 
    router.get('/ControlPrenatalTrat', {search: searchField.value}, {preserveState: true, preserveScroll: true, only: ['lista']})
}, 300));

function openlistado(paciente){
    modalname.value=paciente.name;
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
    var url= '/obtenerregistrostrat?id='+paciente.idprenat;
    axios.get(url).then(function (response) {   
       Swal.close();  
       if(response.data.datos instanceof Object){
        modalregistro(response.data.datos.idprenat,response.data.fecha);
       }else{
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

function modalregistro(data,fecha){   
    form.clearErrors();
    form.reset();   
    form.idprenat=data; 
    form.proximacita=fecha; 
    $('#resgistrotrat').modal('show'); 
}
 
const componentName = getCurrentInstance()?.type.__name
const ok =(msj)=>{ 
    closeModal();
    Swal.fire({title:msj,icon:'success'});
};
 
const closeModal=()=>{  
    form.reset();
    form.clearErrors(); 
    $('#resgistrotrat').modal('hide');  
};
 
 
const guardarDatos=()=>{
    form.post(route('RegControlPrenatalDoc'),{onSuccess:()=>{ok('Registrado correctamente')}  });
};
 
  
onMounted(() => { 
      console.log(componentName); 
    });

</script>

<template>
    <Head title="Control Prenatal" /> 
    <Menus :menuname="componentName"> 
    <div class="content">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"> <Link   :href="route('dashboard')"> Dashboard </Link></li>
                        <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                        <li class="breadcrumb-item active">Control Prenatal Inicial</li>
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
                                                    
                                                                        <button v-if="!paciente.responsable" @click="openlistado(paciente)"
                                                                            class="btn btn-sm  btn-success submit-form  me-2"><i
                                                                                class="fa-solid fa-plus me-1"></i>Registro de tratamientos</button>
                                                                         <div v-else class="custom-badge status-blue ">Registrado</div>
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
     <!-- -------------------modals---------------------- -->
     <div class="modal custom-modal modal-bg  fade invoices-preview" id="resgistrotrat" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <div class="card invoice-info-card">
                                    <div class="card-body p-4 pb-0">
                                        <div class="invoice-item invoice-item-one">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="invoice-logo d-flex justify-content-start">
                                                        <img src="assets/img/logo-dark.png" alt="logo">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="invoice-info">
                                                        <div class="invoice-head">
                                                            <h2 class="text-primary">Control Prenatal</h2>
                                                            <p>{{modalname}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                            <div class="row mt-4 pb-3 ">
                                                 
                                                <div class="col-12 col-md-6 col-xl-4">
                                                    <div class="form-group local-forms">
                                                        <label>Proxima cita<span class="login-danger">*</span></label>
                                                        <TextInput  class="form-control" type="date" v-model="form.proximacita" :class="form.errors.proximacita?'errorinput':''"></TextInput>
                                                    </div> 
                                                </div>
                                                
                                                <div class="col-12">
                                                    <div class="form-group local-forms">
                                                        <label>Señales de peligro, examenes, tratamientos<span class="login-danger">*</span></label>
                                                        <textarea class="form-control"   v-model="form.tratamientos" :class="form.errors.tratamientos?'errorinput':''" rows="10"></textarea>
                                                    </div> 
                                                </div>
                                                
                                            </div> 
                                        <div class="col-12">
                                            <div class="doctor-submit text-end"> 
                                                <button  @click="guardarDatos"
                                                    class="btn btn-primary submit-form me-2" :disabled="form.processing">Registrar</button>
                                                <button @click="closeModal"
                                                    class="btn btn-primary cancel-form" :disabled="form.processing">Cancelar</button>
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
     <!-- -------------------modals---------------------- -->
     <!-- -------------------modals---------------------- -->
    
    </Menus>
     
</template>
