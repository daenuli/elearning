<template>
    <Layout :pageTitle="__('Start Assessment')">
        <PageHeader :breadcrumb_title="''" />
        <div class="container-fluid">
            <form class="form theme-form" @submit.prevent="form.post(route('student.students.store'))">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div v-if="assessmentStatus === 'Not Started'">
                                    <p>{{ __('Dear student') }},</p>
                                    <p>{{ __('Welcome to the assessment! To ensure that you have a smooth and successful experience, please take note of the following instructions') }}:</p>
                                    <ol>
                                        <li>{{ __('Read each question carefully: Each question has multiple options, so make sure to read each option carefully before selecting your answer') }}</li>
                                        <li>{{ __('Answer all questions: There is no penalty for incorrect answers, so make sure to answer every question even if you are unsure of the correct answer') }}.</li>
                                        <li>{{ __('Use process of elimination: If you are unsure about the correct answer, try to eliminate the options that you are sure are incorrect to narrow down your choices') }}.</li>
                                        <li>{{ __('Manage your time: You will have a set amount of time to complete the assessment, so make sure to keep track of your time and pace yourself accordingly') }}.</li>
                                        <li>{{ __('Avoid distractions: Find a quiet and distraction-free environment to take the assessment. Close any unnecessary tabs on your computer and turn off your phone to minimize distractions') }}.</li>
                                    </ol>
                                    <p>{{ __('We hope that these instructions help you prepare for the assessment. Good luck') }}!</p>
                                </div>
                                <div v-else-if="assessmentStatus === 'In Progress'">
                                    <h4>{{ __('Your exam was intrupted') }}.</h4>
                                    <p>{{ __("It appears that your assessment was interrupted due to a power outage or other technical issue. We recommend reviewing any previously completed questions before submitting assessment to ensure that your progress has been saved before continuing. If you experience any further issues, please don't hesitate to reach out to your teacher for assistance") }}.</p>
                                </div>
                                <Link v-if="!assessment.is_completed"
                                    :href="route('student.assessments.start', assessment.id)"
                                    class="btn btn-primary pull-right">
                                {{ assessmentStatus === 'Not Started' ? __('Start Assessment') : __('Continue to assessment') }}
                                </Link>
                                <Link v-if="assessmentStatus === 'Not Started'" :href="route('student.assessments.index')"
                                    class="btn btn-danger pull-right mr-1">
                                {{ __('Cancel') }}
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </Layout>
</template>
<script>
import Sidebar from "@/Pages/Student/Layout/Sidebar.vue";
import Layout from "@/Pages/Student/Layout/Layout.vue";
import PageMainHeader from "@/Pages/Student/Layout/PageMainHeader.vue";
import PageHeader from "@/Pages/Student/Layout/PageHeader.vue";
import { Link, Head } from "@inertiajs/inertia-vue3";
import Datepicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";

export default {
    props: {
        assessment: Object,
        assessmentStatus: String,
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
};
</script>