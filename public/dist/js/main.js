!function () {
    "use strict";
    $(document).ready(function () {
        // $(".topbox").waypoint({
        //     handler: function (t) {
        //         $("#sticky-header").slideToggle()
        //     }, offset: -85
        // });
        $(function () {
            $("[rel='tooltip']").tooltip()
        }), $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        }), $(".c-scroll-to").click(function () {
            var t = $(this).data("scrollto"), e = $("#" + t);
            return $("html,body").animate({scrollTop: e.offset().top - 80}, 1e3), !1
        })
    })
}($), function () {
    "use strict";
    var t = {
        id: "avisa-gettingstarted",
        steps: [{
            title: "آویسا چیست؟",
            content: "آویسا، شامل مجموعه‌ای از کانال‌های آموزشی می‌باشد که اقدام به ارائه آموزش‌های مختلف می‌نمایند.",
            target: "header-brand",
            placement: "left"
        }, {
            title: "آموزشی که به دنبال آن هستید را بیابید!",
            content: "با وارد کردن کلیدواژه‌های مناسب شما به آموزش مورد نظر خود خواهید رسید.",
            target: "top-search-button",
            placement: "bottom"
        }, {
            title: "جدیدترین‌ها",
            content: "در این قسمت آخرین آموزش‌های اضافه شده به سیستم قابل مشاهده است که با ورود به هرکدام از آن‌ها اطلاعات تکمیلی را دریافت خواهید کرد.",
            target: "p-latest-lectures-heading",
            placement: "left"
        }, {
            title: "هنوز ثبت‌نام نکرده‌اید؟",
            content: "شما برای استفاده از آموزش‌های آویسا باید عضو سیستم باشید، استفاده از آویسا بسیار آسان است.",
            target: "avisa-steps",
            placement: "left"
        }],
        i18n: {closeTooltip: " ", nextBtn: "بعدی", prevBtn: "قبلی", doneBtn: "پایان"}
    };
    $("#helper-tour").click(function () {
        hopscotch.startTour(t)
    })
}(), function () {
    "use strict";
    var t = {
        user_id: $(".follow-button").data("userid"),
        channel_id: $(".follow-button").data("channelid"),
        _token: $("meta[name='csrf_token']").attr("content")
    };
    $("#channel-follower").click(function (e) {
        var o = $(this).data("state");
        "follow" === o ? $.post("/user/api/channel/follow", t, function (t) {
            $("#channel-follower").data("state", "unfollow"), $("#follower-text").text("دنبال نمیکنم")
        }) : $.post("/user/api/channel/unfollow", t, function (t) {
            $("#channel-follower").data("state", "follow"), $("#follower-text").text("دنبال کنید")
        })
    })
}(), $(function () {
    "use strict";
    $(".truncate").succinct({size: 60})
}), function () {
    "use strict";
    $(document).ready(function () {
        $("#sad-symbol").show()
    })
}($), function () {
    "use strict";
    $("#purchase-lecture").click(function () {
        var t = {amount: $("#required-cost").val(), _token: $("meta[name='csrf_token']").attr("content")};
        $.post("/user/api/payment/sendopen", t, function (t) {
            $("#res-num").val(t.res_num), $("#purchase-lecture-form").submit()
        })
    })
}($), function () {
    "use strict";
    $(".p-book-type-select input[type=radio]").click(function () {
        var t = $(".p-book-price").data("physicalprice"), e = $(".p-book-price").data("digitalprice"), o = $(this).val();
        if ("digital" == o) {
            var s = e;
            $(".p-book-price-value").html(persianJs(s.toString()).englishNumber().toString())
        } else if ("physical" == o) {
            var s = t;
            $(".p-book-price-value").html(persianJs(s.toString()).englishNumber().toString())
        }
    })
}($), function () {
    "use strict";
    $(".purchase-add-to-cart").click(function () {
        var t = $(this), e = {
            is_physical: t.data("isphysical"),
            lecture_id: t.data("lecture"),
            _token: $("meta[name='csrf_token']").attr("content")
        };
        $.post("/user/api/purchase/order", e, function (e) {
            var o = "/purchase/checkout", s = $("#template-added-to-cart").html(), n = _.template(s)({data: o});
            t.replaceWith(n)
        })
    })
}($), function () {
    "use strict";
    $(document).ready(function () {
        $(".c-carousel-courses, .c-carousel-packages").slick({
            slidesToShow: 3,
            slidesToScroll: 3,
            speed: 450,
            dots: !0,
            lazyLoad: "ondemand",
            infinite: !0,
            responsive: [{
                breakpoint: 1024,
                settings: {slidesToShow: 3, slidesToScroll: 3, infinite: !0, dots: !0}
            }, {breakpoint: 600, settings: {slidesToShow: 2, slidesToScroll: 2}}, {
                breakpoint: 480,
                settings: {slidesToShow: 1, slidesToScroll: 1}
            }]
        }), $(".c-carousel-books").slick({
            slidesToShow: 6,
            slidesToScroll: 6,
            speed: 450,
            dots: !0,
            lazyLoad: "ondemand",
            infinite: !0,
            responsive: [{
                breakpoint: 1024,
                settings: {slidesToShow: 5, slidesToScroll: 5, infinite: !0, dots: !0}
            }, {breakpoint: 600, settings: {slidesToShow: 4, slidesToScroll: 4}}, {
                breakpoint: 480,
                settings: {slidesToShow: 2, slidesToScroll: 2}
            }]
        }), $(".c-carousel-lives").slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            speed: 450,
            dots: !0,
            lazyLoad: "ondemand",
            infinite: !1,
            prevArrow: '<button type="button" class="slick-prev slick-white-arrow">Previous</button>',
            nextArrow: '<button type="button" class="slick-next slick-white-arrow">Next</button>',
            responsive: [{
                breakpoint: 1024,
                settings: {slidesToShow: 3, slidesToScroll: 3, infinite: !0, dots: !0}
            }, {breakpoint: 600, settings: {slidesToShow: 2, slidesToScroll: 2}}, {
                breakpoint: 480,
                settings: {slidesToShow: 1, slidesToScroll: 1}
            }]
        })
    })
}($), function () {
    "use strict";
    $(document).ready(function () {
        var t = $("#p-path-navigator");
        $(window).scroll(function () {
            $(window).scrollTop() > 350 ? t.addClass("p-path-navigator-stick") : $(window).scrollTop() < 351 && t.removeClass("p-path-navigator-stick")
        }), $("#p-path-navigator ul li a").each(function (t, e) {
            var o = $(this).data("scrollto"), s = "#" + o;
            $(s).waypoint({
                handler: function (t) {
                    console.log("yes"), $("*[data-scrollto=" + o + "]").parent("li").toggleClass("selected")
                }, offset: "95px"
            })
        })
    })
}($), function () {
    "use strict";
    $(document).ready(function () {
    })
}($), function () {
    "use strict";
    $(".c-box-live-more").click(function () {
        $(".c-box-live-more i").toggleClass("fa-caret-down fa-caret-up"), $(".c-box-live-more-cont").slideToggle()
    })
}($), function () {
    "use strict";
    $(".search-types-checkbox:checkbox").change(function () {
        var t = $(".search-types-checkbox:checkbox:checked").map(function () {
            return $(this).val()
        }).get(), e = t.join(",");
        console.log(e), $("#search-box-main-types").val(e)
    })
}($);