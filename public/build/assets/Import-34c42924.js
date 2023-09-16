import{_ as k,L as y,H as F,S as w,P as L,D as S,d as f,u as B,z as u,E as _,o as l,c as C,w as m,b as h,a as e,e as i,t as o,f as p,m as H,g as c,n as N,F as P,i as V}from"./app-31c25c41.js";import E from"./Layout-e4c38fc2.js";const M={props:{errors:Object},components:{Link:y,Head:F,Layout:E,Sidebar:w,PageHeader:L,PageMainHeader:S},setup(){let s=f(0),t=f(!1);const n=B({file:null}),r=d=>{n.file=d.target.files[0]};return u.Inertia.on("start",d=>{t.value=!0}),u.Inertia.on("success",d=>{t.value=!1}),u.Inertia.on("error",d=>{t.value=!1}),{fileInputKey:s,form:n,resetFileInput:()=>{n.file=null,document.getElementById("import").value=[]},uploadFile:r,importing:t}}},$={class:"container-fluid"},z={key:0,class:"alert alert-danger",role:"alert"},D={key:1,class:"alert alert-success",role:"alert"},K={class:"row"},T={class:"col-sm-12"},j={class:"card"},O={class:"card-header"},R={class:"card-header-right"},q=e("i",{class:"fa fa-caret-left"},null,-1),A={class:"card-body"},G={class:"alert alert-info dark alert-dismissible fade show",role:"alert"},J={class:"mb-3 row"},Q={class:"col-sm-2 col-form-label"},U={class:"col-sm-10"},W={class:"txt-danger"},X={class:"row"},Y={class:"col-md-12"},Z={key:0,class:"alert alert-warning",role:"alert"},x=e("h4",null,"Import validation errors.",-1),ee={class:"card-footer"},se=["disabled"],te=e("i",{class:"fa fa-download"},null,-1),oe=e("i",{class:"fa fa-refresh"},null,-1);function re(s,t,n,r,v,d){const g=_("PageHeader"),b=_("Link"),I=_("Layout");return l(),C(I,{pageTitle:"Import Students"},{default:m(()=>[h(g,{breadcrumb_title:s.__("Import Students")},null,8,["breadcrumb_title"]),e("div",$,[s.$page.props.flash.error?(l(),i("div",z,[e("p",null,o(s.$page.props.flash.error),1)])):p("",!0),s.$page.props.flash.success?(l(),i("div",D,[e("p",null,o(s.$page.props.flash.success),1)])):p("",!0),e("div",K,[e("div",T,[e("form",{class:"form theme-form",onSubmit:t[2]||(t[2]=H(a=>r.form.post(s.route("admin.import.students.store")),["prevent"]))},[e("div",j,[e("div",O,[e("h5",null,o(s.__("Import Students")),1),e("div",R,[h(b,{href:s.route("admin.students.index"),class:"btn btn-light mr-2"},{default:m(()=>[q,c(" "+o(s.__("Back")),1)]),_:1},8,["href"])])]),e("div",A,[e("div",G,[e("strong",null,o(s.__("Note"))+":",1),c(" "+o(s.__("Make sure to reset file field after making changes to the file.")),1)]),e("div",J,[e("label",Q,o(s.__("Choose File"))+" (xlsx, csv)",1),e("div",U,[(l(),i("input",{type:"file",ref:"file",name:"import",id:"import",class:N([n.errors.file?"is-invalid":""]),onInput:t[0]||(t[0]=a=>r.uploadFile(a)),key:r.fileInputKey,accept:".xlsx"},null,34)),e("div",W,o(n.errors.file),1)])]),e("div",X,[e("div",Y,[s.$page.props.flash.import_error?(l(),i("div",Z,[x,e("ul",null,[(l(!0),i(P,null,V(s.$page.props.flash.import_error,a=>(l(),i("li",{key:a.name},o(a[0]),1))),128))])])):p("",!0)])])]),e("div",ee,[e("button",{class:"btn btn-success pull-right ml-2",disabled:r.importing},[te,c(" "+o(s.__("Import")),1)],8,se),e("button",{class:"btn btn-info pull-right",type:"button",onClick:t[1]||(t[1]=(...a)=>r.resetFileInput&&r.resetFileInput(...a))},[oe,c(" "+o(s.__("Reset")),1)])])])],32)])])])]),_:1})}const ne=k(M,[["render",re]]);export{ne as default};
