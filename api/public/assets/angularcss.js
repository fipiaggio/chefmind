!function(){"use strict";angular.module("angularLoad",[]).service("angularLoad",["$document","$q","$timeout",function(a,b,c){function d(a){var d={};return function(e){if("undefined"==typeof d[e]){var f=b.defer(),g=a(e);g.onload=g.onreadystatechange=function(a){g.readyState&&"complete"!==g.readyState&&"loaded"!==g.readyState||c(function(){f.resolve(a)})},g.onerror=function(a){c(function(){f.reject(a)})},d[e]=f.promise}return d[e]}}var e=a[0];this.loadScript=d(function(a){var b=e.createElement("script");return b.src=a,e.body.appendChild(b),b}),this.loadCSS=d(function(a){var b=e.createElement("link");return b.rel="stylesheet",b.type="text/css",b.href=a,e.head.appendChild(b),b})}])}();
//# sourceMappingURL=angular-load.min.js.map