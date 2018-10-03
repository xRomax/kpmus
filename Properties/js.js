// Прокрутка страницы к нужному блоку через navbar
$(document).ready(function(){
	$("#menu").on("click",".a1",function(event){
		event.preventDefault();
		var id = $(this).attr('href'),
			top = $(id).offset().top;
		$('body,html').animate({scrollTop: top}, 1500);	
	});
   
    // Прокрутка вверх
    $(window).scroll(function(){
        if ($(this).scrollTop() > 200) $('.scrollup').fadeIn();
        else $('.scrollup').fadeOut();
    });
 
    $('.scrollup').click(function(){
        $("html, body").animate({ scrollTop: 0 }, 600);
        return false;
    });
    
    // Отправка форм
    $('#pagination').val(1);
    $('#pagination1').val(1);
    $('#page-size-show').val(10);
    $('#page-size-shown').val(10);
    $('#page-size-showp').val(10);
    $(".optionf").submit();
    
    $("#tab").change(function(){
        $('#pagination').val(1);
        $('#pagination1').val(1);
        $('#page-size-show').val(10);
        $('#page-size-shown').val(10);
        $('#page-size-showp').val(10);
        $(".showf").submit();
        $("#page-table").val($("#tab").val());
        $(".pagef").submit();
        
    });
    
    $(".pageb").click(function(){
        $(".showf").submit();
    });
    
    $(".renameb").click(function(){
        $(".renamef").submit().trigger('reset');
        $(".resultat12").css("display","block")
        $(".resultat12-toggle").css("display","none")
    });

    $(".act").change(function(){
        $("#ntable").val($("#tab").val());
        $(".fieldsf").submit();
    });
    
    $(".changeb").click(function(){
        $("#tablen").val($("#tab").val());
        $(".changef").submit().trigger('reset');
        $('.resultat2 .row .input-field .punkt label').removeClass('active');
        $('#pagination').val($('#pagination').val());
        $('#pagination1').val($('#pagination').val());
        $('#page-size-show').val($('#page-size').val());
        $('#page-size-shown').val($('#page-size').val());
        $('#page-size-showp').val($('#page-size').val());
    });
    
    $(".change-table-b").click(function(){
        $("#table-name").val($("#tab1").val());
        $(".change-table-f").submit();
        $(".change-table-fields-f").submit();
        $(".resultat11").css("display","block");
        $(".resultat11-toggle").css("display","none");
    });
    
    $(".show12").click(function(){
        $(".resultat12").css("display","none");
        $(".resultat12-toggle").css("display","block");
    });  
    
    $(".show11").click(function(){
        $(".resultat11").css("display","none");
        $(".resultat11-toggle").css("display","block");
    });    
    
    $(".show7").click(function(){
        $(".resultat7").css("display","none");
        $(".resultat7-toggle").css("display","block");
    });    
    
    $(".show6").click(function(){
        $(".resultat6").css("display","none");
        $(".resultat6-toggle").css("display","block");
    });
    
    $("#tab1").change(function(){
        $(".change-table-fields-f").submit();
    });
    
    $(".clearb").click(function(){
        $(".clearf").submit();
        $(".resultat7").css("display","block");
        $(".resultat7-toggle").css("display","none");
    });
    
    $(".delnewsb").click(function(){
        $(".delnewsf").submit().trigger('reset');
        $(".newsf").trigger('reset').submit();
    });
    
    $(".accessb").click(function(){
        $(".accessf").submit();
    });
    
    $(".delb").click(function(){
        $(".delf").submit();
        $(".resultat6").css("display","block");
        $(".resultat6-toggle").css("display","none");
    });
    
    $(".createb").click(function(){
        $(".createf").submit().trigger('reset');
        $("#number").val("").trigger('reset');
        $(".addfieldsf").submit();
    });  
    
    $("#number").keyup(function(Event){
        $(".addfieldsf").submit();
    });
    
    $(".newsb").click(function(){
        $(".newsf").submit().trigger('reset');
    });
    
    $("#allow").click(function(){
        $("#getaccess").val("allow");
    });
    
    $("#ban").click(function(){
        $("#getaccess").val("ban");
    });
    
    $(".regb").click(function(){
        $(".regf").submit();
    });    

    // Окно подтверждения
    $(".show").click(function(){
        $('.overlay').fadeIn();
    });  
    
    // Закрыть окно
    $('.close-window').click(function() { 
        $('.overlay').fadeOut();
    });

});
