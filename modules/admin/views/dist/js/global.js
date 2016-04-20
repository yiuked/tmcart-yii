/**
 * Created by Administrator on 2016/4/3.
 */
$(document).ready(function(){
    $(".ajax-toggle").click(function(){
        var e = $(this);
        $.ajax({
            url: 'index.php?r=admin/ajax/toggle',
            cache: false,
            data: "toggle=" + e.data('toggle') + "&model=" + e.data('model') + "&id=" + e.data('id') + "&primary=" + e.data("primary"),
            dataType: "json",
            success: function(data)
            {
                if (data.status == 'YES') {
                    if (e.find("span").attr('class').indexOf('ok') > 0 ) {
                        e.find("span").attr('class', e.find("span").attr('class').replace('ok', 'remove'))
                    } else {
                        e.find("span").attr('class', e.find("span").attr('class').replace('remove', 'ok'))
                    }
                }
            }
        });
    });
    $(".check-all").click(function(){
        var allCheck = $(this).prop("checked");
        $("input[name='"+$(this).data("items")+"']").each(function(){
            $(this).prop("checked",allCheck);
        })
    })
})
