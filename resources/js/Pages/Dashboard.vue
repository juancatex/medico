<script setup> 
import { Head } from '@inertiajs/vue3';  
import Menus from '@/Layouts/Menus.vue';
import {getCurrentInstance} from 'vue'

const componentName = getCurrentInstance()?.type.__name
</script>

<template>
    <Head title="Dashboard" /> 
    <Menus :menuname="componentName"> 
    <div class="content">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard </a></li>
                        <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                        <li class="breadcrumb-item active">Admin Dashboard</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="good-morning-blk">
            <div class="row">
                <div class="col-md-6">
                    <div class="morning-user">
                        <h2>Good Morning, <span>Daniel Bruk</span></h2>
                        <p>Have a nice day at work</p>
                    </div>
                </div>
                <div class="col-md-6 position-blk">
                    <div class="morning-img">
                        <img src="assets/img/morning-img-01.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    </Menus>
     
</template>
