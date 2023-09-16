import{_ as C,L as j,H as M,S as k,P as w,D as L,u as B,z as _,E as u,o as i,c as T,w as H,b as V,a as t,e as r,t as s,f as m,m as b,g as c,v as h,G as f,n as p,i as N,F as P}from"./app-31c25c41.js";import D from"./Layout-e4c38fc2.js";import{S as q}from"./sweetalert2.all-ca2a8785.js";import{h as A}from"./moment-fbc5633a.js";const F={props:{subjects:Object,errors:Object},components:{Link:j,Head:M,Layout:D,Sidebar:k,PageHeader:w,PageMainHeader:L,moment:A},methods:{setSubject:function(e){this.form.id=e.id,this.form.title=e.title}},setup(){const e=B({id:null,title:""});return _.Inertia.on("success",l=>{e.title="",$("#createSubjectModal").modal("hide"),$(`#updateSubjectModal${e.id}`).modal("hide")}),{destroy:l=>{q.fire({title:"Are you sure?",text:"Do you want to delete this subject?",icon:"question",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Yes, delete!"}).then(a=>{a.isConfirmed&&_.Inertia.delete(route("admin.subjects.destroy",l))})},form:e}}},G={class:"container-fluid"},I={key:0,class:"alert alert-danger",role:"alert"},U={key:1,class:"alert alert-success",role:"alert"},z={class:"modal fade",id:"createSubjectModal",tabindex:"-1",role:"dialog","aria-labelledby":"createSubjectModalLabel","aria-hidden":"true"},E={class:"modal-dialog modal-dialog-centered",role:"document"},O={class:"modal-content"},Y={class:"modal-header"},J={class:"modal-title",id:"createSubjectModalLabel"},K=t("i",{class:"fa fa-users"},null,-1),Q=t("button",{class:"close",type:"button","aria-label":"Close","data-bs-dismiss":"modal"},[t("span",{"aria-hidden":"true"},"×")],-1),R={class:"modal-body"},W={class:"mb-3 row"},X={class:"col-sm-3 col-form-label"},Z={class:"col-sm-9"},x={class:"txt-danger"},tt={class:"modal-footer"},et={class:"btn btn-light",type:"button","data-bs-dismiss":"modal"},st={class:"btn btn-primary",type:"submit"},ot={class:"row"},at={class:"col-sm-12"},lt={class:"card"},dt={class:"card-header"},it=t("i",{class:"fa fa-list-alt"},null,-1),nt={class:"card-header-right"},rt={class:"btn btn-light",type:"button","data-bs-toggle":"modal","data-original-title":"test","data-bs-target":"#createSubjectModal"},ct=t("i",{class:"fa fa-plus"},null,-1),_t={class:"table-responsive"},ut={class:"table table-sm"},mt=t("th",{scope:"col"},"#",-1),bt={scope:"col"},ht={scope:"col"},ft={scope:"col"},pt={scope:"row"},vt={class:"btn-group",role:"group","aria-label":"Basic example"},gt=["data-bs-target","onClick"],yt=t("i",{class:"fa fa-pencil"},null,-1),St=[yt],Ct=["onClick"],jt=t("i",{class:"fa fa-trash"},null,-1),Mt=[jt],kt=["id","aria-labelledby"],wt={class:"modal-dialog modal-dialog-centered",role:"document"},Lt={class:"modal-content"},Bt=["onSubmit"],Tt={class:"modal-header"},Ht=["id"],Vt=t("i",{class:"fa fa-users"},null,-1),$t=t("button",{class:"close",type:"button","aria-label":"Close","data-bs-dismiss":"modal"},[t("span",{"aria-hidden":"true"},"×")],-1),Nt={class:"modal-body"},Pt={class:"mb-3 row"},Dt={class:"col-sm-3 col-form-label"},qt={class:"col-sm-9"},At={class:"txt-danger"},Ft={class:"modal-footer"},Gt={class:"btn btn-light",type:"button","data-bs-dismiss":"modal"},It={class:"btn btn-primary",type:"submit"};function Ut(e,d,l,a,zt,v){const g=u("PageHeader"),y=u("Layout");return i(),T(y,{pageTitle:e.__("Subjects")},{default:H(()=>[V(g,{breadcrumb_title:e.__("Subjects")},null,8,["breadcrumb_title"]),t("div",G,[e.$page.props.flash.error?(i(),r("div",I,[t("p",null,s(e.$page.props.flash.error),1)])):m("",!0),e.$page.props.flash.success?(i(),r("div",U,[t("p",null,s(e.$page.props.flash.success),1)])):m("",!0),t("div",z,[t("div",E,[t("div",O,[t("form",{class:"form theme-form",onSubmit:d[1]||(d[1]=b(o=>a.form.post(e.route("admin.subjects.store")),["prevent"]))},[t("div",Y,[t("h5",J,[K,c(" "+s(e.__("Create Subject")),1)]),Q]),t("div",R,[t("div",W,[t("label",X,s(e.__("Title")),1),t("div",Z,[h(t("input",{"onUpdate:modelValue":d[0]||(d[0]=o=>a.form.title=o),class:p(["form-control form-control-sm",[l.errors.title?"is-invalid":""]]),required:"",type:"text"},null,2),[[f,a.form.title]]),t("div",x,s(l.errors.title),1)])])]),t("div",tt,[t("button",et,s(e.__("Cancel")),1),t("button",st,s(e.__("Save")),1)])],32)])])]),t("div",ot,[t("div",at,[t("div",lt,[t("div",dt,[t("h5",null,[it,c(" "+s(e.__("Subjects")),1)]),t("div",nt,[t("button",rt,[ct,c(" "+s(e.__("Create")),1)])])]),t("div",_t,[t("table",ut,[t("thead",null,[t("tr",null,[mt,t("th",bt,s(e.__("Title")),1),t("th",ht,s(e.__("Created At")),1),t("th",ft,s(e.__("Actions")),1)])]),t("tbody",null,[(i(!0),r(P,null,N(l.subjects,(o,S)=>(i(),r("tr",{key:o.id},[t("th",pt,s(S+1),1),t("td",null,s(o.title),1),t("td",null,s(o.created_at),1),t("td",null,[t("div",vt,[t("button",{class:"btn btn-info btn-xs",type:"button","data-bs-toggle":"modal","data-original-title":"test","data-bs-target":`#updateSubjectModal${o.id}`,onClick:n=>v.setSubject(o)},St,8,gt),t("button",{onClick:n=>a.destroy(o.id),class:"btn btn-danger btn-xs"},Mt,8,Ct)])]),t("div",{class:"modal fade",id:`updateSubjectModal${o.id}`,tabindex:"-1",role:"dialog","aria-labelledby":`updateStudyGroupModalLabel${o.id}`,"aria-hidden":"true"},[t("div",wt,[t("div",Lt,[t("form",{class:"form theme-form",onSubmit:b(n=>a.form.put(e.route("admin.subjects.update",o.id)),["prevent"])},[t("div",Tt,[t("h5",{class:"modal-title",id:`updateStudyGroupModalLabel${o.id}`},[Vt,c(" "+s(e.__("Update Subject")),1)],8,Ht),$t]),t("div",Nt,[t("div",Pt,[t("label",Dt,s(e.__("Name")),1),t("div",qt,[h(t("input",{"onUpdate:modelValue":d[2]||(d[2]=n=>a.form.title=n),class:p(["form-control form-control-sm",[l.errors.title?"is-invalid":""]]),required:"",type:"text"},null,2),[[f,a.form.title]]),t("div",At,s(l.errors.title),1)])])]),t("div",Ft,[t("button",Gt,s(e.__("Cancel")),1),t("button",It,s(e.__("Save")),1)])],40,Bt)])])],8,kt)]))),128))])])])])])])])]),_:1},8,["pageTitle"])}const Kt=C(F,[["render",Ut]]);export{Kt as default};
