<?php

class ArcAchievement extends DataProvider {

    public $name;
    public $description;
    public $icon;

    public __construct ArcAchievement() {
        parent::__construct();
        $this->name = "";
        $this->description = "";
        $this->icon = "";
        $this->table = "arc_achievements";
        $this->map = ["id" => "id", "name" => "name",
            "description" => "description", "icon" => "icon"];
    }

    public static getByID($id) {
        $achievement = new ArcAchievement();
        $achievement->get(["id" => $id]);
        return $achievement;
    }

    public static getUserAchievements($userid) {
        $achievement = new ArcAchievement();
        return $achievement->getCollection([]);
    }
}