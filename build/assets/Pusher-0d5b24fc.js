import{_ as r,L as n,H as c,a5 as i,ae as d,E as p,o as u,c as l,w as f,a as e}from"./app-ae2d89af.js";import m from"./Sidebar-3c623214.js";import _ from"./PageMainHeader-912a94ba.js";import h from"./Layout-248c6c4e.js";import v from"./PageHeader-38b8e3e2.js";const w={props:{student:Object},data(){return{}},name:"student-layout",components:{Link:n,Head:c,Layout:h,Sidebar:m,PageHeader:v,PageMainHeader:_},setup(t){const a=new i({broadcaster:"pusher",key:"9a98e2a6647e53d16130",cluster:"ap2",forceTLS:!0,encryption:!0});d(()=>{a.private("private-class."+t.student.class_id).notification(o=>{alert("A new assignment has created.")})})}},y=e("div",{class:"container-fluid"},[e("div",{class:"row mt-5"},[e("div",{class:"col-md-12"},[e("h1",null,"Realtime notifications")])])],-1);function L(t,a,o,g,k,x){const s=p("Layout");return u(),l(s,{pageTitle:"Profile"},{default:f(()=>[y]),_:1})}const E=r(w,[["render",L]]);export{E as default};