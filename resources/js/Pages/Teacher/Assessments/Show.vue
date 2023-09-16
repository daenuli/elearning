<template>
  <Layout :pageTitle="__('Assessments Details')">
    <PageHeader :breadcrumb_title="__('Assessments Details')" />
    <div class="container-fluid">
      <div v-if="$page.props.flash.success" class="alert alert-success" role="alert">
        <p>{{ $page.props.flash.success }}</p>
      </div>
      <div v-if="$page.props.flash.error" class="alert alert-danger" role="alert">
        <p>{{ $page.props.flash.error }}</p>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h5 class="f-w-300">
                <i class="fa fa-book"></i> {{ __('Assessment Details') }}
              </h5>
              <div class="card-header-right">
                <div class="btn-group" role="group" aria-label="Basic example">
                  <Link v-if="!assessment.data.is_published" :href="
                    route('teacher.assessments.edit', assessment.data.id)
                  " class="btn btn-xs btn-primary"><i class="fa fa-pencil text-white"></i>{{ __('Edit') }}</Link>
                  <Link :href="route('teacher.assessments.index')" class="btn btn-xs btn-success"><i
                    class="fa fa-arrow-left text-white"></i> {{ __('Back to list') }}</Link>
                </div>
              </div>
            </div>
            <div class="card-body avatar-showcase">
              <div class="table-responsive">
                <table class="table table-sm table-bordered">
                  <tr>
                    <th>{{ __('Title') }}</th>
                    <td>{{ assessment.data.title }}</td>
                    <th>{{ __('Time Limit') }}</th>
                    <td>{{ assessment.data.time_limit_in_minutes }} Minutes</td>
                  </tr>
                  <tr>
                    <th>{{ __('Schedule From') }}</th>
                    <td>{{ assessment.data.start_date }}</td>
                    <th>{{ __('Schedule To') }}</th>
                    <td>{{ assessment.data.end_date }}</td>
                  </tr>
                  <tr>
                    <th>{{ __('Class') }}</th>
                    <td>{{ assessment.data.class.name }}</td>
                    <th>{{ __('Study Group') }}</th>
                    <td>{{ assessment.data.study_group.name }}</td>
                  </tr>
                  <tr>
                    <th>{{ __('Subject') }}</th>
                    <td>{{ assessment.data.subject.title }}</td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h5 class="f-w-300">
                <i class="fa fa-question-circle"></i> {{ __('Multiple Choice Questions') }}
              </h5>
              <div class="card-header-right">
                <Link :href="
                  route(
                    'teacher.assessments.questions.create',
                    assessment.data.id
                  )
                " class="btn btn-light btn-sm">
                <i class="fa fa-plus"></i>
                {{ __('Create') }}
                </Link>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-xs">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">{{ __('Question') }}</th>
                      <th scope="col">{{ __('Created At') }} </th>
                      <th scope="col">{{ __('Actions') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(question, index) in assessment.data
                      .multiple_choice_questions" :key="question.id">
                      <th scope="row">{{ index + 1 }}</th>
                      <td>{{ question.text }}</td>
                      <td>{{ question.created_at }}</td>
                      <td>
                        <div class="btn-group" role="group" aria-label="Basic example">
                          <button class="btn btn-success btn-xs" data-bs-toggle="modal"
                            :data-bs-target="`.question-details-modal${question.id}`">
                            <i class="fa fa-eye"></i>
                          </button>
                          <Link :href="route('teacher.questions.edit', question.id)" v-if="!assessment.data.is_published" class="btn btn-primary btn-xs">
                          <i class="fa fa-pencil text-white"></i>
                          </Link>
                          <button @click="destroy(question)" v-if="!assessment.data.is_published" class="btn btn-danger btn-xs">
                            <i class="fa fa-trash"></i>
                          </button>
                        </div>
                      </td>
                      <div class="modal fade" :class="`question-details-modal${question.id}`" tabindex="-1" role="dialog"
                        aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title" id="myLargeModalLabel">
                                {{ __('Question Details') }}
                              </h4>
                            </div>
                            <div class="modal-body my-gallery">
                              <div class="row">
                                <div class="col-md-6">
                                  <h6>
                                    <b>{{ question.text }}</b>
                                  </h6>
                                  <ol class="mt-3">
                                    <li v-for="(
                                          choice, index
                                        ) in question.choices" :key="choice.id">
                                      <span :class="[
                                        choice.is_correct
                                          ? 'badge badge-success'
                                          : '',
                                      ]">{{ String.fromCharCode(65 + index) }}.
                                        {{ choice.text }}</span>
                                    </li>
                                  </ol>
                                </div>
                                <div class="col-md-6" v-if="question.file">
                                  <figure class="" itemprop="associatedMedia" itemscope="">
                                    <a :href="question.file.url" itemprop="contentUrl" data-size="1600x950"
                                      data-original-title="" title=""><img class="img-thumbnail" :src="question.file.url"
                                        itemprop="thumbnail" /></a>
                                  </figure>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button class="btn btn-light" type="button" data-bs-dismiss="modal" aria-label="Close">
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
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h5 class="f-w-300">
                <i class="fa fa-question-circle"></i> {{ __('Essay Questions') }}
              </h5>
              <div class="card-header-right">
                <Link :href="
                  route(
                    'teacher.assessments.essay-questions.create',
                    assessment.data.id
                  )
                " class="btn btn-light btn-sm">
                <i class="fa fa-plus"></i>
                {{ __('Create') }}
                </Link>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-xs">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">{{ __('Question') }}</th>
                      <th scope="col">{{ __('Created At') }} </th>
                      <th scope="col">{{ __('Actions') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(question, index) in assessment.data
                      .essay_questions" :key="question.id">
                      <th scope="row">{{ index + 1 }}</th>
                      <td>{{ question.text }}</td>
                      <td>{{ question.created_at }}</td>
                      <td>
                        <div class="btn-group" role="group" aria-label="Basic example">
                          <button class="btn btn-success btn-xs" data-bs-toggle="modal"
                            :data-bs-target="`.question-details-modal${question.id}`">
                            <i class="fa fa-eye"></i>
                          </button>
                          <Link :href="
                            route('teacher.essay-questions.edit', question.id)
                          " 
                          v-if="!assessment.data.is_published"
                          class="btn btn-primary btn-xs">
                          <i class="fa fa-pencil text-white"></i>
                          </Link>
                          <button @click="destroy(question)" v-if="!assessment.data.is_published" class="btn btn-danger btn-xs">
                            <i class="fa fa-trash"></i>
                          </button>
                        </div>
                      </td>
                      <div class="modal fade" :class="`question-details-modal${question.id}`" tabindex="-1" role="dialog"
                        aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title" id="myLargeModalLabel">
                                {{ __('Question Details') }}
                              </h4>
                            </div>
                            <div class="modal-body my-gallery">
                              <div class="row">
                                <div class="col-md-6">
                                  <p>Q: {{ question.text }}</p>
                                  <ol class="mt-3">
                                    <li v-for="(
                                          choice, index
                                        ) in question.choices" :key="choice.id">
                                      <span :class="[
                                        choice.is_correct
                                          ? 'badge badge-success'
                                          : '',
                                      ]">{{ String.fromCharCode(65 + index) }}.
                                        {{ choice.text }}</span>
                                    </li>
                                  </ol>
                                </div>
                                <div class="col-md-6" v-if="question.file">
                                  <figure class="" itemprop="associatedMedia" itemscope="">
                                    <a :href="question.file.url" itemprop="contentUrl" data-size="1600x950"
                                      data-original-title="" title=""><img class="img-thumbnail" :src="question.file.url"
                                        itemprop="thumbnail" /></a>
                                  </figure>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button class="btn btn-light" type="button" data-bs-dismiss="modal" aria-label="Close">
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
    </div>
  </Layout>
</template>
<script>
import Sidebar from "@/Pages/Teacher/Layout/Sidebar.vue";
import Layout from "@/Pages/Teacher/Layout/Layout.vue";
import PageMainHeader from "@/Pages/Teacher/Layout/PageMainHeader.vue";
import PageHeader from "@/Pages/Teacher/Layout/PageHeader.vue";
import { Link, Head } from "@inertiajs/inertia-vue3";
import Datepicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";
import VuePdfEmbed from "vue-pdf-embed";
import Swal from "sweetalert2";
import { Inertia } from "@inertiajs/inertia";

export default {
  props: {
    files: Array,
    assessment: Object,
  },
  components: {
    Link,
    Head,
    Layout,
    Sidebar,
    PageHeader,
    Datepicker,
    VuePdfEmbed,
    PageMainHeader,
  },
  setup() {
    function indexToOptionLabel(index) {
      return String.fromCharCode(65 + index);
    }

    const destroy = (question) => {
      Swal.fire({
        title: "Are you sure?",
        text: `Do you want to delete question?`,
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete!",
      }).then((result) => {
        if (result.isConfirmed) {
          Inertia.delete(route("teacher.questions.destroy", question.id));
        }
      });
    };
    return { destroy, indexToOptionLabel };
  },
};
</script>
<style>
.vue-pdf-embed>div {
  margin-bottom: 8px;
  box-shadow: 0 2px 8px 4px rgba(0, 0, 0, 0.1);
}

.app-header {
  padding: 16px;
  box-shadow: 0 2px 8px 4px rgba(0, 0, 0, 0.1);
  background-color: #555;
  color: #ddd;
}

.app-content {
  padding: 24px 16px;
}

.right {
  float: right;
}
</style>