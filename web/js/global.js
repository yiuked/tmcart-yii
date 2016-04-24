/**
 * Created by Administrator on 2016/4/9.
 */
$(document).ready(function(){
    $(".sidebar-fold").click(function(){
        if ($(".layout-body").hasClass("layout-sidebar-full")) {
            $.cookie('sidebar-fold', 'mini');
            $(".layout-body").removeClass("layout-sidebar-full").addClass("layout-sidebar-mini");
        } else {
            $.cookie('sidebar-fold', 'full');
            $(".layout-body").removeClass("layout-sidebar-mini").addClass("layout-sidebar-full");
        }
    });
    $(".layout-content-navbar-collapse .collapse-icon").click(function(){
        if ($(".layout-content").hasClass("navbar-open")) {
            $.cookie('layout-content', 'close');
            $(this).removeClass("open-status").addClass("close-status");
            $(".layout-content").removeClass("navbar-open");
        } else {
            $.cookie('layout-content', 'open');
            $(this).removeClass("close-status").addClass("open-status");
            $(".layout-content").addClass("navbar-open");
        }
    })
})