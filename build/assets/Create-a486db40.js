import V from"./Sidebar-ca712a0f.js";import C from"./Layout-29cae0ca.js";import j from"./PageMainHeader-a1316194.js";import S from"./PageHeader-faacab35.js";import{_ as L,L as T,H as D,u as U,E as c,o as d,c as F,w as h,b as m,a as s,m as H,g,t as o,v as _,G as p,n,I as u,e as r,i as v,F as f}from"./app-ae2d89af.js";import{x as B}from"./main-3bec7040.js";const M={props:{subjects:Object,classes:Object,study_groups:Object,errors:Object},components:{Link:T,Head:D,Layout:C,Sidebar:V,PageHeader:S,Datepicker:B,PageMainHeader:j},setup(){return{form:U({class_id:"",study_group_id:"",subject_id:null,title:"",time_limit_in_minutes:"",start_date:new Date,end_date:new Date})}}},O={class:"container-fluid"},P={class:"row"},A={class:"col-md-12"},E={class:"card"},N={class:"card-header"},G={class:"f-w-300"},I=s("i",{class:"fa fa-book"},null,-1),q={class:"card-body"},z={class:"row"},x={class:"col-md-6"},J={class:"mb-3 row"},K={class:"col-sm-3 col-form-label"},Q={class:"col-sm-9"},R={class:"txt-danger"},W={class:"col-md-6"},X={class:"mb-3 row"},Y={class:"col-sm-3 col-form-label"},Z={class:"col-sm-9"},$=["placeholder"],ss={class:"txt-danger"},es={class:"col-md-6"},os={class:"mb-3 row"},ts={class:"col-sm-3 col-form-label"},ls={class:"col-sm-9"},is={class:"col-md-6"},as={class:"mb-3 row"},ds={class:"col-sm-3 col-form-label"},ns={class:"col-sm-9"},rs={class:"txt-danger"},_s={class:"col-md-6"},cs={class:"mb-3 row"},ms={class:"col-sm-3 col-form-label"},us={class:"col-sm-9"},vs={value:""},fs=["value"],bs={class:"txt-danger"},hs={class:"col-md-6"},gs={class:"mb-3 row"},ps={class:"col-sm-3 col-form-label"},ys={class:"col-sm-9"},ws={value:""},ks=["value"],Vs={class:"txt-danger"},Cs={class:"col-md-6"},js={class:"mb-3 row"},Ss={class:"col-sm-3 col-form-label"},Ls={class:"col-sm-9"},Ts={value:"null"},Ds=["value"],Us={class:"txt-danger"},Fs={class:"card-footer"},Hs={class:"btn btn-sm btn-primary ml-1 pull-right",type:"submit"};function Bs(t,l,i,a,Ms,Os){const y=c("PageHeader"),b=c("Datepicker"),w=c("Link"),k=c("Layout");return d(),F(k,{pageTitle:t.__("Create Assessment")},{default:h(()=>[m(y,{breadcrumb_title:t.__("Create Assessment")},null,8,["breadcrumb_title"]),s("div",O,[s("form",{class:"form theme-form",onSubmit:l[7]||(l[7]=H(e=>a.form.post(t.route("teacher.assessments.store")),["prevent"]))},[s("div",P,[s("div",A,[s("div",E,[s("div",N,[s("h5",G,[I,g(o(t.__("Create Assessment")),1)])]),s("div",q,[s("div",z,[s("div",x,[s("div",J,[s("label",K,o(t.__("Title")),1),s("div",Q,[_(s("input",{"onUpdate:modelValue":l[0]||(l[0]=e=>a.form.title=e),class:n(["form-control form-control-sm",[i.errors.title?"is-invalid":""]]),type:"text",placeholder:"Title"},null,2),[[p,a.form.title]]),s("div",R,o(i.errors.title),1)])])]),s("div",W,[s("div",X,[s("label",Y,o(t.__("Time limit"))+" ("+o(t.__("In minutes"))+")",1),s("div",Z,[_(s("input",{"onUpdate:modelValue":l[1]||(l[1]=e=>a.form.time_limit_in_minutes=e),class:n(["form-control form-control-sm",[i.errors.time_limit_in_minutes?"is-invalid":""]]),type:"number",placeholder:t.__("Enter time limit")},null,10,$),[[p,a.form.time_limit_in_minutes,void 0,{number:!0}]]),s("div",ss,o(i.errors.time_limit_in_minutes),1)])])]),s("div",es,[s("div",os,[s("label",ts,o(t.__("Schedule From")),1),s("div",ls,[m(b,{modelValue:a.form.start_date,"onUpdate:modelValue":l[2]||(l[2]=e=>a.form.start_date=e),"enable-time-picker":!1,"auto-apply":""},null,8,["modelValue"])])])]),s("div",is,[s("div",as,[s("label",ds,o(t.__("Schedule To")),1),s("div",ns,[m(b,{modelValue:a.form.end_date,"onUpdate:modelValue":l[3]||(l[3]=e=>a.form.end_date=e),class:n([i.errors.end_date?"is-invalid":""]),"enable-time-picker":!1,"auto-apply":""},null,8,["modelValue","class"]),s("div",rs,o(i.errors.end_date),1)])])]),s("div",_s,[s("div",cs,[s("label",ms,o(t.__("Class")),1),s("div",us,[_(s("select",{"onUpdate:modelValue":l[4]||(l[4]=e=>a.form.class_id=e),class:n(["form-control form-control-sm",[i.errors.class_id?"is-invalid":""]]),id:"exampleFormControlSelect31"},[s("option",vs,"("+o(t.__("none"))+")",1),(d(!0),r(f,null,v(i.classes,e=>(d(),r("option",{value:e.id,key:e.id},o(e.name),9,fs))),128))],2),[[u,a.form.class_id]]),s("div",bs,o(i.errors.class_id),1)])])]),s("div",hs,[s("div",gs,[s("label",ps,o(t.__("Study Group")),1),s("div",ys,[_(s("select",{"onUpdate:modelValue":l[5]||(l[5]=e=>a.form.study_group_id=e),class:n(["form-control form-control-sm",[i.errors.study_group_id?"is-invalid":""]]),id:"exampleFormControlSelect31"},[s("option",ws,"("+o(t.__("none"))+")",1),(d(!0),r(f,null,v(i.study_groups,e=>(d(),r("option",{value:e.id,key:e.id},o(e.name),9,ks))),128))],2),[[u,a.form.study_group_id]]),s("div",Vs,o(i.errors.study_group_id),1)])])]),s("div",Cs,[s("div",js,[s("label",Ss,o(t.__("Subject")),1),s("div",Ls,[_(s("select",{"onUpdate:modelValue":l[6]||(l[6]=e=>a.form.subject_id=e),class:n(["form-control btn-square digits",[i.errors.subject_id?"is-invalid":""]]),id:"subject"},[s("option",Ts,"("+o(t.__("none"))+")",1),(d(!0),r(f,null,v(i.subjects,e=>(d(),r("option",{value:e.id,key:e.id},o(e.title),9,Ds))),128))],2),[[u,a.form.subject_id]]),s("div",Us,o(i.errors.subject_id),1)])])])])]),s("div",Fs,[s("button",Hs,o(t.__("Submit")),1),m(w,{href:t.route("teacher.assessments.index"),class:"btn btn-sm btn-light pull-right"},{default:h(()=>[g(o(t.__("Cancel")),1)]),_:1},8,["href"])])])])])],32)])]),_:1},8,["pageTitle"])}const qs=L(M,[["render",Bs]]);export{qs as default};
