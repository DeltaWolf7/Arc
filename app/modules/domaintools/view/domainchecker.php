<div class="card">
    <div class="card-body">
        <?php
        if (isset($_POST["domains"])) {
            $domainArray = explode(PHP_EOL, $_POST["domains"]);
            Log::createLog("info", "domainchecker", "User checked " . count($domainArray) . " domains.");
            echo "<div class=\"table-responsive\"><table class=\"table table-striped\"><thead><tr class=\"text-primary\"><th>Domain</th><th>TLD</th><th>Result</th><th>Days</th></tr></thead>";
            foreach ($domainArray as $domain) {
                if (strlen($domain) > 1) {
                    $whois = new Whois();
                    $result = $whois->getWhois($domain, true);
                    echo "<tr><td>" . $result['Domain'] . "</td><td>" . $result['TLD'] . "</td><td>" . $result['Expire'] . "</td><td>" . $result['Days'] . "</td></tr>";
                }
            }
            echo "</table></div>";
        } else {
        ?>

        <form method="post">
            <textarea name="domains" rows="15" class="form-control"
                placeholder="Enter domain names, one per line.."></textarea>
            <button class="btn btn-primary mt-2" type="submit">Check</button>
        </form>

        <?php } ?>
    </div>
</div>