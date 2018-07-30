<?php 

class Mailbox {

    public $mailboxes;
    public $mailhost
    public $mailcon; 

    function Connect() {
        $self->mailhost = "{mail.gridhost.co.uk:993/imap/ssl}";
        $self->mailcon = imap_open($self->mailhost, "office@mrfelevenplustuition.co.uk", "Education2015!"); 
    }

    function UpdateMailboxes() {
        if ($self->mailcon) {
            $self->mailboxes = imap_list($self->mailcon, $self->mailhost, '*');
        }
    }

    function GetMailboxesAsList() {
        $mailboxarray = [];

        foreach ($self->mailboxes as $mailbox) {

            $name = str_replace($mailhost, "", $mailbox);
            $name = strtolower($name);
            $name = str_replace("inbox.", "", $name);
            $name = ucwords($name);
            
            $icon = "";
            switch ($name) {
                case "Inbox":
                    $icon = "inbox";
                    break;
                case "Sent":
                    $icon = "envelope";
                    break;
                case "Drafts":
                    $icon = "pencil";
                    break;
                case "Spam":
                case "Junk":
                    $icon = "folder-o";
                    break;
                case "Trash":
                    $icon = "trash";
                    break;
                default:
                    $icon = "folder";
                    break;
            }

            $mailboxarray[] = [$name, $icon];
        }

        return $mailboxarray;
    }

    function GetMailboxItems($mailbox) {
        $messsages = [];
        if ($self->mailcon) {
            $mailbox = strtoupper($mailbox);
            if (strpos($mailbox, "INBOX") === false) {
                $mailbox = "INBOX." . $mailbox;
            }

            $mailboxcheck = imap_check($self->mailcon . $mailbox);

            $result = imap_fetch_overview($self->mailcon,"1:{$mailboxcheck->Nmsgs}",0);
            foreach ($result as $overview) {
                $messsages[] = $overview;
            }
        }
        return $messsages;
    }

    function Disconnect() {
        if ($self->mailcon) {
            imap_close($self->mailcon);
        }
    }


?>