<template>
  <div class="p-10">
    <PageHeader :breadcrumb_title="''" />
    <Message />
    <div class="card mt-5">
      <div class="card-header">
        <h6 class="f-w-300 text-center">
          {{ assessment.title }}
        </h6>
      </div>
      <div class="card-body">
        <div v-if="!isTimeOver">
          <p class="pull-right">{{ __('Time left') }}: {{ timeInMinutes }} {{ __('Minutes') }}</p>
          <div v-if="!questionsEnd">
            <h5>{{ questions[currentQuestionCount].text }}</h5>
            <div v-if="questions[currentQuestionCount].type === 'Multiple Choice'">
              <div v-for="(option, index) in questions[currentQuestionCount].options" :key="index">
                <label>
                  <input type="radio" :value="option.text" v-model="questions[currentQuestionCount].student_answer" />
                  {{ option.text }}
                </label>
              </div>
            </div>
            <div v-else class="mt-5">
              <editor v-model="questions[currentQuestionCount].student_answer"
                api-key="6g685dmceoqy8iip7a7dfmn0z3u4m9k1iwt89isp9jai9yy6" :init="{
                  theme: 'silver',
                  height: 600,
                  plugins: plugins,
                  toolbar: toolbar,
                  content_style: content_style,
                }" />
            </div>
            <button @click="submitAssesment()" class="btn btn-sm btn-danger mt-3 pull-right ml-1"
              :title="__('Finish Test')">{{ __('Finish') }}</button>
            <button class="btn btn-sm btn-primary mt-3 pull-right ml-1"
              @click="currentQuestionCount = questions.length - 1" :title="__('Last Question')"><i
                class="fa fa-step-forward"></i></button>
            <button class="btn btn-sm btn-primary mt-3 pull-right ml-1"
              @click="submitAndGoNext(questions[currentQuestionCount])" :title="__('Next')"><i
                class="fa fa-caret-right"></i></button>
            <button class="btn btn-sm btn-primary mt-3 pull-right" @click="goToPrevQuestion"
              :disabled="currentQuestionCount === 0" :title="__('Previus')"><i class="fa fa-caret-left"></i></button>
            <button class="btn btn-sm btn-primary mt-3 pull-right mr-1" @click="currentQuestionCount = 0"
              :title="__('First Question')"><i class="fa fa-step-backward"></i></button>
          </div>
          <div v-else>
            <h2 class="text-danger">{{ __('Warning') }}</h2>
            <p>{{ __('Please make sure the following before FINISHING the exam') }}.</p>
            <ul>
              <li>. {{ __('You have attempted maximum number of questions') }}.</li>
              <li>. {{ __('All the solved questions have been reviwed carefully') }}.</li>
            </ul>
            <button @click="submitAssesment" class="btn btn-sm btn-danger pull-right ml-1"
              title="Finish Test">Finish</button>
            <button class="btn btn-sm btn-primary pull-right" @click="goToLastQuestion"
              :disabled="currentQuestionCount === 0">{{ __('Back') }}</button>
          </div>
        </div>
        <div v-else>
          <p>{{ __("Time's up") }} !</p>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Sidebar from "@/Pages/Student/Layout/Sidebar.vue";
import Layout from "@/Pages/Student/Layout/Layout.vue";
import PageMainHeader from "@/Pages/Student/Layout/PageMainHeader.vue";
import PageHeader from "@/Pages/Student/Layout/PageHeader.vue";
import { Link, Head } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import { ref, computed, onMounted } from 'vue'
import Editor from "@tinymce/tinymce-vue";
import Swal from "sweetalert2";
import axios from 'axios';

export default {
  props: {
    questions: Object,
    assessment: Object,
  },
  components: {
    Link,
    Head,
    Layout,
    Sidebar,
    Editor,
    PageHeader,
    PageMainHeader,
  },
  setup(props) {
    onMounted(() => {

      timeLeft.value = props.assessment.time_limit_in_minutes * 60 - props.assessment.status.time_spent * 60;
      setInterval(() => {
        timeLeft.value -= 1
        timeInMinutes.value = convertSecondsToMinutesAndSeconds(timeLeft.value)
      }, 1000)

      history.pushState(null, document.title, location.href);
      window.addEventListener('popstate', function (event) {
        history.pushState(null, document.title, location.href);
      });
    });

    const convertSecondsToMinutesAndSeconds = (seconds) => {
      if (seconds !== undefined) {
        var minutes = Math.floor(seconds / 60);
        var remainingSeconds = Math.round(seconds) % 60;
        var time = minutes.toString().padStart(2, '0') + ':' + remainingSeconds.toString().padStart(2, '0');
        return time;
      }

      return 0;
    };

    const plugins = [
      "advlist",
      "autolink",
      "lists",
      "link",
      "image",
      "charmap",
      "preview",
      "anchor",
      "searchreplace",
      "visualblocks",
      "code",
      "fullscreen",
      "insertdatetime",
      "media",
      "table",
      "wordcount",
      "visualchars",
    ];
    const toolbar =
      "h1 h2 h3 h4 h5 h6 | undo redo | styles | bold italic underline| alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | fullscreen preview |";
    const content_style =
      "body { font-family:Helvetica,Arial,sans-serif; font-size:16px }";

    const score = ref(0)
    let questionsEnd = ref(false)
    const currentQuestionCount = ref(0)
    const timeInMinutes = ref('');
    const timeOver = ref(false)
    const submitting = ref(false)
    const questions = ref(props.questions.data);
    const timeLeft = ref(props.assessment.time_limit_in_minutes * 60)

    const isTimeOver = computed(() => timeLeft.value <= 0)

    function submitAndGoNext(question) {
      console.log(question.student_answer);

      // Close questions section when the student saved all questions
      questionsEnd.value = currentQuestionCount.value === props.questions.data.length - 1;
      
      // Go to next question
      if (currentQuestionCount.value < props.questions.data.length - 1) {
        currentQuestionCount.value++
      }
      // Increment score if it's correct.
      if (question.student_answer === question.correct_answer) {
        score.value++
      }
      // Save each answer as draft
      axios.post(route('student.assessments.store', props.assessment.id), {
        question: question,
        timeLeft: timeLeft.value,
        status: 'In Progress',
      });
    }

    function goToLastQuestion() {
      currentQuestionCount.value = props.questions.data.length - 1;
      questionsEnd.value = false;
    }

    function goToPrevQuestion() {
      currentQuestionCount.value--
    }

    const submitAssesment = async () => {
      submitting.value = true;
      try {

        const accept = await Swal.fire({
          title: 'Are you sure you want to finish the test?',
          input: 'checkbox',
          inputValue: 0,
          allowOutsideClick: false,
          inputPlaceholder:
            'Yes, I want to finish the test.',
          confirmButtonText:
            'Finish <i class="fa fa-arrow-right"></i>',
          showCancelButton: true,
          inputValidator: (result) => {
            return !result && 'Please accept if you want to finish the test.'
          }
        })
        if (accept) {
          Inertia.post(`/student/assessments/${props.assessment.id}`, {
            questions: questions.value,
            status: 'Completed',
          });
        }
      } catch (error) {
        submitting.value = false;
      }
    };

    function timerEnded() {
      timeOver.value = true
    }

    return {
      questions,
      timeLeft,
      isTimeOver,
      timeOver,
      timerEnded,
      currentQuestionCount,
      questionsEnd,
      score,
      submitAndGoNext,
      submitAssesment,
      goToPrevQuestion,
      goToLastQuestion,
      plugins, toolbar, content_style,
      timeInMinutes
    }
  },
};
</script>