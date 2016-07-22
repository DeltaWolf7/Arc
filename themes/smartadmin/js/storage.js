$( document ).ready(function() {
    if (localStorage.getItem("uBClassMenu") == null) {
        $("#uB").addClass("minified");
    } else {
        $("#uB").addClass(localStorage.getItem("uBClassMenu"));
    }
    if (localStorage.getItem("uBClassStyle") == null) {
        $("#uB").addClass("smart-style-5");
    } else {
        $("#uB").addClass(localStorage.getItem("uBClassStyle"));
    }
});

function setMenu(menu) {
    localStorage.setItem("uBClassMenu", menu);
    updateStyle();
}

function setStyle(style) {
    localStorage.setItem("uBClassStyle", style);
    updateStyle();
}

function updateStyle() {
    $("#uB").removeClass("smart-style-1 smart-style-2 smart-style-3 smart-style-4 smart-style-5 smart-style-6");
    $("#uB").removeClass("menu-on-top minified");
    $("#uB").addClass(localStorage.getItem("uBClassMenu"));
    $("#uB").addClass(localStorage.getItem("uBClassStyle"));
}