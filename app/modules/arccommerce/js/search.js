function sort(mode) {
    var urlRaw = window.location.href.split('?')[0];
    var url = new URL(window.location.href);
    var search = url.searchParams.get("search");
    
    if (search == null) {
        window.location.href = urlRaw + "?sort=" + mode;
    } else {
        window.location.href = urlRaw + "?search=" + search + "&sort=" + mode;
    }
}

function doSearch() {
    var urlRaw = window.location.href.split('?')[0];
    var url = new URL(window.location.href);
    var sort = url.searchParams.get("sort");
    
    if (sort == null) {
        window.location.href = urlRaw + "?search=" + $("#search").val();
    } else {
        window.location.href = urlRaw + "?search=" +  $("#search").val() + "&sort=" + sort;
    }
}

function clearSearch() {
    var urlRaw = window.location.href.split('?')[0];
    window.location.href = urlRaw;
}