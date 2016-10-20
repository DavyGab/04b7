$( document ).ready(function() {
    onResize();
});

$( window ).resize(function() {
    onResize();
});

function onResize() {
    var w_height = $( window ).height();
    var max_height = Math.max($( "#text_home" ).height() + 100, w_height);
    $("#wrap").height(max_height);
    $("header").height(max_height);

    var top = ((w_height - $( "#text_home" ).height()) / 1.8);
    top = top < 70 ? 70 : top;
    $( "#text_home" ).css({ top: top  + 'px'});
}