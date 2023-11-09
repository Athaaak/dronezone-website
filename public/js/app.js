var menuHolder = document.getElementById("menuHolder");
var siteBrand = document.getElementById("siteBrand");
function menuToggle() {
    if (menuHolder.className === "drawMenu") menuHolder.className = "";
    else menuHolder.className = "drawMenu";
}
if (window.innerWidth < 426) siteBrand.innerHTML = "DRONEZONE";
window.onresize = function () {
    if (window.innerWidth < 420) siteBrand.innerHTML = "DRONEZONE";
    else siteBrand.innerHTML = "DRONEZONE";
};
$(document).ready(function () {
    $(".btn-group .btn").click(function () {
        var inputValue = $(this).find("input").val();
        if (inputValue != "all") {
            var target = $('table tr[data-status="' + inputValue + '"]');
            $("table tbody tr").not(target).hide();
            target.fadeIn();
        } else {
            $("table tbody tr").fadeIn();
        }
    });
    // Changing the class of status label to support Bootstrap 4
    var bs = $.fn.tooltip.Constructor.VERSION;
    var str = bs.split(".");
    if (str[0] == 4) {
        $(".label").each(function () {
            var classStr = $(this).attr("class");
            var newClassStr = classStr.replace(/label/g, "badge");
            $(this).removeAttr("class").addClass(newClassStr);
        });
    }
});
