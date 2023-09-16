<template>
  <div class="page-main-header">
    <div class="main-header-right row">
      <div class="main-header-left d-lg-none">
        <div class="logo-wrapper"><a href="index.html" data-original-title="" title=""><img src="" alt=""
              data-original-title="" title=""></a></div>
      </div>
      <div class="mobile-sidebar d-block">
        <div class="media-body text-right switch-sm">
          <label class="switch"><a href="#" data-original-title="" title=""><svg xmlns="http://www.w3.org/2000/svg"
                width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round" class="feather feather-align-left" @click="openNav()"
                id="sidebar-toggle">
                <line x1="17" y1="10" x2="3" y2="10"></line>
                <line x1="21" y1="6" x2="3" y2="6"></line>
                <line x1="21" y1="14" x2="3" y2="14"></line>
                <line x1="17" y1="18" x2="3" y2="18"></line>
              </svg></a></label>
        </div>
      </div>
      <div class="nav-right col p-0">
        <ul class="nav-menus">
          <li class="text-center">
            <span class="h2" style=" margin-bottom:0px !important;">{{ __('Learning Management System') }}</span>
          </li>
          <li class="onhover-dropdown"><a class="txt-dark" href="#" data-original-title="" title="">
              <h6>{{ $page.props.user.locale === 'en' ? 'EN' : 'ID' }}</h6>
            </a>
            <ul class="language-dropdown onhover-show-div p-20">
              <li><a @click="setLocale('en')" href="#" data-lng="en" data-original-title="" title=""><i
                    class="flag-icon flag-icon-is"></i>
                  English</a></li>
              <li><a @click="setLocale('id')" href="#" data-lng="id" data-original-title="" title=""><i
                    class="flag-icon flag-icon-id"></i>
                  Indonesian</a></li>
            </ul>
          </li>
          <li><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()" data-original-title="" title=""><svg
                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="feather feather-maximize">
                <path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3">
                </path>
              </svg></a></li>
          <!-- <li class="onhover-dropdown"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
              fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
              class="feather feather-bell">
              <path d="M22 17H2a3 3 0 0 0 3-3V9a7 7 0 0 1 14 0v5a3 3 0 0 0 3 3zm-8.27 4a2 2 0 0 1-3.46 0"></path>
            </svg><span class="dot"></span>
            <ul class="notification-dropdown onhover-show-div">
              <li>Notification <span class="badge badge-pill badge-primary pull-right">3</span></li>
              <li>
                <div class="media">
                  <div class="media-body">
                    <h6 class="mt-0"><span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                          viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                          stroke-linejoin="round" class="feather feather-shopping-bag shopping-color">
                          <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                          <line x1="3" y1="6" x2="21" y2="6"></line>
                          <path d="M16 10a4 4 0 0 1-8 0"></path>
                        </svg></span>Your order ready for Ship..!<small class="pull-right">9:00
                        AM</small></h6>
                    <p class="mb-0">Lorem ipsum dolor sit amet, consectetuer.</p>
                  </div>
                </div>
              </li>
              <li class="bg-light txt-dark"><a href="#" data-original-title="" title="">All</a> notification</li>
            </ul>
          </li> -->
          <li class="onhover-dropdown">
            <div class="media align-items-center"><img class="align-self-center pull-right img-50 rounded-circle"
                :src="$page.props.user_avatar" alt="header-user" data-original-title="" title="">
              <div class="dotted-animation"><span class="animate-circle"></span><span class="main-circle"></span>
              </div>
            </div>
            <ul class="profile-dropdown onhover-show-div p-20">
              <li>
                <a type="button" @click="logout()" href="#" data-original-title="" title=""><svg
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-log-out">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                    <polyline points="16 17 21 12 16 7"></polyline>
                    <line x1="21" y1="12" x2="9" y2="12"></line>
                  </svg> Logout</a>
              </li>
            </ul>
          </li>
        </ul>

        <div class="d-lg-none mobile-toggle pull-right"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round" class="feather feather-more-horizontal">
            <circle cx="12" cy="12" r="1"></circle>
            <circle cx="19" cy="12" r="1"></circle>
            <circle cx="5" cy="12" r="1"></circle>
          </svg></div>
      </div>
    </div>
  </div>
</template>
<script>
import DropdownLink from '@/Components/DropdownLink.vue';
import image from "@/assets/img/team-1-800x800.jpg";
import { Inertia } from "@inertiajs/inertia";
export default {
  data() {
    return {
      image: image,
      locale: document.head.querySelector('meta[name="locale"]').content
    };
  },
  methods: {
    openNav() {
      $nav = $('.page-sidebar');
      $header = $('.page-main-header');
      $toggle_nav_top = $('#sidebar-toggle');
      $nav = $('.page-sidebar');
      $nav.toggleClass('open');
      $header.toggleClass('open');
    },
    logout: function () {
      Inertia.post(route("logout"));
    },
    setLocale: function (locale) {
      axios.post(route("locale.update"), { locale: locale }).then(() => {
        window.location.reload();
      });
    },
  },
  components: {
    DropdownLink,
  },
};
</script>