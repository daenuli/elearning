<template>
  <Layout :pageTitle="__('Edit Question')">
    <PageHeader :breadcrumb_title="__('Edit Question')" />
    <div class="container-fluid">
      <form class="form theme-form" @submit.prevent="submit">
        <div class="card">
          <div class="card-header">
						<h5 class="f-w-300">{{ __('Edit Question') }}</h5>
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
                      :class="[errors[`text`] ? 'is-invalid' : '']" />
                  </div>
                  <div class="txt-danger">
                    {{ errors[`text`] }}
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <input class="m-t-40" type="file" multiple :class="[errors.file ? 'is-invalid' : '']"
                  @input="form.file = $event.target.files[0]" />
                <div class="txt-danger">
                  {{ errors[`file`] }}
                </div>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-2 pt-2">
                <input type="radio" v-model="form.correctOption" value="optionA" />
              </div>
              <div class="col-sm-2">
                <input class="form-control input" v-model="form.optionA" type="text"
                  :class="[errors['optionA'] ? 'is-invalid' : '']" placeholder="Option A" />
                <div class="txt-danger">
                  {{ errors["optionA"] }}
                </div>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-2 pt-2">
                <input type="radio" v-model="form.correctOption" value="optionB" />
              </div>
              <div class="col-sm-2">
                <input class="form-control input" v-model="form.optionB" type="text"
                  :class="[errors['optionB'] ? 'is-invalid' : '']" placeholder="Option B" />
                <div class="txt-danger">
                  {{ errors["optionB"] }}
                </div>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-2 pt-2">
                <input type="radio" v-model="form.correctOption" value="optionC" />
              </div>
              <div class="col-sm-2">
                <input class="form-control input" v-model="form.optionC" type="text"
                  :class="[errors['optionC'] ? 'is-invalid' : '']" placeholder="Option C" />
                <div class="txt-danger">
                  {{ errors["optionC"] }}
                </div>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-2 pt-2">
                <input type="radio" v-model="form.correctOption" value="optionD" />
              </div>
              <div class="col-sm-2">
                <input class="form-control input" v-model="form.optionD" type="text"
                  :class="[errors['optionD'] ? 'is-invalid' : '']" placeholder="Option D" />
                <div class="txt-danger">
                  {{ errors["optionD"] }}
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-">
                  <div class="txt-danger">
                    {{ errors["correctOption"] }}
                  </div>
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
import { ref, onMounted } from "vue";
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
    function correctOption(choices) {
      if (choices[0].is_correct) {
        return { id: choices[0].id, text: "optionA" };
      }
      if (choices[1].is_correct) {
        return { id: choices[1].id, text: "optionB" };
      }
      if (choices[2].is_correct) {
        return { id: choices[2].id, text: "optionC" };
      }
      if (choices[3].is_correct) {
        return { id: choices[3].id, text: "optionD" };
      }
    }

    function correctOptionId($event, choices) {
      return choices.find((element) => element.is_correct);
    }

    const form = useForm({
      id: props.question.data.id,
      text: props.question.data.text,
      optionA: props.question.data.choices[0].text,
      optionB: props.question.data.choices[1].text,
      optionC: props.question.data.choices[2].text,
      optionD: props.question.data.choices[3].text,
      correctOption: correctOption(props.question.data.choices).text,
      // correctChoiceId: correctOptionId(props.question.data.choices).id
    });

    function submit() {
      Inertia.post(route("teacher.questions.update", this.form.id), {
        _method: "put",
        form: this.form,
      });
    }

    return {
      submit,
      form,
      correctOptionId,
    };
  },
};
</script>