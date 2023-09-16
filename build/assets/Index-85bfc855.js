import{_ as w,L as S,H as C,S as B,P as N,D as $,E as c,o as a,c as L,w as l,z as D,b as r,a as t,e as n,F as p,i as f,t as s,f as _,g as u}from"./app-31c25c41.js";import H from"./Layout-e4c38fc2.js";import{S as I}from"./sweetalert2.all-ca2a8785.js";import{h as m}from"./moment-fbc5633a.js";const P={props:{errors:Object,users:Object},components:{Link:S,Head:C,Layout:H,Sidebar:B,PageHeader:N,PageMainHeader:$,moment:m},methods:{forramttedDate:function(e){return m(e).format("MMM D YYYY")}},setup(){return{destroy:h=>{I.fire({title:"Are you sure?",text:"Do you want to delete this student?",icon:"question",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Yes, delete!"}).then(i=>{i.isConfirmed&&D.Inertia.delete(route("admin.students.destroy",h))})}}}},Y={class:"container-fluid"},E={key:0,class:"alert alert-warning",role:"alert"},M=t("h4",null,"Students import failed.",-1),V={key:1,class:"alert alert-danger",role:"alert"},T={key:2,class:"alert alert-success",role:"alert"},j={class:"row"},A={class:"col-sm-12"},F={class:"card"},O={class:"card-header"},q={class:"card-header-right"},z=["href"],G=t("i",{class:"fa fa-cloud-download white"},null,-1),J=t("i",{class:"fa fa-cloud-upload white"},null,-1),K=t("i",{class:"fa fa-plus"},null,-1),Q={class:"table-responsive"},R={class:"table table-sm"},U=t("th",{scope:"col"},"#",-1),W={scope:"col"},X={scope:"col"},Z={scope:"col"},x={scope:"col"},tt={scope:"col"},et={scope:"col"},st={scope:"col"},ot={scope:"row"},at=["href"],nt={class:"btn-group",role:"group","aria-label":"Basic example"},lt=t("i",{class:"fa fa-eye"},null,-1),rt=t("i",{class:"fa fa-pencil"},null,-1),dt=["onClick"],it=t("i",{class:"fa fa-trash"},null,-1),ct=[it];function _t(e,h,i,b,ut,g){const y=c("PageHeader"),d=c("Link"),k=c("Layout");return a(),L(k,{pageTitle:"Students"},{default:l(()=>[r(y,{breadcrumb_title:e.__("Students")},null,8,["breadcrumb_title"]),t("div",Y,[e.$page.props.flash.import_error?(a(),n("div",E,[M,t("ul",null,[(a(!0),n(p,null,f(e.$page.props.flash.import_error,o=>(a(),n("li",{key:o.name},s(o[0]),1))),128))])])):_("",!0),e.$page.props.flash.error?(a(),n("div",V,[t("p",null,s(e.$page.props.flash.error),1)])):_("",!0),e.$page.props.flash.success?(a(),n("div",T,[t("p",null,s(e.$page.props.flash.success),1)])):_("",!0),t("div",j,[t("div",A,[t("div",F,[t("div",O,[t("h5",null,s(e.__("Students")),1),t("div",q,[t("a",{href:e.route("admin.export.students"),class:"btn btn-success btn-sm mr-2"},[G,u(" "+s(e.__("Export")),1)],8,z),r(d,{href:e.route("admin.import.students.index"),class:"btn btn-primary mr-2"},{default:l(()=>[J,u(" "+s(e.__("Import")),1)]),_:1},8,["href"]),r(d,{href:e.route("admin.students.create"),class:"btn btn-light btn-sm"},{default:l(()=>[K,u(" "+s(e.__("Create")),1)]),_:1},8,["href"])])]),t("div",Q,[t("table",R,[t("thead",null,[t("tr",null,[U,t("th",W,s(e.__("Name")),1),t("th",X,s(e.__("Email")),1),t("th",Z,s(e.__("NISN")),1),t("th",x,s(e.__("Class")),1),t("th",tt,s(e.__("Study Group")),1),t("th",et,s(e.__("Date of Birth")),1),t("th",st,s(e.__("Actions")),1)])]),t("tbody",null,[(a(!0),n(p,null,f(i.users.data,(o,v)=>(a(),n("tr",{key:o.id},[t("th",ot,s(v+1),1),t("td",null,s(o.name),1),t("td",null,[t("a",{href:`mailto:${o.email}`,class:"txt-primary"},s(o.email),9,at)]),t("td",null,s(o.student.NISN_number),1),t("td",null,s(o.student.school_class.name),1),t("td",null,s(o.student.study_group.name),1),t("td",null,s(g.forramttedDate(o.student.date_of_birth)),1),t("td",null,[t("div",nt,[r(d,{href:e.route("admin.students.show",o.student.id),class:"btn btn-success btn-xs"},{default:l(()=>[lt]),_:2},1032,["href"]),r(d,{href:e.route("admin.students.edit",o.student.id),class:"btn btn-info btn-xs"},{default:l(()=>[rt]),_:2},1032,["href"]),t("button",{onClick:ht=>b.destroy(o.id),class:"btn btn-danger btn-xs"},ct,8,dt)])])]))),128))])])])])])])])]),_:1})}const gt=w(P,[["render",_t]]);export{gt as default};
