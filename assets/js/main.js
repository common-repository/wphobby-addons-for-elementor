'use strict';

(function ($, w) {
    var $window = $(w);

    $.fn.getHappySettings = function() {
        return this.data('happy-settings');
    };

    function debounce(func, wait, immediate) {
        var timeout;
        return function() {
            var context = this, args = arguments;
            var later = function() {
                timeout = null;
                if (!immediate) func.apply(context, args);
            };
            var callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
        };
    }

    function initFilterable($scope, filterFn) {
        var $filterable = $scope.find('.hajs-gallery-filter');
        if ($filterable.length) {
            $filterable.on('click', 'button', function(event) {
                event.stopPropagation();

                var $current = $(this);
                $current
                    .parent()
                    .addClass('ha-filter-active')
                    .siblings()
                    .removeClass('ha-filter-active');
                filterFn($current.data('filter'));
            });
        }
    }

    function initPopupGallery($scope, selector, hasPopup, key) {
        if ( ! $.fn.magnificPopup ) {
            return;
        }

        if ( ! hasPopup ) {
            $.magnificPopup.close();
            return;
        }

        $scope.on('click', selector, function(event) {
            event.stopPropagation();
        });

        $scope.find(selector).magnificPopup({
            key: key,
            type: 'image',
            image: {
                titleSrc: function(item) {
                    return item.el.attr('title') ? item.el.attr('title') : item.el.find('img').attr('alt');
                }
            },
            gallery: {
                enabled: true,
                preload: [1,2]
            },
            zoom: {
                enabled: true,
                duration: 300,
                easing: 'ease-in-out',
                opener: function(openerElement) {
                    return openerElement.is('img') ? openerElement : openerElement.find('img');
                }
            }
        });
    }

    var HandleImageCompare = function($scope) {
        var $item = $scope.find('.hajs-image-comparison'),
            settings = $item.getHappySettings(),
            fieldMap = {
                on_hover: 'move_slider_on_hover',
                on_swipe: 'move_with_handle_only',
                on_click: 'click_to_move'
            };

        settings[fieldMap[settings.move_handle || 'on_swipe']] = true;
        delete settings.move_handle;

        $item.imagesLoaded().done(function() {
            $item.twentytwenty(settings);

            var t = setTimeout(function() {
                $window.trigger('resize.twentytwenty');
                clearTimeout(t);
            }, 400);
        });
    };

    var HandleJustifiedGallery = function($scope) {
        var $item = $scope.find('.hajs-justified-gallery'),
            settings = $item.getHappySettings(),
            hasPopup = settings.enable_popup;

        $item.justifiedGallery($.extend({}, {
            rowHeight: 150,
            lastRow: 'justify',
            margins: 10,
        }, settings));

        initPopupGallery($scope, '.ha-js-popup', hasPopup, 'justifiedgallery');

        initFilterable($scope, function(filter) {
            $item.justifiedGallery({
                lastRow: (filter === '*' ? settings.lastRow : 'nojustify'),
                filter: filter
            });
            var selector = filter !== '*' ? filter : '.ha-js-popup';
            initPopupGallery($scope, selector, hasPopup, 'justifiedgallery');
        });
    };

    $window.on('elementor/frontend/init', function() {
        var EF = elementorFrontend,
            EM = elementorModules;

        var Slick = EM.frontend.handlers.Base.extend({
            onInit: function () {
                EM.frontend.handlers.Base.prototype.onInit.apply(this, arguments);
                this.$container = this.$element.find('.whae-slick-wrapper');
                this.run();
            },

            isCarousel: function() {
                return this.$element.hasClass('ha-carousel');
            },

            getDefaultSettings: function() {
                return {
                    arrows: false,
                    dots: false,
                    checkVisible: false,
                    infinite: true,
                    slidesToShow: this.isCarousel() ? 3 : 1,
                    rows: 0,
                    prevArrow: '<button type="button" class="slick-prev"><i class="fa fa-chevron-left"></i></button>',
                    nextArrow: '<button type="button" class="slick-next"><i class="fa fa-chevron-right"></i></button>',
                }
            },

            onElementChange: function() {
                this.$container.slick('unslick');
                this.run();
            },

            getReadySettings: function() {
                var settings = {
                    dots: false,
                    arrows: true,
                    autoplay: true,
                    autoplaySpeed: 3000,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    prevArrow: '<button type="button" class="slick-whae-prev"><i class="fa fa-chevron-left"></i></button>',
                    nextArrow: '<button type="button" class="slick-whae-next"><i class="fa fa-chevron-right"></i></button>',
                };

                switch (this.getElementSettings('navigation')) {
                    case 'arrow':
                        settings.arrows = true;
                        break;
                    case 'dots':
                        settings.dots = true;
                        break;
                    case 'both':
                        settings.arrows = true;
                        settings.dots = true;
                        break;
                }

                if (this.isCarousel()) {
                    settings.slidesToShow = this.getElementSettings('slides_to_show') || 3;
                    settings.responsive = [
                        {
                            breakpoint: EF.config.breakpoints.lg,
                            settings: {
                                slidesToShow: (this.getElementSettings('slides_to_show_tablet') || settings.slidesToShow),
                            }
                        },
                        {
                            breakpoint: EF.config.breakpoints.md,
                            settings: {
                                slidesToShow: (this.getElementSettings('slides_to_show_mobile') || this.getElementSettings('slides_to_show_tablet')) || settings.slidesToShow,
                            }
                        }
                    ];
                }

                return $.extend({}, this.getDefaultSettings(), settings);
            },

            run: function() {
                this.$container.slick(this.getReadySettings());
            }
        });

        var handlersFnMap = {
            'whae-justified-gallery.default': HandleJustifiedGallery
        };

        $.each( handlersFnMap, function( widgetName, handlerFn ) {
            EF.hooks.addAction( 'frontend/element_ready/' + widgetName, handlerFn );
        });

        var handlersClassMap = {
            'whae-slider.default': Slick
        };

        $.each( handlersClassMap, function( widgetName, handlerClass ) {
            EF.hooks.addAction( 'frontend/element_ready/' + widgetName, function( $scope ) {
                EF.elementsHandler.addHandler( handlerClass, { $element: $scope });
            });
        });
    });


} (jQuery, window));
