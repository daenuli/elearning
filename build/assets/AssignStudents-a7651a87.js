import{_ as I,L as w,S as N,P as C,D as L,p as P,u as x,E as u,o as c,e as i,a as e,b as h,t as n,f as v,m as A,g,w as H,v as k,B as y,F as M,i as V}from"./app-31c25c41.js";import"./sweetalert2.all-ca2a8785.js";import{h as B}from"./moment-fbc5633a.js";const E={props:{studentIds:Array,users:Object,study_group:Object,errors:Object},name:"admin-layout",components:{Link:w,Sidebar:N,PageHeader:C,PageMainHeader:L,moment:B},setup(d){P(()=>{t.allSelected=d.studentIds.length===d.users.data.length});const t=x({studentIds:d.studentIds,allSelected:!1});function o(r){r.target.checked?(t.allSelected=!0,d.users.data.forEach(l=>{t.studentIds.push(l.student.id)})):(t.allSelected=!1,t.studentIds=[])}function a(r,l){r.target.checked?t.studentIds.push(l):t.studentIds=t.studentIds.filter(f=>f!==l);let _=$(".check-student:checked").length,m=d.users.data.length;t.allSelected=_===m}return{form:t,selectAll:o,selectStudent:a}}},j={class:"page-wrapper"},D={class:"page-main-header"},F={class:"page-body-wrapper"},O={class:"page-body"},U={class:"container-fluid"},T={class:"container-fluid"},q={key:0,class:"alert alert-success",role:"alert"},z={key:0,class:"alert alert-danger dark alert-dismissible fade show",role:"alert"},G=e("button",{class:"btn-close",type:"button","data-bs-dismiss":"alert","aria-label":"Close"},null,-1),J={class:"row"},K={class:"col-sm-12"},Q={class:"card"},R={class:"card-header"},W=e("h5",null,[e("i",{class:"fa fa-users"}),g(" Add Students")],-1),X={class:"card-header-right"},Y=e("i",{class:"fa fa-arrow-left text-white"},null,-1),Z={class:"card-body"},ee={class:"table-responsive"},te={class:"table table-sm"},se=e("th",{scope:"col"},"Name",-1),de=e("th",{scope:"col"},"Email",-1),ae=e("th",{scope:"col"},"NISN",-1),oe={scope:"row"},ne=["id","value","onClick"],le=e("div",{class:"row mt-4"},[e("div",{class:"col-md-12"},[e("button",{type:"submit",class:"btn btn-primary float-right"}," Add to group ")])],-1);function ce(d,t,o,a,r,l){const _=u("PageMainHeader"),m=u("Sidebar"),f=u("PageHeader"),S=u("Link");return c(),i("div",j,[e("div",D,[h(_)]),e("div",F,[h(m),e("div",O,[e("div",U,[h(f)]),e("div",T,[d.$page.props.flash.success?(c(),i("div",q,[e("p",null,n(d.$page.props.flash.success),1)])):v("",!0),e("form",{class:"form theme-form",onSubmit:t[3]||(t[3]=A(s=>a.form.post(d.route("admin.study-group.assign-students.store",o.study_group.id)),["prevent"]))},[o.errors.studentIds?(c(),i("div",z,[g(n(o.errors.studentIds)+" ",1),G])):v("",!0),e("div",J,[e("div",K,[e("div",Q,[e("div",R,[W,e("span",null,"Select and add students to the study group "+n(o.study_group.name),1),e("div",X,[h(S,{href:d.route("admin.study-groups.index"),class:"btn btn-success"},{default:H(()=>[Y,g(" Back to list ")]),_:1},8,["href"])])]),e("div",Z,[e("div",ee,[e("table",te,[e("thead",null,[e("tr",null,[e("th",null,[k(e("input",{id:"chk-ani-all",type:"checkbox",onClick:t[0]||(t[0]=s=>a.selectAll(s)),"onUpdate:modelValue":t[1]||(t[1]=s=>a.form.allSelected=s)},null,512),[[y,a.form.allSelected]])]),se,de,ae])]),e("tbody",null,[(c(!0),i(M,null,V(o.users.data,s=>{var b;return c(),i("tr",{key:s.student.id},[e("th",oe,[k(e("input",{class:"check-student",id:`user-${s.student.id}`,type:"checkbox","onUpdate:modelValue":t[2]||(t[2]=p=>a.form.studentIds=p),value:s.student.id,onClick:p=>a.selectStudent(p,s.student.id)},null,8,ne),[[y,a.form.studentIds]])]),e("td",null,n(s.name),1),e("td",null,n(s.email),1),e("td",null,n((b=s.student)==null?void 0:b.NISN_number),1)])}),128))])])]),le])])])])],32)])])])])}const he=I(E,[["render",ce]]);export{he as default};
