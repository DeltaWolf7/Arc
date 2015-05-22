<div class="page-header">
    <h1>Skype Session</h1>
</div>


<form>
    <div class="form-group">
        <label for="day">Day</label>
        <select type="text" class="form-control" id="day">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
            <option>6</option>     
            <option>7</option>
            <option>8</option>
            <option>9</option>
            <option>10</option>
            <option>11</option>
            <option>12</option>
            <option>13</option>     
            <option>14</option>
            <option>15</option>
            <option>16</option>
            <option>17</option>
            <option>18</option>
            <option>19</option>
            <option>20</option>
            <option>21</option>     
            <option>22</option>
            <option>23</option>
            <option>24</option>
            <option>25</option>
            <option>26</option>
            <option>27</option>
            <option>28</option>
            <option>29</option>
            <option>30</option>
            <option>31</option>   
        </select>
    </div>
    <div class="form-group">
        <label for="time">Time</label>
        <select type="text" class="form-control" id="time">
            <option>10:00</option>
            <option>10:30</option>
            <option>11:00</option>
            <option>11:30</option>
            <option>12:00</option>
            <option>12:30</option>     
            <option>13:00</option>
            <option>13:30</option>
            <option>14:00</option>
            <option>14:30</option>
        </select>
    </div>
    <button type="button" class="btn btn-default" onclick="send()">Submit</button>
</form>

<div id="status"></div>

<script>
    function send() {
        $.ajax({
            url: "<?php system\Helper::arcGetDispatch(); ?>",
            dataType: "json",
            type: "post",
            contentType: "application/x-www-form-urlencoded",
            data: {action: "send", id: <?php echo system\Helper::arcGetUser()->id; ?>, day: $("#day").val(), time: $("#time").val()},
            complete: function (data) {
                updateStatus("status", null);
            }
        });
    }
</script>