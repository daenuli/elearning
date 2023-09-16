<template>
  <Layout :pageTitle="__('Books')">
    <PageHeader :breadcrumb_title="__('Books')" />
    <div class="container-fluid">
      <Message />
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h5 class="f-w-300"><i class="fa fa-book"></i> {{ __('Books') }}</h5>
              <div class="card-header-right">
                <Link :href="route('admin.books.create')" class="btn btn-light btn-sm">
                <i class="fa fa-plus"></i>
                {{ __('Create') }}
                </Link>
              </div>
            </div>
            <div class="card-body btn-group-wrapper">
              <div class="row">
                <div class="col-md-4">
                  <div class="mb-3 row">
                    <label class="col-sm-5 col-form-label"><b>{{ __('FilterBy Class') }}</b></label>
                    <div class="col-sm-7">
                      <select v-model="class_id" @change="search" class="form-control form-control-sm" id="FilterByClass">
                        <option value=""> ({{ __('All Classes') }})</option>
                        <option :value="school_class.id" v-for="school_class in classes" :key="school_class.id">
                          {{ school_class.name }}
                        </option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="mb-3 row">
                    <label class="col-sm-5 col-form-label"><b>{{ __('FilterBy Subject') }}</b></label>
                    <div class="col-sm-7">
                      <select v-model="subject_id" @change="search" class="form-control form-control-sm"
                        id="FilterBySubject">
                        <option value=""> ({{ __('All Subjects') }})</option>
                        <option :value="subject.id" v-for="subject in subjects" :key="subject.id">
                          {{ subject.title }}
                        </option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="mb-3 row">
                    <label class="col-sm-5 col-form-label"><b>{{ __('Title') }}</b></label>
                    <div class="col-sm-7">
                      <input v-model="title" @input="search" class="form-control form-control-sm" type="text"
                        :placeholder="__('Title')" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-12">
                  <div class="table-responsive">
                    <table class="table table-sm">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">{{ __('Title') }}</th>
                          <th scope="col">{{ __('Subject') }}</th>
                          <th scope="col">{{ __('Class') }}</th>
                          <th scope="col">{{ __('Book') }}</th>
                          <th scope="col">{{ __('Actions') }}</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="(book, index) in bookList" :key="book.id">
                          <th scope="row">{{ index + 1 }}</th>
                          <td>{{ book.title }}</td>
                          <td>{{ book.subject.title }}</td>
                          <td>{{ book.school_class.name }}</td>
                          <td>
                            <Link :href="
                              route('admin.books.show', book.id)
                            " class="btn btn-info btn-xs">
                            <i class="fa fa-book"></i>
                            </Link>
                          </td>
                          <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                              <Link :href="
                                route('admin.books.edit', book.id)
                              " class="btn btn-info btn-xs">
                              <i class="fa fa-pencil"></i>
                              </Link>
                              <button @click="destroy(book)" class="btn btn-danger btn-xs">
                                <i class="fa fa-trash"></i>
                              </button>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </Layout>
</template>
<script>
import Sidebar from "@/Pages/Admin/Layout/Sidebar.vue";
import Layout from "@/Pages/Admin/Layout/Layout.vue";
import PageMainHeader from "@/Pages/Admin/Layout/PageMainHeader.vue";
import PageHeader from "@/Pages/Admin/Layout/PageHeader.vue";
import { Link, Head } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import Swal from "sweetalert2";
import moment from "moment";
import { ref, onMounted } from "vue";

export default {
  props: {
    subjects: Object,
    classes: Object,
    books: Object,
  },
  name: "admin-layout",
  components: {
    Link,
    Head,
    Layout,
    Sidebar,
    PageHeader,
    PageMainHeader,
    moment,
  },
  methods: {
    forramttedDate: function (date) {
      return moment(date).format("MMM D YYYY");
    },
  },
  setup(props) {
    let bookList = ref(props.books);

    onMounted(() => {
      bookList.value = props.books;
    });

    let title = ref('');
    let class_id = ref('');
    let subject_id = ref('');
    
    const search = () => {
      bookList.value = [];
      axios.get(route('admin.books.search'), { params: { class_id: class_id.value, subject_id: subject_id.value, title: title.value } }).then(response => {
        bookList.value = response.data;
      });
    };

    const destroy = (book) => {
      Swal.fire({
        title: "Are you sure?",
        text: `Do you want to delete book ${book.title}?`,
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete!",
      }).then((result) => {
        if (result.isConfirmed) {
          Inertia.delete(route("admin.books.destroy", book.id));
        }
      });
    };
    return { destroy, subject_id, class_id, title, search, bookList };
  },
};
</script>