

jQuery(function(){
    jQuery("#gal").jCarouselLite({
        btnNext: "#right_bot",
        btnPrev: "#left_bot"
    });
});
$(document).ready(function(){


    $('body').fadeTo(500, 1)

    $('#gal li').click(
        function(){
            var title = $(this).children('img').attr('title');
            $('#prod_title').html(title);
            if($(this).hasClass('active'))
            {
                $(this).addClass('active');
                var src = $(this).children('img').attr('src');
                $('#big_img').html('<img src="'+src+'" alt="" width="451" height="339" />');
            //      $('#big_img').css({'background':'url('+src+') no-repeat', 'background-size':'cover'});
            }
            else
            {
                $('#gal li[class=active]').removeClass('active');
                $(this).addClass('active');
                var src = $(this).children('img').attr('src');
                $('#big_img').html('<img src="'+src+'" alt="" width="451" height="339" />');
            //$('#big_img').css({'background':'url('+src+') no-repeat', 'background-size':'cover'});
            }
        })

    $('#gal li').hover(
        function(){
            if(($(this).attr('class'))=='active')
            {
                return false;
            }
            else
            {
                $(this).css({
                    'border':'border: 5px solid #0c92d7;'
                });
            }
        },
        function(){
            if(($(this).attr('class'))=='active')
            {
                return false;
            }
            else
            {
                $(this).css({
                    'border':'5px solid #000;'
                });
            }
        })

    $('#big_img_cont').click(function()
    {
        var scr_width= screen.width;
        $('#bg_grey').fadeTo(400, 1
        );
        var src_big_img = $('#big_img img').attr('src');
        $('#all_scr_img').css({
            'width':scr_width*0.549
        });
        $('#all_scr_img img').attr({
            'src':src_big_img
        }).css({
            'width':scr_width*0.549
        });

    })
    $('.prod_imgs img').click(function()
    {
        var scr_width= screen.width;
        $('#bg_grey').fadeTo(400, 1
        );
        var src_big_img = $(this).attr('src');
        $('#all_scr_img').css({
            'width':scr_width*0.549
        });
        $('#all_scr_img').html('<img src="'+src_big_img+'" alt="" />');
        $('#all_scr_img img').css({
            'width':scr_width*0.549
        });

    })
    $('#bg_grey').click(function()
    {
        $(this).hide( "drop", { direction: "down" }, 400 )
    })
    $(window).resize(function()
    {
        if($('#bg_grey').css('display')=='block')
        {
            var scr_width= screen.width;
            $('#all_scr_img').css({
                'width':scr_width*0.549
            });
            $('#all_scr_img img').css({
                'width':scr_width*0.549
            });
        }
        else
            return(false);
    })

    $('#add_img_but a').click(function(){
        $('#file_upl_form').toggle('normal', function(){
            if($('#file_upl_form').css('display')=='block')
            {
                $('#file_upl_form #file_title').addClass('required');
                $('#hiden').val('1');
            }
            else
            {
                $('#file_upl_form #file_title').removeClass('required');
                $('#hiden').val('0');
            }
        })
    })

    $('#sub_mail, #bg_adm form input[type="submit"], form input[type="submit"]').click(function()
    {
        error=0;
        $('.required').each(function(){
            $(this).css({
                'border':'1px solid #E2E2E2'
            })

            if($(this).attr('value')=='')
            {
                $(this).css({
                    'border':'1px solid red'
                })
                error =1;
            }
        })
        if (error ==0)
        {
            $('#mail_us, #bg_adm form input["submit"], .form_cl input[type="submit"]').submit()
        }
        else
            return false;
    })
    $('.del').click(function()
    {
        var new_href=$(this).attr('href')
        $(this).attr({
            'href':'javascript:void=0'
        })
        $('.gray_bg').css({
            'display':'block'
        })
        $('.warn a.confirm').attr({
            'href':new_href
        });
    })
    $('.cancel').click(function()
    {
        $('.gray_bg').css({
            'display':'none'
        })
    })
    $('#search').focus(function()
    {
        $(this).attr({
            'value':''
        })
    })
})