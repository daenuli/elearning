import c from"./Sidebar-3c623214.js";import r from"./Layout-248c6c4e.js";import _ from"./PageMainHeader-912a94ba.js";import f from"./PageHeader-38b8e3e2.js";import{_ as m,L as h,H as p,E as a,o as u,c as b,w as i,a as o,t as s,b as k,g as n,n as w}from"./app-ae2d89af.js";import{x as g}from"./main-3bec7040.js";import{V as v}from"./vue3-pdf-embed-e87645ee.js";const L={props:{book:Object},components:{Link:h,Head:p,Layout:r,Sidebar:c,PageHeader:f,Datepicker:g,VuePdfEmbed:v,PageMainHeader:_},setup(){}},x={class:"container-fluid"},B={class:"row"},V={class:"col-md-6 pt-3"},y={class:"pull-left"},D={class:"col-md-6"},H=o("i",{class:"fa fa-arrow-left text-white"},null,-1),C=["disabled","href"],N=o("i",{class:"fa fa-download"},null,-1),P={class:"row"},S={class:"col-md-12"},T=["src"];function E(t,j,e,z,M,O){const d=a("Link"),l=a("Layout");return u(),b(l,{pageTitle:t.__("Book Details")},{default:i(()=>[o("div",x,[o("div",B,[o("div",V,[o("h3",y,s(e.book.title),1)]),o("div",D,[k(d,{href:t.route("student.books.index"),class:"btn btn-success pull-right mt-3"},{default:i(()=>[H,n(" "+s(t.__("Back to list")),1)]),_:1},8,["href"]),o("a",{disabled:!e.book.file_path,href:t.route("student.books.download",e.book.id),class:w([{disabled:!e.book.file_path},"btn btn-info mt-3 pull-right mr-1"])},[N,n(" "+s(t.__("Download")),1)],10,C)])]),o("div",P,[o("div",S,[o("embed",{src:e.book.file_path,class:"mt-2",width:"100%",height:"800px"},null,8,T)])])])]),_:1},8,["pageTitle"])}const Q=m(L,[["render",E]]);export{Q as default};
