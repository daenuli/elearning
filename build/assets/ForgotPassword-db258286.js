import{u as d,o as l,e as n,b as e,h as o,a as s,t as m,f as _,m as u,v as p,G as h,w as f,n as w,F as g,H as v,g as b}from"./app-ae2d89af.js";import{_ as y}from"./AuthenticationCardLogo-5f4ea33f.js";import{_ as x}from"./InputError-33e6b925.js";import{_ as k}from"./PrimaryButton-43ba7321.js";const F={class:"page-wrapper"},N={class:"container-fluid p-0"},V={class:"authentication-main"},E={class:"row"},S={class:"col-md-12"},B={class:"auth-innerright"},C={class:"authentication-box"},P={class:"text-center"},$={class:"card mt-4"},D={class:"card-body"},H=s("p",null,"Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.",-1),M={key:0,class:"font-success f-w-600"},T=["onSubmit"],z={class:"mb-3"},G={class:"text-center"},j={__name:"ForgotPassword",props:{status:String},setup(a){const t=d({email:""}),r=()=>{t.post(route("password.email"))};return(J,i)=>(l(),n(g,null,[e(o(v),{title:"Forgot Password"}),s("div",F,[s("div",N,[s("div",V,[s("div",E,[s("div",S,[s("div",B,[s("div",C,[s("div",P,[e(y,{logo:"/public/images/logo.png"},null,8,["logo"])]),s("div",$,[s("div",D,[H,a.status?(l(),n("p",M,m(a.status),1)):_("",!0),s("form",{onSubmit:u(r,["prevent"])},[s("div",z,[p(s("input",{class:"form-control","onUpdate:modelValue":i[0]||(i[0]=c=>o(t).email=c),placeholder:"Enter Your Email",id:"email",type:"email"},null,512),[[h,o(t).email]]),e(x,{class:"mt-2",message:o(t).errors.email},null,8,["message"])]),s("div",G,[e(k,{class:w({"opacity-25":o(t).processing}),disabled:o(t).processing},{default:f(()=>[b(" Email Password Reset Link ")]),_:1},8,["class","disabled"])])],40,T)])])])])])])])])])],64))}};export{j as default};