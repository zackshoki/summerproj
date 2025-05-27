<?php

    $practicePosts = [
        // the idea here is to have each post be a project that i have worked on
        1 => [
            "postId" => 1,
            "title" => "Google DevFest: GAZE",
            "header" => "an AI assistive application for the visually impaired",
            "image" => "",
            "date posted" => "",
            "description" => "",
            "organization" => ""
        ],
        2 => [
            "postId" => 2, 
            "title" => "past Projects"
        ],
        3 => [
            "postId" => 3,
            "title" => "something else"
        ]
    ];

    function getAllProjects() {
        $projects = [
            1 => [
                "projectId" => 1,
                "title" => "LACRM",
                "description" => "lalalala"
            ],
            2 => [
                "projectId" => 2, 
                "title" => "Google Devfest: GAZE"
            ],
            3 => [
                "projectId" => 3,
                "title" => "Hack WashU: Block Ninja"
            ]
        ];
        return $projects;
    }
    function getProject($projectId) {
        $AllProjects = getAllProjects();

        return $AllProjects[$projectId];
    }