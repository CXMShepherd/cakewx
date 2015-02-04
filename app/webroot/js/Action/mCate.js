$(document).ready(function() {
	
});

$(".tpSelect").on("change", function() {
    var type = $(this).val();
    if(type == 1){
        $(".tpStore").show();
    } else{
        $(".tpStore").hide();
    }
});