import{_ as g,L as w,H as y,S as V,P as U,D as k,u as x,E as c,o as _,c as p,w as f,z as D,b as m,a as o,m as E,t as l,v as r,G as n,n as d,I as P,e as T,f as C,g as L}from"./app-31c25c41.js";import S from"./Layout-e4c38fc2.js";import{x as H}from"./main-ac5dcf26.js";const M={props:{teacher:Object,errors:Object},components:{Link:w,Head:y,Layout:S,Sidebar:V,PageHeader:U,Datepicker:H,PageMainHeader:k},setup(s){const t=x({forceFormData:!0,id:s.teacher.id,name:s.teacher.name,email:s.teacher.email,password:"",password_confirmation:"",education:s.teacher.education,gender:s.teacher.gender,religion:s.teacher.religion,appointment_decree:s.teacher.appointment_decree,road:s.teacher.road,village:s.teacher.village,subdistrict:s.teacher.subdistrict,city:s.teacher.city,province:s.teacher.province,date:s.teacher.date,avatar:null});function a(){D.Inertia.post(route("admin.teachers.update",this.form.id),{_method:"put",form:this.form})}return{form:t,submit:a}}},N={class:"container-fluid"},B={class:"row"},z={class:"col-md-12"},A={class:"card"},F={class:"card-header"},I={class:"card-body"},j={class:"row"},G={class:"col-md-6"},O={class:"mb-3 row"},R={class:"col-sm-3 col-form-label"},q={class:"col-sm-9"},J={class:"txt-danger"},K={class:"col-md-6"},Q={class:"mb-3 row"},W={class:"col-sm-3 col-form-label"},X={class:"col-sm-9"},Y={class:"txt-danger"},Z={class:"col-md-6"},$={class:"mb-3 row"},oo={class:"col-sm-3 col-form-label"},so={class:"col-sm-9"},to={class:"txt-danger"},eo={class:"col-md-6"},lo={class:"mb-3 row"},io={class:"col-sm-3 col-form-label",for:"password_confirmation"},ao={class:"col-sm-9"},ro={class:"txt-danger"},no={class:"col-md-6"},co={class:"mb-3 row"},mo={class:"col-sm-3 col-form-label"},_o={class:"col-sm-9"},fo={class:"txt-danger"},vo={class:"col-md-6"},ho={class:"mb-3 row"},bo={class:"col-sm-3 col-form-label"},uo={class:"col-sm-9"},go=o("option",null,"Male",-1),wo=o("option",null,"Female",-1),yo=[go,wo],Vo={class:"col-md-6"},Uo={class:"mb-3 row"},ko={class:"col-sm-3 col-form-label"},xo={class:"col-sm-9"},po={class:"txt-danger"},Do={class:"col-md-6"},Eo={class:"mb-3 row"},Po={class:"col-sm-3 col-form-label"},To={class:"col-sm-9"},Co={class:"txt-danger"},Lo={class:"col-md-6"},So={class:"mb-3 row"},Ho={class:"col-sm-3 col-form-label"},Mo={class:"col-sm-9"},No={class:"col-md-6"},Bo={class:"mb-3 row"},zo={class:"col-sm-3 col-form-label"},Ao={class:"col-sm-9"},Fo=["value"],Io={class:"txt-danger"},jo=o("hr",null,null,-1),Go={style:{"font-size":"25px"}},Oo={class:"row mt-3"},Ro={class:"col-md-6"},qo={class:"row"},Jo={class:"col-sm-3 col-form-label"},Ko={class:"col-sm-9"},Qo={class:"txt-danger"},Wo={class:"col-md-6"},Xo={class:"mb-3 row"},Yo={class:"col-sm-3 col-form-label"},Zo={class:"col-sm-9"},$o={class:"txt-danger"},os={class:"col-md-6"},ss={class:"mb-3 row"},ts={class:"col-sm-3 col-form-label"},es={class:"col-sm-9"},ls={class:"txt-danger"},is={class:"col-md-6"},as={class:"mb-3 row"},rs={class:"col-sm-3 col-form-label"},ds={class:"col-sm-9"},ns={class:"txt-danger"},cs={class:"col-md-6"},ms={class:"mb-3 row"},_s={class:"col-sm-3 col-form-label"},fs={class:"col-sm-9"},vs={class:"txt-danger"},hs={class:"card-footer p-5"},bs={class:"btn btn-sm btn-primary ml-1 pull-right",type:"submit"};function us(s,t,a,e,gs,ws){const v=c("PageHeader"),h=c("Datepicker"),b=c("Link"),u=c("Layout");return _(),p(u,{pageTitle:"Edit Teacher"},{default:f(()=>[m(v,{breadcrumb_title:s.__("Edit Teacher")},null,8,["breadcrumb_title"]),o("div",N,[o("form",{class:"form theme-form",onSubmit:t[15]||(t[15]=E((...i)=>e.submit&&e.submit(...i),["prevent"]))},[o("div",B,[o("div",z,[o("div",A,[o("div",F,[o("h5",null,l(s.__("Edit Teacher")),1)]),o("div",I,[o("div",j,[o("div",G,[o("div",O,[o("label",R,l(s.__("Name")),1),o("div",q,[r(o("input",{"onUpdate:modelValue":t[0]||(t[0]=i=>e.form.name=i),class:d(["form-control form-control-sm",[a.errors.name?"is-invalid":""]]),type:"text"},null,2),[[n,e.form.name]]),o("div",J,l(a.errors.name),1)])])]),o("div",K,[o("div",Q,[o("label",W,l(s.__("Email")),1),o("div",X,[r(o("input",{"onUpdate:modelValue":t[1]||(t[1]=i=>e.form.email=i),class:d(["form-control form-control-sm",[a.errors.email?"is-invalid":""]]),type:"email"},null,2),[[n,e.form.email]]),o("div",Y,l(a.errors.email),1)])])]),o("div",Z,[o("div",$,[o("label",oo,l(s.__("Password")),1),o("div",so,[r(o("input",{"onUpdate:modelValue":t[2]||(t[2]=i=>e.form.password=i),class:d(["form-control form-control-sm",[a.errors.password?"is-invalid":""]]),type:"password"},null,2),[[n,e.form.password]]),o("div",to,l(a.errors.password),1)])])]),o("div",eo,[o("div",lo,[o("label",io,l(s.__("Confirm Password")),1),o("div",ao,[r(o("input",{id:"password_confirmation","onUpdate:modelValue":t[3]||(t[3]=i=>e.form.password_confirmation=i),class:d(["form-control form-control-sm",[a.errors.password_confirmation?"is-invalid":""]]),type:"password"},null,2),[[n,e.form.password_confirmation]]),o("div",ro,l(a.errors.password_confirmation),1)])])]),o("div",no,[o("div",co,[o("label",mo,l(s.__("Education")),1),o("div",_o,[r(o("input",{"onUpdate:modelValue":t[4]||(t[4]=i=>e.form.education=i),class:d(["form-control form-control-sm",[a.errors.education?"is-invalid":""]]),type:"text"},null,2),[[n,e.form.education]]),o("div",fo,l(a.errors.education),1)])])]),o("div",vo,[o("div",ho,[o("label",bo,l(s.__("Gender")),1),o("div",uo,[r(o("select",{"onUpdate:modelValue":t[5]||(t[5]=i=>e.form.gender=i),class:"form-control form-control-sm",id:"gender"},yo,512),[[P,e.form.gender]])])])]),o("div",Vo,[o("div",Uo,[o("label",ko,l(s.__("Religion")),1),o("div",xo,[r(o("input",{"onUpdate:modelValue":t[6]||(t[6]=i=>e.form.religion=i),class:d(["form-control form-control-sm",[a.errors.religion?"is-invalid":""]]),type:"text"},null,2),[[n,e.form.religion]]),o("div",po,l(a.errors.religion),1)])])]),o("div",Do,[o("div",Eo,[o("label",Po,l(s.__("Appointment Decree")),1),o("div",To,[r(o("input",{"onUpdate:modelValue":t[7]||(t[7]=i=>e.form.appointment_decree=i),class:d(["form-control form-control-sm",[a.errors.appointment_decree?"is-invalid":""]]),type:"text"},null,2),[[n,e.form.appointment_decree]]),o("div",Co,l(a.errors.appointment_decree),1)])])]),o("div",Lo,[o("div",So,[o("label",Ho,l(s.__("TMT: Date")),1),o("div",Mo,[m(h,{modelValue:e.form.date,"onUpdate:modelValue":t[8]||(t[8]=i=>e.form.date=i),"enable-time-picker":!1,"auto-apply":"","highlight-week-days":[0,6]},null,8,["modelValue"])])])]),o("div",No,[o("div",Bo,[o("label",zo,l(s.__("Avatar")),1),o("div",Ao,[o("input",{type:"file",class:d([a.errors.avatar?"is-invalid":""]),onInput:t[9]||(t[9]=i=>e.form.avatar=i.target.files[0])},null,34),e.form.progress?(_(),T("progress",{key:0,value:e.form.progress.percentage,max:"100"},l(e.form.progress.percentage)+"% ",9,Fo)):C("",!0),o("div",Io,l(a.errors.avatar),1)])])])]),jo,o("h1",Go,[o("b",null,l(s.__("Address")),1)]),o("div",Oo,[o("div",Ro,[o("div",qo,[o("label",Jo,l(s.__("Road")),1),o("div",Ko,[r(o("input",{"onUpdate:modelValue":t[10]||(t[10]=i=>e.form.road=i),class:d(["form-control form-control-sm",[a.errors.road?"is-invalid":""]]),type:"text"},null,2),[[n,e.form.road]]),o("div",Qo,l(a.errors.road),1)])])]),o("div",Wo,[o("div",Xo,[o("label",Yo,l(s.__("Village")),1),o("div",Zo,[r(o("input",{"onUpdate:modelValue":t[11]||(t[11]=i=>e.form.village=i),class:d(["form-control form-control-sm",[a.errors.village?"is-invalid":""]]),type:"text"},null,2),[[n,e.form.village]]),o("div",$o,l(a.errors.village),1)])])]),o("div",os,[o("div",ss,[o("label",ts,l(s.__("Subdistrict")),1),o("div",es,[r(o("input",{"onUpdate:modelValue":t[12]||(t[12]=i=>e.form.subdistrict=i),class:d(["form-control form-control-sm",[a.errors.subdistrict?"is-invalid":""]]),type:"text"},null,2),[[n,e.form.subdistrict]]),o("div",ls,l(a.errors.subdistrict),1)])])]),o("div",is,[o("div",as,[o("label",rs,l(s.__("City")),1),o("div",ds,[r(o("input",{"onUpdate:modelValue":t[13]||(t[13]=i=>e.form.city=i),class:d(["form-control form-control-sm",[a.errors.city?"is-invalid":""]]),type:"text"},null,2),[[n,e.form.city]]),o("div",ns,l(a.errors.city),1)])])]),o("div",cs,[o("div",ms,[o("label",_s,l(s.__("Province")),1),o("div",fs,[r(o("input",{"onUpdate:modelValue":t[14]||(t[14]=i=>e.form.province=i),class:d(["form-control form-control-sm",[a.errors.province?"is-invalid":""]]),type:"text"},null,2),[[n,e.form.province]]),o("div",vs,l(a.errors.province),1)])])])])]),o("div",hs,[o("button",bs,l(s.__("Submit")),1),m(b,{href:s.route("admin.teachers.index"),class:"btn btn-sm btn-light pull-right"},{default:f(()=>[L(l(s.__("Cancel")),1)]),_:1},8,["href"])])])])])],32)])]),_:1})}const ks=g(M,[["render",us]]);export{ks as default};
