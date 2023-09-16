import C from"./Sidebar-ca712a0f.js";import E from"./Layout-29cae0ca.js";import L from"./PageMainHeader-a1316194.js";import H from"./PageHeader-faacab35.js";import{_ as T,L as U,H as O,u as D,E as r,o as a,c as z,w as k,z as A,b as c,a as s,m as B,g as p,t as i,v as u,G as I,n as _,e as d,f as w,i as f,F as h,I as g}from"./app-ae2d89af.js";import{x as M}from"./main-3bec7040.js";import{E as N}from"./Editor-72357907.js";const P={props:{subjects:Object,assignment:Object,classes:Object,study_groups:Object,errors:Object},components:{Link:U,Head:O,Layout:E,Editor:N,Sidebar:C,PageHeader:H,Datepicker:M,PageMainHeader:L},setup(t){const l=["advlist","autolink","lists","link","image","charmap","preview","anchor","searchreplace","visualblocks","code","fullscreen","insertdatetime","media","table","wordcount","visualchars"],n="h1 h2 h3 h4 h5 h6 | undo redo | styles | bold italic underline| alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | fullscreen preview |",o="body { font-family:Helvetica,Arial,sans-serif; font-size:16px }",b=D({id:t.assignment.id,class_id:t.assignment.class_id,subject_id:t.assignment.subject_id,study_group_id:t.assignment.study_group_id,title:t.assignment.title,instructions:t.assignment.instructions,file_name:t.assignment.file_name,youtube_link:t.assignment.youtube_link,files:[],start_date:t.assignment.start_date,end_date:t.assignment.end_date});function y(m){b.files=m.target.files}function v(){A.Inertia.post(route("teacher.assignments.update",this.form.id),{_method:"put",form:this.form})}return{form:b,uploadFiles:y,submit:v,plugins:l,toolbar:n,content_style:o}}},q={class:"container-fluid"},x={class:"row"},G={class:"col-md-12"},J={class:"card"},K={class:"card-header"},Q={class:"f-w-300"},R=s("i",{class:"fa fa-book"},null,-1),W={class:"card-body"},X={class:"row"},Y={class:"col-md-6"},Z={class:"mb-3 row"},$={class:"col-sm-3 col-form-label"},ss={class:"col-sm-9"},es=["placeholder"],ts={class:"txt-danger"},os={class:"col-md-6"},is={class:"mb-3 row"},ls={class:"col-sm-3 col-form-label"},ns={class:"col-sm-9"},as=["value"],ds={key:0},rs={class:"col-md-6"},cs={class:"mb-3 row"},_s={class:"col-sm-3 col-form-label"},ms={class:"col-sm-9"},us={class:"col-md-6"},fs={class:"mb-3 row"},hs={class:"col-sm-3 col-form-label"},bs={class:"col-sm-9"},vs={class:"col-md-6"},gs={class:"mb-3 row"},ys={class:"col-sm-3 col-form-label"},ks={class:"col-sm-9"},ps={value:""},ws=["value"],Vs={class:"txt-danger"},js={class:"col-md-6"},Ss={class:"mb-3 row"},Fs={class:"col-sm-3 col-form-label"},Cs={class:"col-sm-9"},Es={value:""},Ls=["value"],Hs={class:"txt-danger"},Ts={class:"col-md-6"},Us={class:"mb-3 row"},Os={class:"col-sm-3 col-form-label"},Ds={class:"col-sm-9"},zs={value:"null"},As=["value"],Bs={class:"txt-danger"},Is={class:"row"},Ms={class:"col-md-12"},Ns={class:"card"},Ps={class:"card-header"},qs={class:"card-body"},xs={class:"card-footer p-5"},Gs={class:"btn btn-sm btn-primary ml-1 float-right",type:"submit"};function Js(t,l,n,o,b,y){const v=r("PageHeader"),m=r("Datepicker"),V=r("editor"),j=r("Link"),S=r("Layout");return a(),z(S,{pageTitle:t.__("Edit Assignment")},{default:k(()=>[c(v,{breadcrumb_title:t.__("Edit Assignment")},null,8,["breadcrumb_title"]),s("div",q,[s("form",{class:"form theme-form",onSubmit:l[8]||(l[8]=B((...e)=>o.submit&&o.submit(...e),["prevent"]))},[s("div",x,[s("div",G,[s("div",J,[s("div",K,[s("h5",Q,[R,p(i(t.__("Create Assignment")),1)])]),s("div",W,[s("div",X,[s("div",Y,[s("div",Z,[s("label",$,i(t.__("Title")),1),s("div",ss,[u(s("input",{"onUpdate:modelValue":l[0]||(l[0]=e=>o.form.title=e),class:_(["form-control form-control-sm",[n.errors.title?"is-invalid":""]]),type:"text",placeholder:t.__("Title")},null,10,es),[[I,o.form.title]]),s("div",ts,i(n.errors.title),1)])])]),s("div",os,[s("div",is,[s("label",ls,i(t.__("Files")),1),s("div",ns,[s("input",{type:"file",multiple:"",class:_([n.errors.files?"is-invalid":""]),onInput:l[1]||(l[1]=(...e)=>o.uploadFiles&&o.uploadFiles(...e))},null,34),o.form.progress?(a(),d("progress",{key:0,value:o.form.progress.percentage,max:"100"},i(o.form.progress.percentage)+"% ",9,as)):w("",!0),(a(!0),d(h,null,f(Object.keys(n.errors),(e,F)=>(a(),d("div",{class:"txt-danger",key:F},[e.includes("files")?(a(),d("p",ds,i(n.errors[e]),1)):w("",!0)]))),128))])])]),s("div",rs,[s("div",cs,[s("label",_s,i(t.__("Schedule From")),1),s("div",ms,[c(m,{modelValue:o.form.start_date,"onUpdate:modelValue":l[2]||(l[2]=e=>o.form.start_date=e),"enable-time-picker":!1,"auto-apply":""},null,8,["modelValue"])])])]),s("div",us,[s("div",fs,[s("label",hs,i(t.__("Schedule To")),1),s("div",bs,[c(m,{modelValue:o.form.end_date,"onUpdate:modelValue":l[3]||(l[3]=e=>o.form.end_date=e),"enable-time-picker":!1,"auto-apply":""},null,8,["modelValue"])])])]),s("div",vs,[s("div",gs,[s("label",ys,i(t.__("Class")),1),s("div",ks,[u(s("select",{"onUpdate:modelValue":l[4]||(l[4]=e=>o.form.class_id=e),class:_(["form-control form-control-sm",[n.errors.class_id?"is-invalid":""]]),id:"exampleFormControlSelect31"},[s("option",ps,"("+i(t.__("none"))+")",1),(a(!0),d(h,null,f(n.classes,e=>(a(),d("option",{value:e.id,key:e.id},i(e.name),9,ws))),128))],2),[[g,o.form.class_id]]),s("div",Vs,i(n.errors.class_id),1)])])]),s("div",js,[s("div",Ss,[s("label",Fs,i(t.__("Study Group")),1),s("div",Cs,[u(s("select",{"onUpdate:modelValue":l[5]||(l[5]=e=>o.form.study_group_id=e),class:_(["form-control form-control-sm",[n.errors.study_group_id?"is-invalid":""]]),id:"exampleFormControlSelect31"},[s("option",Es,"("+i(t.__("none"))+")",1),(a(!0),d(h,null,f(n.study_groups,e=>(a(),d("option",{value:e.id,key:e.id},i(e.name),9,Ls))),128))],2),[[g,o.form.study_group_id]]),s("div",Hs,i(n.errors.study_group_id),1)])])]),s("div",Ts,[s("div",Us,[s("label",Os,i(t.__("Subject")),1),s("div",Ds,[u(s("select",{"onUpdate:modelValue":l[6]||(l[6]=e=>o.form.subject_id=e),class:_(["form-control btn-square digits",[n.errors.subject_id?"is-invalid":""]]),id:"subject"},[s("option",zs,"("+i(t.__("none"))+")",1),(a(!0),d(h,null,f(n.subjects,e=>(a(),d("option",{value:e.id,key:e.id},i(e.title),9,As))),128))],2),[[g,o.form.subject_id]]),s("div",Bs,i(n.errors.subject_id),1)])])])])])])])]),s("div",Is,[s("div",Ms,[s("div",Ns,[s("div",Ps,[s("h5",null,i(t.__("Instructions")),1)]),s("div",qs,[c(V,{modelValue:o.form.instructions,"onUpdate:modelValue":l[7]||(l[7]=e=>o.form.instructions=e),"api-key":"6g685dmceoqy8iip7a7dfmn0z3u4m9k1iwt89isp9jai9yy6",init:{theme:"silver",plugins:o.plugins,toolbar:o.toolbar,content_style:o.content_style}},null,8,["modelValue","init"])]),s("div",xs,[s("button",Gs,i(t.__("Submit")),1),c(j,{href:t.route("teacher.assignments.index"),class:"btn btn-sm btn-light float-right"},{default:k(()=>[p(i(t.__("Cancel")),1)]),_:1},8,["href"])])])])])],32)])]),_:1},8,["pageTitle"])}const $s=T(P,[["render",Js]]);export{$s as default};
