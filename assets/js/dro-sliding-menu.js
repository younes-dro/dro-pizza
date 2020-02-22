/**
 * WordPress JQuery Mobile Menu
 * 
 * Inspired from JQuery Simple MobileMenu : https://github.com/Position2/jQuery-Simple-MobileMen
 * 
 */

(function ($) {
    var defaults = {
                    "toggleMenuId"              :   "toggle-menu",
                    "toggleMenuContainerId"     :   "toggle-menu-container",
                    "toggleMenuContainerClass"  :   "toggle-menu-container-class",
                    "wrapperClass"              :   "wp_mm_wrapper",
                    "submenuClass"              :   "sub-menu",
                    "bodyOverlayClass"          :   "body_overlay"
    };
    $.fn.droSlidingMenu = function (options) {
        if ($(this).length === 0) { return this ;}
        var droMenu = {}, ds = $(this);
        var init = function () {
            droMenu.settings = $.extend({}, defaults, options);
            createWrappers();
            createBackButton();
            createRightNavButton();
        },
        createWrappers = function () {
            droMenu.toggleControl           = $("<button/>", {"id": droMenu.settings.toggleMenuId,
                                                 "html": "<span></span><span></span><span></span><span></span>"}),
            droMenu.toggleControlContainer  = $("<div/>",{"id": droMenu.settings.toggleMenuContainerId,
                                                  "class": droMenu.settings.toggleMenuContainerClass}),
            droMenu.wrapperControl          = $("<div/>", {"class": droMenu.settings.wrapperClass});
            droMenu.bodyOverlay             = $("<div/>", {"class": droMenu.settings.bodyOverlayClass});
            ds.appendTo(droMenu.wrapperControl);
            droMenu.toggleControl.prependTo(droMenu.toggleControlContainer);
            droMenu.toggleControlContainer.prependTo($("#masthead"));
            droMenu.bodyOverlay.add(droMenu.wrapperControl).appendTo($(".site"));
        },
        createRightNavButton = function () {
            droMenu.wrapperControl.find("li.page_item_has_children , li.menu-item-has-children").each(function () {
                var rightNavButton = $("<a/>", {"class": "ion-ios-arrow-forward forward"});
                rightNavButton.prependTo($(this));
            });
        },
        createBackButton = function () {
            droMenu.wrapperControl.find("ul." + droMenu.settings.submenuClass).each(function () {
                var dis         = $(this),
                    disPar      = dis.closest("li"),
                    disA        = disPar.find(">a"),
                    disIconBack = $("<span/>", {"class": "ion-ios-arrow-left left"}),
                    disBack     = $("<li/>", {"class": "back",
                                      "html": "<a href='" + disA.attr('href') + "'>" + disA.text() + "</a>"});
                disIconBack.prependTo(disBack);
                disBack.prependTo(dis);
            });
        },
        openCurrentPage = function(){
            /**
             * Syn the mobile menu with the current page
             **/
            droMenu.wrapperControl.find("li.current_page_item , li.current-menu-parent, li.current-menu-ancestor")
                .addClass("active").siblings().removeClass("active");
        },
        toggleMobileMenu = function () {
            $("#" + droMenu.settings.toggleMenuId).toggleClass("open");
            $("." + droMenu.settings.bodyOverlayClass).toggleClass("enabled");
            /*
            * keep the current item opened
            * to back to the home item add : .find("li.active").removeClass("active") 
            */
            $("." + droMenu.settings.wrapperClass).toggleClass("active");
            $("body").toggleClass("wp_mm_enable");
        },
        showSubMenu = function (e) {
            e.preventDefault();
            $("." + droMenu.settings.wrapperClass).scrollTop(0);
            $(this).parent().addClass("active").siblings().removeClass("active");
        },
        goBack = function (e) {
            e.preventDefault();
            $(this).closest("ul." + droMenu.settings.submenuClass).parent().removeClass("active");
        };

        init();
        openCurrentPage();
        droMenu.toggleControl.click(toggleMobileMenu);
        droMenu.bodyOverlay.click(toggleMobileMenu);
        droMenu.wrapperControl.find("li.page_item_has_children, li.menu-item-has-children > a.forward").click(showSubMenu);
        droMenu.wrapperControl.find("li.back > span").click(goBack);
    };
})(jQuery);


