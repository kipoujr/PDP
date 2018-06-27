/*! sidr - v2.2.1 - 2016-09-24
 * http://www.berriart.com/sidr/
 * Copyright (c) 2013-2016 Alberto Varela; Licensed MIT */
!function(){"use strict";function a(a,b,c){var d=new p(b);switch(a){case"open":d.open(c);break;case"close":d.close(c);break;case"toggle":d.toggle(c);break;default:q.error("Method "+a+" does not exist on jQuery.sidr")}}function b(a){return"status"===a?g:t[a]?t[a].apply(this,Array.prototype.slice.call(arguments,1)):"function"!=typeof a&&"string"!=typeof a&&a?void r.error("Method "+a+" does not exist on jQuery.sidr"):t.toggle.apply(this,arguments)}function c(a,b){if("function"==typeof b.source){var c=b.source(name);a.html(c)}else if("string"==typeof b.source&&h.isUrl(b.source))v.get(b.source,function(b){a.html(b)});else if("string"==typeof b.source){var d="",e=b.source.split(",");if(v.each(e,function(a,b){d+='<div class="sidr-inner">'+v(b).html()+"</div>"}),b.renaming){var f=v("<div />").html(d);f.find("*").each(function(a,b){var c=v(b);h.addPrefixes(c)}),d=f.html()}a.html(d)}else null!==b.source&&v.error("Invalid Sidr Source");return a}function d(a){var d=h.transitions,e=v.extend({name:"sidr",speed:200,side:"left",source:null,renaming:!0,body:"body",displace:!0,timing:"ease",method:"toggle",bind:"touchstart click",onOpen:function(){},onClose:function(){},onOpenEnd:function(){},onCloseEnd:function(){}},a),f=e.name,i=v("#"+f);return 0===i.length&&(i=v("<div />").attr("id",f).appendTo(v("body"))),d.supported&&i.css(d.property,e.side+" "+e.speed/1e3+"s "+e.timing),i.addClass("sidr").addClass(e.side).data({speed:e.speed,side:e.side,body:e.body,displace:e.displace,timing:e.timing,method:e.method,onOpen:e.onOpen,onClose:e.onClose,onOpenEnd:e.onOpenEnd,onCloseEnd:e.onCloseEnd}),i=c(i,e),this.each(function(){var a=v(this),c=a.data("sidr"),d=!1;c||(g.moving=!1,g.opened=!1,a.data("sidr",f),a.bind(e.bind,function(a){a.preventDefault(),d||(d=!0,b(e.method,f),setTimeout(function(){d=!1},100))}))})}var e,f,g={moving:!1,opened:!1},h={isUrl:function(a){var b=new RegExp("^(https?:\\/\\/)?((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.?)+[a-z]{2,}|((\\d{1,3}\\.){3}\\d{1,3}))(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*(\\?[;&a-z\\d%_.~+=-]*)?(\\#[-a-z\\d_]*)?$","i");return!!b.test(a)},addPrefixes:function(a){this.addPrefix(a,"id"),this.addPrefix(a,"class"),a.removeAttr("style")},addPrefix:function(a,b){var c=a.attr(b);"string"==typeof c&&""!==c&&"sidr-inner"!==c&&a.attr(b,c.replace(/([A-Za-z0-9_.\-]+)/g,"sidr-"+b+"-$1"))},transitions:function(){var a=document.body||document.documentElement,b=a.style,c=!1,d="transition";return d in b?c=!0:!function(){var a=["moz","webkit","o","ms"],e=void 0,f=void 0;d=d.charAt(0).toUpperCase()+d.substr(1),c=function(){for(f=0;f<a.length;f++)if(e=a[f],e+d in b)return!0;return!1}(),d=c?"-"+e.toLowerCase()+"-"+d.toLowerCase():null}(),{supported:c,property:d}}()},i=function(a,b){if(!(a instanceof b))throw new TypeError("Cannot call a class as a function")},j=function(){function a(a,b){for(var c=0;c<b.length;c++){var d=b[c];d.enumerable=d.enumerable||!1,d.configurable=!0,"value"in d&&(d.writable=!0),Object.defineProperty(a,d.key,d)}}return function(b,c,d){return c&&a(b.prototype,c),d&&a(b,d),b}}(),k=jQuery,l="sidr-animating",m="open",n="close",o="webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend",p=function(){function a(b){i(this,a),this.name=b,this.item=k("#"+b),this.openClass="sidr"===b?"sidr-open":"sidr-open "+b+"-open",this.menuWidth=this.item.outerWidth(!0),this.speed=this.item.data("speed"),this.side=this.item.data("side"),this.displace=this.item.data("displace"),this.timing=this.item.data("timing"),this.method=this.item.data("method"),this.onOpenCallback=this.item.data("onOpen"),this.onCloseCallback=this.item.data("onClose"),this.onOpenEndCallback=this.item.data("onOpenEnd"),this.onCloseEndCallback=this.item.data("onCloseEnd"),this.body=k(this.item.data("body"))}return j(a,[{key:"getAnimation",value:function(a,b){var c={},d=this.side;return"open"===a&&"body"===b?c[d]=this.menuWidth+"px":"close"===a&&"menu"===b?c[d]="-"+this.menuWidth+"px":c[d]=0,c}},{key:"prepareBody",value:function(a){var b="open"===a?"hidden":"";if(this.body.is("body")){var c=k("html"),d=c.scrollTop();c.css("overflow-x",b).scrollTop(d)}}},{key:"openBody",value:function(){if(this.displace){var a=h.transitions,b=this.body;if(a.supported)b.css(a.property,this.side+" "+this.speed/1e3+"s "+this.timing).css(this.side,0).css({width:b.width(),position:"absolute"}),b.css(this.side,this.menuWidth+"px");else{var c=this.getAnimation(m,"body");b.css({width:b.width(),position:"absolute"}).animate(c,{queue:!1,duration:this.speed})}}}},{key:"onCloseBody",value:function(){var a=h.transitions,b={width:"",position:"",right:"",left:""};a.supported&&(b[a.property]=""),this.body.css(b).unbind(o)}},{key:"closeBody",value:function(){var a=this;if(this.displace)if(h.transitions.supported)this.body.css(this.side,0).one(o,function(){a.onCloseBody()});else{var b=this.getAnimation(n,"body");this.body.animate(b,{queue:!1,duration:this.speed,complete:function(){a.onCloseBody()}})}}},{key:"moveBody",value:function(a){a===m?this.openBody():this.closeBody()}},{key:"onOpenMenu",value:function(a){var b=this.name;g.moving=!1,g.opened=b,this.item.unbind(o),this.body.removeClass(l).addClass(this.openClass),this.onOpenEndCallback(),"function"==typeof a&&a(b)}},{key:"openMenu",value:function(a){var b=this,c=this.item;if(h.transitions.supported)c.css(this.side,0).one(o,function(){b.onOpenMenu(a)});else{var d=this.getAnimation(m,"menu");c.css("display","block").animate(d,{queue:!1,duration:this.speed,complete:function(){b.onOpenMenu(a)}})}}},{key:"onCloseMenu",value:function(a){this.item.css({left:"",right:""}).unbind(o),k("html").css("overflow-x",""),g.moving=!1,g.opened=!1,this.body.removeClass(l).removeClass(this.openClass),this.onCloseEndCallback(),"function"==typeof a&&a(name)}},{key:"closeMenu",value:function(a){var b=this,c=this.item;if(h.transitions.supported)c.css(this.side,"").one(o,function(){b.onCloseMenu(a)});else{var d=this.getAnimation(n,"menu");c.animate(d,{queue:!1,duration:this.speed,complete:function(){b.onCloseMenu()}})}}},{key:"moveMenu",value:function(a,b){this.body.addClass(l),a===m?this.openMenu(b):this.closeMenu(b)}},{key:"move",value:function(a,b){g.moving=!0,this.prepareBody(a),this.moveBody(a),this.moveMenu(a,b)}},{key:"open",value:function(b){var c=this;if(g.opened!==this.name&&!g.moving){if(g.opened!==!1){var d=new a(g.opened);return void d.close(function(){c.open(b)})}this.move("open",b),this.onOpenCallback()}}},{key:"close",value:function(a){g.opened!==this.name||g.moving||(this.move("close",a),this.onCloseCallback())}},{key:"toggle",value:function(a){g.opened===this.name?this.close(a):this.open(a)}}]),a}(),q=jQuery,r=jQuery,s=["open","close","toggle"],t={},u=function(b){return function(c,d){"function"==typeof c?(d=c,c="sidr"):c||(c="sidr"),a(b,c,d)}};for(e=0;e<s.length;e++)f=s[e],t[f]=u(f);var v=jQuery;jQuery.sidr=b,jQuery.fn.sidr=d}();;
// Avoid `console` errors in browsers that lack a console.x
//
//(function($) {
//
//(function() {
//    var method;
//    var noop = function () {};
//    var methods = [
//        'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
//        'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
//        'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
//        'timeline', 'timelineEnd', 'timeStamp', 'trace', 'warn'
//    ];
//    var length = methods.length;
//    var console = (window.console = window.console || {});
//
//    while (length--) {
//        method = methods[length];
//
//        // Only stub undefined methods.
//        if (!console[method]) {
//            console[method] = noop;
//        }
//    }
//}());
//
//})(jQuery);


// Place any jQuery/helper plugins in here.
;
(function($) {
    $(document).ready(function() {
        //------------------- When search icon is click ---------------

        $(".search-icon").click(function(e) {

            e.preventDefault();
            $("#search-area").fadeIn(400);

            var headerHeight = $('#programiz-header').height();
            var searchFormHeight = $('#search-area form').height();
            var marginTop = (headerHeight - searchFormHeight) / 2;

            $("#search-area").css({
                'position': 'fixed',
                'width': '100%',
                'background': '#DDD !important',
                'top': '0',
                'z-index': '100',
                'height': '110px'
            });

            $("#search-area form").css({
                'margin': '0 auto',
                'margin-top': '40px'
            });

            $("#search-area .gsc-input input").focus();
        });

        $("#search-area span").click(function(e) {

            e.preventDefault();
            $("#search-area").hide();
            $("#search-area").css('position', 'static');
        });

         // ---------------------- Premium Fancy Bar ----------------------------------------------

        function setCookie(key, value) {
            var expires = new Date();
            expires.setTime(expires.getTime() + (60 * 60 * 1000));
            document.cookie = key + '=' + value + ';expires=' + expires.toUTCString();
        }

        function getCookie(key) {
            var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|$)');
            return keyValue ? keyValue[2] : null;
        }

        var crossButtonClicked = false;
        var cross = getCookie("programizFancyBar");

        if(cross != null) {
            crossButtonClicked = true;
        }

        $("footer").on("click" ,".fancy-cross", function(e){
            e.preventDefault;
            crossButtonClicked = true;

            $(".fancy-premium").slideUp(200);
            setCookie("programizFancyBar", true);
        })


        // -----------------------  sidebar Menu ------------------------------------------------

        var relativeURL = window.location.pathname;
        // $("#programiz-left-sidebar a[href= '" + relativeURL + "']").addClass("currentPage");


        // $(".submenu a").click(function() {

        //     $("topmenu ").find(".currentPage").removeClass("currentPage");
        //     $(this).parent().addClass("currentPage");
        // });

        $(".submenu a").each(function() {

            var href = $(this).attr('href');

            if (href.indexOf(relativeURL) > -1) {
                $(this).parent().addClass("currentPage");
                return false;
            }
        });

        $(".submenu").not(':has(.currentPage)').addClass('visuallyhidden');
        $(".submenu:has(.currentPage)").addClass('visuallynothidden');

        $('.visuallyhidden').prev().append('<span class="indicator_hide"></span>');
        $('.visuallynothidden').prev().append('<span class="indicator_show"></span>');

        $(".topmenu h3").click(function() {

            var all = $(".visuallynothidden");
            all.removeClass('visuallynothidden');
            all.addClass("visuallyhidden");

            console.log('hello');

            $(this).next().toggleClass("visuallyhidden visuallynothidden");

            $(".indicator_hide").remove();
            $(".indicator_show").remove();
            $('.visuallyhidden').prev().append('<span class="indicator_hide"></span>');
            $('.visuallynothidden').prev().append('<span class="indicator_show"></span>');
        });

        // ------------------------------ Screen size (after changed as well) ----------------------

        width = $(window).width();
        changeWidth(width);

        $(window).resize(function() {

            width = $(window).width();

            if ($(this).width() != width) {
                width = $(this).width();
            }

            changeWidth(width);
        });



        function changeWidth(width) {

            //	$(window).off('scroll');

            //--------------------------------- width less than 900 --------------------------------------

            if (width < 900) {

                $('.main-nav li').removeClass('current-nav-li');

                var classFoundInUrl = false;
                var relativeURL = window.location.pathname;

                $('.main-nav ul a').each(function() {

                    var className = $(this).attr('class').split(" ")[0];

                    if (relativeURL.indexOf(className) > -1) {

                        $(this).parent().addClass('current-nav-li');
                        classFoundInUrl = true;
                        return false;
                    }
                });

                if (classFoundInUrl == false)
                    $(".home-icon").parent().addClass('current-nav-li');


                // navReset();

                //------------------ Hide Menubar and  Show menuicon for width < 900 ---------------------------

                // $("#programiz-left-sidebar").hide();


                $(".current-nav-li").parent().children().hide();
                $(".current-nav-li").show();
                $(".home-icon").parent().show();
                $(".main-nav").show();
                if ($(".mobile-menu").length == 0) {
                    $(".current-nav-li").parent().prepend("<li class='mobile-menu'><a class='material-icons' href='' style='font-size: 26px;'>menu</a></li>");
                } else {
                    $(".mobile-menu").show();
                }

            } else {
                // $("#programiz-left-sidebar").show();

                $(".current-nav-li").parent().children().show();
                $(".mobile-menu").hide();

                var longList = false;
                $(".large-list-sidebar td").each(function(i) {
                    if (i > 15) {
                        $(this).addClass('visuallyhidden');
                    }
                    if (i == 16) {
                        longList = true;
                    }
                });

                if (longList === true) {
                    if ($(".view-more-button .material-icons").length == 0) {
                        $(".large-list-sidebar").append("<div class='view-more-button'><i class='material-icons'>expand_more</i></div>");
                    }
                }

                $(".view-more-button").on("click", function(){
                    $(".large-list-sidebar td").removeClass('visuallyhidden');
                    $(".view-more-button").hide();
                });
            }


            //---------------------------------------- width less than 1366px --------------------------------------

            // if (width < 900) {
            //     navReset();
            //     var timer;
            //     var elementPosition = $(".main-nav-wrapper").offset();

                //----------------------------- sticky navigation after scroll ------------------------------------------

            //     $(document).on('scroll', function() {
            //         var scrollTop = $(window).scrollTop();

            //         if (scrollTop <= 63 || (width < 900 && window.innerWidth > window.innerHeight)) {
            //             $('.main-nav-wrapper').css({
            //                 'position': 'static'
            //             });
            //             $('#main-wrapper').css({
            //                 'margin-top': '0'
            //             });
            //             $('#front-page-main-wrapper').css({
            //                 'margin-top': '0'
            //             });
            //         } else {
            //             $('.main-nav-wrapper').css({
            //                 'position': 'fixed',
            //                 'top': '0',
            //                 'width': '100%'
            //             });
            //             $('#main-wrapper').css({
            //                 'margin-top': '64px'
            //             });
            //             $('#front-page-main-wrapper').css({
            //                 'margin-top': '64px'
            //             });
            //         }
            //     });
            // }


            //--------------------------------- width greater than 1366px --------------------------------------

            // if (width >= 1366) {

            // 	navReset();

            // 	$("#programiz-header").css({
            // 		'position': 'fixed',
            // 		'top': '0',
            // 		'width': '100%'
            // 	});

            // 	$("#main-wrapper").css({
            // 		'margin-top': '66px'
            // 	});

            // 	$("#front-page-element-container").css({
            // 		'margin-top': '66px'
            // 	});
            // }
        }

        //-------------------- Reset elements realated to naviation when screen is changed ----------------------
        function navReset() {
            //$("#search-area").hide();
            $('.main-nav-wrapper').css({
                'position': 'static'
            });
            $('#programiz-header').css({
                'position': 'static'
            });
            $('#main-wrapper').css({
                'margin-top': '0'
            });
            $('#front-page-main-wrapper').css({
                'margin-top': '0'
            });
        }


        // ------------------------ Mobile Menu --------------------------------------------

        target = {};

        // $('.mobile-menu').sidr({
        //     name: 'sidr-left',
        //     source: '.header-list-menu',
        //     onOpenEnd: onOpenEndCallback,
        //     onClose: onCloseCallback
        // });

        // $('.mobile-menu-subtheme').sidr({
        //     name: 'sidr-left',
        //     source: '.header-list-menu',
        //     onOpenEnd: onOpenEndCallback,
        //     onClose: onCloseCallback
        // });

        if ($(".header-list-menu")[0])
        {
            $('.mobile-menu').sidr({
                name: 'sidr-left',
                source: '.header-list-menu',
                onOpenEnd: onOpenEndCallback,
                onClose: onCloseCallback
            });

            $('.mobile-menu-subtheme').sidr({
                name: 'sidr-left',
                source: '.header-list-menu',
                onOpenEnd: onOpenEndCallback,
                onClose: onCloseCallback
            });
        }
        else
        {
            $('.mobile-menu').sidr({
                name: 'default-mobile-menu',
                source: '.main-nav',
                onOpenEnd: onOpenEndCallback,
                onClose: onCloseCallback
            });

            $('.mobile-menu-subtheme').sidr({
                    name: 'default-mobile-menu',
                    source: '.main-nav',
                    onOpenEnd: onOpenEndCallback,
                    onClose: onCloseCallback
                });
        }

        var dragging = false;
        var opened = false;

        $("#sidr-left").bind('touchmove', function() {
            dragging = true;
        });

        $("#sidr-left").bind('touchstart', function() {
            dragging = false;
        });

        function onOpenEndCallback() {
            $(document).bind('touchend', enableMenuClose);
        }

        function disableMenuClose(e) {
            menuClose = false;
        }

        function enableMenuClose(e) {
            if(dragging) {
                dragging = false;
                return;
            }

            var container = $("#sidr-left");
            if ((!container.is(e.target)// && container.has(e.target).length === 0)
               && container.has(e.target).length === 0) || 
                (container.has(e.target).length > 0 && typeof $(e.target).attr("href") !== 'undefined' && $(e.target).attr("href").indexOf("#") !== -1))
            {
                setTimeout(function() {
                    $.sidr('close', 'sidr-left');
                }, 200);
            }
        }

        function disableClick(e) {
            e.preventDefault();
            return false;
        }

        function onCloseCallback() {
            $(document).unbind('touchend', enableMenuClose);
            // $(document).unbind('mouseup', enableMenuClose);
            // $(".header-list-menu a").unbind("mouseup", enableMenuClose);
            // $(".header-list-menu a").unbind("touchend", enableMenuClose);
        }

        // -------------------------- scroll to top -----------------------------

        $(window).scroll(function() {

            if ($(this).scrollTop() > 200 && $(".fancy-premium:first").is(":hidden") && crossButtonClicked == false) {
                $(".fancy-premium").slideDown(400);
            }

            if ($(this).scrollTop() <= 200 && $(".fancy-premium:first").is(":visible")) {
                $(".fancy-premium").slideUp(300);
            }
            
            if ($(this).scrollTop()) {
                $('#back-to-top').fadeIn();
            } else {
                $('#back-to-top').fadeOut();
            }
        });

        $("#back-to-top").click(function() {
          $("html, body").animate({ scrollTop: 0 }, "slow");
        });

        // ------------------ Share button and fixed sidebar -------------------------
        // $(window).on("load", function() {
        //     if ($('#share-buttons').length > 0)
        //         var shareScrollTop = $("#share-buttons").offset().top;
        //     if ($('.udemy-affiliates').length > 0)
        //         var sidebarScrollTop = $(".udemy-affiliates").offset().top;

        //     if (window.location.hash) {
        //         $(".udemy-affiliates").addClass('fix-sidebar');
        //     }

        //     if (sidebarScrollTop != null || shareScrollTop != null) {
        //         $(document).scroll(function() {

        //             if (shareScrollTop != null) {
        //                 if ($(document).scrollTop() >= shareScrollTop) {
        //                     $("#share-buttons").addClass('fix-share-button');
        //                 } else {
        //                     $("#share-buttons").removeClass('fix-share-button');
        //                 }

        //             }

        //             if (sidebarScrollTop != null) {
        //                 if ($(document).scrollTop() >= sidebarScrollTop) {
        //                     $(".udemy-affiliates").addClass('fix-sidebar');
        //                 } else {
        //                     $(".udemy-affiliates").removeClass('fix-sidebar');
        //                 }
        //             }
        //         });
        //     }
        // });
    });
})(jQuery);;
