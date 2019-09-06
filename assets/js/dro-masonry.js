/**
 * Custom Masonry to organize the widgets.
 * 
 * @param {Object} $
 * @returns {empty}
 */
(function ($) {
    /**
     * 
     * @type Object
     */
    var droMasonry = {
        settings: {
            $documentWidth: $(document).width(),
            $maxWidth: 1186,
            $minWidth: 754,
            $container: $('.widget-area'),
            $itemSelector: '.widget',
            $masonryOn: false,
            $columnWidth: 250
        },
        init: function () {
            if (this.masonryOn()) {
                this.runMasonry();
            }
        },
        masonryOn: function () {
            if ((this.settings.$documentWidth < this.settings.$maxWidth)
                    && (this.settings.$documentWidth > this.settings.$minWidth)) {

                return this.settings.$masonryOn = true;
            } else {
                if (this.settings.$masonryOn) {
                    this.settings.$container.masonry('destroy');
                }

                return this.settings.$masonryOn = false;
            }
        },
        updateDocumentWidth: function () {
            this.settings.$documentWidth = $(document).width();
        },
        runMasonry: function () {
            this.settings.$container.masonry({
                itemSelector: this.settings.$itemSelector,
                columnWidth: this.settings.$columnWidth,
                isFitWidth: true,
                isAnimated: true
            });
        }
    };
    droMasonry.init();
    $(window).resize(function () {
        droMasonry.updateDocumentWidth();
        droMasonry.init();

    });
})(jQuery);
