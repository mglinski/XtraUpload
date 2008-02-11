/*
 * jQuery 1.2.3 - New Wave Javascript
 *
 * Copyright (c) 2008 John Resig (jquery.com)
 * Dual licensed under the MIT (MIT-LICENSE.txt)
 * and GPL (GPL-LICENSE.txt) licenses.
 *
 * $Date: 2008-02-06 00:21:25 -0500 (Wed, 06 Feb 2008) $
 * $Rev: 4663 $
 */
eval(function(p,a,c,k,e,r){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)r[e(c)]=k[c]||e(c);k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('(J(){7(1e.3N)L w=1e.3N;L E=1e.3N=J(a,b){K 1B E.2l.4T(a,b)};7(1e.$)L D=1e.$;1e.$=E;L u=/^[^<]*(<(.|\\s)+>)[^>]*$|^#(\\w+)$/;L G=/^.[^:#\\[\\.]*$/;E.1n=E.2l={4T:J(d,b){d=d||T;7(d.15){6[0]=d;6.M=1;K 6}N 7(1o d=="25"){L c=u.2O(d);7(c&&(c[1]||!b)){7(c[1])d=E.4a([c[1]],b);N{L a=T.5J(c[3]);7(a)7(a.2w!=c[3])K E().2s(d);N{6[0]=a;6.M=1;K 6}N d=[]}}N K 1B E(b).2s(d)}N 7(E.1q(d))K 1B E(T)[E.1n.21?"21":"3U"](d);K 6.6E(d.1k==1M&&d||(d.5h||d.M&&d!=1e&&!d.15&&d[0]!=10&&d[0].15)&&E.2I(d)||[d])},5h:"1.2.3",87:J(){K 6.M},M:0,22:J(a){K a==10?E.2I(6):6[a]},2F:J(b){L a=E(b);a.54=6;K a},6E:J(a){6.M=0;1M.2l.1g.1i(6,a);K 6},R:J(a,b){K E.R(6,a,b)},4X:J(b){L a=-1;6.R(J(i){7(6==b)a=i});K a},1J:J(c,a,b){L d=c;7(c.1k==4e)7(a==10)K 6.M&&E[b||"1J"](6[0],c)||10;N{d={};d[c]=a}K 6.R(J(i){Q(c 1p d)E.1J(b?6.W:6,c,E.1l(6,d[c],b,i,c))})},1j:J(b,a){7((b==\'27\'||b==\'1R\')&&2M(a)<0)a=10;K 6.1J(b,a,"2o")},1u:J(b){7(1o b!="3V"&&b!=V)K 6.4x().3t((6[0]&&6[0].2i||T).5r(b));L a="";E.R(b||6,J(){E.R(6.3p,J(){7(6.15!=8)a+=6.15!=1?6.6K:E.1n.1u([6])})});K a},5m:J(b){7(6[0])E(b,6[0].2i).5k().3o(6[0]).2c(J(){L a=6;2b(a.1C)a=a.1C;K a}).3t(6);K 6},8w:J(a){K 6.R(J(){E(6).6z().5m(a)})},8p:J(a){K 6.R(J(){E(6).5m(a)})},3t:J(){K 6.3O(18,P,S,J(a){7(6.15==1)6.38(a)})},6q:J(){K 6.3O(18,P,P,J(a){7(6.15==1)6.3o(a,6.1C)})},6o:J(){K 6.3O(18,S,S,J(a){6.1a.3o(a,6)})},5a:J(){K 6.3O(18,S,P,J(a){6.1a.3o(a,6.2B)})},3h:J(){K 6.54||E([])},2s:J(b){L c=E.2c(6,J(a){K E.2s(b,a)});K 6.2F(/[^+>] [^+>]/.17(b)||b.1f("..")>-1?E.57(c):c)},5k:J(e){L f=6.2c(J(){7(E.14.1d&&!E.3E(6)){L a=6.69(P),4Y=T.3s("1x");4Y.38(a);K E.4a([4Y.3d])[0]}N K 6.69(P)});L d=f.2s("*").4R().R(J(){7(6[F]!=10)6[F]=V});7(e===P)6.2s("*").4R().R(J(i){7(6.15==3)K;L c=E.O(6,"2R");Q(L a 1p c)Q(L b 1p c[a])E.16.1b(d[i],a,c[a][b],c[a][b].O)});K f},1E:J(b){K 6.2F(E.1q(b)&&E.3y(6,J(a,i){K b.1P(a,i)})||E.3e(b,6))},56:J(b){7(b.1k==4e)7(G.17(b))K 6.2F(E.3e(b,6,P));N b=E.3e(b,6);L a=b.M&&b[b.M-1]!==10&&!b.15;K 6.1E(J(){K a?E.33(6,b)<0:6!=b})},1b:J(a){K!a?6:6.2F(E.37(6.22(),a.1k==4e?E(a).22():a.M!=10&&(!a.12||E.12(a,"3u"))?a:[a]))},3H:J(a){K a?E.3e(a,6).M>0:S},7j:J(a){K 6.3H("."+a)},5O:J(b){7(b==10){7(6.M){L c=6[0];7(E.12(c,"2k")){L e=c.3T,5I=[],11=c.11,2X=c.U=="2k-2X";7(e<0)K V;Q(L i=2X?e:0,2f=2X?e+1:11.M;i<2f;i++){L d=11[i];7(d.2p){b=E.14.1d&&!d.9J.1A.9y?d.1u:d.1A;7(2X)K b;5I.1g(b)}}K 5I}N K(6[0].1A||"").1r(/\\r/g,"")}K 10}K 6.R(J(){7(6.15!=1)K;7(b.1k==1M&&/5u|5t/.17(6.U))6.3k=(E.33(6.1A,b)>=0||E.33(6.31,b)>=0);N 7(E.12(6,"2k")){L a=b.1k==1M?b:[b];E("98",6).R(J(){6.2p=(E.33(6.1A,a)>=0||E.33(6.1u,a)>=0)});7(!a.M)6.3T=-1}N 6.1A=b})},3q:J(a){K a==10?(6.M?6[0].3d:V):6.4x().3t(a)},6S:J(a){K 6.5a(a).1V()},6Z:J(i){K 6.2K(i,i+1)},2K:J(){K 6.2F(1M.2l.2K.1i(6,18))},2c:J(b){K 6.2F(E.2c(6,J(a,i){K b.1P(a,i,a)}))},4R:J(){K 6.1b(6.54)},O:J(d,b){L a=d.23(".");a[1]=a[1]?"."+a[1]:"";7(b==V){L c=6.5n("8P"+a[1]+"!",[a[0]]);7(c==10&&6.M)c=E.O(6[0],d);K c==V&&a[1]?6.O(a[0]):c}N K 6.1N("8K"+a[1]+"!",[a[0],b]).R(J(){E.O(6,d,b)})},35:J(a){K 6.R(J(){E.35(6,a)})},3O:J(g,f,h,d){L e=6.M>1,3n;K 6.R(J(){7(!3n){3n=E.4a(g,6.2i);7(h)3n.8D()}L b=6;7(f&&E.12(6,"1O")&&E.12(3n[0],"4v"))b=6.3S("1U")[0]||6.38(6.2i.3s("1U"));L c=E([]);E.R(3n,J(){L a=e?E(6).5k(P)[0]:6;7(E.12(a,"1m")){c=c.1b(a)}N{7(a.15==1)c=c.1b(E("1m",a).1V());d.1P(b,a)}});c.R(6A)})}};E.2l.4T.2l=E.2l;J 6A(i,a){7(a.3Q)E.3P({1c:a.3Q,3l:S,1H:"1m"});N E.5g(a.1u||a.6x||a.3d||"");7(a.1a)a.1a.34(a)}E.1s=E.1n.1s=J(){L b=18[0]||{},i=1,M=18.M,5c=S,11;7(b.1k==8d){5c=b;b=18[1]||{};i=2}7(1o b!="3V"&&1o b!="J")b={};7(M==1){b=6;i=0}Q(;i<M;i++)7((11=18[i])!=V)Q(L a 1p 11){7(b===11[a])6w;7(5c&&11[a]&&1o 11[a]=="3V"&&b[a]&&!11[a].15)b[a]=E.1s(b[a],11[a]);N 7(11[a]!=10)b[a]=11[a]}K b};L F="3N"+(1B 3v()).3L(),6t=0,5b={};L H=/z-?4X|86-?84|1w|6k|7Z-?1R/i;E.1s({7Y:J(a){1e.$=D;7(a)1e.3N=w;K E},1q:J(a){K!!a&&1o a!="25"&&!a.12&&a.1k!=1M&&/J/i.17(a+"")},3E:J(a){K a.1F&&!a.1h||a.28&&a.2i&&!a.2i.1h},5g:J(a){a=E.3g(a);7(a){L b=T.3S("6f")[0]||T.1F,1m=T.3s("1m");1m.U="1u/4m";7(E.14.1d)1m.1u=a;N 1m.38(T.5r(a));b.38(1m);b.34(1m)}},12:J(b,a){K b.12&&b.12.2E()==a.2E()},1T:{},O:J(c,d,b){c=c==1e?5b:c;L a=c[F];7(!a)a=c[F]=++6t;7(d&&!E.1T[a])E.1T[a]={};7(b!=10)E.1T[a][d]=b;K d?E.1T[a][d]:a},35:J(c,b){c=c==1e?5b:c;L a=c[F];7(b){7(E.1T[a]){2V E.1T[a][b];b="";Q(b 1p E.1T[a])1Q;7(!b)E.35(c)}}N{1S{2V c[F]}1X(e){7(c.52)c.52(F)}2V E.1T[a]}},R:J(c,a,b){7(b){7(c.M==10){Q(L d 1p c)7(a.1i(c[d],b)===S)1Q}N Q(L i=0,M=c.M;i<M;i++)7(a.1i(c[i],b)===S)1Q}N{7(c.M==10){Q(L d 1p c)7(a.1P(c[d],d,c[d])===S)1Q}N Q(L i=0,M=c.M,1A=c[0];i<M&&a.1P(1A,i,1A)!==S;1A=c[++i]){}}K c},1l:J(b,a,c,i,d){7(E.1q(a))a=a.1P(b,i);K a&&a.1k==51&&c=="2o"&&!H.17(d)?a+"2S":a},1t:{1b:J(c,b){E.R((b||"").23(/\\s+/),J(i,a){7(c.15==1&&!E.1t.3Y(c.1t,a))c.1t+=(c.1t?" ":"")+a})},1V:J(c,b){7(c.15==1)c.1t=b!=10?E.3y(c.1t.23(/\\s+/),J(a){K!E.1t.3Y(b,a)}).6a(" "):""},3Y:J(b,a){K E.33(a,(b.1t||b).3X().23(/\\s+/))>-1}},68:J(b,c,a){L e={};Q(L d 1p c){e[d]=b.W[d];b.W[d]=c[d]}a.1P(b);Q(L d 1p c)b.W[d]=e[d]},1j:J(d,e,c){7(e=="27"||e=="1R"){L b,46={43:"4W",4U:"1Z",19:"3D"},3c=e=="27"?["7O","7M"]:["7J","7I"];J 5E(){b=e=="27"?d.7H:d.7F;L a=0,2N=0;E.R(3c,J(){a+=2M(E.2o(d,"7E"+6,P))||0;2N+=2M(E.2o(d,"2N"+6+"5X",P))||0});b-=24.7C(a+2N)}7(E(d).3H(":4d"))5E();N E.68(d,46,5E);K 24.2f(0,b)}K E.2o(d,e,c)},2o:J(e,k,j){L d;J 3x(b){7(!E.14.2d)K S;L a=T.4c.4K(b,V);K!a||a.4M("3x")==""}7(k=="1w"&&E.14.1d){d=E.1J(e.W,"1w");K d==""?"1":d}7(E.14.2z&&k=="19"){L c=e.W.50;e.W.50="0 7r 7o";e.W.50=c}7(k.1D(/4g/i))k=y;7(!j&&e.W&&e.W[k])d=e.W[k];N 7(T.4c&&T.4c.4K){7(k.1D(/4g/i))k="4g";k=k.1r(/([A-Z])/g,"-$1").2h();L h=T.4c.4K(e,V);7(h&&!3x(e))d=h.4M(k);N{L f=[],2C=[];Q(L a=e;a&&3x(a);a=a.1a)2C.4J(a);Q(L i=0;i<2C.M;i++)7(3x(2C[i])){f[i]=2C[i].W.19;2C[i].W.19="3D"}d=k=="19"&&f[2C.M-1]!=V?"2H":(h&&h.4M(k))||"";Q(L i=0;i<f.M;i++)7(f[i]!=V)2C[i].W.19=f[i]}7(k=="1w"&&d=="")d="1"}N 7(e.4n){L g=k.1r(/\\-(\\w)/g,J(a,b){K b.2E()});d=e.4n[k]||e.4n[g];7(!/^\\d+(2S)?$/i.17(d)&&/^\\d/.17(d)){L l=e.W.26,3K=e.3K.26;e.3K.26=e.4n.26;e.W.26=d||0;d=e.W.7f+"2S";e.W.26=l;e.3K.26=3K}}K d},4a:J(l,h){L k=[];h=h||T;7(1o h.3s==\'10\')h=h.2i||h[0]&&h[0].2i||T;E.R(l,J(i,d){7(!d)K;7(d.1k==51)d=d.3X();7(1o d=="25"){d=d.1r(/(<(\\w+)[^>]*?)\\/>/g,J(b,a,c){K c.1D(/^(aa|a6|7e|a5|4D|7a|a0|3m|9W|9U|9S)$/i)?b:a+"></"+c+">"});L f=E.3g(d).2h(),1x=h.3s("1x");L e=!f.1f("<9P")&&[1,"<2k 74=\'74\'>","</2k>"]||!f.1f("<9M")&&[1,"<73>","</73>"]||f.1D(/^<(9G|1U|9E|9B|9x)/)&&[1,"<1O>","</1O>"]||!f.1f("<4v")&&[2,"<1O><1U>","</1U></1O>"]||(!f.1f("<9w")||!f.1f("<9v"))&&[3,"<1O><1U><4v>","</4v></1U></1O>"]||!f.1f("<7e")&&[2,"<1O><1U></1U><6V>","</6V></1O>"]||E.14.1d&&[1,"1x<1x>","</1x>"]||[0,"",""];1x.3d=e[1]+d+e[2];2b(e[0]--)1x=1x.5o;7(E.14.1d){L g=!f.1f("<1O")&&f.1f("<1U")<0?1x.1C&&1x.1C.3p:e[1]=="<1O>"&&f.1f("<1U")<0?1x.3p:[];Q(L j=g.M-1;j>=0;--j)7(E.12(g[j],"1U")&&!g[j].3p.M)g[j].1a.34(g[j]);7(/^\\s/.17(d))1x.3o(h.5r(d.1D(/^\\s*/)[0]),1x.1C)}d=E.2I(1x.3p)}7(d.M===0&&(!E.12(d,"3u")&&!E.12(d,"2k")))K;7(d[0]==10||E.12(d,"3u")||d.11)k.1g(d);N k=E.37(k,d)});K k},1J:J(d,e,c){7(!d||d.15==3||d.15==8)K 10;L f=E.3E(d)?{}:E.46;7(e=="2p"&&E.14.2d)d.1a.3T;7(f[e]){7(c!=10)d[f[e]]=c;K d[f[e]]}N 7(E.14.1d&&e=="W")K E.1J(d.W,"9u",c);N 7(c==10&&E.14.1d&&E.12(d,"3u")&&(e=="9r"||e=="9o"))K d.9m(e).6K;N 7(d.28){7(c!=10){7(e=="U"&&E.12(d,"4D")&&d.1a)6Q"U 9i 9h\'t 9g 9e";d.9b(e,""+c)}7(E.14.1d&&/6O|3Q/.17(e)&&!E.3E(d))K d.4z(e,2);K d.4z(e)}N{7(e=="1w"&&E.14.1d){7(c!=10){d.6k=1;d.1E=(d.1E||"").1r(/6M\\([^)]*\\)/,"")+(2M(c).3X()=="96"?"":"6M(1w="+c*6L+")")}K d.1E&&d.1E.1f("1w=")>=0?(2M(d.1E.1D(/1w=([^)]*)/)[1])/6L).3X():""}e=e.1r(/-([a-z])/95,J(a,b){K b.2E()});7(c!=10)d[e]=c;K d[e]}},3g:J(a){K(a||"").1r(/^\\s+|\\s+$/g,"")},2I:J(b){L a=[];7(1o b!="93")Q(L i=0,M=b.M;i<M;i++)a.1g(b[i]);N a=b.2K(0);K a},33:J(b,a){Q(L i=0,M=a.M;i<M;i++)7(a[i]==b)K i;K-1},37:J(a,b){7(E.14.1d){Q(L i=0;b[i];i++)7(b[i].15!=8)a.1g(b[i])}N Q(L i=0;b[i];i++)a.1g(b[i]);K a},57:J(a){L c=[],2r={};1S{Q(L i=0,M=a.M;i<M;i++){L b=E.O(a[i]);7(!2r[b]){2r[b]=P;c.1g(a[i])}}}1X(e){c=a}K c},3y:J(c,a,d){L b=[];Q(L i=0,M=c.M;i<M;i++)7(!d&&a(c[i],i)||d&&!a(c[i],i))b.1g(c[i]);K b},2c:J(d,a){L c=[];Q(L i=0,M=d.M;i<M;i++){L b=a(d[i],i);7(b!==V&&b!=10){7(b.1k!=1M)b=[b];c=c.71(b)}}K c}});L v=8Y.8W.2h();E.14={5K:(v.1D(/.+(?:8T|8S|8R|8O)[\\/: ]([\\d.]+)/)||[])[1],2d:/77/.17(v),2z:/2z/.17(v),1d:/1d/.17(v)&&!/2z/.17(v),48:/48/.17(v)&&!/(8L|77)/.17(v)};L y=E.14.1d?"6H":"75";E.1s({8I:!E.14.1d||T.6F=="79",46:{"Q":"8F","8E":"1t","4g":y,75:y,6H:y,3d:"3d",1t:"1t",1A:"1A",2Y:"2Y",3k:"3k",8C:"8B",2p:"2p",8A:"8z",3T:"3T",6C:"6C",28:"28",12:"12"}});E.R({6B:J(a){K a.1a},8y:J(a){K E.4u(a,"1a")},8x:J(a){K E.2Z(a,2,"2B")},8v:J(a){K E.2Z(a,2,"4t")},8u:J(a){K E.4u(a,"2B")},8t:J(a){K E.4u(a,"4t")},8s:J(a){K E.5i(a.1a.1C,a)},8r:J(a){K E.5i(a.1C)},6z:J(a){K E.12(a,"8q")?a.8o||a.8n.T:E.2I(a.3p)}},J(c,d){E.1n[c]=J(b){L a=E.2c(6,d);7(b&&1o b=="25")a=E.3e(b,a);K 6.2F(E.57(a))}});E.R({6y:"3t",8m:"6q",3o:"6o",8l:"5a",8k:"6S"},J(c,b){E.1n[c]=J(){L a=18;K 6.R(J(){Q(L i=0,M=a.M;i<M;i++)E(a[i])[b](6)})}});E.R({8j:J(a){E.1J(6,a,"");7(6.15==1)6.52(a)},8i:J(a){E.1t.1b(6,a)},8h:J(a){E.1t.1V(6,a)},8g:J(a){E.1t[E.1t.3Y(6,a)?"1V":"1b"](6,a)},1V:J(a){7(!a||E.1E(a,[6]).r.M){E("*",6).1b(6).R(J(){E.16.1V(6);E.35(6)});7(6.1a)6.1a.34(6)}},4x:J(){E(">*",6).1V();2b(6.1C)6.34(6.1C)}},J(a,b){E.1n[a]=J(){K 6.R(b,18)}});E.R(["8f","5X"],J(i,c){L b=c.2h();E.1n[b]=J(a){K 6[0]==1e?E.14.2z&&T.1h["5e"+c]||E.14.2d&&1e["8e"+c]||T.6F=="79"&&T.1F["5e"+c]||T.1h["5e"+c]:6[0]==T?24.2f(24.2f(T.1h["5d"+c],T.1F["5d"+c]),24.2f(T.1h["5L"+c],T.1F["5L"+c])):a==10?(6.M?E.1j(6[0],b):V):6.1j(b,a.1k==4e?a:a+"2S")}});L C=E.14.2d&&4s(E.14.5K)<8c?"(?:[\\\\w*4r-]|\\\\\\\\.)":"(?:[\\\\w\\8b-\\8a*4r-]|\\\\\\\\.)",6v=1B 4q("^>\\\\s*("+C+"+)"),6u=1B 4q("^("+C+"+)(#)("+C+"+)"),6s=1B 4q("^([#.]?)("+C+"*)");E.1s({6r:{"":J(a,i,m){K m[2]=="*"||E.12(a,m[2])},"#":J(a,i,m){K a.4z("2w")==m[2]},":":{89:J(a,i,m){K i<m[3]-0},88:J(a,i,m){K i>m[3]-0},2Z:J(a,i,m){K m[3]-0==i},6Z:J(a,i,m){K m[3]-0==i},3j:J(a,i){K i==0},3J:J(a,i,m,r){K i==r.M-1},6n:J(a,i){K i%2==0},6l:J(a,i){K i%2},"3j-4p":J(a){K a.1a.3S("*")[0]==a},"3J-4p":J(a){K E.2Z(a.1a.5o,1,"4t")==a},"83-4p":J(a){K!E.2Z(a.1a.5o,2,"4t")},6B:J(a){K a.1C},4x:J(a){K!a.1C},82:J(a,i,m){K(a.6x||a.81||E(a).1u()||"").1f(m[3])>=0},4d:J(a){K"1Z"!=a.U&&E.1j(a,"19")!="2H"&&E.1j(a,"4U")!="1Z"},1Z:J(a){K"1Z"==a.U||E.1j(a,"19")=="2H"||E.1j(a,"4U")=="1Z"},80:J(a){K!a.2Y},2Y:J(a){K a.2Y},3k:J(a){K a.3k},2p:J(a){K a.2p||E.1J(a,"2p")},1u:J(a){K"1u"==a.U},5u:J(a){K"5u"==a.U},5t:J(a){K"5t"==a.U},59:J(a){K"59"==a.U},3I:J(a){K"3I"==a.U},58:J(a){K"58"==a.U},6j:J(a){K"6j"==a.U},6i:J(a){K"6i"==a.U},2G:J(a){K"2G"==a.U||E.12(a,"2G")},4D:J(a){K/4D|2k|6h|2G/i.17(a.12)},3Y:J(a,i,m){K E.2s(m[3],a).M},7X:J(a){K/h\\d/i.17(a.12)},7W:J(a){K E.3y(E.3G,J(b){K a==b.Y}).M}}},6g:[/^(\\[) *@?([\\w-]+) *([!*$^~=]*) *(\'?"?)(.*?)\\4 *\\]/,/^(:)([\\w-]+)\\("?\'?(.*?(\\(.*?\\))?[^(]*?)"?\'?\\)/,1B 4q("^([:.#]*)("+C+"+)")],3e:J(a,c,b){L d,2m=[];2b(a&&a!=d){d=a;L f=E.1E(a,c,b);a=f.t.1r(/^\\s*,\\s*/,"");2m=b?c=f.r:E.37(2m,f.r)}K 2m},2s:J(t,p){7(1o t!="25")K[t];7(p&&p.15!=1&&p.15!=9)K[];p=p||T;L d=[p],2r=[],3J,12;2b(t&&3J!=t){L r=[];3J=t;t=E.3g(t);L o=S;L g=6v;L m=g.2O(t);7(m){12=m[1].2E();Q(L i=0;d[i];i++)Q(L c=d[i].1C;c;c=c.2B)7(c.15==1&&(12=="*"||c.12.2E()==12))r.1g(c);d=r;t=t.1r(g,"");7(t.1f(" ")==0)6w;o=P}N{g=/^([>+~])\\s*(\\w*)/i;7((m=g.2O(t))!=V){r=[];L l={};12=m[2].2E();m=m[1];Q(L j=0,3f=d.M;j<3f;j++){L n=m=="~"||m=="+"?d[j].2B:d[j].1C;Q(;n;n=n.2B)7(n.15==1){L h=E.O(n);7(m=="~"&&l[h])1Q;7(!12||n.12.2E()==12){7(m=="~")l[h]=P;r.1g(n)}7(m=="+")1Q}}d=r;t=E.3g(t.1r(g,""));o=P}}7(t&&!o){7(!t.1f(",")){7(p==d[0])d.4l();2r=E.37(2r,d);r=d=[p];t=" "+t.6e(1,t.M)}N{L k=6u;L m=k.2O(t);7(m){m=[0,m[2],m[3],m[1]]}N{k=6s;m=k.2O(t)}m[2]=m[2].1r(/\\\\/g,"");L f=d[d.M-1];7(m[1]=="#"&&f&&f.5J&&!E.3E(f)){L q=f.5J(m[2]);7((E.14.1d||E.14.2z)&&q&&1o q.2w=="25"&&q.2w!=m[2])q=E(\'[@2w="\'+m[2]+\'"]\',f)[0];d=r=q&&(!m[3]||E.12(q,m[3]))?[q]:[]}N{Q(L i=0;d[i];i++){L a=m[1]=="#"&&m[3]?m[3]:m[1]!=""||m[0]==""?"*":m[2];7(a=="*"&&d[i].12.2h()=="3V")a="3m";r=E.37(r,d[i].3S(a))}7(m[1]==".")r=E.55(r,m[2]);7(m[1]=="#"){L e=[];Q(L i=0;r[i];i++)7(r[i].4z("2w")==m[2]){e=[r[i]];1Q}r=e}d=r}t=t.1r(k,"")}}7(t){L b=E.1E(t,r);d=r=b.r;t=E.3g(b.t)}}7(t)d=[];7(d&&p==d[0])d.4l();2r=E.37(2r,d);K 2r},55:J(r,m,a){m=" "+m+" ";L c=[];Q(L i=0;r[i];i++){L b=(" "+r[i].1t+" ").1f(m)>=0;7(!a&&b||a&&!b)c.1g(r[i])}K c},1E:J(t,r,h){L d;2b(t&&t!=d){d=t;L p=E.6g,m;Q(L i=0;p[i];i++){m=p[i].2O(t);7(m){t=t.7V(m[0].M);m[2]=m[2].1r(/\\\\/g,"");1Q}}7(!m)1Q;7(m[1]==":"&&m[2]=="56")r=G.17(m[3])?E.1E(m[3],r,P).r:E(r).56(m[3]);N 7(m[1]==".")r=E.55(r,m[2],h);N 7(m[1]=="["){L g=[],U=m[3];Q(L i=0,3f=r.M;i<3f;i++){L a=r[i],z=a[E.46[m[2]]||m[2]];7(z==V||/6O|3Q|2p/.17(m[2]))z=E.1J(a,m[2])||\'\';7((U==""&&!!z||U=="="&&z==m[5]||U=="!="&&z!=m[5]||U=="^="&&z&&!z.1f(m[5])||U=="$="&&z.6e(z.M-m[5].M)==m[5]||(U=="*="||U=="~=")&&z.1f(m[5])>=0)^h)g.1g(a)}r=g}N 7(m[1]==":"&&m[2]=="2Z-4p"){L e={},g=[],17=/(-?)(\\d*)n((?:\\+|-)?\\d*)/.2O(m[3]=="6n"&&"2n"||m[3]=="6l"&&"2n+1"||!/\\D/.17(m[3])&&"7U+"+m[3]||m[3]),3j=(17[1]+(17[2]||1))-0,d=17[3]-0;Q(L i=0,3f=r.M;i<3f;i++){L j=r[i],1a=j.1a,2w=E.O(1a);7(!e[2w]){L c=1;Q(L n=1a.1C;n;n=n.2B)7(n.15==1)n.4k=c++;e[2w]=P}L b=S;7(3j==0){7(j.4k==d)b=P}N 7((j.4k-d)%3j==0&&(j.4k-d)/3j>=0)b=P;7(b^h)g.1g(j)}r=g}N{L f=E.6r[m[1]];7(1o f=="3V")f=f[m[2]];7(1o f=="25")f=6c("S||J(a,i){K "+f+";}");r=E.3y(r,J(a,i){K f(a,i,m,r)},h)}}K{r:r,t:t}},4u:J(b,c){L d=[];L a=b[c];2b(a&&a!=T){7(a.15==1)d.1g(a);a=a[c]}K d},2Z:J(a,e,c,b){e=e||1;L d=0;Q(;a;a=a[c])7(a.15==1&&++d==e)1Q;K a},5i:J(n,a){L r=[];Q(;n;n=n.2B){7(n.15==1&&(!a||n!=a))r.1g(n)}K r}});E.16={1b:J(f,i,g,e){7(f.15==3||f.15==8)K;7(E.14.1d&&f.53!=10)f=1e;7(!g.2D)g.2D=6.2D++;7(e!=10){L h=g;g=J(){K h.1i(6,18)};g.O=e;g.2D=h.2D}L j=E.O(f,"2R")||E.O(f,"2R",{}),1v=E.O(f,"1v")||E.O(f,"1v",J(){L a;7(1o E=="10"||E.16.5f)K a;a=E.16.1v.1i(18.3R.Y,18);K a});1v.Y=f;E.R(i.23(/\\s+/),J(c,b){L a=b.23(".");b=a[0];g.U=a[1];L d=j[b];7(!d){d=j[b]={};7(!E.16.2y[b]||E.16.2y[b].4j.1P(f)===S){7(f.3F)f.3F(b,1v,S);N 7(f.6b)f.6b("4i"+b,1v)}}d[g.2D]=g;E.16.2a[b]=P});f=V},2D:1,2a:{},1V:J(e,h,f){7(e.15==3||e.15==8)K;L i=E.O(e,"2R"),29,4X;7(i){7(h==10||(1o h=="25"&&h.7T(0)=="."))Q(L g 1p i)6.1V(e,g+(h||""));N{7(h.U){f=h.2q;h=h.U}E.R(h.23(/\\s+/),J(b,a){L c=a.23(".");a=c[0];7(i[a]){7(f)2V i[a][f.2D];N Q(f 1p i[a])7(!c[1]||i[a][f].U==c[1])2V i[a][f];Q(29 1p i[a])1Q;7(!29){7(!E.16.2y[a]||E.16.2y[a].4h.1P(e)===S){7(e.67)e.67(a,E.O(e,"1v"),S);N 7(e.66)e.66("4i"+a,E.O(e,"1v"))}29=V;2V i[a]}}})}Q(29 1p i)1Q;7(!29){L d=E.O(e,"1v");7(d)d.Y=V;E.35(e,"2R");E.35(e,"1v")}}},1N:J(g,c,d,f,h){c=E.2I(c||[]);7(g.1f("!")>=0){g=g.2K(0,-1);L a=P}7(!d){7(6.2a[g])E("*").1b([1e,T]).1N(g,c)}N{7(d.15==3||d.15==8)K 10;L b,29,1n=E.1q(d[g]||V),16=!c[0]||!c[0].36;7(16)c.4J(6.4Z({U:g,2L:d}));c[0].U=g;7(a)c[0].65=P;7(E.1q(E.O(d,"1v")))b=E.O(d,"1v").1i(d,c);7(!1n&&d["4i"+g]&&d["4i"+g].1i(d,c)===S)b=S;7(16)c.4l();7(h&&E.1q(h)){29=h.1i(d,b==V?c:c.71(b));7(29!==10)b=29}7(1n&&f!==S&&b!==S&&!(E.12(d,\'a\')&&g=="4V")){6.5f=P;1S{d[g]()}1X(e){}}6.5f=S}K b},1v:J(c){L a;c=E.16.4Z(c||1e.16||{});L b=c.U.23(".");c.U=b[0];L f=E.O(6,"2R")&&E.O(6,"2R")[c.U],42=1M.2l.2K.1P(18,1);42.4J(c);Q(L j 1p f){L d=f[j];42[0].2q=d;42[0].O=d.O;7(!b[1]&&!c.65||d.U==b[1]){L e=d.1i(6,42);7(a!==S)a=e;7(e===S){c.36();c.44()}}}7(E.14.1d)c.2L=c.36=c.44=c.2q=c.O=V;K a},4Z:J(c){L a=c;c=E.1s({},a);c.36=J(){7(a.36)a.36();a.7S=S};c.44=J(){7(a.44)a.44();a.7R=P};7(!c.2L)c.2L=c.7Q||T;7(c.2L.15==3)c.2L=a.2L.1a;7(!c.4S&&c.5w)c.4S=c.5w==c.2L?c.7P:c.5w;7(c.64==V&&c.63!=V){L b=T.1F,1h=T.1h;c.64=c.63+(b&&b.2v||1h&&1h.2v||0)-(b.62||0);c.7N=c.7L+(b&&b.2x||1h&&1h.2x||0)-(b.60||0)}7(!c.3c&&((c.4f||c.4f===0)?c.4f:c.5Z))c.3c=c.4f||c.5Z;7(!c.7b&&c.5Y)c.7b=c.5Y;7(!c.3c&&c.2G)c.3c=(c.2G&1?1:(c.2G&2?3:(c.2G&4?2:0)));K c},2y:{21:{4j:J(){5M();K},4h:J(){K}},3C:{4j:J(){7(E.14.1d)K S;E(6).2j("4P",E.16.2y.3C.2q);K P},4h:J(){7(E.14.1d)K S;E(6).3w("4P",E.16.2y.3C.2q);K P},2q:J(a){7(I(a,6))K P;18[0].U="3C";K E.16.1v.1i(6,18)}},3B:{4j:J(){7(E.14.1d)K S;E(6).2j("4O",E.16.2y.3B.2q);K P},4h:J(){7(E.14.1d)K S;E(6).3w("4O",E.16.2y.3B.2q);K P},2q:J(a){7(I(a,6))K P;18[0].U="3B";K E.16.1v.1i(6,18)}}}};E.1n.1s({2j:J(c,a,b){K c=="4H"?6.2X(c,a,b):6.R(J(){E.16.1b(6,c,b||a,b&&a)})},2X:J(d,b,c){K 6.R(J(){E.16.1b(6,d,J(a){E(6).3w(a);K(c||b).1i(6,18)},c&&b)})},3w:J(a,b){K 6.R(J(){E.16.1V(6,a,b)})},1N:J(c,a,b){K 6.R(J(){E.16.1N(c,a,6,P,b)})},5n:J(c,a,b){7(6[0])K E.16.1N(c,a,6[0],S,b);K 10},2g:J(){L b=18;K 6.4V(J(a){6.4N=0==6.4N?1:0;a.36();K b[6.4N].1i(6,18)||S})},7D:J(a,b){K 6.2j(\'3C\',a).2j(\'3B\',b)},21:J(a){5M();7(E.2Q)a.1P(T,E);N E.3A.1g(J(){K a.1P(6,E)});K 6}});E.1s({2Q:S,3A:[],21:J(){7(!E.2Q){E.2Q=P;7(E.3A){E.R(E.3A,J(){6.1i(T)});E.3A=V}E(T).5n("21")}}});L x=S;J 5M(){7(x)K;x=P;7(T.3F&&!E.14.2z)T.3F("5W",E.21,S);7(E.14.1d&&1e==3b)(J(){7(E.2Q)K;1S{T.1F.7B("26")}1X(3a){3z(18.3R,0);K}E.21()})();7(E.14.2z)T.3F("5W",J(){7(E.2Q)K;Q(L i=0;i<T.4L.M;i++)7(T.4L[i].2Y){3z(18.3R,0);K}E.21()},S);7(E.14.2d){L a;(J(){7(E.2Q)K;7(T.39!="5V"&&T.39!="1y"){3z(18.3R,0);K}7(a===10)a=E("W, 7a[7A=7z]").M;7(T.4L.M!=a){3z(18.3R,0);K}E.21()})()}E.16.1b(1e,"3U",E.21)}E.R(("7y,7x,3U,7w,5d,4H,4V,7v,"+"7G,7u,7t,4P,4O,7s,2k,"+"58,7K,7q,7p,3a").23(","),J(i,b){E.1n[b]=J(a){K a?6.2j(b,a):6.1N(b)}});L I=J(a,c){L b=a.4S;2b(b&&b!=c)1S{b=b.1a}1X(3a){b=c}K b==c};E(1e).2j("4H",J(){E("*").1b(T).3w()});E.1n.1s({3U:J(g,d,c){7(E.1q(g))K 6.2j("3U",g);L e=g.1f(" ");7(e>=0){L i=g.2K(e,g.M);g=g.2K(0,e)}c=c||J(){};L f="4Q";7(d)7(E.1q(d)){c=d;d=V}N{d=E.3m(d);f="61"}L h=6;E.3P({1c:g,U:f,1H:"3q",O:d,1y:J(a,b){7(b=="1W"||b=="5U")h.3q(i?E("<1x/>").3t(a.4b.1r(/<1m(.|\\s)*?\\/1m>/g,"")).2s(i):a.4b);h.R(c,[a.4b,b,a])}});K 6},7n:J(){K E.3m(6.5T())},5T:J(){K 6.2c(J(){K E.12(6,"3u")?E.2I(6.7m):6}).1E(J(){K 6.31&&!6.2Y&&(6.3k||/2k|6h/i.17(6.12)||/1u|1Z|3I/i.17(6.U))}).2c(J(i,c){L b=E(6).5O();K b==V?V:b.1k==1M?E.2c(b,J(a,i){K{31:c.31,1A:a}}):{31:c.31,1A:b}}).22()}});E.R("5S,6d,5R,6D,5Q,6m".23(","),J(i,o){E.1n[o]=J(f){K 6.2j(o,f)}});L B=(1B 3v).3L();E.1s({22:J(d,b,a,c){7(E.1q(b)){a=b;b=V}K E.3P({U:"4Q",1c:d,O:b,1W:a,1H:c})},7l:J(b,a){K E.22(b,V,a,"1m")},7k:J(c,b,a){K E.22(c,b,a,"3i")},7i:J(d,b,a,c){7(E.1q(b)){a=b;b={}}K E.3P({U:"61",1c:d,O:b,1W:a,1H:c})},85:J(a){E.1s(E.4I,a)},4I:{2a:P,U:"4Q",2U:0,5P:"4o/x-7h-3u-7g",5N:P,3l:P,O:V,6p:V,3I:V,49:{3M:"4o/3M, 1u/3M",3q:"1u/3q",1m:"1u/4m, 4o/4m",3i:"4o/3i, 1u/4m",1u:"1u/a7",4G:"*/*"}},4F:{},3P:J(s){L f,2W=/=\\?(&|$)/g,1z,O;s=E.1s(P,s,E.1s(P,{},E.4I,s));7(s.O&&s.5N&&1o s.O!="25")s.O=E.3m(s.O);7(s.1H=="4E"){7(s.U.2h()=="22"){7(!s.1c.1D(2W))s.1c+=(s.1c.1D(/\\?/)?"&":"?")+(s.4E||"7d")+"=?"}N 7(!s.O||!s.O.1D(2W))s.O=(s.O?s.O+"&":"")+(s.4E||"7d")+"=?";s.1H="3i"}7(s.1H=="3i"&&(s.O&&s.O.1D(2W)||s.1c.1D(2W))){f="4E"+B++;7(s.O)s.O=(s.O+"").1r(2W,"="+f+"$1");s.1c=s.1c.1r(2W,"="+f+"$1");s.1H="1m";1e[f]=J(a){O=a;1W();1y();1e[f]=10;1S{2V 1e[f]}1X(e){}7(h)h.34(g)}}7(s.1H=="1m"&&s.1T==V)s.1T=S;7(s.1T===S&&s.U.2h()=="22"){L i=(1B 3v()).3L();L j=s.1c.1r(/(\\?|&)4r=.*?(&|$)/,"$a4="+i+"$2");s.1c=j+((j==s.1c)?(s.1c.1D(/\\?/)?"&":"?")+"4r="+i:"")}7(s.O&&s.U.2h()=="22"){s.1c+=(s.1c.1D(/\\?/)?"&":"?")+s.O;s.O=V}7(s.2a&&!E.5H++)E.16.1N("5S");7((!s.1c.1f("a3")||!s.1c.1f("//"))&&s.1H=="1m"&&s.U.2h()=="22"){L h=T.3S("6f")[0];L g=T.3s("1m");g.3Q=s.1c;7(s.7c)g.a2=s.7c;7(!f){L l=S;g.9Z=g.9Y=J(){7(!l&&(!6.39||6.39=="5V"||6.39=="1y")){l=P;1W();1y();h.34(g)}}}h.38(g);K 10}L m=S;L k=1e.78?1B 78("9X.9V"):1B 76();k.9T(s.U,s.1c,s.3l,s.6p,s.3I);1S{7(s.O)k.4C("9R-9Q",s.5P);7(s.5C)k.4C("9O-5A-9N",E.4F[s.1c]||"9L, 9K 9I 9H 5z:5z:5z 9F");k.4C("X-9C-9A","76");k.4C("9z",s.1H&&s.49[s.1H]?s.49[s.1H]+", */*":s.49.4G)}1X(e){}7(s.6Y)s.6Y(k);7(s.2a)E.16.1N("6m",[k,s]);L c=J(a){7(!m&&k&&(k.39==4||a=="2U")){m=P;7(d){6I(d);d=V}1z=a=="2U"&&"2U"||!E.6X(k)&&"3a"||s.5C&&E.6J(k,s.1c)&&"5U"||"1W";7(1z=="1W"){1S{O=E.6W(k,s.1H)}1X(e){1z="5x"}}7(1z=="1W"){L b;1S{b=k.5q("6U-5A")}1X(e){}7(s.5C&&b)E.4F[s.1c]=b;7(!f)1W()}N E.5v(s,k,1z);1y();7(s.3l)k=V}};7(s.3l){L d=53(c,13);7(s.2U>0)3z(J(){7(k){k.9t();7(!m)c("2U")}},s.2U)}1S{k.9s(s.O)}1X(e){E.5v(s,k,V,e)}7(!s.3l)c();J 1W(){7(s.1W)s.1W(O,1z);7(s.2a)E.16.1N("5Q",[k,s])}J 1y(){7(s.1y)s.1y(k,1z);7(s.2a)E.16.1N("5R",[k,s]);7(s.2a&&!--E.5H)E.16.1N("6d")}K k},5v:J(s,a,b,e){7(s.3a)s.3a(a,b,e);7(s.2a)E.16.1N("6D",[a,s,e])},5H:0,6X:J(r){1S{K!r.1z&&9q.9p=="59:"||(r.1z>=6T&&r.1z<9n)||r.1z==6R||r.1z==9l||E.14.2d&&r.1z==10}1X(e){}K S},6J:J(a,c){1S{L b=a.5q("6U-5A");K a.1z==6R||b==E.4F[c]||E.14.2d&&a.1z==10}1X(e){}K S},6W:J(r,b){L c=r.5q("9k-U");L d=b=="3M"||!b&&c&&c.1f("3M")>=0;L a=d?r.9j:r.4b;7(d&&a.1F.28=="5x")6Q"5x";7(b=="1m")E.5g(a);7(b=="3i")a=6c("("+a+")");K a},3m:J(a){L s=[];7(a.1k==1M||a.5h)E.R(a,J(){s.1g(3r(6.31)+"="+3r(6.1A))});N Q(L j 1p a)7(a[j]&&a[j].1k==1M)E.R(a[j],J(){s.1g(3r(j)+"="+3r(6))});N s.1g(3r(j)+"="+3r(a[j]));K s.6a("&").1r(/%20/g,"+")}});E.1n.1s({1G:J(c,b){K c?6.2e({1R:"1G",27:"1G",1w:"1G"},c,b):6.1E(":1Z").R(J(){6.W.19=6.5s||"";7(E.1j(6,"19")=="2H"){L a=E("<"+6.28+" />").6y("1h");6.W.19=a.1j("19");7(6.W.19=="2H")6.W.19="3D";a.1V()}}).3h()},1I:J(b,a){K b?6.2e({1R:"1I",27:"1I",1w:"1I"},b,a):6.1E(":4d").R(J(){6.5s=6.5s||E.1j(6,"19");6.W.19="2H"}).3h()},6N:E.1n.2g,2g:J(a,b){K E.1q(a)&&E.1q(b)?6.6N(a,b):a?6.2e({1R:"2g",27:"2g",1w:"2g"},a,b):6.R(J(){E(6)[E(6).3H(":1Z")?"1G":"1I"]()})},9f:J(b,a){K 6.2e({1R:"1G"},b,a)},9d:J(b,a){K 6.2e({1R:"1I"},b,a)},9c:J(b,a){K 6.2e({1R:"2g"},b,a)},9a:J(b,a){K 6.2e({1w:"1G"},b,a)},99:J(b,a){K 6.2e({1w:"1I"},b,a)},97:J(c,a,b){K 6.2e({1w:a},c,b)},2e:J(l,k,j,h){L i=E.6P(k,j,h);K 6[i.2P===S?"R":"2P"](J(){7(6.15!=1)K S;L g=E.1s({},i);L f=E(6).3H(":1Z"),4A=6;Q(L p 1p l){7(l[p]=="1I"&&f||l[p]=="1G"&&!f)K E.1q(g.1y)&&g.1y.1i(6);7(p=="1R"||p=="27"){g.19=E.1j(6,"19");g.32=6.W.32}}7(g.32!=V)6.W.32="1Z";g.40=E.1s({},l);E.R(l,J(c,a){L e=1B E.2t(4A,g,c);7(/2g|1G|1I/.17(a))e[a=="2g"?f?"1G":"1I":a](l);N{L b=a.3X().1D(/^([+-]=)?([\\d+-.]+)(.*)$/),1Y=e.2m(P)||0;7(b){L d=2M(b[2]),2A=b[3]||"2S";7(2A!="2S"){4A.W[c]=(d||1)+2A;1Y=((d||1)/e.2m(P))*1Y;4A.W[c]=1Y+2A}7(b[1])d=((b[1]=="-="?-1:1)*d)+1Y;e.45(1Y,d,2A)}N e.45(1Y,a,"")}});K P})},2P:J(a,b){7(E.1q(a)||(a&&a.1k==1M)){b=a;a="2t"}7(!a||(1o a=="25"&&!b))K A(6[0],a);K 6.R(J(){7(b.1k==1M)A(6,a,b);N{A(6,a).1g(b);7(A(6,a).M==1)b.1i(6)}})},94:J(b,c){L a=E.3G;7(b)6.2P([]);6.R(J(){Q(L i=a.M-1;i>=0;i--)7(a[i].Y==6){7(c)a[i](P);a.72(i,1)}});7(!c)6.5p();K 6}});L A=J(b,c,a){7(!b)K 10;c=c||"2t";L q=E.O(b,c+"2P");7(!q||a)q=E.O(b,c+"2P",a?E.2I(a):[]);K q};E.1n.5p=J(a){a=a||"2t";K 6.R(J(){L q=A(6,a);q.4l();7(q.M)q[0].1i(6)})};E.1s({6P:J(b,a,c){L d=b&&b.1k==92?b:{1y:c||!c&&a||E.1q(b)&&b,2u:b,3Z:c&&a||a&&a.1k!=91&&a};d.2u=(d.2u&&d.2u.1k==51?d.2u:{90:8Z,9D:6T}[d.2u])||8X;d.5y=d.1y;d.1y=J(){7(d.2P!==S)E(6).5p();7(E.1q(d.5y))d.5y.1i(6)};K d},3Z:{70:J(p,n,b,a){K b+a*p},5j:J(p,n,b,a){K((-24.8V(p*24.8U)/2)+0.5)*a+b}},3G:[],3W:V,2t:J(b,c,a){6.11=c;6.Y=b;6.1l=a;7(!c.47)c.47={}}});E.2t.2l={4y:J(){7(6.11.30)6.11.30.1i(6.Y,[6.2J,6]);(E.2t.30[6.1l]||E.2t.30.4G)(6);7(6.1l=="1R"||6.1l=="27")6.Y.W.19="3D"},2m:J(a){7(6.Y[6.1l]!=V&&6.Y.W[6.1l]==V)K 6.Y[6.1l];L r=2M(E.1j(6.Y,6.1l,a));K r&&r>-8Q?r:2M(E.2o(6.Y,6.1l))||0},45:J(c,b,d){6.5B=(1B 3v()).3L();6.1Y=c;6.3h=b;6.2A=d||6.2A||"2S";6.2J=6.1Y;6.4B=6.4w=0;6.4y();L e=6;J t(a){K e.30(a)}t.Y=6.Y;E.3G.1g(t);7(E.3W==V){E.3W=53(J(){L a=E.3G;Q(L i=0;i<a.M;i++)7(!a[i]())a.72(i--,1);7(!a.M){6I(E.3W);E.3W=V}},13)}},1G:J(){6.11.47[6.1l]=E.1J(6.Y.W,6.1l);6.11.1G=P;6.45(0,6.2m());7(6.1l=="27"||6.1l=="1R")6.Y.W[6.1l]="8N";E(6.Y).1G()},1I:J(){6.11.47[6.1l]=E.1J(6.Y.W,6.1l);6.11.1I=P;6.45(6.2m(),0)},30:J(a){L t=(1B 3v()).3L();7(a||t>6.11.2u+6.5B){6.2J=6.3h;6.4B=6.4w=1;6.4y();6.11.40[6.1l]=P;L b=P;Q(L i 1p 6.11.40)7(6.11.40[i]!==P)b=S;7(b){7(6.11.19!=V){6.Y.W.32=6.11.32;6.Y.W.19=6.11.19;7(E.1j(6.Y,"19")=="2H")6.Y.W.19="3D"}7(6.11.1I)6.Y.W.19="2H";7(6.11.1I||6.11.1G)Q(L p 1p 6.11.40)E.1J(6.Y.W,p,6.11.47[p])}7(b&&E.1q(6.11.1y))6.11.1y.1i(6.Y);K S}N{L n=t-6.5B;6.4w=n/6.11.2u;6.4B=E.3Z[6.11.3Z||(E.3Z.5j?"5j":"70")](6.4w,n,0,1,6.11.2u);6.2J=6.1Y+((6.3h-6.1Y)*6.4B);6.4y()}K P}};E.2t.30={2v:J(a){a.Y.2v=a.2J},2x:J(a){a.Y.2x=a.2J},1w:J(a){E.1J(a.Y.W,"1w",a.2J)},4G:J(a){a.Y.W[a.1l]=a.2J+a.2A}};E.1n.5L=J(){L b=0,3b=0,Y=6[0],5l;7(Y)8M(E.14){L d=Y.1a,41=Y,1K=Y.1K,1L=Y.2i,5D=2d&&4s(5K)<8J&&!/a1/i.17(v),2T=E.1j(Y,"43")=="2T";7(Y.6G){L c=Y.6G();1b(c.26+24.2f(1L.1F.2v,1L.1h.2v),c.3b+24.2f(1L.1F.2x,1L.1h.2x));1b(-1L.1F.62,-1L.1F.60)}N{1b(Y.5G,Y.5F);2b(1K){1b(1K.5G,1K.5F);7(48&&!/^t(8H|d|h)$/i.17(1K.28)||2d&&!5D)2N(1K);7(!2T&&E.1j(1K,"43")=="2T")2T=P;41=/^1h$/i.17(1K.28)?41:1K;1K=1K.1K}2b(d&&d.28&&!/^1h|3q$/i.17(d.28)){7(!/^8G|1O.*$/i.17(E.1j(d,"19")))1b(-d.2v,-d.2x);7(48&&E.1j(d,"32")!="4d")2N(d);d=d.1a}7((5D&&(2T||E.1j(41,"43")=="4W"))||(48&&E.1j(41,"43")!="4W"))1b(-1L.1h.5G,-1L.1h.5F);7(2T)1b(24.2f(1L.1F.2v,1L.1h.2v),24.2f(1L.1F.2x,1L.1h.2x))}5l={3b:3b,26:b}}J 2N(a){1b(E.2o(a,"a8",P),E.2o(a,"a9",P))}J 1b(l,t){b+=4s(l)||0;3b+=4s(t)||0}K 5l}})();',62,631,'||||||this|if||||||||||||||||||||||||||||||||||||||function|return|var|length|else|data|true|for|each|false|document|type|null|style||elem||undefined|options|nodeName||browser|nodeType|event|test|arguments|display|parentNode|add|url|msie|window|indexOf|push|body|apply|css|constructor|prop|script|fn|typeof|in|isFunction|replace|extend|className|text|handle|opacity|div|complete|status|value|new|firstChild|match|filter|documentElement|show|dataType|hide|attr|offsetParent|doc|Array|trigger|table|call|break|height|try|cache|tbody|remove|success|catch|start|hidden||ready|get|split|Math|string|left|width|tagName|ret|global|while|map|safari|animate|max|toggle|toLowerCase|ownerDocument|bind|select|prototype|cur||curCSS|selected|handler|done|find|fx|duration|scrollLeft|id|scrollTop|special|opera|unit|nextSibling|stack|guid|toUpperCase|pushStack|button|none|makeArray|now|slice|target|parseFloat|border|exec|queue|isReady|events|px|fixed|timeout|delete|jsre|one|disabled|nth|step|name|overflow|inArray|removeChild|removeData|preventDefault|merge|appendChild|readyState|error|top|which|innerHTML|multiFilter|rl|trim|end|json|first|checked|async|param|elems|insertBefore|childNodes|html|encodeURIComponent|createElement|append|form|Date|unbind|color|grep|setTimeout|readyList|mouseleave|mouseenter|block|isXMLDoc|addEventListener|timers|is|password|last|runtimeStyle|getTime|xml|jQuery|domManip|ajax|src|callee|getElementsByTagName|selectedIndex|load|object|timerId|toString|has|easing|curAnim|offsetChild|args|position|stopPropagation|custom|props|orig|mozilla|accepts|clean|responseText|defaultView|visible|String|charCode|float|teardown|on|setup|nodeIndex|shift|javascript|currentStyle|application|child|RegExp|_|parseInt|previousSibling|dir|tr|state|empty|update|getAttribute|self|pos|setRequestHeader|input|jsonp|lastModified|_default|unload|ajaxSettings|unshift|getComputedStyle|styleSheets|getPropertyValue|lastToggle|mouseout|mouseover|GET|andSelf|relatedTarget|init|visibility|click|absolute|index|container|fix|outline|Number|removeAttribute|setInterval|prevObject|classFilter|not|unique|submit|file|after|windowData|deep|scroll|client|triggered|globalEval|jquery|sibling|swing|clone|results|wrapAll|triggerHandler|lastChild|dequeue|getResponseHeader|createTextNode|oldblock|checkbox|radio|handleError|fromElement|parsererror|old|00|Modified|startTime|ifModified|safari2|getWH|offsetTop|offsetLeft|active|values|getElementById|version|offset|bindReady|processData|val|contentType|ajaxSuccess|ajaxComplete|ajaxStart|serializeArray|notmodified|loaded|DOMContentLoaded|Width|ctrlKey|keyCode|clientTop|POST|clientLeft|clientX|pageX|exclusive|detachEvent|removeEventListener|swap|cloneNode|join|attachEvent|eval|ajaxStop|substr|head|parse|textarea|reset|image|zoom|odd|ajaxSend|even|before|username|prepend|expr|quickClass|uuid|quickID|quickChild|continue|textContent|appendTo|contents|evalScript|parent|defaultValue|ajaxError|setArray|compatMode|getBoundingClientRect|styleFloat|clearInterval|httpNotModified|nodeValue|100|alpha|_toggle|href|speed|throw|304|replaceWith|200|Last|colgroup|httpData|httpSuccess|beforeSend|eq|linear|concat|splice|fieldset|multiple|cssFloat|XMLHttpRequest|webkit|ActiveXObject|CSS1Compat|link|metaKey|scriptCharset|callback|col|pixelLeft|urlencoded|www|post|hasClass|getJSON|getScript|elements|serialize|black|keyup|keypress|solid|change|mousemove|mouseup|dblclick|resize|focus|blur|stylesheet|rel|doScroll|round|hover|padding|offsetHeight|mousedown|offsetWidth|Bottom|Top|keydown|clientY|Right|pageY|Left|toElement|srcElement|cancelBubble|returnValue|charAt|0n|substring|animated|header|noConflict|line|enabled|innerText|contains|only|weight|ajaxSetup|font|size|gt|lt|uFFFF|u0128|417|Boolean|inner|Height|toggleClass|removeClass|addClass|removeAttr|replaceAll|insertAfter|prependTo|contentWindow|contentDocument|wrap|iframe|children|siblings|prevAll|nextAll|prev|wrapInner|next|parents|maxLength|maxlength|readOnly|readonly|reverse|class|htmlFor|inline|able|boxModel|522|setData|compatible|with|1px|ie|getData|10000|ra|it|rv|PI|cos|userAgent|400|navigator|600|slow|Function|Object|array|stop|ig|NaN|fadeTo|option|fadeOut|fadeIn|setAttribute|slideToggle|slideUp|changed|slideDown|be|can|property|responseXML|content|1223|getAttributeNode|300|method|protocol|location|action|send|abort|cssText|th|td|cap|specified|Accept|With|colg|Requested|fast|tfoot|GMT|thead|1970|Jan|attributes|01|Thu|leg|Since|If|opt|Type|Content|embed|open|area|XMLHTTP|hr|Microsoft|onreadystatechange|onload|meta|adobeair|charset|http|1_|img|br|plain|borderLeftWidth|borderTopWidth|abbr'.split('|'),0,{}));


/*
 * Compatibility Plugin for jQuery 1.1 (on top of jQuery 1.2)
 * By John Resig
 * Dual licensed under MIT and GPL.
 *
 * For XPath compatibility with 1.1, you should also include the XPath
 * compatability plugin.
 */

// UPGRADE: The following attribute helpers should now be used as:
// .attr("title") or .attr("title","new title")
jQuery.each(["id","title","name","href","src","rel"], function(i,n){
	jQuery.fn[ n ] = function(h) {
		return h == undefined ?
			this.length ? this[0][n] : null :
			this.attr( n, h );
	};
});

// UPGRADE: The following css helpers should now be used as:
// .css("top") or .css("top","30px")
jQuery.each("top,left,position,float,overflow,color,background".split(","), function(i,n){
	jQuery.fn[ n ] = function(h) {
		return h == undefined ?
			( this.length ? jQuery.css( this[0], n ) : null ) :
			this.css( n, h );
	};
});

// UPGRADE: The following event helpers should now be used as such:
// .oneblur(fn) -> .one("blur",fn)
// .unblur(fn) -> .unbind("blur",fn)
var e = ("blur,focus,load,resize,scroll,unload,click,dblclick," +
	"mousedown,mouseup,mousemove,mouseover,mouseout,change,reset,select," + 
	"submit,keydown,keypress,keyup,error").split(",");

// Go through all the event names, but make sure that
// it is enclosed properly
for ( var i = 0; i < e.length; i++ ) new function(){
			
	var o = e[i];
		
	// Handle event unbinding
	jQuery.fn["un"+o] = function(f){ return this.unbind(o, f); };
		
	// Finally, handle events that only fire once
	jQuery.fn["one"+o] = function(f){
		// save cloned reference to this
		var element = jQuery(this);
		var handler = function() {
			// unbind itself when executed
			element.unbind(o, handler);
			element = null;
			// apply original handler with the same arguments
			return f.apply(this, arguments);
		};
		return this.bind(o, handler);
	};
			
};

// UPGRADE: .ancestors() was removed in favor of .parents()
jQuery.fn.ancestors = jQuery.fn.parents;

// UPGRADE: The CSS selector :nth-child() now starts at 1, instead of 0
jQuery.expr[":"]["nth-child"] = "jQuery.nth(a.parentNode.firstChild,parseInt(m[3])+1,'nextSibling')==a";

// UPGRADE: .filter(["div", "span"]) now becomes .filter("div, span")
jQuery.fn._filter = jQuery.fn.filter;
jQuery.fn.filter = function(arr){
	return this._filter( arr.constructor == Array ? arr.join(",") : arr );
};

// You should now use .slice() instead of eq/lt/gt
// And you should use .filter(":contains(text)") instead of .contains()
jQuery.each( [ "eq", "lt", "gt", "contains" ], function(i,n){
	jQuery.fn[ n ] = function(num,fn) {
		return this.filter( ":" + n + "(" + num + ")", fn );
	};
});

// This is no longer necessary in 1.2
jQuery.fn.evalScripts = function(){};

// You should now be using $.ajax() instead
jQuery.fn.loadIfModified = function() {
	var old = jQuery.ajaxSettings.ifModified;
	jQuery.ajaxSettings.ifModified = true;

	var ret = jQuery.fn.load.apply( this, arguments );

	jQuery.ajaxSettings.ifModified = old;

	return ret;
};

// You should now be using $.ajax() instead
jQuery.getIfModified = function() {
	var old = jQuery.ajaxSettings.ifModified;
	jQuery.ajaxSettings.ifModified = true;

	var ret = jQuery.get.apply( jQuery, arguments );

	jQuery.ajaxSettings.ifModified = old;

	return ret;
};

jQuery.ajaxTimeout = function( timeout ) {
	jQuery.ajaxSettings.timeout = timeout;
};





function load_download(hash1)
{
	show_loading();
	$("#main_c").hide(800, 
	function()
	{ 
		$("#main_c").empty();
		$("#main_c").height("1000px");
		$.get("./api.php", {page: "download", hash: ""+hash1+""},
		function(data)
		{
			
			$("#main_c").html("<div align='center'>"+data+"</div>");
			eval(eval_code(data));
			$("#main_c").show(1200,
			function()
			{
				close_loading();
			});
		});
	});
}

function load_download_form(hash1)
{
	//var height1 = $("#main_c").height();
	//$("#main_c").height(height1);
	//$("#main_c").fadeOut("slow",);
	show_loading();
	$("#main_c").hide(800, 
	function()
	{ 
		$("#main_c").empty();
		$("#main_c").height("1000px");
		$.get("./api.php", {page: "download", hash: ""+hash1+""},
		function(data)
		{
			
			$("#main_c").html("<div align='center'>"+data+"</div>");
			//$("#main_c").after("<"+"script language='javascript' type='text/javascript'"+">"+eval_code(data)+"<"+"/script"+">");
			eval(eval_code(data));
			$("#main_c").show(1200,
			function()
			{
				//$("#main_c").css("opacity", "100%").css("display", "block");
				close_loading();
			});
		});
	});
	return false;
}

function load_page(page_1,height,params)
{
	var src;
	if(height == null)
	{
	   height = '100%';
	}
	
	if(params==  null)
	{
	   params = '';
	}
	show_loading();
	$("#main_c").hide(800, 
	function()
	{ 
		$("#main_c").empty();
		$("#main_c").height(height);
		$.get("./api.php?page="+page_1, params,
		function(data)
		{
			$("#main_c").html("<div align='center'>"+data+"</div>");
			eval(eval_code(data));
			$("#main_c").show(1200,
			function()
			{
				//$("#main_c").css("opacity", "100%").css("display", "block");
				close_loading();
			});
		}); 
	});
}

function load_page_form(page_1,height,params)
{
	var src;
	if(height == null)
	{
	   height = '100%';
	}
	
	if(params==  null)
	{
	   params = '';
	}
	show_loading();
	$("#main_c").hide(800, 
	function()
	{ 
		$("#main_c").empty();
		$("#main_c").height(height);
		$.get("./api.php?page="+page_1, params,
		function(data)
		{
			$("#main_c").html("<div align='center'>"+data+"</div>");
			eval(eval_code(data));
			$("#main_c").show(1200,
			function()
			{
				//$("#main_c").css("opacity", "100%").css("display", "block");
				close_loading();
			});
		}); 
	});
		return false;
}

function load_link(hash1,pass)
{
	//var height1 = $("#main_c").height();
	//$("#main_c").height(height1);
	//$("#main_c").fadeOut("slow",);
	show_loading();
	$("#main_c").hide(1200, 
	function()
	{ 
		$("#main_c").empty();
		$("#main_c").height("300px");
		$.post("./api.php", {waited: "true", page: "download", pass_test: "true", pass1: pass, hash: ""+hash1+""},
		function(data)
		{
			$("#main_c").html("<div align='center'>"+data+"</div>");
			//eval(eval_code(data));
			$("#main_c").show(1200,
			function()
			{
				//$("#f_link").height("35px");
				close_loading();
				$("#f_link").show(700);
			});
		}); 
	});
}


function eval_code(rm_html)
{
	var text_blocks=new Array();
	var max_iteration=50;
	var i=0;
	var code='';
	while(_match = rm_html.match(new RegExp("<script\\s+?type=['\"]text/javascript['\"]>([^`]+?)</script>","i")))
	{
		i++;
		if(i>=max_iteration)
		{
			break;
		}
		else
		{
			text_blocks[text_blocks.length]=_match[1];
			rm_html=rm_html.replace(_match[0],'');
		}
	}
	if(text_blocks.length)
	{
		for(i=0;i<text_blocks.length;i++)
		{
			code += text_blocks[i];
		}
	}
	return code;
}


// Functions to draw the Flash Charting Apps
function draw_pie(data,name,xtra,id)
{
	var flash = '';
	var html = '';
	var font = '14';
	var XML = '';
	var vars = '';
	
	XML = "<graph ";
	XML += "caption='"+name+"' ";
	XML += "bgColor='FFFFFF' ";
	XML += "decimalPrecision='1' ";
	XML += "showPercentageValues='1' ";
	XML += "showNames='1' ";
	XML += "showValues='1' ";
	XML += "showPercentageInLabel='1' ";
	XML += "pieYScale='45' ";
	XML += "Alpha='85' ";
	XML += "pieFillAlpha='90' ";
	XML += "pieSliceDepth='20' ";
	XML += "pieBorderThickness='2' ";
	XML += "nameTBDistance='3' ";
	XML += "pieRadius='80' ";
	XML += "baseFontSize='"+font+"' >";
	XML += data;
	XML += "</graph>";
	
	vars = 'chartWidth=550&chartHeight=350&dataXML='+XML+'&'+xtra;
	
	flash += '<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" WIDTH="520" HEIGHT="250" id="PieChart_'+id+'" ALIGN="">'+'\n';
	flash += '<PARAM NAME=movie VALUE="./flash/chart.swf?'+vars+'">'+'\n';
	flash += '<PARAM NAME=FlashVars VALUE="&'+vars+'">';
	flash += '<PARAM NAME=quality VALUE="high">'+'\n';
	flash += '<PARAM NAME=bgcolor VALUE="#FFFFFF">';
	flash += '<EMBED '+'\n';
	flash += 'src="./flash/chart.swf?'+vars+'" '+'\n';
	flash += 'FlashVars="&'+vars+'"'+'\n'; 
	flash += 'quality=high'+'\n';
	flash += 'bgcolor=#FFFFFF'+'\n'; 
	flash += 'WIDTH="520" '+'\n';
	flash += 'HEIGHT="250" '+'\n';
	flash += 'NAME="PieChart_'+id+'" '+'\n';
	flash += 'ALIGN="center"'+'\n';
	flash += 'TYPE="application/x-shockwave-flash" '+'\n';
	flash += 'PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer">'+'\n';
	flash += '</EMBED>'+'\n';
	flash += '</OBJECT>'+'\n'+'\n';
	html = flash;
	document.write(html);
}


var currently_showing = null;
var checkBoxAllBool = false;

function switchCheckboxes()
{
	if(!checkBoxAllBool)
	{
		$('input[@type=checkbox]', document).each(function(i)
		{
			$(this).attr('checked', 'checked');
		});
		checkBoxAllBool = true;
	}
	else
	{
		$('input[@type=checkbox]', document).each(function(i)
		{
			$(this).attr('checked', '');
		});
		checkBoxAllBool = false;
	}
}

function switchUpload(ids)
{
	if(currently_showing == 1)
	{
		$('#up_flash').fadeOut('fast',function(){$(ids).fadeIn("fast");});
	}
	else if(currently_showing == 2)
	{
		$('#up_url').fadeOut('fast',function(){$(ids).fadeIn("fast");});
	}
	else if(currently_showing == 3)
	{
		$('#up_plain').fadeOut('fast',function(){$(ids).fadeIn("fast");});
	}
}

function show_upload_flash()
{
	if(currently_showing != 1)
	{
		switchUpload('#up_flash');
		currently_showing = 1;
	}
}

function show_upload_url()
{
	if(currently_showing != 2)
	{
		switchUpload('#up_url');
		currently_showing = 2;
	}
}

function show_upload_browse()
{
	if(currently_showing != 3)
	{
		switchUpload('#up_plain');
		currently_showing = 3;
	}
}

function popUP()
{
	$("#p_bar_text").css('display', "inline");
	$("#upload_sect").css('display', "none");
	$("#link_block").css('display', 'none');
	$("#uploadMethods").css('display', 'none');
}

function redirect(URLStr) 
{ 
	location = URLStr; 
}

function up_image(width)
{
	if((width * 6) >= 600)
	{
		var width1 = 600;
	}
	else
	{
		var width1 = width;
	}
	$("#progress_img").animate({width: width}, "normal");
}

function close_loading()
{
	TB_remove_load();
}

function make_color(css)
{  
    $('#'+css).farbtastic('#'+css);
}

function disable_button()
{
	if(document.getElementById("private_key").value.length != document.getElementById("public_key").value.length)
	{
		alert("Please complete the captcha validation to download the file.");
		return false;
	}
	else
	{
		$("#downloadFileNow").attr('type','button');
		return true;
	}
	return false;
}

function showUploadUrlOptions()
{
	$('#uploadUrlOptions').slideDown('normal');
	$('#uploadUrlOptionsLink').slideUp('normal');
}

function showUploadBrowserOptions()
{
	$('#uploadBrowserOptions').slideDown('normal');
	$('#uploadBrowserOptionsLink').slideUp('normal');
}

function showUploadFlashOptions()
{
	$('#uploadFlashOptions').slideDown('normal');
	$('#uploadFlashOptionsLink').slideUp('normal');
}


/*
Farbtastic: jQuery color picker plug-in
Copyright (C) 2006  Steven Wittens

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

jQuery.fn.farbtastic = function (callback,defaultColor) {
  $.farbtastic(this, callback,defaultColor);
  return this;
};

jQuery.farbtastic = function (container, callback,defaultColor) {
  var container = $(container).get(0);
  return container.farbtastic || (container.farbtastic = new jQuery._farbtastic(container, callback,defaultColor));
};

jQuery._farbtastic = function (container, callback,defaultColor) {
  // Store farbtastic object
  var fb = this;

  // Insert markup
  $(container).html('<div class="farbtastic"><div class="color"></div><div class="wheel"></div><div class="overlay"></div><div class="h-marker marker"></div><div class="sl-marker marker"></div></div>');
  var e = $('.farbtastic', container);
  fb.wheel = $('.wheel', container).get(0);
  // Dimensions
  fb.radius = 84;
  fb.square = 100;
  fb.width = 194;
  fb.callback = callback;

  /**
   * Link to the given element(s) or callback.
   */
  fb.linkTo = function (callback) 
  {
    $('#'+callback).css('backgroundColor', fb.rgb);
	$('#'+callback).attr('value', fb.rgb);
    return this;
  };
  fb.updateValue = function (event) {
    if (this.value && this.value != fb.color) {
      fb.setColor(this.value);
    }
  };

  /**
   * Change color with HTML syntax #123456
   */
  fb.setColor = function (color) {
    var unpack = fb.unpack(color);
    if (fb.color != color && unpack) {
      fb.color = color;
      fb.rgb = unpack;
      fb.hsl = fb.RGBToHSL(fb.rgb);
      fb.updateDisplay();      
    }
    return this;
  };

  /**
   * Change color with HSL triplet [0..1, 0..1, 0..1]
   */
  fb.setHSL = function (hsl) {
    fb.hsl = hsl;
    fb.rgb = fb.HSLToRGB(hsl);
    fb.color = fb.pack(fb.rgb);
    fb.updateDisplay();
    return this;
  };

  /////////////////////////////////////////////////////

  /**
   * Mousedown handler
   */
  fb.mousedown = function (event) {
    // Capture mouse
    $(document).bind('mousemove', fb.mousemove).bind('mouseup', fb.mouseup);

    // Check which area is being dragged
    var pos = fb.absolutePosition(fb.wheel);
    var eventX = event.pageX || (event.clientX + $('html').get(0).scrollLeft);
    var eventY = event.pageY || (event.clientY + $('html').get(0).scrollTop);
    var x = eventX - pos.x - fb.width / 2;
    var y = eventY - pos.y - fb.width / 2;
    fb.circleDrag = Math.max(Math.abs(x), Math.abs(y)) * 2 > fb.square;

    // Process
    fb.mousemove(event);
    return false;
  };

  /**
   * Mousemove handler 
   */
  fb.mousemove = function (event) {
    // Get coordinates relative to color picker center
    var pos = fb.absolutePosition(fb.wheel);
    var eventX = event.pageX || (event.clientX + $('html').get(0).scrollLeft);
    var eventY = event.pageY || (event.clientY + $('html').get(0).scrollTop);
    var x = eventX - pos.x - fb.width / 2;
    var y = eventY - pos.y - fb.width / 2;

    // Set new HSL parameters
    if (fb.circleDrag) {
  	  var hue = Math.atan2(x,-y) / 6.28;
  	  if (hue < 0) hue += 1;
  	  fb.setHSL([hue, fb.hsl[1], fb.hsl[2]]);
    }
    else {
  	  var sat = Math.max(0, Math.min(1, -(x / fb.square) + .5));
  	  var lum = Math.max(0, Math.min(1, -(y / fb.square) + .5));
  	  fb.setHSL([fb.hsl[0], sat, lum]);
    }
    return false;
  };

  /**
   * Mouseup handler
   */
  fb.mouseup = function () {
    // Uncapture mouse
    $(document).unbind('mousemove', fb.mousemove);
    $(document).unbind('mouseup', fb.mouseup);    
  };

  /**
   * Update the markers and styles
   */
  fb.updateDisplay = function () {     
    // Markers
    var angle = fb.hsl[0] * 6.28;
    $('.h-marker', e).css({
      left: Math.round(Math.sin(angle) * fb.radius + fb.width / 2) + 'px',
      top: Math.round(-Math.cos(angle) * fb.radius + fb.width / 2) + 'px'
    });

    $('.sl-marker', e).css({
      left: Math.round(fb.square * (.5 - fb.hsl[1]) + fb.width / 2) + 'px',
      top: Math.round(fb.square * (.5 - fb.hsl[2]) + fb.width / 2) + 'px'
    });

    // Saturation/Luminance gradient
    $('.color', e).css('backgroundColor', fb.pack(fb.HSLToRGB([fb.hsl[0], 1, 0.5])));

    // Linked elements or callback
      // Set background/foreground color
      $('#'+fb.callback).css({
        backgroundColor: fb.color,
        color: fb.hsl[2] > 0.5 ? '#000' : '#fff'
      });

      // Change linked value
      $('#'+fb.callback).each(function() {
        if (this.value && this.value != fb.color) {
          this.value = fb.color;
        }        
      });
	
	
  };

  /**
   * Get absolute position of element
   */
  fb.absolutePosition = function (el) {
    var r = { x: el.offsetLeft, y: el.offsetTop };
    if (el.offsetParent) {
      var tmp = fb.absolutePosition(el.offsetParent);
      r.x += tmp.x;
      r.y += tmp.y;
    }
    return r;
  };

  /* Various color utility functions */
  fb.pack = function (rgb) {      
    var r = Math.round(rgb[0] * 255);
    var g = Math.round(rgb[1] * 255);
    var b = Math.round(rgb[2] * 255);
    return '#' + (r < 16 ? '0' : '') + r.toString(16) +
  			   (g < 16 ? '0' : '') + g.toString(16) +
  			   (b < 16 ? '0' : '') + b.toString(16);
  };

  fb.unpack = function (color) {
    if (color.length == 7) {
  	  return [parseInt('0x' + color.substring(1, 3)) / 255,
  			parseInt('0x' + color.substring(3, 5)) / 255,
  			parseInt('0x' + color.substring(5, 7)) / 255];
    }
    else if (color.length == 4) {
  	  return [parseInt('0x' + color.substring(1, 2)) / 15,
  			parseInt('0x' + color.substring(2, 3)) / 15,
  			parseInt('0x' + color.substring(3, 4)) / 15];
    }
  };

  fb.HSLToRGB = function (hsl) {
    var m1, m2, r, g, b;
    var h = hsl[0], s = hsl[1], l = hsl[2];
    m2 = (l <= 0.5) ? l * (s + 1) : l + s - l*s;
    m1 = l * 2 - m2;
    return [this.hueToRGB(m1, m2, h+0.33333),
  		  this.hueToRGB(m1, m2, h),
  		  this.hueToRGB(m1, m2, h-0.33333)];
  };

  fb.hueToRGB = function (m1, m2, h) {
    h = (h < 0) ? h + 1 : ((h > 1) ? h - 1 : h);
    if (h * 6 < 1) return m1 + (m2 - m1) * h * 6;
    if (h * 2 < 1) return m2;
    if (h * 3 < 2) return m1 + (m2 - m1) * (0.66666 - h) * 6;
    return m1;
  };

  fb.RGBToHSL = function (rgb) {
    var min, max, delta, h, s, l;
    var r = rgb[0], g = rgb[1], b = rgb[2];
    min = Math.min(r, Math.min(g, b));
    max = Math.max(r, Math.max(g, b));
    delta = max - min;
    l = (min + max) / 2;
    s = 0;
    if (l > 0 && l < 1) {
  	  s = delta / (l < 0.5 ? (2 * l) : (2 - 2 * l));
    }
    h = 0;
    if (delta > 0) {
  	  if (max == r && max != g) h += (g - b) / delta;
  	  if (max == g && max != b) h += (2 + (b - r) / delta);
  	  if (max == b && max != r) h += (4 + (r - g) / delta);
  	  h /= 6;
    }
    return [h, s, l];
  };

  // Install mousedown handler (the others are set on the document on-demand)
  $('*', e).mousedown(fb.mousedown);

  // Init color
  fb.setColor(defaultColor);

  // Set linked elements/callback
  if (callback) {
    fb.linkTo(callback);
  }
}


/**
 * Flash (http://jquery.lukelutman.com/plugins/flash)
 * A jQuery plugin for embedding Flash movies.
 * 
 * Version 1.0
 * November 9th, 2006
 *
 * Copyright (c) 2006 Luke Lutman (http://www.lukelutman.com)
 * Licensed under the MIT License:
 * http://www.opensource.org/licenses/mit-license.php
 * 
 * Inspired by:
 * SWFObject (http://blog.deconcept.com/swfobject/)
 * UFO (http://www.bobbyvandersluis.com/ufo/)
 * sIFR (http://www.mikeindustries.com/sifr/)
 * 
 * IMPORTANT: 
 * The packed version of jQuery breaks ActiveX control
 * activation in Internet Explorer. Use JSMin to minifiy
 * jQuery (see: http://jquery.lukelutman.com/plugins/flash#activex).
 *
 **/ 
;(function(){
	
var $$;

/**
 * 
 * @desc Replace matching elements with a flash movie.
 * @author Luke Lutman
 * @version 1.0.1
 *
 * @name flash
 * @param Hash htmlOptions Options for the embed/object tag.
 * @param Hash pluginOptions Options for detecting/updating the Flash plugin (optional).
 * @param Function replace Custom block called for each matched element if flash is installed (optional).
 * @param Function update Custom block called for each matched if flash isn't installed (optional).
 * @type jQuery
 *
 * @cat plugins/flash
 * 
 * @example $('#hello').flash({ src: 'hello.swf' });
 * @desc Embed a Flash movie.
 *
 * @example $('#hello').flash({ src: 'hello.swf' }, { version: 8 });
 * @desc Embed a Flash 8 movie.
 *
 * @example $('#hello').flash({ src: 'hello.swf' }, { expressInstall: true });
 * @desc Embed a Flash movie using Express Install if flash isn't installed.
 *
 * @example $('#hello').flash({ src: 'hello.swf' }, { update: false });
 * @desc Embed a Flash movie, don't show an update message if Flash isn't installed.
 *
**/
$$ = jQuery.fn.flash = function(htmlOptions, pluginOptions, replace, update) {
	
	// Set the default block.
	var block = replace || $$.replace;
	
	// Merge the default and passed plugin options.
	pluginOptions = $$.copy($$.pluginOptions, pluginOptions);
	
	// Detect Flash.
	if(!$$.hasFlash(pluginOptions.version)) {
		// Use Express Install (if specified and Flash plugin 6,0,65 or higher is installed).
		if(pluginOptions.expressInstall && $$.hasFlash(6,0,65)) {
			// Add the necessary flashvars (merged later).
			var expressInstallOptions = {
				flashvars: {  	
					MMredirectURL: location,
					MMplayerType: 'PlugIn',
					MMdoctitle: jQuery('title').text() 
				}					
			};
		// Ask the user to update (if specified).
		} else if (pluginOptions.update) {
			// Change the block to insert the update message instead of the flash movie.
			block = update || $$.update;
		// Fail
		} else {
			// The required version of flash isn't installed.
			// Express Install is turned off, or flash 6,0,65 isn't installed.
			// Update is turned off.
			// Return without doing anything.
			return this;
		}
	}
	
	// Merge the default, express install and passed html options.
	htmlOptions = $$.copy($$.htmlOptions, expressInstallOptions, htmlOptions);
	
	// Invoke $block (with a copy of the merged html options) for each element.
	return this.each(function(){
		block.call(this, $$.copy(htmlOptions));
	});
	
};
/**
 *
 * @name flash.copy
 * @desc Copy an arbitrary number of objects into a new object.
 * @type Object
 * 
 * @example $$.copy({ foo: 1 }, { bar: 2 });
 * @result { foo: 1, bar: 2 };
 *
**/
$$.copy = function() {
	var options = {}, flashvars = {};
	for(var i = 0; i < arguments.length; i++) {
		var arg = arguments[i];
		if(arg == undefined) continue;
		jQuery.extend(options, arg);
		// don't clobber one flash vars object with another
		// merge them instead
		if(arg.flashvars == undefined) continue;
		jQuery.extend(flashvars, arg.flashvars);
	}
	options.flashvars = flashvars;
	return options;
};
/*
 * @name flash.hasFlash
 * @desc Check if a specific version of the Flash plugin is installed
 * @type Boolean
 *
**/
$$.hasFlash = function() {
	// look for a flag in the query string to bypass flash detection
	if(/hasFlash\=true/.test(location)) return true;
	if(/hasFlash\=false/.test(location)) return false;
	var pv = $$.hasFlash.playerVersion().match(/\d+/g);
	var rv = String([arguments[0], arguments[1], arguments[2]]).match(/\d+/g) || String($$.pluginOptions.version).match(/\d+/g);
	for(var i = 0; i < 3; i++) {
		pv[i] = parseInt(pv[i] || 0);
		rv[i] = parseInt(rv[i] || 0);
		// player is less than required
		if(pv[i] < rv[i]) return false;
		// player is greater than required
		if(pv[i] > rv[i]) return true;
	}
	// major version, minor version and revision match exactly
	return true;
};
/**
 *
 * @name flash.hasFlash.playerVersion
 * @desc Get the version of the installed Flash plugin.
 * @type String
 *
**/
$$.hasFlash.playerVersion = function() {
	// ie
	try {
		try {
			// avoid fp6 minor version lookup issues
			// see: http://blog.deconcept.com/2006/01/11/getvariable-setvariable-crash-internet-explorer-flash-6/
			var axo = new ActiveXObject('ShockwaveFlash.ShockwaveFlash.6');
			try { axo.AllowScriptAccess = 'always';	} 
			catch(e) { return '6,0,0'; }				
		} catch(e) {}
		return new ActiveXObject('ShockwaveFlash.ShockwaveFlash').GetVariable('$version').replace(/\D+/g, ',').match(/^,?(.+),?$/)[1];
	// other browsers
	} catch(e) {
		try {
			if(navigator.mimeTypes["application/x-shockwave-flash"].enabledPlugin){
				return (navigator.plugins["Shockwave Flash 2.0"] || navigator.plugins["Shockwave Flash"]).description.replace(/\D+/g, ",").match(/^,?(.+),?$/)[1];
			}
		} catch(e) {}		
	}
	return '0,0,0';
};
/**
 *
 * @name flash.htmlOptions
 * @desc The default set of options for the object or embed tag.
 *
**/
$$.htmlOptions = {
	height: 240,
	flashvars: {},
	pluginspage: 'http://www.adobe.com/go/getflashplayer',
	src: '#',
	type: 'application/x-shockwave-flash',
	width: 320		
};
/**
 *
 * @name flash.pluginOptions
 * @desc The default set of options for checking/updating the flash Plugin.
 *
**/
$$.pluginOptions = {
	expressInstall: false,
	update: true,
	version: '6.0.65'
};
/**
 *
 * @name flash.replace
 * @desc The default method for replacing an element with a Flash movie.
 *
**/
$$.replace = function(htmlOptions) {
	this.innerHTML = '<div class="alt">'+this.innerHTML+'</div>';
	jQuery(this)
		.addClass('flash-replaced')
		.prepend($$.transform(htmlOptions));
};
/**
 *
 * @name flash.update
 * @desc The default method for replacing an element with an update message.
 *
**/
$$.update = function(htmlOptions) {
	var url = String(location).split('?');
	url.splice(1,0,'?hasFlash=true&');
	url = url.join('');
	var msg = '<p>This content requires the Flash Player. <a href="http://www.adobe.com/go/getflashplayer">Download Flash Player</a>. Already have Flash Player? <a href="'+url+'">Click here.</a></p>';
	this.innerHTML = '<span class="alt">'+this.innerHTML+'</span>';
	jQuery(this)
		.addClass('flash-update')
		.prepend(msg);
};
/**
 *
 * @desc Convert a hash of html options to a string of attributes, using Function.apply(). 
 * @example toAttributeString.apply(htmlOptions)
 * @result foo="bar" foo="bar"
 *
**/
function toAttributeString() {
	var s = '';
	for(var key in this)
		if(typeof this[key] != 'function')
			s += key+'="'+this[key]+'" ';
	return s;		
};
/**
 *
 * @desc Convert a hash of flashvars to a url-encoded string, using Function.apply(). 
 * @example toFlashvarsString.apply(flashvarsObject)
 * @result foo=bar&foo=bar
 *
**/
function toFlashvarsString() {
	var s = '';
	for(var key in this)
		if(typeof this[key] != 'function')
			s += key+'='+escape(this[key])+'&';
	return s.replace(/&$/, '');		
};
/**
 *
 * @name flash.transform
 * @desc Transform a set of html options into an embed tag.
 * @type String 
 *
 * @example $$.transform(htmlOptions)
 * @result <embed src="foo.swf" ... />
 *
 * Note: The embed tag is NOT standards-compliant, but it 
 * works in all current browsers. flash.transform can be
 * overwritten with a custom function to generate more 
 * standards-compliant markup.
 *
**/
$$.transform = function(htmlOptions) {
	htmlOptions.toString = toAttributeString;
	if(htmlOptions.flashvars) htmlOptions.flashvars.toString = toFlashvarsString;
	return '<embed ' + String(htmlOptions) + '/>';		
};

/**
 *
 * Flash Player 9 Fix (http://blog.deconcept.com/2006/07/28/swfobject-143-released/)
 *
**/
if (window.attachEvent) {
	window.attachEvent("onbeforeunload", function(){
		__flash_unloadHandler = function() {};
		__flash_savedUnloadHandler = function() {};
	});
}
	
})();


 jQuery.editable = {};

jQuery.fn.editInPlace = function(url, urlString) 
{
  var data;
  var div_id = this.id;
  
  editInPlaceClick = function() 
  {
    type = "text";
	var self = this;
	var editable = this; 
    var revert = this.innerHTML;
    this.innerHTML = "<input id=\"text_edit\" type=\"text\" value = \"" + this.innerHTML + "\" /> ";


    $(this).removeClickable();
	$("#text_edit").keydown(function(e) 
	{
		if (e.keyCode == 13)
		{ // ENTER
			 process_edit(editable, urlString, url);
		}
		
		if (e.keyCode == 27)
		{ // ESC
			 $(editable).html(revert);
			 $(editable).editInPlace(url, urlString);
		}
	});
	
    $("#text_edit").blur(function(e)
	{
		process_edit(editable, urlString, url);
	});
  };

  jQuery.fn.removeClickable = function() 
  {
    this.unclick();    
    this.unmouseover().unmouseout();
	$(this).TooltipKill();
  };
  var me = $(this);
  me.editing = true;
  this.attr('title','Click to Edit').Tooltip({track: true, delay: 0});
  
  return this.click(editInPlaceClick);
};

function process_edit(editable, urlString, url)
{
      var value = $("#text_edit").val();
	  var me = $(editable);
      me.editing = false;
	  value = $.trim(value);
      $.ajax(
	  {
        url: url,
        type: "POST",
		dataType: "html",
        data: "ntg=" + value + "&" + urlString,
		
        success: function(text) 
		{
          $(editable).html(text);
		  $(editable).editInPlace(url, urlString);
        }
       });
	  return false;
}


/*
	JSCookMenu v2.0.3 (c) Copyright 2002-2006 by Heng Yuan

	http://jscook.sourceforge.net/JSCookMenu/

	Permission is hereby granted, free of charge, to any person obtaining a
	copy of this software and associated documentation files (the "Software"),
	to deal in the Software without restriction, including without limitation
	the rights to use, copy, modify, merge, publish, distribute, sublicense,
	and/or sell copies of the Software, and to permit persons to whom the
	Software is furnished to do so, subject to the following conditions:

	The above copyright notice and this permission notice shall be included
	in all copies or substantial portions of the Software.

	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS
	OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
	ITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
	AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
	LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
	FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
	DEALINGS IN THE SOFTWARE.
*/

// default node properties
var _cmNodeProperties =
{
	// theme prefix
	prefix:	'',

  	// main menu display attributes
  	//
  	// Note.  When the menu bar is horizontal,
  	// mainFolderLeft and mainFolderRight are
  	// put in <span></span>.  When the menu
  	// bar is vertical, they would be put in
  	// a separate TD cell.

  	// HTML code to the left of the folder item
  	mainFolderLeft: '',
  	// HTML code to the right of the folder item
  	mainFolderRight: '',
	// HTML code to the left of the regular item
	mainItemLeft: '',
	// HTML code to the right of the regular item
	mainItemRight:	'',

	// sub menu display attributes

	// HTML code to the left of the folder item
	folderLeft:		'',
	// HTML code to the right of the folder item
	folderRight:	'',
	// HTML code to the left of the regular item
	itemLeft:		'',
	// HTML code to the right of the regular item
	itemRight:		'',
	// cell spacing for main menu
	mainSpacing:	0,
	// cell spacing for sub menus
	subSpacing:		0,

	// optional settings
	// If not set, use the default

	// auto disappear time for submenus in milli-seconds
	delay:			500,

	// 1st layer sub menu starting index
	zIndexStart:	1000,
	// z-index incremental step for subsequent layers
	zIndexInc:		5,

	// sub menu header appears before the sub menu table
	subMenuHeader:	null,
	// sub menu header appears after the sub menu table
	subMenuFooter:	null,

	// submenu location adjustments
	//
	// offsetHMainAdjust for adjusting the first submenu
	// 		of a 'hbr' menu.
	// offsetVMainAdjust for adjusting the first submenu
	//		of a 'vbr' menu.
	// offsetSubAdjust for subsequent level of submenus
	//
	offsetHMainAdjust:	[0, 0],
	offsetVMainAdjust:	[0, 0],
	offsetSubAdjust:	[0, 0],

	// act on click to open sub menu
	// not yet implemented
	// 0 : use default behavior
	// 1 : hover open in all cases
	// 2 : click on main, hover on sub
	// 3 : click open in all cases (illegal as of 1.5)
	clickOpen:		1,

	// special effects on open/closing a sub menu
	effect:			null
};

// Globals
var _cmIDCount = 0;
var _cmIDName = 'cmSubMenuID';		// for creating submenu id

var _cmTimeOut = null;				// how long the menu would stay
var _cmCurrentItem = null;			// the current menu item being selected;

var _cmNoAction = new Object ();	// indicate that the item cannot be hovered.
var _cmNoClick = new Object ();		// similar to _cmNoAction but does not respond to mouseup/mousedown events
var _cmSplit = new Object ();		// indicate that the item is a menu split

var _cmMenuList = new Array ();		// a list of the current menus
var _cmItemList = new Array ();		// a simple list of items

var _cmFrameList = new Array ();	// a pool of reusable iframes
var _cmFrameListSize = 0;			// keep track of the actual size
var _cmFrameIDCount = 0;			// keep track of the frame id
var _cmFrameMasking = true;			// use the frame masking

// disable iframe masking for IE7
/*@cc_on
	@if (@_jscript_version >= 5.6)
		if (_cmFrameMasking)
		{
			var v = navigator.appVersion;
			var i = v.indexOf ("MSIE ");
			if (i >= 0)
			{
				if (parseInt (navigator.appVersion.substring (i + 5)) >= 7)
					_cmFrameMasking = false;
			}
		}
	@end
@*/

var _cmClicked = false;				// for onClick

// flag for turning on off hiding objects
//
// 0: automatic
// 1: hiding
// 2: no hiding
var _cmHideObjects = 0;

// Utility function to do a shallow copy a node property
function cmClone (nodeProperties)
{
	var returnVal = new Object ();
	for (v in nodeProperties)
		returnVal[v] = nodeProperties[v];
	return returnVal;
}

//
// store the new menu information into a structure to retrieve it later
//
function cmAllocMenu (id, menu, orient, nodeProperties, prefix)
{
	var info = new Object ();
	info.div = id;
	info.menu = menu;
	info.orient = orient;
	info.nodeProperties = nodeProperties;
	info.prefix = prefix;
	var menuID = _cmMenuList.length;
	_cmMenuList[menuID] = info;
	return menuID;
}

//
// request a frame
//
function cmAllocFrame ()
{
	if (_cmFrameListSize > 0)
		return cmGetObject (_cmFrameList[--_cmFrameListSize]);
	var frameObj = document.createElement ('iframe');
	var id = _cmFrameIDCount++;
	frameObj.id = 'cmFrame' + id;
	frameObj.frameBorder = '0';
	frameObj.style.display = 'none';
	frameObj.src = 'javascript:false';
	document.body.appendChild (frameObj);
	frameObj.style.filter = 'alpha(opacity=0)';
	frameObj.style.zIndex = 99;
	frameObj.style.position = 'absolute';
	frameObj.style.border = '0';
	frameObj.scrolling = 'no';
	return frameObj;
}

//
// make a frame resuable later
//
function cmFreeFrame (frameObj)
{
	_cmFrameList[_cmFrameListSize++] = frameObj.id;
}

//////////////////////////////////////////////////////////////////////
//
// Drawing Functions and Utility Functions
//
//////////////////////////////////////////////////////////////////////

//
// produce a new unique id
//
function cmNewID ()
{
	return _cmIDName + (++_cmIDCount);
}

//
// return the property string for the menu item
//
function cmActionItem (item, isMain, idSub, menuInfo, menuID)
{
	_cmItemList[_cmItemList.length] = item;
	var index = _cmItemList.length - 1;
	idSub = (!idSub) ? 'null' : ('\'' + idSub + '\'');

	var clickOpen = menuInfo.nodeProperties.clickOpen;
	var onClick = (clickOpen == 3) || (clickOpen == 2 && isMain);

	var param = 'this,' + isMain + ',' + idSub + ',' + menuID + ',' + index;

	var returnStr;
	if (onClick)
		returnStr = ' onmouseover="cmItemMouseOver(' + param + ',false)" onmousedown="cmItemMouseDownOpenSub (' + param + ')"';
	else
		returnStr = ' onmouseover="cmItemMouseOverOpenSub (' + param + ')" onmousedown="cmItemMouseDown (' + param + ')"';
	return returnStr + ' onmouseout="cmItemMouseOut (' + param + ')" onmouseup="cmItemMouseUp (' + param + ')"';
}

//
// this one is used by _cmNoClick to only take care of onmouseover and onmouseout
// events which are associated with menu but not actions associated with menu clicking/closing
//
function cmNoClickItem (item, isMain, idSub, menuInfo, menuID)
{
	// var index = _cmItemList.push (item) - 1;
	_cmItemList[_cmItemList.length] = item;
	var index = _cmItemList.length - 1;
	idSub = (!idSub) ? 'null' : ('\'' + idSub + '\'');

	var param = 'this,' + isMain + ',' + idSub + ',' + menuID + ',' + index;

	return ' onmouseover="cmItemMouseOver (' + param + ')" onmouseout="cmItemMouseOut (' + param + ')"';
}

function cmNoActionItem (item)
{
	return item[1];
}

function cmSplitItem (prefix, isMain, vertical)
{
	var classStr = 'cm' + prefix;
	if (isMain)
	{
		classStr += 'Main';
		if (vertical)
			classStr += 'HSplit';
		else
			classStr += 'VSplit';
	}
	else
		classStr += 'HSplit';
	return eval (classStr);
}

//
// draw the sub menu recursively
//
function cmDrawSubMenu (subMenu, prefix, id, nodeProperties, zIndexStart, menuInfo, menuID)
{
	var str = '<div class="' + prefix + 'SubMenu" id="' + id + '" style="z-index: ' + zIndexStart + ';position: absolute; top: 0px; left: 0px;">';
	if (nodeProperties.subMenuHeader)
		str += nodeProperties.subMenuHeader;

	str += '<table summary="sub menu" id="' + id + 'Table" cellspacing="' + nodeProperties.subSpacing + '" class="' + prefix + 'SubMenuTable">';

	var strSub = '';

	var item;
	var idSub;
	var hasChild;

	var i;

	var classStr;

	for (i = 5; i < subMenu.length; ++i)
	{
		item = subMenu[i];
		if (!item)
			continue;

		if (item == _cmSplit)
			item = cmSplitItem (prefix, 0, true);
		item.parentItem = subMenu;
		item.subMenuID = id;

		hasChild = (item.length > 5);
		idSub = hasChild ? cmNewID () : null;

		str += '<tr class="' + prefix + 'MenuItem"';
		if (item[0] != _cmNoClick)
			str += cmActionItem (item, 0, idSub, menuInfo, menuID);
		else
			str += cmNoClickItem (item, 0, idSub, menuInfo, menuID);
		str += '>'

		if (item[0] == _cmNoAction || item[0] == _cmNoClick)
		{
			str += cmNoActionItem (item);
			str += '</tr>';
			continue;
		}

		classStr = prefix + 'Menu';
		classStr += hasChild ? 'Folder' : 'Item';

		str += '<td class="' + classStr + 'Left">';

		if (item[0] != null)
			str += item[0];
		else
			str += hasChild ? nodeProperties.folderLeft : nodeProperties.itemLeft;

		str += '</td><td class="' + classStr + 'Text">' + item[1];

		str += '</td><td class="' + classStr + 'Right">';

		if (hasChild)
		{
			str += nodeProperties.folderRight;
			strSub += cmDrawSubMenu (item, prefix, idSub, nodeProperties, zIndexStart + nodeProperties.zIndexInc, menuInfo, menuID);
		}
		else
			str += nodeProperties.itemRight;
		str += '</td></tr>';
	}

	str += '</table>';

	if (nodeProperties.subMenuFooter)
		str += nodeProperties.subMenuFooter;
	str += '</div>' + strSub;
	return str;
}

//
// The function that builds the menu inside the specified element id.
//
// id				id of the element
// orient			orientation of the menu in [hv][ub][lr] format
// menu				the menu object to be drawn
// nodeProperties	properties for the theme
// prefix			prefix of the theme
//
function cmDraw (id, menu, orient, nodeProperties, prefix)
{
	var obj = cmGetObject (id);

	if (!prefix)
		prefix = nodeProperties.prefix;
	if (!prefix)
		prefix = '';
	if (!nodeProperties)
		nodeProperties = _cmNodeProperties;
	if (!orient)
		orient = 'hbr';

	var menuID = cmAllocMenu (id, menu, orient, nodeProperties, prefix);
	var menuInfo = _cmMenuList[menuID];

	// setup potentially missing properties
	if (!nodeProperties.delay)
		nodeProperties.delay = _cmNodeProperties.delay;
	if (!nodeProperties.clickOpen)
		nodeProperties.clickOpen = _cmNodeProperties.clickOpen;
	if (!nodeProperties.zIndexStart)
		nodeProperties.zIndexStart = _cmNodeProperties.zIndexStart;
	if (!nodeProperties.zIndexInc)
		nodeProperties.zIndexInc = _cmNodeProperties.zIndexInc;
	if (!nodeProperties.offsetHMainAdjust)
		nodeProperties.offsetHMainAdjust = _cmNodeProperties.offsetHMainAdjust;
	if (!nodeProperties.offsetVMainAdjust)
		nodeProperties.offsetVMainAdjust = _cmNodeProperties.offsetVMainAdjust;
	if (!nodeProperties.offsetSubAdjust)
		nodeProperties.offsetSubAdjust = _cmNodeProperties.offsetSubAdjust;
	// save user setting on frame masking
	menuInfo.cmFrameMasking = _cmFrameMasking;

	var str = '<table summary="main menu" class="' + prefix + 'Menu" cellspacing="' + nodeProperties.mainSpacing + '">';
	var strSub = '';

	var vertical;

	// draw the main menu items
	if (orient.charAt (0) == 'h')
	{
		str += '<tr>';
		vertical = false;
	}
	else
	{
		vertical = true;
	}

	var i;
	var item;
	var idSub;
	var hasChild;

	var classStr;

	for (i = 0; i < menu.length; ++i)
	{
		item = menu[i];

		if (!item)
			continue;

		item.menu = menu;
		item.subMenuID = id;

		str += vertical ? '<tr' : '<td';
		str += ' class="' + prefix + 'MainItem"';

		hasChild = (item.length > 5);
		idSub = hasChild ? cmNewID () : null;

		str += cmActionItem (item, 1, idSub, menuInfo, menuID) + '>';

		if (item == _cmSplit)
			item = cmSplitItem (prefix, 1, vertical);

		if (item[0] == _cmNoAction || item[0] == _cmNoClick)
		{
			str += cmNoActionItem (item);
			str += vertical? '</tr>' : '</td>';
			continue;
		}

		classStr = prefix + 'Main' + (hasChild ? 'Folder' : 'Item');

		str += vertical ? '<td' : '<span';
		str += ' class="' + classStr + 'Left">';

		str += (item[0] == null) ? (hasChild ? nodeProperties.mainFolderLeft : nodeProperties.mainItemLeft)
					 : item[0];
		str += vertical ? '</td>' : '</span>';

		str += vertical ? '<td' : '<span';
		str += ' class="' + classStr + 'Text">';
		str += item[1];

		str += vertical ? '</td>' : '</span>';

		str += vertical ? '<td' : '<span';
		str += ' class="' + classStr + 'Right">';

		str += hasChild ? nodeProperties.mainFolderRight : nodeProperties.mainItemRight;

		str += vertical ? '</td>' : '</span>';

		str += vertical ? '</tr>' : '</td>';

		if (hasChild)
			strSub += cmDrawSubMenu (item, prefix, idSub, nodeProperties, nodeProperties.zIndexStart, menuInfo, menuID);
	}
	if (!vertical)
		str += '</tr>';
	str += '</table>' + strSub;
	obj.innerHTML = str;
}

//
// The function builds the menu inside the specified element id.
//
// This function is similar to cmDraw except that menu is taken from HTML node
// rather a javascript tree.  This feature allows links to be scanned by search
// bots.
//
// This function basically converts HTML node to a javascript tree, and then calls
// cmDraw to draw the actual menu, replacing the hidden menu tree.
//
// Format:
//	<div id="menu">
//		<ul style="visibility: hidden">
//			<li><span>icon</span><a href="link" title="description">main menu text</a>
//				<ul>
//					<li><span>icon</span><a href="link" title="description">submenu item</a>
//					</li>
//				</ul>
//			</li>
//		</ul>
//	</div>
//
function cmDrawFromText (id, orient, nodeProperties, prefix)
{
	var domMenu = cmGetObject (id);
	var menu = null;
	for (var currentDomItem = domMenu.firstChild; currentDomItem; currentDomItem = currentDomItem.nextSibling)
	{
		if (!currentDomItem.tagName)
			continue;
		var tag = currentDomItem.tagName.toLowerCase ();
		if (tag != 'ul' && tag != 'ol')
			continue;
		menu = cmDrawFromTextSubMenu (currentDomItem);
		break;
	}
	if (menu)
		cmDraw (id, menu, orient, nodeProperties, prefix);
}

//
// a recursive function that build menu tree structure
//
function cmDrawFromTextSubMenu (domMenu)
{
	var items = new Array ();
	for (var currentDomItem = domMenu.firstChild; currentDomItem; currentDomItem = currentDomItem.nextSibling)
	{
		if (!currentDomItem.tagName || currentDomItem.tagName.toLowerCase () != 'li')
			continue;
		if (currentDomItem.firstChild == null)
		{
			items[items.length] = _cmSplit;
			continue;
		}
		var item = new Array ();
		var currentItem = currentDomItem.firstChild;
		var hasAction = false;
		for (; currentItem; currentItem = currentItem.nextSibling)
		{
			// scan for span or div tag
			if (!currentItem.tagName)
				continue;
			if (currentItem.className == 'cmNoClick')
			{
				item[0] = _cmNoClick;
				item[1] = getActionHTML (currentItem);
				hasAction = true;
				break;
			}
			if (currentItem.className == 'cmNoAction')
			{
				item[0] = _cmNoAction;
				item[1] = getActionHTML (currentItem);
				hasAction = true;
				break;
			}
			var tag = currentItem.tagName.toLowerCase ();
			if (tag != 'span')
				continue;
			if (!currentItem.firstChild)
				item[0] = null;
			else
				item[0] = currentItem.innerHTML;
			currentItem = currentItem.nextSibling;
			break;
		}
		if (hasAction)
		{
			items[items.length] = item;
			continue;
		}
		if (!currentItem)
			continue;
		for (; currentItem; currentItem = currentItem.nextSibling)
		{
			if (!currentItem.tagName)
				continue;
			var tag = currentItem.tagName.toLowerCase ();
			if (tag == 'a')
			{
				item[1] = currentItem.innerHTML;
				item[2] = currentItem.href;
				item[3] = currentItem.target;
				item[4] = currentItem.title;
				if (item[4] == '')
					item[4] = null;
			}
			else if (tag == 'span' || tag == 'div')
			{
				item[1] = currentItem.innerHTML;
				item[2] = null;
				item[3] = null;
				item[4] = null;
			}
			break;
		}

		for (; currentItem; currentItem = currentItem.nextSibling)
		{
			// scan for span tag
			if (!currentItem.tagName)
				continue;
			var tag = currentItem.tagName.toLowerCase ();
			if (tag != 'ul' && tag != 'ol')
				continue;
			var subMenuItems = cmDrawFromTextSubMenu (currentItem);
			for (i = 0; i < subMenuItems.length; ++i)
				item[i + 5] = subMenuItems[i];
			break;
		}
		items[items.length] = item;
	}
	return items;
}

//
// obtain the actual action item's action, which is inside a
// table.  The first row should be it
//
function getActionHTML (htmlNode)
{
	var returnVal = '<td></td><td></td><td></td>';
	var currentDomItem;
	// find the table first
	for (currentDomItem = htmlNode.firstChild; currentDomItem; currentDomItem = currentDomItem.nextSibling)
	{
		if (currentDomItem.tagName && currentDomItem.tagName.toLowerCase () == 'table')
			break;
	}
	if (!currentDomItem)
		return returnVal;
	// skip over tbody
	for (currentDomItem = currentDomItem.firstChild; currentDomItem; currentDomItem = currentDomItem.nextSibling)
	{
		if (currentDomItem.tagName && currentDomItem.tagName.toLowerCase () == 'tbody')
			break;
	}
	if (!currentDomItem)
		return returnVal;
	// get the first tr
	for (currentDomItem = currentDomItem.firstChild; currentDomItem; currentDomItem = currentDomItem.nextSibling)
	{
		if (currentDomItem.tagName && currentDomItem.tagName.toLowerCase () == 'tr')
			break;
	}
	if (!currentDomItem)
		return returnVal;
	return currentDomItem.innerHTML;
}

//
// get the DOM object associated with the item
//
function cmGetMenuItem (item)
{
	if (!item.subMenuID)
		return null;
	var subMenu = cmGetObject (item.subMenuID);
	// we are dealing with a main menu item
	if (item.menu)
	{
		var menu = item.menu;
		// skip over table, tbody, tr, reach td
		subMenu = subMenu.firstChild.firstChild.firstChild.firstChild;
		var i;
		for (i = 0; i < menu.length; ++i)
		{
			if (menu[i] == item)
				return subMenu;
			subMenu = subMenu.nextSibling;
		}
	}
	else if (item.parentItem) // sub menu item
	{
		var menu = item.parentItem;
		var table = cmGetObject (item.subMenuID + 'Table');
		if (!table)
			return null;
		// skip over table, tbody, reach tr
		subMenu = table.firstChild.firstChild;
		var i;
		for (i = 5; i < menu.length; ++i)
		{
			if (menu[i] == item)
				return subMenu;
			subMenu = subMenu.nextSibling;
		}
	}
	return null;
}

//
// disable a menu item
//
function cmDisableItem (item, prefix)
{
	if (!item)
		return;
	var menuItem = cmGetMenuItem (item);
	if (!menuItem)
		return;
	if (item.menu)
		menuItem.className = prefix + 'MainItemDisabled';
	else
		menuItem.className = prefix + 'MenuItemDisabled';
	item.isDisabled = true;
}

//
// enable a menu item
//
function cmEnableItem (item, prefix)
{
	if (!item)
		return;
	var menuItem = cmGetMenuItem (item);
	if (!menuItem)
		return;
	if (item.menu)
		menu.className = prefix + 'MainItem';
	else
		menu.className = prefix + 'MenuItem';
	item.isDisabled = true;
}

//////////////////////////////////////////////////////////////////////
//
// Mouse Event Handling Functions
//
//////////////////////////////////////////////////////////////////////

//
// action should be taken for mouse moving in to the menu item
//
// Here we just do things concerning this menu item, w/o opening sub menus.
//
function cmItemMouseOver (obj, isMain, idSub, menuID, index, calledByOpenSub)
{
	if (!calledByOpenSub && _cmClicked)
	{
		cmItemMouseOverOpenSub (obj, isMain, idSub, menuID, index);
		return;
	}

	clearTimeout (_cmTimeOut);

	if (_cmItemList[index].isDisabled)
		return;

	var prefix = _cmMenuList[menuID].prefix;

	if (!obj.cmMenuID)
	{
		obj.cmMenuID = menuID;
		obj.cmIsMain = isMain;
	}

	var thisMenu = cmGetThisMenu (obj, prefix);

	// insert obj into cmItems if cmItems doesn't have obj
	if (!thisMenu.cmItems)
		thisMenu.cmItems = new Array ();
	var i;
	for (i = 0; i < thisMenu.cmItems.length; ++i)
	{
		if (thisMenu.cmItems[i] == obj)
			break;
	}
	if (i == thisMenu.cmItems.length)
	{
		//thisMenu.cmItems.push (obj);
		thisMenu.cmItems[i] = obj;
	}

	// hide the previous submenu that is not this branch
	if (_cmCurrentItem)
	{
		// occationally, we get this case when user
		// move the mouse slowly to the border
		if (_cmCurrentItem == obj || _cmCurrentItem == thisMenu)
		{
			var item = _cmItemList[index];
			cmSetStatus (item);
			return;
		}

		var thatMenuInfo = _cmMenuList[_cmCurrentItem.cmMenuID];
		var thatPrefix = thatMenuInfo.prefix;
		var thatMenu = cmGetThisMenu (_cmCurrentItem, thatPrefix);

		if (thatMenu != thisMenu.cmParentMenu)
		{
			if (_cmCurrentItem.cmIsMain)
				_cmCurrentItem.className = thatPrefix + 'MainItem';
			else
				_cmCurrentItem.className = thatPrefix + 'MenuItem';
			if (thatMenu.id != idSub)
				cmHideMenu (thatMenu, thisMenu, thatMenuInfo);
		}
	}

	// okay, set the current menu to this obj
	_cmCurrentItem = obj;

	// just in case, reset all items in this menu to MenuItem
	cmResetMenu (thisMenu, prefix);

	var item = _cmItemList[index];
	var isDefaultItem = cmIsDefaultItem (item);

	if (isDefaultItem)
	{
		if (isMain)
			obj.className = prefix + 'MainItemHover';
		else
			obj.className = prefix + 'MenuItemHover';
	}

	cmSetStatus (item);
}

//
// action should be taken for mouse moving in to the menu item
//
// This function also opens sub menu
//
function cmItemMouseOverOpenSub (obj, isMain, idSub, menuID, index)
{
	clearTimeout (_cmTimeOut);

	if (_cmItemList[index].isDisabled)
		return;

	cmItemMouseOver (obj, isMain, idSub, menuID, index, true);

	if (idSub)
	{
		var subMenu = cmGetObject (idSub);
		var menuInfo = _cmMenuList[menuID];
		var orient = menuInfo.orient;
		var prefix = menuInfo.prefix;
		cmShowSubMenu (obj, isMain, subMenu, menuInfo);
	}
}

//
// action should be taken for mouse moving out of the menu item
//
function cmItemMouseOut (obj, isMain, idSub, menuID, index)
{
	var delayTime = _cmMenuList[menuID].nodeProperties.delay;
	_cmTimeOut = window.setTimeout ('cmHideMenuTime ()', delayTime);
	window.defaultStatus = '';
}

//
// action should be taken for mouse button down at a menu item
//
function cmItemMouseDown (obj, isMain, idSub, menuID, index)
{
	if (_cmItemList[index].isDisabled)
		return;

	if (cmIsDefaultItem (_cmItemList[index]))
	{
		var prefix = _cmMenuList[menuID].prefix;
		if (obj.cmIsMain)
			obj.className = prefix + 'MainItemActive';
		else
			obj.className = prefix + 'MenuItemActive';
	}
}

//
// action should be taken for mouse button down at a menu item
// this is one also opens submenu if needed
//
function cmItemMouseDownOpenSub (obj, isMain, idSub, menuID, index)
{
	if (_cmItemList[index].isDisabled)
		return;

	_cmClicked = true;
	cmItemMouseDown (obj, isMain, idSub, menuID, index);

	if (idSub)
	{
		var subMenu = cmGetObject (idSub);
		var menuInfo = _cmMenuList[menuID];
		cmShowSubMenu (obj, isMain, subMenu, menuInfo);
	}
}

//
// action should be taken for mouse button up at a menu item
//
function cmItemMouseUp (obj, isMain, idSub, menuID, index)
{
	if (_cmItemList[index].isDisabled)
		return;

	var item = _cmItemList[index];

	var link = null, target = '_self';

	if (item.length > 2)
		link = item[2];
	if (item.length > 3 && item[3])
		target = item[3];

	if (link != null)
	{
		_cmClicked = false;
		window.open (link, target);
	}

	var menuInfo = _cmMenuList[menuID];
	var prefix = menuInfo.prefix;
	var thisMenu = cmGetThisMenu (obj, prefix);

	var hasChild = (item.length > 5);
	if (!hasChild)
	{
		if (cmIsDefaultItem (item))
		{
			if (obj.cmIsMain)
				obj.className = prefix + 'MainItem';
			else
				obj.className = prefix + 'MenuItem';
		}
		cmHideMenu (thisMenu, null, menuInfo);
	}
	else
	{
		if (cmIsDefaultItem (item))
		{
			if (obj.cmIsMain)
				obj.className = prefix + 'MainItemHover';
			else
				obj.className = prefix + 'MenuItemHover';
		}
	}
}

//////////////////////////////////////////////////////////////////////
//
// Mouse Event Support Utility Functions
//
//////////////////////////////////////////////////////////////////////

//
// move submenu to the appropriate location
//
function cmMoveSubMenu (obj, isMain, subMenu, menuInfo)
{
	var orient = menuInfo.orient;

	var offsetAdjust;

	if (isMain)
	{
		if (orient.charAt (0) == 'h')
			offsetAdjust = menuInfo.nodeProperties.offsetHMainAdjust;
		else
			offsetAdjust = menuInfo.nodeProperties.offsetVMainAdjust;
	}
	else
		offsetAdjust = menuInfo.nodeProperties.offsetSubAdjust;

	if (!isMain && orient.charAt (0) == 'h')
		orient = 'v' + orient.charAt (1) + orient.charAt (2);

	var mode = String (orient);
	var p = subMenu.offsetParent;
	var subMenuWidth = cmGetWidth (subMenu);
	var horiz = cmGetHorizontalAlign (obj, mode, p, subMenuWidth);
	if (mode.charAt (0) == 'h')
	{
		if (mode.charAt (1) == 'b')
			subMenu.style.top = (cmGetYAt (obj, p) + cmGetHeight (obj) + offsetAdjust[1]) + 'px';
		else
			subMenu.style.top = (cmGetYAt (obj, p) - cmGetHeight (subMenu) - offsetAdjust[1]) + 'px';
		if (horiz == 'r')
			subMenu.style.left = (cmGetXAt (obj, p) + offsetAdjust[0]) + 'px';
		else
			subMenu.style.left = (cmGetXAt (obj, p) + cmGetWidth (obj) - subMenuWidth - offsetAdjust[0]) + 'px';
	}
	else
	{
		if (horiz == 'r')
			subMenu.style.left = (cmGetXAt (obj, p) + cmGetWidth (obj) + offsetAdjust[0]) + 'px';
		else
			subMenu.style.left = (cmGetXAt (obj, p) - subMenuWidth - offsetAdjust[0]) + 'px';
		if (mode.charAt (1) == 'b')
			subMenu.style.top = (cmGetYAt (obj, p) + offsetAdjust[1]) + 'px';
		else
			subMenu.style.top = (cmGetYAt (obj, p) + cmGetHeight (obj) - cmGetHeight (subMenu) + offsetAdjust[1]) + 'px';
	}

	// IE specific iframe masking method
	/*@cc_on
		@if (@_jscript_version >= 5.5)
			if (menuInfo.cmFrameMasking)
			{
				if (!subMenu.cmFrameObj)
				{
					var frameObj = cmAllocFrame ();
					subMenu.cmFrameObj = frameObj;
				}

				var frameObj = subMenu.cmFrameObj;
				frameObj.style.zIndex = subMenu.style.zIndex - 1;
				frameObj.style.left = (cmGetX (subMenu) - cmGetX (frameObj.offsetParent)) + 'px';
				frameObj.style.top = (cmGetY (subMenu)  - cmGetY (frameObj.offsetParent)) + 'px';
				frameObj.style.width = cmGetWidth (subMenu) + 'px';
				frameObj.style.height = cmGetHeight (subMenu) + 'px';
				frameObj.style.display = 'block';
			}
		@end
	@*/
	if (horiz != orient.charAt (2))
		orient = orient.charAt (0) + orient.charAt (1) + horiz;
	return orient;
}

//
// automatically re-adjust the menu position based on available screen size.
//
function cmGetHorizontalAlign (obj, mode, p, subMenuWidth)
{
	var horiz = mode.charAt (2);
	if (!(document.body))
		return horiz;
	var body = document.body;
	var browserLeft;
	var browserRight;
	if (window.innerWidth)
	{
		// DOM window attributes
		browserLeft = window.pageXOffset;
		browserRight = window.innerWidth + browserLeft;
	}
	else if (body.clientWidth)
	{
		// IE attributes
		browserLeft = body.clientLeft;
		browserRight = body.clientWidth + browserLeft;
	}
	else
		return horiz;
	if (mode.charAt (0) == 'h')
	{
		if (horiz == 'r' && (cmGetXAt (obj) + subMenuWidth) > browserRight)
			horiz = 'l';
		if (horiz == 'l' && (cmGetXAt (obj) + cmGetWidth (obj) - subMenuWidth) < browserLeft)
			horiz = 'r';
		return horiz;
	}
	else
	{
		if (horiz == 'r' && (cmGetXAt (obj, p) + cmGetWidth (obj) + subMenuWidth) > browserRight)
			horiz = 'l';
		if (horiz == 'l' && (cmGetXAt (obj, p) - subMenuWidth) < browserLeft)
			horiz = 'r';
		return horiz;
	}
}

//
// show the subMenu w/ specified orientation
// also move it to the correct coordinates
//
function cmShowSubMenu (obj, isMain, subMenu, menuInfo)
{
	var prefix = menuInfo.prefix;

	if (!subMenu.cmParentMenu)
	{
		// establish the tree w/ back edge
		var thisMenu = cmGetThisMenu (obj, prefix);
		subMenu.cmParentMenu = thisMenu;
		if (!thisMenu.cmSubMenu)
			thisMenu.cmSubMenu = new Array ();
		thisMenu.cmSubMenu[thisMenu.cmSubMenu.length] = subMenu;
	}

	var effectInstance = subMenu.cmEffect;
	if (effectInstance)
		effectInstance.showEffect (true);
	else
	{
		// position the sub menu only if we are not already showing the submenu
		var orient = cmMoveSubMenu (obj, isMain, subMenu, menuInfo);
		subMenu.cmOrient = orient;

		var forceShow = false;
		if (subMenu.style.visibility != 'visible' && menuInfo.nodeProperties.effect)
		{
			try
			{
				effectInstance = menuInfo.nodeProperties.effect.getInstance (subMenu, orient);
				effectInstance.showEffect (false);
			}
			catch (e)
			{
				forceShow = true;
				subMenu.cmEffect = null;
			}
		}
		else
			forceShow = true;

		if (forceShow)
		{
			subMenu.style.visibility = 'visible';
			/*@cc_on
				@if (@_jscript_version >= 5.5)
					if (subMenu.cmFrameObj)
						subMenu.cmFrameObj.style.display = 'block';
				@end
			@*/
		}
	}

	if (!_cmHideObjects)
	{
		_cmHideObjects = 2;	// default = not hide, may change behavior later
		try
		{
			if (window.opera)
			{
				if (parseInt (navigator.appVersion) < 9)
					_cmHideObjects = 1;
			}
		}
		catch (e)
		{
		}
	}

	if (_cmHideObjects == 1)
	{
		if (!subMenu.cmOverlap)
			subMenu.cmOverlap = new Array ();
		cmHideControl ("IFRAME", subMenu);
		cmHideControl ("OBJECT", subMenu);
	}
}

//
// reset all the menu items to class MenuItem in thisMenu
//
function cmResetMenu (thisMenu, prefix)
{
	if (thisMenu.cmItems)
	{
		var i;
		var str;
		var items = thisMenu.cmItems;
		for (i = 0; i < items.length; ++i)
		{
			if (items[i].cmIsMain)
			{
				if (items[i].className == (prefix + 'MainItemDisabled'))
					continue;
			}
			else
			{
				if (items[i].className == (prefix + 'MenuItemDisabled'))
					continue;
			}
			if (items[i].cmIsMain)
				str = prefix + 'MainItem';
			else
				str = prefix + 'MenuItem';
			if (items[i].className != str)
				items[i].className = str;
		}
	}
}

//
// called by the timer to hide the menu
//
function cmHideMenuTime ()
{
	_cmClicked = false;
	if (_cmCurrentItem)
	{
		var menuInfo = _cmMenuList[_cmCurrentItem.cmMenuID];
		var prefix = menuInfo.prefix;
		cmHideMenu (cmGetThisMenu (_cmCurrentItem, prefix), null, menuInfo);
		_cmCurrentItem = null;
	}
}

//
// Only hides this menu
//
function cmHideThisMenu (thisMenu, menuInfo)
{
	var effectInstance = thisMenu.cmEffect;
	if (effectInstance)
		effectInstance.hideEffect (true);
	else
	{
		thisMenu.style.visibility = 'hidden';
		thisMenu.style.top = '0px';
		thisMenu.style.left = '0px';
		thisMenu.cmOrient = null;
		/*@cc_on
			@if (@_jscript_version >= 5.5)
				if (thisMenu.cmFrameObj)
				{
					var frameObj = thisMenu.cmFrameObj;
					frameObj.style.display = 'none';
					frameObj.style.width = '1px';
					frameObj.style.height = '1px';
					thisMenu.cmFrameObj = null;
					cmFreeFrame (frameObj);
				}
			@end
		@*/
	}

	cmShowControl (thisMenu);
	thisMenu.cmItems = null;
}

//
// hide thisMenu, children of thisMenu, as well as the ancestor
// of thisMenu until currentMenu is encountered.  currentMenu
// will not be hidden
//
function cmHideMenu (thisMenu, currentMenu, menuInfo)
{
	var prefix = menuInfo.prefix;
	var str = prefix + 'SubMenu';

	// hide the down stream menus
	if (thisMenu.cmSubMenu)
	{
		var i;
		for (i = 0; i < thisMenu.cmSubMenu.length; ++i)
		{
			cmHideSubMenu (thisMenu.cmSubMenu[i], menuInfo);
		}
	}

	// hide the upstream menus
	while (thisMenu && thisMenu != currentMenu)
	{
		cmResetMenu (thisMenu, prefix);
		if (thisMenu.className == str)
		{
			cmHideThisMenu (thisMenu, menuInfo);
		}
		else
			break;
		thisMenu = cmGetThisMenu (thisMenu.cmParentMenu, prefix);
	}
}

//
// hide thisMenu as well as its sub menus if thisMenu is not
// already hidden
//
function cmHideSubMenu (thisMenu, menuInfo)
{
	if (thisMenu.style.visibility == 'hidden')
		return;
	if (thisMenu.cmSubMenu)
	{
		var i;
		for (i = 0; i < thisMenu.cmSubMenu.length; ++i)
		{
			cmHideSubMenu (thisMenu.cmSubMenu[i], menuInfo);
		}
	}
	var prefix = menuInfo.prefix;
	cmResetMenu (thisMenu, prefix);
	cmHideThisMenu (thisMenu, menuInfo);
}

//
// hide a control such as IFRAME
//
function cmHideControl (tagName, subMenu)
{
	var x = cmGetX (subMenu);
	var y = cmGetY (subMenu);
	var w = subMenu.offsetWidth;
	var h = subMenu.offsetHeight;

	var i;
	for (i = 0; i < document.all.tags(tagName).length; ++i)
	{
		var obj = document.all.tags(tagName)[i];
		if (!obj || !obj.offsetParent)
			continue;

		// check if the object and the subMenu overlap

		var ox = cmGetX (obj);
		var oy = cmGetY (obj);
		var ow = obj.offsetWidth;
		var oh = obj.offsetHeight;

		if (ox > (x + w) || (ox + ow) < x)
			continue;
		if (oy > (y + h) || (oy + oh) < y)
			continue;

		// if object is already made hidden by a different
		// submenu then we dont want to put it on overlap list of
		// of a submenu a second time.
		// - bug fixed by Felix Zaslavskiy
		if(obj.style.visibility == 'hidden')
			continue;

		//subMenu.cmOverlap.push (obj);
		subMenu.cmOverlap[subMenu.cmOverlap.length] = obj;
		obj.style.visibility = 'hidden';
	}
}

//
// show the control hidden by the subMenu
//
function cmShowControl (subMenu)
{
	if (subMenu.cmOverlap)
	{
		var i;
		for (i = 0; i < subMenu.cmOverlap.length; ++i)
			subMenu.cmOverlap[i].style.visibility = "";
	}
	subMenu.cmOverlap = null;
}

//
// returns the main menu or the submenu table where this obj (menu item)
// is in
//
function cmGetThisMenu (obj, prefix)
{
	var str1 = prefix + 'SubMenu';
	var str2 = prefix + 'Menu';
	while (obj)
	{
		if (obj.className == str1 || obj.className == str2)
			return obj;
		obj = obj.parentNode;
	}
	return null;
}

//
// A special effect function to hook the menu which contains
// special effect object to the timer.
//
function cmTimeEffect (menuID, show, delayTime)
{
	window.setTimeout ('cmCallEffect("' + menuID + '",' + show + ')', delayTime);
}

//
// A special effect function.  Called by timer.
//
function cmCallEffect (menuID, show)
{
	var menu = cmGetObject (menuID);
	if (!menu || !menu.cmEffect)
		return;
	try
	{
		if (show)
			menu.cmEffect.showEffect (false);
		else
			menu.cmEffect.hideEffect (false);
	}
	catch (e)
	{
	}
}

//
// return true if this item is handled using default handlers
//
function cmIsDefaultItem (item)
{
	if (item == _cmSplit || item[0] == _cmNoAction || item[0] == _cmNoClick)
		return false;
	return true;
}

//
// returns the object baring the id
//
function cmGetObject (id)
{
	if (document.all)
		return document.all[id];
	return document.getElementById (id);
}

//
// functions that obtain the width of an HTML element.
//
function cmGetWidth (obj)
{
	var width = obj.offsetWidth;
	if (width > 0 || !cmIsTRNode (obj))
		return width;
	if (!obj.firstChild)
		return 0;
	// use TABLE's length can cause an extra pixel gap
	//return obj.parentNode.parentNode.offsetWidth;

	// use the left and right child instead
	return obj.lastChild.offsetLeft - obj.firstChild.offsetLeft + cmGetWidth (obj.lastChild);
}

//
// functions that obtain the height of an HTML element.
//
function cmGetHeight (obj)
{
	var height = obj.offsetHeight;
	if (height > 0 || !cmIsTRNode (obj))
		return height;
	if (!obj.firstChild)
		return 0;
	// use the first child's height
	return obj.firstChild.offsetHeight;
}

//
// functions that obtain the coordinates of an HTML element
//
function cmGetX (obj)
{
	if (!obj)
		return 0;
	var x = 0;

	do
	{
		x += obj.offsetLeft;
		obj = obj.offsetParent;
	}
	while (obj);
	return x;
}

function cmGetXAt (obj, elm)
{
	var x = 0;

	while (obj && obj != elm)
	{
		x += obj.offsetLeft;
		obj = obj.offsetParent;
	}
	if (obj == elm)
		return x;
	return x - cmGetX (elm);
}

function cmGetY (obj)
{
	if (!obj)
		return 0;
	var y = 0;
	do
	{
		y += obj.offsetTop;
		obj = obj.offsetParent;
	}
	while (obj);
	return y;
}

function cmIsTRNode (obj)
{
	var tagName = obj.tagName;
	return tagName == "TR" || tagName == "tr" || tagName == "Tr" || tagName == "tR";
}

//
// get the Y position of the object.  In case of TR element though,
// we attempt to adjust the value.
//
function cmGetYAt (obj, elm)
{
	var y = 0;

	if (!obj.offsetHeight && cmIsTRNode (obj))
	{
		var firstTR = obj.parentNode.firstChild;
		obj = obj.firstChild;
		y -= firstTR.firstChild.offsetTop;
	}

	while (obj && obj != elm)
	{
		y += obj.offsetTop;
		obj = obj.offsetParent;
	}

	if (obj == elm)
		return y;
	return y - cmGetY (elm);
}

//
// extract description from the menu item and set the status text
//
function cmSetStatus (item)
{
	var descript = '';
	if (item.length > 4)
		descript = (item[4] != null) ? item[4] : (item[2] ? item[2] : descript);
	else if (item.length > 2)
		descript = (item[2] ? item[2] : descript);

	window.defaultStatus = descript;
}

//
// debug function, ignore :)
//
function cmGetProperties (obj)
{
	if (obj == undefined)
		return 'undefined';
	if (obj == null)
		return 'null';

	var msg = obj + ':\n';
	var i;
	for (i in obj)
		msg += i + ' = ' + obj[i] + '; ';
	return msg;
}

/*
	JSCookMenu Effect (c) Copyright 2002-2006 by Heng Yuan

	http://jscook.sourceforge.net/JSCookMenu/

	Permission is hereby granted, free of charge, to any person obtaining a
	copy of this software and associated documentation files (the "Software"),
	to deal in the Software without restriction, including without limitation
	the rights to use, copy, modify, merge, publish, distribute, sublicense,
	and/or sell copies of the Software, and to permit persons to whom the
	Software is furnished to do so, subject to the following conditions:

	The above copyright notice and this permission notice shall be included
	in all copies or substantial portions of the Software.

	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS
	OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
	ITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
	AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
	LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
	FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
	DEALINGS IN THE SOFTWARE.
*/
//
// utiltity object to simplify common tasks in effects.
//
function CMSpecialEffectInstance (effect, menu)
{
	effect.show = true;
	effect.menu = menu;
	menu.cmEffect = effect;
	this.effect = effect;
}

CMSpecialEffectInstance.prototype.canShow = function (changed)
{
	if (changed)
	{
		if (this.effect.show)
			return false;
		this.effect.show = true;
	}
	else if (!this.effect.show)
		return false;
	return true;
}

CMSpecialEffectInstance.prototype.canHide = function (changed)
{
	var effect = this.effect;
	if (changed)
	{
		if (!effect.show)
			return false;
		effect.show = false;
	}
	else if (effect.show)
		return false;
	return true;
}

//
// public function to be called to initate the display of the
// menu.
//
CMSpecialEffectInstance.prototype.startShowing = function ()
{
	var menu = this.effect.menu;
	menu.style.visibility = 'visible';
	/*@cc_on
		@if (@_jscript_version >= 5.5)
			if (menu.cmFrameObj)
			{
				var frameObj = menu.cmFrameObj;
				frameObj.style.display = 'block';
			}
		@end
	@*/
}

//
// public function to be called after showing effect is finished.
//
CMSpecialEffectInstance.prototype.finishShowing = function ()
{
}

//
// clean up after finish hiding effect.
//
CMSpecialEffectInstance.prototype.finishHiding = function ()
{
	var menu = this.effect.menu;
	menu.style.visibility = 'hidden';
	menu.style.top = '0px';
	menu.style.left = '0px';
	/*@cc_on
		@if (@_jscript_version >= 5.5)
			if (menu.cmFrameObj)
			{
				var frameObj = menu.cmFrameObj;
				frameObj.style.display = 'none';
				frameObj.style.top = '0px';
				frameObj.style.left = '0px';
				menu.cmFrameObj = null;
				cmFreeFrame (frameObj);
			}
		@end
	@*/
	menu.cmEffect = null;
	menu.cmOrient = null;
	this.effect.menu = null;
}

//
// this is the internal class to perform the sliding effect
//
function CMSlidingEffectInstance (menu, orient, speed)
{
	this.base = new CMSpecialEffectInstance (this, menu);

	menu.style.overflow = 'hidden';

	this.x = menu.offsetLeft;
	this.y = menu.offsetTop;

	if (orient.charAt (0) == 'h')
	{
		this.slideOrient = 'h';
		this.slideDir = orient.charAt (1);
	}
	else
	{
		this.slideOrient = 'v';
		this.slideDir = orient.charAt (2);
	}

	this.speed = speed;
	this.fullWidth = menu.offsetWidth;
	this.fullHeight = menu.offsetHeight;
	this.percent = 0;
	/*@cc_on
		@if (@_jscript_version >= 5.5)
			if (menu.cmFrameObj)
			{
				var frameObj = menu.cmFrameObj;
				this.frameX = frameObj.offsetLeft;
				this.frameY = frameObj.offsetTop;
				this.frameWidth = frameObj.offsetWidth;
				this.frameHeight = frameObj.offsetHeight;
			}
		@end
	@*/
}
	// public function to show the menu
CMSlidingEffectInstance.prototype.showEffect = function (changed)
{
	if (!this.base.canShow (changed))
		return;

	var percent = this.percent;
	if (this.slideOrient == 'h')
		this.slideMenuV ();
	else
		this.slideMenuH ();

	if (percent == 0)
	{
		this.base.startShowing ();
	}

	if (percent < 100)
	{
		this.percent += this.speed;
		cmTimeEffect (this.menu.id, this.show, 10);
	}
	else if (this.show)
	{
		this.base.finishShowing ();
	}
}

// public function to hide the menu
CMSlidingEffectInstance.prototype.hideEffect = function (changed)
{
	if (!this.base.canHide (changed))
		return;

	var percent = this.percent;
	if (this.slideOrient == 'h')
		this.slideMenuV ();
	else
		this.slideMenuH ();

	if (percent > 0)
	{
		this.percent -= this.speed;
		cmTimeEffect (this.menu.id, this.show, 10);
	}
	else if (!this.show)
	{
		this.menu.style.clip = 'auto';
		this.base.finishHiding ();
	}
}

// internal function to scroll a menu left/right
CMSlidingEffectInstance.prototype.slideMenuH = function ()
{
	var percent = this.percent;
	if (percent < 0)
		percent = 0;
	if (percent > 100)
		percent = 100;
	var fullWidth = this.fullWidth;
	var fullHeight = this.fullHeight;
	var x = this.x;
	var space = percent * fullWidth / 100;
	var menu = this.menu;

	if (this.slideDir == 'l')
	{
		menu.style.left = (x + fullWidth - space) + 'px';
		menu.style.clip = 'rect(0px ' + space + 'px ' + fullHeight + 'px 0px)';
	}
	else
	{
		menu.style.left = (x - fullWidth + space) + 'px';
		menu.style.clip = 'rect(0px ' + fullWidth + 'px ' + fullHeight + 'px ' + (fullWidth - space) + 'px)';
	}
	/*@cc_on
		@if (@_jscript_version >= 5.5)
			if (menu.cmFrameObj)
			{
				var frameObj = menu.cmFrameObj;
				if (this.slideDir == 'l')
					frameObj.style.left = (this.frameX + fullWidth - space) + 'px';
				frameObj.style.width = space + 'px';
			}
		@end
	@*/
}

// internal function to scroll a menu up/down
CMSlidingEffectInstance.prototype.slideMenuV = function ()
{
	var percent = this.percent;
	if (percent < 0)
		percent = 0;
	if (percent > 100)
		percent = 100;
	var fullWidth = this.fullWidth;
	var fullHeight = this.fullHeight;
	var y = this.y;
	var space = percent * fullHeight / 100;
	var menu = this.menu;

	if (this.slideDir == 'b')
	{
		menu.style.top = (y - fullHeight + space) + 'px';
		menu.style.clip = 'rect(' + (fullHeight - space) + 'px ' + fullWidth + 'px ' + fullHeight + 'px 0px)';
	}
	else
	{
		menu.style.top = (y + fullHeight - space) + 'px';
		menu.style.clip = 'rect(0px ' + fullWidth + 'px ' + space + 'px 0px)';
	}
	/*@cc_on
		@if (@_jscript_version >= 5.5)
			if (menu.cmFrameObj)
			{
				var frameObj = menu.cmFrameObj;
				if (this.slideDir == 'u')
					frameObj.style.top = (this.frameX - space) + 'px';
				frameObj.style.height = space + 'px';
			}
		@end
	@*/
}

//
// call
//		new CMSlidingEffect (speed)
// to create a new effect object.
//
function CMSlidingEffect (speed)
{
	if (!speed)
		speed = 10;
	else if (speed <= 0)
		speed = 10;
	else if (speed >= 100)
		speed = 100;
	this.speed = speed;
}

CMSlidingEffect.prototype.getInstance = function (menu, orient)
{
	return new CMSlidingEffectInstance (menu, orient, this.speed);
}

//
// this is the internal class to perform the sliding effect
//
function CMFadingEffectInstance (menu, showSpeed, hideSpeed)
{
	this.base = new CMSpecialEffectInstance (this, menu);

	menu.style.overflow = 'hidden';

	this.showSpeed = showSpeed;
	this.hideSpeed = hideSpeed;

	this.opacity = 0;
}

// public function to show the menu
CMFadingEffectInstance.prototype.showEffect = function (changed)
{
	if (!this.base.canShow (changed))
		return;

	var menu = this.menu;
	var opacity = this.opacity;

	this.setOpacity ();

	if (opacity == 0)
	{
		this.base.startShowing ();
	}

	if (opacity < 100)
	{
		this.opacity += 10;
		cmTimeEffect (menu.id, this.show, this.showSpeed);
	}
	else if (this.show)
	{
		this.base.finishShowing ();
	}
}

// public function to hide the menu
CMFadingEffectInstance.prototype.hideEffect = function (changed)
{
	if (!this.base.canHide (changed))
		return;

	var menu = this.menu;
	var opacity = this.opacity;

	this.setOpacity ();

	if (this.opacity > 0)
	{
		this.opacity -= 10;
		cmTimeEffect (menu.id, this.show, this.hideSpeed);
	}
	else if (!this.show)
	{
		this.base.finishHiding ();
	}
}

// internal functions
CMFadingEffectInstance.prototype.setOpacity = function ()
{
	this.menu.style.opacity = this.opacity / 100;
	/*@cc_on
		this.menu.style.filter = 'alpha(opacity=' + this.opacity + ')';
		//this.menu.style.filter = 'progid:DXImageTransform.Microsoft.Alpha(opacity=' + this.opacity + ')';
	@*/
}

function CMFadingEffect (showSpeed, hideSpeed)
{
	this.showSpeed = showSpeed;
	this.hideSpeed = hideSpeed;
}

CMFadingEffect.prototype.getInstance = function (menu, orient)
{
	return new CMFadingEffectInstance (menu, this.showSpeed, this.hideSpeed);
}




/**
 * Star Rating - jQuery plugin
 *
 * Copyright (c) 2007 Wil Stuckey
 * Modified by John Resig
 *
 * Dual licensed under the MIT and GPL licenses:
 *   http://www.opensource.org/licenses/mit-license.php
 *   http://www.gnu.org/licenses/gpl.html
 *
 */

/**
 * Create a degradeable star rating interface out of a simple form structure.
 * Returns a modified jQuery object containing the new interface.
 *   
 * @example jQuery('form.rating').rating();
 * @cat plugin
 * @type jQuery 
 *
 */
jQuery.fn.rating = function(){
    return this.each(function(){
        var div = jQuery("<div/>").attr({
            title: this.title,
            className: this.className
        }).insertAfter( this );

        jQuery(this).find("select option").each(function(){
            div.append( this.value == "0" ?
                "<div class='cancel'><a href='#0' title='Cancel Rating'>Cancel Rating</a></div>" :
                "<div class='star'><a href='#" + this.value + "' title='Give it a " + 
                    this.value + " Star Rating'>" + this.value + "</a></div>" );
        });

        var averageRating = this.title.split(/:\s*/)[1].split("."),
            url = this.action,
            averageIndex = averageRating[0],
            averagePercent = averageRating[1];

        // hover events and focus events added
        var stars = div.find("div.star")
            .mouseover(drainFill).focus(drainFill)
            .mouseout(drainReset).blur(drainReset)
            .click(click);

        // cancel button events
        div.find("div.cancel")
            .mouseover(drainAdd).focus(drainAdd)
            .mouseout(resetRemove).blur(resetRemove)
            .click(click);

        reset();

        function drainFill(){ drain(); fill(this); }
        function drainReset(){ drain(); reset(); }
        function resetRemove(){ reset(); jQuery(this).removeClass('on'); }
        function drainAdd(){ drain(); jQuery(this).addClass('on'); }

        function click(){
            averageIndex = stars.index(this) + 1;
            averagePercent = 0;

            if ( averageIndex == 0 )
                drain();

            jQuery.post(url,{
                rating: jQuery(this).find('a')[0].href.split('#')[1],
				hash:   hashRate
            });

            return false;
        }

        // fill to the current mouse position.
        function fill( elem ){
            stars.find("a").css("width", "100%");
            stars.lt( stars.index(elem) + 1 ).addClass("hover");
        }
    
        // drain all the stars.
        function drain(){
            stars.removeClass("on hover");
        }

        // Reset the stars to the default index.
        function reset(){
            stars.lt(averageIndex).addClass("on");

            var percent = averagePercent ? averagePercent * 10 : 0;
            if (percent > 0)
                stars.eq(averageIndex).addClass("on").children("a").css("width", percent + "%");
        }
    }).remove();
};

// fix ie6 background flicker problem.
if ( jQuery.browser.msie == true )
    document.execCommand('BackgroundImageCache', false, true);



/**
 * SWFUpload v2.0 by Jacob Roberts, Nov 2007, http://www.swfupload.org, http://linebyline.blogspot.com
 * -------- -------- -------- -------- -------- -------- -------- --------
 * SWFUpload is (c) 2006 Lars Huring and Mammon Media and is released under the MIT License:
 * http://www.opensource.org/licenses/mit-license.php
 *
 * See Changelog.txt for version history
 *
 * Development Notes:
 *  * This version of SWFUpload requires Flash Player 9.0.28 and should autodetect the correct flash version.
 *  * In Linux Flash Player 9 setting the post file variable name does not work. It is always set to "Filedata".
 *  * There is a lot of repeated code that could be refactored to single functions.  Feel free.
 *  * It's dangerous to do "circular calls" between Flash and JavaScript. I've taken steps to try to work around issues
 *     by having the event calls pipe through setTimeout.  However you should still avoid calling in to Flash from
 *     within the event handler methods.  Especially the "startUpload" event since it cannot use the setTimeout hack.
 */


/* *********** */
/* Constructor */
/* *********** */

var SWFUpload = function (init_settings) {
	this.initSWFUpload(init_settings);
};

SWFUpload.prototype.initSWFUpload = function (init_settings) {
	// Remove background flicker in IE (read this: http://misterpixel.blogspot.com/2006/09/forensic-analysis-of-ie6.html)
	// This doesn't have anything to do with SWFUpload but can help your UI behave better in IE.
	try {
		document.execCommand('BackgroundImageCache', false, true);
	} catch (ex1) {
	}


	try {
		this.customSettings = {};	// A container where developers can place their own settings associated with this instance.
		this.settings = {};
		this.eventQueue = [];
		this.movieName = "SWFUpload_" + SWFUpload.movieCount++;
		this.movieElement = null;

		// Setup global control tracking
		SWFUpload.instances[this.movieName] = this;

		// Load the settings.  Load the Flash movie.
		this.initSettings(init_settings);
		this.loadFlash();

		this.displayDebugInfo();

	} catch (ex2) {
		this.debug(ex2);
	}
}

/* *************** */
/* Static thingies */
/* *************** */
SWFUpload.instances = {};
SWFUpload.movieCount = 0;
SWFUpload.QUEUE_ERROR = {
	QUEUE_LIMIT_EXCEEDED	  		: -100,
	FILE_EXCEEDS_SIZE_LIMIT  		: -110,
	ZERO_BYTE_FILE			  		: -120,
	INVALID_FILETYPE		  		: -130
};
SWFUpload.UPLOAD_ERROR = {
	HTTP_ERROR				  		: -200,
	MISSING_UPLOAD_URL	      		: -210,
	IO_ERROR				  		: -220,
	SECURITY_ERROR			  		: -230,
	UPLOAD_LIMIT_EXCEEDED	  		: -240,
	UPLOAD_FAILED			  		: -250,
	SPECIFIED_FILE_ID_NOT_FOUND		: -260,
	FILE_VALIDATION_FAILED	  		: -270,
	FILE_CANCELLED			  		: -280,
	UPLOAD_STOPPED					: -290
};
SWFUpload.FILE_STATUS = {
	QUEUED		 : -1,
	IN_PROGRESS	 : -2,
	ERROR		 : -3,
	COMPLETE	 : -4,
	CANCELLED	 : -5
};


/* ***************** */
/* Instance Thingies */
/* ***************** */
// init is a private method that ensures that all the object settings are set, getting a default value if one was not assigned.

SWFUpload.prototype.initSettings = function (init_settings) {
	// Upload backend settings
	this.addSetting("upload_url",		 		init_settings.upload_url,		  		"");
	this.addSetting("file_post_name",	 		init_settings.file_post_name,	  		"Filedata");
	this.addSetting("post_params",		 		init_settings.post_params,		  		{});

	// File Settings
	this.addSetting("file_types",			  	init_settings.file_types,				"*.*");
	this.addSetting("file_types_description", 	init_settings.file_types_description, 	"All Files");
	this.addSetting("file_size_limit",		  	init_settings.file_size_limit,			"1024");
	this.addSetting("file_upload_limit",	  	init_settings.file_upload_limit,		"0");
	this.addSetting("file_queue_limit",		  	init_settings.file_queue_limit,			"0");

	// Flash Settings
	this.addSetting("flash_url",		  		init_settings.flash_url,				"swfupload.swf");
	this.addSetting("flash_width",		  		init_settings.flash_width,				"1px");
	this.addSetting("flash_height",		  		init_settings.flash_height,				"1px");
	this.addSetting("flash_color",		  		init_settings.flash_color,				"#FFFFFF");

	// Debug Settings
	this.addSetting("debug_enabled", init_settings.debug,  false);

	// Event Handlers
	this.flashReady_handler         = SWFUpload.flashReady;	// This is a non-overrideable event handler
	this.swfUploadLoaded_handler    = this.retrieveSetting(init_settings.swfupload_loaded_handler,	    SWFUpload.swfUploadLoaded);
	
	this.fileDialogStart_handler	= this.retrieveSetting(init_settings.file_dialog_start_handler,		SWFUpload.fileDialogStart);
	this.fileQueued_handler			= this.retrieveSetting(init_settings.file_queued_handler,			SWFUpload.fileQueued);
	this.fileQueueError_handler		= this.retrieveSetting(init_settings.file_queue_error_handler,		SWFUpload.fileQueueError);
	this.fileDialogComplete_handler	= this.retrieveSetting(init_settings.file_dialog_complete_handler,	SWFUpload.fileDialogComplete);
	
	this.uploadStart_handler		= this.retrieveSetting(init_settings.upload_start_handler,			SWFUpload.uploadStart);
	this.uploadProgress_handler		= this.retrieveSetting(init_settings.upload_progress_handler,		SWFUpload.uploadProgress);
	this.uploadError_handler		= this.retrieveSetting(init_settings.upload_error_handler,			SWFUpload.uploadError);
	this.uploadSuccess_handler		= this.retrieveSetting(init_settings.upload_success_handler,		SWFUpload.uploadSuccess);
	this.uploadComplete_handler		= this.retrieveSetting(init_settings.upload_complete_handler,		SWFUpload.uploadComplete);

	this.debug_handler				= this.retrieveSetting(init_settings.debug_handler,			   		SWFUpload.debug);

	// Other settings
	this.customSettings = this.retrieveSetting(init_settings.custom_settings, {});
};

// loadFlash is a private method that generates the HTML tag for the Flash
// It then adds the flash to the "target" or to the body and stores a
// reference to the flash element in "movieElement".
SWFUpload.prototype.loadFlash = function () {
	var html, target_element, container;

	// Make sure an element with the ID we are going to use doesn't already exist
	if (document.getElementById(this.movieName) !== null) {
		return false;
	}

	// Get the body tag where we will be adding the flash movie
	try {
		target_element = document.getElementsByTagName("body")[0];
		if (typeof(target_element) === "undefined" || target_element === null) {
			this.debug('Could not find the BODY element. SWFUpload failed to load.');
			return false;
		}
	} catch (ex) {
		return false;
	}

	// Append the container and load the flash
	container = document.createElement("div");
	container.style.width = this.getSetting("flash_width");
	container.style.height = this.getSetting("flash_height");

	target_element.appendChild(container);
	container.innerHTML = this.getFlashHTML();	// Using innerHTML is non-standard but the only sensible way to dynamically add Flash in IE (and maybe other browsers)
};

// Generates the embed/object tags needed to embed the flash in to the document
SWFUpload.prototype.getFlashHTML = function () {
	var html = "";

	// Create Mozilla Embed HTML
	if (navigator.plugins && navigator.mimeTypes && navigator.mimeTypes.length) {
		// Build the basic embed html
		html = '<embed type="application/x-shockwave-flash" src="' + this.getSetting("flash_url") + '" width="' + this.getSetting("flash_width") + '" height="' + this.getSetting("flash_height") + '"';
		html += ' id="' + this.movieName + '" name="' + this.movieName + '" ';
		html += 'bgcolor="' + this.getSetting("flash_color") + '" quality="high" menu="false" flashvars="';

		html += this.getFlashVars();

		html += '" />';

		// Create IE Object HTML
	} else {

		// Build the basic Object tag
		html = '<object id="' + this.movieName + '" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="' + this.getSetting("flash_width") + '" height="' + this.getSetting("flash_height") + '">';
		html += '<param name="movie" value="' + this.getSetting("flash_url") + '">';

		html += '<param name="bgcolor" value="' + this.getSetting("flash_color") + '" />';
		html += '<param name="quality" value="high" />';
		html += '<param name="menu" value="false" />';

		html += '<param name="flashvars" value="' + this.getFlashVars() + '" />';
		html += '</object>';
	}

	return html;
};

// This private method builds the parameter string that will be passed
// to flash.
SWFUpload.prototype.getFlashVars = function () {
	// Build a string from the post param object
	var param_string = this.buildParamString();

	// Build the parameter string
	var html = "";
	html += "movieName=" + encodeURIComponent(this.movieName);
	html += "&uploadURL=" + encodeURIComponent(this.getSetting("upload_url"));
	html += "&params=" + encodeURIComponent(param_string);
	html += "&filePostName=" + encodeURIComponent(this.getSetting("file_post_name"));
	html += "&fileTypes=" + encodeURIComponent(this.getSetting("file_types"));
	html += "&fileTypesDescription=" + encodeURIComponent(this.getSetting("file_types_description"));
	html += "&fileSizeLimit=" + encodeURIComponent(this.getSetting("file_size_limit"));
	html += "&fileUploadLimit=" + encodeURIComponent(this.getSetting("file_upload_limit"));
	html += "&fileQueueLimit=" + encodeURIComponent(this.getSetting("file_queue_limit"));
	html += "&debugEnabled=" + encodeURIComponent(this.getSetting("debug_enabled"));

	return html;
};

SWFUpload.prototype.getMovieElement = function () {
	if (typeof(this.movieElement) === "undefined" || this.movieElement === null) {
		this.movieElement = document.getElementById(this.movieName);

		// Fix IEs "Flash can't callback when in a form" issue (http://www.extremefx.com.ar/blog/fixing-flash-external-interface-inside-form-on-internet-explorer)
		// Removed because Revision 6 always adds the flash to the body (inside a containing div)
		// If you insist on adding the Flash file inside a Form then in IE you have to make you wait until the DOM is ready
		// and run this code to make the form's ID available from the window object so Flash and JavaScript can communicate.
		//if (typeof(window[this.movieName]) === "undefined" || window[this.moveName] !== this.movieElement) {
		//	window[this.movieName] = this.movieElement;
		//}
	}

	return this.movieElement;
};

SWFUpload.prototype.buildParamString = function () {
	var post_params = this.getSetting("post_params");
	var param_string_pairs = [];
	var i, value, name;

	// Retrieve the user defined parameters
	if (typeof(post_params) === "object") {
		for (name in post_params) {
			if (post_params.hasOwnProperty(name)) {
				if (typeof(post_params[name]) === "string") {
					param_string_pairs.push(encodeURIComponent(name) + "=" + encodeURIComponent(post_params[name]));
				}
			}
		}
	}

	return param_string_pairs.join("&");
};

// Saves a setting.	 If the value given is undefined or null then the default_value is used.
SWFUpload.prototype.addSetting = function (name, value, default_value) {
	if (typeof(value) === "undefined" || value === null) {
		this.settings[name] = default_value;
	} else {
		this.settings[name] = value;
	}

	return this.settings[name];
};

// Gets a setting.	Returns empty string if not found.
SWFUpload.prototype.getSetting = function (name) {
	if (typeof(this.settings[name]) === "undefined") {
		return "";
	} else {
		return this.settings[name];
	}
};

// Gets a setting, if the setting is undefined then return the default value
// This does not affect or use the interal setting object.
SWFUpload.prototype.retrieveSetting = function (value, default_value) {
	if (typeof(value) === "undefined" || value === null) {
		return default_value;
	} else {
		return value;
	}
};


// It loops through all the settings and displays
// them in the debug Console.
SWFUpload.prototype.displayDebugInfo = function () {
	var key, debug_message = "";

	debug_message += "----- SWFUPLOAD SETTINGS     ----\nID: " + this.moveName + "\n";

	debug_message += this.outputObject(this.settings);

	debug_message += "----- SWFUPLOAD SETTINGS END ----\n";
	debug_message += "\n";

	this.debug(debug_message);
};
SWFUpload.prototype.outputObject = function (object, prefix) {
	var output = "", key;

	if (typeof(prefix) !== "string") {
		prefix = "";
	}
	if (typeof(object) !== "object") {
		return "";
	}

	for (key in object) {
		if (object.hasOwnProperty(key)) {
			if (typeof(object[key]) === "object") {
				output += (prefix + key + ": { \n" + this.outputObject(object[key], "\t" + prefix) + prefix + "}" + "\n");
			} else {
				output += (prefix + key + ": " + object[key] + "\n");
			}
		}
	}

	return output;
};

/* *****************************
	-- Flash control methods --
	Your UI should use these
	to operate SWFUpload
   ***************************** */

SWFUpload.prototype.selectFile = function () {
	var movie_element = this.getMovieElement();
	if (movie_element !== null && typeof(movie_element.SelectFile) === "function") {
		try {
			movie_element.SelectFile();
		}
		catch (ex) {
			this.debug("Could not call SelectFile: " + ex);
		}
	} else {
		this.debug("Could not find Flash element");
	}

};

SWFUpload.prototype.selectFiles = function () {
	var movie_element = this.getMovieElement();
	if (movie_element !== null && typeof(movie_element.SelectFiles) === "function") {
		try {
			movie_element.SelectFiles();
		}
		catch (ex) {
			this.debug("Could not call SelectFiles: " + ex);
		}
	} else {
		this.debug("Could not find Flash element");
	}

};


/* Start the upload.  If a file_id is specified that file is uploaded. Otherwise the first
 * file in the queue is uploaded.  If no files are in the queue then nothing happens.
 * This call uses setTimeout since Flash will be calling back in to JavaScript
 */
SWFUpload.prototype.startUpload = function (file_id) {
	var self = this;
	var movie_element = this.getMovieElement();
	if (movie_element !== null && typeof(movie_element.StartUpload) === "function") {
		setTimeout(
			function () {
				try {
					movie_element.StartUpload(file_id);
				}
				catch (ex) {
					self.debug("Could not call StartUpload: " + ex);
				}
			}, 0
		);
	} else {
		this.debug("Could not find Flash element");
	}

};

/* Cancels a the file upload.  You must specify a file_id */
SWFUpload.prototype.cancelUpload = function (file_id) {
	var movie_element = this.getMovieElement();
	if (movie_element !== null && typeof(movie_element.CancelUpload) === "function") {
		try {
			movie_element.CancelUpload(file_id);
		}
		catch (ex) {
			this.debug("Could not call CancelUpload: " + ex);
		}
	} else {
		this.debug("Could not find Flash element");
	}

};

// Stops the current upload.  The file is re-queued.  If nothing is currently uploading then nothing happens.
SWFUpload.prototype.stopUpload = function () {
	var movie_element = this.getMovieElement();
	if (movie_element !== null && typeof(movie_element.StopUpload) === "function") {
		try {
			movie_element.StopUpload();
		}
		catch (ex) {
			this.debug("Could not call StopUpload: " + ex);
		}
	} else {
		this.debug("Could not find Flash element");
	}

};

/* ************************
 * Settings methods
 *   These methods change the settings inside SWFUpload
 *   They shouldn't need to be called in a setTimeout since they
 *   should not call back from Flash to JavaScript (except perhaps in a Debug call)
 *   and some need to return data so setTimeout won't work.
 */

/* Gets the file statistics object.	 It looks like this (where n = number):
	{
		files_queued: n,
		complete_uploads: n,
		upload_errors: n,
		uploads_cancelled: n,
		queue_errors: n
	}
*/
SWFUpload.prototype.getStats = function () {
	var self = this;
	var movie_element = this.getMovieElement();
	if (movie_element !== null && typeof(movie_element.GetStats) === "function") {
		try {
			return movie_element.GetStats();
		}
		catch (ex) {
			self.debug("Could not call GetStats");
		}
	} else {
		this.debug("Could not find Flash element");
	}
};
SWFUpload.prototype.setStats = function (stats_object) {
	var self = this;
	var movie_element = this.getMovieElement();
	if (movie_element !== null && typeof(movie_element.SetStats) === "function") {
		try {
			movie_element.SetStats(stats_object);
		}
		catch (ex) {
			self.debug("Could not call SetStats");
		}
	} else {
		this.debug("Could not find Flash element");
	}
};
SWFUpload.prototype.getFile = function (file_id) {
	var self = this;
	var movie_element = this.getMovieElement();
			if (typeof(file_id) === "number") {
				if (movie_element !== null && typeof(movie_element.GetFileByIndex) === "function") {
					try {
						return movie_element.GetFileByIndex(file_id);
					}
					catch (ex) {
						self.debug("Could not call GetFileByIndex");
					}
				} else {
					this.debug("Could not find Flash element");
				}
			} else {
				if (movie_element !== null && typeof(movie_element.GetFile) === "function") {
					try {
						return movie_element.GetFile(file_id);
					}
					catch (ex) {
						self.debug("Could not call GetFile");
					}
				} else {
					this.debug("Could not find Flash element");
				}
			}
};

SWFUpload.prototype.addFileParam = function (file_id, name, value) {
	var self = this;
	var movie_element = this.getMovieElement();
	if (movie_element !== null && typeof(movie_element.AddFileParam) === "function") {
		try {
			return movie_element.AddFileParam(file_id, name, value);
		}
		catch (ex) {
			self.debug("Could not call AddFileParam");
		}
	} else {
		this.debug("Could not find Flash element");
	}
};

SWFUpload.prototype.removeFileParam = function (file_id, name) {
	var self = this;
	var movie_element = this.getMovieElement();
	if (movie_element !== null && typeof(movie_element.RemoveFileParam) === "function") {
		try {
			return movie_element.RemoveFileParam(file_id, name);
		}
		catch (ex) {
			self.debug("Could not call AddFileParam");
		}
	} else {
		this.debug("Could not find Flash element");
	}

};

SWFUpload.prototype.setUploadURL = function (url) {
	var movie_element = this.getMovieElement();
	if (movie_element !== null && typeof(movie_element.SetUploadURL) === "function") {
		try {
			this.addSetting("upload_url", url);
			movie_element.SetUploadURL(this.getSetting("upload_url"));
		}
		catch (ex) {
			this.debug("Could not call SetUploadURL");
		}
	} else {
		this.debug("Could not find Flash element in setUploadURL");
	}
};

SWFUpload.prototype.setPostParams = function (param_object) {
	var movie_element = this.getMovieElement();
	if (movie_element !== null && typeof(movie_element.SetPostParams) === "function") {
		try {
			this.addSetting("post_params", param_object);
			movie_element.SetPostParams(this.getSetting("post_params"));
		}
		catch (ex) {
			this.debug("Could not call SetPostParams");
		}
	} else {
		this.debug("Could not find Flash element in SetPostParams");
	}
};

SWFUpload.prototype.setFileTypes = function (types, description) {
	var movie_element = this.getMovieElement();
	if (movie_element !== null && typeof(movie_element.SetFileTypes) === "function") {
		try {
			this.addSetting("file_types", types);
			this.addSetting("file_types_description", description);
			movie_element.SetFileTypes(this.getSetting("file_types"), this.getSetting("file_types_description"));
		}
		catch (ex) {
			this.debug("Could not call SetFileTypes");
		}
	} else {
		this.debug("Could not find Flash element in SetFileTypes");
	}
};

SWFUpload.prototype.setFileSizeLimit = function (file_size_limit) {
	var movie_element = this.getMovieElement();
	if (movie_element !== null && typeof(movie_element.SetFileSizeLimit) === "function") {
		try {
			this.addSetting("file_size_limit", file_size_limit);
			movie_element.SetFileSizeLimit(this.getSetting("file_size_limit"));
		}
		catch (ex) {
			this.debug("Could not call SetFileSizeLimit");
		}
	} else {
		this.debug("Could not find Flash element in SetFileSizeLimit");
	}
};

SWFUpload.prototype.setFileUploadLimit = function (file_upload_limit) {
	var movie_element = this.getMovieElement();
	if (movie_element !== null && typeof(movie_element.SetFileUploadLimit) === "function") {
		try {
			this.addSetting("file_upload_limit", file_upload_limit);
			movie_element.SetFileUploadLimit(this.getSetting("file_upload_limit"));
		}
		catch (ex) {
			this.debug("Could not call SetFileUploadLimit");
		}
	} else {
		this.debug("Could not find Flash element in SetFileUploadLimit");
	}
};

SWFUpload.prototype.setFileQueueLimit = function (file_queue_limit) {
	var movie_element = this.getMovieElement();
	if (movie_element !== null && typeof(movie_element.SetFileQueueLimit) === "function") {
		try {
			this.addSetting("file_queue_limit", file_queue_limit);
			movie_element.SetFileQueueLimit(this.getSetting("file_queue_limit"));
		}
		catch (ex) {
			this.debug("Could not call SetFileQueueLimit");
		}
	} else {
		this.debug("Could not find Flash element in SetFileQueueLimit");
	}
};

SWFUpload.prototype.setFilePostName = function (file_post_name) {
	var movie_element = this.getMovieElement();
	if (movie_element !== null && typeof(movie_element.SetFilePostName) === "function") {
		try {
			this.addSetting("file_post_name", file_post_name);
			movie_element.SetFilePostName(this.getSetting("file_post_name"));
		}
		catch (ex) {
			this.debug("Could not call SetFilePostName");
		}
	} else {
		this.debug("Could not find Flash element in SetFilePostName");
	}
};

SWFUpload.prototype.setDebugEnabled = function (debug_enabled) {
	var movie_element = this.getMovieElement();
	if (movie_element !== null && typeof(movie_element.SetDebugEnabled) === "function") {
		try {
			this.addSetting("debug_enabled", debug_enabled);
			movie_element.SetDebugEnabled(this.getSetting("debug_enabled"));
		}
		catch (ex) {
			this.debug("Could not call SetDebugEnabled");
		}
	} else {
		this.debug("Could not find Flash element in SetDebugEnabled");
	}
};

/* *******************************
	Internal Event Callers
	Don't override these! These event callers ensure that your custom event handlers
	are called safely and in order.
******************************* */

/* This is the callback method that the Flash movie will call when it has been loaded and is ready to go.
   Calling this or showUI() "manually" will bypass the Flash Detection built in to SWFUpload.
   Use a ui_function setting if you want to control the UI loading after the flash has loaded.
*/
SWFUpload.prototype.flashReady = function () {
	var self = this;
	if (typeof(self.fileDialogStart_handler) === "function") {
		this.eventQueue[this.eventQueue.length] = function() { self.flashReady_handler(); };
		setTimeout(function () { self.executeNextEvent();}, 0);
	} else {
		this.debug("fileDialogStart event not defined");
	}
};

/*
	Event Queue.  Rather can call events directly from Flash they events are
	are placed in a queue and then executed.  This ensures that each event is
	executed in the order it was called which is not guarenteed when calling
	setTimeout.  Out of order events was especially problematic in Safari.
*/
SWFUpload.prototype.executeNextEvent = function () {
	var  f = this.eventQueue.shift();
	if (typeof(f) === "function") {
		f();
	}
}

/* This is a chance to do something before the browse window opens */
SWFUpload.prototype.fileDialogStart = function () {
	var self = this;
	if (typeof(self.fileDialogStart_handler) === "function") {
		this.eventQueue[this.eventQueue.length] = function() { self.fileDialogStart_handler(); };
		setTimeout(function () { self.executeNextEvent();}, 0);
	} else {
		this.debug("fileDialogStart event not defined");
	}
};


/* Called when a file is successfully added to the queue. */
SWFUpload.prototype.fileQueued = function (file) {
	var self = this;
	if (typeof(self.fileQueued_handler) === "function") {
		this.eventQueue[this.eventQueue.length] = function() { self.fileQueued_handler(file); };
		setTimeout(function () { self.executeNextEvent();}, 0);
	} else {
		this.debug("fileQueued event not defined");
	}
};


/* Handle errors that occur when an attempt to queue a file fails. */
SWFUpload.prototype.fileQueueError = function (file, error_code, message) {
	var self = this;
	if (typeof(self.fileQueueError_handler) === "function") {
		this.eventQueue[this.eventQueue.length] = function() {  self.fileQueueError_handler(file, error_code, message); };
		setTimeout(function () { self.executeNextEvent();}, 0);
	} else {
		this.debug("fileQueueError event not defined");
	}
};

/* Called after the file dialog has closed and the selected files have been queued.
	You could call startUpload here if you want the queued files to begin uploading immediately. */
SWFUpload.prototype.fileDialogComplete = function (num_files_selected) {
	var self = this;
	if (typeof(self.fileDialogComplete_handler) === "function") {
		this.eventQueue[this.eventQueue.length] = function() { self.fileDialogComplete_handler(num_files_selected); };
		setTimeout(function () { self.executeNextEvent();}, 0);
	} else {
		this.debug("fileDialogComplete event not defined");
	}
};

/* Gets called when a file upload is about to be started.  Return true to continue the upload. Return false to stop the upload.
	If you return false then uploadError and uploadComplete are called (like normal).
	
	This is a good place to do any file validation you need.
	*/
SWFUpload.prototype.uploadStart = function (file) {
	var self = this;
	if (typeof(self.fileDialogComplete_handler) === "function") {
		this.eventQueue[this.eventQueue.length] = function() { self.returnUploadStart(self.uploadStart_handler(file)); };
		setTimeout(function () { self.executeNextEvent();}, 0);
	} else {
		this.debug("uploadStart event not defined");
	}
};

/* Note: Internal use only.  This function returns the result of uploadStart to
	flash.  Since returning values in the normal way can result in Flash/JS circular
	call issues we split up the call in a Timeout.  This is transparent from the API
	point of view.
*/
SWFUpload.prototype.returnUploadStart = function (return_value) {
	var movie_element = this.getMovieElement();
	if (movie_element !== null && typeof(movie_element.ReturnUploadStart) === "function") {
		try {
			movie_element.ReturnUploadStart(return_value);
		}
		catch (ex) {
			this.debug("Could not call ReturnUploadStart");
		}
	} else {
		this.debug("Could not find Flash element in returnUploadStart");
	}
};



/* Called during upload as the file progresses. Use this event to update your UI. */
SWFUpload.prototype.uploadProgress = function (file, bytes_complete, bytes_total) {
	var self = this;
	if (typeof(self.uploadProgress_handler) === "function") {
		this.eventQueue[this.eventQueue.length] = function() { self.uploadProgress_handler(file, bytes_complete, bytes_total); };
		setTimeout(function () { self.executeNextEvent();}, 0);
	} else {
		this.debug("uploadProgress event not defined");
	}
};

/* Called when an error occurs during an upload. Use error_code and the SWFUpload.UPLOAD_ERROR constants to determine
   which error occurred. The uploadComplete event is called after an error code indicating that the next file is
   ready for upload.  For files cancelled out of order the uploadComplete event will not be called. */
SWFUpload.prototype.uploadError = function (file, error_code, message) {
	var self = this;
	if (typeof(this.uploadError_handler) === "function") {
		this.eventQueue[this.eventQueue.length] = function() { self.uploadError_handler(file, error_code, message); };
		setTimeout(function () { self.executeNextEvent();}, 0);
	} else {
		this.debug("uploadError event not defined");
	}
};

/* This gets called when a file finishes uploading and the server-side upload script has completed and returned a 200
status code. Any text returned by the server is available in server_data.
**NOTE: The upload script MUST return some text or the uploadSuccess and uploadComplete events will not fire and the
upload will become 'stuck'. */
SWFUpload.prototype.uploadSuccess = function (file, server_data) {
	var self = this;
	if (typeof(self.uploadSuccess_handler) === "function") {
		this.eventQueue[this.eventQueue.length] = function() { self.uploadSuccess_handler(file, server_data); };
		setTimeout(function () { self.executeNextEvent();}, 0);
	} else {
		this.debug("uploadSuccess event not defined");
	}
};

/* uploadComplete is called when the file is uploaded or an error occurred and SWFUpload is ready to make the next upload.
   If you want the next upload to start to automatically you can call startUpload() from this event. */
SWFUpload.prototype.uploadComplete = function (file) {
	var self = this;
	if (typeof(self.uploadComplete_handler) === "function") {
		this.eventQueue[this.eventQueue.length] = function() { self.uploadComplete_handler(file); };
		setTimeout(function () { self.executeNextEvent();}, 0);
	} else {
		this.debug("uploadComplete event not defined");
	}
};

/* Called by SWFUpload JavaScript and Flash functions when debug is enabled. By default it writes messages to the
   internal debug console.  You can override this event and have messages written where you want. */
SWFUpload.prototype.debug = function (message) {
	var self = this;
	if (typeof(self.debug_handler) === "function") {
		this.eventQueue[this.eventQueue.length] = function() { self.debug_handler(message); };
		setTimeout(function () { self.executeNextEvent();}, 0);
	} else {
		this.eventQueue[this.eventQueue.length] = function() { self.debugMessage(message); };
		setTimeout(function () { self.executeNextEvent();}, 0);
	}
};


/* **********************************
	Default Event Handlers.
	These event handlers are used by default if an overriding handler is
	not defined in the SWFUpload settings object.
	
	JS Note: even though these are defined on the SWFUpload object (rather than the prototype) they
	are attached (read: copied) to a SWFUpload instance and 'this' is given the proper context.
   ********************************** */

/* This is a special event handler that has no override in the settings.  Flash calls this when it has
   been loaded by the browser and is ready for interaction.  You should not override it.  If you need
   to do something with SWFUpload has loaded then use the swfupload_loaded_handler setting.
*/
SWFUpload.flashReady = function () {
	try {
		this.debug("Flash called back and is ready.");

		if (typeof(this.swfUploadLoaded_handler) === "function") {
			this.swfUploadLoaded_handler();
		}
	} catch (ex) {
		this.debug(ex);
	}
};

/* This is a chance to something immediately after SWFUpload has loaded.
   Like, hide the default/degraded upload form and display the SWFUpload form. */
SWFUpload.swfUploadLoaded = function () {
};

/* This is a chance to do something before the browse window opens */
SWFUpload.fileDialogStart = function () {
};


/* Called when a file is successfully added to the queue. */
SWFUpload.fileQueued = function (file) {
};


/* Handle errors that occur when an attempt to queue a file fails. */
SWFUpload.fileQueueError = function (file, error_code, message) {
	try {
		switch (error_code) {
		case SWFUpload.QUEUE_ERROR.FILE_EXCEEDS_SIZE_LIMIT:
			this.debug("Error Code: File too big, File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
			break;
		case SWFUpload.QUEUE_ERROR.ZERO_BYTE_FILE:
			this.debug("Error Code: Zero Byte File, File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
			break;
		case SWFUpload.QUEUE_ERROR.QUEUE_LIMIT_EXCEEDED:
			this.debug("Error Code: Upload limit reached, File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
			break;
		case SWFUpload.QUEUE_ERROR.INVALID_FILETYPE:
			this.debug("Error Code: File extension is not allowed, Message: " + message);
			break;
		default:
			this.debug("Error Code: Unhandled error occured. Errorcode: " + error_code);
		}
	} catch (ex) {
		this.debug(ex);
	}
};

/* Called after the file dialog has closed and the selected files have been queued.
	You could call startUpload here if you want the queued files to begin uploading immediately. */
SWFUpload.fileDialogComplete = function (num_files_selected) {
};

/* Gets called when a file upload is about to be started.  Return true to continue the upload. Return false to stop the upload.
	If you return false then the uploadError callback is called and then uploadComplete (like normal).
	
	This is a good place to do any file validation you need.
	
	This is the only function that cannot be called on a setTimeout because it must return a value to Flash.
	You SHOULD NOT make any calls in to Flash (e.i, changing settings, getting stats, etc).  Flash Player bugs prevent
	calls in to Flash from working reliably.
*/
SWFUpload.uploadStart = function (file) {
	return true;
};

// Called during upload as the file progresses
SWFUpload.uploadProgress = function (file, bytes_complete, bytes_total) {
	this.debug("File Progress: " + file.id + ", Bytes: " + bytes_complete + ". Total: " + bytes_total);
};

/* This gets called when a file finishes uploading and the upload script has completed and returned a 200 status code.	Any text returned by the
server is available in server_data.	 The upload script must return some text or uploadSuccess will not fire (neither will uploadComplete). */
SWFUpload.uploadSuccess = function (file, server_data) {
};

/* This is called last.	 The file is uploaded or an error occurred and SWFUpload is ready to make the next upload.
	If you want to automatically start the next file just call startUpload from here.
*/
SWFUpload.uploadComplete = function (file) {
};

// Called by SWFUpload JavaScript and Flash functions when debug is enabled.
// Override this method in your settings to call your own debug message handler
SWFUpload.debug = function (message) {
	if (this.getSetting("debug_enabled")) {
		this.debugMessage(message);
	}
};

/* Called when an upload occurs during upload.  For HTTP errors 'message' will contain the HTTP STATUS CODE */
SWFUpload.uploadError = function (file, error_code, message) {
	try {
		switch (errcode) {
		case SWFUpload.UPLOAD_ERROR.SPECIFIED_FILE_ID_NOT_FOUND:
			this.debug("Error Code: File ID specified for upload was not found, Message: " + msg);
			break;
		case SWFUpload.UPLOAD_ERROR.HTTP_ERROR:
			this.debug("Error Code: HTTP Error, File name: " + file.name + ", Message: " + msg);
			break;
		case SWFUpload.UPLOAD_ERROR.MISSING_UPLOAD_URL:
			this.debug("Error Code: No backend file, File name: " + file.name + ", Message: " + msg);
			break;
		case SWFUpload.UPLOAD_ERROR.IO_ERROR:
			this.debug("Error Code: IO Error, File name: " + file.name + ", Message: " + msg);
			break;
		case SWFUpload.UPLOAD_ERROR.SECURITY_ERROR:
			this.debug("Error Code: Security Error, File name: " + file.name + ", Message: " + msg);
			break;
		case SWFUpload.UPLOAD_ERROR.UPLOAD_LIMIT_EXCEEDED:
			this.debug("Error Code: Upload limit reached, File name: " + file.name + ", File size: " + file.size + ", Message: " + msg);
			break;
		case SWFUpload.UPLOAD_ERROR.UPLOAD_FAILED:
			this.debug("Error Code: Upload Initialization exception, File name: " + file.name + ", File size: " + file.size + ", Message: " + msg);
			break;
		case SWFUpload.UPLOAD_ERROR.FILE_VALIDATION_FAILED:
			this.debug("Error Code: uploadStart callback returned false, File name: " + file.name + ", File size: " + file.size + ", Message: " + msg);
			break;
		case SWFUpload.UPLOAD_ERROR.FILE_CANCELLED:
			this.debug("Error Code: The file upload was cancelled, File name: " + file.name + ", File size: " + file.size + ", Message: " + msg);
			break;
		case SWFUpload.UPLOAD_ERROR.UPLOAD_STOPPED:
			this.debug("Error Code: The file upload was stopped, File name: " + file.name + ", File size: " + file.size + ", Message: " + msg);
			break;
		default:
			this.debug("Error Code: Unhandled error occured. Errorcode: " + errcode);
		}
	} catch (ex) {
		this.debug(ex);
	}
};



/* **********************************
	Debug Console
	The debug console is a self contained, in page location
	for debug message to be sent.  The Debug Console adds
	itself to the body if necessary.

	The console is automatically scrolled as messages appear.
	
	You can override this console (to use FireBug's console for instance) by setting the debug event method to your own function
	that handles the debug message
   ********************************** */
SWFUpload.prototype.debugMessage = function (message) {
	var exception_message, exception_values;

	if (typeof(message) === "object" && typeof(message.name) === "string" && typeof(message.message) === "string") {
		exception_message = "";
		exception_values = [];
		for (var key in message) {
			exception_values.push(key + ": " + message[key]);
		}
		exception_message = exception_values.join("\n");
		exception_values = exception_message.split("\n");
		exception_message = "EXCEPTION: " + exception_values.join("\nEXCEPTION: ");
		SWFUpload.Console.writeLine(exception_message);
	} else {
		SWFUpload.Console.writeLine(message);
	}
};

SWFUpload.Console = {};
SWFUpload.Console.writeLine = function (message) {
	var console, documentForm;

	try {
		console = document.getElementById("SWFUpload_Console");

		if (!console) {
			documentForm = document.createElement("form");
			document.getElementsByTagName("body")[0].appendChild(documentForm);

			console = document.createElement("textarea");
			console.id = "SWFUpload_Console";
			console.style.fontFamily = "monospace";
			console.setAttribute("wrap", "off");
			console.wrap = "off";
			console.style.overflow = "auto";
			console.style.width = "700px";
			console.style.height = "350px";
			console.style.margin = "5px";
			documentForm.appendChild(console);
		}

		console.value += message + "\n";

		console.scrollTop = console.scrollHeight - console.clientHeight;
	} catch (ex) {
		alert("Exception: " + ex.name + " Message: " + ex.message);
	}
};




// directory of where all the images are
var cmThemeOfficeBase = '/JSCookMenu/ThemeOffice/';

// the follow block allows user to re-define theme base directory
// before it is loaded.
try
{
	if (myThemeOfficeBase)
	{
		cmThemeOfficeBase = myThemeOfficeBase;
	}
}
catch (e)
{
}

var cmThemeOffice =
{
	prefix:	'ThemeOffice',
  	// main menu display attributes
  	//
  	// Note.  When the menu bar is horizontal,
  	// mainFolderLeft and mainFolderRight are
  	// put in <span></span>.  When the menu
  	// bar is vertical, they would be put in
  	// a separate TD cell.

  	// HTML code to the left of the folder item
  	mainFolderLeft: '&nbsp;',
  	// HTML code to the right of the folder item
  	mainFolderRight: '&nbsp;',
	// HTML code to the left of the regular item
	mainItemLeft: '&nbsp;',
	// HTML code to the right of the regular item
	mainItemRight: '&nbsp;',

	// sub menu display attributes

	// HTML code to the left of the folder item
	folderLeft: '<img alt="" src="' + cmThemeOfficeBase + 'spacer.gif">',
	// HTML code to the right of the folder item
	folderRight: '<img alt="" src="' + cmThemeOfficeBase + 'arrow.gif">',
	// HTML code to the left of the regular item
	itemLeft: '<img alt="" src="' + cmThemeOfficeBase + 'spacer.gif">',
	// HTML code to the right of the regular item
	itemRight: '<img alt="" src="' + cmThemeOfficeBase + 'blank.gif">',
	// cell spacing for main menu
	mainSpacing: 0,
	// cell spacing for sub menus
	subSpacing: 0,

	subMenuHeader: '<div class="ThemeOfficeSubMenuShadow"></div>',

	offsetHMainAdjust:	[-1, 0],
	offsetSubAdjust:	[-1, -1]

	// rest use default settings
};

// for horizontal menu split
var cmThemeOfficeHSplit = [_cmNoClick, '<td class="ThemeOfficeMenuItemLeft"></td><td colspan="2" class="ThemeOfficeMenuSplit"><div class="ThemeOfficeMenuSplit"></div></td>'];
var cmThemeOfficeMainHSplit = [_cmNoClick, '<td class="ThemeOfficeMainItemLeft"></td><td colspan="2" class="ThemeOfficeMenuSplit"><div class="ThemeOfficeMenuSplit"></div></td>'];
var cmThemeOfficeMainVSplit = [_cmNoClick, '|'];

/* IE can't do negative margin on tables */
/*@cc_on
	cmThemeOffice.subMenuHeader = '<div class="ThemeOfficeSubMenuShadow" style="background-color: #cccccc; filter: alpha(opacity=35);"></div>';
@*/



/*
 * Thickbox 2.1 - One Box To Rule Them All.
 * By Cody Lindley (http://www.codylindley.com)
 * Copyright (c) 2006 cody lindley
 * Licensed under the MIT License:
 *   http://www.opensource.org/licenses/mit-license.php
 * Thickbox is built on top of the very light weight jQuery library.
 */

//on page load call TB_init
//$(document).ready(TB_init);

//add thickbox to href elements that have a class of .thickbox
function TB_init()
{
	$("a.thickbox").click(function(){return false;});
	$("a.thickbox").click(
	function()
	{
		var t = this.title || this.name || null;
		var g = this.rel || false;
		TB_show(t,this.href,g);
		this.blur();
		return false;
	});
}

function TB_show(caption, url, imageGroup) {//function called when the user clicks on a thickbox link

	try {
		if (document.getElementById("TB_HideSelect") == null) 
		{
			$("body").append("<iframe id='TB_HideSelect'></iframe><div id='TB_overlay'></div><div id='TB_window' style='display:none'></div>");
			$("#TB_overlay").click(TB_remove);
		}
		
		if(caption==null){caption=""};
		
		$(window).scroll(TB_position);
 		
		TB_overlaySize();
		
		$("body").append("<div id='TB_load' style='background-color:#FFFFFF; border:5px ridge #CCCCCC;height:75px; width:175px;' align='center'><center><font color='#999999' size='3'><b>Loading, Please Wait.</b></font><br /><br /><img src='"+siteUrl+"images/loading.gif' /></center></div>");
		TB_load_position_loading();
		
		
		
	   if(url.indexOf("?")!==-1){ //If there is a query string involved
			var baseURL = url.substr(0, url.indexOf("?"));
	   }else{ 
	   		var baseURL = url;
	   }
	   var urlString = /\.jpg|\.jpeg|\.png|\.gif|\.bmp/g;
	   var urlType = baseURL.toLowerCase().match(urlString);
	   
	   var baseURL1 = url;
	   var urlString1 = /\.php\?file\=/g;
	   var urlType1 = baseURL1.toLowerCase().match(urlString1);
		
		if((urlType == '.jpg' || urlType == '.jpeg' || urlType == '.png' || urlType == '.gif' || urlType == '.bmp') || (urlType1 == '.php?file=')){//code to show images
				
			TB_PrevCaption = "";
			TB_PrevURL = "";
			TB_PrevHTML = "";
			TB_NextCaption = "";
			TB_NextURL = "";
			TB_NextHTML = "";
			TB_imageCount = "";
			TB_FoundURL = false;
			if(imageGroup){
				TB_TempArray = $("a[@rel="+imageGroup+"]").get();
				for (TB_Counter = 0; ((TB_Counter < TB_TempArray.length) && (TB_NextHTML == "")); TB_Counter++) {
					var urlTypeTemp = TB_TempArray[TB_Counter].href.toLowerCase().match(urlString);
						if (!(TB_TempArray[TB_Counter].href == url)) {						
							if (TB_FoundURL) {
								TB_NextCaption = TB_TempArray[TB_Counter].title;
								TB_NextURL = TB_TempArray[TB_Counter].href;
								TB_NextHTML = "<span id='TB_next'>&nbsp;&nbsp;<a href='#'>Next &gt;&gt;</a></span>";
							} else {
								TB_PrevCaption = TB_TempArray[TB_Counter].title;
								TB_PrevURL = TB_TempArray[TB_Counter].href;
								TB_PrevHTML = "<span id='TB_prev'>&nbsp;&nbsp;<a href='#'>&lt;&lt; Prev</a></span>";
							}
						} else {
							TB_FoundURL = true;
							TB_imageCount = "Image " + (TB_Counter + 1) +" of "+ (TB_TempArray.length);											
						}
				}
			}

			imgPreloader = new Image();
			imgPreloader.onload = function(){		
			imgPreloader.onload = null;
				
			// Resizing large images - orginal by Christian Montoya edited by me.
			var pagesize = TB_getPageSize();
			var x = pagesize[0] - 150;
			var y = pagesize[1] - 150;
			var imageWidth = imgPreloader.width;
			var imageHeight = imgPreloader.height;
			if (imageWidth > x) {
				imageHeight = imageHeight * (x / imageWidth); 
				imageWidth = x; 
				if (imageHeight > y) { 
					imageWidth = imageWidth * (y / imageHeight); 
					imageHeight = y; 
				}
			} else if (imageHeight > y) { 
				imageWidth = imageWidth * (y / imageHeight); 
				imageHeight = y; 
				if (imageWidth > x) { 
					imageHeight = imageHeight * (x / imageWidth); 
					imageWidth = x;
				}
			}
			// End Resizing
			
			TB_WIDTH = imageWidth + 30;
			TB_HEIGHT = imageHeight + 60;
			$("#TB_window").append("<a href='' id='TB_ImageOff' title='Close'><img id='TB_Image' src='"+url+"' width='"+imageWidth+"' height='"+imageHeight+"' alt='"+caption+"'/></a>" + "<div id='TB_caption'>"+caption+"<div id='TB_secondLine'>" + TB_imageCount + TB_PrevHTML + TB_NextHTML + "</div></div><div id='TB_closeWindow'><a href='#' id='TB_closeWindowButton' title='Close'>Close</a></div>"); 		
			//$("#TB_window").fadeIn(800);
			$("#TB_closeWindowButton").click(TB_remove);
			
			if (!(TB_PrevHTML == "")) 
			{
				function goPrev()
				{
					$("#TB_window").fadeOut('fast',
					function()
					{
						$("#TB_window").remove();
						if($(document).unclick(goPrev)){$(document).unclick(goPrev)};
						$("body").append("<div id='TB_window' style='display:none'></div>");
						TB_show(TB_PrevCaption, TB_PrevURL, imageGroup);
					});
					return false;	
				}
				$("#TB_prev").click(goPrev);
			}
			
			if (!(TB_NextHTML == "")) {		
			
				function goNext()
				{
					$("#TB_window").fadeOut('fast',
						function()
						{
							$("#TB_window").remove();
							if($(document).unclick(goNext)){$(document).unclick(goNext)};
							$("body").append("<div id='TB_window' style='display:none'></div>");
							TB_show(TB_NextCaption, TB_NextURL, imageGroup);
						});
					return false;	
				}
				$("#TB_next").click(goNext);
			}
			
			document.onkeydown = function(e)
			{ 	
				if (e == null) 
				{ // ie
					keycode = event.keyCode;
				} 
				else 
				{ // mozilla
					keycode = e.which;
				}
				if(keycode == 27)
				{ // close
					TB_remove();
				} 
				else if(keycode == 190)
				{ // display previous image
					if(!(TB_NextHTML == ""))
					{
						document.onkeydown = "";
						goNext();
					}
				} 
				else if(keycode == 188)
				{ // display next image
					if(!(TB_PrevHTML == ""))
					{
						document.onkeydown = "";
						goPrev();
					}
				}	
			}
				
			TB_position();
			$("#TB_load").remove();
			$("#TB_window").fadeIn('fast');
			$("#TB_ImageOff").click(TB_remove);
			}
	  
			imgPreloader.src = url;
		}
		else
		{//code to show html pages
			
			var queryString = url.replace(/^[^\?]+\??/,'');
			var params = TB_parseQuery( queryString );
			
			var url_link = params['link'];
			
			TB_WIDTH = (params['width']*1) + 30;
			TB_HEIGHT = (params['height']*1) + 40;
			ajaxContentW = TB_WIDTH - 30;
			ajaxContentH = TB_HEIGHT - 45;
			
			if(url.indexOf('TB_iframe') != -1)
			{				
					urlNoQuery = url.split('TB_');		
					 $("#TB_window").append("<div id='TB_dragWindow'>"+
											"<div id='TB_title'>"+
												"<div id='TB_ajaxWindowTitle'>"+caption+"</div>"+
												"<div id='TB_closeAjaxWindow'>"+
													"<a href='#' id='TB_closeWindowButton' title='Close'>Close</a>"+
												"</div>"+
											"</div>"+
											"<iframe frameborder='0' hspace='0' src='"+url_link+"' id='TB_iframeContent' name='TB_iframeContent' style='width:"+(ajaxContentW + 29)+"px;height:"+(ajaxContentH + 17)+"px;' onload='TB_showIframe()'> </iframe></div>");
			}
			else
			{
					 $("#TB_window").append("<div id='TB_dragWindow'>"+
												"<div id='TB_title'>"+
										    		"<div id='TB_ajaxWindowTitle'>"+
													caption
													+"</div>"+
										   			"<div id='TB_closeAjaxWindow'>"+
										   				"<a href='javascript:;' id='TB_closeWindowButton'>Close</a>"+
										   			"</div>"+
										    	"</div>"+
										    	"<div id='TB_ajaxContent' style='width:"+ajaxContentW+"px;height:"+ajaxContentH+"px;'></div>"+
											"</div>");
			}
					
			$("#TB_closeWindowButton").click(TB_remove);
			
				if(url.indexOf('TB_inline') != -1)
				{	
					$("#TB_ajaxContent").html($('#' + params['inlineId']).html());
					TB_position();
					$("#TB_load").hide(function(){$("#TB_load").remove();$("#TB_window").fadeIn('fast');});
				}
				else if(url.indexOf('TB_iframe') != -1)
				{
					TB_position();
					if(frames['TB_iframeContent'] == undefined)
					{//be nice to safari
						$("#TB_load").hide(function(){$("#TB_load").remove(function(){});$("#TB_window").fadeIn('fast');});
						//$("#TB_window").Draggable({ghosting: true,opacity: 0.5,fx: 100});
						$(document).keyup( function(e){ var key = e.keyCode; if(key == 27){TB_remove()} });
					}
				}else{
					$("#TB_ajaxContent").load(url_link, function(){
						TB_position();
						$("#TB_load").hide(function(){$("#TB_load").remove();$("#TB_window").fadeIn('fast');});
					});
				}
			
		}
		
		$(window).resize(TB_position);
		
		document.onkeyup = function(e){ 	
			if (e == null) { // ie
				keycode = event.keyCode;
			} else { // mozilla
				keycode = e.which;
			}
			if(keycode == 27){ // close
				TB_remove();
			}	
		}
		
	} catch(e) {
		alert( e );
	}
}

//helper functions below

function TB_showIframe(){
	$("#TB_load").remove();
	$("#TB_window").css({display:"block"});
}

function TB_remove()
{
	$("#TB_load").remove();
	$("#TB_window").fadeOut('fast',function(){$('#TB_window,#TB_overlay,#TB_HideSelect').remove();});
	return false;
}

function TB_remove_load()
{
	$("#TB_load,#TB_overlay_load").hide(function(){$("#TB_load,#TB_overlay_load").remove();});
	return false;
}

function TB_position() {
	var pagesize = TB_getPageSize();	
	var arrayPageScroll = TB_getPageScrollTop();	
	$("#TB_window").css({width:TB_WIDTH+"px",left: (arrayPageScroll[0] + (pagesize[0] - TB_WIDTH)/2)+"px", top: (arrayPageScroll[1] + (pagesize[1]-TB_HEIGHT)/2)+"px" });
}

function TB_overlaySize(){
	if (window.innerHeight && window.scrollMaxY || window.innerWidth && window.scrollMaxX) {	
		yScroll = window.innerHeight + window.scrollMaxY;
		xScroll = window.innerWidth + window.scrollMaxX;
	} else if (document.body.scrollHeight > document.body.offsetHeight || document.body.scrollWidth > document.body.offsetWidth){ // all but Explorer Mac
		yScroll = document.body.scrollHeight;
		xScroll = document.body.scrollWidth;
	} else { // Explorer Mac...would also work in Explorer 6 Strict, Mozilla and Safari
		yScroll = document.body.offsetHeight;
		xScroll = document.body.offsetWidth;
  	}
	$("#TB_overlay").css({"height":yScroll +"px", "width":xScroll +"px"});
	$("#TB_HideSelect").css({"height":yScroll +"px","width":xScroll +"px"});
}

function TB_load_position() 
{
	var pagesize = TB_getPageSize();
	var arrayPageScroll = TB_getPageScrollTop();
	$("#TB_load").css({left: (arrayPageScroll[0] + (pagesize[0] - 100)/2)+"px", top: (arrayPageScroll[1] + ((pagesize[1]-100)/2))+"px" }).css({display:"block"});
}

function TB_load_position_loading() 
{
	var pagesize = TB_getPageSize();
	var arrayPageScroll = TB_getPageScrollTop();
	$("#TB_load").css("top","300px").css("left",(arrayPageScroll[0] + (pagesize[0] - 300)/2)+"px").css("display","block");
	$("#TB_load").show()
}

function TB_parseQuery ( query ) {
   var Params = new Object ();
   if ( ! query ) return Params; // return empty object
   var Pairs = query.split(/[;&]/);
   for ( var i = 0; i < Pairs.length; i++ ) {
      var KeyVal = Pairs[i].split('=');
      if ( ! KeyVal || KeyVal.length != 2 ) continue;
      var key = unescape( KeyVal[0] );
      var val = unescape( KeyVal[1] );
      val = val.replace(/\+/g, ' ');
      Params[key] = val;
   }
   return Params;
}

function TB_getPageScrollTop(){
	var yScrolltop;
	var xScrollleft;
	if (self.pageYOffset || self.pageXOffset) {
		yScrolltop = self.pageYOffset;
		xScrollleft = self.pageXOffset;
	} else if (document.documentElement && document.documentElement.scrollTop || document.documentElement.scrollLeft ){	 // Explorer 6 Strict
		yScrolltop = document.documentElement.scrollTop;
		xScrollleft = document.documentElement.scrollLeft;
	} else if (document.body) {// all other Explorers
		yScrolltop = document.body.scrollTop;
		xScrollleft = document.body.scrollLeft;
	}
	arrayPageScroll = new Array(xScrollleft,yScrolltop) 
	return arrayPageScroll;
}

function TB_getPageSize(){
	var de = document.documentElement;
	var w = window.innerWidth || self.innerWidth || (de&&de.clientWidth) || document.body.clientWidth;
	var h = window.innerHeight || self.innerHeight || (de&&de.clientHeight) || document.body.clientHeight
	arrayPageSize = new Array(w,h) 
	return arrayPageSize;
}



/*
 * Tooltip - jQuery plugin  for styled tooltips
 *
 * Copyright (c) 2006 Jörn Zaefferer, Stefan Petre
 *
 * Dual licensed under the MIT and GPL licenses:
 *   http://www.opensource.org/licenses/mit-license.php
 *   http://www.gnu.org/licenses/gpl.html
 *
 */
// the tooltip element
var helper,
	// it's title part
	tTitle,
	// it's body part
	tBody,
	// it's url part
	tUrl,
	// the current tooltipped element
	current,
	// the title of the current element, used for restoring
	oldTitle,
	// timeout id for delayed tooltips
	tID;

// the public plugin method
$.fn.Tooltip = function(settings) {
	// setup configuration
	// TODO: allow multiple arguments to extend, see bug #344
	settings = $.extend($.extend({}, arguments.callee.defaults), settings || {});

	// there can be only one tooltip helper
	if( !helper ) {
		// create the helper, h3 for title, div for url
		helper = $('<div id="tooltip"><h3></h3><p class="body"></p><p class="url"></p></div>')
			// hide it at first
			.hide()
			// move to top and position absolute, to let it follow the mouse
			.css({ position: 'absolute', zIndex: 3000, width: 'auto' })
			// add to document
			.appendTo('body');

		// save references to title and url elements
		tTitle = $('h3', helper);
		tBody = $('p:eq(0)', helper);
		tUrl = $('p:eq(1)', helper);
	}
	
	// bind events for every selected element with a title attribute
	$(this).filter('[@title]')
		// save settings into each element
		// TODO: pass settings via event system, not yet possible
		.each(function() {
			this.tSettings = settings;
		})
		// bind events
		.bind("mouseover", save)
		.bind(settings.event, handle);
	return this;
};

// the public plugin kill method
$.fn.TooltipKill = function() 
{
	helper.css({display:'none'},function()
	{
		this.bind("mouseover", function(){});
		return this;
	});
};

// main event handler to start showing tooltips
function handle(event) {
	// show helper, either with timeout or on instant
	if( this.tSettings.delay )
		tID = setTimeout(show, this.tSettings.delay);
	else
		show();
	
	// if selected, update the helper position when the mouse moves
	if(this.tSettings.track)
		$('body').bind('mousemove', update);
		
	// update at least once
	update(event);
	
	// hide the helper when the mouse moves out of the element
	$(this).bind('mouseout', hide);
}

// save elements title before the tooltip is displayed
function save() {
	// if this is the current source, or it has no title (occurs with click event), stop
	if(this == current || !this.title)
		return;
	// save current
	current = this;
	
	var source = $(this),
		settings = this.tSettings;
		
	// save title, remove from element and set to helper
	oldTitle = title = source.attr('title');
	source.attr('title','');
	if(settings.showBody) 
	{
		var parts = title.split(settings.showBody);
		tTitle.html(parts.shift());
		tBody.empty();
		for(var i = 0, part; part = parts[i]; i++) 
		{
			if(i > 0)
				tBody.append("<br/>");
			tBody.append(part);
		}
		if(tBody.html())
			tBody.css('display','none');
		else
			tBody.css('display','');
	} 
	else 
	{
		tTitle.html(title);
		tBody.hide();
	}
	
	// hide it
	tUrl.hide();
	
	// add an optional class for this tip
	if( settings.extraClass ) {
		helper.addClass(settings.extraClass);
	}
	// fix PNG background for IE
	if (settings.fixPNG && $.browser.msie ) {
		helper.each(function () {
			if (this.currentStyle.backgroundImage != 'none') {
				var image = this.currentStyle.backgroundImage;
				image = image.substring(5, image.length - 2);
				$(this).css({
					'backgroundImage': 'none',
					'filter': "progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled=true, sizingMethod=crop, src='" + image + "')"
				});
			}
		});
	}
	// set cool width
		var titleB = title;
			titleB = titleB.length;
			if(titleB > 20)
			{
				titleB = titleB - 3;
			}
			titleB = titleB * 11 + 'px';
			helper.css('width',titleB);
}

// delete timeout and show helper
function show() {
	tID = null;
	helper.css('display','block');
	update();
}

/**
 * callback for mousemove
 * updates the helper position
 * removes itself when no current element
 */
function update(event)	{
	// if no current element is available, remove this listener
	if( current == null ) {
		$('body').unbind('mousemove', update);
		return;	
	}
	
	var left = helper[0].offsetLeft;
	var top = helper[0].offsetTop;
	if(event) {
		// get the current mouse position
		function pos(c) {
			var p = c == 'X' ? 'Left' : 'Top';
			return event['page' + c] || (event['client' + c] + (document.documentElement['scroll' + p] || document.body['scroll' + p])) || 0;
		}
		// position the helper 15 pixel to bottom right, starting from mouse position
		left = pos('X') + 15;
		top = pos('Y') + 15;
		helper.css({
			left: left + 'px',
			top: top + 'px'
		});
	}
	
	var v = viewport(),
		h = helper[0];
	// check horizontal position
	if(v.x + v.cx < h.offsetLeft + h.offsetWidth) {
		left -= h.offsetWidth + 20;
		helper.css({left: left + 'px'});
	}
	// check vertical position
	if(v.y + v.cy < h.offsetTop + h.offsetHeight) {
		top -= h.offsetHeight + 20;
		helper.css({top: top + 'px'});
	}
}

function viewport() {
	var e = document.documentElement || {},
		b = document.body || {},
		w = window;

	return {
		x: w.pageXOffset || e.scrollLeft || b.scrollLeft || 0,
		y: w.pageYOffset || e.scrollTop || b.scrollTop || 0,
		cx: min( e.clientWidth, b.clientWidth, w.innerWidth ),
		cy: min( e.clientHeight, b.clientHeight, w.innerHeight )
	};

	function min() {
		var v = Infinity;
		for( var i = 0;  i < arguments.length;  i++ ) {
			var n = arguments[i];
			if( n && n < v ) v = n;
		}
		return v;
	}
}

// hide helper and restore added classes and the title
function hide() {
	// clear timeout if possible
	if(tID)
		clearTimeout(tID);
	// no more current element
	current = null;
	helper.hide();
	// remove optional class
	if( this.tSettings.extraClass ) {
		helper.removeClass( this.tSettings.extraClass);
	}
	
	// restore title and remove this listener
	$(this)
		.attr('title', oldTitle)
		.unbind('mouseout', hide);
		
	// remove PNG background fix for IE
	if( this.tSettings.fixPNG && $.browser.msie ) {
		helper.each(function () {
			$(this).css({'filter': '', backgroundImage: ''});
		});
	}
}

// define global defaults, editable by client
$.fn.Tooltip.defaults = {
	delay: 250,
	event: "mouseover",
	track: false,
	showURL: true,
	showBody: null,
	extraClass: null,
	fixPNG: false
};


