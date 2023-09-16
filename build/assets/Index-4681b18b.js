import{_ as w,L as v,H as k,S as C,P as B,D,E as h,o as a,c as L,w as n,z as T,b as r,a as e,e as c,t as s,f as u,g as _,i as $,F as H}from"./app-ae2d89af.js";import E from"./Layout-cc8ee99e.js";import{S as M}from"./sweetalert2.all-f377fe99.js";import{h as p}from"./moment-fbc5633a.js";const N={props:{users:Object},name:"create-teacher",components:{Link:v,Head:k,Layout:E,Sidebar:C,PageHeader:B,PageMainHeader:D,moment:p},methods:{forramttedDate:function(t){return p(t).format("MMM D YYYY")}},setup(){return{destroy:i=>{M.fire({title:"Are you sure?",text:`Do you want to delete ${i.name}?`,icon:"question",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Yes, delete!"}).then(d=>{d.isConfirmed&&T.Inertia.delete(route("admin.teachers.destroy",i.id))})}}}},P={class:"container-fluid"},S={key:0,class:"alert alert-success",role:"alert"},Y={key:1,class:"alert alert-warning",role:"alert"},V={class:"row"},A={class:"col-sm-12"},I={class:"card"},F={class:"card-header"},j={class:"card-header-right"},q=["href"],z=e("i",{class:"fa fa-cloud-download white"},null,-1),G=e("i",{class:"fa fa-cloud-upload white"},null,-1),O=e("i",{class:"fa fa-plus"},null,-1),R={class:"table-responsive"},J={class:"table table-sm"},K=e("th",{scope:"col"},"#",-1),Q={scope:"col"},U={scope:"col"},W={scope:"col"},X={scope:"col"},Z={scope:"col"},x={scope:"col"},ee={scope:"col"},te={scope:"col"},se={scope:"row"},oe=["href"],ae={class:"btn-group",role:"group","aria-label":"Basic example"},ne=e("i",{class:"fa fa-eye"},null,-1),re=e("i",{class:"fa fa-pencil"},null,-1),le=["onClick"],ce=e("i",{class:"fa fa-trash"},null,-1),ie=[ce];function de(t,i,d,m,he,f){const b=h("PageHeader"),l=h("Link"),g=h("Layout");return a(),L(g,{pageTitle:"Teachers"},{default:n(()=>[r(b,{breadcrumb_title:t.__("Teachers")},null,8,["breadcrumb_title"]),e("div",P,[t.$page.props.flash.success?(a(),c("div",S,[e("p",null,s(t.$page.props.flash.success),1)])):u("",!0),t.$page.props.flash.warning?(a(),c("div",Y,[e("p",null,s(t.$page.props.flash.warning),1)])):u("",!0),e("div",V,[e("div",A,[e("div",I,[e("div",F,[e("h5",null,s(t.__("Teachers")),1),e("div",j,[e("a",{href:t.route("admin.export.teachers"),class:"btn btn-success btn-sm mr-2"},[z,_(" "+s(t.__("Export")),1)],8,q),r(l,{href:t.route("admin.import.teachers.index"),class:"btn btn-primary mr-2"},{default:n(()=>[G,_(" "+s(t.__("Import")),1)]),_:1},8,["href"]),r(l,{href:t.route("admin.teachers.create"),class:"btn btn-light btn-sm"},{default:n(()=>[O,_(" "+s(t.__("Create")),1)]),_:1},8,["href"])])]),e("div",R,[e("table",J,[e("thead",null,[e("tr",null,[K,e("th",Q,s(t.__("Name")),1),e("th",U,s(t.__("Email")),1),e("th",W,s(t.__("Education")),1),e("th",X,s(t.__("Gender")),1),e("th",Z,s(t.__("Religion")),1),e("th",x,s(t.__("Appointment Decree")),1),e("th",ee,s(t.__("TMT: Date")),1),e("th",te,s(t.__("Actions")),1)])]),e("tbody",null,[(a(!0),c(H,null,$(d.users.data,(o,y)=>(a(),c("tr",{key:o.id},[e("th",se,s(y+1),1),e("td",null,s(o.name),1),e("td",null,[e("a",{href:`mailto:${o.email}`,class:"txt-primary"},s(o.email),9,oe)]),e("td",null,s(o.teacher.education),1),e("td",null,s(o.teacher.gender),1),e("td",null,s(o.teacher.religion),1),e("td",null,s(o.teacher.appointment_decree),1),e("td",null,s(f.forramttedDate(o.teacher.date)),1),e("td",null,[e("div",ae,[r(l,{href:t.route("admin.teachers.show",o.teacher.id),class:"btn btn-success btn-xs"},{default:n(()=>[ne]),_:2},1032,["href"]),r(l,{href:t.route("admin.teachers.edit",o.teacher.id),class:"btn btn-info btn-xs"},{default:n(()=>[re]),_:2},1032,["href"]),e("button",{onClick:_e=>m.destroy(o),class:"btn btn-danger btn-xs"},ie,8,le)])])]))),128))])])])])])])])]),_:1})}const be=w(N,[["render",de]]);export{be as default};
