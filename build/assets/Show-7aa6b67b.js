import L from"./Sidebar-ca712a0f.js";import S from"./Layout-29cae0ca.js";import B from"./PageMainHeader-a1316194.js";import A from"./PageHeader-faacab35.js";import{_ as M,L as D,H as T,E as v,o,c as u,w as c,z as Q,b as m,a as s,e as d,t,f as n,g as r,i as b,n as f,F as g}from"./app-ae2d89af.js";import{x as H}from"./main-3bec7040.js";import{V}from"./vue3-pdf-embed-e87645ee.js";import{S as E}from"./sweetalert2.all-f377fe99.js";const P={props:{files:Array,assessment:Object},components:{Link:D,Head:T,Layout:S,Sidebar:L,PageHeader:A,Datepicker:H,VuePdfEmbed:V,PageMainHeader:B},setup(){function e(l){return String.fromCharCode(65+l)}return{destroy:l=>{E.fire({title:"Are you sure?",text:"Do you want to delete question?",icon:"question",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Yes, delete!"}).then(h=>{h.isConfirmed&&Q.Inertia.delete(route("teacher.questions.destroy",l.id))})},indexToOptionLabel:e}}},z={class:"container-fluid"},N={key:0,class:"alert alert-success",role:"alert"},j={key:1,class:"alert alert-danger",role:"alert"},x={class:"row"},F={class:"col-md-12"},O={class:"card"},U={class:"card-header"},G={class:"f-w-300"},I=s("i",{class:"fa fa-book"},null,-1),Y={class:"card-header-right"},J={class:"btn-group",role:"group","aria-label":"Basic example"},K=s("i",{class:"fa fa-pencil text-white"},null,-1),R=s("i",{class:"fa fa-arrow-left text-white"},null,-1),W={class:"card-body avatar-showcase"},X={class:"table-responsive"},Z={class:"table table-sm table-bordered"},$={class:"row"},q={class:"col-md-6"},ss={class:"card"},ts={class:"card-header"},es={class:"f-w-300"},as=s("i",{class:"fa fa-question-circle"},null,-1),ls={class:"card-header-right"},os=s("i",{class:"fa fa-plus"},null,-1),ds={class:"card-body"},is={class:"table-responsive"},ns={class:"table table-xs"},cs=s("th",{scope:"col"},"#",-1),rs={scope:"col"},_s={scope:"col"},hs={scope:"col"},us={scope:"row"},ms={class:"btn-group",role:"group","aria-label":"Basic example"},bs=["data-bs-target"],fs=s("i",{class:"fa fa-eye"},null,-1),gs=[fs],ps=s("i",{class:"fa fa-pencil text-white"},null,-1),ys=["onClick"],vs=s("i",{class:"fa fa-trash"},null,-1),Cs=[vs],ks={class:"modal-dialog modal-dialog-centered modal-lg"},ws={class:"modal-content"},Ls={class:"modal-header"},Ss={class:"modal-title",id:"myLargeModalLabel"},Bs={class:"modal-body my-gallery"},As={class:"row"},Ms={class:"col-md-6"},Ds={class:"mt-3"},Ts={key:0,class:"col-md-6"},Qs={class:"",itemprop:"associatedMedia",itemscope:""},Hs=["href"],Vs=["src"],Es={class:"modal-footer"},Ps={class:"btn btn-light",type:"button","data-bs-dismiss":"modal","aria-label":"Close"},zs={class:"col-md-6"},Ns={class:"card"},js={class:"card-header"},xs={class:"f-w-300"},Fs=s("i",{class:"fa fa-question-circle"},null,-1),Os={class:"card-header-right"},Us=s("i",{class:"fa fa-plus"},null,-1),Gs={class:"card-body"},Is={class:"table-responsive"},Ys={class:"table table-xs"},Js=s("th",{scope:"col"},"#",-1),Ks={scope:"col"},Rs={scope:"col"},Ws={scope:"col"},Xs={scope:"row"},Zs={class:"btn-group",role:"group","aria-label":"Basic example"},$s=["data-bs-target"],qs=s("i",{class:"fa fa-eye"},null,-1),st=[qs],tt=s("i",{class:"fa fa-pencil text-white"},null,-1),et=["onClick"],at=s("i",{class:"fa fa-trash"},null,-1),lt=[at],ot={class:"modal-dialog modal-dialog-centered modal-lg"},dt={class:"modal-content"},it={class:"modal-header"},nt={class:"modal-title",id:"myLargeModalLabel"},ct={class:"modal-body my-gallery"},rt={class:"row"},_t={class:"col-md-6"},ht={class:"mt-3"},ut={key:0,class:"col-md-6"},mt={class:"",itemprop:"associatedMedia",itemscope:""},bt=["href"],ft=["src"],gt={class:"modal-footer"},pt={class:"btn btn-light",type:"button","data-bs-dismiss":"modal","aria-label":"Close"};function yt(e,C,l,h,vt,Ct){const k=v("PageHeader"),_=v("Link"),w=v("Layout");return o(),u(w,{pageTitle:e.__("Assessments Details")},{default:c(()=>[m(k,{breadcrumb_title:e.__("Assessments Details")},null,8,["breadcrumb_title"]),s("div",z,[e.$page.props.flash.success?(o(),d("div",N,[s("p",null,t(e.$page.props.flash.success),1)])):n("",!0),e.$page.props.flash.error?(o(),d("div",j,[s("p",null,t(e.$page.props.flash.error),1)])):n("",!0),s("div",x,[s("div",F,[s("div",O,[s("div",U,[s("h5",G,[I,r(" "+t(e.__("Assessment Details")),1)]),s("div",Y,[s("div",J,[l.assessment.data.is_published?n("",!0):(o(),u(_,{key:0,href:e.route("teacher.assessments.edit",l.assessment.data.id),class:"btn btn-xs btn-primary"},{default:c(()=>[K,r(t(e.__("Edit")),1)]),_:1},8,["href"])),m(_,{href:e.route("teacher.assessments.index"),class:"btn btn-xs btn-success"},{default:c(()=>[R,r(" "+t(e.__("Back to list")),1)]),_:1},8,["href"])])])]),s("div",W,[s("div",X,[s("table",Z,[s("tr",null,[s("th",null,t(e.__("Title")),1),s("td",null,t(l.assessment.data.title),1),s("th",null,t(e.__("Time Limit")),1),s("td",null,t(l.assessment.data.time_limit_in_minutes)+" Minutes",1)]),s("tr",null,[s("th",null,t(e.__("Schedule From")),1),s("td",null,t(l.assessment.data.start_date),1),s("th",null,t(e.__("Schedule To")),1),s("td",null,t(l.assessment.data.end_date),1)]),s("tr",null,[s("th",null,t(e.__("Class")),1),s("td",null,t(l.assessment.data.class.name),1),s("th",null,t(e.__("Study Group")),1),s("td",null,t(l.assessment.data.study_group.name),1)]),s("tr",null,[s("th",null,t(e.__("Subject")),1),s("td",null,t(l.assessment.data.subject.title),1)])])])])])])]),s("div",$,[s("div",q,[s("div",ss,[s("div",ts,[s("h5",es,[as,r(" "+t(e.__("Multiple Choice Questions")),1)]),s("div",ls,[m(_,{href:e.route("teacher.assessments.questions.create",l.assessment.data.id),class:"btn btn-light btn-sm"},{default:c(()=>[os,r(" "+t(e.__("Create")),1)]),_:1},8,["href"])])]),s("div",ds,[s("div",is,[s("table",ns,[s("thead",null,[s("tr",null,[cs,s("th",rs,t(e.__("Question")),1),s("th",_s,t(e.__("Created At")),1),s("th",hs,t(e.__("Actions")),1)])]),s("tbody",null,[(o(!0),d(g,null,b(l.assessment.data.multiple_choice_questions,(a,p)=>(o(),d("tr",{key:a.id},[s("th",us,t(p+1),1),s("td",null,t(a.text),1),s("td",null,t(a.created_at),1),s("td",null,[s("div",ms,[s("button",{class:"btn btn-success btn-xs","data-bs-toggle":"modal","data-bs-target":`.question-details-modal${a.id}`},gs,8,bs),l.assessment.data.is_published?n("",!0):(o(),u(_,{key:0,href:e.route("teacher.questions.edit",a.id),class:"btn btn-primary btn-xs"},{default:c(()=>[ps]),_:2},1032,["href"])),l.assessment.data.is_published?n("",!0):(o(),d("button",{key:1,onClick:i=>h.destroy(a),class:"btn btn-danger btn-xs"},Cs,8,ys))])]),s("div",{class:f(["modal fade",`question-details-modal${a.id}`]),tabindex:"-1",role:"dialog","aria-labelledby":"myLargeModalLabel","aria-hidden":"true"},[s("div",ks,[s("div",ws,[s("div",Ls,[s("h4",Ss,t(e.__("Question Details")),1)]),s("div",Bs,[s("div",As,[s("div",Ms,[s("h6",null,[s("b",null,t(a.text),1)]),s("ol",Ds,[(o(!0),d(g,null,b(a.choices,(i,y)=>(o(),d("li",{key:i.id},[s("span",{class:f([i.is_correct?"badge badge-success":""])},t(String.fromCharCode(65+y))+". "+t(i.text),3)]))),128))])]),a.file?(o(),d("div",Ts,[s("figure",Qs,[s("a",{href:a.file.url,itemprop:"contentUrl","data-size":"1600x950","data-original-title":"",title:""},[s("img",{class:"img-thumbnail",src:a.file.url,itemprop:"thumbnail"},null,8,Vs)],8,Hs)])])):n("",!0)])]),s("div",Es,[s("button",Ps,t(e.__("Close")),1)])])])],2)]))),128))])])])])])]),s("div",zs,[s("div",Ns,[s("div",js,[s("h5",xs,[Fs,r(" "+t(e.__("Essay Questions")),1)]),s("div",Os,[m(_,{href:e.route("teacher.assessments.essay-questions.create",l.assessment.data.id),class:"btn btn-light btn-sm"},{default:c(()=>[Us,r(" "+t(e.__("Create")),1)]),_:1},8,["href"])])]),s("div",Gs,[s("div",Is,[s("table",Ys,[s("thead",null,[s("tr",null,[Js,s("th",Ks,t(e.__("Question")),1),s("th",Rs,t(e.__("Created At")),1),s("th",Ws,t(e.__("Actions")),1)])]),s("tbody",null,[(o(!0),d(g,null,b(l.assessment.data.essay_questions,(a,p)=>(o(),d("tr",{key:a.id},[s("th",Xs,t(p+1),1),s("td",null,t(a.text),1),s("td",null,t(a.created_at),1),s("td",null,[s("div",Zs,[s("button",{class:"btn btn-success btn-xs","data-bs-toggle":"modal","data-bs-target":`.question-details-modal${a.id}`},st,8,$s),l.assessment.data.is_published?n("",!0):(o(),u(_,{key:0,href:e.route("teacher.essay-questions.edit",a.id),class:"btn btn-primary btn-xs"},{default:c(()=>[tt]),_:2},1032,["href"])),l.assessment.data.is_published?n("",!0):(o(),d("button",{key:1,onClick:i=>h.destroy(a),class:"btn btn-danger btn-xs"},lt,8,et))])]),s("div",{class:f(["modal fade",`question-details-modal${a.id}`]),tabindex:"-1",role:"dialog","aria-labelledby":"myLargeModalLabel","aria-hidden":"true"},[s("div",ot,[s("div",dt,[s("div",it,[s("h4",nt,t(e.__("Question Details")),1)]),s("div",ct,[s("div",rt,[s("div",_t,[s("p",null,"Q: "+t(a.text),1),s("ol",ht,[(o(!0),d(g,null,b(a.choices,(i,y)=>(o(),d("li",{key:i.id},[s("span",{class:f([i.is_correct?"badge badge-success":""])},t(String.fromCharCode(65+y))+". "+t(i.text),3)]))),128))])]),a.file?(o(),d("div",ut,[s("figure",mt,[s("a",{href:a.file.url,itemprop:"contentUrl","data-size":"1600x950","data-original-title":"",title:""},[s("img",{class:"img-thumbnail",src:a.file.url,itemprop:"thumbnail"},null,8,ft)],8,bt)])])):n("",!0)])]),s("div",gt,[s("button",pt,t(e.__("Close")),1)])])])],2)]))),128))])])])])])])])])]),_:1},8,["pageTitle"])}const Tt=M(P,[["render",yt]]);export{Tt as default};
