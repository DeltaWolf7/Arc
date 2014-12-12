<div class="header">
    <h1>Store Manager</h1>
</div>

<div class="text-right">
    <div class="btn-group" role="group">
        <button type="button" class="btn btn-default btn-lg" onclick="window.location='<?php echo arcGetModulePath(); ?>'"><span class="fa fa-pie-chart"></span> Overview</button>
        <button type="button" class="btn btn-default btn-lg" onclick="window.location='<?php echo arcGetModulePath() . "orders"; ?>'"><span class="fa fa-shopping-cart"></span> Orders</button>
        <button type="button" class="btn btn-default btn-lg" onclick="window.location='<?php echo arcGetModulePath() . "customers"; ?>'"><span class="fa fa-users"></span> Customers</button>
        <button type="button" class="btn btn-default btn-lg" onclick="window.location='<?php echo arcGetModulePath() . "categories"; ?>'"><span class="fa fa-folder"></span> Categories</button>
        <button type="button" class="btn btn-default btn-lg" onclick="window.location='<?php echo arcGetModulePath() . "products"; ?>'"><span class="fa fa-coffee"></span> Products</button>
        <button type="button" class="btn btn-default btn-lg" onclick="window.location='<?php echo arcGetModulePath() . "settings"; ?>'"><span class="fa fa-cog"></span> Settings</button>
    </div>
</div>
