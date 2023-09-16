<template>
  <Head :title="__('Assignments')" />
  <PageMainHeader />
  <div class="page-body-wrapper">
    <Sidebar />
    <div class="page-body">
      <div class="container-fluid">
        <PageHeader :breadcrumb_title="__('Assignments')" />
      </div>
      <div class="container-fluid mt-3">
        <div v-if="$page.props.flash.success" class="alert alert-success" role="alert">
          <p>{{ $page.props.flash.success }}</p>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <div class="card">
              <div class="card-header">
                <h5 class="f-w-300"><i class="fa fa-book"></i>{{ __('Assignments') }}</h5>
                <div class="card-header-right">
                  <Link :href="route('student.active-lessons.index')" class="pull-right white"><i
                    class="fa fa-caret-left white"></i>Back</Link>
                </div>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="mb-3 row">
                      <label class="col-sm-5 col-form-label"><b>{{ __('FilterBy Subject') }}</b></label>
                      <div class="col-sm-7">
                        <select v-model="subject_id" @change="search" class="form-control form-control-sm"
                          id="exampleFormControlSelect31">
                          <option value=""> ({{ __('All Subjects') }})</option>
                          <option :value="subject.id" v-for="subject in subjects" :key="subject.id">
                            {{ subject.title }}
                          </option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="table-responsive">
                      <table class="table table-sm">
                        <thead>
                          <tr>
                            <th scope="col">Sr. No.</th>
                            <th scope="col">{{ __('Title') }}</th>
                            <th scope="col">{{ __('Subject') }}</th>
                            <th scope="col">{{ __('Due Date') }}</th>
                            <th scope="col">{{ __('Submit') }}</th>
                            <th scope="col">{{ __('Result') }}</th>
                            <th scope="col">{{ __('Actions') }}</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="(assignment, index) in assignmnetsList" :key="assignment.id">
                            <td>Assignment # {{ index + 1 }}</td>
                            <td> {{ assignment.title }}</td>
                            <td>{{ assignment.subject.title }}</td>
                            <td class="text-danger">{{ assignment.end_date }}</td>
                            <td><span :class="['badge', assignment.is_completed ? 'badge-success' : 'badge-warning']">{{
                              assignment.is_completed ? 'Submitted' : 'Pending' }}</span></td>
                            <td>{{ __('Score') }}: {{ assignment.status.marks_obtained }}</td>
                            <td>
                              <div class="btn-group" role="group" aria-label="Basic example">
                                <Link :href="route('student.assignment.show', assignment.id)"
                                  class="btn btn-success btn-xs">
                                <i class="fa fa-eye"></i>
                                </Link>
                                <a v-if="!assignment.is_completed" href="#" class="btn btn-primary btn-xs" type="button"
                                  data-bs-toggle="modal" :data-bs-target="`.upload-assignment${assignment.id}`"
                                  @click="url = route('student.assignment.store', assignment.id)"
                                  :title="__('Submit Assignment')"><i class="fa fa-upload"></i></a>
                              </div>
                            </td>
                            <div class="modal fade" :class="`upload-assignment${assignment.id}`" tabindex="-1"
                              role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                              <form class="form theme-form" @submit.prevent="submmitForm(assignment.id)">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h4 class="modal-title" id="mySmallModalLabel">{{ __('Submit Assignment') }}</h4>
                                    </div>
                                    <div class="modal-body">
                                      <div class="row mt-3">
                                        <div class="col-md-12">
                                          <label class="form-label">{{ __('File') }}</label>
                                          <input class="pl-2" type="file" :class="[errors.file ? 'is-invalid' : '']"
                                            @input="form.file = $event.target.files[0]" />
                                          <div class="txt-danger">
                                            {{ errors.file }}
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button class="btn btn-light" data-bs-dismiss="modal">{{ __('Close') }}</button>
                                      <button class="btn btn-primary" type="submit">{{ __('Submit Assignment') }}</button>
                                    </div>
                                  </div>
                                </div>
                              </form>
                            </div>
                          </tr>
                        </tbody>
                      </table>
                      <p class="text-center mt-3" v-if="!assignmnetsList.length">
                        {{ __('No assignments found') }}.
                      </p>
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
</template>
<script>
import Sidebar from "@/Pages/Student/Layout/Sidebar.vue";
import PageMainHeader from "@/Pages/Student/Layout/PageMainHeader.vue";
import Layout from "@/Pages/Student/Layout/Layout.vue";
import PageHeader from "@/Pages/Student/Layout/PageHeader.vue";
import { Link, useForm, Head } from "@inertiajs/inertia-vue3";
import moment from 'moment'
import { ref, computed } from 'vue'

export default {
  props: {
    subjects: Object,
    assignments: Object,
    errors: Object,
  },
  components: {
    Link,
    Head,
    Layout,
    Sidebar,
    PageHeader,
    PageMainHeader,
    moment
  },
  setup(props) {

    const isAssignmentCompleted = (assignment) => {
      return assignment.status.is_completed;
    };

    let assignmnetsList = ref(props.assignments);
    let subject_id = ref('');

    const search = () => {
      if (subject_id.value) {
        axios.get(route('student.active-assignments.search'), { params: { subject_id: subject_id.value } }).then(response => {
          assignmnetsList.value = [];
          assignmnetsList.value = response.data;
        });
        return;
      }
      assignmnetsList.value = props.assignments;
    };

    let url = ref('');
    const isAssignmentOpen = (due_date) => {
      return new Date(due_date) >= new Date;
    };
    const form = useForm({
      file: null
    });
    const submmitForm = (assignmentId) => {
      form.post(url.value, {
        onSuccess: () => {
          $(`.upload-assignment${assignmentId}`).modal('hide');
        },
      });
    }
    return { isAssignmentOpen, form, url, submmitForm, isAssignmentCompleted, assignmnetsList, subject_id, search }
  }
};
</script>