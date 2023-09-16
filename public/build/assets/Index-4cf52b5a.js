import{_ as C,L as G,H as M,S as k,P as w,D as L,u as B,z as m,E as _,o as n,c as N,w as H,b as V,a as t,e as r,t as o,f as u,m as h,g as c,v as b,G as p,n as f,i as P,F as T}from"./app-31c25c41.js";import D from"./Layout-e4c38fc2.js";import{S as q}from"./sweetalert2.all-ca2a8785.js";import{h as A}from"./moment-fbc5633a.js";const F={props:{study_groups:Object,errors:Object},name:"admin-layout",components:{Link:G,Head:M,Layout:D,Sidebar:k,PageHeader:w,PageMainHeader:L,moment:A},methods:{setStudyGroup:function(e){this.form.id=e.id,this.form.name=e.name}},setup(){const e=B({id:null,name:""});return m.Inertia.on("success",d=>{e.name="",$("#createStudyGroupModal").modal("hide"),$(`#updateStudyGroupModal${e.id}`).modal("hide")}),{destroy:d=>{q.fire({title:"Are you sure?",text:"Do you want to delete this study group?",icon:"question",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Yes, delete!"}).then(a=>{a.isConfirmed&&m.Inertia.delete(route("admin.study-groups.destroy",d))})},form:e}}},I={class:"container-fluid"},U={key:0,class:"alert alert-danger",role:"alert"},j={key:1,class:"alert alert-success",role:"alert"},z={class:"modal fade",id:"createStudyGroupModal",tabindex:"-1",role:"dialog","aria-labelledby":"createStudyGroupModalLabel","aria-hidden":"true"},E={class:"modal-dialog modal-dialog-centered",role:"document"},O={class:"modal-content"},Y={class:"modal-header"},J={class:"modal-title",id:"createStudyGroupModalLabel"},K=t("i",{class:"fa fa-users"},null,-1),Q=t("button",{class:"close",type:"button","aria-label":"Close","data-bs-dismiss":"modal"},[t("span",{"aria-hidden":"true"},"×")],-1),R={class:"modal-body"},W={class:"mb-3 row"},X={class:"col-sm-3 col-form-label"},Z={class:"col-sm-9"},x={class:"txt-danger"},tt={class:"modal-footer"},et={class:"btn btn-light",type:"button","data-bs-dismiss":"modal"},ot={class:"btn btn-primary",type:"submit"},st={class:"row"},at={class:"col-sm-12"},dt={class:"card"},lt={class:"card-header"},nt={class:"card-header-right"},it={class:"btn btn-light",type:"button","data-bs-toggle":"modal","data-original-title":"test","data-bs-target":"#createStudyGroupModal"},rt=t("i",{class:"fa fa-plus"},null,-1),ct={class:"table-responsive"},mt={class:"table table-sm"},_t=t("th",{scope:"col"},"#",-1),ut={scope:"col"},ht={scope:"col"},bt={scope:"col"},pt={scope:"row"},ft={class:"btn-group",role:"group","aria-label":"Basic example"},yt=["data-bs-target","onClick"],vt=t("i",{class:"fa fa-pencil"},null,-1),gt=[vt],St=["onClick"],Ct=t("i",{class:"fa fa-trash"},null,-1),Gt=[Ct],Mt=["id","aria-labelledby"],kt={class:"modal-dialog modal-dialog-centered",role:"document"},wt={class:"modal-content"},Lt=["onSubmit"],Bt={class:"modal-header"},Nt=["id"],Ht=t("i",{class:"fa fa-users"},null,-1),Vt=t("button",{class:"close",type:"button","aria-label":"Close","data-bs-dismiss":"modal"},[t("span",{"aria-hidden":"true"},"×")],-1),$t={class:"modal-body"},Pt={class:"mb-3 row"},Tt={class:"col-sm-3 col-form-label"},Dt={class:"col-sm-9"},qt={class:"txt-danger"},At={class:"modal-footer"},Ft={class:"btn btn-light",type:"button","data-bs-dismiss":"modal"},It={class:"btn btn-primary",type:"submit"};function Ut(e,l,d,a,jt,y){const v=_("PageHeader"),g=_("Layout");return n(),N(g,{pageTitle:e.__("Study Groups")},{default:H(()=>[V(v,{breadcrumb_title:e.__("Study Groups")},null,8,["breadcrumb_title"]),t("div",I,[e.$page.props.flash.error?(n(),r("div",U,[t("p",null,o(e.$page.props.flash.error),1)])):u("",!0),e.$page.props.flash.success?(n(),r("div",j,[t("p",null,o(e.$page.props.flash.success),1)])):u("",!0),t("div",z,[t("div",E,[t("div",O,[t("form",{class:"form theme-form",onSubmit:l[1]||(l[1]=h(s=>a.form.post(e.route("admin.study-groups.store")),["prevent"]))},[t("div",Y,[t("h5",J,[K,c(" "+o(e.__("Create Study Group")),1)]),Q]),t("div",R,[t("div",W,[t("label",X,o(e.__("Name")),1),t("div",Z,[b(t("input",{"onUpdate:modelValue":l[0]||(l[0]=s=>a.form.name=s),class:f(["form-control form-control-sm",[d.errors.name?"is-invalid":""]]),required:"",type:"text"},null,2),[[p,a.form.name]]),t("div",x,o(d.errors.name),1)])])]),t("div",tt,[t("button",et,o(e.__("Cancel")),1),t("button",ot,o(e.__("Save")),1)])],32)])])]),t("div",st,[t("div",at,[t("div",dt,[t("div",lt,[t("h5",null,o(e.__("Study Groups")),1),t("div",nt,[t("button",it,[rt,c(" "+o(e.__("Create")),1)])])]),t("div",ct,[t("table",mt,[t("thead",null,[t("tr",null,[_t,t("th",ut,o(e.__("Name")),1),t("th",ht,o(e.__("Created At")),1),t("th",bt,o(e.__("Actions")),1)])]),t("tbody",null,[(n(!0),r(T,null,P(d.study_groups,(s,S)=>(n(),r("tr",{key:s.id},[t("th",pt,o(S+1),1),t("td",null,o(s.name),1),t("td",null,o(s.created_at),1),t("td",null,[t("div",ft,[t("button",{class:"btn btn-info btn-xs",type:"button","data-bs-toggle":"modal","data-original-title":"test","data-bs-target":`#updateStudyGroupModal${s.id}`,onClick:i=>y.setStudyGroup(s)},gt,8,yt),t("button",{onClick:i=>a.destroy(s.id),class:"btn btn-danger btn-xs"},Gt,8,St)])]),t("div",{class:"modal fade",id:`updateStudyGroupModal${s.id}`,tabindex:"-1",role:"dialog","aria-labelledby":`updateStudyGroupModalLabel${s.id}`,"aria-hidden":"true"},[t("div",kt,[t("div",wt,[t("form",{class:"form theme-form",onSubmit:h(i=>a.form.put(e.route("admin.study-groups.update",s.id)),["prevent"])},[t("div",Bt,[t("h5",{class:"modal-title",id:`updateStudyGroupModalLabel${s.id}`},[Ht,c(" "+o(e.__("Update Study Group")),1)],8,Nt),Vt]),t("div",$t,[t("div",Pt,[t("label",Tt,o(e.__("Name")),1),t("div",Dt,[b(t("input",{"onUpdate:modelValue":l[2]||(l[2]=i=>a.form.name=i),class:f(["form-control form-control-sm",[d.errors.name?"is-invalid":""]]),required:"",type:"text"},null,2),[[p,a.form.name]]),t("div",qt,o(d.errors.name),1)])])]),t("div",At,[t("button",Ft,o(e.__("Cancel")),1),t("button",It,o(e.__("Save")),1)])],40,Lt)])])],8,Mt)]))),128))])])])])])])])]),_:1},8,["pageTitle"])}const Jt=C(F,[["render",Ut]]);export{Jt as default};
