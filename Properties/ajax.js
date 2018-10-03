$(document).ready(function(){
    $('.ajax').submit(function(event) {
        event.preventDefault();
        var a = $(this).attr('action');

        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(result) {
                switch (a) {
                    case 'show.php': $(".resultat1").html(result); break;
                    case 'changecols.php': $(".resultat1").html(result);  break;
                    case 'fields.php': $(".resultat2").html(result); break;
                    case 'reg.php': $(".resultat3").html(result); $(".regf").load("index.php .formreload"); break;
                    case 'news.php': $(".resultat4").html(result); break;
                    case 'addfields.php': $(".resultat5").html(result); break;
                    case 'deletetable.php': $(".resultat6").html(result); $(".optionf").submit(); break;
                    case 'createtable.php': $(".resultat13").html(result); $(".optionf").submit(); break;
                    case 'cleartable.php': $(".resultat7").html(result); break;
                    case 'option.php': $(".resultat8").html(result); break;
                    case 'accesstable.php': $(".resultat9").html(result); break;
                    case 'changetablefields.php': $(".resultat10").html(result); break;
                    case 'changetable.php': $(".resultat11").html(result); break;
                    case 'renametable.php': $(".resultat12").html(result); $(".optionf").submit(); break;
                    case 'pagetable.php': $(".resultat14").html(result); break;
                }
            },
        });
    });
});