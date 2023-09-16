import C from"./Sidebar-ca712a0f.js";import w from"./PageMainHeader-a1316194.js";import x from"./Layout-29cae0ca.js";import L from"./PageHeader-faacab35.js";import{_ as S,L as M,H as B,u as N,z as F,E as b,o as c,c as G,w as g,b as u,a as s,e as _,t as d,f,g as r,i as H,n as m,m as V,v as p,G as v,F as O}from"./app-ae2d89af.js";import{h as P}from"./moment-fbc5633a.js";const j={props:{students:Object,assignment:Object,errors:Object},components:{Link:M,Head:B,Layout:x,Sidebar:C,PageHeader:L,PageMainHeader:w,moment:P},setup(){const a=N({id:null,marks:0}),n=i=>!i.status.is_completed,o=i=>i.status.is_graded,e=i=>({badge:!0,"badge-success":o(i),"badge-danger":!o(i)});function h(i){a.id=i.id,a.marks=i.status.marks_obtained}return F.Inertia.on("success",i=>{a.marks=0,$(`#gradeAssignment${a.id}`).modal("hide")}),{form:a,setForm:h,isAssignmentCompleted:n,isAssignmentGraded:o,getBadgeClass:e}}},E={class:"container-fluid mt-3"},I={key:0,class:"alert alert-success",role:"alert"},T={class:"row"},q={class:"col-sm-12"},z={class:"card"},D={class:"card-header"},U={class:"f-w-300"},Y=s("i",{class:"fa fa-book"},null,-1),J={class:"card-header-right"},K=["href"],Q=s("i",{class:"fa fa-cloud-download white"},null,-1),R=s("i",{class:"fa fa-caret-left white"},null,-1),W={class:"table-responsive mt-3"},X={class:"table table-sm"},Z=s("thead",null,[s("tr",null,[s("th",{scope:"col"},"Student Name"),s("th",{scope:"col"},"Submitted"),s("th",{scope:"col"},"Submitted At"),s("th",{scope:"col"},"File"),s("th",{scope:"col"},"Marks Obtained"),s("th",{scope:"col"},"Is Graded"),s("th",{scope:"col"},"Actions")])],-1),ss=["data-bs-target"],ts=s("i",{class:"fa fa-file-pdf-o"},null,-1),es=[ts],as=["disabled","data-bs-target","onClick"],os=s("i",{class:"fa fa-check-square"},null,-1),is=["id","aria-labelledby"],ds={class:"modal-dialog modal-dialog-centered",role:"document"},ns={class:"modal-content"},ls=["onSubmit"],cs={class:"modal-header"},rs=["id"],ms=s("i",{class:"fa fa-star"},null,-1),_s=s("button",{class:"close",type:"button","aria-label":"Close","data-bs-dismiss":"modal"},[s("span",{"aria-hidden":"true"},"×")],-1),bs={class:"modal-body"},hs={class:"mb-3 row"},gs=s("label",{class:"col-sm-4 col-form-label"},"Marks Obtained",-1),us={class:"col-sm-8"},fs={class:"txt-danger"},ps=s("div",{class:"modal-footer"},[s("button",{class:"btn btn-light",type:"button","data-bs-dismiss":"modal"}," Cancel "),s("button",{class:"btn btn-primary",type:"submit"}," Save ")],-1),vs=["id"],ks={class:"modal-dialog modal-xl"},ys={class:"modal-content"},As={class:"modal-header"},Cs=["id"],ws=s("br",null,null,-1),xs={class:"modal-body"},Ls=["src"],Ss=s("div",{class:"modal-footer"},[s("button",{"data-bs-dismiss":"modal",class:"btn btn-light"}," Close ")],-1);function Ms(a,n,o,e,h,i){const k=b("PageHeader"),y=b("Link"),A=b("Layout");return c(),G(A,{pageTitle:"Assignment Submissions"},{default:g(()=>[u(k,{breadcrumb_title:"Assignment Submissions"}),s("div",E,[a.$page.props.flash.success?(c(),_("div",I,[s("p",null,d(a.$page.props.flash.success),1)])):f("",!0),s("div",T,[s("div",q,[s("div",z,[s("div",D,[s("h5",U,[Y,r(" "+d(o.assignment.title),1)]),s("p",null,d(o.assignment.subject.title),1),s("div",J,[s("a",{href:a.route("teacher.export.assignments",o.assignment.id),class:"btn btn-success btn-sm mr-2"},[Q,r(" Export ")],8,K),u(y,{href:a.route("teacher.evaluation.assignments"),class:"btn btn-info btn-sm mr-2 white"},{default:g(()=>[R,r("Back")]),_:1},8,["href"])])]),s("div",W,[s("table",X,[Z,s("tbody",null,[(c(!0),_(O,null,H(o.students,t=>(c(),_("tr",{key:t.id},[s("td",null,d(t.name),1),s("td",null,[s("span",{class:m(["badge",t.status.is_completed?"badge-success":"badge-danger"])},d(t.status.is_completed?"Yes":"No"),3)]),s("td",null,d(t.status.submitted_at_date),1),s("td",null,[e.isAssignmentCompleted(t)?f("",!0):(c(),_("button",{key:0,class:"btn btn-xs btn-primary",type:"button","data-bs-toggle":"modal","data-bs-target":`.student-${t.id}-assignment`},es,8,ss))]),s("td",null,d(t.status.marks_obtained),1),s("td",null,[s("span",{class:m(e.getBadgeClass(t))},d(e.isAssignmentGraded(t)?"Yes":"No"),3)]),s("td",null,[s("button",{class:m(["btn btn-primary btn-sm",{disabled:e.isAssignmentCompleted(t)}]),disabled:e.isAssignmentCompleted(t),type:"button","data-bs-toggle":"modal","data-bs-target":`#gradeAssignment${t.id}`,onClick:l=>e.setForm(t)},[os,r(" Grade Assignment ")],10,as)]),s("div",{class:"modal fade",id:`gradeAssignment${t.id}`,tabindex:"-1",role:"dialog","aria-labelledby":`gradeAssignment${t.id}`,"aria-hidden":"true"},[s("div",ds,[s("div",ns,[s("form",{class:"form theme-form",onSubmit:V(l=>e.form.post(a.route("teacher.evaluation.assignment.grade",t.status.id)),["prevent"])},[p(s("input",{type:"hidden","onUpdate:modelValue":n[0]||(n[0]=l=>e.form.id=l)},null,512),[[v,e.form.id]]),s("div",cs,[s("h5",{class:"modal-title",id:`gradeAssignment${t.id}Modal`},[ms,r(" Grade Assignment ")],8,rs),_s]),s("div",bs,[s("div",hs,[gs,s("div",us,[p(s("input",{"onUpdate:modelValue":n[1]||(n[1]=l=>e.form.marks=l),class:m(["form-control form-control-sm",[o.errors.marks?"is-invalid":""]]),required:"",type:"text"},null,2),[[v,e.form.marks]]),s("div",fs,d(o.errors.marks),1)])])]),ps],40,ls)])])],8,is),s("div",{class:m(["modal fade",`student-${t.id}-assignment`]),id:`student-${t.id}-assignment`,tabindex:"-1",role:"dialog","aria-labelledby":"myLargeModalLabel","aria-hidden":"true"},[s("div",ks,[s("div",ys,[s("div",As,[s("h4",{class:"modal-title",id:`student${t.id}AssignmentModal`},d(o.assignment.title),9,Cs),ws,s("span",null,d(t.name),1)]),s("div",xs,[s("embed",{src:t.status.filePathLabel,width:"100%",height:"700px"},null,8,Ls)]),Ss])])],10,vs)]))),128))])])])])])])])]),_:1})}const Os=S(j,[["render",Ms]]);export{Os as default};
