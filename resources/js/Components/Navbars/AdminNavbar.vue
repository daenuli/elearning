<template>
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item d-none d-sm-inline-block">
            <form @submit.prevent="logout">
            <DropdownLink as="button">
                Log Out
            </DropdownLink>
        </form>
          <!-- <a href="#" class="nav-link">Logout</a> -->
        </li>
      </ul>
    </nav>

  <!-- End Navbar -->
</template>

<script>
import image from "@/assets/img/team-1-800x800.jpg";
import UserDropdown from "@/components/Dropdowns/UserDropdown.vue";
import DropdownLink from '@/Components/DropdownLink.vue';
import { Inertia } from '@inertiajs/inertia';

export default {
  components: {
    DropdownLink,
    UserDropdown,
  },
  data() {
    return {
      image: image,
    };
  },
  methods: {
    logout: function() {
        Inertia.post(route('logout'));
    }
  }
};
</script>
