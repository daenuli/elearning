import b from"./Sidebar-826486d8.js";import f from"./Layout-5c71fb0f.js";import v from"./PageMainHeader-cf474ae0.js";import g from"./PageHeader-77eb4629.js";import{_ as y,L as p,H as w,E as n,o as a,c as L,w as c,b as _,a as s,e as l,t as e,f as k,g as i,F as C,i as H,n as S}from"./app-31c25c41.js";import{x as M}from"./main-ac5dcf26.js";import{V as T}from"./vue3-pdf-embed-da8021ce.js";const V={props:{files:Array,lesson:Object},components:{Link:p,Head:w,Layout:f,Sidebar:b,PageHeader:g,Datepicker:M,VuePdfEmbed:T,PageMainHeader:v}},B={class:"container-fluid"},D={key:0,class:"alert alert-success",role:"alert"},N={class:"row"},P={class:"col-md-12"},E={class:"card"},F={class:"card-header"},j={class:"f-w-300"},Y=s("i",{class:"fa fa-book"},null,-1),z={class:"card-header-right"},A={class:"btn-group",role:"group","aria-label":"Basic example"},G=s("i",{class:"fa fa-pencil text-white"},null,-1),O=s("i",{class:"fa fa-arrow-left text-white"},null,-1),q={class:"card-body avatar-showcase"},I={class:"table-responsive"},J={class:"table table-sm table-bordered"},K=s("button",{class:"btn btn-danger",type:"button","data-bs-toggle":"modal","data-bs-target":".view-video"},[s("i",{class:"fa fa-youtube-play"})],-1),Q={class:"modal fade view-video",tabindex:"-1",role:"dialog","aria-labelledby":"myLargeModalLabel","aria-hidden":"true"},R={class:"modal-dialog modal-lg"},U={class:"modal-content"},W={class:"modal-header"},X={class:"modal-title",id:"myLargeModalLabel"},Z={class:"modal-body"},$=["src"],x={class:"modal-footer"},ss={class:"btn btn-light","data-bs-dismiss":"modal"},es={class:"row"},ts={class:"col-md-12"},os={class:"card"},as={class:"card-header"},ls={class:"f-w-300"},ds=s("i",{class:"fa fa-file-pdf-o"},null,-1),is={class:"card-body"},ns={key:0,style:{color:"gray"}},cs={key:1,class:"table"},_s=["data-bs-target"],rs={class:"modal-dialog modal-xl"},hs={class:"modal-content"},us={class:"modal-header"},ms={class:"modal-title",id:"myLargeModalLabel"},bs=s("button",{class:"btn-close",type:"button","data-bs-dismiss":"modal","aria-label":"Close"},null,-1),fs={class:"modal-body"},vs=["src"],gs=["src"],ys={class:"modal-footer"},ps={"data-bs-dismiss":"modal",class:"btn btn-light"},ws={class:"row"},Ls={class:"col-md-12"},ks={class:"card"},Cs={class:"card-header"},Hs={class:"f-w-300"},Ss=s("i",{class:"fa fa-list"},null,-1),Ms={class:"card-body"},Ts={key:0,style:{color:"gray"}},Vs=["innerHTML"];function Bs(t,Ds,o,Ns,Ps,Es){const u=n("PageHeader"),r=n("Link"),m=n("Layout");return a(),L(m,{pageTitle:t.__("Lesson Details")},{default:c(()=>[_(u,{breadcrumb_title:t.__("Lesson Details")},null,8,["breadcrumb_title"]),s("div",B,[t.$page.props.flash.success?(a(),l("div",D,[s("p",null,e(t.$page.props.flash.success),1)])):k("",!0),s("div",N,[s("div",P,[s("div",E,[s("div",F,[s("h5",j,[Y,i(" "+e(t.__("Lesson Details")),1)]),s("div",z,[s("div",A,[_(r,{href:t.route("teacher.lessons.edit",o.lesson.id),class:"btn btn-xs btn-primary"},{default:c(()=>[G,i(e(t.__("Edit")),1)]),_:1},8,["href"]),_(r,{href:t.route("teacher.lessons.index"),class:"btn btn-xs btn-success"},{default:c(()=>[O,i(" "+e(t.__("Back to list")),1)]),_:1},8,["href"])])])]),s("div",q,[s("div",I,[s("table",J,[s("tr",null,[s("th",null,e(t.__("Title")),1),s("td",null,e(o.lesson.title),1),s("th",null,e(t.__("Youtube Link")),1),s("td",null,[K,s("div",Q,[s("div",R,[s("div",U,[s("div",W,[s("h4",X,e(t.__("Youtube Video")),1)]),s("div",Z,[s("iframe",{width:"100%",height:"315",src:o.lesson.youtube_video_link,frameborder:"0",allowfullscreen:""},null,8,$)]),s("div",x,[s("button",ss,e(t.__("Close")),1)])])])])])]),s("tr",null,[s("th",null,e(t.__("Schedule From")),1),s("td",null,e(o.lesson.start_date),1),s("th",null,e(t.__("Schedule To")),1),s("td",null,e(o.lesson.end_date),1)]),s("tr",null,[s("th",null,e(t.__("Class")),1),s("td",null,e(o.lesson.class.name),1),s("th",null,e(t.__("Study Group")),1),s("td",null,e(o.lesson.study_group.name),1)]),s("tr",null,[s("th",null,e(t.__("Subject")),1),s("td",null,e(o.lesson.subject.title),1)])])])])])])]),s("div",es,[s("div",ts,[s("div",os,[s("div",as,[s("h5",ls,[ds,i(" "+e(t.__("Files")),1)])]),s("div",is,[o.files.length===0?(a(),l("p",ns,e(t.__("No files found"))+"!",1)):(a(),l("table",cs,[(a(!0),l(C,null,H(o.files,(d,h)=>(a(),l("tr",{key:d},[s("th",null,[s("a",{href:"","data-bs-toggle":"modal","data-bs-target":`.view-file-${h}`},e(d.name),9,_s)]),s("td",null,[s("div",{class:S(["modal fade",`view-file-${h}`]),tabindex:"-1",role:"dialog","aria-labelledby":"myLargeModalLabel","aria-hidden":"true"},[s("div",rs,[s("div",hs,[s("div",us,[s("h4",ms,e(d.name),1),bs]),s("div",fs,[d.mime_type==="application/pdf"?(a(),l("embed",{key:0,src:d.url,width:"100%",height:"600px"},null,8,vs)):(a(),l("iframe",{key:1,src:`https://docs.google.com/gview?url=${d.url}&embedded=true`,width:"100%",height:"500px"},null,8,gs))]),s("div",ys,[s("button",ps,e(t.__("Close")),1)])])])],2)])]))),128))]))])])])]),s("div",ws,[s("div",Ls,[s("div",ks,[s("div",Cs,[s("h5",Hs,[Ss,i(" "+e(t.__("Description")),1)])]),s("div",Ms,[o.lesson.description===null?(a(),l("p",Ts,e(t.__("No description"))+".",1)):(a(),l("div",{key:1,innerHTML:o.lesson.description},null,8,Vs))])])])])])]),_:1},8,["pageTitle"])}const qs=y(V,[["render",Bs]]);export{qs as default};
