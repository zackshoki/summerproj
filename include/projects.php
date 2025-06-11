<?php




// function getProject($projectId) {
//     $AllProjects = getAllProjects();

//     return $AllProjects[$projectId];
// }

function getAllProjects()
{
    $projects = dbQuery("
            SELECT *
            FROM projects
            WHERE dateArchived IS NULL
        ")->fetchAll();
    return $projects;
}

function getProject($projectId)
{
    $project = dbQuery("
            SELECT *
            FROM projects
            WHERE projectId = $projectId
            AND dateArchived IS NULL
        ")->fetch();
    return $project;
}

function insertProject($projectName, $projectOrganization, $dateCreated, $projectCreators, $shortDescription, $longDescription, $image)
{ //, $image
    dbQuery("
        INSERT INTO projects (title, organization, dateCreated, shortDescription, creators, longDescription, image) VALUES ('$projectName','$projectOrganization','$dateCreated','$shortDescription','$projectCreators','$longDescription','$image')
        ");
}

function deleteProject($projectId)
{
    dbQuery("
            UPDATE projects
            SET dateArchived = NOW()
            WHERE projectId = $projectId
        ");
    
}

function validateUser($email, $password) {
    // return true if theres a match
    $user = dbQuery("
        SELECT userId, username, password FROM users WHERE username = '$email' AND password = '$password'
    ")->fetch();
    return $user;
}
