// Template Name: Bookstore
// Template URL: https://techpedia.co.uk/template/book_store
// Description:  Bookstore - Sports Club Html Template
// Version: 1.0.0

(function (window, document, $, undefined) {
  "use strict";
  var Init = {
    i: function (e) {
      Init.s();
      Init.methods();
    },
    s: function (e) {
      (this._window = $(window)),
        (this._document = $(document)),
        (this._body = $("body")),
        (this._html = $("html"));
    },
    methods: function (e) {
      Init.w();
      Init.ShareLink();
      Init.BackToTop();
      Init.preloader();
      Init.jsSlider();
      Init.searchToggle();
      Init.quantityHandle();
      Init.wishlistButton();
      Init.countdownInit(".countdown", "2024/12/01");
      Init.initializeSlick();
      Init.formValidation();
      Init.contactForm();
    },

    w: function (e) {
      this._window.on("load", Init.l).on("scroll", Init.res);
    },


    ShareLink: function() {

      const shareLinks = document.querySelectorAll('.share-link');

      shareLinks.forEach(link => {
        link.addEventListener('click', function (event) {
          event.preventDefault();

          const platform = this.getAttribute('data-platform');
          const url = window.location.href; // URL of the current page
          const title = document.title; // Page title
          const text = encodeURIComponent(`${title}`); // Text to share with page title
          let shareUrl = '';

          switch (platform) {
            case 'facebook':
              shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${url}&quote=${text}`;
              break;
            case 'whatsapp':
              shareUrl = `https://api.whatsapp.com/send?text=${text}%20${url}`;
              break;
            case 'twitter':
              shareUrl = `https://twitter.com/intent/tweet?text=${text}&url=${url}`;
              break;
            default:
              return;
          }

          window.open(shareUrl, '_blank', 'noopener,noreferrer');
        });
      });
    },

    BackToTop: function () {
      var btn = $("#backto-top");
      $(window).on("scroll", function () {
        if ($(window).scrollTop() > 300) {
          btn.addClass("show");
        } else {
          btn.removeClass("show");
        }
      });
      btn.on("click", function (e) {
        e.preventDefault();
        $("html, body").animate(
          {
            scrollTop: 0,
          },
          "300"
        );
      });
    },

    preloader: function () {
      setTimeout(function () {
        $("#preloader").hide("slow");
      }, 2000);
    },
    jsSlider: function () {
      if ($(".js-slider").length) {
        $(".js-slider").ionRangeSlider({
          skin: "big",
          type: "double",
          grid: false,
          min: 0,
          max: 100,
          from: 20,
          to: 80,
          hide_min_max: true,
          hide_from_to: true,
        });
      }
    },

    searchToggle: function () {
      if ($('.search-form').length) {
        $('.search-btn').on('click', function () {
          if ($('.search-form').hasClass('non-active')) {
            $('.search-form').removeClass('non-active');
          } else {
            $('.search-form').addClass('non-active');
          }
          $(this).find("i").toggleClass("fa-search fa-times");
          return false;
        });
      }
    }, 

    quantityHandle: function () {
      $(".decrement").on("click", function () {
        var qtyInput = $(this).closest(".quantity-wrap").children(".number");
        var qtyVal = parseInt(qtyInput.val());
        if (qtyVal > 0) {
          qtyInput.val(qtyVal - 1);
        }
      });
      $(".increment").on("click", function () {
        var qtyInput = $(this).closest(".quantity-wrap").children(".number");
        var qtyVal = parseInt(qtyInput.val());
        qtyInput.val(parseInt(qtyVal + 1));
      });
    },

    wishlistButton: function () {
      if ($(".wishlist-icon").length) {
        $('.wishlist-icon').on('click', function() {
          $(this).find('.fal').toggleClass('fas');
          return false;
        })
      }
    },


    initializeSlick: function (e) {
      if ($(".books-slider").length) {
        $(".books-slider").slick({
          slidesToShow: 4,
          slidesToScroll: 1,
          autoplay: true,
          autoplaySpeed: 3000,
          dots: true,
          arrows: false,
          centerPadding: "0",
          
          cssEase: "linear",
          responsive: [
            {
              breakpoint: 1399,
              settings: {
                slidesToShow: 3,
              },
            },
            {
              breakpoint: 992,
              settings: {
                slidesToShow: 2,
              },
            },
            {
              breakpoint: 767,
              settings: {
                slidesToShow: 2,
                dots: false,
              },
            },
            {
              breakpoint: 575,
              settings: {
                slidesToShow: 1,
                dots: false,
              },
            },
          ],
        });
      }
      if ($(".testimonials-area").length) {
        $(".testimonials-area").slick({
          slidesToShow: 1,
          slidesToScroll: 1,
          autoplay: true,
          autoplaySpeed: 3000,
          dots: true,
          arrows: true,
          centerPadding: "0",
          // cssEase: "linear",
          fade: true,
          responsive: [
            {
              breakpoint: 1399,
              settings: {
                slidesToShow: 1,
              },
            },
            {
              breakpoint: 992,
              settings: {
                slidesToShow: 1,
              },
            },
            {
              breakpoint: 575,
              settings: {
                arrows: false,
                slidesToShow: 1,
              },
            },
            {
              breakpoint: 399,
              settings: {
                arrows: false,
                dots: false,
              },
            },
          ],
        });
      }
      if ($(".trending-book-slider").length) {
        $(".trending-book-slider").slick({
          slidesToShow: 4,
          slidesToScroll: 1,
          autoplay: false,
          autoplaySpeed: 3000,
          dots: true,
          arrows: false,
          centerPadding: "0",
          cssEase: "linear",
          responsive: [
            {
              breakpoint: 1199,
              settings: {
                slidesToShow: 3,
              },
            },
            {
              breakpoint: 992,
              settings: {
                slidesToShow: 2,
                dots: false,
              },
            },
            {
              breakpoint: 767,
              settings: {
                slidesToShow: 2,
                dots: false,
              },
            },
            {
              breakpoint: 575,
              settings: {
                slidesToShow: 1,
                dots: false,
              },
            },
          ],
        });
      }
      if($("#topAuthorsCarousel").length) {

        $('#topAuthorsCarousel').owlCarousel({
          loop: true,
          margin: 10,
          nav: true,
          dots: false,
          autoplay: true,
          autoplayTimeout: 3000,
          autoplayHoverPause: true,
          responsive: {
            0: {
              items: 2
            },
            600: {
              items: 5
            },
            1000: {
              items: 10
            }
          }
        });
      }
       
      if ($(".weekly-deals-slider").length) {
        $(".weekly-deals-slider").slick({
          slidesToShow: 4,
          slidesToScroll: 1,
          autoplay: true,
          autoplaySpeed: 3000,
          dots: true,
          arrows: false,
          centerPadding: "0",
          cssEase: "linear",
          responsive: [
            {
              breakpoint: 1399,
              settings: {
                slidesToShow: 3,
              },
            },
            {
              breakpoint: 992,
              settings: {
                slidesToShow: 2,
              },
            },
            {
              breakpoint: 575,
              settings: {
                slidesToShow: 1,
              },
            },
          ],
        });
      }
      if ($(".horror-books-slider").length) {
        $(".horror-books-slider").slick({
          slidesToShow: 4,
          slidesToScroll: 1,
          autoplay: true,
          autoplaySpeed: 3000,
          dots: true,
          arrows: false,
          centerPadding: "0",
          cssEase: "linear",
          responsive: [
            {
              breakpoint: 1399,
              settings: {
                slidesToShow: 3,
              },
            },
            {
              breakpoint: 992,
              settings: {
                slidesToShow: 2,
                dots: false,
              },
            },
            {
              breakpoint: 575,
              settings: {
                slidesToShow: 2,
                dots: false,

              },
            },
          ],
        });
      }
    },
    wizardInit: function () {
      $('#form-wizard').smartWizard();
    },
    countdownInit: function (countdownSelector, countdownTime, countdown) {
      var eventCounter = $(countdownSelector);
      if (eventCounter.length) {
        eventCounter.countdown(countdownTime, function (e) {
          $(this).html(
            e.strftime(
              '<li><h6>%D</h6><h6>Days</h6></li>\
              <li><h6>%H</h6><h6>Hrs</h6></li>\
              <li><h6>%M</h6><h6>Min</h6></li>\
              <li><h6>%S</h6><h6>Sec</h6></li>'
            )
          );
        });
      }
    },

    formValidation: function () {
      if ($(".contact-form").length) {
        $(".contact-form").validate();
      }
    },

    contactForm: function () {
      $(".contact-form").on("submit", function (e) {
        e.preventDefault();
        if ($(".contact-form").valid()) {
          var _self = $(this);
          _self
            .closest("div")
            .find('button[type="submit"]')
            .attr("disabled", "disabled");
          var data = $(this).serialize();
          $.ajax({
            url: "./assets/mail/contact.php",
            type: "post",
            dataType: "json",
            data: data,
            success: function (data) {
              $(".contact-form").trigger("reset");
              _self.find('button[type="submit"]').removeAttr("disabled");
              if (data.success) {
                document.getElementById("message").innerHTML =
                  "<h3 class='bg-success text-white p-3 mt-3'>Email Sent Successfully</h3>";
              } else {
                document.getElementById("message").innerHTML =
                  "<h3 class='bg-success text-white p-3 mt-3'>There is an error</h3>";
              }
              $("#message").show("slow");
              $("#message").slideDown("slow");
              setTimeout(function () {
                $("#message").slideUp("hide");
                $("#message").hide("slow");
              }, 3000);
            },
          });
        } else {
          return false;
        }
      });
    },
  };
  Init.i();
})(window, document, jQuery);
