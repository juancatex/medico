<script setup> 
import { Head,Link,useForm,router} from '@inertiajs/vue3';  
import Menus from '@/Layouts/Menus.vue';
import TextInput from '@/Components/TextInput.vue';
import Cropp from '@/Components/CropperImage.vue'; 
import Pagination from '@/Components/Paginations.vue';
import {getCurrentInstance,onMounted,watch,ref} from 'vue'; 
import Swal from 'sweetalert2';
import { debounce } from 'lodash';
import moment from 'moment';
const searchField=ref('');
const updatemodal=ref(false);
const props =defineProps({ 
    lista: {
        type: Object,
    },  
    dep: {
        type: Object,
    }, 
    prov: {
        type: Object,
    },   
    autoid: {
        type: Object,
    },  
    datemin: {
        type: String,   
    },  
    datemax: {
        type: String,
    }   
});
const form = useForm({ 
    idrol: 4,
    id:null,  
    name: '',
    dir: '',
    zona:null,
    iddepartamento:'',
    idprovincia: '',
    red:null,
    telefono: null,
    idioma:null,
    lengua:null, 
    fechanacimiento:null,  
    email: '', 
    foto:null, 
    edad:null, 
    autoidentificacion:'',
    alfabeta:0,
    estudios:0,
    nivelanios:0,
    estadocivil:0,
    vivesola:0,
    controlprenatalen:null, 
    partoen:null, 
    cip:null, 
    ci:null, 
    numhisclinico:null 

});
function modalupdate(paciente){
    updatemodal.value=true;
    form.clearErrors();
    form.reset();
    form.id=paciente.id;
    form.iddepartamento=paciente.iddepartamento;
    cambiadepartamento();
    form.idrol=4;
    form.idprovincia=paciente.idprovincia;
    form.name=paciente.name  
    form.fechanacimiento=paciente.fechanacimiento;
    
    form.telefono=paciente.telefono; 
    form.dir=paciente.dir;
    form.email=paciente.email; 
    form.foto=paciente.foto;
   
    form.zona=paciente.zona;
    form.red=paciente.red;
    form.idioma=paciente.idioma;
    form.lengua=paciente.lengua;
    form.edad=paciente.edad;
    form.autoidentificacion=paciente.autoidentificacion;
    form.alfabeta=paciente.alfabeta;
    form.estudios=paciente.estudios;
    form.nivelanios=paciente.nivelanios;
    form.estadocivil=paciente.estadocivil;
    form.vivesola=paciente.vivesola;
    form.controlprenatalen=paciente.controlprenatalen;
    form.partoen=paciente.partoen;
    form.cip=paciente.cip;
    form.ci=paciente.ci;
    form.numhisclinico=paciente.numhisclinico;
       
    $('#registropacientes').modal('show'); 
}
function modalupdatecopy(paciente){
    updatemodal.value=false;
    form.clearErrors();
    form.reset(); 
    form.iddepartamento=paciente.iddepartamento;
    cambiadepartamento();
    form.idrol=4;
    form.idprovincia=paciente.idprovincia;
    form.name=paciente.name  
    form.fechanacimiento=paciente.fechanacimiento; 
    form.telefono=paciente.telefono; 
    form.dir=paciente.dir; 
    form.foto=paciente.foto; 
    form.zona=paciente.zona;
    form.red=paciente.red;
    form.idioma=paciente.idioma;
    form.lengua=paciente.lengua;
    form.edad=paciente.edad;
    form.autoidentificacion=paciente.autoidentificacion;
    form.alfabeta=paciente.alfabeta;
    form.estudios=paciente.estudios;
    form.nivelanios=paciente.nivelanios;
    form.estadocivil=paciente.estadocivil;
    form.vivesola=paciente.vivesola;
    form.controlprenatalen=paciente.controlprenatalen;
    form.partoen=paciente.partoen;
    form.cip=paciente.cip;
    form.ci=paciente.ci;
    form.numhisclinico=paciente.numhisclinico;
       
    $('#registropacientes').modal('show'); 
}
const componentName = getCurrentInstance()?.type.__name
const ok =(msj)=>{ 
    closeModal();
    Swal.fire({title:msj,icon:'success'});
};
const EliminarDatos=(id)=>{
    
    const alerta=Swal.mixin({buttonsStyling:true});
    alerta.fire({
        title:'¿Esta seguro de eliminar el registro?',
        icon:'question',showCancelButton:true,
        confirmButtonText:'<i class="ti-check"></i> Si',
        cancelButtonText:'<i class="ti-close"></i> Cancelar'
    }).then(
        (result)=>{
            if(result.isConfirmed){ 
                form.id=id;
                form.post(route('EliminarPaciente'),{onSuccess:()=>{ok('Eliminado correctamente')}  });
            } 
        }
    );
    }; 
const closeModal=()=>{ 
    updatemodal.value=false;
    form.reset();
    form.clearErrors(); 
    $('#registropacientes').modal('hide');  
};
function modalo(){
    updatemodal.value=false;
    form.clearErrors();
    form.reset();
    $('#registropacientes').modal('show'); 
}
function cambiadepartamento() {
    form.idprovincia='';
    router.get('Paciente', {dep: form.iddepartamento}, {preserveState: true, preserveScroll: true, only: ['prov']});  
}
const guardarDatos=()=>{
    form.post(route('RegPaciente'),{onSuccess:()=>{ok('Creado correctamente')}  });
};
const actualizarDatos=()=>{
    form.put(route('ActualizarPaciente'),{onSuccess:()=>{ok('Modificado correctamente')}  }); 
};
const resetpass=()=>{
    form.put(route('ActualizarPacientePass'),{onSuccess:()=>{ok('Modificado correctamente')}  }); 
};
 
watch(form, debounce(() => { 
    form.ci=form.cip!=null?form.cip.replace(/\D/g, ''):'';
}, 300));
watch(form, debounce(() => { 
   
if(form.fechanacimiento!=null){
  const nacimiento=moment(form.fechanacimiento);
  var hoy=moment();
  var anios=hoy.diff(nacimiento,"years");
  form.edad=anios;
}
   

}, 300));
watch(searchField, debounce(() => { 
    router.get('/Paciente', {search: searchField.value}, {preserveState: true, preserveScroll: true, only: ['lista']})
}, 300));
onMounted(() => { 
      console.log(componentName);
      console.log(props.autoid);
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
                                        <div class="col-auto text-end float-end ms-auto download-grp">
                                            <div class="invoices-settings-btn"> 
                                                <button  class="btn" @click="modalo">
                                                    <i data-feather="plus-circle"></i> Nuevo registro
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table border-0 custom-table comman-table datatable mb-0">
                                        <thead>
                                            <tr>
                                                 
                                                <th>Nombre completo</th>
                                                <th>Gestion </th>
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
                                                <td class="align-middle" style="text-align: center;">{{ paciente.gestion }}</td>
                                                <td class="align-middle" style="text-align: center;">{{ paciente.cip }}</td> 
                                                <td class="align-middle" style="text-align: center;">{{ paciente.fechanacimiento }}</td>
                                                <td class="align-middle" style="text-align: center;">{{ paciente.numhisclinico }}</td>
                                                <td class="align-middle" style="text-align: right;">{{ paciente.controlprenatalen }}</td> 
                                                <td class="align-middle" style="text-align: right;">{{ paciente.email }}</td>
                                                

                                                <td class="text-end">
                                                    <button  @click="modalupdatecopy(paciente)"
                                                                            class="btn btn-sm btn-white text-warning me-2"><i
                                                                                class="far fa-copy me-1"></i>Copiar</button>

                                                                        <button v-if="paciente.activo" @click="modalupdate(paciente)"
                                                                            class="btn btn-sm btn-white text-success me-2"><i
                                                                                class="far fa-edit me-1"></i> Editar</button>
                                                                        <div v-else class="custom-badge status-red submit-form  me-2">Inactico</div>

                                                                        <button v-if="paciente.activo" @click="EliminarDatos(paciente.id)"
                                                                            class="btn btn-sm btn-white text-danger"><i
                                                                                class="far fa-window-close me-1"></i>Inactivar</button>

                                                                        
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
                                                            <h2 class="text-primary">Nuevo Registro</h2>
                                                            <p>Paciente</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
 
                                        <div class="row mt-4">
                                      
                                        <div class="col-12 col-md-12 col-xl-8">
                                            <div class="form-group local-forms">
                                                <label>Nombre completo <span class="login-danger">*</span></label> 
                                                <TextInput class="form-control" type="text" v-model="form.name" :class="form.errors.name?'errorinput':''"></TextInput>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-4">
                                            <div class="form-group local-forms">
                                                <label>Correo Electronico <span class="login-danger">*</span></label> 
                                                <TextInput class="form-control" type="email" v-model="form.email" :class="form.errors.email?'errorinput':''"></TextInput>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-4">
                                            <div class="form-group local-forms">
                                                <label>Domicilio <span class="login-danger">*</span></label>
                                                <TextInput class="form-control" type="text" v-model="form.dir" :class="form.errors.dir?'errorinput':''"></TextInput>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-4">
                                            <div class="form-group local-forms">
                                                <label>Zona <span class="login-danger">*</span></label>
                                                <TextInput class="form-control" type="text" v-model="form.zona" :class="form.errors.zona?'errorinput':''"></TextInput>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-4">
                                            <div class="form-group local-forms">
                                                <label>Red <span class="login-danger">*</span></label>
                                                <TextInput class="form-control" type="text" v-model="form.red" :class="form.errors.red?'errorinput':''"></TextInput>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-4">
                                            <div class="form-group local-forms">
                                                <label>Ciudad <span class="login-danger">*</span></label> 
                                                    <select class="form-control select" :class="form.errors.iddepartamento?'errorinput':''"
                                                        v-model="form.iddepartamento"
                                                        @change="cambiadepartamento"
                                                        ref="input" >  
                                                        <option value=""  disabled >Seleccione Departamento</option>
                                                        <option v-for="op in dep" :key="op.iddepartamento" :value="op.iddepartamento"  :selected="op.iddepartamento==form.iddepartamento">
                                                            {{ op.nomdepartamento }}
                                                        </option>
                                                    </select> 
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-4">
                                            <div class="form-group local-forms">
                                                <label>Provincia <span class="login-danger">*</span></label>
                                              
                                                    <select class="form-control select" :class="form.errors.idprovincia?'errorinput':''"
                                                        v-model="form.idprovincia" 
                                                        ref="input" >  
                                                        <option value=""  disabled >Seleccione Provincia</option>
                                                        <option v-for="pro in prov" :key="pro.idprovincia" :value="pro.idprovincia" :selected="pro.idprovincia==form.idprovincia">
                                                            {{ pro.nomprovincia }}
                                                        </option>
                                                    </select> 
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-4">
                                            <div class="form-group local-forms ">
                                                <label>Fecha de nacimiento<span class="login-danger">*</span></label> 
                                                <input class="form-control datetimepicker" :min="datemax" :max="datemin" type="date" v-model="form.fechanacimiento" :class="form.errors.fechanacimiento?'errorinput':''"/>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-4">
                                            <div class="form-group local-forms">
                                                <label>Numero de telefono <span class="login-danger">*</span></label>
                                                <TextInput class="form-control" type="number" v-model="form.telefono" :class="form.errors.telefono?'errorinput':''"></TextInput>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-4">
                                            <div class="form-group local-forms">
                                                <label>Idioma Hablando<span class="login-danger">*</span></label>
                                                <TextInput class="form-control" type="text" v-model="form.idioma" :class="form.errors.idioma?'errorinput':''"></TextInput>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-4">
                                            <div class="form-group local-forms">
                                                <label>Lengua Materna<span class="login-danger">*</span></label>
                                                <TextInput class="form-control" type="text" v-model="form.lengua" :class="form.errors.lengua?'errorinput':''"></TextInput>
                                            </div>
                                        </div>
                                         
                                        <div class="col-12 col-md-6 col-xl-4">
                                            <div class="form-group local-forms">
                                                <label>Edad <span class="login-danger">*</span></label>
                                                <TextInput class="form-control" type="number" v-model="form.edad" :class="form.errors.edad?'errorinput':''"></TextInput>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-4">
                                            <div class="form-group local-forms ">
                                                <label>autoidentificacion <span class="login-danger">*</span></label>
                                              
                                                    <select class="form-control select  " :class="form.errors.autoidentificacion?'errorinput':''"
                                                        v-model="form.autoidentificacion" 
                                                        ref="input" >  
                                                        <option value=""  disabled >Seleccione Autoidentificacion</option>
                                                        <option v-for="auid in autoid" :key="auid.id" :value="auid.id" :selected="auid.id==form.autoidentificacion">
                                                            {{ auid.name }}
                                                        </option>
                                                    </select> 
                                            </div>
                                        </div>
                                       
 
                                        <div class="col-12 col-md-6 col-xl-4" >
                                            <div class="form-group select-gender" :class="form.errors.genero?'errorinput':''">
                                                <label class="gen-label">Estudios<span
                                                        class="login-danger">*</span></label>
                                                <div class="form-check-inline">
                                                    <label class="form-check-label"> 
                                                            <TextInput class="form-check-input mt-0" name="estudios" value="0" type="radio" v-model="form.estudios" :checked="form.estudios==0"/>Ninguno 
                                                    </label>
                                                </div>
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                            <TextInput class="form-check-input mt-0" name="estudios" value="1" type="radio" v-model="form.estudios" :checked="form.estudios==1"/>Primaria 
                                                    </label>
                                                </div>
                                                <div class="form-check-inline">
                                                    <label class="form-check-label"> 
                                                            <TextInput class="form-check-input mt-0" name="estudios" value="2" type="radio" v-model="form.estudios" :checked="form.estudios==2"/>Secundaria 
                                                    </label>
                                                </div>
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                            <TextInput class="form-check-input mt-0" name="estudios" value="3" type="radio" v-model="form.estudios" :checked="form.estudios==3"/>Universidad 
                                                    </label>
                                                </div> 
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-3">
                                            <div class="form-group local-forms">
                                                <label>Años en el mayor nivel <span class="login-danger">*</span></label>
                                                <TextInput class="form-control" type="number" v-model="form.nivelanios" :class="form.errors.nivelanios?'errorinput':''"></TextInput>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-3"  >
                                            <div class="form-group select-gender" :class="form.errors.genero?'errorinput':''">
                                                <label class="gen-label">Alfabeta<span
                                                        class="login-danger">*</span></label>
                                                <div class="form-check-inline">
                                                    <label class="form-check-label"> 
                                                            <TextInput class="form-check-input mt-0" name="alfa" value="0" type="radio" v-model="form.alfabeta" :checked="form.alfabeta==0"/>No 
                                                    </label>
                                                </div>
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                            <TextInput class="form-check-input mt-0" name="alfa" value="1" type="radio" v-model="form.alfabeta" :checked="form.alfabeta==1"/>Si 
                                                    </label>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="col-12 col-md-6 col-xl-3"  >
                                            <div class="form-group select-gender" :class="form.errors.genero?'errorinput':''">
                                                <label class="gen-label">Estado Civil<span
                                                        class="login-danger">*</span></label>
                                                <div class="form-check-inline">
                                                    <label class="form-check-label"> 
                                                            <TextInput class="form-check-input mt-0" name="estadocivil" value="0" type="radio" v-model="form.estadocivil" :checked="form.estadocivil==0"/>Casada 
                                                    </label>
                                                </div>
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                            <TextInput class="form-check-input mt-0" name="estadocivil" value="1" type="radio" v-model="form.estadocivil" :checked="form.estadocivil==1"/>Union Libre 
                                                    </label>
                                                </div>
                                                <div class="form-check-inline">
                                                    <label class="form-check-label"> 
                                                            <TextInput class="form-check-input mt-0" name="estadocivil" value="2" type="radio" v-model="form.estadocivil" :checked="form.estadocivil==2"/>Soltera 
                                                    </label>
                                                </div>
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                            <TextInput class="form-check-input mt-0" name="estadocivil" value="3" type="radio" v-model="form.estadocivil" :checked="form.estadocivil==3"/>Otro 
                                                    </label>
                                                </div> 
                                                
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6 col-xl-3"  >
                                            <div class="form-group select-gender" :class="form.errors.genero?'errorinput':''">
                                                <label class="gen-label">Vive sola<span
                                                        class="login-danger">*</span></label>
                                                <div class="form-check-inline">
                                                    <label class="form-check-label"> 
                                                            <TextInput class="form-check-input mt-0" name="vivesola" value="0" type="radio" v-model="form.vivesola" :checked="form.vivesola==0"/>No 
                                                    </label>
                                                </div>
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                            <TextInput class="form-check-input mt-0" name="vivesola" value="1" type="radio" v-model="form.vivesola" :checked="form.vivesola==1"/>Si 
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
     
                                        <div class="col-12 col-md-6 col-xl-6">
                                            <div class="form-group local-forms">
                                                <label>Control Prenatal en<span class="login-danger">*</span></label>
                                                <TextInput class="form-control" type="text" v-model="form.controlprenatalen" :class="form.errors.controlprenatalen?'errorinput':''"></TextInput>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-6">
                                            <div class="form-group local-forms">
                                                <label>Parto en<span class="login-danger">*</span></label>
                                                <TextInput class="form-control" type="text" v-model="form.partoen" :class="form.errors.partoen?'errorinput':''"></TextInput>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-6">
                                            <div class="form-group local-forms">
                                                <label>Carnet de Identidad<span class="login-danger">*</span></label>
                                                <TextInput class="form-control" type="text" v-model="form.cip" :class="form.errors.cip?'errorinput':''"></TextInput>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-6">
                                            <div class="form-group local-forms">
                                                <label>Numero de Historial Clinico<span class="login-danger">*</span></label>
                                                <TextInput class="form-control" type="text" v-model="form.numhisclinico" :class="form.errors.numhisclinico?'errorinput':''"></TextInput>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-6">
                                            <div class="form-group local-forms">
                                                <label>Fotografia<span class="login-danger">*</span></label>
                                                    <table  :class="form.errors.foto?'form-floating dropzone mb-3 has-danger':'form-floating dropzone mb-3'">
                                                        <tbody> 
                                                            <tr>
                                                                <td class="align-middle" style="text-align: center;    padding-top: 12px;">
                                                                    <div v-if="form.foto" class="upload-images upload-size mb-2">
                                                                        <img  :src="form.foto" alt="Image">
                                                                        </div>
                                                                    <Cropp v-model="form.foto"/>
                                                                </td> 
                                                            </tr> 
                                                        </tbody>
                                                    </table>
                                            </div>
                                        </div>
 
                                        <div class="col-12">
                                            <div class="doctor-submit text-end">
                                                <button v-if="updatemodal" @click="resetpass"
                                                    class="btn btn-danger submit-form me-2" :disabled="form.processing">Restablecer contraseña</button>
                                                    <button v-if="updatemodal" @click="actualizarDatos"
                                                    class="btn btn-primary submit-form me-2" :disabled="form.processing">Actualizar</button>
                                                <button v-else @click="guardarDatos"
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
     </div>
     <!-- -------------------modals---------------------- -->
    </Menus>
     
</template>
