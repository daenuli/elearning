<template>
  <Layout pageTitle="Home" :avatar="avatar">
    <PageHeader :breadcrumb_title="__('Home')" />
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-4">
          <Link :href="route('teacher.lessons.index')">
          <div class="card">
            <div class="card-body">
              <div class="media feather-main">
                <div class="feather-icon-block">
                  <svg fill="#fff" width="800px" height="800px" viewBox="0 -8 528 528" xmlns="http://www.w3.org/2000/svg">
                    <title>video</title>
                    <path
                      d="M264 456Q211 456 164 429 118 402 91 356 64 310 64 256 64 202 91 156 118 110 164 83 210 56 264 56 318 56 364 83 410 110 437 156 464 202 464 256 464 309 437 356 410 402 364 429 318 456 264 456ZM345 256L216 160 216 352 345 256Z" />
                  </svg>
                </div>
                <div class="media-body align-self-center">
                  <h6>{{ __('Lessons') }}</h6>
                  <p>{{ lessons_count }}</p>
                </div>
              </div>
            </div>
          </div>
          </Link>
        </div>

        <div class="col-md-4">
          <Link :href="route('teacher.assignments.index')">
          <div class="card">
            <div class="card-body">
              <div class="media feather-main">
                <div class="feather-icon-block">
                  <svg fill="#fff" width="800px" height="800px" viewBox="0 0 1920 1920"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M1468.214 0v551.145L840.27 1179.089c-31.623 31.623-49.693 74.54-49.693 119.715v395.289h395.288c45.176 0 88.093-18.07 119.716-49.694l162.633-162.633v438.206H0V0h1468.214Zm129.428 581.3c22.137-22.136 57.825-22.136 79.962 0l225.879 225.879c22.023 22.023 22.023 57.712 0 79.848l-677.638 677.637c-10.616 10.503-24.96 16.49-39.98 16.49H903.516v-282.35c0-15.02 5.986-29.364 16.49-39.867Zm-920.005 548.095H338.82v112.94h338.818v-112.94Zm225.88-225.879H338.818v112.94h564.697v-112.94Zm734.106-202.5-89.561 89.56 146.03 146.031 89.562-89.56-146.031-146.031Zm-508.228-362.197H338.82v338.818h790.576V338.82Z"
                      fill-rule="evenodd" />
                  </svg>
                </div>
                <div class="media-body align-self-center">
                  <h6>{{ __('Assignments') }}</h6>
                  <p>{{ assignments_count }}</p>
                </div>
              </div>
            </div>
          </div>
          </Link>
        </div>
        <div class="col-md-4">
          <Link :href="route('teacher.assessments.index')">
          <div class="card">
            <div class="card-body">
              <div class="media feather-main">
                <div class="feather-icon-block">
                  <svg fill="#fff" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="28.621px" height="28.621px"
                    viewBox="0 0 28.621 28.621" style="enable-background: new 0 0 28.621 28.621" xml:space="preserve">
                    <g>
                      <path d="M14.311,0c-6.904,0-12.5,5.596-12.5,12.5c0,4.723,2.618,8.828,6.48,10.955l-0.147,5.166l5.898-3.635
            		C14.131,24.988,14.22,25,14.311,25c6.904,0,12.5-5.596,12.5-12.5C26.811,5.596,21.215,0,14.311,0z M13.75,20.018
            		c-1.116,0-1.876-0.822-1.876-1.918c0-1.119,0.779-1.92,1.876-1.92c1.14,0,1.878,0.801,1.898,1.92
            		C15.649,19.193,14.891,20.018,13.75,20.018z M16.301,12.173c-0.779,0.865-1.096,1.686-1.074,2.638v0.377h-2.805L12.4,14.641
            		c-0.063-1.074,0.295-2.173,1.246-3.31c0.673-0.803,1.223-1.477,1.223-2.194c0-0.737-0.487-1.222-1.542-1.263
            		c-0.693,0-1.539,0.251-2.084,0.632l-0.718-2.301c0.759-0.442,2.022-0.861,3.52-0.861c2.785,0,4.048,1.538,4.048,3.289
            		C18.094,10.233,17.104,11.287,16.301,12.173z" />
                    </g>
                  </svg>
                </div>
                <div class="media-body align-self-center">
                  <h6>{{ __('Assessments') }}</h6>
                  <p>{{ assessments_count }}</p>
                </div>
              </div>
            </div>
          </div>
          </Link>
        </div>
      </div>
    </div>
  </Layout>
</template>
<script>
import { Link, Head } from "@inertiajs/inertia-vue3";
import Sidebar from "@/Pages/Teacher/Layout/Sidebar.vue";
import Layout from "@/Pages/Teacher/Layout/Layout.vue";
import PageMainHeader from "@/Pages/Teacher/Layout/PageMainHeader.vue";
import PageHeader from "@/Pages/Teacher/Layout/PageHeader.vue";
export default {
  props: {
    avatar: String | Boolean,
    lessons_count: Number,
    assignments_count: Number,
    assessments_count: Number,
  },
  name: "admin-layout",
  components: {
    Link,
    Head,
    Layout,
    Sidebar,
    PageHeader,
    PageMainHeader,
  },
};
</script>