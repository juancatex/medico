<script setup> 
import { Head,Link,useForm,router} from '@inertiajs/vue3';  
import Menus from '@/Layouts/Menus.vue'; 
import {getCurrentInstance,onMounted,watch,ref} from 'vue'; 
import Swal from 'sweetalert2';
import Pdfgen from '../pdf.js';  

const datapdf=ref(''); 
const props =defineProps({ 
    user: {
        type: Object,
    }  
}); 
const componentName = getCurrentInstance()?.type.__name 
const form = useForm({   
    id:props.user.id,  
    passactual: null, 
    password: null, 
    passwordConfirm:null
});
onMounted(() => { 
      console.log(componentName); 
       
 });
 const ok =(msj)=>{ 
    form.clearErrors;
    form.reset; 
    Swal.fire({title:msj,icon:'success'});
};
 const actualizarDatos=()=>{
    form.put(route('Seguridadupdate'),{onSuccess:()=>{ok('Modificado correctamente')}  }); 
};

</script>

<template>
    <Head title="Seguridad" /> 
    <Menus :menuname="componentName"> 
    <div class="content">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"> <Link   :href="route('dashboard')"> Dashboard </Link></li>
                        <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                        <li class="breadcrumb-item active">Seguridad</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
                    <div class="col-sm-12">
                        <div class="card card-table show-entire">
                            <div class="card-body"> 



                                <div class="page-table-header mb-2"> 
                                   
                                    <div class="row">
                                        <h4 class="page-title">Cambiar contraseña</h4>
                                        <div class="col-12 col-md-6 col-xl-12">
                                            <div class="form-group local-forms">
                                                <label>Contraseña antigua<span class="login-danger">*</span></label>
                                                <input class="form-control" type="password" v-model="form.passactual"  :class="form.errors.passactual?'errorinput':''">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-6">
                                            <div class="form-group local-forms">
                                                <label>Nueva contraseña <span class="login-danger">*</span></label>
                                                <input class="form-control" type="password" v-model="form.password"  :class="form.errors.password?'errorinput':''">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-6">
                                            <div class="form-group local-forms">
                                                <label>Confirmar contraseña <span class="login-danger">*</span></label>
                                                <input class="form-control" type="password" v-model="form.passwordConfirm"  :class="form.errors.passwordConfirm?'errorinput':''">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="doctor-submit text-end">
                                                <button  @click="actualizarDatos" class="btn btn-primary submit-form me-2">Guardar cambios</button>
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
