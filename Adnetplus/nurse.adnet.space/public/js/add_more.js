$(document).ready(function(){
    for(let i=1; i<=8; i++) {
        $("#btn-add-more-" + i).click(function(){
            $("#table-" + i + " tbody tr:last-child").before("<tr><td><input class='form-control' type='text'/></td><td><input class='form-control' type='text'/></td></tr>");
        });
    }
});