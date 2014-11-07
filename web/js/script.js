$(document).ready(function() {
    $(".projetcts_sousmenu").hide();
    $(".projetcts_sousmenu2").hide();
    $("#form_Lien").hide("slow");
    $("#form_Lien").prev().hide('slow');
    $("#form_Media").prev().hide("slow");
    $("#form_Media").hide("slow");        
    $("#form_MediaOther").prev().hide('slow');
    $("#form_MediaOther").hide('slow');
     $('.rte-zone').rte("css url", "toolbox images url");
    $("#form_Type").change(function(){
    if($(this).val()==1){
        $("#form_Lien").hide("slow");
        $("#form_Lien").prev().hide('slow');
        $("#form_Media").prev().hide("slow");
        $("#form_Media").hide("slow");        
        $("#form_MediaOther").prev().hide('slow');
        $("#form_MediaOther").hide('slow');
    }
    else if($(this).val()== 2){
         $("#form_Lien").prev().show("slow");   
         $("#form_Lien").show("slow");
         $("#form_Media").hide("slow");
         $("#form_Media").prev().hide('slow');
         $("#form_MediaOther").prev().hide('slow');
         $("#form_MediaOther").hide('slow');
        
    }
    else if($(this).val()== 3){
        $("#form_Lien").prev().hide('slow');
        $("#form_Lien").hide('slow');
        $("#form_MediaOther").prev().hide('slow');
        $("#form_MediaOther").hide('slow');
        $("#form_Media").prev().show("slow");
        $("#form_Media").show("slow");
    }
    else if($(this).val()== 4){
        $("#form_MediaOther").prev().show('slow');
        $("#form_MediaOther").show('slow');
        $("#form_Media").prev().hide("slow");
        $("#form_Media").hide("slow");
        $("#form_Lien").prev().hide('slow');
        $("#form_Lien").hide('slow');
    }
    else if($(this).val()== 5){
        $("#form_MediaOther").prev().hide('slow');
        $("#form_MediaOther").hide('slow');
        $("#form_Media").prev().hide("slow");
        $("#form_Media").hide("slow");
        $("#form_Lien").prev().hide('slow');
        $("#form_Lien").hide('slow');
    }
    })
    
    $("#search").css("display","none");

    $(".fleche").click(function(){
        $(".projetcts_sousmenu").slideUp("slow");
    });
    $(".fleche2").click(function(){
        $(".projetcts_sousmenu2").slideUp("slow");
    });
    $("#icon-search").one("click", function(){
        
        $(".lien-search").attr("onclick","document.searchForm.submit();");
        if($("#search").css("display")=="none"){

       $("#search").animate({
        width:"35%" ,
        left:"+=80",
        display:"block",   
        opacity:"toggle"
}, 1500 )
      
        } 
        return false;
});

    $(function() {
    $( ".datepicker" ).datepicker();
    });
    $(function() {
                $('#navigation a').stop().animate({'marginLeft':'-85px'},1000);

                $('#navigation > li').hover(
                    function () {
                        $('a',$(this)).stop().animate({'marginLeft':'-2px'},200);
                    },
                    function () {
                        $('a',$(this)).stop().animate({'marginLeft':'-85px'},200);
                    }
                );
            });
    $(".dropdown-toggle ").click(function(){
        $(".projetcts_sousmenu2").slideUp("slow");
        $(".projetcts_sousmenu").slideToggle("slow");
        //$("#wrap").empty().load("article.html");		
    });
    $(".dropdown-toggle2").click(function(){
    
        $(".projetcts_sousmenu").slideUp("slow");
        $(".projetcts_sousmenu2").slideToggle("slow");
       // $("#wrap").empty().load("../views/template/NotreAgence.twig");
 
    });
    var nb = 3;

    
 });
