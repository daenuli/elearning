<template>
  <Head title="Questions" />
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
        <div
            v-if="$page.props.flash.error"
            class="alert alert-danger"
            role="alert"
          >
            <p>{{ $page.props.flash.error }}</p>
        </div>
          <div class="row">
            <div class="col-sm-12">
              <div class="card">
                <div class="card-header">
                  <h5 class="f-w-300">
                    <i class="fa fa-question-circle"></i> Questions
                  </h5>
                  <span>{{ assessment.title }}</span>
                  <div class="card-header-right">
                    <Link
                      :href="
                        route('teacher.assessments.index', $page.props.user.id)
                      "
                      class="btn btn-success mr-1"
                    >
                      <i class="fa fa-arrow-left text-white"></i>
                      Back to assessments
                    </Link>
                    <Link
                      :href="
                        route(
                          'teacher.assessments.essay-questions.create',
                          assessment.id
                        )
                      "
                      class="btn btn-primary btn-sm"
                    >
                      <i class="fa fa-plus"></i>
                      Create
                    </Link>
                  </div>
                </div>
                <div class="card-body btn-group-wrapper">
                  <div class="table-responsive">
                    <table class="table table-sm">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Question</th>
                          <th scope="col">Created At</th>
                          <th scope="col">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr
                          v-for="(question, index) in questions.data"
                          :key="question.id"
                        >
                          <th scope="row">{{ index + 1 }}</th>
                          <td>{{ question.text }}</td>
                          <td>{{ question.created_at }}</td>
                          <td>
                            <div
                              class="btn-group"
                              role="group"
                              aria-label="Basic example"
                            >
                              <button
                                class="btn btn-success btn-xs"
                                data-bs-toggle="modal"
                                :data-bs-target="`.question-details-modal${question.id}`"
                              >
                                <i class="fa fa-eye"></i>
                              </button>
                              <Link
                                :href="
                                  route('teacher.essay-questions.edit', question.id)
                                "
                                class="btn btn-primary btn-xs"
                              >
                                <i class="fa fa-pencil text-white"></i>
                              </Link>
                              <button
                                @click="destroy(question)"
                                class="btn btn-danger btn-xs"
                              >
                                <i class="fa fa-trash"></i>
                              </button>
                            </div>
                          </td>
                          <div
                            class="modal fade"
                            :class="`question-details-modal${question.id}`"
                            tabindex="-1"
                            role="dialog"
                            aria-labelledby="myLargeModalLabel"
                            aria-hidden="true"
                          >
                            <div
                              class="
                                modal-dialog modal-dialog-centered modal-lg
                              "
                            >
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h4
                                    class="modal-title"
                                    id="myLargeModalLabel"
                                  >
                                    Question Details
                                  </h4>
                                  <button
                                    class="btn-close"
                                    type="button"
                                    data-bs-dismiss="modal"
                                    aria-label="Close"
                                  ></button>
                                </div>
                                <div class="modal-body my-gallery">
                                  <div class="row">
                                    <div class="col-md-6">
                                      <h3>
                                        <b>Q: {{ question.text }}</b>
                                      </h3>
                                    </div>
                                    <div class="col-md-6" v-if="question.file">
                                      <figure
                                        class=""
                                        itemprop="associatedMedia"
                                        itemscope=""
                                      >
                                        <a
                                          :href="question.file.url"
                                          itemprop="contentUrl"
                                          data-size="1600x950"
                                          data-original-title=""
                                          title=""
                                          ><img
                                            class="img-thumbnail"
                                            :src="question.file.url"
                                            itemprop="thumbnail"
                                        /></a>
                                      </figure>
                                    </div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button
                                    class="btn btn-light"
                                    type="button"
                                    data-bs-dismiss="modal"
                                    aria-label="Close"
                                  >
                                    Close
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
      </div>
    </div>
  </div>
</template>
<script>
import Sidebar from "@/Pages/Teacher/Layout/Sidebar.vue";
import Layout from "@/Pages/Teacher/Layout/Layout.vue";
import PageMainHeader from "@/Pages/Teacher/Layout/PageMainHeader.vue";
import PageHeader from "@/Pages/Teacher/Layout/PageHeader.vue";
import { Link, Head, useForm } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import Swal from "sweetalert2";
import moment from "moment";

export default {
  props: {
    assessment: Object,
    questions: Object,
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