<?php

class result {

    public $id = -1;
    public $userid = -1;
    public $type;
    public $data;
    public $date;
    public $correct;
    public $time;
    private $database;

    public function __construct() {
        $this->type = '';
        $this->date = '';
        $this->date = date("Y-m-d H:i:s");
        $this->database = new medoo();
        $this->time = 0;
        $this->correct = false;
    }
    
    public function getResult($id) {
        $data = $this->database->get('results', ['id', 'userid', 'type', 'data', 'date', 'correct', 'time'], ['id' => $id]);

        if (is_array($data)) {
            $this->userid = $data['userid'];
            $this->type = $data['type'];
            $this->date = $data['date'];
            $this->data = $data['data'];
            $this->id = $data['id'];
            $this->correct = $data['correct'];
            $this->time = $data['time'];
            return true;
        }
        return false;
    }

    public function updateResult() {
        if ($this->id == -1) {
            $this->id = $this->database->insert('results', ['userid' => $this->userid,
                'type' => $this->type,
                'data' => $this->data,
                'date' => $this->date,
                'time' => $this->time,
                'correct' => $this->correct
                ]);
        } else {
            $this->database->update('results', ['userid' => $this->userid,
                'type' => $this->type,
                'data' => $this->data,
                'date' => $this->date,
                'time' => $this->time,
                'correct' => $this->correct
                ], ['id' => $this->id]);
        }
    }

    public function deleteResult($id) {
        $this->database->delete('results', ['id' => $id]);
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

?>
