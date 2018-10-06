<div class="card">
    <div class="table table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Date</th>
                    <th scope="col">Title</th>
                    <th scope="col">Version</th>
                    <th scope="col">Actions</th>
                <tr>
            </thead>
            <tbody>
                <?php

                    $downloads = ArcDownload::getAllByDownloads();
                    foreach ($downloads as $download) {
                        echo "<tr>"
                            . "<td>{$download->id}</td>"
                            . "<td>" . system\Helper::arcConvertDateTime($download->date) . "</td>"
                            . "<td>{$download->title}</td>"
                            . "<td>{$download->version}</td>"
                            . "<td>"
                            . "<div class=\"btn-group btn-group-toggle\" data-toggle=\"buttons\">"
                            . "<a href=\"\" class=\"btn btn-danger\"><i class=\"fas fa-times\"></i></a>"
                            . "<a href=\"\" class=\"btn btn-success\"><i class=\"fas fa-signal\"></i></a>"
                            . "</div>"
                            . "</td>"
                            . "</tr>";
                    }

                ?>
            </tbody>
        </table>
    </div>
</div>