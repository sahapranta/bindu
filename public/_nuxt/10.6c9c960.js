(window.webpackJsonp=window.webpackJsonp||[]).push([[10],{257:function(t,e,n){"use strict";n.r(e);n(13),n(11),n(8),n(6),n(12),n(94);var o=n(21),r=n(3),c=n(112);function l(object,t){var e=Object.keys(object);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(object);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(object,t).enumerable}))),e.push.apply(e,n)}return e}var h={head:function(){return{title:this.data.title}},data:function(){return{snackbar:!1,timeout:3e3,snacktext:"",data:{},loading:!1,items:[{icon:"mdi-facebook",text:"Share via Facebook",action:"fb"},{icon:"mdi-whatsapp",text:"Share to Whatsapp",action:"whatsapp"},{icon:"mdi-facebook-messenger",text:"Share via Messenger",action:"messenger"},{icon:"mdi-link",text:"Copy Link",action:"copy"}]}},computed:function(t){for(var i=1;i<arguments.length;i++){var source=null!=arguments[i]?arguments[i]:{};i%2?l(Object(source),!0).forEach((function(e){Object(r.a)(t,e,source[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(source)):l(Object(source)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(source,e))}))}return t}({noshare:function(){return!window.navigator.share}},Object(c.c)({posts:"data/posts"})),methods:{goto:function(t){this.$router.push({name:"blog.view",params:{slug:t}})},share:function(t){var data,e=this;"copy"===t?(data=window.location.href,new Promise((function(t,e){if(window.clipboardData&&window.clipboardData.setData)return clipboardData.setData("Text",data),t();if(document.queryCommandSupported&&document.queryCommandSupported("copy")){var textarea=document.createElement("textarea");textarea.textContent=data,textarea.style.position="fixed",document.body.appendChild(textarea),textarea.select();try{return document.execCommand("copy"),t()}catch(t){return console.warn("Copy to clipboard failed.",t),e(t)}finally{document.body.removeChild(textarea)}}})),this.snackbar=!0,this.snacktext="Shareable Link Copied to your clipboard"):"fb"===t||"whatsapp"===t?this.popupWindow("https://www.facebook.com/sharer/sharer.php?u=".concat(window.location.href)):"messenger"===t||"native"===t&&navigator.share({title:"".concat(window.title),url:"".concat(window.location.href)}).then((function(){e.snackbar=!0,e.snacktext="Thanks for Sharing"})).catch(console.error)},popupWindow:function(t,title){var e=arguments.length>2&&void 0!==arguments[2]?arguments[2]:360,n=arguments.length>3&&void 0!==arguments[3]?arguments[3]:220,o=window.top.outerHeight/2+window.top.screenY-n/2,r=window.top.outerWidth/2+window.top.screenX-e/2;return window.open(t,title,"toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=".concat(e,", height=").concat(n,", top=").concat(o,", left=").concat(r))},fetchData:function(){var t=this;return Object(o.a)(regeneratorRuntime.mark((function e(){var n,data;return regeneratorRuntime.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return t.loading=!0,e.prev=1,e.next=4,t.$api.get("/post/"+t.$route.params.slug);case 4:n=e.sent,data=n.data,t.data=data,e.next=12;break;case 9:e.prev=9,e.t0=e.catch(1),console.log(e.t0);case 12:t.loading=!1;case 13:case"end":return e.stop()}}),e,null,[[1,9]])})))()}},mounted:function(){this.fetchData(),0===this.posts.length&&this.$store.dispatch("data/getPosts")}},d=(n(440),n(42)),v=n(52),f=n.n(v),m=n(69),w=n(91),k=n(58),y=n(246),_=n(394),O=n(420),x=n(99),C=n(133),j=n(247),S=(n(32),n(34),n(17),n(441),n(51)),T=n(18),B=n(16),D=n(29),$=n(80),A=n(5),P=n(1),V=n(9),E=Object(A.a)(S.a,T.a,D.a,Object($.b)(["absolute","bottom","left","right","top"])).extend({name:"v-snackbar",props:{app:Boolean,centered:Boolean,contentClass:{type:String,default:""},multiLine:Boolean,text:Boolean,timeout:{type:[Number,String],default:5e3},transition:{type:[Boolean,String],default:"v-snack-transition",validator:function(t){return"string"==typeof t||!1===t}},vertical:Boolean},data:function(){return{activeTimeout:-1}},computed:{classes:function(){return{"v-snack--absolute":this.absolute,"v-snack--active":this.isActive,"v-snack--bottom":this.bottom||!this.top,"v-snack--centered":this.centered,"v-snack--has-background":this.hasBackground,"v-snack--left":this.left,"v-snack--multi-line":this.multiLine&&!this.vertical,"v-snack--right":this.right,"v-snack--text":this.text,"v-snack--top":this.top,"v-snack--vertical":this.vertical}},hasBackground:function(){return!this.text&&!this.outlined},isDark:function(){return this.hasBackground?!this.light:B.a.options.computed.isDark.call(this)},styles:function(){if(this.absolute)return{};var t=this.$vuetify.application,e=t.bar,n=t.bottom,footer=t.footer,o=t.insetFooter,r=t.left,c=t.right,l=t.top;return{paddingBottom:Object(P.g)(n+footer+o),paddingLeft:this.app?Object(P.g)(r):void 0,paddingRight:this.app?Object(P.g)(c):void 0,paddingTop:Object(P.g)(e+l)}}},watch:{isActive:"setTimeout",timeout:"setTimeout"},mounted:function(){this.isActive&&this.setTimeout()},created:function(){this.$attrs.hasOwnProperty("auto-height")&&Object(V.e)("auto-height",this),0==this.timeout&&Object(V.d)('timeout="0"',"-1",this)},methods:{genActions:function(){return this.$createElement("div",{staticClass:"v-snack__action "},[Object(P.s)(this,"action",{attrs:{class:"v-snack__btn"}})])},genContent:function(){return this.$createElement("div",{staticClass:"v-snack__content",class:Object(r.a)({},this.contentClass,!0),attrs:{role:"status","aria-live":"polite"}},[Object(P.s)(this)])},genWrapper:function(){var data=(this.hasBackground?this.setBackgroundColor:this.setTextColor)(this.color,{staticClass:"v-snack__wrapper",class:S.a.options.computed.classes.call(this),directives:[{name:"show",value:this.isActive}]});return this.$createElement("div",data,[this.genContent(),this.genActions()])},genTransition:function(){return this.$createElement("transition",{props:{name:this.transition}},[this.genWrapper()])},setTimeout:function(){var t=this;window.clearTimeout(this.activeTimeout);var e=Number(this.timeout);this.isActive&&![0,-1].includes(e)&&(this.activeTimeout=window.setTimeout((function(){t.isActive=!1}),e))}},render:function(t){return t("div",{staticClass:"v-snack",class:this.classes,style:this.styles},[!1!==this.transition?this.genTransition():this.genWrapper()])}}),L=n(374),component=Object(d.a)(h,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("v-container",{attrs:{fluid:""}},[n("v-img",{staticClass:"white--text align-end",attrs:{src:t.data.image_url,alt:t.data.slug,height:"55vh"}},[n("div",{staticClass:"display-2 white--text pl-4 pb-4 line-height elevation-6"},[t._v(t._s(t.data.title))])]),t._v(" "),n("div",{staticClass:"grey lighten-3 px-4 py-8 mb-4"},[n("div",{staticClass:"d-flex justify-space-between"},[n("div",{staticClass:"font-weight-light grey--text title mb-2"},[t._v("\n        Posted "+t._s(t.data.created)+"\n        "),n("v-icon",[t._v("mdi-clock-outline")])],1),t._v(" "),t.noshare?n("div",[t._l(t.items,(function(p,i){return[n("v-tooltip",{key:i,attrs:{bottom:""},scopedSlots:t._u([{key:"activator",fn:function(e){var o=e.on,r=e.attrs;return[n("v-btn",t._g(t._b({staticClass:"mr-1",attrs:{"x-small":"",fab:""},on:{click:function(e){return t.share(p.action)}}},"v-btn",r,!1),o),[n("v-icon",[t._v(t._s(p.icon))])],1)]}}],null,!0)},[t._v(" "),n("span",[t._v(t._s(p.text))])])]}))],2):n("div",[[n("v-tooltip",{attrs:{bottom:""},scopedSlots:t._u([{key:"activator",fn:function(e){var o=e.on,r=e.attrs;return[n("v-btn",t._g(t._b({attrs:{small:"",fab:""},on:{click:function(e){return t.share("native")}}},"v-btn",r,!1),o),[n("v-icon",[t._v("mdi-share")])],1)]}}])},[t._v(" "),n("span",[t._v("Share Now")])])]],2)]),t._v(" "),n("div",{domProps:{innerHTML:t._s(t.data.description)}})]),t._v(" "),n("v-row",{staticClass:"mb-12"},[t._l(t.posts.slice(0,3),(function(e,i){return[n("v-col",{key:i,attrs:{cols:"12",md:"4"}},[n("b",[t._v(t._s(i+1)+".")]),t._v(" "),n("v-hover",{scopedSlots:t._u([{key:"default",fn:function(o){var r=o.hover;return[n("v-card",{class:{"on-hover":r},attrs:{elevation:r?12:2},on:{click:function(n){return t.goto(e.slug)}}},[n("v-img",{staticClass:"white--text align-end",style:"opacity:"+(r?"1":"0.8"),attrs:{src:e.image_url,height:"150"}},[n("v-card-title",{staticClass:"line-height"},[t._v(t._s(e.title))])],1)],1)]}}],null,!0)})],1)]}))],2),t._v(" "),n("v-snackbar",{attrs:{timeout:t.timeout},scopedSlots:t._u([{key:"action",fn:function(e){var o=e.attrs;return[n("v-btn",t._b({attrs:{color:"white",icon:""},on:{click:function(e){t.snackbar=!1}}},"v-btn",o,!1),[n("v-icon",[t._v("mdi-close")])],1)]}}]),model:{value:t.snackbar,callback:function(e){t.snackbar=e},expression:"snackbar"}},[t._v("\n    "+t._s(t.snacktext)+"\n    ")])],1)}),[],!1,null,"2e130c74",null);e.default=component.exports;f()(component,{VBtn:m.a,VCard:w.a,VCardTitle:k.c,VCol:y.a,VContainer:_.a,VHover:O.a,VIcon:x.a,VImg:C.a,VRow:j.a,VSnackbar:E,VTooltip:L.a})},414:function(t,e,n){},420:function(t,e,n){"use strict";var o=n(101),r=n(29),c=n(5),l=n(9);e.a=Object(c.a)(o.a,r.a).extend({name:"v-hover",props:{disabled:{type:Boolean,default:!1},value:{type:Boolean,default:void 0}},methods:{onMouseEnter:function(){this.runDelay("open")},onMouseLeave:function(){this.runDelay("close")}},render:function(){return this.$scopedSlots.default||void 0!==this.value?(this.$scopedSlots.default&&(element=this.$scopedSlots.default({hover:this.isActive})),Array.isArray(element)&&1===element.length&&(element=element[0]),element&&!Array.isArray(element)&&element.tag?(this.disabled||(element.data=element.data||{},this._g(element.data,{mouseenter:this.onMouseEnter,mouseleave:this.onMouseLeave})),element):(Object(l.c)("v-hover should only contain a single element",this),element)):(Object(l.c)("v-hover is missing a default scopedSlot or bound value",this),null);var element}})},440:function(t,e,n){"use strict";var o=n(414);n.n(o).a},441:function(t,e,n){}}]);