var cssua=function(i,l){var m=/[\w\-\.]+[\/][v]?\d+(\.\d+)*/g,n=/\b(aol|america online browser)[\s\/]*(\d+(\.\d+)*)/,o=/\b(msie|microsoft internet explorer)[\s\/]*(\d+(\.\d+)*)/,p=/rv[:](\d+(\.\d+)*).*?\bgecko[\/]\d+/,q=/\bopera[\s\/]*(\d+(\.\d+)*)/,r=/\bandroid[\s]+(\d+(\.\d+)*)/,s=/\bos[\s]+(\d+(\_\d+)*) like mac os x/,t=/\b(mspie|microsoft pocket internet explorer)[\s\/]*(\d+(\.\d+)*)/,u=/\bicab[\s\/]*(\d+(\.\d+)*)/,v=/\bblackberry\w*[\s\/]+(\d+(\.\d+)*)/,w=/(\w*mobile[\/]\w*|\bandroid\b|\bipad\b|\bipod\b|\w*phone\w*|\bpda\b|\bchtml\b|\bmidp\b|\bcldc\b|blackberry\w*|windows ce\b|palm\w*\b|symbian\w*\b)/,
g={parse:function(b){var a={};b=(""+b).toLowerCase();if(!b)return a;var c=b.match(m);if(c)for(var e=0;e<c.length;e++){var f=c[e].indexOf("/"),d=c[e].substring(0,f);if(d&&d!=="mozilla"){if(d==="applewebkit")d="webkit";a[d]=c[e].substr(f+1)}}if(n.exec(b))a.aol=RegExp.$2;if(q.exec(b))a.opera=RegExp.$1;else if(u.exec(b))a.icab=RegExp.$1;else if(o.exec(b))a.ie=RegExp.$2;else if(t.exec(b))a.mspie=RegExp.$2;else if(p.exec(b))a.gecko=RegExp.$1;else if(r.exec(b))a.android=RegExp.$1;else if(s.exec(b))a.ios=
RegExp.$1.split("_").join(".");if(!a.blackberry&&v.exec(b))a.blackberry=RegExp.$1;if(w.exec(b))a.mobile=RegExp.$1;if(a.safari)if(a.chrome||a.blackberry)delete a.safari;else a.safari=a.version?a.version:{"419":"2.0.4","417":"2.0.3","416":"2.0.2","412":"2.0","312":"1.3","125":"1.2","85":"1.0"}[parseInt(a.safari,10)]||a.safari;else if(a.opera&&a.version)a.opera=a.version;a.version&&delete a.version;return a},format:function(b){function a(f,d){f=f.split(".").join("-");var j=" ua-"+f;if(d){d=d.split(".").join("-");
for(var h=d.indexOf("-");h>0;){j+=" ua-"+f+"-"+d.substring(0,h);h=d.indexOf("-",h+1)}j+=" ua-"+f+"-"+d}return j}var c="",e;for(e in b)if(e&&b.hasOwnProperty(e))c+=a(e,b[e]);return c},encode:function(b){var a="",c;for(c in b)if(c&&b.hasOwnProperty(c)){if(a)a+="&";a+=encodeURIComponent(c)+"="+encodeURIComponent(b[c])}return a}};g.userAgent=g.ua=g.parse(l);var k=g.format(g.ua);if(i.className)i.className+=k;else i.className=k.substr(1);return g}(document.documentElement,navigator.userAgent);