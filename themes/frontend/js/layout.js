var robo_layout = {};
robo_layout.render_avatar = function(selector) {
    var items = $(selector);
    if ($(items).size() == 0) {
        return false;
    }
    $(items).each(function() {
        var img = $(this).find("img:first");
        var frame_width = parseInt($(this).width());
        var frame_height = parseInt($(this).height());
        var img_width = parseInt($(img).width());
        var img_height = parseInt($(img).height());
        var direction = "left";
        if (img_width >= img_height) {
            $(img).height(frame_height + "px");
            $(img).width("auto");
        } else {
            $(img).width(frame_width + "px");
            $(img).height("auto");
            direction = "top";
        }
        img = $(this).find("img:first");
        img_width = parseInt($(img).width());
        img_height = parseInt($(img).height());
        if (img_width < frame_width) {
            space = frame_width - img_width;
            $(img).height((img_height + space) + "px");
            $(img).width("auto");
        }
        img_width = parseInt($(img).width());
        img_height = parseInt($(img).height());
        if (img_height < frame_height) {
            space = frame_height - img_height;
            $(img).width((img_width + space) + "px");
            $(img).height("auto");
        }
        img_width = parseInt($(img).width());
        img_height = parseInt($(img).height());
        var mgl = Math.round((img_width - frame_width) / 2);
        var mgt = Math.round((img_height - frame_height) / 2);
        if (direction == "left") {
            $(img).css({"position": "relative", "left": "-" + mgl + "px"});
        } else {
            $(img).css({"position": "relative", "top": "-" + mgt + "px"});
        }
    });
    return false;
};

robo_layout.render_frame = function(selector, ratio, direction, auto_render) {
    var items = $(selector);
    if ($(items).size() == 0) {
        return false;
    }
    ratio = ratio.split(":");
    if (direction == null || direction == undefined) {
        direction = "height";
    }
    if (auto_render == null || auto_render == undefined) {
        auto_render = false;
    }
    if (ratio.length != 2) {
        alert('[robo_layout.render_frame] method call errors: invalid ratio parameter');
        return false;
    }
    $(items).each(function() {
        $(this).width("auto");
        var frame_width = parseInt($(this).width());
        var frame_height = parseInt($(this).height());
        if (direction == "height") {
            var new_frame_height = Math.floor((frame_width * parseInt(ratio[1])) / parseInt(ratio[0]));
            $(this).height(new_frame_height + "px");
        } else {
            var new_frame_width = Math.floor((frame_height * parseInt(ratio[0])) / parseInt(ratio[1]));
            $(this).width(new_frame_width + "px");
        }
        $(this).find("img").attr("align", "center");
    });
    if (auto_render) {
        robo_layout.render_avatar(selector);
    }
    return false;
};

robo_layout.init = function() {
    robo_layout.render_frame('.frame-32', '3:2');
    return false;
};
