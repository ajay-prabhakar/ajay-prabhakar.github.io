import{s as I,n as S}from"../chunks/scheduler.6ebf42d0.js";import{S as O,i as T,s as y,g as v,B as W,f as d,c as E,h as g,j as k,C as B,k as m,a as w,z as u,F as D,m as b,n as j,o as z}from"../chunks/index.68cd4d08.js";import{e as A}from"../chunks/each.e59479a4.js";import{f as L}from"../chunks/dateTime.85771285.js";async function F({fetch:c}){return{posts:await(await c("api/projects")).json()}}const J=Object.freeze(Object.defineProperty({__proto__:null,load:F},Symbol.toStringTag,{value:"Module"}));function P(c,s,a){const n=c.slice();return n[1]=s[a],n}function q(c){let s,a,n=c[1].title+"",f,p,h,i,l,e=L(c[1].date,!0)+"",_,t;return{c(){s=v("li"),a=v("a"),f=b(n),h=y(),i=v("span"),l=b("- "),_=b(e),t=y(),this.h()},l(o){s=g(o,"LI",{});var r=k(s);a=g(r,"A",{href:!0,class:!0});var x=k(a);f=j(x,n),x.forEach(d),h=E(r),i=g(r,"SPAN",{class:!0});var C=k(i);l=j(C,"- "),_=j(C,e),C.forEach(d),t=E(r),r.forEach(d),this.h()},h(){m(a,"href",p="/work/"+c[1].slug),m(a,"class","text-link"),m(i,"class","quiet svelte-1hn26y2")},m(o,r){w(o,s,r),u(s,a),u(a,f),u(s,h),u(s,i),u(i,l),u(i,_),u(s,t)},p(o,r){r&1&&n!==(n=o[1].title+"")&&z(f,n),r&1&&p!==(p="/work/"+o[1].slug)&&m(a,"href",p),r&1&&e!==(e=L(o[1].date,!0)+"")&&z(_,e)},d(o){o&&d(s)}}}function H(c){let s,a,n,f="Work",p,h,i=A(c[0].posts),l=[];for(let e=0;e<i.length;e+=1)l[e]=q(P(c,i,e));return{c(){s=y(),a=v("article"),n=v("h1"),n.textContent=f,p=y(),h=v("ul");for(let e=0;e<l.length;e+=1)l[e].c();this.h()},l(e){W("svelte-1m8hdvu",document.head).forEach(d),s=E(e),a=g(e,"ARTICLE",{class:!0});var t=k(a);n=g(t,"H1",{"data-svelte-h":!0}),B(n)!=="svelte-trzwrh"&&(n.textContent=f),p=E(t),h=g(t,"UL",{class:!0});var o=k(h);for(let r=0;r<l.length;r+=1)l[r].l(o);o.forEach(d),t.forEach(d),this.h()},h(){document.title="Work",m(h,"class","list"),m(a,"class","article")},m(e,_){w(e,s,_),w(e,a,_),u(a,n),u(a,p),u(a,h);for(let t=0;t<l.length;t+=1)l[t]&&l[t].m(h,null)},p(e,[_]){if(_&1){i=A(e[0].posts);let t;for(t=0;t<i.length;t+=1){const o=P(e,i,t);l[t]?l[t].p(o,_):(l[t]=q(o),l[t].c(),l[t].m(h,null))}for(;t<l.length;t+=1)l[t].d(1);l.length=i.length}},i:S,o:S,d(e){e&&(d(s),d(a)),D(l,e)}}}function M(c,s,a){let{data:n}=s;return c.$$set=f=>{"data"in f&&a(0,n=f.data)},[n]}class K extends O{constructor(s){super(),T(this,s,M,H,I,{data:0})}}export{K as component,J as universal};
