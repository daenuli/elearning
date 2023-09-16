import C from"./Sidebar-826486d8.js";import w from"./PageMainHeader-cf474ae0.js";import L from"./Layout-5c71fb0f.js";import S from"./PageHeader-77eb4629.js";import{_ as M,L as B,H as N,u as F,z as G,E as h,o as r,c as H,w as g,b as u,a as s,e as _,t,f,g as c,i as V,n as m,m as O,v as p,G as v,F as P}from"./app-31c25c41.js";import{h as j}from"./moment-fbc5633a.js";const T={props:{students:Object,assignment:Object,errors:Object},components:{Link:B,Head:N,Layout:L,Sidebar:C,PageHeader:S,PageMainHeader:w,moment:j},setup(){const e=F({id:null,marks:0}),n=d=>!d.status.is_completed,i=d=>d.status.is_graded,o=d=>({badge:!0,"badge-success":i(d),"badge-danger":!i(d)});function b(d){e.id=d.id,e.marks=d.status.marks_obtained}return G.Inertia.on("success",d=>{e.marks=0,$(`#gradeAssignment${e.id}`).modal("hide")}),{form:e,setForm:b,isAssignmentCompleted:n,isAssignmentGraded:i,getBadgeClass:o}}},E={class:"container-fluid mt-3"},I={key:0,class:"alert alert-success",role:"alert"},q={class:"row"},z={class:"col-sm-12"},D={class:"card"},U={class:"card-header"},Y={class:"f-w-300"},J=s("i",{class:"fa fa-book"},null,-1),K={class:"card-header-right"},Q=["href"],R=s("i",{class:"fa fa-cloud-download white"},null,-1),W=s("i",{class:"fa fa-caret-left white"},null,-1),X={class:"table-responsive mt-3"},Z={class:"table table-sm"},x={scope:"col"},ss={scope:"col"},es={scope:"col"},ts={scope:"col"},as={scope:"col"},os={scope:"col"},is={scope:"col"},ds=["data-bs-target"],ns=s("i",{class:"fa fa-file-pdf-o"},null,-1),ls=[ns],rs=["disabled","data-bs-target","onClick"],cs=s("i",{class:"fa fa-check-square"},null,-1),ms=["id","aria-labelledby"],_s={class:"modal-dialog modal-dialog-centered",role:"document"},hs={class:"modal-content"},bs=["onSubmit"],gs={class:"modal-header"},us=["id"],fs=s("i",{class:"fa fa-star"},null,-1),ps=s("button",{class:"close",type:"button","aria-label":"Close","data-bs-dismiss":"modal"},[s("span",{"aria-hidden":"true"},"×")],-1),vs={class:"modal-body"},ks={class:"mb-3 row"},ys={class:"col-sm-4 col-form-label"},As={class:"col-sm-8"},Cs={class:"txt-danger"},ws={class:"modal-footer"},Ls={class:"btn btn-light",type:"button","data-bs-dismiss":"modal"},Ss={class:"btn btn-primary",type:"submit"},Ms=["id"],Bs={class:"modal-dialog modal-xl"},Ns={class:"modal-content"},Fs={class:"modal-header"},Gs=["id"],Hs=s("br",null,null,-1),Vs={class:"modal-body"},Os=["src"],Ps={class:"modal-footer"},js={"data-bs-dismiss":"modal",class:"btn btn-light"};function Ts(e,n,i,o,b,d){const k=h("PageHeader"),y=h("Link"),A=h("Layout");return r(),H(A,{pageTitle:e.__("Assignment Submissions")},{default:g(()=>[u(k,{breadcrumb_title:e.__("Assignment Submissions")},null,8,["breadcrumb_title"]),s("div",E,[e.$page.props.flash.success?(r(),_("div",I,[s("p",null,t(e.$page.props.flash.success),1)])):f("",!0),s("div",q,[s("div",z,[s("div",D,[s("div",U,[s("h5",Y,[J,c(" "+t(i.assignment.title),1)]),s("p",null,t(i.assignment.subject.title),1),s("div",K,[s("a",{href:e.route("teacher.export.assignments",i.assignment.id),class:"btn btn-success btn-sm mr-2"},[R,c(" "+t(e.__("Export")),1)],8,Q),u(y,{href:e.route("teacher.evaluation.assignments"),class:"btn btn-info btn-sm mr-2 white"},{default:g(()=>[W,c(t(e.__("Back")),1)]),_:1},8,["href"])])]),s("div",X,[s("table",Z,[s("thead",null,[s("tr",null,[s("th",x,t(e.__("Student Name")),1),s("th",ss,t(e.__("Submitted")),1),s("th",es,t(e.__("Submitted At")),1),s("th",ts,t(e.__("File")),1),s("th",as,t(e.__("Marks Obtained")),1),s("th",os,t(e.__("Is Graded")),1),s("th",is,t(e.__("Actions")),1)])]),s("tbody",null,[(r(!0),_(P,null,V(i.students,a=>(r(),_("tr",{key:a.id},[s("td",null,t(a.name),1),s("td",null,[s("span",{class:m(["badge",a.status.is_completed?"badge-success":"badge-danger"])},t(a.status.is_completed?"Yes":"No"),3)]),s("td",null,t(a.status.submitted_at_date),1),s("td",null,[o.isAssignmentCompleted(a)?f("",!0):(r(),_("button",{key:0,class:"btn btn-xs btn-primary",type:"button","data-bs-toggle":"modal","data-bs-target":`.student-${a.id}-assignment`},ls,8,ds))]),s("td",null,t(a.status.marks_obtained),1),s("td",null,[s("span",{class:m(o.getBadgeClass(a))},t(o.isAssignmentGraded(a)?"Yes":"No"),3)]),s("td",null,[s("button",{class:m(["btn btn-primary btn-sm",{disabled:o.isAssignmentCompleted(a)}]),disabled:o.isAssignmentCompleted(a),type:"button","data-bs-toggle":"modal","data-bs-target":`#gradeAssignment${a.id}`,onClick:l=>o.setForm(a)},[cs,c(" "+t(e.__("Grade Assignment")),1)],10,rs)]),s("div",{class:"modal fade",id:`gradeAssignment${a.id}`,tabindex:"-1",role:"dialog","aria-labelledby":`gradeAssignment${a.id}`,"aria-hidden":"true"},[s("div",_s,[s("div",hs,[s("form",{class:"form theme-form",onSubmit:O(l=>o.form.post(e.route("teacher.evaluation.assignment.grade",a.status.id)),["prevent"])},[p(s("input",{type:"hidden","onUpdate:modelValue":n[0]||(n[0]=l=>o.form.id=l)},null,512),[[v,o.form.id]]),s("div",gs,[s("h5",{class:"modal-title",id:`gradeAssignment${a.id}Modal`},[fs,c(" "+t(e.__("Grade Assignment")),1)],8,us),ps]),s("div",vs,[s("div",ks,[s("label",ys,t(e.__("Marks Obtained")),1),s("div",As,[p(s("input",{"onUpdate:modelValue":n[1]||(n[1]=l=>o.form.marks=l),class:m(["form-control form-control-sm",[i.errors.marks?"is-invalid":""]]),required:"",type:"text"},null,2),[[v,o.form.marks]]),s("div",Cs,t(i.errors.marks),1)])])]),s("div",ws,[s("button",Ls,t(e.__("Cancel")),1),s("button",Ss,t(e.__("Save")),1)])],40,bs)])])],8,ms),s("div",{class:m(["modal fade",`student-${a.id}-assignment`]),id:`student-${a.id}-assignment`,tabindex:"-1",role:"dialog","aria-labelledby":"myLargeModalLabel","aria-hidden":"true"},[s("div",Bs,[s("div",Ns,[s("div",Fs,[s("h4",{class:"modal-title",id:`student${a.id}AssignmentModal`},t(i.assignment.title),9,Gs),Hs,s("span",null,t(a.name),1)]),s("div",Vs,[s("embed",{src:a.status.filePathLabel,width:"100%",height:"700px"},null,8,Os)]),s("div",Ps,[s("button",js,t(e.__("Close")),1)])])])],10,Ms)]))),128))])])])])])])])]),_:1},8,["pageTitle"])}const Ys=M(T,[["render",Ts]]);export{Ys as default};