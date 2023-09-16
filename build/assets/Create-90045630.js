import D from"./Sidebar-ca712a0f.js";import F from"./Layout-29cae0ca.js";import U from"./PageMainHeader-a1316194.js";import H from"./PageHeader-faacab35.js";import{_ as T,L as O,H as q,u as B,E as c,o as d,c as E,w as y,b as _,a as s,m as M,g as p,t,v as m,G as k,n as r,e as n,f as w,i as u,F as f,I as b}from"./app-ae2d89af.js";import{x as N}from"./main-3bec7040.js";import{E as P}from"./Editor-72357907.js";const z={props:{subjects:Object,classes:Object,study_groups:Object,errors:Object},components:{Link:O,Head:q,Layout:F,Sidebar:D,Editor:P,PageHeader:H,Datepicker:N,PageMainHeader:U},setup(){const l=["advlist","autolink","lists","link","image","charmap","preview","anchor","searchreplace","visualblocks","code","fullscreen","insertdatetime","media","table","wordcount","visualchars"],i="h1 h2 h3 h4 h5 h6 | undo redo | styles | bold italic underline| alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | fullscreen preview |",a="body { font-family:Helvetica,Arial,sans-serif; font-size:16px }",e=B({class_id:"",study_group_id:"",title:"",subject_id:null,description:"",file_name:"",youtube_link:"",files:[],start_date:new Date,end_date:new Date});function h(v){e.files=v.target.files}return{form:e,uploadFiles:h,plugins:l,toolbar:i,content_style:a}}},G={class:"container-fluid"},I={class:"row"},Y={class:"col-md-12"},A={class:"card"},J={class:"card-header"},K={class:"f-w-300"},Q=s("i",{class:"fa fa-book"},null,-1),R={class:"card-body"},W={class:"row"},X={class:"col-md-6"},Z={class:"mb-3 row"},x={class:"col-sm-3 col-form-label"},$={class:"col-sm-9"},ss=["placeholder"],os={class:"txt-danger"},es={class:"col-md-6"},ts={class:"mb-3 row"},ls={class:"col-sm-3 col-form-label"},is={class:"col-sm-9"},as=["value"],ds={key:0},ns={class:"col-md-6"},rs={class:"mb-3 row"},cs={class:"col-sm-3 col-form-label"},_s={class:"col-sm-9"},ms={class:"col-md-6"},us={class:"mb-3 row"},fs={class:"col-sm-3 col-form-label"},bs={class:"col-sm-9"},hs={class:"col-md-6"},vs={class:"mb-3 row"},gs={class:"col-sm-3 col-form-label"},ys={class:"col-sm-9"},ps=["placeholder"],ks={class:"txt-danger"},ws={class:"col-md-6"},Vs={class:"mb-3 row"},js={class:"col-sm-3 col-form-label"},Ls={class:"col-sm-9"},Cs={value:""},Ss=["value"],Ds={class:"txt-danger"},Fs={class:"col-md-6"},Us={class:"mb-3 row"},Hs={class:"col-sm-3 col-form-label"},Ts={class:"col-sm-9"},Os={value:""},qs=["value"],Bs={class:"txt-danger"},Es={class:"col-md-6"},Ms={class:"mb-3 row"},Ns={class:"col-sm-3 col-form-label"},Ps={class:"col-sm-9"},zs={value:"null"},Gs=["value"],Is={class:"txt-danger"},Ys={class:"row"},As={class:"col-md-12"},Js={class:"card"},Ks={class:"card-header"},Qs={class:"card-body"},Rs={class:"card-footer p-5"},Ws={class:"btn btn-sm btn-primary ml-1 float-right",type:"submit"};function Xs(l,i,a,e,h,v){const V=c("PageHeader"),g=c("Datepicker"),j=c("editor"),L=c("Link"),C=c("Layout");return d(),E(C,{pageTitle:l.__("Create Lesson")},{default:y(()=>[_(V,{breadcrumb_title:l.__("Create Lesson")},null,8,["breadcrumb_title"]),s("div",G,[s("form",{class:"form theme-form",onSubmit:i[9]||(i[9]=M(o=>e.form.post(l.route("teacher.lessons.store")),["prevent"]))},[s("div",I,[s("div",Y,[s("div",A,[s("div",J,[s("h5",K,[Q,p(t(l.__("Create Lesson")),1)])]),s("div",R,[s("div",W,[s("div",X,[s("div",Z,[s("label",x,t(l.__("Title")),1),s("div",$,[m(s("input",{"onUpdate:modelValue":i[0]||(i[0]=o=>e.form.title=o),class:r(["form-control form-control-sm",[a.errors.title?"is-invalid":""]]),type:"text",placeholder:l.__("Title")},null,10,ss),[[k,e.form.title]]),s("div",os,t(a.errors.title),1)])])]),s("div",es,[s("div",ts,[s("label",ls,t(l.__("Files")),1),s("div",is,[s("input",{type:"file",multiple:"",class:r([a.errors.files?"is-invalid":""]),onInput:i[1]||(i[1]=(...o)=>e.uploadFiles&&e.uploadFiles(...o))},null,34),e.form.progress?(d(),n("progress",{key:0,value:e.form.progress.percentage,max:"100"},t(e.form.progress.percentage)+"% ",9,as)):w("",!0),(d(!0),n(f,null,u(Object.keys(a.errors),(o,S)=>(d(),n("div",{class:"txt-danger",key:S},[o.includes("files")?(d(),n("p",ds,t(a.errors[o]),1)):w("",!0)]))),128))])])]),s("div",ns,[s("div",rs,[s("label",cs,t(l.__("Schedule From")),1),s("div",_s,[_(g,{modelValue:e.form.start_date,"onUpdate:modelValue":i[2]||(i[2]=o=>e.form.start_date=o),"enable-time-picker":!1,"auto-apply":""},null,8,["modelValue"])])])]),s("div",ms,[s("div",us,[s("label",fs,t(l.__("Schedule To")),1),s("div",bs,[_(g,{modelValue:e.form.end_date,"onUpdate:modelValue":i[3]||(i[3]=o=>e.form.end_date=o),"enable-time-picker":!1,"auto-apply":""},null,8,["modelValue"])])])]),s("div",hs,[s("div",vs,[s("label",gs,t(l.__("Youtube Link")),1),s("div",ys,[m(s("input",{"onUpdate:modelValue":i[4]||(i[4]=o=>e.form.youtube_link=o),class:r(["form-control form-control-sm",[a.errors.youtube_link?"is-invalid":""]]),type:"text",placeholder:l.__("Youtube Link")},null,10,ps),[[k,e.form.youtube_link]]),s("div",ks,t(a.errors.youtube_link),1)])])]),s("div",ws,[s("div",Vs,[s("label",js,t(l.__("Class")),1),s("div",Ls,[m(s("select",{"onUpdate:modelValue":i[5]||(i[5]=o=>e.form.class_id=o),class:r(["form-control btn-square digits",[a.errors.class_id?"is-invalid":""]]),id:"class"},[s("option",Cs,"("+t(l.__("none"))+")",1),(d(!0),n(f,null,u(a.classes,o=>(d(),n("option",{value:o.id,key:o.id},t(o.name),9,Ss))),128))],2),[[b,e.form.class_id]]),s("div",Ds,t(a.errors.class_id),1)])])]),s("div",Fs,[s("div",Us,[s("label",Hs,t(l.__("Study Group")),1),s("div",Ts,[m(s("select",{"onUpdate:modelValue":i[6]||(i[6]=o=>e.form.study_group_id=o),class:r(["form-control btn-square digits",[a.errors.study_group_id?"is-invalid":""]]),id:"study-group"},[s("option",Os,"("+t(l.__("none"))+")",1),(d(!0),n(f,null,u(a.study_groups,o=>(d(),n("option",{value:o.id,key:o.id},t(o.name),9,qs))),128))],2),[[b,e.form.study_group_id]]),s("div",Bs,t(a.errors.study_group_id),1)])])]),s("div",Es,[s("div",Ms,[s("label",Ns,t(l.__("Subject")),1),s("div",Ps,[m(s("select",{"onUpdate:modelValue":i[7]||(i[7]=o=>e.form.subject_id=o),class:r(["form-control btn-square digits",[a.errors.subject_id?"is-invalid":""]]),id:"subject"},[s("option",zs,"("+t(l.__("none"))+")",1),(d(!0),n(f,null,u(a.subjects,o=>(d(),n("option",{value:o.id,key:o.id},t(o.title),9,Gs))),128))],2),[[b,e.form.subject_id]]),s("div",Is,t(a.errors.subject_id),1)])])])])])])])]),s("div",Ys,[s("div",As,[s("div",Js,[s("div",Ks,[s("h5",null,t(l.__("Description")),1)]),s("div",Qs,[_(j,{modelValue:e.form.description,"onUpdate:modelValue":i[8]||(i[8]=o=>e.form.description=o),"api-key":"6g685dmceoqy8iip7a7dfmn0z3u4m9k1iwt89isp9jai9yy6",init:{theme:"silver",plugins:e.plugins,toolbar:e.toolbar,content_style:e.content_style}},null,8,["modelValue","init"])]),s("div",Rs,[s("button",Ws,t(l.__("Submit")),1),_(L,{href:l.route("teacher.lessons.index"),class:"btn btn-sm btn-light float-right"},{default:y(()=>[p(t(l.__("Cancel")),1)]),_:1},8,["href"])])])])])],32)])]),_:1},8,["pageTitle"])}const lo=T(z,[["render",Xs]]);export{lo as default};