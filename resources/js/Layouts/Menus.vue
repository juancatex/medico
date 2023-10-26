<script setup> 
import { Link } from '@inertiajs/vue3';
import {onBeforeMount,ref,onMounted} from 'vue'; 
const props =defineProps({ 
    menuname: {
        type: String,
    } 
});
const nombre=ref({});
const menus=ref({});
  
function getdata(){ 
    axios.get("userin").then(function (response) {  
        nombre.value=response.data.user; 
        menus.value=response.data.menus;   
                })
                .catch(function (error) {
                    console.log(error);
                });
}

function init() { 
    setTimeout(function(){ 
    var evento=$('#sidebar-menu ul li.submenu a.active').parents('li:last').addClass('bselect').children('a:first').addClass('active').attr('id');
    if (evento !== undefined) {
        clickevento(evento);
    } 
}, 800);
 
}
function clickevento(menu){  
           if (!$('#'+menu).hasClass('subdrop')) {
                $('ul', $('#'+menu).parents('ul:first')).slideUp(350);
                $('a', $('#'+menu).parents('ul:first')).removeClass('subdrop');
                $('#'+menu).next('ul').slideDown(350);
                $('#'+menu).addClass('subdrop');
            } else if ($('#'+menu).hasClass('subdrop')) {
                $('#'+menu).removeClass('subdrop');
                $('#'+menu).next('ul').slideUp(350);
            }
}
 
onMounted(async () => { 
    init();
})

onBeforeMount(() => {
    getdata();
});
</script>

<template> 
  
        <div class="header">
            <div class="header-left">
                <div class="logo">
                    <img src="assets/img/logo.png" width="35" height="35" alt=""> <span> Cristal II</span>
                </div>
            </div>
            <a id="toggle_btn" href="javascript:void(0);"><img src="assets/img/icons/bar-icon.svg" alt=""></a>
            <a id="mobile_btn" class="mobile_btn float-start" href="#sidebar"><img src="assets/img/icons/bar-icon.svg" alt=""></a> 
            <ul class="nav user-menu float-end"> 
                <li class="nav-item dropdown has-arrow user-profile-list">
                    <a href="#" class="dropdown-toggle nav-link user-link" data-bs-toggle="dropdown">
                        <div class="user-names">
                            <h5>{{ nombre.name}}</h5>
                            <span>{{ nombre.namerol}}</span>
                        </div>
                        <span class="user-img">
                            <img src="assets/img/user-06.jpg" alt="Admin">
                        </span>
                    </a>
                    <div class="dropdown-menu"> 
                        <!-- <a class="dropdown-item" href="edit-profile.html">Perfil</a>  -->
                        <Link :href="route('seguridad')" method="get" as="button" class="dropdown-item" >Seguridad</Link> 
                        <Link :href="route('logout')" method="post" as="button" class="dropdown-item" >Salir</Link> 
                    </div>
                </li> 
            </ul>
            <div class="dropdown mobile-user-menu float-end">
                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i
                        class="fa-solid fa-ellipsis-vertical"></i></a>
                <div class="dropdown-menu dropdown-menu-end"> 
                    <Link :href="route('seguridad')" method="get" as="button" class="dropdown-item" >Seguridad</Link> 
                    <Link :href="route('logout')" method="post" as="button" class="dropdown-item" >Salir</Link> 
                </div>
            </div>
        </div>
        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="menu-title">Menu</li>
                         

                        <li class="submenu" v-for="item in menus" :key="item.idmenu" >
                            <a href="#" @click.prevent="clickevento('menu'+item.idmenu)" :id="'menu'+item.idmenu" class="puntero"><i :class="item.logo"></i> <span> {{item.nommenu}} </span> <span
                                    class="menu-arrow"></span></a>
                            <ul style="display: none;">
                                <li v-for="vista in item.vistas" :key="'v'+vista.idv">
                                    <Link :href="route(vista.ruta)" :class="vista.nomvue==menuname?'active':''">{{ vista.nomvista }}</Link> </li> 
                            </ul>
                        </li>
  
                    </ul>
                    
                </div>
            </div>
        </div>
        <div class="page-wrapper">
            <slot />
        </div>
    
</template>
