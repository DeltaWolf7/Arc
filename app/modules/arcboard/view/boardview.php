<div class="container-fluid">

<?php

    BoardViewItem::checkLifespans();
    $items = BoardViewItem::getItems();
    $count = 0;
foreach ($items as $item) {
    if ($count == 0) {
        echo "<div class=\"row\">";
    }

    echo "<div class=\"col-md-4\">"
    . "<div class=\"card\">";

    if (!empty($item->image)) {
        echo "<img class=\"card-img-top\" src=\"{$item->image}\" alt=\"{$item->title}\">";
    }
    echo "<div class=\"card-block\">";
    if (!empty($item->title)) {
        echo "<h4 class=\"card-title\">{$item->title}</h4>";
    }
    if (!empty($item->subtitle)) {
        echo "<h6 class=\"card-subtitle mb-2 text-muted\">{$item->subtitle}</h6>";
    }
    if (!empty($item->description)) {
        echo "<p class=\"card-text\">{$item->description}</p>";
    }
    if (!empty($item->links)) {
        $links = explode(",", $item->links);
        foreach ($links as $link) {
            $data = explode("|", $link);
            echo "<a href=\"{$data[0]}\" class=\"card-link\">{$data[1]}</a>";
        }
    }
    echo "<br />" . $item->getLifespan();
        
    echo "</div>"
    . "</div>"
    . "</div>";

    if ($count == 3) {
        echo "</div>";
    }

    $count++;
    if ($count > 3) {
        $count == 0;
    }
}
?>

</div>