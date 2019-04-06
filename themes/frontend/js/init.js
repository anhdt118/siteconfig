$(document).ready(function () {
    render_layout();
});
function render_layout() {
    // Hide Header on on scroll down
    var $nav = $("#nav-wp");
    var did_scroll;
    var last_scroll_top = 0;
    var delta = 5;
    var header_height = $nav.outerHeight();
    $(window).scroll(function() {
        did_scroll = true;
        if ($(this).scrollTop() != 0) {
            $('#scroll-top').fadeIn();
        } else {
            $('#scroll-top').fadeOut();
        }
    });
    setInterval(function() {
        if (did_scroll) {
            has_scrolled();
            did_scroll = false;
        }
    }, 250);
    function has_scrolled() {
        var st = $(this).scrollTop();
        // Make sure they scroll more than delta
        if(Math.abs(last_scroll_top - st) <= delta)
            return;
        // If they scrolled down and are past the navbar, add class .nav-up.
        // This is necessary so you never see what is "behind" the navbar.
        if (st > last_scroll_top && st > header_height){
            // Scroll Down
            $nav.removeClass('nav-down').addClass('nav-up');
        } else {
            // Scroll Up
            if(st + $(window).height() < $(document).height()) {
                $nav.addClass('nav-down').removeClass('nav-up');
            }
        }
        if (st < header_height) {
            $nav.removeClass('nav-down').removeClass('nav-up');
        }
        last_scroll_top = st;
    }
    $('[data-toggle="tooltip"]').tooltip();
    if ($("#input-search").size() > 0 && $("#btn-search").size() > 0) {
        $("#input-search").focus(function() {
            $(this).keypress(function(e) {
                if (e.keyCode == 13) {
                    $("#btn-search").trigger("click");
                }
                return true;
            });
        });
        $("#input-search").dblclick(function() {
            var action = BASE_URL;
            window.location = action;
        });
        $("#btn-search").click(function() {
            var keywords = render_keyword($("#input-search").val());
            if (keywords.toString().length > 0) {
                var action = BASE_URL + 'search/' + keywords + '?q=' + keywords;
                window.location = action;
            } else {
                window.location = BASE_URL;
            }
        });
        function render_keyword(keyword) {
            if (keyword == null) {
                return false;
            }
            keyword = keyword.toString();
            keyword = keyword.replaceAll(" ", "+", keyword);
            keyword = keyword.replaceAll("&", "+", keyword);
            keyword = keyword.replaceAll("*", "+", keyword);
            keyword = keyword.replaceAll("@", "+", keyword);
            keyword = keyword.replaceAll("#", "+", keyword);
            return keyword;
        }
        // JavaScript Document
        String.prototype.replaceAll = function(strTarget, strSubString){
            var strText = this;
            var intIndexOfMatch = strText.indexOf( strTarget );
            while (intIndexOfMatch != -1){
                strText = strText.replace(strTarget, strSubString)
                intIndexOfMatch = strText.indexOf(strTarget);
            }
            return( strText );
        }
    }
    var $menu_btn = $("#menu-btn");
    var $sidebar = $("#sidebar");
    var $page = $("#wrapper");
    $menu_btn.click(function() {
        $(this).toggleClass("active");
        $sidebar.toggleClass("active");
        $page.toggleClass("page-right");
        return false;
    });
    $("#sidebar ul > li > i").click(function() {
        $(this).toggleClass("fa-caret-up");
        $(this).parent().find(".mega-menu").toggle();
        return false;
    });
};
