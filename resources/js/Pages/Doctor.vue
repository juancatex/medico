<script setup> 
import { Head,Link,useForm,router} from '@inertiajs/vue3';  
import Menus from '@/Layouts/Menus.vue';
import TextInput from '@/Components/TextInput.vue';
import Cropp from '@/Components/CropperImage.vue'; 
import Pagination from '@/Components/Paginations.vue';
import {getCurrentInstance,onMounted,watch,ref} from 'vue'; 
import Swal from 'sweetalert2';
import { debounce } from 'lodash';
const componentName = getCurrentInstance()?.type.__name;
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
    } 
});
const form = useForm({
    iddepartamento:'',
    idrol: 2,
    idprovincia: '',
    name: '',
    genero: null, 
    ci:null, 
    id:null, 
    fechanacimiento:'', 
    matricula: '',
    telefono: null,
    telfamiliar: null,
    dir: '',
    email: '', 
    foto:null       
});

function cambiadepartamento() {
    form.idprovincia='';
    router.get('Doctor', {dep: form.iddepartamento}, {preserveState: true, preserveScroll: true, only: ['prov']});  
}
function modalo(){
    updatemodal.value=false;
    form.clearErrors();
    form.reset();
    $('#registrodoctores').modal('show'); 
}
function modalupdate(doctor){
    updatemodal.value=true;
    form.clearErrors();
    form.reset();
    form.id=doctor.id;
    form.iddepartamento=doctor.iddepartamento;
    cambiadepartamento();
    form.idrol=2;
    form.idprovincia=doctor.idprovincia;
    form.name=doctor.name
    form.genero=doctor.genero;
    form.ci=doctor.ci;
    form.fechanacimiento=doctor.fechanacimiento;
    form.matricula=doctor.matricula;
    form.telefono=doctor.telefono;
    form.telfamiliar=doctor.telfamiliar;
    form.dir=doctor.dir;
    form.email=doctor.email; 
    form.foto=doctor.foto;
    $('#registrodoctores').modal('show'); 
}
const closeModal=()=>{ 
    updatemodal.value=false;
    form.reset();
    form.clearErrors(); 
    $('#registrodoctores').modal('hide');  
};
const guardarDatos=()=>{
    form.post(route('RegDoctor'),{onSuccess:()=>{ok('Creado correctamente')}  });
};
const actualizarDatos=()=>{
    form.put(route('ActualizarDoctor'),{onSuccess:()=>{ok('Modificado correctamente')}  }); 
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
                form.post(route('EliminarDoctor'),{onSuccess:()=>{ok('Eliminado correctamente')}  });
            } 
        }
    );
    }; 

const ok =(msj)=>{ 
    closeModal();
    Swal.fire({title:msj,icon:'success'});
};

onMounted(() => { 
    if ($('[data-feather]').length > 0) {
        feather.replace();
    }
      console.log(componentName);
    });
watch(searchField, debounce(() => { 
    router.get('/Doctor', {search: searchField.value}, {preserveState: true, preserveScroll: true, only: ['lista']})
}, 300));
const resetpass=()=>{
    form.put(route('ActualizarDoctorPass'),{onSuccess:()=>{ok('Modificado correctamente')}  }); 
};
</script>

<template>
    <Head title="Doctor" /> 
    <Menus :menuname="componentName"> 
    <div class="content">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"> <Link   :href="route('dashboard')"> Dashboard </Link></li>
                        <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                        <li class="breadcrumb-item active">Doctor</li>
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
                                                      <h3>Listado general de doctores</h3>
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
                                                <th>C.I.</th>
                                                <th>Fecha de Nacimiento</th>
                                                <th>Matricula</th>
                                                <th>Correo Electrónico</th> 
                                                <th>Numero de Teléfono</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody> 
                                            <tr v-for="doctor in lista.data" :key="doctor.id"> 

                                                <td class="profile-image"><img width="28"
                                                                                height="28" :src="doctor.foto?doctor.foto:'assets/img/user.jpg'"
                                                                                class="rounded-circle m-r-5" alt="">{{ doctor.name}}</td> 
                                                <td class="align-middle" style="text-align: center;">{{ doctor.ci }}</td>
                                                <td class="align-middle" style="text-align: center;">{{ doctor.fechanacimiento }}</td>
                                                <td class="align-middle" style="text-align: center;">{{ doctor.matricula }}</td>
                                                <td class="align-middle" style="text-align: right;">{{ doctor.email }}</td>
                                                <td class="align-middle" style="text-align: right;">{{ doctor.telefono }}</td> 

                                                <td class="text-end">
                                                                        <button @click="modalupdate(doctor)"
                                                                            class="btn btn-sm btn-white text-success me-2"><i
                                                                                class="far fa-edit me-1"></i> Editar</button>

                                                                        <button @click="EliminarDatos(doctor.id)"
                                                                            class="btn btn-sm btn-white text-danger"><i
                                                                                class="far fa-trash-alt me-1"></i>Eliminar</button>
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
     <div class="modal custom-modal modal-bg  fade invoices-preview" id="registrodoctores" role="dialog">
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
                                                            <p>Doctor</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
 
                                        <div class="row mt-4">
                                      
                                        <div class="col-12 col-md-12 col-xl-12">
                                            <div class="form-group local-forms">
                                                <label>Nombre completo <span class="login-danger">*</span></label> 
                                                <TextInput class="form-control" type="text" v-model="form.name" :class="form.errors.name?'errorinput':''"></TextInput>
                                            </div>
                                        </div>
                                         

                                        <div class="col-12 col-md-6 col-xl-4">
                                            <div class="form-group local-forms ">
                                                <label>Fecha de nacimiento<span class="login-danger">*</span></label> 
                                                <TextInput class="form-control datetimepicker" type="date" v-model="form.fechanacimiento" :class="form.errors.fechanacimiento?'errorinput':''"></TextInput>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6 col-xl-4">
                                            <div class="form-group select-gender" :class="form.errors.genero?'errorinput':''">
                                                <label class="gen-label">Genero<span
                                                        class="login-danger">*</span></label>
                                                <div class="form-check-inline">
                                                    <label class="form-check-label"> 
                                                            <TextInput class="form-check-input mt-0" name="gender" value="M" type="radio" v-model="form.genero" :checked="form.genero=='M'"/>Masculino 
                                                    </label>
                                                </div>
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                            <TextInput class="form-check-input mt-0" name="gender" value="F" type="radio" v-model="form.genero" :checked="form.genero=='F'"/>Femenino 
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-4">
                                            <div class="form-group local-forms">
                                                <label>Cedula de Identidad <span class="login-danger">*</span></label> 
                                                <TextInput class="form-control" type="number" v-model="form.ci" :class="form.errors.ci?'errorinput':''"></TextInput>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-4">
                                            <div class="form-group local-forms">
                                                <label>Matricula Profesional <span class="login-danger">*</span></label>
                                                <TextInput class="form-control" type="text" v-model="form.matricula" :class="form.errors.matricula?'errorinput':''"></TextInput>
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
                                                <label>Contacto de Emergencia <span class="login-danger">*</span></label>
                                                <TextInput class="form-control" type="number" v-model="form.telfamiliar" :class="form.errors.telfamiliar?'errorinput':''"></TextInput>
                                            </div> 
                                        </div> 
                                        <div class="col-12 col-md-6 col-xl-4">
                                            <div class="form-group local-forms">
                                                <label>Ciudad <span class="login-danger">*</span></label> 
                                                    <select class="form-control select"  :class="form.errors.iddepartamento?'errorinput':''"
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
                                            <div class="form-group local-forms">
                                                <label>Correo Electronico <span class="login-danger">*</span></label> 
                                                <TextInput class="form-control" type="email" v-model="form.email" :class="form.errors.email?'errorinput':''"></TextInput>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-10">
                                            <div class="form-group local-forms">
                                                <label>Direccion <span class="login-danger">*</span></label>
                                                <textarea class="form-control" rows="6" cols="30" v-model="form.dir" :class="form.errors.dir?'errorinput':''" ></textarea>
                                            </div>
                                        </div> 
                                       

                                        <div class="col-12 col-md-6 col-xl-2 row">
                                            <table
                                                :class="form.errors.foto?'form-floating dropzone mb-3 has-danger':'form-floating dropzone mb-3'">
                                                <tbody> 
                                                    <tr>
                                                        <td class="align-middle" style="text-align: center;">
                                                            <div v-if="form.foto" class="upload-images upload-size mb-2">
                                                                <img  :src="form.foto" alt="Image">
                                                             </div>
                                                           <Cropp v-model="form.foto"/>
                                                        </td> 
                                                    </tr> 
                                                </tbody>
                                            </table>
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
