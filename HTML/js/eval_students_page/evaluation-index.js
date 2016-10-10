var $tds = $("#radio_buttons td");

$tds.css("cursor", "pointer");

$tds.click(function(event){
    var $target = $(event.target);
    $target.children().eq(0).click();
});