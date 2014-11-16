<?php

namespace Erudio {

    class Result extends DataProvider {

        public $userid;
        public $type;
        public $data;
        public $date;
        public $correct;
        public $time;

        public function __construct() {
            parent::__construct();
            $this->type = "";
            $this->data = "";
            $this->date = date("Y-m-d H:i:s");
            $this->time = 0;
            $this->correct = false;
            $this->table = "erudio_results";
            $this->columns = ["id", "userid", "data", "date", "correct", "time"];
        }

        public function getQuickFireCount($id, $getCorrect) {
            $data = $this->database->query("SELECT COUNT(*) FROM results WHERE userid=" . $id . " AND correct=" . $getCorrect . " AND type='Quick Fire'")->fetchAll();
            return $data[0][0];
        }

        public function getOddOneOutCount($id, $getCorrect) {
            $data = $this->database->query("SELECT COUNT(*) FROM results WHERE userid=" . $id . " AND correct=" . $getCorrect . " AND type='Odd One Out'")->fetchAll();
            return $data[0][0];
        }

        public function getAntonymsCount($id, $getCorrect) {
            $data = $this->database->query("SELECT COUNT(*) FROM results WHERE userid=" . $id . " AND correct=" . $getCorrect . " AND type='Antonyms'")->fetchAll();
            return $data[0][0];
        }

        public function getSynonymsCount($id, $getCorrect) {
            $data = $this->database->query("SELECT COUNT(*) FROM results WHERE userid=" . $id . " AND correct=" . $getCorrect . " AND type='Synonyms'")->fetchAll();
            return $data[0][0];
        }

        public function getShuffledCount($id, $getCorrect) {
            $data = $this->database->query("SELECT COUNT(*) FROM results WHERE userid=" . $id . " AND correct=" . $getCorrect . " AND type='Shuffled Sentences'")->fetchAll();
            return $data[0][0];
        }

        public function getMultistageCount($id, $getCorrect) {
            $data = $this->database->query("SELECT COUNT(*) FROM results WHERE userid=" . $id . " AND correct=" . $getCorrect . " AND type='Multi Stage'")->fetchAll();
            return $data[0][0];
        }

        public function getResults($userID, $rows) {
            $data = $this->database->query("SELECT * FROM results WHERE userid=" . $userID . " ORDER BY date DESC LIMIT 0, " . $rows)->fetchAll();

            foreach ($data as $result) {
                $res = new result();
                $res->id = $result['id'];
                $res->userid = $result['userid'];
                $res->type = $result['type'];
                $res->data = $result['data'];
                $res->date = $result['date'];
                $res->time = $result['time'];
                $res->correct = $result['correct'];
                array_push($this->results, $res);
            }
        }

        public function getResultsByDate($userID, $date, $rows) {
            $dateFormat = date('Y-m-d', strtotime($date));
            $data = $this->database->query("SELECT * FROM results WHERE userid=" . $userID . " AND DATE(date)='" . $dateFormat . "' ORDER BY date DESC LIMIT 0, " . $rows)->fetchAll();

            foreach ($data as $result) {
                $res = new result();
                $res->id = $result['id'];
                $res->userid = $result['userid'];
                $res->type = $result['type'];
                $res->data = $result['data'];
                $res->date = $result['date'];
                $res->time = $result['time'];
                $res->correct = $result['correct'];
                array_push($this->results, $res);
            }
        }

        public function getResultsByDateAndType($userID, $date, $rows, $type) {
            $dateFormat = date('Y-m-d', strtotime($date));
            $data = $this->database->query("SELECT * FROM results WHERE userid=" . $userID . " AND DATE(date)='" . $dateFormat . "' AND type='" . $type . "' ORDER BY date DESC LIMIT 0, " . $rows)->fetchAll();

            foreach ($data as $result) {
                $res = new result();
                $res->id = $result['id'];
                $res->userid = $result['userid'];
                $res->type = $result['type'];
                $res->data = $result['data'];
                $res->date = $result['date'];
                $res->time = $result['time'];
                $res->correct = $result['correct'];
                array_push($this->results, $res);
            }
        }

        public function getResultsByType($userID, $rows, $type) {
            $data = $this->database->query("SELECT * FROM results WHERE userid=" . $userID . " AND type='" . $type . "' ORDER BY date DESC LIMIT 0, " . $rows)->fetchAll();

            foreach ($data as $result) {
                $res = new result();
                $res->id = $result['id'];
                $res->userid = $result['userid'];
                $res->type = $result['type'];
                $res->data = $result['data'];
                $res->date = $result['date'];
                $res->time = $result['time'];
                $res->correct = $result['correct'];
                array_push($this->results, $res);
            }
        }

        public function getResultsLast($rows, $type) {
            $data = $this->database->query("SELECT * FROM results WHERE type='" . $type . "' ORDER BY date DESC LIMIT 0, " . $rows)->fetchAll();

            foreach ($data as $result) {
                $res = new result();
                $res->id = $result['id'];
                $res->userid = $result['userid'];
                $res->type = $result['type'];
                $res->data = $result['data'];
                $res->date = $result['date'];
                $res->time = $result['time'];
                $res->correct = $result['correct'];
                array_push($this->results, $res);
            }
        }

    }

}