<template>
  <Layout :pageTitle="__('Assignments')">
    <PageHeader />
    <div class="container-fluid">
      <Message />
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h5 class="f-w-300"><i class="fa fa-book"></i> {{ __('Assignments') }}</h5>
              <div class="card-header-right">
                <Link :href="route('teacher.assignments.create')" class="btn btn-light btn-sm">
                <i class="fa fa-plus"></i>
                {{ __('Create') }}
                </Link>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="table-responsive">
                    <table class="table table-sm">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">{{__('Title')}}</th>
                          <th scope="col">{{__('Class')}}</th>
                          <th scope="col">{{__('Study Group')}}</th>
                          <th scope="col">{{__('Subject')}}</th>
                          <th scope="col">{{__('Schedule From')}}</th>
                          <th scope="col">{{__('Schedule To')}}</th>
                          <th scope="col">{{__('Status')}}</th>
                          <th scope="col">{{__('Actions')}}</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="(assignment, index) in assignments" :key="assignment.id">
                          <th scope="row">{{ index + 1 }}</th>
                          <td>{{ assignment.title }}</td>
                          <td>{{ assignment.class.name }}</td>
                          <td>{{ assignment.study_group.name }}</td>
                          <td>{{ assignment.subject.title }}</td>
                          <td>{{ assignment.start_date }}</td>
                          <td>{{ assignment.end_date }}</td>
                          <td v-if="!assignment.is_published"><a href="#" @click="publishAssignment(assignment)"><span
                                class="badge badge-warning white">Draft</span></a></td>
                          <td v-else><span class="badge badge-success white">Published</span></td>
                          <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                              <Link :href="route('teacher.assignments.show', assignment.id)"
                                class="btn btn-success btn-xs">
                              <i class="fa fa-eye"></i>
                              </Link>
                              <Link :class="{ 'disabled': assignment.is_published }"
                                :href="route('teacher.assignments.edit', assignment.id)" class="btn btn-info btn-xs">
                              <i class="fa fa-pencil"></i>
                              </Link>
                              <button :disabled="assignment.is_published" :class="{ 'disabled': assignment.is_published }"
                                @click="destroy(assignment)" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i>
                              </button>
                            </div>
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
      </div>
    </div>
  </Layout>
</template>
<script>
import Sidebar from "@/Pages/Teacher/Layout/Sidebar.vue";
import Layout from "@/Pages/Teacher/Layout/Layout.vue";
import PageMainHeader from "@/Pages/Teacher/Layout/PageMainHeader.vue";
import PageHeader from "@/Pages/Teacher/Layout/PageHeader.vue";
import { Link, Head } from "@inertiajs/inertia-vue3";
import { Inertia } from '@inertiajs/inertia';
import Swal from 'sweetalert2'
import moment from 'moment'
import { ref, computed, onMounted, onBeforeUnmount } from 'vue'

export default {
  props: {
    assignments: Object
  },
  name: "admin-layout",
  components: {
    Link,
    Head,
    Layout,
    Sidebar,
    PageHeader,
    PageMainHeader,
    moment
  },
  methods: {
    forramttedDate: function (date) {
      return moment(date).format('MMM D YYYY')
    }
  },
  setup() {

    const publishAssignment = (assignment) => {
      Swal.fire({
        title: 'Are you sure you want to publish assignment?',
        text: `Once an assignment has been published, it is not possible to update or delete it.`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, publish!',
        showLoaderOnConfirm: true,

      }).then((result) => {
        if (result.isConfirmed) {
          Inertia.post(route('teacher.assignment.publish', assignment.id));
        }
      })
    };

    const destroy = (assignment) => {

      Swal.fire({
        title: 'Are you sure?',
        text: `Do you want to delete assignment ${assignment.title}?`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete!'
      }).then((result) => {
        if (result.isConfirmed) {
          Inertia.delete(route('teacher.assignments.destroy', assignment.id));
        }
      })
    }
    return { destroy, publishAssignment }
  }
};
</script>