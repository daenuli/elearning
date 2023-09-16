import{_ as u,a3 as v,L as g,H as b,u as w,E as m,o as c,c as y,w as k,b as P,a as o,e as _,t as e,f,m as V,v as d,G as n,n as i}from"./app-31c25c41.js";import C from"./Sidebar-826486d8.js";import H from"./Layout-5c71fb0f.js";import B from"./PageMainHeader-cf474ae0.js";import L from"./PageHeader-77eb4629.js";const N={props:{user:Object,errors:Object,avatar:String|Boolean},data(){return{image:v}},name:"teacher-layout",components:{Link:g,Head:b,Layout:H,Sidebar:C,PageHeader:L,PageMainHeader:B},setup(s){return{form:w({name:s.user.name,email:s.user.email,password:"",password_confirmation:"",avatar:null})}}},S={class:"container-fluid"},E={key:0,class:"alert alert-success",role:"alert"},U={class:"row"},z={class:"col-md-12"},M={class:"card"},T={class:"card-body"},j={class:"row mb-2 text-center"},D={class:"col-md-12"},O={class:"col-auto"},A=["src"],F={class:"col mt-2"},G={class:"mb-1"},I={class:"row mt-5"},q={class:"col-md-6"},x={class:"form-group"},J={class:"form-label"},K=["placeholder"],Q={class:"txt-danger"},R={class:"col-md-6"},W={class:"form-group"},X={class:"form-label"},Y=["placeholder"],Z={class:"txt-danger"},$={class:"row mt-3"},oo={class:"col-md-6"},so={class:"form-group"},eo={class:"form-label"},ao=["placeholder"],ro={class:"txt-danger"},to={class:"col-md-6"},lo={class:"form-label",for:"password_confirmation"},io=["placeholder"],no={class:"txt-danger"},co={class:"row mt-3"},mo={class:"col-md-6"},_o={class:"form-label"},fo=["value"],ho={class:"txt-danger"},po={class:"form-footer"},uo={type:"submit",class:"btn btn-primary mt-3 btn-sm pull-right"};function vo(s,a,t,r,go,bo){const h=m("PageHeader"),p=m("Layout");return c(),y(p,{pageTitle:s.__("Profile"),avatar:t.avatar},{default:k(()=>[P(h,{breadcrumb_title:s.__("Profile")},null,8,["breadcrumb_title"]),o("div",S,[s.$page.props.flash.success?(c(),_("div",E,[o("p",null,e(s.$page.props.flash.success),1)])):f("",!0),o("form",{class:"form theme-form",onSubmit:a[5]||(a[5]=V(l=>r.form.post(s.route("teacher.profile.store")),["prevent"]))},[o("div",U,[o("div",z,[o("div",M,[o("div",T,[o("div",j,[o("div",D,[o("div",O,[o("img",{style:{"margin-left":"auto","margin-right":"auto"},class:"img-70 rounded-circle",alt:"",src:t.avatar,"data-original-title":"",title:""},null,8,A)]),o("div",F,[o("h3",G,e(s.$page.props.user.name),1)])])]),o("div",I,[o("div",q,[o("div",x,[o("label",J,e(s.__("Name")),1),d(o("input",{"onUpdate:modelValue":a[0]||(a[0]=l=>r.form.name=l),class:i(["form-control",[t.errors.name?"is-invalid":""]]),placeholder:s.__("Name")},null,10,K),[[n,r.form.name]]),o("div",Q,e(t.errors.name),1)])]),o("div",R,[o("div",W,[o("label",X,e(s.__("Email")),1),d(o("input",{"onUpdate:modelValue":a[1]||(a[1]=l=>r.form.email=l),class:i(["form-control",[t.errors.email?"is-invalid":""]]),placeholder:s.__("Email")},null,10,Y),[[n,r.form.email]]),o("div",Z,e(t.errors.email),1)])])]),o("div",$,[o("div",oo,[o("div",so,[o("label",eo,e(s.__("Password")),1),d(o("input",{style:{display:"block",width:"100%",padding:"0.375rem 0.75rem","font-size":"1rem","font-weight":"400","line-height":"1.5",color:"#212529","background-color":"#fff","background-clip":"padding-box",border:"1px solid #ced4da","border-radius":"0.25rem"},"onUpdate:modelValue":a[2]||(a[2]=l=>r.form.password=l),class:i(["form-control",[t.errors.password?"is-invalid":""]]),type:"password",placeholder:s.__("Password")},null,10,ao),[[n,r.form.password]]),o("div",ro,e(t.errors.password),1)])]),o("div",to,[o("label",lo,e(s.__("Confirm Password")),1),d(o("input",{style:{display:"block",width:"100%",padding:"0.375rem 0.75rem","font-size":"1rem","font-weight":"400","line-height":"1.5",color:"#212529","background-color":"#fff","background-clip":"padding-box",border:"1px solid #ced4da","border-radius":"0.25rem"},id:"password_confirmation","onUpdate:modelValue":a[3]||(a[3]=l=>r.form.password_confirmation=l),class:i(["form-control",[t.errors.password_confirmation?"is-invalid":""]]),type:"password",placeholder:s.__("Confirm Password")},null,10,io),[[n,r.form.password_confirmation]]),o("div",no,e(t.errors.password_confirmation),1)])]),o("div",co,[o("div",mo,[o("label",_o,e(s.__("Avatar")),1),o("input",{type:"file",class:i([t.errors.avatar?"is-invalid":""]),onInput:a[4]||(a[4]=l=>r.form.avatar=l.target.files[0])},null,34),r.form.progress?(c(),_("progress",{key:0,value:r.form.progress.percentage,max:"100"},e(r.form.progress.percentage)+"% ",9,fo)):f("",!0),o("div",ho,e(t.errors.avatar),1)])]),o("div",po,[o("button",uo,e(s.__("Save")),1)])])])])])],32)])]),_:1},8,["pageTitle","avatar"])}const Co=u(N,[["render",vo]]);export{Co as default};
