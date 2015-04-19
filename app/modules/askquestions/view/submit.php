<div class="page-header">
    <h1>Submit Game</h1>
</div>


<form>
    <div class="form-group">
        <label for="game">Questions</label>
        <textarea id="game" class="form-control" rows="30">
Question 1: 
Answer 1: 
Answer 2:
Answer 3:
Answer 4:
Correct Answer: 1/2/3/4

Question 2: 
Answer 1: 
Answer 2:
Answer 3:
Answer 4:
Correct Answer: 1/2/3/4

Question 3: 
Answer 1: 
Answer 2:
Answer 3:
Answer 4:
Correct Answer: 1/2/3/4


Question 4: 
Answer 1: 
Answer 2:
Answer 3:
Answer 4:
Correct Answer: 1/2/3/4


Question 5: 
Answer 1: 
Answer 2:
Answer 3:
Answer 4:
Correct Answer: 1/2/3/4


Question 6: 
Answer 1: 
Answer 2:
Answer 3:
Answer 4:
Correct Answer: 1/2/3/4


Question 7: 
Answer 1: 
Answer 2:
Answer 3:
Answer 4:
Correct Answer: 1/2/3/4


Question 8: 
Answer 1: 
Answer 2:
Answer 3:
Answer 4:
Correct Answer: 1/2/3/4


Question 9: 
Answer 1: 
Answer 2:
Answer 3:
Answer 4:
Correct Answer: 1/2/3/4


Question 10: 
Answer 1: 
Answer 2:
Answer 3:
Answer 4:
Correct Answer: 1/2/3/4


Question 11: 
Answer 1: 
Answer 2:
Answer 3:
Answer 4:
Correct Answer: 1/2/3/4


Question 12: 
Answer 1: 
Answer 2:
Answer 3:
Answer 4:
Correct Answer: 1/2/3/4


Question 13: 
Answer 1: 
Answer 2:
Answer 3:
Answer 4:
Correct Answer: 1/2/3/4


Question 14: 
Answer 1: 
Answer 2:
Answer 3:
Answer 4:
Correct Answer: 1/2/3/4


Question 15: 
Answer 1: 
Answer 2:
Answer 3:
Answer 4:
Correct Answer: 1/2/3/4
        </textarea>
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
            data: {action: "send", id: <?php echo system\Helper::arcGetUser()->id; ?>, data: $("#game").val()}
        });
        updateStatus("status", null);
    }
</script>