<template>
  <Layout :pageTitle="__('Study Groups')">
    <PageHeader :breadcrumb_title="__('Study Groups')" />
    <div class="container-fluid">
      <div v-if="$page.props.flash.error" class="alert alert-danger" role="alert">
        <p>{{ $page.props.flash.error }}</p>
      </div>
      <div v-if="$page.props.flash.success" class="alert alert-success" role="alert">
        <p>{{ $page.props.flash.success }}</p>
      </div>

      <div class="modal fade" id="createStudyGroupModal" tabindex="-1" role="dialog"
        aria-labelledby="createStudyGroupModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <form class="form theme-form" @submit.prevent="form.post(route('admin.study-groups.store'))">
              <div class="modal-header">
                <h5 class="modal-title" id="createStudyGroupModalLabel">
                  <i class="fa fa-users"></i>
                  {{ __('Create Study Group') }}
                </h5>
                <button class="close" type="button" aria-label="Close" data-bs-dismiss="modal"><span
                    aria-hidden="true">×</span></button>
              </div>
              <div class="modal-body">
                <div class="mb-3 row">
                  <label class="col-sm-3 col-form-label">{{ __('Name') }}</label>
                  <div class="col-sm-9">
                    <input v-model="form.name" class="form-control form-control-sm"
                      :class="[errors.name ? 'is-invalid' : '']" required type="text" />
                    <div class="txt-danger">{{ errors.name }}</div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button class="btn btn-light" type="button" data-bs-dismiss="modal">
                  {{ __('Cancel') }}
                </button>
                <button class="btn btn-primary" type="submit">{{ __('Save') }}</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h5> {{ __('Study Groups') }}</h5>
              <div class="card-header-right">
                <button class="btn btn-light" type="button" data-bs-toggle="modal" data-original-title="test"
                  data-bs-target="#createStudyGroupModal">
                  <i class="fa fa-plus"></i> {{ __('Create') }}
                </button>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table table-sm">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{__('Name') }}</th>
                    <th scope="col">{{__('Created At') }}</th>
                    <th scope="col">{{__('Actions') }}</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(study_group, index) in study_groups" :key="study_group.id">
                    <th scope="row">{{ index + 1 }}</th>
                    <td>{{ study_group.name }}</td>
                    <td>{{ study_group.created_at }}</td>
                    <td>
                      <div class="btn-group" role="group" aria-label="Basic example">
                        <button class="btn btn-info btn-xs" type="button" data-bs-toggle="modal"
                          data-original-title="test" :data-bs-target="`#updateStudyGroupModal${study_group.id}`"
                          @click="setStudyGroup(study_group)">
                          <i class="fa fa-pencil"></i>
                        </button>
                        <button @click="destroy(study_group.id)" class="btn btn-danger btn-xs">
                          <i class="fa fa-trash"></i>
                        </button>
                      </div>
                    </td>
                    <div class="modal fade" :id="`updateStudyGroupModal${study_group.id}`" tabindex="-1" role="dialog"
                      :aria-labelledby="`updateStudyGroupModalLabel${study_group.id}`" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <form class="form theme-form" @submit.prevent="
                            form.put(
                              route(
                                'admin.study-groups.update',
                                study_group.id
                              )
                            )
                            ">
                            <div class="modal-header">
                              <h5 class="modal-title" :id="`updateStudyGroupModalLabel${study_group.id}`">
                                <i class="fa fa-users"></i>
                                {{ __('Update Study Group') }}
                              </h5>
                              <button class="close" type="button" aria-label="Close" data-bs-dismiss="modal"><span
                                  aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body">
                              <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">{{ __('Name') }}</label>
                                <div class="col-sm-9">
                                  <input v-model="form.name" class="form-control form-control-sm" :class="[
                                    errors.name ? 'is-invalid' : '',
                                  ]" required type="text" />
                                  <div class="txt-danger">
                                    {{ errors.name }}
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
import Sidebar from "@/Pages/Admin/Layout/Sidebar.vue";
import Layout from "@/Pages/Admin/Layout/Layout.vue";
import PageMainHeader from "@/Pages/Admin/Layout/PageMainHeader.vue";
import PageHeader from "@/Pages/Admin/Layout/PageHeader.vue";
import { Link, useForm, Head } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import Swal from "sweetalert2";
import moment from "moment";

export default {
  props: {
    study_groups: Object,
    errors: Object,
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
  methods: {
    setStudyGroup: function (study_group) {
      this.form.id = study_group.id;
      this.form.name = study_group.name;
    },
  },
  setup() {
    const form = useForm({
      id: null,
      name: "",
    });
    Inertia.on("success", (event) => {
      form.name = "";
      $("#createStudyGroupModal").modal("hide");
      $(`#updateStudyGroupModal${form.id}`).modal("hide");
    });
    const destroy = (id) => {
      Swal.fire({
        title: "Are you sure?",
        text: "Do you want to delete this study group?",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete!",
      }).then((result) => {
        if (result.isConfirmed) {
          Inertia.delete(route("admin.study-groups.destroy", id));
        }
      });
    };

    return { destroy, form };
  },
};
</script>