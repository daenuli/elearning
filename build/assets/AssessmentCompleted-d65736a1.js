import m from"./Sidebar-3c623214.js";import _ from"./Layout-248c6c4e.js";import u from"./PageMainHeader-912a94ba.js";import h from"./PageHeader-38b8e3e2.js";import{_ as g,L as p,H as f,E as r,o as s,e as a,b as d,a as e,t as o,f as i,w as y,g as k}from"./app-ae2d89af.js";const b={props:{message:String,is_submitted:Boolean},name:"admin-layout",components:{Link:p,Head:f,Layout:_,Sidebar:m,PageHeader:h,PageMainHeader:u}},v={class:"p-10"},w={key:0,class:"alert alert-success",role:"alert"},x={key:1,class:"card"},H={class:"card-body"},B=e("p",null," Congratulations on completing the exam! We hope it went well for you. We wanted to let you know that your assessment has been received and will be graded shortly. Thank you for your hard work and dedication during the exam. ",-1),C=e("p",null," E learning management system ",-1),L={key:2},N={key:0,class:"",role:"alert"},P={class:"text-danger text-center"},V={class:"row mt-2"},E={class:"col-md-12 text-center"};function S(n,T,t,W,A,D){const c=r("PageHeader"),l=r("Link");return s(),a("div",v,[d(c),t.message&&!t.is_submitted?(s(),a("div",w,[e("p",null,o(t.message),1)])):i("",!0),t.is_submitted?(s(),a("div",L,[t.message&&t.is_submitted?(s(),a("div",N,[e("p",P,o(t.message),1)])):i("",!0)])):(s(),a("div",x,[e("div",H,[e("div",null,[e("p",null,"Hi "+o(n.$page.props.user.name),1),B,C])])])),e("div",V,[e("div",E,[d(l,{class:"btn btn-primary",href:n.route("student.dashboard")},{default:y(()=>[k("Back to home")]),_:1},8,["href"])])])])}const G=g(b,[["render",S]]);export{G as default};