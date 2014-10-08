<div class="page-header">
    <h1>Messages</h1>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
            <?php
            $user = arcGetUser();
            $folder = '';

            if (empty(arcGetURLData("data1"))) {
                echo "Inbox";
                $folder = "inbox";
            } elseif (arcGetURLData("data1") == "sent") {
                echo "Sent";
                $folder = "sent";
            } elseif (arcGetURLData("data1") == "trash") {
                echo "Trash";
                $folder = "trash";
                $messages = Message::getMessagesByFolder($user->id, $folder);
                foreach ($messages as $message) {
                    if (strtotime($message->date) < strtotime('-30 days')) {
                        $message->delete($message->id);
                    }
                }
            } elseif (arcGetURLData("data1") == "delete") {
                $m = new Message();
                $m->getByID(arcGetURLData("data2"));
                $m->folder = "Trash";
                $m->update();
                echo "Inbox";
                $folder = "inbox";
            } elseif (arcGetURLData("data1") == "reply") {
                $m = new Message();
                $m->getByID(arcGetURLData("data2"));
                $m->read = true;
                $m->update();

                $newMail = new Message();
                $newMail->fromid = $user->id;
                $newMail->fromuser = $user->firstname . " " . $user->lastname;
                $newMail->userid = $m->fromid;
                $newMail->subject = "Re: " . $m->subject;
                $newMail->content = PHP_EOL . PHP_EOL . "-----Original Message-----" . PHP_EOL . $m->content;
                $folder = "reply";
            } elseif (arcGetURLData("data1") == "message") {
                echo "Message";
                $folder = "message";
                $m = new Message();
                $m->getByID(arcGetURLData("data2"));
                $m->read = true;
                $m->update();
            } elseif (arcGetURLData("data1") == "send") {
                echo "Compose";
                $folder = "send";
                $newMail = new Message();
                $newMail->fromid = $user->id;
                $newMail->fromuser = $user->firstname . " " . $user->lastname;
                $newMail->userid = arcGetURLData("data2");
            }
            ?>
        </h3>
    </div>

    <?php
    $message = new Message();
    $data = $message->getMessagesByFolder($user->id, $folder);
    ?>

    <div class="panel-body">
        <div class="row">
            <div class="col-md-3">
                <ul class="list-group">
                    <li class="list-group-item"><a href="<?php echo arcGetModulePath(); ?>/send"><span class="fa fa-pencil"></span> Compose</a></li>
                    <li class="list-group-item"><a href="<?php echo arcGetModulePath(); ?>/"><span class="fa fa-inbox"></span> Inbox</a></li>
                    <li class="list-group-item"><a href="<?php echo arcGetModulePath(); ?>/sent"><span class="fa fa-folder"></span> Sent</a></li>
                    <li class="list-group-item"><a href="<?php echo arcGetModulePath(); ?>/trash"><span class="fa fa-trash"></span> Trash</a></li>
                </ul>
            </div>
            <div class="col-md-9">
                <ul class="list-group">
                    <?php
                    if ($folder == "inbox" || $folder == "sent" || $folder == "trash") {
                        if (count($data) > 0) {
                            ?>

                            <table class="table table-hover">
                                <tr>
                                    <th>&nbsp;</th>
                                    <th>Subject</th>
                                    <th>Date</th>
                                    <th>&nbsp;</th>
                                </tr>
                                <?php
                                foreach ($data as $msg) {
                                    echo "<tr><td><span class='fa fa-envelope'";
                                    if ($msg->read == true) {
                                        echo "-o";
                                    }
                                    echo "'></span>";

                                    if ($msg->replied == true) {
                                        echo "&nbsp;<span class='fa fa-mail-reply-all'></span>";
                                    }
                                    ?>
                                </td><td><a href='<?php echo arcGetModulePath() . "/message/" . $msg->id; ?>'><?php echo $msg->subject; ?></a></td>
                            <td><?php echo $msg->date; ?></td>
                            <td class="text-right"><a href='<?php echo arcGetModulePath() . "/reply/" . $msg->id; ?>'><span class="fa fa-mail-reply"></span></a> <a href='<?php echo arcGetModulePath() . "/delete/" . $msg->id; ?>'><span class="fa fa-remove"></span></a></td>
                            <?php
                        }
                        echo "</table>";
                    } else {
                        echo "No messages in this folder.";
                    }
                } else {
                    ?>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form>
                                <table id="messages" class="table table-bordered">
                                    <tr><td>To</td><td>
                                            <?php if (arcGetURLData("data1") == "send" || arcGetURLData("data1") == "reply") {
                                                ?>
                                                <select id="touser" class="form-control">
                                                    <?php
                                                    $userList = User::getAllUsers();
                                                    foreach ($userList as $u) {
                                                        echo "<option value='" . $u->id . "'";
                                                        if ($u->id == $newMail->userid) {
                                                            echo "selected";
                                                        }
                                                        echo ">" . $u->firstname . " " . $u->lastname . " (" . $u->id . ")</option>";
                                                    }
                                                    ?>
                                                </select>
                                                <?php
                                            } else {
                                                echo $user->firstname . " " . $user->lastname;
                                            }
                                            ?>
                                        </td></tr>
                                    <tr><td style="vertical-align: middle;">Subject</td><td>
                                            <?php if (arcGetURLData("data1") == "send" || arcGetURLData("data1") == "reply") {
                                                ?>
                                                <input id="subject" type="textbox" class="form-control" placeholder="Subject" maxlength="100" value="<?php echo $newMail->subject; ?>" />
                                                <?php
                                            } else {
                                                echo $m->subject;
                                            }
                                            ?>
                                        </td></tr>
                                    <?php if (arcGetURLData("data1") == "message") { ?>
                                        <tr><td>From</td><td><a href='<?php echo arcGetModulePath() . "/send/" . $m->fromid; ?>'><?php echo $m->fromuser; ?></a></td></tr>

                                        <tr><td>Date</td><td><?php echo $m->date; ?></td></tr>
                                    <?php } ?>
                                </table>


                                <?php
                                if (arcGetURLData("data1") == "send" || arcGetURLData("data1") == "reply") {
                                    ?>
                                    <textarea rows="10" class="form-control" id="message"><?php echo $newMail->content; ?></textarea> 

                                    <p>
                                    <div class="row">
                                        <div class="col-md-10">&nbsp;</div>
                                        <div class="col-md-2 text-right"><a href="#" onclick="ajax.send('POST', {action: 'send', userid: '#userid', touser: '#touser', subject: '#subject', message: '#message', replyid: '#replyid'}, '<?php arcGetDispatch(); ?>', sendMessage, true)"><span class='fa fa-send'></span> Send</a></div>
                                    </div>

                                    </p>

                                    <?php
                                } else {
                                    ?>
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <?php
                                            echo $m->content;
                                            ?>
                                        </div></div>
                                    <p>
                                    <div class="row">
                                        <div class="col-md-9">&nbsp;</div>
                                        <div class="col-md-3 text-right"><a href='<?php echo arcGetModulePath() . "/reply/" . $m->id; ?>'><span class="fa fa-reply"></span> Reply</a>&nbsp;
                                            <a href='<?php echo arcGetModulePath() . "/delete/" . $m->id; ?>'><span class="fa fa-remove"></span> Delete</a></div>
                                    </div>

                                    </p>
                                    <?php
                                }
                                ?>
                                <input type="hidden" value="<?php echo $user->id; ?>" id="userid">
                                <input type="hidden" value="<?php
                            if (arcGetURLData("data1") == "reply") {
                                echo $m->id;
                            } else {
                                echo "0";
                            }
                                ?>" id="replyid">
                            </form>
                        </div>
                    </div>
                    <?php
                }
                ?>


                </div>
                </div>

                <script>
                    function sendMessage(data) {
                        window.location = "<?php echo arcGetModulePath(); ?>";
                        updateStatus(data);
                    }
                </script>
