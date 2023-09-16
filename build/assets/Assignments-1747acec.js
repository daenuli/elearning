import{h as S}from"./moment-fbc5633a.js";import{_ as w,L as B,H as A,d as r,E as h,o as n,c as C,w as p,b as y,a as s,t,v as b,I as v,e as i,i as _,F as u,g as f}from"./app-ae2d89af.js";import L from"./Layout-29cae0ca.js";import H from"./Sidebar-ca712a0f.js";import V from"./PageHeader-faacab35.js";import F from"./PageMainHeader-a1316194.js";const D={props:{subjects:Object,classes:Object,assignments:Object,study_groups:Object},components:{Link:B,Head:A,Layout:L,Sidebar:H,PageHeader:V,PageMainHeader:F,moment:S},setup(l){let a=r(""),d=r(""),o=r(""),c=r(l.assignments);return{search:()=>{axios.get(route("teacher.evaluation.assignments.search"),{params:{class_id:a.value,subject_id:d.value,study_group_id:o.value}}).then(m=>{c.value=[],c.value=m.data})},class_id:a,subject_id:d,study_group_id:o,submittedAssignments:c}}},G={class:"container-fluid mt-3"},N={class:"row"},O={class:"col-md-4"},P={class:"mb-3 row"},T={class:"col-sm-5 col-form-label"},U={class:"col-sm-7"},E={value:""},M=["value"],I={class:"col-md-4"},q={class:"mb-3 row"},z={class:"col-sm-5 col-form-label"},J={class:"col-sm-7"},K={value:""},Q=["value"],R={class:"col-md-4"},W={class:"mb-3 row"},X={class:"col-sm-5 col-form-label"},Y={class:"col-sm-7"},Z={value:""},x=["value"],$={key:0,class:"row mt-3"},ss={class:"card"},es={class:"card-body"},ts={class:"media"},os={class:"mb-0",style:{color:"gray"}},ls={class:"text-danger"},as={class:"project-widgets text-center"},ns={class:"font-primary counter"},is={class:"card-footer project-footer",style:{display:"flex","justify-content":"space-between"}},ds={class:"mb-0"},cs={class:"counter"},rs={class:"mb-0"},_s={class:"counter"},us={key:1,class:"row mt-5"},ms={class:"col-md-12"},hs={class:"text-center"};function bs(l,a,d,o,c,g){const m=h("PageHeader"),j=h("Link"),k=h("Layout");return n(),C(k,{pageTitle:l.__("Student Assignments")},{default:p(()=>[y(m,{breadcrumb_title:l.__("Student Assignments")},null,8,["breadcrumb_title"]),s("div",G,[s("div",N,[s("div",O,[s("div",P,[s("label",T,[s("b",null,t(l.__("FilterBy Class")),1)]),s("div",U,[b(s("select",{"onUpdate:modelValue":a[0]||(a[0]=e=>o.class_id=e),onChange:a[1]||(a[1]=(...e)=>o.search&&o.search(...e)),class:"form-control form-control-sm",id:"filterByClass"},[s("option",E," ("+t(l.__("All Classes"))+")",1),(n(!0),i(u,null,_(d.classes,e=>(n(),i("option",{value:e.id,key:e.id},t(e.name),9,M))),128))],544),[[v,o.class_id]])])])]),s("div",I,[s("div",q,[s("label",z,[s("b",null,t(l.__("FilterBy Study Group")),1)]),s("div",J,[b(s("select",{"onUpdate:modelValue":a[2]||(a[2]=e=>o.study_group_id=e),onChange:a[3]||(a[3]=(...e)=>o.search&&o.search(...e)),class:"form-control form-control-sm",id:"filterByStudyGroup"},[s("option",K," ("+t(l.__("All Study Groups"))+")",1),(n(!0),i(u,null,_(d.study_groups,e=>(n(),i("option",{value:e.id,key:e.id},t(e.name),9,Q))),128))],544),[[v,o.study_group_id]])])])]),s("div",R,[s("div",W,[s("label",X,[s("b",null,t(l.__("FilterBy Subject")),1)]),s("div",Y,[b(s("select",{"onUpdate:modelValue":a[4]||(a[4]=e=>o.subject_id=e),onChange:a[5]||(a[5]=(...e)=>o.search&&o.search(...e)),class:"form-control form-control-sm",id:"filterBySubject"},[s("option",Z," ("+t(l.__("All Subjects"))+")",1),(n(!0),i(u,null,_(d.subjects,e=>(n(),i("option",{value:e.id,key:e.id},t(e.title),9,x))),128))],544),[[v,o.subject_id]])])])])]),o.submittedAssignments.length?(n(),i("div",$,[(n(!0),i(u,null,_(o.submittedAssignments,e=>(n(),i("div",{class:"col-sm-3",key:e.id},[s("div",ss,[y(j,{href:l.route("teacher.evaluation.student.assignments",e.id)},{default:p(()=>[s("div",es,[s("div",ts,[s("p",os,t(l.__("Due Date"))+": ",1),f(),s("span",ls," "+t(e.due_date_label),1)]),s("div",as,[s("h6",ns,[s("b",null,t(e.title),1)]),s("p",null,t(e.subject.title),1)])]),s("div",is,[s("h6",ds,[s("b",null,t(l.__("Class"))+":",1),f(),s("span",cs,[s("b",null,t(e.class.name),1)])]),s("h6",rs,[s("b",null,t(l.__("Study Group"))+":",1),f(),s("span",_s,[s("b",null,t(e.study_group.name),1)])])])]),_:2},1032,["href"])])]))),128))])):(n(),i("div",us,[s("div",ms,[s("p",hs,[s("i",null,t(l.__("No assignments found"))+".",1)])])]))])]),_:1},8,["pageTitle"])}const ks=w(D,[["render",bs]]);export{ks as default};
