/*

Elfsight Pricing Table
Version: 2.2.0
Release date: Thu Apr 26 2018

https://elfsight.com

Copyright (c) 2018 Elfsight, LLC. ALL RIGHTS RESERVED

*/!function(e){(window.eapps=window.eapps||{}).observer=function(e,o,t){e.$watch("widget.data.layout",function(){"table"===e.widget.data.layout?r("head",!0,o):r("head",!1,o)}),e.$watch("widget.data.mainColor",function(r,o){e.widget.data.mainColor&&e.widget.data.columns.forEach(function(r,t){e.widget.data.columns[t].mainColor||(e.widget.data.columns[t].mainColor=e.widget.data.mainColor),!e.widget.data.mainColor&&""!==e.widget.data.mainColor||e.widget.data.columns[t].mainColor!==o||(e.widget.data.columns[t].mainColor=e.widget.data.mainColor)})}),t&&t.$watch("currentComplex",function(){t.currentComplex&&(e.widget.data.columns.forEach(function(r,o){(t.currentComplex.priceCurrency||""===t.currentComplex.priceCurrency)&&(e.widget.data.columns[o].priceCurrency=t.currentComplex.priceCurrency),(t.currentComplex.pricePostfix||""===t.currentComplex.pricePostfix)&&(e.widget.data.columns[o].pricePostfix=t.currentComplex.pricePostfix),(t.currentComplex.pricePrefix||""===t.currentComplex.pricePrefix)&&(e.widget.data.columns[o].pricePrefix=t.currentComplex.pricePrefix)}),t.currentComplex.isFeatured?r("ribbonGroup",!0,o):r("ribbonGroup",!1,o),"filled"===t.currentComplex.buttonType?r("buttonTextColor",!0,o):r("buttonTextColor",!1,o))},!0)};var r=function(e,o,t){t.forEach(function(i,n){if(i.id===e)return t[n].visible=o,!1;i&&i.properties&&r(e,o,i.properties),i.complex&&i.complex.properties&&r(e,o,i.complex.properties),i.subgroup&&i.subgroup.properties&&r(e,o,i.subgroup.properties)})}}();