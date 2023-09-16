<template>
  <Layout :pageTitle="__('Create Question')">
    <PageHeader :breadcrumb_title="__('Create Question')" />
    <div class="container-fluid">
      <form class="form theme-form">
        <div class="card">
          <div class="card-header">
						<h5 class="f-w-300">{{ __('Create Question') }}</h5>
            <div class="card-header-right">
							<Link :href="route('teacher.assessments.show', assessment.id)" class="pull-right white"><i class="fa fa-caret-left white"></i>{{ __('Back') }}</Link>
            </div>
          </div>
          <div class="card-body">
            <div v-for="(question, index) in questions" :key="index">
              <div class="row mt-2">
                <div class="col-md-4">
                  <div class="form-group m-form__group">
                    <label class="pb-2">{{ __('Question') }} {{ index + 1 }}</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">?</span>
                      </div>
                      <input class="form-control input-height" style="height: 42px !important" type="text" v-model="question.text" :class="[
                        errors[`questions.${index}.text`]
                          ? 'is-invalid'
                          : '',
                      ]" :placeholder="__('Enter your question')" />
                    </div>
                    <div class="txt-danger">
                      {{ errors[`questions.${index}.text`] }}
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <input class="m-t-45" type="file" multiple :class="[errors.file ? 'is-invalid' : '']"
                    @input="question.file = $event.target.files[0]" />
                  <div class="txt-danger">
                    {{ errors[`questions.${index}.file`] }}
                  </div>
                </div>
                <div class="col-md-4 p-t-30">
                  <button class="btn btn-danger btn-sm pull-right" :disabled="questions.length === 1"
                    @click="deleteQuestion(index)">
                    <i class="fa fa-minus-circle"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <button type="button" @click="submitQuestions" class="btn btn-success pull-right">
              {{ __('Save') }}
            </button>
            <Link :href="
              route('teacher.assessments.show', assessment.id)
            " class="btn btn-danger mr-1 pull-right">{{ __('Cancel') }}</Link>
            <button @click="addQuestion" type="button" class="btn btn-primary mr-1 pull-right">
              <i class="fa fa-plus"></i>
              {{ __('Add More') }}
            </button>
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
import { ref, onMounted } from "vue";
import { Inertia } from "@inertiajs/inertia";

export default {
  props: {
    assessment: Object,
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
    const submitting = ref(false);
    const questions = ref([
      { text: "" },
    ]);
    const addQuestion = () => {
      questions.value.push({
        text: ""
      });
    };

    const deleteQuestion = (index) => {
      questions.value.splice(index, 1);
    };

    const submitQuestions = async () => {
      submitting.value = true;
      try {
        Inertia.post(route('teacher.assessments.essay-questions.store', props.assessment.id), {
          questions: questions.value,
        });
      } catch (error) {
        submitting.value = false;
      }
    };

    return {
      questions,
      addQuestion,
      deleteQuestion,
      submitQuestions,
      submitting,
    };
  },
};
</script>