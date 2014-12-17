<div class="page-header">
    <h1>Register</h1>
</div>

<form role="form">
    <div class="form-group">
        <label for="name">Firstname</label>
        <input maxlength="50" type="text" class="form-control" id="firstname" placeholder="Enter firstname">
    </div>
    <div class="form-group">
        <label for="name">Lastname</label>
        <input maxlength="50" type="text" class="form-control" id="lastname" placeholder="Enter lastname">
    </div>
    <div class="form-group">
        <label for="email">Email address</label>
        <input maxlength="100" type="text" class="form-control" id="email" placeholder="Enter email address">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input maxlength="100" type="password" class="form-control" id="password" placeholder="Password" autocomplete="off">
    </div>
    <div class="form-group">
        <label for="password2">Retype Password</label>
        <input maxlength="100" type="password" class="form-control" id="password2" placeholder="Retype password" autocomplete="off">
    </div>
    <button id="registerBtn" type="button" class="btn btn-default">Register</button>
</form>

<script>
    $("#registerBtn").click(function () {
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {firstname: $("#firstname").val(), lastname: $("#lastname").val(), email: $("#email").val(),
                password: $("#password").val(), password2: $("#password2").val()},
            success: function (data) {
                var jdata = jQuery.parseJSON(JSON.stringify(data));
                updateStatus(jdata.status, jdata.data);
                if (jdata.status == "success") {
                    window.location = "<?php echo system\Helper::arcGetPath(); ?>";
                }
            }
        });
    });
</script>