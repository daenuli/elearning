<template>
  <Layout :pageTitle="__('Books')">
    <PageHeader />
    <div class="container-fluid">
      <Message />
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h5 class="f-w-300"><i class="fa fa-book"></i> {{ __('Books') }}</h5>
            </div>
            <div class="card-body btn-group-wrapper">
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3 row">
                    <label class="col-sm-5 col-form-label"><b>{{ __('FilterBy Class') }}</b></label>
                    <div class="col-sm-7">
                      <select v-model="class_id" @change="search" class="form-control form-control-sm"
                        id="exampleFormControlSelect31">
                        <option value=""> ({{ __('All Classes') }})</option>
                        <option :value="school_class.id" v-for="school_class in classes" :key="school_class.id">
                          {{ school_class.name }}
                        </option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
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
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="table-responsive">
                    <table class="table table-sm">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">{{ __('Title') }}</th>
                          <th scope="col">{{ __('Subject') }}</th>
                          <th scope="col">{{ __('Class') }}</th>
                          <th scope="col">{{ __('Book') }}</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="(book, index) in bookList" :key="book.id">
                          <th scope="row">{{ index + 1 }}</th>
                          <td>{{ book.title }}</td>
                          <td>{{ book.subject.title }}</td>
                          <td>{{ book.school_class.name }}</td>
                          <td>
                            <Link :href="route('student.books.show', book.id)
                              " class="btn btn-info btn-xs">
                            <i class="fa fa-book"></i>
                            </Link>
                          </td>
                          <div class="modal fade" :class="`bookFile${book.id}`" tabindex="-1" role="dialog"
                            aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title" id="myLargeModalLabel">
                                    {{ book.title }}
                                  </h4>
                                </div>
                                <div class="modal-body">
                                  <embed v-if="book.file_path" :src="book.file_path" width="100%" height="600px" />
                                  <p v-else class="text-center"><i>{{ __('File not found') }}.</i></p>
                                </div>
                                <div class="modal-footer">
                                  <a v-bind:disabled="!book.file_path" :href="route('student.books.download', book.id)"
                                    :class="{ 'disabled': !book.file_path }" class="btn btn-success">
                                    <i class="fa fa-download"></i> {{ __('Download') }}
                                  </a>
                                  <button data-bs-dismiss="modal" class="btn btn-light">
                                    {{ __('Close') }}
                                  </button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </tr>
                      </tbody>
                    </table>
                    <p class="text-center mt-3" v-if="!bookList.length">
                      {{ __('No books found') }}.
                    </p>
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
import Sidebar from "@/Pages/Student/Layout/Sidebar.vue";
import Layout from "@/Pages/Student/Layout/Layout.vue";
import PageMainHeader from "@/Pages/Student/Layout/PageMainHeader.vue";
import PageHeader from "@/Pages/Student/Layout/PageHeader.vue";
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
  name: "student-layout",
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

    let class_id = ref('');
    let subject_id = ref('');

    const search = () => {

      if (!subject_id && !class_id) {
        bookList.value = props.books;
      }

      axios.get(route('student.books.search'), { params: { class_id: class_id.value, subject_id: subject_id.value } }).then(response => {
        bookList.value = [];
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
          Inertia.delete(route("student.books.destroy", book.id));
        }
      });
    };
    return { destroy, search, class_id, subject_id, bookList };
  },
};
</script>