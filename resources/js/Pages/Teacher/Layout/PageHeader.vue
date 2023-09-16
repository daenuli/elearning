<template>
  <div class="page-header" style="padding-bottom:0px !important">
    <div class="row">
      <div class="col">
        <div class="page-header-left">
          <h4 class="mb-3">{{ breadcrumb_title }}</h4>
        </div>
      </div>
      <!-- Bookmark Start-->
      <div class="col">
        <div class="bookmark pull-right">
          <ul>
            <li>
              <a
                href="#"
                data-bs-toggle="tooltip"
                title="Calender"
                data-bs-original-title="Calendar"
                ><i data-feather="calendar"></i
              ></a>
            </li>
            <li>
              <a
                href="#"
                data-bs-toggle="tooltip"
                title="Mail"
                data-bs-original-title="Mail"
                ><i data-feather="mail"></i
              ></a>
            </li>
            <li>
              <a
                href="#"
                data-bs-toggle="tooltip"
                title="Chat"
                data-bs-original-title="Chat"
                ><i data-feather="message-square"></i
              ></a>
            </li>
            <li>
              <a href="javascript:void(0)"
                ><i class="bookmark-search" data-feather="star"></i
              ></a>
              <form class="form-inline search-form">
                <div class="form-group form-control-search">
                  <input type="text" placeholder="Search.." />
                </div>
              </form>
            </li>
          </ul>
        </div>
      </div>
      <!-- Bookmark Ends-->
    </div>
  </div>
</template>
<script>
import image from "@/assets/img/team-1-800x800.jpg";
export default {
  props: ["breadcrumb_title"],
  data() {
    return {
      image: image,
    };
  },
};
</script>