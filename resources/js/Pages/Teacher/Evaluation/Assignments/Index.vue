<template>
  <Layout :pageTitle="__('Assignment Submissions')">
    <PageHeader :breadcrumb_title="__('Assignment Submissions')" />
    <div class="container-fluid mt-3">
      <div v-if="$page.props.flash.success" class="alert alert-success" role="alert">
        <p>{{ $page.props.flash.success }}</p>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h5 class="f-w-300">
                <i class="fa fa-book"></i> {{ assignment.title }}
              </h5>
              <p>{{ assignment.subject.title }}</p>
              <div class="card-header-right">
                <a :href="route('teacher.export.assignments', assignment.id)" class="btn btn-success btn-sm mr-2">
                  <i class="fa fa-cloud-download white"></i>
                {{ __('Export') }}
                </a>
                <Link :href="route('teacher.evaluation.assignments')" class="btn btn-info btn-sm mr-2 white"><i
                  class="fa fa-caret-left white"></i>{{ __('Back') }}</Link>
              </div>
            </div>
            <div class="table-responsive mt-3">
              <table class="table table-sm">
                <thead>
                  <tr>
                    <th scope="col">{{__('Student Name') }} </th>
                    <th scope="col">{{__('Submitted') }}</th>
                    <th scope="col">{{__('Submitted At') }} </th>
                    <th scope="col">{{__('File') }}</th>
                    <th scope="col">{{__('Marks Obtained') }} </th>
                    <th scope="col">{{__('Is Graded') }} </th>
                    <th scope="col">{{__('Actions') }}</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="student in students" :key="student.id">
                    <td>{{ student.name }}</td>
                    <td>
                      <span :class="[
                        'badge',
                        student.status.is_completed
                          ? 'badge-success'
                          : 'badge-danger',
                      ]">
                        {{ student.status.is_completed ? "Yes" : "No" }}
                      </span>
                    </td>
                    <td>
                      {{ student.status.submitted_at_date }}
                    </td>
                    <td>
                      <button v-if="!isAssignmentCompleted(student)" class="btn btn-xs btn-primary" type="button"
                        data-bs-toggle="modal" :data-bs-target="`.student-${student.id}-assignment`">
                        <i class="fa fa-file-pdf-o"></i>
                      </button>
                    </td>
                    <td>{{ student.status.marks_obtained }}</td>
                    <td>
                      <span :class="getBadgeClass(student)">
                        {{ isAssignmentGraded(student) ? "Yes" : "No" }}
                      </span>
                    </td>
                    <td>
                      <button class="btn btn-primary btn-sm" :class="{ disabled: isAssignmentCompleted(student) }"
                        v-bind:disabled="isAssignmentCompleted(student)" type="button" data-bs-toggle="modal"
                        :data-bs-target="`#gradeAssignment${student.id}`" @click="setForm(student)">
                        <i class="fa fa-check-square"></i> {{ __('Grade Assignment') }}
                      </button>
                    </td>
                    <div class="modal fade" :id="`gradeAssignment${student.id}`" tabindex="-1" role="dialog"
                      :aria-labelledby="`gradeAssignment${student.id}`" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <form class="form theme-form" @submit.prevent="
                            form.post(
                              route(
                                'teacher.evaluation.assignment.grade',
                                student.status.id
                              )
                            )
                          ">
                            <input type="hidden" v-model="form.id" />
                            <div class="modal-header">
                              <h5 class="modal-title" :id="`gradeAssignment${student.id}Modal`">
                                <i class="fa fa-star"></i>
                                {{ __('Grade Assignment') }}
                              </h5>
                              <button class="close" type="button" aria-label="Close" data-bs-dismiss="modal">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div class="mb-3 row">
                                <label class="col-sm-4 col-form-label">{{ __('Marks Obtained') }}</label>
                                <div class="col-sm-8">
                                  <input v-model="form.marks" class="form-control form-control-sm"
                                    :class="[errors.marks ? 'is-invalid' : '']" required type="text" />
                                  <div class="txt-danger">
                                    {{ errors.marks }}
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button class="btn btn-light" type="button" data-bs-dismiss="modal">
                                {{ __('Cancel') }}
                              </button>
                              <button class="btn btn-primary" type="submit">
                                {{ __('Save') }}
                              </button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <div class="modal fade" :id="`student-${student.id}-assignment`"
                      :class="`student-${student.id}-assignment`" tabindex="-1" role="dialog"
                      aria-labelledby="myLargeModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title" :id="`student${student.id}AssignmentModal`">
                              {{ assignment.title }}
                            </h4>
                            <br />
                            <span>{{ student.name }}</span>
                          </div>
                          <div class="modal-body">
                            <embed :src="student.status.filePathLabel" width="100%" height="700px" />
                          </div>
                          <div class="modal-footer">
                            <button data-bs-dismiss="modal" class="btn btn-light">
                              {{ __('Close') }}
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </Layout>
</template>
<script>
import Sidebar from "@/Pages/Teacher/Layout/Sidebar.vue";
import PageMainHeader from "@/Pages/Teacher/Layout/PageMainHeader.vue";
import Layout from "@/Pages/Teacher/Layout/Layout.vue";
import PageHeader from "@/Pages/Teacher/Layout/PageHeader.vue";
import { Link, useForm, Head } from "@inertiajs/inertia-vue3";
import moment from "moment";
import { Inertia } from "@inertiajs/inertia";
import { computed } from "vue";

export default {
  props: {
    students: Object,
    assignment: Object,
    errors: Object,
  },
  components: {
    Link,
    Head,
    Layout,
    Sidebar,
    PageHeader,
    PageMainHeader,
    moment,
  },
  setup() {
    const form = useForm({
      id: null,
      marks: 0,
    });

    const isAssignmentCompleted = (student) => {
      return !student.status.is_completed;
    };

    const isAssignmentGraded = (student) => {
      return student.status.is_graded;
    };

    const getBadgeClass = (student) => {
      return {
        badge: true,
        "badge-success": isAssignmentGraded(student),
        "badge-danger": !isAssignmentGraded(student),
      };
    };

    function setForm(student) {
      form.id = student.id;
      form.marks = student.status.marks_obtained;
    }

    Inertia.on("success", (event) => {
      form.marks = 0;
      $(`#gradeAssignment${form.id}`).modal("hide");
    });
    return {
      form,
      setForm,
      isAssignmentCompleted,
      isAssignmentGraded,
      getBadgeClass,
    };
  },
};
</script>