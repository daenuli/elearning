<template>
    <Head title="Assign Students" />
  <div class="page-wrapper">
    <div class="page-main-header">
      <PageMainHeader />
    </div>
    <div class="page-body-wrapper">
      <Sidebar />
      <div class="page-body">
        <div class="container-fluid">
          <PageHeader />
        </div>
        <div class="container-fluid">
          <div
            v-if="$page.props.flash.success"
            class="alert alert-success"
            role="alert"
          >
            <p>{{ $page.props.flash.success }}</p>
          </div>
           <form
            class="form theme-form"
            @submit.prevent="form.post(route('admin.school-class.add-students.store', school_class.id))"
          >
            <div v-if="errors.studentIds" class="alert alert-danger dark alert-dismissible fade show" role="alert">{{ errors.studentIds }}
              <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <h5><i class="fa fa-users"></i> Add Students</h5>
                    <span
                      >Select and add students to the class
                      {{ school_class.name }}</span
                    >
                    <div class="card-header-right">
                      <Link :href="route('admin.school-classes.index')" class="btn btn-success">
                        <i class="fa fa-arrow-left text-white"></i> Back to list
                      </Link>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-sm">
                        <thead>
                          <tr>
                            <th>
                              <input
                                id="chk-ani-all"
                                type="checkbox"
                                @click="selectAll($event)"
                                v-model="form.allSelected"
                              />
                            </th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">NISN</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="user in users.data" :key="user.student.id">
                            <th scope="row">
                              <input
                                class="check-student"
                                :id="`user-${user.student.id}`"
                                type="checkbox"
                                v-model="form.studentIds"
                                :value="user.student.id"
                                @click="selectStudent($event, user.student.id)"
                              >
                            </th>
                            <td>{{ user.name }}</td>
                            <td>{{ user.email }}</td>
                            <td>{{ user.student?.NISN_number }}</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="row mt-4">
                      <div class="col-md-12">
                        <button type="submit" class="btn btn-primary float-right">
                          Add to Class 
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Sidebar from "@/Pages/Admin/Layout/Sidebar.vue";
import Layout from "@/Pages/Admin/Layout/Layout.vue";
import PageMainHeader from "@/Pages/Admin/Layout/PageMainHeader.vue";
import PageHeader from "@/Pages/Admin/Layout/PageHeader.vue";
import { Link, useForm, Head } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import Swal from "sweetalert2";
import moment from "moment";
import axios from 'axios';
import {ref, onMounted} from 'vue';

export default {
  props: {
    studentIds: Array,
    users: Object,
    school_class: Object,
    errors: Object
  },
  name: "admin-layout",
  components: {
    Link,
    Head,
    Layout,
    Sidebar,
    PageHeader,
    PageMainHeader,
    moment,
  },
  setup(props) {
    onMounted(() => {
      form.allSelected = props.studentIds.length === props.users.data.length
    });

    const form = useForm({
      studentIds: props.studentIds,
      allSelected: false
    });

    function selectAll($event) {
      if ($event.target.checked) {
        form.allSelected = true;
        props.users.data.forEach(user => {
          form.studentIds.push(user.student.id);
        });
      } else {
        form.allSelected = false;
        form.studentIds = []
      }
    };

    function selectStudent($event, id){

      $event.target.checked 
      ? form.studentIds.push(id)
      : form.studentIds = form.studentIds.filter(element => element !== id)

      let chekedLength = $('.check-student:checked').length;
      let totalLength = props.users.data.length;

      form.allSelected = chekedLength === totalLength
    };

    return { 
        form,
        selectAll,
        selectStudent
    }
  }
};
</script>