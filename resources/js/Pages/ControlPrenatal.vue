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
const listadotrat=ref({}); 
const peso=ref(null); 
const talla=ref(null); 
const props =defineProps({ 
    lista: {
        type: Object,
    } 
});
const form = useForm({ 
    iduser: null,       
    peso: null,    
    imc: null,    
    pa: null,    
    edadgest: null,    
    alturauterina: null,    
    presentacion: null,    
    fcf: null,    
    movimfetales: null,    
    proteinuria: null,    
    numtabferroso: null,    
    tratamientos: null,    
    responsable: null,    
    proximacita: null,    
});
watch(searchField, debounce(() => { 
    router.get('/ControlPrenatal', {search: searchField.value}, {preserveState: true, preserveScroll: true, only: ['lista']})
}, 300));

watch(peso, () => { 
    form.peso=peso.value;
    calcularIMC(); 
} );

function calcularIMC(){
    console.log("object");
    if(form.peso!=null&&form.peso>0&&talla.value !=null&&talla.value>0){ 
            var tallaux=redondeo_valor(talla.value/100)
            var aux = tallaux*tallaux;
            form.imc= redondeo_valor(form.peso/aux);  
    }
}
 
function openlistado(paciente){ 
    paciente.responsable=true;
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
    var url= '/obtenerregistros?id='+paciente.id;
    axios.get(url).then(function (response) {   
       Swal.close();  
       if(response.data instanceof Object&&response.data.length>0){
        modallistado(response);
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

 

function modalregistro(data){  
    modalname.value=data.name;
    form.clearErrors();
    form.reset();   
    form.iduser=data.id; 
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
    var url= '/obtenergestacionActual?id='+data.id;
    axios.get(url).then(function (response) {   
       Swal.close(); 
       $('#resgistrotrat').modal('show'); 
       if(response.data instanceof Object){ 
        talla.value=response.data.talla
       } 
    })
    .catch(function (error) {
        console.log(error);
    });

    
}
function modallistado(data){ 
    listadotrat.value = data.data;
    $('#listadotrat').modal('show'); 
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
const closeModalListado=()=>{   
    $('#listadotrat').modal('hide');  
};

 
const guardarDatos=()=>{
    form.post(route('RegControlPrenatal'),{onSuccess:()=>{ok('Registrado correctamente')}  });
};
 
function porcentaje(datos){
  if(datos!=null){
    const arrayin=Object.values(datos);
    var counter=0;
                for (let value of arrayin) { 
                    if(value!=null){
                        counter++;
                    }
                }
   
        return redondeo_valor((100*counter)/arrayin.length) ;
  }else{
    return 0;
  }

}
function redondeo_valor(num, decimales = 2, redoncero = true) {
  var signo = (num >= 0 ? 1 : -1);
  num = num * signo;
  if (decimales === 0)
    return signo * Math.round(num);
  num = num.toString().split('e');
  num = Math.round(+(num[0] + 'e' + (num[1] ? (+num[1] + decimales) : decimales)));
  num = num.toString().split('e');
  if (redoncero) {
    return fillDecimals(signo * (num[0] + 'e' + (num[1] ? (+num[1] - decimales) : -decimales)), decimales);
  } else {
    return (signo * (num[0] + 'e' + (num[1] ? (+num[1] - decimales) : -decimales)));
  }

}

 function fillDecimals(number, length = 2) {
  function pad(input, length, padding) {
    var str = input + "";
    return (length <= str.length) ? str : pad(str + padding, length, padding);
  }
  var str = number + "";
  var dot = str.lastIndexOf('.');
  var isDecimal = dot != -1;
  var integer = isDecimal ? str.substr(0, dot) : str;
  var decimals = isDecimal ? str.substr(dot + 1) : "";
  decimals = pad(decimals, length, 0);
  return integer + '.' + decimals;
}
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
                                                <th class="align-middle" style="text-align: center;">xx antecedentes</th>
                                                <th class="align-middle" style="text-align: center;">xx gestacion</th>
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
                                                <td class="align-middle" style="text-align: center;">{{ porcentaje(paciente.getante) }}%</td>
                                                <td class="align-middle" style="text-align: center;">{{ porcentaje(paciente.getgest) }}%</td>
                                                <td class="align-middle" style="text-align: center;">{{ paciente.controlprenatalen }}</td>  
                                                

                                                <td class="text-end">
                                                  
                                                                        <div v-if="paciente.getmayor" class="custom-badge status-blue submit-form  me-2"><div v-if="paciente.getmayor.responsable" >Atendido</div> </div>

                                                                        <button @click="openlistado(paciente)"
                                                                            class="btn btn-sm  btn-primary submit-form  me-2"><i
                                                                                class="fa-solid fa-search me-1"></i>Ver estado</button>
                                                                               
                                                                        <button @click="modalregistro(paciente)"
                                                                            class="btn btn-sm  btn-success submit-form  me-2"><i
                                                                                class="fa-solid fa-plus me-1"></i>Nuevo registro</button>
                                                                         
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
                                                            <h2 class="text-primary">Control Prenatal Inicial</h2>
                                                            <p>{{modalname}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                            <div class="row mt-4 pb-3 ">
                                                <div class="col-12 col-md-6 col-xl-3">
                                                    <div class="form-group local-forms">
                                                        <label>Peso <span class="login-danger">*</span></label>
                                                        <TextInput  min="1" class="form-control" type="number" v-model="peso" :class="form.errors.peso?'errorinput':''"></TextInput>
                                                    </div> 
                                                </div>
                                                <div class="col-12 col-md-6 col-xl-3">
                                                    <div class="form-group local-forms">
                                                        <label>IMC <span class="login-danger">*</span></label>
                                                        <TextInput min="1" class="form-control" type="number" v-model="form.imc" :class="form.errors.imc?'errorinput':''"></TextInput>
                                                    </div> 
                                                </div> 
                                                <div class="col-12 col-md-6 col-xl-3">
                                                    <div class="form-group local-forms">
                                                        <label>Edad gestacional<span class="login-danger">*</span></label>
                                                        <TextInput min="1" class="form-control" type="number" v-model="form.edadgest" :class="form.errors.edadgest?'errorinput':''"></TextInput>
                                                    </div> 
                                                </div>
                                               
                                                <div class="col-12 col-md-6 col-xl-3">
                                                    <div class="form-group local-forms">
                                                        <label>Presión arterial<span class="login-danger">*</span></label>
                                                        <TextInput class="form-control" type="text" v-model="form.pa" :class="form.errors.pa?'errorinput':''"></TextInput>
                                                    </div> 
                                                </div>
                                                <div class="col-12 col-md-6 col-xl-3">
                                                    <div class="form-group local-forms">
                                                        <label>Presentacion <span class="login-danger">*</span></label> 
                                                            <select class="form-control select" :class="form.errors.presentacion?'errorinput':''"
                                                                v-model="form.presentacion" 
                                                                ref="input" >  
                                                                <option value="null"  disabled>Seleccione</option> 
                                                                <option value="0">Cefálico (cef)</option> 
                                                                <option value="1">Pelviana (pel)</option> 
                                                                <option value="2">Transversa (tra)</option> 
                                                            </select> 
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6 col-xl-3">
                                                    <div class="form-group local-forms">
                                                        <label>Altura uterina<span class="login-danger">*</span></label>
                                                        <TextInput min="1"  class="form-control" type="number" v-model="form.alturauterina" :class="form.errors.alturauterina?'errorinput':''"></TextInput>
                                                    </div> 
                                                </div>
                                                <div class="col-12 col-md-6 col-xl-3">
                                                    <div class="form-group local-forms">
                                                        <label>Frec. cardíaca <span class="login-danger">*</span></label>
                                                        <TextInput min="1"  class="form-control" type="number" v-model="form.fcf" :class="form.errors.fcf?'errorinput':''"></TextInput>
                                                    </div> 
                                                </div>
                                               
                                                <div class="col-12 col-md-6 col-xl-3">
                                                    <div class="form-group local-forms">
                                                        <label>N° Tab. S. Ferroso<span class="login-danger">*</span></label>
                                                        <TextInput min="0" class="form-control" type="number" v-model="form.numtabferroso" :class="form.errors.numtabferroso?'errorinput':''"></TextInput>
                                                    </div> 
                                                </div>
                                                <div class="col-12 col-md-6 col-xl-3">
                                                    <div class="form-group local-forms">
                                                        <label>Movim. fetales <span class="login-danger">*</span></label>
                                                        <TextInput  class="form-control" type="text" v-model="form.movimfetales" :class="form.errors.movimfetales?'errorinput':''"></TextInput>
                                                    </div> 
                                                </div> 
                                                <div class="col-12 col-md-6 col-xl-3">
                                                    <div class="form-group local-forms">
                                                        <label>Proteinuria<span class="login-danger">*</span></label>
                                                        <TextInput class="form-control" type="text" v-model="form.proteinuria" :class="form.errors.proteinuria?'errorinput':''"></TextInput>
                                                    </div> 
                                                </div>
                                                
                                            </div>
                                        <div v-if="form.errors.asisfecha" class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>Registro duplicado!</strong> El paciente ya cuenta con un registro previo.
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
     <div class="modal custom-modal modal-bg  fade invoices-preview" id="listadotrat" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-xl">
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
                                    <div class="row mt-4 pb-3">
                                        <div class="col-12">
                                                        <div class="table-responsive">
                                                                    <table class="table border-0 custom-table comman-table datatable mb-0">
                                                                        <thead>
                                                                            <tr> 
                                                                                <th>Fecha Registro</th>
                                                                                <th>Peso</th>
                                                                                <th>IMC</th>
                                                                                <th>P.A.</th>
                                                                                <th>Ed. gest.</th>
                                                                                <th>Alt. ut.</th>  
                                                                                <th>Pre.</th>  
                                                                                <th>FCF</th>  
                                                                                <th>Mov. fet.</th>  
                                                                                <th>Proteinuria</th>  
                                                                                <th>Num. tab. fe.</th>  
                                                                                <th style="width: 200px; ">Señales de peligro, examenes, tratamientos</th>  
                                                                                <th>Responsable</th>  
                                                                                <th>Proxima cita</th>  
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody> 
                                                                            <tr v-for="trat in listadotrat" :key="trat.idprenat"  style="  white-space: normal !important;"> 

                                                                                <td class="align-middle" style="text-align: center;">{{ trat.asisfecha}}</td> 
                                                                                <td class="align-middle" style="text-align: center;">{{ trat.peso }}</td>
                                                                                <td class="align-middle" style="text-align: center;">{{ trat.imc }}</td>
                                                                                <td class="align-middle" style="text-align: center;">{{ trat.pa }}</td>
                                                                                <td class="align-middle" style="text-align: center;">{{ trat.edadgest }}</td> 
                                                                                <td class="align-middle" style="text-align: center;">{{ trat.alturauterina }}</td>
                                                                                <td class="align-middle" style="text-align: center;">{{ trat.presentacion!=null?(trat.presentacion==0?'cef':(trat.presentacion==1?'pel':(trat.presentacion==2?'tra':'-'))):'' }}</td>
                                                                                <td class="align-middle" style="text-align: center;">{{ trat.fcf }}</td>
                                                                                <td class="align-middle" style="text-align: center;">{{ trat.movimfetales }}</td>
                                                                                <td class="align-middle" style="text-align: center;">{{ trat.proteinuria }}</td>
                                                                                <td class="align-middle" style="text-align: center;">{{ trat.numtabferroso }}</td>
                                                                                <td class="align-middle" style="text-align: left;  width: 200px; ">{{ trat.tratamientos }}</td>
                                                                                <td class="align-middle" style="text-align: left;">{{ trat.name }}</td>
                                                                                <td class="align-middle" style="text-align: center;">{{ trat.proximacita }}</td>
                                                                                  
                                                                            </tr> 
                                                                        </tbody>
                                                                    </table>  
                                                        </div>
                                         </div>
                                    </div>
                                        <div class="col-12">
                                            <div class="doctor-submit text-end"> 
                                                <button @click="closeModalListado"
                                                    class="btn btn-primary cancel-form" :disabled="form.processing">Cerrar</button>
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
