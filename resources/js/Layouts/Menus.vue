<script setup> 
import { Link } from '@inertiajs/vue3';
import {onBeforeMount,ref} from 'vue'; 
const props =defineProps({ 
    menuname: {
        type: String,
    } ,
    users: {
        type: Object,
    },
});
const nombre=ref({});
function getdata(){ 
    axios.get("userin").then(function (response) {  
        nombre.value=response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
}

onBeforeMount(() => {
    getdata();
});
</script>

<template> 
    <div class="main-wrapper">
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
                            <span>Admin</span>
                        </div>
                        <span class="user-img">
                            <img src="assets/img/user-06.jpg" alt="Admin">
                        </span>
                    </a>
                    <div class="dropdown-menu"> 
                        <a class="dropdown-item" href="edit-profile.html">Perfil</a>
                        <a class="dropdown-item" href="settings.html">Configuraciones</a> 
                        <Link :href="route('logout')" method="post" as="button" class="dropdown-item" >Saliddr</Link> 
                    </div>
                </li> 
            </ul>
            <div class="dropdown mobile-user-menu float-end">
                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i
                        class="fa-solid fa-ellipsis-vertical"></i></a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="profile.html">My Profile</a>
                    <a class="dropdown-item" href="edit-profile.html">Edit Profile</a>
                    <a class="dropdown-item" href="settings.html">Settings</a>
                    <a class="dropdown-item" href="login.html">Logout</a>
                </div>
            </div>
        </div>
        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="menu-title">Menu</li>
                        
                        <li>
                            <a href="chat.html"><span class="menu-side"><img src="assets/img/icons/menu-icon-10.svg"
                                        alt=""></span> <span>Chat</span> <span class="menu-arrow"></span></a>
                        </li>  
                        <li>
                            <a href="chat.html"><span class="menu-side"><img src="assets/img/icons/menu-icon-10.svg"
                                        alt=""></span> <span>Chat</span> <span class="menu-arrow"></span></a>
                        </li>  
                        <li>
                            <a href="chat.html"><span class="menu-side"><img src="assets/img/icons/menu-icon-10.svg"
                                        alt=""></span> <span>Chat</span> <span class="menu-arrow"></span></a>
                        </li>  
                        <li>
                            <a href="chat.html"><span class="menu-side"><img src="assets/img/icons/menu-icon-10.svg"
                                        alt=""></span> <span>Chat</span> <span class="menu-arrow"></span></a>
                        </li>  
                        <li>
                            <a href="chat.html"><span class="menu-side"><img src="assets/img/icons/menu-icon-10.svg"
                                        alt=""></span> <span>Chat</span> <span class="menu-arrow"></span></a>
                        </li>  
                    </ul>
                    <div class="logout-btn">
                        <a href="login.html"><span class="menu-side"><img src="assets/img/icons/logout.svg"
                                    alt=""></span> <span>Salir del sistema</span></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-wrapper">
            <slot />
        </div>
    </div>
</template>
