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

    function insertProject($projectName, $projectOrganization, $dateCreated, $projectCreators, $shortDescription, $longDescription) { //, $image
        dbQuery("
        INSERT INTO projects (title, organization, dateCreated, shortDescription, creators, longDescription, image) VALUES ('$projectName','$projectOrganization','$dateCreated','$shortDescription','$projectCreators','$longDescription','placeholder')
        ");
    }