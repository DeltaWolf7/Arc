<?php

class ArcUserAchievement extends DataProvider {

    public $userid;
    public $achievementid;
    public $awarded;

    public __construct ArcAchievement() {
        parent::__construct();
        $this->userid = 0;
        $this->achievementid = 0;
        $this->awarded = date("y-m-d H:i:s");
        $this->table = "arc_user_achievements";
        $this->map = ["id" => "id", "userid" => "userid",
            "achievementid" => "achievementid", "awarded" => "awarded"];
    }

    public static getByID($id) {
        $achievement = new ArcUserAchievement();
        $achievement->get(["id" => $id]);
        return $achievement;
    }

    public static getUserAchievements($userid) {
        $achievement = new ArcUserAchievement();
        return $achievement->getCollection(["userid" => $userid]);
    }
}