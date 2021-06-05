<?php

    $pages = Page::searchPages($searchquery);
    $display = [];

    $groups[] = UserGroup::getByName('Guests');
    if (system\Helper::arcIsUserLoggedIn() == true) {
        $groups = array_merge($groups, system\Helper::arcGetUser()->getGroups());
    }

    foreach ($pages as $page) {
        if (Router::hasPermission($groups, $page->seourl) && $page->seourl != 'error' && $page->hidefrommenu != 1) {         
            $display[] = $page;
        }
    }

    if (count($display) > 0) {
        system\Helper::arcMarkSearch();
?>

<div class="card">
    <div class="card-body">
        <h2>Pages matching '<?php echo $searchquery; ?>'</h2>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr class="text-primary">
                        <th scope="col" style="width: 10px;"></th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
        foreach ($display as $page) {
            echo "<tr><td><i class=\"far fa-file\"></i></td><td><a href=\"{$page->seourl}\">{$page->title}</a></td><td>{$page->metadescription}</td></tr>";
        }
?>
                    </body>
            </table>
        </div>
    </div>
</div>
<?php
    }