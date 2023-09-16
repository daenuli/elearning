<template>
	<Layout pageTitle="Home">
		<PageHeader />
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-4">
					<Link :href="route('admin.teachers.index')">
					<div class="card">
						<div class="card-body">
							<div class="media feather-main">
								<div class="feather-icon-block">
									<svg fill="#fff" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
										xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
										viewBox="0 0 489.38 489.38" style="enable-background: new 0 0 489.38 489.38"
										xml:space="preserve">
										<g id="XMLID_129_">
											<path id="XMLID_134_" d="M473.725,5.656H213.576c-8.655,0-15.655,7.022-15.655,15.664v110.484l11.319-13.234
				                  		c5.375-6.292,12.461-10.172,19.992-11.793V36.978h228.836v204.531H229.233v-34.238l-7.05,8.244
				                  		c-6.161,7.189-14.858,11.65-24.262,12.529v29.124c0,8.642,7,15.655,15.655,15.655h84.489L255.141,467.7
				                  		c-1.923,8.739,3.6,17.382,12.346,19.31c8.667,1.904,17.382-3.601,19.287-12.331l44.457-201.855h25.844l44.457,201.855
				                  		c1.666,7.557,8.369,12.714,15.803,12.705c1.154,0,2.334-0.117,3.502-0.374c8.746-1.928,14.268-10.57,12.328-19.31l-42.92-194.877
				                  		h83.481c8.647,0,15.655-7.013,15.655-15.655V21.32C489.38,12.678,482.372,5.656,473.725,5.656z" />
											<path id="XMLID_132_"
												d="M349.368,97.116c-1.234-3.11-4.732-4.637-7.84-3.406l-92.234,32.555
				                  		c-8.465-6.554-20.678-5.383-27.737,2.827l-29.267,34.178l-25.951-22.245c0.171,1.837,0.56,3.622,0.56,5.507v48.291l14.438,12.371
				                  		c8.568,7.338,21.385,6.204,28.549-2.198l34.842-40.743l28.1-16.439l73.951-43.267C349.336,103.073,350.469,99.923,349.368,97.116z" />
											<path id="XMLID_131_"
												d="M109.928,105.776H92.547c-13.308,0-25.01,6.468-32.448,16.327l-53.352,49.12
				                  		c-8.313,7.405-9.067,20.232-1.581,28.595l43.528,48.585c7.421,8.309,20.267,9.044,28.579,1.576
				                  		c8.334-7.469,9.038-20.262,1.57-28.586l-30.003-33.504l42.616-38.134l-24.82,33.721l24.279,27.107
				                  		c13.416,14.992,12.151,38.027-2.834,51.453c-10.231,9.172-24.193,11.324-36.297,7.094c0,0,0.188,93.659,0.188,193.962
				                  		c0,13.416,10.874,24.291,24.291,24.291c13.403,0,24.291-10.875,24.291-24.291c0-100.272,0-43.051,0-144.771h16.203
				                  		c0,101.646,0,44.468,0,144.771c0,7.004-1.953,13.49-5.067,19.231c4.076,3.135,9.148,5.06,14.676,5.06
				                  		c13.424,0,24.298-10.875,24.298-24.291c0-100.272,0.031-58.237,0.031-316.561C150.697,124.022,132.45,105.776,109.928,105.776z" />
											<path id="XMLID_130_" d="M79.592,91.198c6.495,3.376,13.787,5.471,21.62,5.471c7.853,0,15.145-2.095,21.659-5.477
				                  		c15.204-7.877,25.684-23.559,25.684-41.862c0-26.146-21.196-47.335-47.344-47.335c-26.144,0-47.335,21.189-47.335,47.335
				                  		C53.877,67.643,64.368,83.331,79.592,91.198z" />
										</g>
									</svg>
								</div>
								<div class="media-body align-self-center">
									<h6>{{ __("Teachers") }}</h6>
									<p>{{ teachers_count }}</p>
								</div>
							</div>
						</div>
					</div>
					</Link>
				</div>
				<div class="col-md-4">
					<Link :href="route('admin.students.index')">
					<div class="card">
						<div class="card-body">
							<div class="media feather-main">
								<div class="feather-icon-block">
									<svg fill="#fff" width="800px" height="800px" viewBox="0 0 64 64"
										xmlns="http://www.w3.org/2000/svg" stroke-width="3" stroke="#fff">
										<path
											d="M48.61,56.07A16.61,16.61,0,0,0,32,39.45h0A16.61,16.61,0,0,0,15.39,56.07Z" />
										<path
											d="M39.41,28a8.11,8.11,0,0,1-8.25,8.1,8.28,8.28,0,0,1-7.95-8.37V16.45a.06.06,0,0,1,.05-.06,60.56,60.56,0,0,1,8.27-.68,54.93,54.93,0,0,1,7.91.68.06.06,0,0,1,.06.06Z" />
										<path
											d="M23.21,20.14l-8.27-3.8a.08.08,0,0,1,0-.13L31.32,8.39h.06l16.33,7.74a.07.07,0,0,1,0,.12L39.5,20.14" />
										<path d="M23.21,24.35H20.89s-2,0-2,3.1c0,2.86,2,2.86,2,2.86l2.72,0" />
										<path d="M39.41,24.71h2.32s2,0,2,3.09c0,2.86-2,2.86-2,2.86H39" />
										<line x1="46.85" y1="33.15" x2="46.85" y2="16.72" />
										<circle cx="46.85" cy="35.28" r="2.13" />
										<path d="M39.5,23a42.89,42.89,0,0,0-7.95-.69,40.85,40.85,0,0,0-8.34.69" />
									</svg>
								</div>
								<div class="media-body align-self-center">
									<h6>{{ __("Students") }}</h6>
									<p>{{ students_count }}</p>
								</div>
							</div>
						</div>
					</div>
					</Link>
				</div>
				<div class="col-md-4">
					<Link :href="route('admin.study-groups.index')">
					<div class="card">
						<div class="card-body">
							<div class="media feather-main">
								<div class="feather-icon-block">
									<svg fill="#fff" width="800px" height="800px" viewBox="0 0 36 36" version="1.1"
										preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg"
										xmlns:xlink="http://www.w3.org/1999/xlink">
										<title>group-solid</title>
										<path class="clr-i-solid clr-i-solid-path-1"
											d="M12,16.14q-.43,0-.87,0a8.67,8.67,0,0,0-6.43,2.52l-.24.28v8.28H8.54v-4.7l.55-.62.25-.29a11,11,0,0,1,4.71-2.86A6.59,6.59,0,0,1,12,16.14Z">
										</path>
										<path class="clr-i-solid clr-i-solid-path-2"
											d="M31.34,18.63a8.67,8.67,0,0,0-6.43-2.52,10.47,10.47,0,0,0-1.09.06,6.59,6.59,0,0,1-2,2.45,10.91,10.91,0,0,1,5,3l.25.28.54.62v4.71h3.94V18.91Z">
										</path>
										<path class="clr-i-solid clr-i-solid-path-3"
											d="M11.1,14.19c.11,0,.2,0,.31,0a6.45,6.45,0,0,1,3.11-6.29,4.09,4.09,0,1,0-3.42,6.33Z">
										</path>
										<path class="clr-i-solid clr-i-solid-path-4"
											d="M24.43,13.44a6.54,6.54,0,0,1,0,.69,4.09,4.09,0,0,0,.58.05h.19A4.09,4.09,0,1,0,21.47,8,6.53,6.53,0,0,1,24.43,13.44Z">
										</path>
										<circle class="clr-i-solid clr-i-solid-path-5" cx="17.87" cy="13.45" r="4.47">
										</circle>
										<path class="clr-i-solid clr-i-solid-path-6"
											d="M18.11,20.3A9.69,9.69,0,0,0,11,23l-.25.28v6.33a1.57,1.57,0,0,0,1.6,1.54H23.84a1.57,1.57,0,0,0,1.6-1.54V23.3L25.2,23A9.58,9.58,0,0,0,18.11,20.3Z">
										</path>
										<rect x="0" y="0" width="36" height="36" fill-opacity="0" />
									</svg>
								</div>
								<div class="media-body align-self-center">
									<h6>{{ __("Study Groups") }}</h6>
									<p>{{ study_groups_count }}</p>
								</div>
							</div>
						</div>
					</div>
					</Link>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<Link :href="route('admin.school-classes.index')">
					<div class="card">
						<div class="card-body">
							<div class="media feather-main">
								<div class="feather-icon-block">
									<svg fill="#fff" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
										xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 488 488"
										style="enable-background: new 0 0 488 488" xml:space="preserve">
										<g transform="translate(0 -540.36)">
											<g>
												<g>
													<path d="M183,682.51c5.5,0,10-4.5,10-10v-10.6h9.8c5.5,0,10-4.5,10-10s-4.4-10-10-10H193v-9.9c0-5.5-4.5-10-10-10s-10,4.5-10,10
				        				v9.9h-9.8c-5.5,0-10,4.5-10,10s4.5,10,10,10h9.8v10.6C173,678.01,177.5,682.51,183,682.51z" />
													<path d="M100.1,662.61h-8.4c-5.5,0-10,4.5-10,10s4.5,10,10,10h40.4c5.5,0,10-4.5,10-10c-0.1-5.6-4.6-10.1-10.1-10.1v0h-1.6
				        				c3.8-11.1,1.1-23-7.3-31.4c-8.2-8.2-21.6-11.3-34.1-7.9c-5.3,1.5-8.5,7-7,12.3s7,8.5,12.3,7c5.5-1.5,11.5-0.4,14.7,2.8
				        				c3,3,3.9,7,2.5,11C109.4,660.01,104.8,662.61,100.1,662.61z" />
													<path
														d="M264.6,702.41c5.5,0,10-4.5,10-10v-9.9c5.5,0,9.9-4.5,9.9-10s-4.4-9.9-9.9-10v-9.9c0-5.5-4.5-10-10-10s-10,4.5-10,10v9.9
				        				h-10.5v-30.5c0-5.5-4.5-10-10-10s-10,4.5-10,10v40.5c0,5.5,4.5,10,10,10h20.5v9.9C254.6,697.91,259.1,702.41,264.6,702.41z" />
													<path
														d="M40.4,784.11h254.5v10.6c0,5.5,4.5,10,10,10h122c5.5,0,10-4.5,10-10v-81c0-5.4-4.4-9.9-10-9.9v0c-5.5,0-10,4.5-10,10v71
				        				h-102v-71c0-3.6-1.9-6.9-5-8.7c-3.1-1.8-6.9-1.8-10,0l-44.4,25.9l-14.4-14.4c-3.9-3.9-10.2-3.9-14.1,0c-3.9,3.9-3.9,10.2,0,14.1
				        				l19.8,19.9c3.2,3.2,8.2,3.9,12.1,1.6l36-21v32.9H50.4v-193.9l295.4-0.1l0.1,46.5c-12.3,7-20.6,20.2-20.6,35.3
				        				c0,22.4,18.2,40.6,40.5,40.6s40.5-18.2,40.5-40.6c0-22.3-18.1-40.5-40.4-40.6l-0.1-51.2c0-5.5-4.5-10-10-10l-315.4,0.1
				        				c-5.5,0-10,4.5-10,10v213.9c0,2.7,1.1,5.2,2.9,7.1C35.2,783.11,37.7,784.11,40.4,784.11z M365.9,631.31
				        				c11.3,0,20.5,9.3,20.5,20.6s-9.2,20.6-20.5,20.6s-20.5-9.2-20.5-20.6C345.4,640.51,354.6,631.31,365.9,631.31z" />
													<path
														d="M30.5,886.41c0,22.4,18.2,40.6,40.5,40.6s40.5-18.2,40.5-40.6c0-22.4-18.2-40.6-40.5-40.6S30.5,864.01,30.5,886.41z
				        				 M91.5,886.51c0,11.4-9.2,20.6-20.5,20.6s-20.5-9.3-20.5-20.6c0-11.4,9.2-20.6,20.5-20.6S91.5,875.11,91.5,886.51z" />
													<path d="M132,927.61c-5.5,0-10,4.5-10,10v61H20v-61c0-5.5-4.5-10-10-10s-10,4.5-10,10v71c0,5.5,4.5,10,10,10h122
				        				c5.5,0,10-4.4,10-10v-71C142,932.11,137.5,927.61,132,927.61z" />
													<path
														d="M376.5,886.41c0,22.4,18.2,40.6,40.5,40.6s40.5-18.2,40.5-40.6c0-22.4-18.2-40.6-40.5-40.6S376.5,864.01,376.5,886.41z
				        				 M437.5,886.51c0,11.4-9.2,20.6-20.5,20.6s-20.5-9.3-20.5-20.6c0-11.4,9.2-20.6,20.5-20.6S437.5,875.11,437.5,886.51z" />
													<path d="M478,927.61c-5.5,0-10,4.5-10,10v61H366v-61c0-5.5-4.5-10-10-10s-10,4.5-10,10v71c0,5.5,4.5,10,10,10h122
				        				c5.5,0,10-4.4,10-10v-71C488,932.11,483.5,927.61,478,927.61z" />
													<path
														d="M203.5,886.41c0,22.4,18.2,40.6,40.5,40.6s40.5-18.2,40.5-40.6c0-22.4-18.2-40.6-40.5-40.6S203.5,864.01,203.5,886.41z
				        				 M264.5,886.51c0,11.4-9.2,20.6-20.5,20.6s-20.5-9.3-20.5-20.6c0-11.4,9.2-20.6,20.5-20.6S264.5,875.11,264.5,886.51z" />
													<path d="M305,927.61c-5.5,0-10,4.5-10,10v61H193v-61c0-5.5-4.5-10-10-10s-10,4.5-10,10v71c0,5.5,4.5,10,10,10h122
				        				c5.5,0,10-4.4,10-10v-71C315,932.11,310.5,927.61,305,927.61z" />
												</g>
											</g>
										</g>
									</svg>
								</div>
								<div class="media-body align-self-center">
									<h6>{{ __("Classes") }}</h6>
									<p>{{ school_classes_count }}</p>
								</div>
							</div>
						</div>
					</div>
					</Link>
				</div>
				<div class="col-md-4">
					<Link :href="route('admin.subjects.index')">
					<div class="card">
						<div class="card-body">
							<div class="media feather-main">
								<div class="feather-icon-block">
									<svg fill="#fff" width="800px" height="800px" viewBox="0 0 24 24"
										xmlns="http://www.w3.org/2000/svg">
										<path
											d="M13,16H3a1,1,0,0,0,0,2H13a1,1,0,0,0,0-2ZM3,8H21a1,1,0,0,0,0-2H3A1,1,0,0,0,3,8Zm18,3H3a1,1,0,0,0,0,2H21a1,1,0,0,0,0-2Z" />
									</svg>
								</div>
								<div class="media-body align-self-center">
									<h6>{{ __("Subjects") }}</h6>
									<p>{{ subjects_count }}</p>
								</div>
							</div>
						</div>
					</div>
					</Link>
				</div>
				<div class="col-md-4">
					<Link :href="route('admin.books.index')">
					<div class="card">
						<div class="card-body">
							<div class="media feather-main">
								<div class="feather-icon-block">
									<svg width="800px" height="800px" viewBox="0 0 24 24" fill="none"
										xmlns="http://www.w3.org/2000/svg">
										<path
											d="M2 6C2 6 3.5 4 7 4C10.5 4 12 6 12 6V20C12 20 10.5 19 7 19C3.5 19 2 20 2 20V6Z"
											stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
										<path
											d="M12 6C12 6 13.5 4 17 4C20.5 4 22 6 22 6V20C22 20 20.5 19 17 19C13.5 19 12 20 12 20V6Z"
											stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
									</svg>
								</div>
								<div class="media-body align-self-center">
									<h6>{{ __("Books") }}</h6>
									<p>{{ books_count }}</p>
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
import Sidebar from "@/Pages/Admin/Layout/Sidebar.vue";
import Layout from "@/Pages/Admin/Layout/Layout.vue";
import PageMainHeader from "@/Pages/Admin/Layout/PageMainHeader.vue";
import PageHeader from "@/Pages/Admin/Layout/PageHeader.vue";
export default {
	props: {
		teachers_count: Number,
		students_count: Number,
		study_groups_count: Number,
		school_classes_count: Number,
		books_count: Number,
		subjects_count: Number,
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