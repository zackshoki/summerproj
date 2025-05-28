<?php




    // function getProject($projectId) {
    //     $AllProjects = getAllProjects();

    //     return $AllProjects[$projectId];
    // }

    function getAllProjects() {
        $projects = dbQuery("
            SELECT *
            FROM projects
        ")->fetchAll();
        return $projects;
    }

    function getProject($projectId) {
        $project = dbQuery("
            SELECT *
            FROM projects
            WHERE projectId = $projectId
        ")->fetch();
        return $project;
    }
    // getProject()