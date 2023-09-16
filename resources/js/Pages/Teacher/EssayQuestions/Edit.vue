<template>
  <Layout :pageTitle="__('Edit Question')">
    <PageHeader :breadcrumb_title="__('Edit Question')" />
    <div class="container-fluid">
      <form class="form theme-form" @submit.prevent="submit">
        <div class="card">
          <div class="card-header">
            <h3>{{ __('Edit Question') }}</h3>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group m-form__group">
                  <label class="pb-2">{{ __('Question') }}</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">?</span>
                    </div>
                    <input class="form-control input-height" style="height: 42px !important" type="text" v-model="form.text"
                      :class="[errors[`form.text`] ? 'is-invalid' : '']" />
                  </div>
                  <div class="txt-danger">
                    {{ errors[`form.text`] }}
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <input class="m-t-45" type="file" multiple :class="[errors['form.file'] ? 'is-invalid' : '']"
                  @input="form.file = $event.target.files[0]" />
                <div class="txt-danger">
                  {{ errors[`form.file`] }}
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-success pull-right">
              {{ __('Update') }}
            </button>
            <Link :href="
              route(
                'teacher.assessments.show',
                question.data.assessment_id
              )
            " class="btn btn-danger mr-1 pull-right">{{ __('Cancel') }}</Link>
          </div>
        </div>
      </form>
    </div>
  </Layout>
</template>
<script>
import Sidebar from "@/Pages/Teacher/Layout/Sidebar.vue";
import Layout from "@/Pages/Teacher/Layout/Layout.vue";
import PageMainHeader from "@/Pages/Teacher/Layout/PageMainHeader.vue";
import PageHeader from "@/Pages/Teacher/Layout/PageHeader.vue";
import { Link, useForm, Head } from "@inertiajs/inertia-vue3";
import Datepicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";
import { Inertia } from "@inertiajs/inertia";

export default {
  props: {
    question: Object,
    errors: Object,
  },
  components: {
    Link,
    Head,
    Layout,
    Sidebar,
    PageHeader,
    Datepicker,
    PageMainHeader,
  },
  setup(props) {

    const form = useForm({
      id: props.question.data.id,
      text: props.question.data.text,
      file: '',
    });

    function submit() {
      Inertia.post(route("teacher.essay-questions.update", this.form.id), {
        _method: "put",
        form: this.form,
      });
    }

    return {
      submit,
      form,
    };
  },
};
</script>