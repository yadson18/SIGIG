$(".plType").val(1);

$(".planeType").on("click", function(){
    $(".plType").val($(this).val());
    if($(".plType").val() == 1){
        $("#mensal").addClass("hide");
        $("#mensal").removeClass("show");
        $("#anual").addClass("show");
        $("#anual").removeClass("hide");
    }
    else{
        $("#mensal").addClass("show");
        $("#mensal").removeClass("hide");
        $("#anual").addClass("hide");
        $("#anual").removeClass("show");
    }
});