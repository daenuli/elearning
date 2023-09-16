<template>
	<Layout :pageTitle="__('Multiple Choice Questions')">
		<PageHeader :breadcrumb_title="__('Multiple Choice Questions')" />
		<div class="container-fluid">
			<form class="form theme-form">
				<div class="card">
					<div class="card-header">
						<h5 class="f-w-300">{{ __('Create Questions') }}</h5>
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
											<input class="form-control form-control-sm-height" style="height: 42px !important" type="text" v-model="question.text" :class="[
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
									<input class="m-t-40" type="file" multiple :class="[errors.file ? 'is-invalid' : '']"
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
							<div class="form-group row">
								<div class="col-sm-2 pt-2">
									<input type="radio" v-model="question.correctOption" value="optionA" />
								</div>
								<div class="col-sm-2">
									<input class="form-control form-control-sm" v-model="question.optionA" type="text" :class="[
										errors[`questions.${index}.optionA`]
											? 'is-invalid'
											: '',
									]" :placeholder="__('Option A')" />
									<div class="txt-danger">
										{{ errors[`questions.${index}.optionA`] }}
									</div>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-sm-2 pt-2">
									<input  type="radio" v-model="question.correctOption" value="optionB" />
								</div>
								<div class="col-sm-2">
									<input class="form-control form-control-sm" v-model="question.optionB" type="text" :class="[
										errors[`questions.${index}.optionB`]
											? 'is-invalid'
											: '',
									]" :placeholder="__('Option B')" />
									<div class="txt-danger">
										{{ errors[`questions.${index}.optionB`] }}
									</div>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-sm-2 pt-2">
									<input type="radio" v-model="question.correctOption" value="optionC" />
								</div>
								<div class="col-sm-2">
									<input class="form-control form-control-sm" v-model="question.optionC" type="text" :class="[
										errors[`questions.${index}.optionC`]
											? 'is-invalid'
											: '',
									]" :placeholder="__('Option C')" />
									<div class="txt-danger">
										{{ errors[`questions.${index}.optionC`] }}
									</div>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-sm-2 pt-2">
									<input type="radio" v-model="question.correctOption" value="optionD" />
								</div>
								<div class="col-sm-2">
									<input class="form-control form-control-sm" v-model="question.optionD" type="text" :class="[
										errors[`questions.${index}.optionD`]
											? 'is-invalid'
											: '',
									]" :placeholder="__('Option D')" />
									<div class="txt-danger">
										{{ errors[`questions.${index}.optionD`] }}
									</div>
								</div>
								<div class="row mt-3">
									<div class="col-">
										<div class="txt-danger">
											{{ errors[`questions.${index}.correctOption`] }}
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer">
						<button type="button" @click="submitQuestions" class="btn btn-success pull-right">
							{{ __('Save') }}
						</button>
						<Link :href="
							route(
								'teacher.assessments.questions.index',
								assessment.id
							)
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
			{ text: "", optionA: "", optionB: "", optionC: "", optionD: "" },
		]);
		const addQuestion = () => {
			questions.value.push({
				text: "",
				optionA: "",
				optionB: "",
				optionC: "",
				optionD: "",
			});
		};

		const deleteQuestion = (index) => {
			questions.value.splice(index, 1);
		};

		const submitQuestions = async () => {
			submitting.value = true;
			try {
				Inertia.post(`/teacher/assessments/${props.assessment.id}/questions`, {
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