<?php

/*
 * The MIT License
 *
 * Copyright 2014 Craig Longford.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

/**
 * AJAX data dispatch handler
 *
 * @author Craig Longford
 */
require_once "../../system/bootstrap.php";
arcSetPage("coachman");

if ($_POST["action"] == "savevehicle") {

    if (empty($_POST["regNo"])) {
        echo "danger|Invalid vehicle registration number";
        return;
    }

    $seats = (int) $_POST["seats"];
    if ($seats <= 0) {
        echo "danger|Number of seats specified is invalid";
        return;
    }

    $fuel = (double) $_POST["fuel"];
    if ($fuel <= 0.00) {
        echo "danger|Invalid fuel cost";
        return;
    }

    $vehicle = new Vehicle();
    if ($_POST["id"] != "0") {
        $vehicle->getByID($_POST["id"]);
    }
    $vehicle->regno = strtoupper($_POST["regNo"]);
    $vehicle->seats = $seats;
    $vehicle->typeid = $_POST["type"];
    $vehicle->fuelcostpermile = $fuel;
    $vehicle->update();

    echo "success|Vehicle saved";
} elseif ($_POST['action'] == "savedriver") {
    
    if (empty($_POST['firstname'])) {
        echo "danger|Invalid firstname";
        return;
    }
    
    if (empty($_POST['lastname'])) {
        echo "danger|Invalid lastname";
        return;
    }
    
    $cost = (double) $_POST["cost"];
    if ($cost <= 0.00) {
        echo "danger|Invalid cost per hour";
        return;
    }
    
    
    $driver = new Driver();
    if ($_POST['id'] != "0") {
        $driver->getByID($_POST['id']);
    }
    
    $driver->firstname = ucwords($_POST['firstname']);
    $driver->lastname = ucwords($_POST['lastname']);
    $driver->email = strtolower($_POST['email']);
    $driver->phone = $_POST['phone'];
    $driver->mobile = $_POST['mobile'];
    $driver->costperhour = $_POST['cost'];
    $driver->update();
    
    echo "success|Driver saved";
}
