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
const dosis1=ref(null); 
const dosis2=ref(null); 
const gli1=ref(null); 
const gli2=ref(null); 
const anemiamenor=ref(null); 
const anemiamayor=ref(null); 
const pesoanterior=ref(null); 
const talla=ref(null); 
const props =defineProps({ 
    lista: {
        type: Object,
    } 
});
const form = useForm({ 
    iduser: null, 
    pesoanterior: null, 
    talla: null, 
    imc: null, 
    evaluacionnutricional: null, 
    fppdate: null, 
    fumdate: null, 
    fum: null, 
    eco: null, 
    fumaact1: null, 
    fumaact2: null, 
    fumapas1: null, 
    fumapas2: null, 
    drogas1: null, 
    drogas2: null, 
    alcohol1: null, 
    alcohol2: null, 
    violencia1: null, 
    violencia2: null, 
    natirubeola: null, 
    antitetanicavigente: null, 
    dosis1: null, 
    dosis2: null, 
    odont: null, 
    mamas: null, 
    pap: null, 
    colp: null, 
    grupo: null, 
    rh: null, 
    inmuniz: null, 
    antid: null, 
    glicemia20: null, 
    glicemia20105: null, 
    glicemia30: null, 
    glicemia30105: null, 
    hbmenor: null, 
    anemiamenor: null, 
    hierro: null, 
    folatos: null, 
    hbmayor: null, 
    anemiamayor: null, 
    vihsolmenor: null, 
    vihpruebamenor: null, 
    vihtratmenor: null, 
    vihsolmayor: null, 
    vihpruebamayor: null, 
    vihtratmayor: null, 
    sifilismenorrpr: null, 
    sifilismenor20: null, 
    sifilismenortrat: null, 
    sifilismenor: null, 
    sifilismenortratpareja: null, 
    sifilismayorrpr: null, 
    sifilismayor20: null, 
    sifilismayortrat: null, 
    sifilismayor: null, 
    sifilismayortratpareja: null, 
    planeadoparto: null, 
    orientacion: null, 
    orina: null, 
    bacteriuriamenor: null, 
    bacteriuriamayor: null, 
    chagas: null, 
    paludismo: null, 
    estreptococo: null, 
    toxoplasmosismenor: null, 
    toxoplasmosismayor: null, 
    toxoplasmosisconsulta: null,    
});
watch(searchField, debounce(() => { 
    router.get('/GestacionActual', {search: searchField.value}, {preserveState: true, preserveScroll: true, only: ['lista']})
}, 300));

watch(dosis1, () => {  
   form.dosis1=dosis1.value==null?null:(dosis1.value?1:0)
} );
watch(dosis2, () => { 
    form.dosis2=dosis2.value==null?null:(dosis2.value?1:0)
} );
watch(gli1, () => { 
    form.glicemia20105=gli1.value==null?null:(gli1.value?1:0)
} );

watch(gli2, () => { 
    form.glicemia30105=gli2.value==null?null:(gli2.value?1:0)
} );
watch(anemiamenor, () => { 
    form.anemiamenor=anemiamenor.value==null?null:(anemiamenor.value?1:0)
} );
watch(anemiamayor, () => { 
    form.anemiamayor=anemiamayor.value==null?null:(anemiamayor.value?1:0)
} );

watch(pesoanterior, () => { 
    form.pesoanterior=pesoanterior.value;
    calcularIMC(); 
} );
watch(talla, () => { 
    form.talla=talla.value;
    calcularIMC();
} );

function calcularIMC(){
    console.log("object");
    if(form.pesoanterior!=null&&form.pesoanterior>0){
        if(form.talla!=null&&form.talla>0){
            var tallaux=redondeo_valor(form.talla/100)
            var aux = tallaux*tallaux;
            form.imc= redondeo_valor(form.pesoanterior/aux); 
            switch (true) {
                case form.imc<21.2:
                      form.evaluacionnutricional=0;
                    break;
                case form.imc>=21.2&&form.imc<24.3:
                form.evaluacionnutricional=1;
                    break;
                case form.imc>=24.3&&form.imc<26.6:
                form.evaluacionnutricional=2;
                    break;
                case form.imc>=26.6:
                form.evaluacionnutricional=3;
                    break;
              
            }
        }
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
    var url= '/obtenergestacionActual?id='+paciente.id;
    axios.get(url).then(function (response) {   
       Swal.close(); 
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
    form.pesoanterior=paciente.pesoanterior; 
    form.talla=paciente.talla; 
    pesoanterior.value=paciente.pesoanterior; 
    talla.value=paciente.talla; 
    form.imc=paciente.imc; 
    form.evaluacionnutricional=paciente.evaluacionnutricional; 
    form.fppdate=paciente.fppdate; 
    form.fumdate=paciente.fumdate; 
    form.fum=paciente.fum; 
    form.eco=paciente.eco; 
    form.fumaact1=paciente.fumaact1; 
    form.fumaact2=paciente.fumaact2; 
    form.fumapas1=paciente.fumapas1; 
    form.fumapas2=paciente.fumapas2; 
    form.drogas1=paciente.drogas1; 
    form.drogas2=paciente.drogas2; 
    form.alcohol1=paciente.alcohol1; 
    form.alcohol2=paciente.alcohol2; 
    form.violencia1=paciente.violencia1; 
    form.violencia2=paciente.violencia2; 
    form.natirubeola=paciente.natirubeola; 
    form.antitetanicavigente=paciente.antitetanicavigente; 
    form.dosis1=paciente.dosis1; 
    form.dosis2=paciente.dosis2; 
    form.odont=paciente.odont; 
    form.mamas=paciente.mamas; 
    form.pap=paciente.pap; 
    form.colp=paciente.colp; 
    form.grupo=paciente.grupo; 
    form.rh=paciente.rh; 
    form.inmuniz=paciente.inmuniz; 
    form.antid=paciente.antid; 
    form.glicemia20=paciente.glicemia20; 
    form.glicemia20105=paciente.glicemia20105; 
    form.glicemia30=paciente.glicemia30; 
    form.glicemia30105=paciente.glicemia30105; 
    form.hbmenor=paciente.hbmenor; 
    form.anemiamenor=paciente.anemiamenor; 
    form.hierro=paciente.hierro; 
    form.folatos=paciente.folatos; 
    form.hbmayor=paciente.hbmayor; 
    form.anemiamayor=paciente.anemiamayor; 
    form.vihsolmenor=paciente.vihsolmenor; 
    form.vihpruebamenor=paciente.vihpruebamenor; 
    form.vihtratmenor=paciente.vihtratmenor; 
    form.vihsolmayor=paciente.vihsolmayor; 
    form.vihpruebamayor=paciente.vihpruebamayor; 
    form.vihtratmayor=paciente.vihtratmayor; 
    form.sifilismenorrpr=paciente.sifilismenorrpr; 
    form.sifilismenor20=paciente.sifilismenor20; 
    form.sifilismenortrat=paciente.sifilismenortrat; 
    form.sifilismenor=paciente.sifilismenor; 
    form.sifilismenortratpareja=paciente.sifilismenortratpareja; 
    form.sifilismayorrpr=paciente.sifilismayorrpr; 
    form.sifilismayor20=paciente.sifilismayor20; 
    form.sifilismayortrat=paciente.sifilismayortrat; 
    form.sifilismayor=paciente.sifilismayor; 
    form.sifilismayortratpareja=paciente.sifilismayortratpareja; 
    form.planeadoparto=paciente.planeadoparto; 
    form.orientacion=paciente.orientacion; 
    form.orina=paciente.orina; 
    form.bacteriuriamenor=paciente.bacteriuriamenor; 
    form.bacteriuriamayor=paciente.bacteriuriamayor; 
    form.chagas=paciente.chagas; 
    form.paludismo=paciente.paludismo; 
    form.estreptococo=paciente.estreptococo; 
    form.toxoplasmosismenor=paciente.toxoplasmosismenor; 
    form.toxoplasmosismayor=paciente.toxoplasmosismayor; 
    form.toxoplasmosisconsulta=paciente.toxoplasmosisconsulta; 
       
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
    form.post(route('Reggestacionactual'),{onSuccess:()=>{ok('Registrado correctamente')}  });
};
 
  
onMounted(() => { 
      console.log(componentName); 
    });

</script>

<template>
    <Head title="Gestacion Actual" /> 
    <Menus :menuname="componentName"> 
    <div class="content">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"> <Link   :href="route('dashboard')"> Dashboard </Link></li>
                        <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                        <li class="breadcrumb-item active">Gestacion Actual</li>
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
                                                                            class="btn btn-sm  btn-success submit-form  me-2"><i
                                                                                class="fa-solid fa-person-pregnant me-1"></i>Gestacion Actual</button>
  
                                                                         
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
                                                            <h2 class="text-primary">Gestación Actual</h2>
                                                            <p>{{modalname}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
 
                                    <div class="row mt-4 pb-3 ">
                                        
                                        <div class="col-12 col-md-6 col-xl-3 cuadrogestacion" >
                                           
                                            <table cellpadding="5" style="width: 100%;">
                                                <tr>
                                                    <td>
                                                            <div class="form-group local-forms" style="margin-bottom: 14px;">
                                                            <label>Peso Anterior<span class="login-danger">*</span></label> 
                                                            <TextInput min="1" class="form-control" type="number" v-model="pesoanterior" :class="form.errors.pesoanterior?'errorinput':''"></TextInput>
                                                            </div>
                                                            <div class="form-group local-forms" style="margin-bottom: 0px;">
                                                            <label>Talla (cm)<span class="login-danger">*</span></label> 
                                                            <TextInput min="1" class="form-control" type="number" v-model="talla" :class="form.errors.talla?'errorinput':''"></TextInput>
                                                            </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group local-forms" style="margin-bottom: 14px;">
                                                            <label>IMC<span class="login-danger">*</span></label> 
                                                            <TextInput min="1" class="form-control" type="number" v-model="form.imc" :class="form.errors.imc?'errorinput':''" readonly></TextInput>
                                                         </div>
                                                         <table  :class="form.errors.evaluacionnutricional?'errorinput':''" style="width: 100%;" >
                                                            <tr>
                                                                <td><label class="form-check-label">
                                                                    E <TextInput class="form-check-input mt-0 m-1" name="evaluacionnutricional" value="0" type="radio" v-model="form.evaluacionnutricional" :checked="form.evaluacionnutricional==0"/> 
                                                                    N <TextInput class="form-check-input mt-0 m-1" name="evaluacionnutricional" value="1" type="radio" v-model="form.evaluacionnutricional" :checked="form.evaluacionnutricional==1"/> 
                                                                    </label>
                                                                </td>   
                                                            </tr>
                                                            <tr>
                                                                <td><label class="form-check-label">
                                                                    S <TextInput class="form-check-input mt-0 m-1" name="evaluacionnutricional" value="2" type="radio" v-model="form.evaluacionnutricional" :checked="form.evaluacionnutricional==2"/> 
                                                                    O <TextInput class="form-check-input mt-0 m-1" name="evaluacionnutricional" value="3" type="radio" v-model="form.evaluacionnutricional" :checked="form.evaluacionnutricional==3"/>
                                                                    </label>
                                                                </td>
                                                            </tr>
                                                         </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-4 cuadrogestacion">
                                            <table cellpadding="5" style="width: 100%;">
                                                <tr> 
                                                    <td style="width: 50%;">
                                                            <div class="form-group local-forms" style="margin-bottom: 14px;">
                                                            <label>FUM<span class="login-danger">*</span></label> 
                                                            <TextInput min="1" class="form-control" type="date" v-model="form.fumdate" :class="form.errors.fumdate?'errorinput':''"></TextInput>
                                                            </div>
                                                            <div class="form-group local-forms" style="margin-bottom: 0px;">
                                                            <label>FPP<span class="login-danger">*</span></label> 
                                                            <TextInput min="1" class="form-control" type="date" v-model="form.fppdate" :class="form.errors.fppdate?'errorinput':''"></TextInput>
                                                            </div>
                                                    </td>
                                                    <td style="width: 50%;">
                                                        
                                                         <table   style="width: 100%;" >
                                                            <tr><td colspan="2"><div class="form-group local-forms" >
                                                            <label style="text-align: center;    width: 100%;">Eg. Confiable<span class="login-danger">*</span></label>  
                                                         </div></td></tr>
                                                            <tr :class="form.errors.fum?'errorinput':''">
                                                                <td>FUM</td>
                                                                <td><label class="form-check-label" style="text-align: start;">
                                                                    <TextInput class="form-check-input mt-0 m-1" name="fum" value="0" type="radio" v-model="form.fum" :checked="form.fum==0"/>No
                                                                    <TextInput class="form-check-input mt-0 m-1" name="fum" value="1" type="radio" v-model="form.fum" :checked="form.fum==1"/>Si 
                                                                    </label>
                                                                </td>   
                                                            </tr>
                                                            <tr :class="form.errors.eco?'errorinput':''">
                                                                <td>Eco</td>
                                                                <td><label class="form-check-label" style="text-align: start;">
                                                                    <TextInput class="form-check-input mt-0 m-1" name="eco" value="0" type="radio" v-model="form.eco" :checked="form.eco==0"/>No
                                                                    <TextInput class="form-check-input mt-0 m-1" name="eco" value="1" type="radio" v-model="form.eco" :checked="form.eco==1"/>Si
                                                                    </label>
                                                                </td>
                                                            </tr>
                                                         </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-5 cuadrogestacion d-flex align-items-center">
                                            <table style="width: 100%;font-size: smaller;" cellpadding="5">
                                            <tr>
                                                <td></td>
                                                <td>Fuma Act.</td>
                                                <td>Fuma Pas.</td>
                                                <td>Drogas</td>
                                                <td>Alcohol</td>
                                                <td>Violencia</td>
                                            </tr>
                                            <tr>
                                                <td>1a mitad</td>
                                                <td>
                                                    <label class="form-check-label" style="    font-size: xx-small;">
                                                    <TextInput class="form-check-input mt-0 m-1" name="fumaact1" value="0" type="radio" v-model="form.fumaact1" :checked="form.fumaact1==0"/>No
                                                    <TextInput class="form-check-input mt-0 m-1" name="fumaact1" value="1" type="radio" v-model="form.fumaact1" :checked="form.fumaact1==1"/>Si
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="form-check-label" style="    font-size: xx-small;">
                                                    <TextInput class="form-check-input mt-0 m-1" name="fumapas1" value="0" type="radio" v-model="form.fumapas1" :checked="form.fumapas1==0"/>No
                                                    <TextInput class="form-check-input mt-0 m-1" name="fumapas1" value="1" type="radio" v-model="form.fumapas1" :checked="form.fumapas1==1"/>Si
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="form-check-label" style="    font-size: xx-small;">
                                                    <TextInput class="form-check-input mt-0 m-1" name="drogas1" value="0" type="radio" v-model="form.drogas1" :checked="form.drogas1==0"/>No
                                                    <TextInput class="form-check-input mt-0 m-1" name="drogas1" value="1" type="radio" v-model="form.drogas1" :checked="form.drogas1==1"/>Si
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="form-check-label" style="    font-size: xx-small;">
                                                    <TextInput class="form-check-input mt-0 m-1" name="alcohol1" value="0" type="radio" v-model="form.alcohol1" :checked="form.alcohol1==0"/>No
                                                    <TextInput class="form-check-input mt-0 m-1" name="alcohol1" value="1" type="radio" v-model="form.alcohol1" :checked="form.alcohol1==1"/>Si
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="form-check-label" style="    font-size: xx-small;">
                                                    <TextInput class="form-check-input mt-0 m-1" name="violencia1" value="0" type="radio" v-model="form.violencia1" :checked="form.violencia1==0"/>No
                                                    <TextInput class="form-check-input mt-0 m-1" name="violencia1" value="1" type="radio" v-model="form.violencia1" :checked="form.violencia1==1"/>Si
                                                    </label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2a mitad</td>
                                                <td>
                                                    <label class="form-check-label" style="    font-size: xx-small;">
                                                    <TextInput class="form-check-input mt-0 m-1" name="fumaact2" value="0" type="radio" v-model="form.fumaact2" :checked="form.fumaact2==0"/>No
                                                    <TextInput class="form-check-input mt-0 m-1" name="fumaact2" value="1" type="radio" v-model="form.fumaact2" :checked="form.fumaact2==1"/>Si
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="form-check-label" style="    font-size: xx-small;">
                                                    <TextInput class="form-check-input mt-0 m-1" name="fumapas2" value="0" type="radio" v-model="form.fumapas2" :checked="form.fumapas2==0"/>No
                                                    <TextInput class="form-check-input mt-0 m-1" name="fumapas2" value="1" type="radio" v-model="form.fumapas2" :checked="form.fumapas2==1"/>Si
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="form-check-label" style="    font-size: xx-small;">
                                                    <TextInput class="form-check-input mt-0 m-1" name="drogas2" value="0" type="radio" v-model="form.drogas2" :checked="form.drogas2==0"/>No
                                                    <TextInput class="form-check-input mt-0 m-1" name="drogas2" value="1" type="radio" v-model="form.drogas2" :checked="form.drogas2==1"/>Si
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="form-check-label" style="    font-size: xx-small;">
                                                    <TextInput class="form-check-input mt-0 m-1" name="alcohol2" value="0" type="radio" v-model="form.alcohol2" :checked="form.alcohol2==0"/>No
                                                    <TextInput class="form-check-input mt-0 m-1" name="alcohol2" value="1" type="radio" v-model="form.alcohol2" :checked="form.alcohol2==1"/>Si
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="form-check-label" style="    font-size: xx-small;">
                                                    <TextInput class="form-check-input mt-0 m-1" name="violencia2" value="0" type="radio" v-model="form.violencia2" :checked="form.violencia2==0"/>No
                                                    <TextInput class="form-check-input mt-0 m-1" name="violencia2" value="1" type="radio" v-model="form.violencia2" :checked="form.violencia2==1"/>Si
                                                    </label>
                                                </td>
                                            </tr>
                                            </table>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-4 cuadrogestacion">
                                            <table cellpadding="5" style="width: 100%;">
                                                <tr>  
                                                    <td style="width: 50%;">
                                                        
                                                         <table  :class="form.errors.natirubeola?'errorinput':''" style="width: 100%;" >
                                                            <tr><td colspan="2"><div class="form-group local-forms">
                                                            <label style="text-align: center;    width: 100%;">Antirubeola<span class="login-danger">*</span></label>  
                                                         </div></td></tr>
                                                            <tr> 
                                                                <td><label class="form-check-label"  >
                                                                    <TextInput class="form-check-input mt-0 m-1" name="natirubeola" value="0" type="radio" v-model="form.natirubeola" :checked="form.natirubeola==0"/>Previa
                                                                    <TextInput class="form-check-input mt-0 m-1" name="natirubeola" value="1" type="radio" v-model="form.natirubeola" :checked="form.natirubeola==1"/>No sabe
                                                                    </label>
                                                                </td>   
                                                            </tr>
                                                            <tr> 
                                                                <td><label class="form-check-label" >
                                                                    <TextInput class="form-check-input mt-0 m-1" name="natirubeola" value="2" type="radio" v-model="form.natirubeola" :checked="form.natirubeola==2"/>Embarazo
                                                                    <TextInput class="form-check-input mt-0 m-1" name="natirubeola" value="3" type="radio" v-model="form.natirubeola" :checked="form.natirubeola==3"/>No
                                                                    </label>
                                                                </td>
                                                            </tr>
                                                         </table>
                                                    </td>
                                                    <td style="width: 50%;">
                                                        <table   style="width: 100%;font-size: smaller;" >
                                                            <tr><td colspan="2"><div class="form-group local-forms" >
                                                            <label style="text-align: center;    width: 100%;">Antitetanita<span class="login-danger">*</span></label>  
                                                         </div></td></tr>
                                                            <tr  :class="form.errors.antitetanicavigente?'errorinput':''" > <td style="text-align: end;">Vigente</td>
                                                                <td><label class="form-check-label"  >
                                                                    <TextInput class="form-check-input mt-0 m-1" name="antitetanicavigente" value="0" type="radio" v-model="form.antitetanicavigente" :checked="form.antitetanicavigente==0"/>No
                                                                    <TextInput class="form-check-input mt-0 m-1" name="antitetanicavigente" value="1" type="radio" v-model="form.antitetanicavigente" :checked="form.antitetanicavigente==1"/>Si
                                                                    </label>
                                                                </td>   
                                                            </tr>
                                                            <tr > <td style="text-align: end;">Dosis</td>
                                                                <td><label class="form-check-label" >
                                                                    <input class="form-check-input mt-0 m-1" :class="form.errors.dosis1?'errorinput':''" name="dosis1"  type="checkbox" v-model="dosis1" />1ra
                                                                    <input class="form-check-input mt-0 m-1" :class="form.errors.dosis2?'errorinput':''" name="dosis2"  type="checkbox" v-model="dosis2" />2da
                                                                    </label>
                                                                </td>
                                                            </tr>
                                                         </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-2 cuadrogestacion">
                                            <table style="width: 100%;font-size: smaller;" >
                                                            <tr><td colspan="2"><div class="form-group local-forms" >
                                                            <label style="text-align: center;    width: 100%;">Ex. Normal<span class="login-danger">*</span></label>  
                                                         </div></td></tr>
                                                            <tr :class="form.errors.odont?'errorinput':''" >
                                                                <td>Odont.</td>
                                                                <td><label class="form-check-label" style="text-align: start;">
                                                                    <TextInput class="form-check-input mt-0 m-1" name="odont" value="0" type="radio" v-model="form.odont" :checked="form.odont==0"/>No
                                                                    <TextInput class="form-check-input mt-0 m-1" name="odont" value="1" type="radio" v-model="form.odont" :checked="form.odont==1"/>Si 
                                                                    </label>
                                                                </td>   
                                                            </tr>
                                                            <tr :class="form.errors.mamas?'errorinput':''" >
                                                                <td>Mamas</td>
                                                                <td><label class="form-check-label" style="text-align: start;">
                                                                    <TextInput class="form-check-input mt-0 m-1" name="mamas" value="0" type="radio" v-model="form.mamas" :checked="form.mamas==0"/>No
                                                                    <TextInput class="form-check-input mt-0 m-1" name="mamas" value="1" type="radio" v-model="form.mamas" :checked="form.mamas==1"/>Si
                                                                    </label>
                                                                </td>
                                                            </tr>
                                             </table>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-3 cuadrogestacion">
                                            <table style="width: 100%;font-size: smaller;" >
                                                            <tr><td colspan="2"><div class="form-group local-forms" >
                                                            <label style="text-align: center;    width: 100%;">Cervix<span class="login-danger">*</span></label>  
                                                         </div></td></tr>
                                                            <tr :class="form.errors.pap?'errorinput':''" >
                                                                <td>PAP</td>
                                                                <td><label class="form-check-label" style="    font-size: smaller;">
                                                                    <TextInput class="form-check-input mt-0 m-1" name="pap" value="0" type="radio" v-model="form.pap" :checked="form.pap==0"/>Normal
                                                                    <TextInput class="form-check-input mt-0 m-1" name="pap" value="1" type="radio" v-model="form.pap" :checked="form.pap==1"/>Anormal 
                                                                    <TextInput class="form-check-input mt-0 m-1" name="pap" value="2" type="radio" v-model="form.pap" :checked="form.pap==2"/>No hizo 
                                                                    </label>
                                                                </td>   
                                                            </tr>
                                                            <tr :class="form.errors.colp?'errorinput':''" >
                                                                <td>COLP</td>
                                                                <td><label class="form-check-label" style="    font-size: smaller;">
                                                                    <TextInput class="form-check-input mt-0 m-1" name="colp" value="0" type="radio" v-model="form.colp" :checked="form.colp==0"/>Normal
                                                                    <TextInput class="form-check-input mt-0 m-1" name="colp" value="1" type="radio" v-model="form.colp" :checked="form.colp==1"/>Anormal 
                                                                    <TextInput class="form-check-input mt-0 m-1" name="colp" value="2" type="radio" v-model="form.colp" :checked="form.colp==2"/>No hizo 
                                                                    </label>
                                                                </td>
                                                            </tr>
                                             </table>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-3 cuadrogestacion">
                                            <table style="width: 100%;font-size: smaller;" >
                                                            <tr>
                                                                <td>Grupo</td><td>Rh</td><td>Inmuniz.</td>
                                                            </tr>
                                                            <tr>
                                                                <td><input  style="width: 45px; text-transform: lowercase; text-align: center;margin: auto;" class="form-control" type="text" maxlength="1" autocapitalize="none" v-model="form.grupo" :class="form.errors.grupo?'errorinput':''"/></td>
                                                                <td><label class="form-check-label" style="    font-size: smaller;">
                                                                    <TextInput class="form-check-input mt-0 m-1" name="rh" value="0" type="radio" v-model="form.rh" :checked="form.rh==0"/>-
                                                                    <TextInput class="form-check-input mt-0 m-1" name="rh" value="1" type="radio" v-model="form.rh" :checked="form.rh==1"/>+  
                                                                    </label>
                                                                </td>   
                                                                <td><label class="form-check-label" style="    font-size: smaller;">
                                                                    <TextInput class="form-check-input mt-0 m-1" name="inmuniz" value="0" type="radio" v-model="form.inmuniz" :checked="form.inmuniz==0"/>No
                                                                    <TextInput class="form-check-input mt-0 m-1" name="inmuniz" value="1" type="radio" v-model="form.inmuniz" :checked="form.inmuniz==1"/>Si 
                                                                    </label>
                                                                </td>   
                                                            </tr>
                                                            <tr>
                                                                <td colspan="3">Gamma Globulina Anti D</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="3">
                                                                    <label class="form-check-label" >
                                                                    <TextInput class="form-check-input mt-0 m-1" name="antid" value="0" type="radio" v-model="form.antid" :checked="form.antid==0"/>No 
                                                                    <TextInput class="form-check-input mt-0 m-1" name="antid" value="1" type="radio" v-model="form.antid" :checked="form.antid==1"/>Si  
                                                                    <TextInput class="form-check-input mt-0 m-1" name="antid" value="2" type="radio" v-model="form.antid" :checked="form.antid==2"/>N/C 
                                                                    </label>
                                                                </td>  
                                                            </tr>
                                                            
                                             </table>
                                        </div>


                                        <div class="col-12 col-md-6 col-xl-3 cuadrogestacion">
                                            <table cellpadding="5" style="width: 100%;">
                                                <tr>
                                                    <td colspan="2">
                                                        <div class="form-group local-forms"  style="margin-bottom: 6px;">
                                                            <label style="text-align: center;    width: 100%;">Glicemia en ayunas<span class="login-danger">*</span></label>  
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr> 
                                                    <td>
                                                            <div class="form-group local-forms" style="margin-bottom: 2px;">
                                                            <label>{{"<20 sem"}}</label> 
                                                            <TextInput min="0" class="form-control" type="number" v-model="form.glicemia20" :class="form.errors.glicemia20?'errorinput':''"></TextInput>
                                                            </div>
                                                    </td>
                                                    <td>
                                                        <label class="form-check-label" >
                                                            <input class="form-check-input mt-0 m-1" :class="form.errors.glicemia20105?'errorinput':''" name="gli1"  type="checkbox" v-model="gli1" />{{">=105 mg/dl"}}
                                                         </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                            <div class="form-group local-forms" style="margin-bottom: 2px;">
                                                            <label>{{">=30 sem"}}</label> 
                                                            <TextInput min="0" class="form-control" type="number" v-model="form.glicemia30" :class="form.errors.glicemia30?'errorinput':''"></TextInput>
                                                            </div>
                                                    </td>
                                                    <td>
                                                        <label class="form-check-label" >
                                                            <input class="form-check-input mt-0 m-1" :class="form.errors.glicemia30105?'errorinput':''" name="gli2"  type="checkbox" v-model="gli2" />{{">=105 mg/dl"}}
                                                         </label>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-2 cuadrogestacion">
                                            <table cellpadding="5" style="width: 100%;">
                                                <tr>
                                                        <td colspan="2">
                                                            <div class="form-group local-forms" >
                                                                <label style="text-align: center;    width: 100%;">{{ "Hb <20 sem" }}<span class="login-danger">*</span></label>  
                                                            </div>
                                                        </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="form-group local-forms" style="margin-bottom: 14px;"> 
                                                            <TextInput min="0" class="form-control" type="number" v-model="form.hbmenor" :class="form.errors.hbmenor?'errorinput':''"></TextInput>
                                                        </div>
                                                        <label class="form-check-label" >
                                                          Anemia  <input class="form-check-input mt-0 m-1" :class="form.errors.anemiamenor?'errorinput':''" name="anemiamenor"  type="checkbox" v-model="anemiamenor" /> Si
                                                         </label>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-2 cuadrogestacion">
                                            <table style="width: 100%;font-size: smaller;" >
                                                            <tr><td colspan="2"><div class="form-group local-forms" >
                                                            <label style="text-align: center;    width: 100%;">Suplementos<span class="login-danger">*</span></label>  
                                                         </div></td></tr>
                                                            <tr :class="form.errors.hierro?'errorinput':''" >
                                                                <td>Hierro</td>
                                                                <td><label class="form-check-label" style="text-align: start;">
                                                                    <TextInput class="form-check-input mt-0 m-1" name="hierro" value="0" type="radio" v-model="form.hierro" :checked="form.hierro==0"/>No
                                                                    <TextInput class="form-check-input mt-0 m-1" name="hierro" value="1" type="radio" v-model="form.hierro" :checked="form.hierro==1"/>Si 
                                                                    </label>
                                                                </td>   
                                                            </tr>
                                                            <tr :class="form.errors.folatos?'errorinput':''" >
                                                                <td>Folatos</td>
                                                                <td><label class="form-check-label" style="text-align: start;">
                                                                    <TextInput class="form-check-input mt-0 m-1" name="folatos" value="0" type="radio" v-model="form.folatos" :checked="form.folatos==0"/>No
                                                                    <TextInput class="form-check-input mt-0 m-1" name="folatos" value="1" type="radio" v-model="form.folatos" :checked="form.folatos==1"/>Si
                                                                    </label>
                                                                </td>
                                                            </tr>
                                             </table>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-2 cuadrogestacion">
                                            <table cellpadding="5" style="width: 100%;">
                                                <tr>
                                                        <td colspan="2">
                                                            <div class="form-group local-forms" >
                                                                <label style="text-align: center;    width: 100%;">{{ "Hb >=20 sem" }}<span class="login-danger">*</span></label>  
                                                            </div>
                                                        </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="form-group local-forms" style="margin-bottom: 14px;"> 
                                                            <TextInput min="0" class="form-control" type="number" v-model="form.hbmayor" :class="form.errors.hbmayor?'errorinput':''"></TextInput>
                                                        </div>
                                                        <label class="form-check-label" >
                                                          Anemia  <input class="form-check-input mt-0 m-1" :class="form.errors.anemiamayor?'errorinput':''" name="anemiamayor"  type="checkbox" v-model="anemiamayor" /> Si
                                                         </label>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-3 cuadrogestacion d-flex align-items-center">
                                            <table cellpadding="5" style="width: 100%;font-size: smaller;">
                                                <tr>
                                                    <td>Planeado mi parto</td>
                                                    <td>
                                                        <label class="form-check-label" style="text-align: start;">
                                                            <TextInput class="form-check-input mt-0 m-1" name="planeadoparto" value="0" type="radio" v-model="form.planeadoparto" :checked="form.planeadoparto==0"/>No
                                                            <TextInput class="form-check-input mt-0 m-1" name="planeadoparto" value="1" type="radio" v-model="form.planeadoparto" :checked="form.planeadoparto==1"/>Si
                                                        </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Orientación</td>
                                                    <td>
                                                        <label class="form-check-label" style="text-align: start;">
                                                            <TextInput class="form-check-input mt-0 m-1" name="orientacion" value="0" type="radio" v-model="form.orientacion" :checked="form.orientacion==0"/>No
                                                            <TextInput class="form-check-input mt-0 m-1" name="orientacion" value="1" type="radio" v-model="form.orientacion" :checked="form.orientacion==1"/>Si
                                                        </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Detec. proteinas orina</td>
                                                    <td>
                                                        <label class="form-check-label" style="text-align: start;">
                                                            <TextInput class="form-check-input mt-0 m-1" name="orina" value="0" type="radio" v-model="form.orina" :checked="form.orina==0"/>No
                                                            <TextInput class="form-check-input mt-0 m-1" name="orina" value="1" type="radio" v-model="form.orina" :checked="form.orina==1"/>Si
                                                        </label>
                                                    </td>
                                                </tr>
                                            </table>   
                                        </div>

                                        <div class="col-12 col-md-6 col-xl-6 cuadrogestacion d-flex align-items-center">
                                            <table cellpadding="5" style="width: 100%;font-size: smaller;">
                                            <tr>
                                                <th>VIH<span class="login-danger">*</span></th> <th>Diag.<span class="login-danger">*</span></th> <th>Trat.<span class="login-danger">*</span></th>
                                            </tr>
                                            <tr>
                                                <td> {{ ">20 sem. Solicitada" }}  </td> <td>   Prueba Result. </td> <td>  TARV. en emb. </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label class="form-check-label" style="text-align: start;">
                                                        <TextInput class="form-check-input mt-0 m-1" name="vihsolmenor" value="0" type="radio" v-model="form.vihsolmenor" :checked="form.vihsolmenor==0"/>No
                                                        <TextInput class="form-check-input mt-0 m-1" name="vihsolmenor" value="1" type="radio" v-model="form.vihsolmenor" :checked="form.vihsolmenor==1"/>Si
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="form-check-label" style="text-align: start;">
                                                        <TextInput class="form-check-input mt-0 m-1" name="vihpruebamenor" value="0" type="radio" v-model="form.vihpruebamenor" :checked="form.vihpruebamenor==0"/>  - 
                                                        <TextInput class="form-check-input mt-0 m-1" name="vihpruebamenor" value="1" type="radio" v-model="form.vihpruebamenor" :checked="form.vihpruebamenor==1"/>  + 
                                                  
                                                        <TextInput class="form-check-input mt-0 m-1" name="vihpruebamenor" value="2" type="radio" v-model="form.vihpruebamenor" :checked="form.vihpruebamenor==2"/>n/c
                                                        <TextInput class="form-check-input mt-0 m-1" name="vihpruebamenor" value="3" type="radio" v-model="form.vihpruebamenor" :checked="form.vihpruebamenor==3"/>s/d
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="form-check-label" style="text-align: start;">
                                                        <TextInput class="form-check-input mt-0 m-1" name="vihtratmenor" value="0" type="radio" v-model="form.vihtratmenor" :checked="form.vihtratmenor==0"/>No
                                                        <TextInput class="form-check-input mt-0 m-1" name="vihtratmenor" value="1" type="radio" v-model="form.vihtratmenor" :checked="form.vihtratmenor==1"/>Si
                                                        <TextInput class="form-check-input mt-0 m-1" name="vihtratmenor" value="2" type="radio" v-model="form.vihtratmenor" :checked="form.vihtratmenor==2"/>n/c
                                                    </label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> {{ ">=20 sem. Solicitada" }}  </td> <td>   Prueba Result. </td> <td>  TARV. en emb. </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label class="form-check-label" style="text-align: start;">
                                                        <TextInput class="form-check-input mt-0 m-1" name="vihsolmayor" value="0" type="radio" v-model="form.vihsolmayor" :checked="form.vihsolmayor==0"/>No
                                                        <TextInput class="form-check-input mt-0 m-1" name="vihsolmayor" value="1" type="radio" v-model="form.vihsolmayor" :checked="form.vihsolmayor==1"/>Si
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="form-check-label" style="text-align: start;">
                                                        <TextInput class="form-check-input mt-0 m-1" name="vihpruebamayor" value="0" type="radio" v-model="form.vihpruebamayor" :checked="form.vihpruebamayor==0"/>  - 
                                                        <TextInput class="form-check-input mt-0 m-1" name="vihpruebamayor" value="1" type="radio" v-model="form.vihpruebamayor" :checked="form.vihpruebamayor==1"/>  + 
                                                 
                                                        <TextInput class="form-check-input mt-0 m-1" name="vihpruebamayor" value="2" type="radio" v-model="form.vihpruebamayor" :checked="form.vihpruebamayor==2"/>n/c
                                                        <TextInput class="form-check-input mt-0 m-1" name="vihpruebamayor" value="3" type="radio" v-model="form.vihpruebamayor" :checked="form.vihpruebamayor==3"/>s/d
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="form-check-label" style="text-align: start;">
                                                        <TextInput class="form-check-input mt-0 m-1" name="vihtratmayor" value="0" type="radio" v-model="form.vihtratmayor" :checked="form.vihtratmayor==0"/>No
                                                        <TextInput class="form-check-input mt-0 m-1" name="vihtratmayor" value="1" type="radio" v-model="form.vihtratmayor" :checked="form.vihtratmayor==1"/>Si
                                                        <TextInput class="form-check-input mt-0 m-1" name="vihtratmayor" value="2" type="radio" v-model="form.vihtratmayor" :checked="form.vihtratmayor==2"/>n/c
                                                    </label>
                                                </td>
                                            </tr>
                                            </table>   
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-6 cuadrogestacion d-flex align-items-center">
                                            <table cellpadding="5" style="width: 100%;font-size: smaller;">
                                                <tr>
                                                <th colspan="3">Sifilis: Diagnostico y tratamiento<span class="login-danger">*</span></th>  
                                                </tr>
                                                <tr>
                                                    <td> RPR/VDRL </td> <td>Tratamiento</td> <td>Tto. de pareja</td>
                                                </tr>
                                                <tr>
                                                    <td  >
                                                        <label class="form-check-label" style="margin-bottom: 14px;"   > 
                                                        <TextInput class="form-check-input mt-0 m-1" name="sifilismenorrpr" value="0" type="radio" v-model="form.sifilismenorrpr" :checked="form.sifilismenorrpr==0"/>-
                                                        <TextInput class="form-check-input mt-0 m-1" name="sifilismenorrpr" value="1" type="radio" v-model="form.sifilismenorrpr" :checked="form.sifilismenorrpr==1"/>+
                                                        <TextInput class="form-check-input mt-0 m-1" name="sifilismenorrpr" value="2" type="radio" v-model="form.sifilismenorrpr" :checked="form.sifilismenorrpr==2"/>s/d
                                                    </label>
                                                    <div class="form-group local-forms" style="margin-bottom: 0px;">
                                                            <label>{{ "<20 sem" }}</label> 
                                                            <TextInput min="0" class="form-control" type="number" v-model="form.sifilismenor20" :class="form.errors.sifilismenor20?'errorinput':''"></TextInput>
                                                    </div>
                                                    </td>
                                                    <td >
                                                     <label class="form-check-label" style=" margin-bottom: 14px;"   >  
                                                        <TextInput class="form-check-input mt-0 m-1" name="sifilismenortrat" value="0" type="radio" v-model="form.sifilismenortrat" :checked="form.sifilismenortrat==0"/>No
                                                        <TextInput class="form-check-input mt-0 m-1" name="sifilismenortrat" value="1" type="radio" v-model="form.sifilismenortrat" :checked="form.sifilismenortrat==1"/>Si
                                                       <TextInput class="form-check-input mt-0 m-1" name="sifilismenortrat" value="2" type="radio" v-model="form.sifilismenortrat" :checked="form.sifilismenortrat==2"/>s/d
                                                        <TextInput class="form-check-input mt-0 m-1" name="sifilismenortrat" value="3" type="radio" v-model="form.sifilismenortrat" :checked="form.sifilismenortrat==3"/>n/c
                                                    </label>
                                                    <div class="form-group local-forms" style="margin-bottom: 0px;">
                                                            <label>{{ "sem" }}</label> 
                                                            <TextInput min="0" class="form-control" type="number" v-model="form.sifilismenor" :class="form.errors.sifilismenor?'errorinput':''"></TextInput>
                                                    </div>
                                                    </td>
                                                    <td>
                                                        <label class="form-check-label"    >
                                                        <TextInput class="form-check-input mt-0 m-1" name="sifilismenortratpareja" value="0" type="radio" v-model="form.sifilismenortratpareja" :checked="form.sifilismenortratpareja==0"/>No
                                                        <TextInput class="form-check-input mt-0 m-1" name="sifilismenortratpareja" value="1" type="radio" v-model="form.sifilismenortratpareja" :checked="form.sifilismenortratpareja==1"/>Si
                                                    </label>
                                                   <label class="form-check-label" style=" margin-bottom: 14px;"   >  
                                                        <TextInput class="form-check-input mt-0 m-1" name="sifilismenortratpareja" value="2" type="radio" v-model="form.sifilismenortratpareja" :checked="form.sifilismenortratpareja==2"/>s/d
                                                        <TextInput class="form-check-input mt-0 m-1" name="sifilismenortratpareja" value="3" type="radio" v-model="form.sifilismenortratpareja" :checked="form.sifilismenortratpareja==3"/>n/c
                                                    </label>
                                                    </td>
                                                </tr>

                                                <!-- ------------------------- -->
                                                <tr>
                                                    <td  >
                                                    <div class="form-group local-forms" style="margin-bottom: 10px;">
                                                            <label>{{ ">=20 sem" }}</label> 
                                                            <TextInput min="0" class="form-control" type="number" v-model="form.sifilismayor20" :class="form.errors.sifilismayor20?'errorinput':''"></TextInput>
                                                    </div>
                                                        <label class="form-check-label" style="margin-bottom: 14px;"   > 
                                                        <TextInput class="form-check-input mt-0 m-1" name="sifilismayorrpr" value="0" type="radio" v-model="form.sifilismayorrpr" :checked="form.sifilismayorrpr==0"/>-
                                                        <TextInput class="form-check-input mt-0 m-1" name="sifilismayorrpr" value="1" type="radio" v-model="form.sifilismayorrpr" :checked="form.sifilismayorrpr==1"/>+
                                                        <TextInput class="form-check-input mt-0 m-1" name="sifilismayorrpr" value="2" type="radio" v-model="form.sifilismayorrpr" :checked="form.sifilismayorrpr==2"/>s/d
                                                    </label>
                                                    
                                                    </td>
                                                    <td >
                                                    <div class="form-group local-forms" style="margin-bottom: 10px;">
                                                            <label>{{ "sem" }}</label> 
                                                            <TextInput min="0" class="form-control" type="number" v-model="form.sifilismayor" :class="form.errors.sifilismayor?'errorinput':''"></TextInput>
                                                    </div>
                                                     <label class="form-check-label" style=" margin-bottom: 14px;"   >  
                                                        <TextInput class="form-check-input mt-0 m-1" name="sifilismayortrat" value="0" type="radio" v-model="form.sifilismayortrat" :checked="form.sifilismayortrat==0"/>No
                                                        <TextInput class="form-check-input mt-0 m-1" name="sifilismayortrat" value="1" type="radio" v-model="form.sifilismayortrat" :checked="form.sifilismayortrat==1"/>Si
                                                       <TextInput class="form-check-input mt-0 m-1" name="sifilismayortrat" value="2" type="radio" v-model="form.sifilismayortrat" :checked="form.sifilismayortrat==2"/>s/d
                                                        <TextInput class="form-check-input mt-0 m-1" name="sifilismayortrat" value="3" type="radio" v-model="form.sifilismayortrat" :checked="form.sifilismayortrat==3"/>n/c
                                                    </label>
                                                    
                                                    </td>
                                                    <td>
                                                        <label class="form-check-label"    >
                                                        <TextInput class="form-check-input mt-0 m-1" name="sifilismayortratpareja" value="0" type="radio" v-model="form.sifilismayortratpareja" :checked="form.sifilismayortratpareja==0"/>No
                                                        <TextInput class="form-check-input mt-0 m-1" name="sifilismayortratpareja" value="1" type="radio" v-model="form.sifilismayortratpareja" :checked="form.sifilismayortratpareja==1"/>Si
                                                    </label>
                                                   <label class="form-check-label" style=" margin-bottom: 14px;"   >  
                                                        <TextInput class="form-check-input mt-0 m-1" name="sifilismayortratpareja" value="2" type="radio" v-model="form.sifilismayortratpareja" :checked="form.sifilismayortratpareja==2"/>s/d
                                                        <TextInput class="form-check-input mt-0 m-1" name="sifilismayortratpareja" value="3" type="radio" v-model="form.sifilismayortratpareja" :checked="form.sifilismayortratpareja==3"/>n/c
                                                    </label>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-3 cuadrogestacion d-flex align-items-center">
                                            <table style="width: 100%;font-size: smaller;" >
                                                            <tr><td colspan="2"><div class="form-group local-forms" >
                                                            <label style="text-align: center;    width: 100%;">Bacteriuria<span class="login-danger">*</span></label>  
                                                         </div></td></tr>
                                                            <tr :class="form.errors.bacteriuriamenor?'errorinput':''" >
                                                                <td>{{"< 20"}}</td>
                                                                <td><label class="form-check-label" style="    font-size: smaller;">
                                                                    <TextInput class="form-check-input mt-0 m-1" name="bacteriuriamenor" value="0" type="radio" v-model="form.bacteriuriamenor" :checked="form.bacteriuriamenor==0"/>Normal
                                                                    <TextInput class="form-check-input mt-0 m-1" name="bacteriuriamenor" value="1" type="radio" v-model="form.bacteriuriamenor" :checked="form.bacteriuriamenor==1"/>Anormal 
                                                                    <TextInput class="form-check-input mt-0 m-1" name="bacteriuriamenor" value="2" type="radio" v-model="form.bacteriuriamenor" :checked="form.bacteriuriamenor==2"/>No hizo 
                                                                    </label>
                                                                </td>   
                                                            </tr>
                                                            <tr :class="form.errors.bacteriuriamayor?'errorinput':''" >
                                                                <td>{{">=20"}}</td>
                                                                <td><label class="form-check-label" style="    font-size: smaller;">
                                                                    <TextInput class="form-check-input mt-0 m-1" name="bacteriuriamayor" value="0" type="radio" v-model="form.bacteriuriamayor" :checked="form.bacteriuriamayor==0"/>Normal
                                                                    <TextInput class="form-check-input mt-0 m-1" name="bacteriuriamayor" value="1" type="radio" v-model="form.bacteriuriamayor" :checked="form.bacteriuriamayor==1"/>Anormal 
                                                                    <TextInput class="form-check-input mt-0 m-1" name="bacteriuriamayor" value="2" type="radio" v-model="form.bacteriuriamayor" :checked="form.bacteriuriamayor==2"/>No hizo 
                                                                    </label>
                                                                </td>
                                                            </tr>
                                             </table>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-2 cuadrogestacion d-flex align-items-center">
                                            <table style="width: 100%;font-size: smaller;" >
                                                            <tr><td colspan="2"><div class="form-group local-forms" >
                                                            <label style="text-align: center;    width: 100%;">Chagas<span class="login-danger">*</span></label>  
                                                               </div></td></tr>
                                                            <tr :class="form.errors.chagas?'errorinput':''" > 
                                                                <td><label class="form-check-label" style="    font-size: smaller;">
                                                                    <TextInput class="form-check-input mt-0 m-1" name="chagas" value="0" type="radio" v-model="form.chagas" :checked="form.chagas==0"/>-
                                                                    <TextInput class="form-check-input mt-0 m-1" name="chagas" value="1" type="radio" v-model="form.chagas" :checked="form.chagas==1"/>+ 
                                                                    <TextInput class="form-check-input mt-0 m-1" name="chagas" value="2" type="radio" v-model="form.chagas" :checked="form.chagas==2"/>No hizo 
                                                                    </label>
                                                                </td>   
                                                            </tr> 
                                             </table>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-2 cuadrogestacion d-flex align-items-center">
                                            <table style="width: 100%;font-size: smaller;" >
                                                            <tr><td colspan="2"><div class="form-group local-forms" >
                                                            <label style="text-align: center;    width: 100%;">Paludismo/Malaria<span class="login-danger">*</span></label>  
                                                               </div></td></tr>
                                                            <tr :class="form.errors.paludismo?'errorinput':''" > 
                                                                <td><label class="form-check-label" style="    font-size: smaller;">
                                                                    <TextInput class="form-check-input mt-0 m-1" name="paludismo" value="0" type="radio" v-model="form.paludismo" :checked="form.paludismo==0"/>-
                                                                    <TextInput class="form-check-input mt-0 m-1" name="paludismo" value="1" type="radio" v-model="form.paludismo" :checked="form.paludismo==1"/>+ 
                                                                    <TextInput class="form-check-input mt-0 m-1" name="paludismo" value="2" type="radio" v-model="form.paludismo" :checked="form.paludismo==2"/>No hizo 
                                                                    </label>
                                                                </td>   
                                                            </tr> 
                                             </table>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-2 cuadrogestacion d-flex align-items-center">
                                            <table style="width: 100%;font-size: smaller;" >
                                                            <tr><td colspan="2"><div class="form-group local-forms" >
                                                            <label style="text-align: center;    width: 100%;">Estreptococo B<span class="login-danger">*</span></label>  
                                                               </div></td></tr>
                                                            <tr><td>35 - 37 semanas</td></tr>
                                                            <tr :class="form.errors.estreptococo?'errorinput':''" > 
                                                                <td><label class="form-check-label" style="    font-size: smaller;">
                                                                    <TextInput class="form-check-input mt-0 m-1" name="estreptococo" value="0" type="radio" v-model="form.estreptococo" :checked="form.estreptococo==0"/>-
                                                                    <TextInput class="form-check-input mt-0 m-1" name="estreptococo" value="1" type="radio" v-model="form.estreptococo" :checked="form.estreptococo==1"/>+ 
                                                                    <TextInput class="form-check-input mt-0 m-1" name="estreptococo" value="2" type="radio" v-model="form.estreptococo" :checked="form.estreptococo==2"/>No hizo 
                                                                    </label>
                                                                </td>   
                                                            </tr> 
                                             </table>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-3 cuadrogestacion d-flex align-items-center">
                                            <table style="width: 100%;font-size: smaller;" > 
                                                            <tr><td colspan="2"><div class="form-group local-forms" >
                                                            <label style="text-align: center;    width: 100%;">Toxoplasmosis<span class="login-danger">*</span></label>  
                                                         </div></td></tr>
                                                            <tr :class="form.errors.toxoplasmosismenor?'errorinput':''">
                                                                <td>{{ "< 20" }}</td>
                                                                <td><label class="form-check-label" style="text-align: start;">
                                                                    <TextInput class="form-check-input mt-0 m-1" name="toxoplasmosismenor" value="0" type="radio" v-model="form.toxoplasmosismenor" :checked="form.toxoplasmosismenor==0"/>-
                                                                    <TextInput class="form-check-input mt-0 m-1" name="toxoplasmosismenor" value="1" type="radio" v-model="form.toxoplasmosismenor" :checked="form.toxoplasmosismenor==1"/>+ 
                                                                    <TextInput class="form-check-input mt-0 m-1" name="toxoplasmosismenor" value="2" type="radio" v-model="form.toxoplasmosismenor" :checked="form.toxoplasmosismenor==2"/>No se hizo 
                                                                    </label>
                                                                </td>   
                                                            </tr>
                                                            <tr :class="form.errors.toxoplasmosismayor?'errorinput':''">
                                                                <td>{{ ">=20" }}</td>
                                                                <td><label class="form-check-label" style="text-align: start;">
                                                                    <TextInput class="form-check-input mt-0 m-1" name="toxoplasmosismayor" value="0" type="radio" v-model="form.toxoplasmosismayor" :checked="form.toxoplasmosismayor==0"/>-
                                                                    <TextInput class="form-check-input mt-0 m-1" name="toxoplasmosismayor" value="1" type="radio" v-model="form.toxoplasmosismayor" :checked="form.toxoplasmosismayor==1"/>+ 
                                                                    <TextInput class="form-check-input mt-0 m-1" name="toxoplasmosismayor" value="2" type="radio" v-model="form.toxoplasmosismayor" :checked="form.toxoplasmosismayor==2"/>No se hizo 
                                                                    </label>
                                                                </td>
                                                            </tr>
                                                            <tr :class="form.errors.toxoplasmosisconsulta?'errorinput':''">
                                                                <td>1ra consul.</td>
                                                                <td><label class="form-check-label" style="text-align: start;">
                                                                    <TextInput class="form-check-input mt-0 m-1" name="toxoplasmosisconsulta" value="0" type="radio" v-model="form.toxoplasmosisconsulta" :checked="form.toxoplasmosisconsulta==0"/>-
                                                                    <TextInput class="form-check-input mt-0 m-1" name="toxoplasmosisconsulta" value="1" type="radio" v-model="form.toxoplasmosisconsulta" :checked="form.toxoplasmosisconsulta==1"/>+ 
                                                                    <TextInput class="form-check-input mt-0 m-1" name="toxoplasmosisconsulta" value="2" type="radio" v-model="form.toxoplasmosisconsulta" :checked="form.toxoplasmosisconsulta==2"/>No se hizo 
                                                                    </label>
                                                                </td>
                                                            </tr>
                                          </table>
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
