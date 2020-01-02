/*
 * 
 * 
 * 
 */

(function ($) {
    /**
     * Creating the mobile menu.
     * 
     */
    var droPizzaMainMenu = $('nav.main-navigation ul.nav-menu').clone(true, true);
    $(droPizzaMainMenu).droSlidingMenu();

    /**
     * Show/ hide meta entry (Tags , Categories).
     */
    $('.open-meta-tags').on('click', function () {
        $entryfooter = $(this).parent();
        $(this).parent().parent().toggleClass('active').promise().done(function () {
            $(this).find('.meta-infos').slideToggle('fast');
            $entryfooter.toggleClass('open');
        });
        $(this).toggleClass('active');
    });
    /**
     * Aply Blur effect when the mobile menu is opned
     */
    $('#toggle-menu, .body_overlay').on('click', function () {
        if ($(this).hasClass('open')) {
            if ($('.top-header').length) {
                $('.top-header').toggleClass('zoom-in');
            }
            $('svg, .site-branding , .site-content , .site-footer, #site-navigation').toggleClass('blured');
        } else {
            if ($('.top-header').length) {
                $('.top-header').toggleClass('zoom-in');
            }
            $('svg, .site-branding , .site-content , .site-footer, #site-navigation').toggleClass('blured');
        }
    });
    /**
     * Dislay / Hide gallery caption text if it's exists
     */
    if ($('figure.gallery-item .gallery-caption')) {
        $('figure.gallery-item .gallery-caption').css({"display": "none"});
        var toggleCaption = $('<span/>', {'class': 'toggleCaption',
            'html': '<i class=" toggleCaption-plus"></i>'});
        $('figure.gallery-item').has('.gallery-caption').append(toggleCaption);

        $('figure.gallery-item  .toggleCaption').on('click', function () {
            $(this).find('i').toggleClass('toggleCaption-minus');
            $(this).prev('.gallery-caption').slideToggle();
        });
    }

    $.fn.handleGalley = function () {
        return this.each(function () {
            var $this = $(this);
            var numberOfColums, numberOfImages;
            var numberOfImages = $this.find('img').length;
            
            var classList = $this.attr('class').split(/\s+/);
//            console.log(classList);
            var t = classList.filter(function (item) {
                if (item.indexOf('columns-') === 0) {
                    return item;
                }
            });
            numberOfColums = t[0].substr(8);
            if(numberOfImages % numberOfColums !== 0){
                var m = numberOfImages % numberOfColums ;
                $this.find('li.blocks-gallery-item').slice(-m).each(function(e){
                    
                    var maxWidth = 100 / m ;
                    maxWidth  = Number( maxWidth);
                    maxWidth = maxWidth.toFixed(2);
                    
                    $(this).css({"maxWidth": maxWidth +'%'});
                    
                    
                });
            };
        });

    };
    if ($('ul.wp-block-gallery').length) {
        $('ul.wp-block-gallery').handleGalley();
    }

//    $.fn.toggleCaption = function () {
//
//        return this.each(function () {
//            var $this = $(this);
//            if ($this.find('figcaption').length) {
//                
//                var toggleCaption = $('<span/>', {'class': 'toggleCaption',
//                    'html': '<i class=" toggleCaption-plus"></i>'});
////                $this.find('figcaption').css({"display": "none"});
//                $this.find('figure').after(toggleCaption);
//                $this.find('span.toggleCaption').on('click',function(){
//                    $(this).find('i').toggleClass('toggleCaption-minus');
//                    $(this).prev('figure').find('figcaption').slideToggle();
//                });
//                
//            }else{
////               $this.css({"border":"1px solid #f00"});
//            }
//        });
//    };
//    if ($('li.blocks-gallery-item').length) {
//        $('li.blocks-gallery-item').toggleCaption();
//    }

})(jQuery);


