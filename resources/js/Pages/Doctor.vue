<script setup> 
import { Head,Link } from '@inertiajs/vue3';  
import Menus from '@/Layouts/Menus.vue';
import {getCurrentInstance,onMounted} from 'vue'; 
const props =defineProps({ 
    lista: {
        type: Object,
    }  
});
const componentName = getCurrentInstance()?.type.__name

onMounted(() => { 
    if ($('[data-feather]').length > 0) {
        feather.replace();
    }
      console.log(componentName);
    });

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
                                                            <input type="text" class="form-control"
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
                                                <div  class="btn" data-bs-toggle="modal"
                                    data-bs-target="#invoices_preview">
                                                    <i data-feather="plus-circle"></i> Nuevo registro
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table border-0 custom-table comman-table datatable mb-0">
                                        <thead>
                                            <tr>
                                                 
                                                <th>Name</th>
                                                <th>Department</th>
                                                <th>Specialization</th>
                                                <th>Degree</th>
                                                <th>Mobile</th>
                                                <th>Email</th>
                                                <th>Joining Date</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                             
                                                <td class="profile-image"><a href="profile.html"><img width="28"
                                                            height="28" src="assets/img/profiles/avatar-01.jpg"
                                                            class="rounded-circle m-r-5" alt=""> Andrea Lalema</a></td>
                                                <td>Otolaryngology</td>
                                                <td>Infertility</td>
                                                <td>MBBS, MS</td>
                                                <td><a href="javascript:;">+1 23 456890</a></td>
                                                <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                                        data-cfemail="d1b4a9b0bca1bdb491b4bcb0b8bdffb2bebc">[email&#160;protected]</a>
                                                </td>
                                                <td>01.10.2022</td>
                                                <td class="text-end">
                                                    <a href="edit-invoices.html"
                                                        class="btn btn-sm btn-white text-success me-2"><i
                                                            class="far fa-edit me-1"></i> Edit</a>
                                                    <a class="btn btn-sm btn-white text-danger" href="#"
                                                        data-bs-toggle="modal" data-bs-target="#delete_paid"><i
                                                            class="far fa-trash-alt me-1"></i>Delete</a>
                                                </td>
                                            </tr>
                                             
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </div>
    <!-- -------------------modals---------------------- -->
    <div class="modal custom-modal modal-bg  fade invoices-preview" id="invoices_preview" role="dialog">
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
 
                                        <div class="row">
                                      
                                        <div class="col-12 col-md-6 col-xl-4">
                                            <div class="form-group local-forms">
                                                <label>First Name <span class="login-danger">*</span></label>
                                                <input class="form-control" type="text" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-4">
                                            <div class="form-group local-forms">
                                                <label>Last Name <span class="login-danger">*</span></label>
                                                <input class="form-control" type="text" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-4">
                                            <div class="form-group local-forms">
                                                <label>User Name <span class="login-danger">*</span></label>
                                                <input class="form-control" type="text" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-6">
                                            <div class="form-group local-forms">
                                                <label>Mobile <span class="login-danger">*</span></label>
                                                <input class="form-control" type="text" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-6">
                                            <div class="form-group local-forms">
                                                <label>Email <span class="login-danger">*</span></label>
                                                <input class="form-control" type="email" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-6">
                                            <div class="form-group local-forms">
                                                <label>Password <span class="login-danger">*</span></label>
                                                <input class="form-control" type="password" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-6">
                                            <div class="form-group local-forms">
                                                <label>Confirm Password <span class="login-danger">*</span></label>
                                                <input class="form-control" type="password" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-6">
                                            <div class="form-group local-forms cal-icon">
                                                <label>Date Of Birth <span class="login-danger">*</span></label>
                                                <input class="form-control datetimepicker" type="text" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-6">
                                            <div class="form-group select-gender">
                                                <label class="gen-label">Gender<span
                                                        class="login-danger">*</span></label>
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="radio" name="gender"
                                                            class="form-check-input mt-0">Male
                                                    </label>
                                                </div>
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="radio" name="gender"
                                                            class="form-check-input mt-0">Female
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-4">
                                            <div class="form-group local-forms">
                                                <label>Education <span class="login-danger">*</span></label>
                                                <input class="form-control" type="text" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-4">
                                            <div class="form-group local-forms">
                                                <label>Designation <span class="login-danger">*</span></label>
                                                <input class="form-control" type="text" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-4">
                                            <div class="form-group local-forms">
                                                <label>Department <span class="login-danger">*</span></label>
                                                <select class="form-control select">
                                                    <option>Select Department</option>
                                                    <option>Orthopedics</option>
                                                    <option>Radiology</option>
                                                    <option>Dentist</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12">
                                            <div class="form-group local-forms">
                                                <label>Address <span class="login-danger">*</span></label>
                                                <textarea class="form-control" rows="3" cols="30"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-3">
                                            <div class="form-group local-forms">
                                                <label>City <span class="login-danger">*</span></label>
                                                <select class="form-control select">
                                                    <option>Select City</option>
                                                    <option>Alaska</option>
                                                    <option>Los Angeles</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-3">
                                            <div class="form-group local-forms">
                                                <label>Country <span class="login-danger">*</span></label>
                                                <select class="form-control select">
                                                    <option>Select Country </option>
                                                    <option>Usa</option>
                                                    <option>Uk</option>
                                                    <option>Italy</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-3">
                                            <div class="form-group local-forms">
                                                <label>State/Province <span class="login-danger">*</span></label>
                                                <select class="form-control select">
                                                    <option>Select State</option>
                                                    <option>Alaska</option>
                                                    <option>California</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-3">
                                            <div class="form-group local-forms">
                                                <label>Postal Code <span class="login-danger">*</span></label>
                                                <input class="form-control" type="text" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12">
                                            <div class="form-group local-forms">
                                                <label>Start Biography <span class="login-danger">*</span></label>
                                                <textarea class="form-control" rows="3" cols="30"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-6">
                                            <div class="form-group local-top-form">
                                                <label class="local-top">Avatar <span
                                                        class="login-danger">*</span></label>
                                                <div class="settings-btn upload-files-avator">
                                                    <input type="file" accept="image/*" name="image" id="file"
                                                        onchange="loadFile(event)" class="hide-input">
                                                    <label for="file" class="upload">Choose File</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-6">
                                            <div class="form-group select-gender">
                                                <label class="gen-label">Status <span
                                                        class="login-danger">*</span></label>
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="radio" name="gender"
                                                            class="form-check-input mt-0">Active
                                                    </label>
                                                </div>
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="radio" name="gender"
                                                            class="form-check-input mt-0">In Active
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="doctor-submit text-end">
                                                <button type="submit"
                                                    class="btn btn-primary submit-form me-2">Submit</button>
                                                <button type="submit"
                                                    class="btn btn-primary cancel-form">Cancel</button>
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
    </Menus>
     
</template>
