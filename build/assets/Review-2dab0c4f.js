import x from"./Sidebar-ca712a0f.js";import H from"./PageMainHeader-a1316194.js";import T from"./Layout-29cae0ca.js";import O from"./PageHeader-faacab35.js";import{_ as S,L as V,H as B,u as E,z as j,E as _,o as t,c as N,w as p,b as g,a as s,e as a,t as d,f as c,g as b,i as u,F as h,n as y,m as P,v as k,G as w}from"./app-ae2d89af.js";import{h as Q}from"./moment-fbc5633a.js";const F={props:{assessment:Object,questions:Object,studentAssessment:Object,errors:Object},components:{Link:V,Head:B,Layout:T,Sidebar:x,PageHeader:O,PageMainHeader:H,moment:Q},setup(r){const i=(l,f)=>l.answer.student_choice_id===f.id,o=l=>l.is_correct,n=E({id:null,marks:r.studentAssessment.marks_obtained});return j.Inertia.on("success",l=>{$("#gradeAssessment").modal("hide")}),{form:n,isStudentChoiceCorrect:i,isCorrectChoice:o}}},G={class:"container-fluid mt-3"},q={key:0,class:"alert alert-success",role:"alert"},z={key:1,class:"alert alert-danger",role:"alert"},D={class:"row"},U={class:"col-md-12"},I={class:"card"},K={class:"card-body"},R={class:"row"},J={class:"col-md-6"},W={class:"col-md-6"},X=s("button",{class:"btn btn-primary btn-sm pull-right",type:"button","data-bs-toggle":"modal","data-bs-target":"#gradeAssessment"}," Grade Assessment ",-1),Y=s("i",{class:"fa fa-caret-left white"},null,-1),Z={class:"row mt-5"},ss={class:"col-md-12"},es={key:0},ts={class:"mt-3"},as={class:"col-md-12"},os={class:"card"},ns=s("div",{class:"card-header"},[s("h3",null,"Essay Questions")],-1),ds={class:"card-body"},rs={key:0,class:"row mt-5 b-b-info border-1"},is={class:"col-md-12"},ls=["innerHTML"],cs={key:1,class:"text-danger mb-5"},ms=s("i",null,"The student has not provided an answer to this essay question",-1),_s=[ms],us={class:"modal fade",id:"gradeAssessment",tabindex:"-1",role:"dialog","aria-labelledby":"gradeAssessment","aria-hidden":"true"},hs={class:"modal-dialog modal-lg modal-dialog-centered",role:"document"},bs={class:"modal-content"},fs=s("div",{class:"modal-header"},[s("h5",{class:"modal-title",id:"gradeAssessmentModal"},[s("i",{class:"fa fa-star"}),b(" Grade Assessment ")]),s("button",{class:"close",type:"button","aria-label":"Close","data-bs-dismiss":"modal"},[s("span",{"aria-hidden":"true"},"×")])],-1),vs={class:"modal-body"},ps=s("div",{class:"alert alert-info alert-dismissible fade show",role:"alert"},"To streamline the grading process, please note that only the essay questions require manual grading. The multiple choice questions will be graded automatically. Kindly evaluate the essay questions below. ",-1),gs={class:"mb-3 row"},ys=s("label",{class:"col-sm-5 col-form-label"},"Marks Obtained (Only Essay Questions)",-1),ks={class:"col-sm-7"},ws={class:"txt-danger"},Cs=s("div",{class:"modal-footer"},[s("button",{class:"btn btn-light",type:"button","data-bs-dismiss":"modal"}," Cancel "),s("button",{class:"btn btn-primary",type:"submit"},"Save")],-1);function As(r,i,o,n,l,f){const C=_("PageHeader"),A=_("Link"),L=_("Layout");return t(),N(L,{pageTitle:"Assessments"},{default:p(()=>[g(C,{breadcrumb_title:""}),s("div",G,[r.$page.props.flash.success?(t(),a("div",q,[s("p",null,d(r.$page.props.flash.success),1)])):c("",!0),r.$page.props.flash.error?(t(),a("div",z,[s("p",null,d(r.$page.props.flash.error),1)])):c("",!0),s("div",D,[s("div",U,[s("div",I,[s("div",K,[s("div",R,[s("div",J,[s("h4",null,[s("b",null,d(o.assessment.title),1)]),b(" Marks Obtained: "+d(o.studentAssessment.marks_obtained),1)]),s("div",W,[X,g(A,{class:"btn btn-success mr-1 pull-right",href:r.route("teacher.evaluation.student.assessments",o.assessment.id)},{default:p(()=>[Y,b(" Back")]),_:1},8,["href"])])]),s("div",Z,[s("div",ss,[(t(!0),a(h,null,u(o.questions,(e,M)=>(t(),a("div",{key:M},[e.type==="Multiple Choice"?(t(),a("div",es,[s("p",null,"Q: "+d(e.text),1),s("ol",ts,[(t(!0),a(h,null,u(e.choices,(m,v)=>(t(),a("li",{key:v},[s("span",{class:y({"badge badge-info":n.isCorrectChoice(m),"badge badge-success":n.isStudentChoiceCorrect(e,m)})},d(String.fromCharCode(65+v))+". "+d(m.text),3)]))),128))])])):c("",!0)]))),128))])])])])]),s("div",as,[s("div",os,[ns,s("div",ds,[(t(!0),a(h,null,u(o.questions,e=>(t(),a("div",{key:e.id},[e.type==="Essay"?(t(),a("div",rs,[s("div",is,[s("p",null,"Q: "+d(e.text),1),e.answer.essay_answer_text?(t(),a("p",{key:0,class:"mt-5 mb-5",innerHTML:e.answer.essay_answer_text},null,8,ls)):(t(),a("p",cs,_s))])])):c("",!0)]))),128))])])])]),s("div",us,[s("div",hs,[s("div",bs,[s("form",{class:"form theme-form",onSubmit:i[2]||(i[2]=P(e=>n.form.post(r.route("teacher.evaluation.student.assessment.grade",o.studentAssessment.id)),["prevent"]))},[k(s("input",{type:"hidden","onUpdate:modelValue":i[0]||(i[0]=e=>n.form.id=e)},null,512),[[w,n.form.id]]),fs,s("div",vs,[ps,s("div",gs,[ys,s("div",ks,[k(s("input",{"onUpdate:modelValue":i[1]||(i[1]=e=>n.form.marks=e),class:y(["form-control form-control-sm",[o.errors.marks?"is-invalid":""]]),required:"",type:"text"},null,2),[[w,n.form.marks]]),s("div",ws,d(o.errors.marks),1)])])]),Cs],32)])])])])]),_:1})}const Ss=S(F,[["render",As]]);export{Ss as default};
