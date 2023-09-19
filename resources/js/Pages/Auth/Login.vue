<script setup>
import Checkbox from '@/Components/Checkbox.vue'; 
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
     <Head title="Inicio" />
     <div class="main-wrapper login-body">
        <div class="container-fluid px-0">
            <div class="row">

                <div class="col-lg-6 login-wrap">
                    <div class="login-sec">
                        <div class="log-img">
                            <img class="img-fluid" src="assets/img/login-02.png" alt="Logo">
                        </div>
                    </div>
                </div>


                <div class="col-lg-6 login-wrap-bg">
                    <div class="login-wrapper">
                        <div class="loginbox">
                            <div class="login-right">
                                <div class="login-right-wrap">
                                     <div class="logo">
                                        <img src="assets/img/logo.png" width="45" height="45" alt=""> <span> Cristal II</span>
                                    </div>
                                    <br>
                                    <h2>Inicio</h2>

                                    <form @submit.prevent="submit">
                                        <div class="form-group">
                                            <label>Correo electronico <span class="login-danger">*</span></label>
                                           
                                            <TextInput
                                                id="email"
                                                type="email"
                                                class="form-control"
                                                v-model="form.email"
                                                required
                                                autofocus
                                                autocomplete="Correo electronico" /> 
                                             <h6 v-show="form.errors.email" class="text-danger p-1">
                                                    {{form.errors.email}}
                                             </h6> 
                                        </div>
                                        <div class="form-group">
                                            <label>Contraseña <span class="login-danger">*</span></label>
                                           
                                            <TextInput
                                                id="password"
                                                type="password"
                                                class="form-control pass-input"
                                                v-model="form.password"
                                                required
                                                autocomplete="Contraseña"
                                            />
 
                                            <h6 v-show="form.errors.password" class="text-danger p-1">
                                                    {{form.errors.password}}
                                             </h6> 
                                            <span class="profile-views feather-eye-off toggle-password"></span>
                                        </div>
                                        <div class="forgotpass">
                                            <div class="remember-me">
                                                <label class="custom_check mr-2 mb-0 d-inline-flex remember-me">
                                                    Recordarme 
                                                    <Checkbox name="remember" v-model:checked="form.remember" />
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                           
                                        </div>
                                        <div class="form-group login-btn"> 
                                            <PrimaryButton class="btn btn-primary btn-block" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                                Ingresar
                                            </PrimaryButton>
                                        </div>
                                    </form>
 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>
