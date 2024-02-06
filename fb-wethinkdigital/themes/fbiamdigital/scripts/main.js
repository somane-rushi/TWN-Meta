'use strict';

function _typeof(obj) {
  if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") {
    _typeof = function _typeof(obj) {
      return typeof obj;
    };
  } else {
    _typeof = function _typeof(obj) {
      return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj;
    };
  }
  return _typeof(obj);
}

function _classCallCheck(instance, Constructor) {
  if (!(instance instanceof Constructor)) {
    throw new TypeError("Cannot call a class as a function");
  }
}

function _defineProperties(target, props) {
  for (var i = 0; i < props.length; i++) {
    var descriptor = props[i];
    descriptor.enumerable = descriptor.enumerable || false;
    descriptor.configurable = true;
    if ("value" in descriptor) descriptor.writable = true;
    Object.defineProperty(target, descriptor.key, descriptor);
  }
}

function _createClass(Constructor, protoProps, staticProps) {
  if (protoProps) _defineProperties(Constructor.prototype, protoProps);
  if (staticProps) _defineProperties(Constructor, staticProps);
  return Constructor;
}

(function($, Backbone) {
  var App = App || {};
  var MQ_BREAKPOINTS = {
    MD: '(min-width: 48em)'
  };
  App.FunfactsView = Backbone.View.extend({
    initialize: function initialize() {
      var $el = this.$el;
      this.$('.c-funfact__heading').each(function() {
        // Animate only if there's numbers
        if ($(this).text().match(/([\d|\.]+)/) !== null) {
          $(this).css('visibility', 'hidden');
          $(this).one('inview', function() {
            $(this).css('visibility', 'visible');
            var number = $(this).text().match(/([\d|\.]+)/).pop(); // Get the mantissa length to fix the decimal places for animating, e.g. 1.45

            var mantissaLength = number.indexOf('.') >= 0 ? number.split('.').pop().length : 0;
            $(this).html(DOMPurify.sanitize($(this).text().replace(/([\d|\.]+)/, '<span>$1</span>')));
            $(this).prop('counter', 0).animate({
              counter: $(this).find('span').text()
            }, {
              duration: 1500,
              easing: 'swing',
              step: function step(now) {
                $(this).find('span').text(now.toFixed(mantissaLength));
              }
            });
          });
        }
      });
      this.$el.flickity({
        groupCells: true,
        adaptiveHeight: false,
        wrapAround: false,
        imagesLoaded: true,
        on: {
          resize: function resize() {
            $el.toggleClass('c-funfacts--is-single-slide', this.slides.length < 2);
            this.cells.forEach(function(slide) {
              return slide.element.style.height = '';
            });
            var heights = this.cells.map(function(slide) {
                return slide.element.offsetHeight;
              }),
              max = Math.max.apply(Math, heights);
            this.cells.forEach(function(slide) {
              return slide.element.style.height = "".concat(max, "px");
            });
          }
        }
      }).flickity('resize');
    }
  });
  App.SingleGalleryView = Backbone.View.extend({
    initialize: function initialize() {
      var $el = this.$el;
      $('.c-single-gallery').flickity({
        groupCells: true,
        wrapAround: false,
        draggable: '>1',
        cellAlign: 'left',
        imagesLoaded: true,
        on: {
          resize: function resize() {
            $el.toggleClass('c-single-gallery--is-single-slide', this.slides.length < 2);
          }
        }
      }).flickity('resize');
    }
  });
  App.InlineSelectView = Backbone.View.extend({
    initialize: function initialize() {
      this.$el.select2({
        minimumResultsForSearch: -1,
        // hides search box
        dropdownAutoWidth: true,
        width: 'auto',
        theme: 'default select2-container--inline'
      });
      this.$el.filter('[data-onchangesubmit]').on('select2:select', function() {
        $(this).closest('form').submit();
      });
    }
  });
  App.NavMenuView = Backbone.View.extend({
    el: '.c-site-header',
    events: {
      'click .c-site-header__nav-toggle': 'toggleNav'
    },
    toggleNav: function toggleNav() {
      this.$el.toggleClass('c-site-header--show-nav');
    }
  });
  App.ModalView = Backbone.View.extend({
    el: '.c-modal',
    events: {
      'click .c-modal__btn-close': 'close',
      'click': 'clickOutside'
    },
    open: function open() {
      this.$el.addClass('c-modal--show');
      $('body').addClass('u-no-scroll');
    },
    close: function close() {
      this.$el.removeClass('c-modal--show');
      $('body').removeClass('u-no-scroll');
      this.trigger('fbiad.resources-form-close');
    },
    clickOutside: function clickOutside(e) {
      if (!$(e.target).closest('.c-modal__body').length) {
        this.close();
      }
    }
  });
  App.ResourceFormSuccessView = Backbone.View.extend({
    el: '.c-resources-thanks',
    template: $('#tmpl-resources-form-thanks').html(),
    events: {
      'click .c-resources-thanks__btn-action': 'exit'
    },
    initialize: function initialize(props) {
      this.modal = props.modal;
      this.form = props.form;
    },
    render: function render() {
      this.$el.html(DOMPurify.sanitize(_.template(this.template)()), {
        SAFE_FOR_JQUERY: true,
        ADD_ATTR: ['download']
      });
    },
    exit: function exit() {
      this.modal.close();
      this.destroy();
    },
    destroy: function destroy() {
      this.$el.empty();
    }
  });
  App.ResourcesFormView = Backbone.View.extend({
    el: '.c-resources-form',
    events: {
      'close': 'close'
    },
    initialize: function initialize(props) {
      var _this = this;

      this.modal = props.modal;
      this.successView = new App.ResourceFormSuccessView({
        modal: this.modal,
        form: this
      });
      /**
       * Bind floating fields effect
       */

      this.fields = _.map(this.$('.c-resources-form__field--floating .c-resources-form__input'), function(el) {
        return new App.FloatingInputView({
          el: el
        });
      });
      /**
       * Customize jquery validate
       */

      if (typeof jQuery.validator === 'function') {
        // Add custom rules for validator
        jQuery.validator.addMethod('lettersonly', function(value, element) {
          return this.optional(element) || /^[a-z]+$/i.test(value);
        }, 'Please enter a valid value.');
        jQuery.extend(jQuery.validator.messages, {
          required: 'This field is required.',
          email: 'Please enter a valid email address.'
        }); //Sets a custom email pattern for the built-in email validation rule.

        jQuery.validator.methods.email = function(value, element) {
          return this.optional(element) || /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(value);
        };
      }

      this.$el.validate({
        rules: {
          first_name: {
            required: true,
            minlength: 2,
            lettersonly: true
          },
          last_name: {
            required: true,
            minlength: 2,
            lettersonly: true
          },
          email: {
            required: true,
            email: true
          },
          company: {
            required: true,
            minlength: 2
          },
          job_title: {
            required: true,
            minlength: 2
          },
          agree: 'required'
        },
        errorElement: 'span',
        errorPlacement: function errorPlacement($error, $element) {
          if (!$element.is('[type="checkbox"]')) {
            $element.siblings('.c-resources-form__message').append(DOMPurify.sanitize($error[0], {
              SAFE_FOR_JQUERY: true
            }));
          }
        },
        highlight: function highlight(element) {
          $(element).closest('.c-resources-form__field').addClass('c-resources-form__field--error');
        },
        unhighlight: function unhighlight(element) {
          $(element).closest('.c-resources-form__field').removeClass('c-resources-form__field--error');
        },
        submitHandler: function submitHandler() {
          _this.$el.addClass('c-resources-form--loading');

          _this.$('.c-resources-form__btn-submit').addClass('c-btn--loading').attr('disabled', 'disabled');

          _this.$el.ajaxSubmit({
            dataType: 'json',
            data: {
              action: 'resources_access_lead_submit'
            },
            clearForm: true,
            success: _.bind(_this.handleSubmitSuccess, _this)
          });
        }
      });
      this.modal.on('fbiad.resources-form-close', function() {
        _this.resetForm();

        _this.successView.destroy();
      });
    },
    handleSubmitSuccess: function handleSubmitSuccess(responseData, status) {
      if (status === 'success' && responseData.status === 'success') {
        this.successView.render();
        this.$('.c-resources-form__btn-submit').removeClass('c-btn--loading').removeAttr('disabled', 'disabled');
        this.$el.removeClass('c-resources-form--loading').addClass('c-resources-form--success');
      } else {
        console.warn('An error occurred when submitting the form.', responseData.status, responseData.message);
      }
    },
    resetForm: function resetForm() {
      this.$el.removeClass('c-resources-form--success').validate().resetForm(); // Trigger the blur function after resetting for floating fields

      _.each(this.fields, function(f) {
        return f.$el.trigger('blur');
      });
    }
  });
  App.ResourcesBannerView = Backbone.View.extend({
    el: '.c-resources-banner',
    events: {
      'click .c-resources-banner__cta': 'openLeadForm'
    },
    initialize: function initialize() {
      this.modal = new App.ModalView();
      this.form = new App.ResourcesFormView({
        modal: this.modal
      });
    },
    openLeadForm: function openLeadForm(e) {
      e.preventDefault();
      this.modal.open();
      return false;
    }
  });
  App.ResourcesVideoPlayerView = Backbone.View.extend({
    el: '.c-resources-video-player',
    events: {
      'click .c-resources-video-player__btn-close': 'close',
      'click': 'clickOutside'
    },
    initialize: function initialize() {
      this.videoEl = this.$('video').get(0);
      enableInlineVideo(this.videoEl);
    },
    open: function open(videoSrc, playOnStart) {
      this.$('video').empty();
      var videoSourceEl = document.createElement('source'); // Added '#t=0.1' to fix iOS showing white on videos before user hit play

      videoSourceEl.src = videoSrc + '#t=0.1';
      videoSourceEl.type = 'video/mp4';
      this.videoEl.appendChild(videoSourceEl);
      this.videoEl.load();
      this.$el.addClass('c-resources-video-player--show');
      $('body').addClass('u-no-scroll');

      if (playOnStart) {
        try {
          this.videoEl.play();
        } catch (e) { // cannot autoplay due to browser restrictions
        }
      }
    },
    close: function close() {
      this.videoEl.pause();
      this.videoEl.currentTime = 0;
      this.$el.removeClass('c-resources-video-player--show');
      $('body').removeClass('u-no-scroll');
    },
    clickOutside: function clickOutside(e) {
      if (!$(e.target).closest('.c-resources-video-player__content').length) {
        this.close();
      }
    }
  });

  var ResourcesListing =
    /*#__PURE__*/
    function() {
      function ResourcesListing() {
        _classCallCheck(this, ResourcesListing);

        this.$el = $('.c-listing--resources');

        if (!this.$el.length) {
          return;
        }

        this.player = new App.ResourcesVideoPlayerView();
        this.bindEvents();
      }

      _createClass(ResourcesListing, [{
        key: "bindEvents",
        value: function bindEvents() {
          var _this2 = this;

          var targetElemClass = '.c-listing-item--resources[data-video-src]';
          this.$el.on('click', targetElemClass, this.openPlayer.bind(this));
          this.$el.on('mouseenter', targetElemClass, this.handleMouseEnter.bind(this));
          this.$el.on('mouseleave', targetElemClass, this.handleMouseLeave.bind(this));

          if (!Modernizr.mq(MQ_BREAKPOINTS.MD)) {
            $('body').on('inview', '.c-listing-item__img[data-preview-img]', function(e, isInView) {
              var $elem = $(e.currentTarget).closest('.c-listing-item');

              if (isInView) {
                _this2.playThumbnailPreview($elem);
              } else {
                _this2.stopThumbnailPreview($elem);
              }
            });
          }
        }
      }, {
        key: "openPlayer",
        value: function openPlayer(e) {
          e.preventDefault();
          var $elem = $(e.currentTarget);
          var videoSrc = $elem.data('videoSrc');
          this.player.open(videoSrc, true);
          return false;
        }
      }, {
        key: "handleMouseEnter",
        value: function handleMouseEnter(e) {
          var $elem = $(e.currentTarget);

          if (Modernizr.mq(MQ_BREAKPOINTS.MD)) {
            this.playThumbnailPreview($elem);
          }
        }
      }, {
        key: "handleMouseLeave",
        value: function handleMouseLeave(e) {
          var $elem = $(e.currentTarget);

          if (Modernizr.mq(MQ_BREAKPOINTS.MD)) {
            this.stopThumbnailPreview($elem);
          }
        }
      }, {
        key: "playThumbnailPreview",
        value: function playThumbnailPreview($elem) {
          var _this3 = this;

          var _playThumbnailPreview = function _playThumbnailPreview($elem, src) {
            $elem.find('.c-listing-item__thumbnail-preview').css('background-image', "url(".concat(src, ")"));
          };

          this.setThumbnailPreviewActive($elem, true);
          var previewImgSrc = $elem.find('.c-listing-item__img').data('previewImg');

          if (typeof previewImgSrc === 'undefined') {
            return;
          }

          if (!this.isThumbnailPreviewLoading($elem) && !this.isThumbnailPreviewLoaded($elem)) {
            this.setThumbnailPreviewLoading($elem, true);
            var previewImgElem = new Image();
            $(previewImgElem).on('load', function() {
              _this3.setThumbnailPreviewLoading($elem, false);

              _this3.setThumbnailPreviewLoaded($elem, true); // Play only if mouse enter


              if (_this3.isThumbnailPreviewActive($elem)) {
                _playThumbnailPreview($elem, previewImgSrc);
              }
            }).on('error', function() {
              _this3.setThumbnailPreviewLoading($elem, false);

              console.error("Cannot load image: ".concat(previewImgSrc));
            }).attr('src', previewImgSrc);
          } else {
            _playThumbnailPreview($elem, previewImgSrc);
          }
        }
      }, {
        key: "stopThumbnailPreview",
        value: function stopThumbnailPreview($elem) {
          this.setThumbnailPreviewActive($elem, false);
        }
      }, {
        key: "setThumbnailPreviewLoading",
        value: function setThumbnailPreviewLoading($elem, state) {
          $elem.toggleClass('c-listing-item--loading', state);
        }
      }, {
        key: "isThumbnailPreviewLoading",
        value: function isThumbnailPreviewLoading($elem) {
          return $elem.hasClass('c-listing-item--loading');
        }
      }, {
        key: "setThumbnailPreviewLoaded",
        value: function setThumbnailPreviewLoaded($elem, state) {
          return $elem.toggleClass('c-listing-item--loaded', state);
        }
      }, {
        key: "isThumbnailPreviewLoaded",
        value: function isThumbnailPreviewLoaded($elem) {
          return $elem.hasClass('c-listing-item--loaded');
        }
      }, {
        key: "setThumbnailPreviewActive",
        value: function setThumbnailPreviewActive($elem, state) {
          return $elem.toggleClass('c-listing-item--active', state);
        }
      }, {
        key: "isThumbnailPreviewActive",
        value: function isThumbnailPreviewActive($elem) {
          return $elem.hasClass('c-listing-item--active');
        }
      }]);

      return ResourcesListing;
    }();

  App.InfiniteScrollView = Backbone.View.extend({
    el: '#infinite-handle',
    events: {
      'click': 'startFetch'
    },
    initialize: function initialize() {
      var _this4 = this;
      this.animateStaggerOnView = new App.AnimateStaggerOnView();

      if ('object' === _typeof(window.infiniteScroll)) {
        $('body').on('infinite-scroll-posts-end', function() {
          return _this4.$el.remove();
        }).on('post-load', _.bind(this.endFetch, this));
      }
    },
    startFetch: function startFetch() {
      this.$el.addClass('c-btn--loading');
    },
    endFetch: function endFetch() {
      this.$el.removeClass('c-btn--loading'); // This only bind events if animateStaggerOnView has been enabled

      this.animateStaggerOnView.bindEvents();
    }
  });
  App.FloatingInputView = Backbone.View.extend({
    events: {
      'focus': 'focus',
      'blur': 'blur'
    },
    focus: function focus() {
      this.$el.addClass('c-resources-form__input--focus');
    },
    blur: function blur(e) {
      if ($(e.currentTarget).val().length <= 0) {
        this.$el.removeClass('c-resources-form__input--focus');
      }
    }
  });
  App.AnimateStaggerOnView = Backbone.View.extend({
    el: 'body',
    chunks: [],
    enabled: false,
    initialize: function initialize() {
      this.maybeInitAnimations();
      $(window).on('resize', _.debounce(_.bind(this.maybeInitAnimations, this), 100));
    },
    maybeInitAnimations: function maybeInitAnimations() {
      if (Modernizr.mq(MQ_BREAKPOINTS.MD) && !this.enabled) {
        this.enabled = true;
        window.requestAnimationFrame(_.bind(this.animate, this));
        this.bindEvents();
      }
    },
    bindEvents: function bindEvents() {
      if (this.enabled) {
        this.$('.u-animated').not('.u-animated--animate').on('inview', _.bind(this.queueAnimatables, this));
      }
    },
    animate: function animate() {
      if (this.chunks.length > 0) {
        var delay = 0;

        _.each(this.chunks, function($elem, i) {
          var staggerDuration = i === 0 ? 0 : 100;

          if ($elem.closest('.c-listing').length > 0) {
            staggerDuration = i === 0 ? 0 : 200;
          }

          delay += staggerDuration;
          $elem.css(Modernizr.prefixed('transitionDelay'), "".concat(delay, "ms")).addClass('u-animated--animate');
        }); // clear chunks


        this.chunks = [];
      }

      window.requestAnimationFrame(_.bind(this.animate, this));
    },
    queueAnimatables: function queueAnimatables(e, isInView) {
      var $elem = $(e.currentTarget);

      if (isInView) {
        this.chunks.push($elem);
      }
    }
  });
  App.FooterPartnersItemView = Backbone.View.extend({
    tagName: 'a',
    className: 'c-site-footer-partners__list-item',
    attributes: function attributes() {
      var attributes = {
        'target': '_blank',
        'rel': 'noopener'
      };

      if (this.model) {
        attributes.href = this.model.get('link');
      }

      return attributes;
    },
    model: null,
    initialize: function initialize(props) {
      this.model = props.model;
      this.render();
    },
    render: function render() {
      var img = document.createElement('img');
      img.setAttribute('width', 'auto');
      img.setAttribute('height', '40');
      img.src = this.model.get('footer_logo');
      img.alt = this.model.get('title').rendered;
      this.el.appendChild(img);
    }
  });
  App.FooterPartnersView = Backbone.View.extend({
    el: '.c-site-footer-partners',
    initialize: function initialize() {
      this.$list = this.$('.c-site-footer-partners__list');

      if ((typeof wp === "undefined" ? "undefined" : _typeof(wp)) === 'object' && _typeof(wp.api) === 'object' && typeof wp.api.collections.Partner === 'function') {
        this.collection = new wp.api.collections.Partner();
        this.listenTo(this.collection, 'sync', this.render); // Based on vip_get_random_posts()

        this.collection.fetch({
          data: {
            per_page: 100
          }
        });
      }
    },
    render: function render() {
      var _this5 = this;

      this.$list.empty();
      var collection = this.collection.chain().reject(function(model) {
        return model.get('footer_logo').length === 0;
      }).sample(5);

      if (!collection.isEmpty().value()) {
        this.$el.show();
        collection.each(function(model) {
          var itemView = new App.FooterPartnersItemView({
            model: model
          });

          _this5.$list.get(0).appendChild(itemView.el);
        });
      } else {
        this.$el.hide();
      }
    }
  });
  App.SiteSelector = Backbone.View.extend({
    el: '.c-site-selector',
    events: {
      'click .menu-item-has-children': 'toggleDisplay'
    },
    initialize: function initialize() {
      var _this6 = this;

      $(document).on('click', function(e) {
        if (!$(e.target).closest(_this6.$('.menu-item--show')).length) {
          _this6.$('.menu-item--show').removeClass('menu-item--show');
        }
      });
    },
    toggleDisplay: function toggleDisplay(e) {
      this.$(e.target).parent().toggleClass('menu-item--show');
    }
  });

  App.VideoHightlightsView = Backbone.View.extend({
        events: {
            'click .c-video-hightlights-item__thumbnail-icon': 'openPlayer'
        },
        initialize: function initialize() {
            if ($('.c-video-hightlights-item').length > 1) {
                var _this2 = this;
                var $el = this.$el;

                $('.c-home-section__video').flickity({
                    groupCells: '50%',
                    wrapAround: false,
                    draggable: '>1',
                    cellAlign: 'left',
                    imagesLoaded: true,
                    prevNextButtons: false,
                    contain: false,
                    lazyLoad: 2,
                    on: {
                        resize: function resize() {}
                    }
                }).flickity('resize');
            } else if ($('.c-video-hightlights-item').length == 1) {
                $('.c-video-hightlights-item').addClass('is-selected');
            }
            

            this.player = new App.ResourcesVideoPlayerView();
        },
        openPlayer: function openPlayer(e) {
            var videoSrc = $(e.target).parents('.c-video-hightlights-item').data('video-url');
            console.log(videoSrc);
            this.player.open(videoSrc, true);
        }
    });
  /**
   * Initialize application
   */

  _.each($('.c-funfacts'), function(el) {
    return new App.FunfactsView({
      el: el
    });
  });

  _.each($('.c-single-gallery'), function(el) {
    return new App.SingleGalleryView({
      el: el
    });
  });

  _.each($('.c-select'), function(el) {
    return new App.InlineSelectView({
      el: el
    });
  });

  _.each($('.c-home-section--video-highlights'), function(el) {
      return new App.VideoHightlightsView({
          el: el
      })
  });

  new App.NavMenuView();
  new App.SiteSelector();
  new App.ResourcesBannerView();
  new App.FooterPartnersView();
  new App.InfiniteScrollView();
  new ResourcesListing();
})(jQuery, Backbone);
