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
const tresconsecutivos=ref(null); 
const props =defineProps({ 
    lista: {
        type: Object,
    } 
});
const form = useForm({ 
    iduser: null, 
    tbcf:null,
    tbcp:null,
    diabetesf:null,
    diabetesp:null,
    hipertensionf:null,
    hipertensionp:null,
    preeclampsiaf:null,
    preeclampsiap:null,
    eclampsiaf:null,
    eclampsiap:null,
    otrof:null,
    otrop:null,   
    cirtracto:null, 
    infertilidad:null, 
    cardiopat:null, 
    nefropatia:null, 
    violencia:null, 
    vih:null,   
    ultimoprevions:null,    
    ultimoprevionormal:null,    
    antecedentesgemelares:null,    
    tresconsecutivos:null,    
    gestasprevias:null,    
    ectopico:null,    
    partos:null,    
    abortos:null,    
    vaginales:null,    
    cesareas:null,    
    nacidosvivos:null,    
    nacidosmuertos:null,    
    muertossemana:null,    
    muertosdespuessemana:null,    
    viven:null,    
    finembarazoanterior:null,    
    embarazoplaneado:null,    
    fracasometodo:null,     
});
watch(searchField, debounce(() => { 
    router.get('/Antecedentes', {search: searchField.value}, {preserveState: true, preserveScroll: true, only: ['lista']})
}, 300));
watch(tresconsecutivos, () => {  
   form.tresconsecutivos=tresconsecutivos.value==null?null:(tresconsecutivos.value?1:0)
} );
function openantecedentes(paciente){
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
    var url= '/obtenerantecedentes?id='+paciente.id;
    axios.get(url).then(function (response) {   
       Swal.close();
        console.log(response.data instanceof Object);
       if(response.data instanceof Object){
        modalupdate(response);
       }else{
        modalo(paciente.id);
       }
    })
    .catch(function (error) {
        console.log(error);
    });
}
function modalupdate(data){ 
    var paciente=data.data; 
    form.clearErrors();
    form.reset(); 
    form.iduser=paciente.iduser;
    form.tbcf=paciente.tbcf;
    form.tbcp=paciente.tbcp;
    form.diabetesf=paciente.diabetesf;
    form.diabetesp=paciente.diabetesp;
    form.hipertensionf=paciente.hipertensionf;
    form.hipertensionp=paciente.hipertensionp;
    form.preeclampsiaf=paciente.preeclampsiaf;
    form.preeclampsiap=paciente.preeclampsiap;
    form.eclampsiaf=paciente.eclampsiaf;
    form.eclampsiap=paciente.eclampsiap;
    form.otrof=paciente.otrof;
    form.otrop=paciente.otrop;   
    form.cirtracto=paciente.cirtracto; 
    form.infertilidad=paciente.infertilidad; 
    form.cardiopat=paciente.cardiopat; 
    form.nefropatia=paciente.nefropatia; 
    form.violencia=paciente.violencia; 
    form.vih=paciente.vih;   
    form.ultimoprevions=paciente.ultimoprevions;    
    form.ultimoprevionormal=paciente.ultimoprevionormal;    
    form.antecedentesgemelares=paciente.antecedentesgemelares;    
    form.tresconsecutivos=paciente.tresconsecutivos;    
    form.gestasprevias=paciente.gestasprevias;    
    form.ectopico=paciente.ectopico;    
    form.partos=paciente.partos;    
    form.abortos=paciente.abortos;    
    form.vaginales=paciente.vaginales;    
    form.cesareas=paciente.cesareas;    
    form.nacidosvivos=paciente.nacidosvivos;    
    form.nacidosmuertos=paciente.nacidosmuertos;    
    form.muertossemana=paciente.muertossemana;    
    form.muertosdespuessemana=paciente.muertosdespuessemana;    
    form.viven=paciente.viven;    
    form.finembarazoanterior=paciente.finembarazoanterior;    
    form.embarazoplaneado=paciente.embarazoplaneado;    
    form.fracasometodo=paciente.fracasometodo; 
       
    $('#registropacientes').modal('show'); 
}
function modalo(id){  
    form.clearErrors();
    form.reset();
    form.iduser=id;
    $('#registropacientes').modal('show'); 
}

const componentName = getCurrentInstance()?.type.__name
const ok =(msj)=>{ 
    closeModal();
    Swal.fire({title:msj,icon:'success'});
};
 
const closeModal=()=>{  
    form.reset();
    form.clearErrors(); 
    $('#registropacientes').modal('hide');  
};

 
const guardarDatos=()=>{
    form.post(route('RegAntecedentes'),{onSuccess:()=>{ok('Registrado correctamente')}  });
};
 
  
onMounted(() => { 
      console.log(componentName); 
    });

</script>

<template>
    <Head title="Antecedentes" /> 
    <Menus :menuname="componentName"> 
    <div class="content">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"> <Link   :href="route('dashboard')"> Dashboard </Link></li>
                        <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                        <li class="breadcrumb-item active">Antecedentes</li>
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
                                                 
                                                <th>Nombre completo</th>
                                                <th>C.I.</th>
                                                <th>Fecha de Nacimiento</th>
                                                <th>N° Historial Clinico</th>
                                                <th>Control prenatal</th>
                                                <th>Correo Electrónico</th>  
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody> 
                                            <tr v-for="paciente in lista.data" :key="paciente.id"> 

                                                <td class="profile-image"><img width="28"
                                                                                height="28" :src="paciente.foto?paciente.foto:'assets/img/user.jpg'"
                                                                                class="rounded-circle m-r-5" alt="">{{ paciente.name}}</td> 
                                                <td class="align-middle" style="text-align: center;">{{ paciente.cip }}</td>
                                                <td class="align-middle" style="text-align: center;">{{ paciente.fechanacimiento }}</td>
                                                <td class="align-middle" style="text-align: center;">{{ paciente.numhisclinico }}</td>
                                                <td class="align-middle" style="text-align: right;">{{ paciente.controlprenatalen }}</td> 
                                                <td class="align-middle" style="text-align: right;">{{ paciente.email }}</td>
                                                

                                                <td class="text-end">
                                                                        <button @click="openantecedentes(paciente)"
                                                                            class="btn btn-sm  btn-primary submit-form  me-2"><i
                                                                                class="fa-solid fa-check-to-slot me-1"></i>Antecedentes</button>
                                                                               

                                                                         
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
     <div class="modal custom-modal modal-bg  fade invoices-preview" id="registropacientes" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <div class="card invoice-info-card">
                                    <div class="card-body p-4">
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
                                                            <h2 class="text-primary">Antecedentes</h2>
                                                            <p>{{modalname}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
 
                                        <div class="row mt-4 pb-3 invoice-item-one">
                                       
 
                                        <div class="col-12 col-md-6 col-xl-4" >
                                            <div class="form-group select-gender" > 
                                                        <table style="width: 100%;">
                                                            <tr>
                                                                <td> <label class="gen-label">Familiares<span class="login-danger">*</span></label> </td><td></td>
                                                                <td> <label class="gen-label">Personales<span class="login-danger">*</span></label> </td> 
                                                            </tr>
                                                            <tr>
                                                                <td :class="form.errors.tbcf?'errorinput':''"><label class="form-check-label">
                                                                    <TextInput class="form-check-input mt-0 m-1" name="tbcf" value="0" type="radio" v-model="form.tbcf" :checked="form.tbcf==0"/>No 
                                                                    <TextInput class="form-check-input mt-0 m-1" name="tbcf" value="1" type="radio" v-model="form.tbcf" :checked="form.tbcf==1"/>Si 
                                                                    </label>
                                                                </td>
                                                                <td style="font-size: small;max-width: 145px;">{{ '<- '}} <span>TBC</span> {{ '->' }}</td>
                                                                <td :class="form.errors.tbcp?'errorinput':''"><label class="form-check-label">
                                                                    <TextInput class="form-check-input mt-0 m-1" name="tbcp" value="0" type="radio" v-model="form.tbcp" :checked="form.tbcp==0"/>No 
                                                                    <TextInput class="form-check-input mt-0 m-1" name="tbcp" value="1" type="radio" v-model="form.tbcp" :checked="form.tbcp==1"/>Si 
                                                                    </label>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td :class="form.errors.diabetesf?'errorinput':''"><label class="form-check-label">
                                                                    <TextInput class="form-check-input mt-0 m-1" name="diabetesf" value="0" type="radio" v-model="form.diabetesf" :checked="form.diabetesf==0"/>No 
                                                                    <TextInput class="form-check-input mt-0 m-1" name="diabetesf" value="1" type="radio" v-model="form.diabetesf" :checked="form.diabetesf==1"/>Si 
                                                                    </label>
                                                                </td>
                                                                <td style="font-size: small;max-width: 145px;">{{ '<- Diabetes ->' }}</td>
                                                                <td :class="form.errors.diabetesp?'errorinput':''"><label class="form-check-label">
                                                                    <TextInput class="form-check-input mt-0 m-1" name="diabetesp" value="0" type="radio" v-model="form.diabetesp" :checked="form.diabetesp==0"/>No 
                                                                    <TextInput class="form-check-input mt-0 m-1" name="diabetesp" value="1" type="radio" v-model="form.diabetesp" :checked="form.diabetesp==1"/>Si 
                                                                    </label>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td :class="form.errors.hipertensionf?'errorinput':''"><label class="form-check-label">
                                                                    <TextInput class="form-check-input mt-0 m-1" name="hipertensionf" value="0" type="radio" v-model="form.hipertensionf" :checked="form.hipertensionf==0"/>No 
                                                                    <TextInput class="form-check-input mt-0 m-1" name="hipertensionf" value="1" type="radio" v-model="form.hipertensionf" :checked="form.hipertensionf==1"/>Si 
                                                                    </label>
                                                                </td>
                                                                <td style="font-size: small;max-width: 145px;">{{ '<- Hipertension ->' }}</td>
                                                                <td :class="form.errors.hipertensionp?'errorinput':''"><label class="form-check-label">
                                                                    <TextInput class="form-check-input mt-0 m-1" name="hipertensionp" value="0" type="radio" v-model="form.hipertensionp" :checked="form.hipertensionp==0"/>No 
                                                                    <TextInput class="form-check-input mt-0 m-1" name="hipertensionp" value="1" type="radio" v-model="form.hipertensionp" :checked="form.hipertensionp==1"/>Si 
                                                                    </label>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td :class="form.errors.preeclampsiaf?'errorinput':''"><label class="form-check-label">
                                                                    <TextInput class="form-check-input mt-0 m-1" name="preeclampsiaf" value="0" type="radio" v-model="form.preeclampsiaf" :checked="form.preeclampsiaf==0"/>No 
                                                                    <TextInput class="form-check-input mt-0 m-1" name="preeclampsiaf" value="1" type="radio" v-model="form.preeclampsiaf" :checked="form.preeclampsiaf==1"/>Si 
                                                                    </label>
                                                                </td>
                                                                <td style="font-size: small;max-width: 145px;">{{ '<- Pre eclampsia ->' }}</td>
                                                                <td :class="form.errors.preeclampsiap?'errorinput':''"><label class="form-check-label">
                                                                    <TextInput class="form-check-input mt-0 m-1" name="preeclampsiap" value="0" type="radio" v-model="form.preeclampsiap" :checked="form.preeclampsiap==0"/>No 
                                                                    <TextInput class="form-check-input mt-0 m-1" name="preeclampsiap" value="1" type="radio" v-model="form.preeclampsiap" :checked="form.preeclampsiap==1"/>Si 
                                                                    </label>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td :class="form.errors.eclampsiaf?'errorinput':''"><label class="form-check-label">
                                                                    <TextInput class="form-check-input mt-0 m-1" name="eclampsiaf" value="0" type="radio" v-model="form.eclampsiaf" :checked="form.eclampsiaf==0"/>No 
                                                                    <TextInput class="form-check-input mt-0 m-1" name="eclampsiaf" value="1" type="radio" v-model="form.eclampsiaf" :checked="form.eclampsiaf==1"/>Si 
                                                                    </label>
                                                                </td>
                                                                <td style="font-size: small;max-width: 145px;">{{ '<- Eclampsia ->' }}</td>
                                                                <td :class="form.errors.eclampsiap?'errorinput':''"><label class="form-check-label">
                                                                    <TextInput class="form-check-input mt-0 m-1" name="eclampsiap" value="0" type="radio" v-model="form.eclampsiap" :checked="form.eclampsiap==0"/>No 
                                                                    <TextInput class="form-check-input mt-0 m-1" name="eclampsiap" value="1" type="radio" v-model="form.eclampsiap" :checked="form.eclampsiap==1"/>Si 
                                                                    </label>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td :class="form.errors.otrof?'errorinput':''"><label class="form-check-label">
                                                                    <TextInput class="form-check-input mt-0 m-1" name="otrof" value="0" type="radio" v-model="form.otrof" :checked="form.otrof==0"/>No 
                                                                    <TextInput class="form-check-input mt-0 m-1" name="otrof" value="1" type="radio" v-model="form.otrof" :checked="form.otrof==1"/>Si 
                                                                    </label>
                                                                </td> 
                                                                <td style="font-size: small;max-width: 145px;">{{ '<- '}} <span>Otra condicion medica grave</span> {{ '->' }}</td>
                                                                <td :class="form.errors.otrop?'errorinput':''"><label class="form-check-label">
                                                                    <TextInput class="form-check-input mt-0 m-1" name="otrop" value="0" type="radio" v-model="form.otrop" :checked="form.otrop==0"/>No 
                                                                    <TextInput class="form-check-input mt-0 m-1" name="otrop" value="1" type="radio" v-model="form.otrop" :checked="form.otrop==1"/>Si 
                                                                    </label>
                                                                </td>
                                                            </tr>
                                                        </table> 
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6 col-xl-3 mt-4" >
                                            <div class="form-group select-gender" > 
                                                <table style="width: 100%;">
                                                     <tr>
                                                        <td style="text-align: end;font-size: small;max-width: 145px;">Cirugia tracto reprod.<span class="login-danger">*</span></td>
                                                        <td>
                                                            <label class="form-check-label">
                                                                    <TextInput class="form-check-input mt-0 m-1" name="cirtracto" value="0" type="radio" v-model="form.cirtracto" :checked="form.cirtracto==0"/>No 
                                                                    <TextInput class="form-check-input mt-0 m-1" name="cirtracto" value="1" type="radio" v-model="form.cirtracto" :checked="form.cirtracto==1"/>Si 
                                                             </label>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align: end; font-size: small;max-width: 145px;">Infertilidad<span class="login-danger">*</span></td>
                                                        <td>
                                                            <label class="form-check-label">
                                                                    <TextInput class="form-check-input mt-0 m-1" name="infertilidad" value="0" type="radio" v-model="form.infertilidad" :checked="form.infertilidad==0"/>No 
                                                                    <TextInput class="form-check-input mt-0 m-1" name="infertilidad" value="1" type="radio" v-model="form.infertilidad" :checked="form.infertilidad==1"/>Si 
                                                             </label>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align: end; font-size: small;max-width: 145px;">Cardiopat<span class="login-danger">*</span></td>
                                                        <td>
                                                            <label class="form-check-label">
                                                                    <TextInput class="form-check-input mt-0 m-1" name="cardiopat" value="0" type="radio" v-model="form.cardiopat" :checked="form.cardiopat==0"/>No 
                                                                    <TextInput class="form-check-input mt-0 m-1" name="cardiopat" value="1" type="radio" v-model="form.cardiopat" :checked="form.cardiopat==1"/>Si 
                                                             </label>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align: end; font-size: small;max-width: 145px;">Nefropatia<span class="login-danger">*</span></td>
                                                        <td>
                                                            <label class="form-check-label">
                                                                    <TextInput class="form-check-input mt-0 m-1" name="nefropatia" value="0" type="radio" v-model="form.nefropatia" :checked="form.nefropatia==0"/>No 
                                                                    <TextInput class="form-check-input mt-0 m-1" name="nefropatia" value="1" type="radio" v-model="form.nefropatia" :checked="form.nefropatia==1"/>Si 
                                                             </label>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align: end; font-size: small;max-width: 145px;">Violencia<span class="login-danger">*</span></td>
                                                        <td>
                                                            <label class="form-check-label">
                                                                    <TextInput class="form-check-input mt-0 m-1" name="violencia" value="0" type="radio" v-model="form.violencia" :checked="form.violencia==0"/>No 
                                                                    <TextInput class="form-check-input mt-0 m-1" name="violencia" value="1" type="radio" v-model="form.violencia" :checked="form.violencia==1"/>Si 
                                                             </label>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align: end; font-size: small;max-width: 145px;">VIH +<span class="login-danger">*</span></td>
                                                        <td>
                                                            <label class="form-check-label">
                                                                    <TextInput class="form-check-input mt-0 m-1" name="vih" value="0" type="radio" v-model="form.vih" :checked="form.vih==0"/>No 
                                                                    <TextInput class="form-check-input mt-0 m-1" name="vih" value="1" type="radio" v-model="form.vih" :checked="form.vih==1"/>Si 
                                                             </label>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>



                                        <div class="col-12 col-md-6 col-xl-5 row">
                                           <table style="width: 100%;">
                                            <tr>
                                                <td>
                                                    <label>Gestas previas<span class="login-danger">*</span></label>
                                                </td>
                                                <td style="width: 75px;">
                                                    <TextInput class="form-control" type="number" v-model="form.gestasprevias" :class="form.errors.gestasprevias?'errorinput':''"></TextInput>
                                                </td>
                                                <td>
                                                    <label>Emb. ectopico<span class="login-danger">*</span></label>
                                                </td>
                                                <td style="width: 75px;">
                                                    <TextInput class="form-control" type="number" v-model="form.ectopico" :class="form.errors.ectopico?'errorinput':''"></TextInput>
                                                </td>
                                                <td>
                                                    <label>Partos<span class="login-danger">*</span></label>
                                                </td>
                                                <td style="width: 75px;">
                                                    <TextInput class="form-control" type="number" v-model="form.partos" :class="form.errors.partos?'errorinput':''"></TextInput>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Abortos<span class="login-danger">*</span></label>
                                                </td>
                                                <td style="width: 75px;">
                                                    <TextInput class="form-control" type="number" v-model="form.abortos" :class="form.errors.abortos?'errorinput':''"></TextInput>
                                                      <label class="form-check-label" style="font-size: x-small;">  
                                                               <input class="form-check-input mt-0 m-1" :class="form.errors.tresconsecutivos?'errorinput':''" name="tresconsecutivos"  type="checkbox" v-model="tresconsecutivos" />3 espont.  
                                                      </label> 
                                                </td>
                                                <td>
                                                    <label>Vaginales<span class="login-danger">*</span></label>
                                                </td>
                                                <td style="width: 75px;">
                                                    <TextInput class="form-control" type="number" v-model="form.vaginales" :class="form.errors.vaginales?'errorinput':''"></TextInput>
                                                </td>
                                                <td>
                                                    <label>Cesareas<span class="login-danger">*</span></label>
                                                </td>
                                                <td style="width: 75px;">
                                                    <TextInput class="form-control" type="number" v-model="form.cesareas" :class="form.errors.cesareas?'errorinput':''"></TextInput>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Nacidos vivos<span class="login-danger">*</span></label>
                                                </td>
                                                <td style="width: 75px;">
                                                    <TextInput class="form-control" type="number" v-model="form.nacidosvivos" :class="form.errors.nacidosvivos?'errorinput':''"></TextInput>
                                                </td>
                                                <td>
                                                    <label>Nacidos muertos<span class="login-danger">*</span></label>
                                                </td>
                                                <td style="width: 75px;">
                                                    <TextInput class="form-control" type="number" v-model="form.nacidosmuertos" :class="form.errors.nacidosmuertos?'errorinput':''"></TextInput>
                                                </td>
                                                <td>
                                                    <label>Muertos 1a sem.<span class="login-danger">*</span></label>
                                                </td>
                                                <td style="width: 75px;">
                                                    <TextInput class="form-control" type="number" v-model="form.muertossemana" :class="form.errors.muertossemana?'errorinput':''"></TextInput>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Despues 1a sem.<span class="login-danger">*</span></label>
                                                </td>
                                                <td style="width: 75px;">
                                                    <TextInput class="form-control" type="number" v-model="form.muertosdespuessemana" :class="form.errors.muertosdespuessemana?'errorinput':''"></TextInput>
                                                </td>
                                                <td>
                                                    <label>Viven<span class="login-danger">*</span></label>
                                                </td>
                                                <td style="width: 75px;">
                                                    <TextInput class="form-control" type="number" v-model="form.viven" :class="form.errors.viven?'errorinput':''"></TextInput>
                                                </td>
                                                
                                            </tr>
                                           </table>
                                        </div>
                                       
                                      
                                    </div>
                                    <div class="row mt-4 pb-3 ">
                                        <div class="col-12 col-md-6 col-xl-4"  >
                                            <div class="form-group select-gender" :class="form.errors.genero?'errorinput':''">
                                                <label class="gen-label">Ultimo previo<span
                                                        class="login-danger">*</span></label>
                                                <div class="form-check-inline">
                                                    <label class="form-check-label"> 
                                                            <TextInput class="form-check-input mt-0" name="ultimoprevions" value="0" type="radio" v-model="form.ultimoprevions" :checked="form.ultimoprevions==0"/>N/S 
                                                    </label>
                                                </div>
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                            <TextInput class="form-check-input mt-0" name="ultimoprevions" value="1" type="radio" v-model="form.ultimoprevions" :checked="form.ultimoprevions==1"/>{{ '<2500g' }} 
                                                    </label>
                                                </div> 
                                                <div class="form-check-inline">
                                                    <label class="form-check-label"> 
                                                            <TextInput class="form-check-input mt-0" name="ultimoprevionormal" value="0" type="radio" v-model="form.ultimoprevionormal" :checked="form.ultimoprevionormal==0"/>Normal
                                                    </label>
                                                </div>
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                            <TextInput class="form-check-input mt-0" name="ultimoprevionormal" value="1" type="radio" v-model="form.ultimoprevionormal" :checked="form.ultimoprevionormal==1"/>{{ '>=4000g' }} 
                                                    </label>
                                                </div>
                                            </div>
                                             <div class="form-group select-gender" :class="form.errors.genero?'errorinput':''">
                                                <label class="gen-label">Antecedentes gemelares<span
                                                        class="login-danger">*</span></label>
                                                <div class="form-check-inline">
                                                    <label class="form-check-label"> 
                                                            <TextInput class="form-check-input mt-0" name="antecedentesgemelares" value="0" type="radio" v-model="form.antecedentesgemelares" :checked="form.antecedentesgemelares==0"/>No
                                                    </label>
                                                </div>
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                            <TextInput class="form-check-input mt-0" name="antecedentesgemelares" value="1" type="radio" v-model="form.antecedentesgemelares" :checked="form.antecedentesgemelares==1"/>Si 
                                                    </label>
                                                </div> 
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-3"  > 
                                            <div class="form-group select-gender" :class="form.errors.genero?'errorinput':''">
                                                <label class="gen-label">Embarazo planeado<span
                                                        class="login-danger">*</span></label>
                                                <div class="form-check-inline">
                                                    <label class="form-check-label"> 
                                                            <TextInput class="form-check-input mt-0" name="embarazoplaneado" value="0" type="radio" v-model="form.embarazoplaneado" :checked="form.embarazoplaneado==0"/>No
                                                    </label>
                                                </div>
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                            <TextInput class="form-check-input mt-0" name="embarazoplaneado" value="1" type="radio" v-model="form.embarazoplaneado" :checked="form.embarazoplaneado==1"/>Si 
                                                    </label>
                                                </div> 
                                            </div>
                                            <div class="form-group local-forms ">
                                                <label>Fin de embarazo anterior<span class="login-danger">*</span></label> 
                                                <TextInput class="form-control datetimepicker" type="date" v-model="form.finembarazoanterior" :class="form.errors.finembarazoanterior?'errorinput':''"></TextInput>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-5">
                                            
                                            <div class="form-group select-gender" :class="form.errors.genero?'errorinput':''">
                                                <label class="gen-label">Fracaso metodo anticonceptivo<span
                                                        class="login-danger">*</span></label>
                                                <div class="form-check-inline">
                                                    <label class="form-check-label"> 
                                                            <TextInput class="form-check-input mt-0" name="fracasometodo" value="0" type="radio" v-model="form.fracasometodo" :checked="form.fracasometodo==0"/>No usaba 
                                                    </label>
                                                </div>
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                            <TextInput class="form-check-input mt-0" name="fracasometodo" value="1" type="radio" v-model="form.fracasometodo" :checked="form.fracasometodo==1"/>Barrera
                                                    </label>
                                                </div> 
                                                <div class="form-check-inline">
                                                    <label class="form-check-label"> 
                                                            <TextInput class="form-check-input mt-0" name="fracasometodo" value="2" type="radio" v-model="form.fracasometodo" :checked="form.fracasometodo==2"/>DIU
                                                    </label>
                                                </div>
                                                <br>

                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                            <TextInput class="form-check-input mt-0" name="fracasometodo" value="3" type="radio" v-model="form.fracasometodo" :checked="form.fracasometodo==3"/>Hormonal
                                                    </label>
                                                </div>
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                            <TextInput class="form-check-input mt-0" name="fracasometodo" value="4" type="radio" v-model="form.fracasometodo" :checked="form.fracasometodo==4"/>Emergencia 
                                                    </label>
                                                </div>
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                            <TextInput class="form-check-input mt-0" name="fracasometodo" value="5" type="radio" v-model="form.fracasometodo" :checked="form.fracasometodo==5"/>Tradicional
                                                    </label>
                                                </div>
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
    </Menus>
     
</template>
