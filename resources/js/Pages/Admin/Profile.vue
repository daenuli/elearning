<template>
  <Layout pageTitle="Profile" :avatar="avatar">
    <PageHeader :breadcrumb_title="__('Profile')" />
    <div class="container-fluid mt-3">
      <div v-if="$page.props.flash.success" class="alert alert-success" role="alert">
        <p>{{ $page.props.flash.success }}</p>
      </div>
      <form class="form theme-form" @submit.prevent="form.post(route('admin.profile.store'))">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <div class="row mb-2 text-center">
                  <div class="col-md-12">
                    <div class="col-auto">
                      <img style="margin-left: auto; margin-right: auto" class="img-70 rounded-circle" alt=""
                        :src="avatar" data-original-title="" title="" />
                    </div>
                    <div class="col mt-2">
                      <h3 class="mb-1">{{ $page.props.user.name }}</h3>
                    </div>
                  </div>
                </div>
                <div class="row mt-5">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-label">{{ __('Name') }}</label>
                      <input v-model="form.name" class="form-control" :class="[errors.name ? 'is-invalid' : '']"
                        placeholder="Name" />
                      <div class="txt-danger">{{ errors.name }}</div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-label">{{ __('Email') }}</label>
                      <input v-model="form.email" class="form-control" placeholder="Email"
                        :class="[errors.email ? 'is-invalid' : '']" />
                      <div class="txt-danger">{{ errors.email }}</div>
                    </div>
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-label">{{ __('Password') }}</label>
                      <input style="
                                        display: block;
                                        width: 100%;
                                        padding: 0.375rem 0.75rem;
                                        font-size: 1rem;
                                        font-weight: 400;
                                        line-height: 1.5;
                                        color: #212529;
                                        background-color: #fff;
                                        background-clip: padding-box;
                                        border: 1px solid #ced4da;
                                        border-radius: 0.25rem;
                                      " v-model="form.password" class="form-control"
                        :class="[errors.password ? 'is-invalid' : '']" type="password" placeholder="Password" />
                      <div class="txt-danger">{{ errors.password }}</div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label" for="password_confirmation">{{ __('Confirm Password') }}</label>
                    <input style="
                                      display: block;
                                      width: 100%;
                                      padding: 0.375rem 0.75rem;
                                      font-size: 1rem;
                                      font-weight: 400;
                                      line-height: 1.5;
                                      color: #212529;
                                      background-color: #fff;
                                      background-clip: padding-box;
                                      border: 1px solid #ced4da;
                                      border-radius: 0.25rem;
                                    " id="password_confirmation" v-model="form.password_confirmation"
                      class="form-control" :class="[
                        errors.password_confirmation ? 'is-invalid' : '',
                      ]" type="password" placeholder="Confirm Password" />
                    <div class="txt-danger">
                      {{ errors.password_confirmation }}
                    </div>
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="col-md-6">
                    <label class="form-label">{{ __('Avatar') }}</label>
                    <input type="file" :class="[errors.avatar ? 'is-invalid' : '']"
                      @input="form.avatar = $event.target.files[0]" />
                    <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                      {{ form.progress.percentage }}%
                    </progress>
                    <div class="txt-danger">
                      {{ errors.avatar }}
                    </div>
                  </div>
                </div>
                <div class="form-footer">
                  <button type="submit" class="btn btn-primary mt-3 pull-right">
                    Save
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </Layout>
</template>
<script>
import { Link, useForm, Head } from "@inertiajs/inertia-vue3";
import Sidebar from "@/Pages/Admin/Layout/Sidebar.vue";
import Layout from "@/Pages/Admin/Layout/Layout.vue";
import PageMainHeader from "@/Pages/Admin/Layout/PageMainHeader.vue";
import PageHeader from "@/Pages/Admin/Layout/PageHeader.vue";
import image from "@/assets/img/avatar.jpg";

export default {
  props: {
    user: Object,
    errors: Object,
    avatar: String | Boolean,
  },
  data() {
    return {
      image: image,
    };
  },
  name: "profile",
  components: {
    Link,
    Head,
    Layout,
    Sidebar,
    PageHeader,
    PageMainHeader,
  },
  setup(props) {
    const form = useForm({
      name: props.user.name,
      email: props.user.email,
      password: "",
      password_confirmation: "",
      avatar: null,
    });
    return { form };
  },
};
</script>