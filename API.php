
<?php


    require_once 'DBObjects/SchedulingProject.php';
    require_once 'DBObjects/Shout.class.php';
-

$method = $_GET['method'];
$type = $_GET['type'];



switch($method) {
    case 'get_all':
        switch($type) {
            case 'SchedulingProject':
                $projects = SchedulingProject::getAll();
                error_log('hit the get all method', 3, 'error_log.log');
                error_log(count($projects), 3, 'error_log.log');

                echo json_encode($projects);
                break;
        }
        break;
    case 'get_by_id':
        switch($type) {
            case 'Shout':
                $shouts = Shout::findByProjectId($_GET['id']);
                echo json_encode($shouts);
                break;
        }
}


// mapping urls to methods?

// Hit the URL. The URL should contain the get, get_all, whatever, the object type.

// If you have the object type name then you can call a static method on it.

// SchedulingProject::get_all()

// So when you hit the Url, use both of these to form the method call.

/*
So how would you use this?

    From JS you would do a post containing these things. JS would then get the json.

    This stuff's never actually called from the PHP
*/





?>