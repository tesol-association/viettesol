<?php
/**
 * Created by PhpStorm.
 * User: thangbk111
 * Date: 3/28/2019
 * Time: 6:07 PM
 */
return [
    'USER' => [
        'ADMIN' => 1,
        'NO_ROLE' => 0
    ],
    'CONFERENCE_ROLE' => [
        'DIRECTOR' => 'Director',
        'TRACK_DIRECTOR' => 'Track Director',
        'REVIEWER' => 'Reviewer',
        'AUTHOR' => 'Author'
    ],
    'PAPER' => [
        'ACCEPTED' => 0,
        'REVISION' => 1,
        'REJECTED' => 2,
    ],
    'PAPER_EVENT' => [
        //Author
        'SUBMITTED' => 'submitted',
        'EDIT_SUBMISSION' => 'edit_submission',
        'ADD_AUTHOR' => 'add_author',
        //Track Director
        'ASSIGNMENT' => 'assigned',
        'UN_ASSIGNMENT' => 'unassigned',
        'DECIDED' => 'decided',
        // Reviewer
        'ACCEPT_REVIEW' => 'accept_assign',
        'REJECT_REVIEW' => 'reject_assign',
        'REVIEW_COMPLETE' => 'complete_review',
    ],
    'REVIEW_ASSIGNMENT' => [
        'INDEX_ASSIGNMENT' => ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'],
        'ACCEPTED_ASSIGNMENT' => 0,
        'REJECTED_ASSIGNMENT' => 1,
        'ACCEPT_RECOMMENDATION' => 0,
        'REVISION_RECOMMENDATION' => 1,
        'REJECT_RECOMMENDATION' => 2,
    ],
    'PAPER_STATUS' => [
        'SUBMITTED' => 'submitted',
        'ACCEPTED' => 'accepted',
        'REJECTED' => 'rejected',
        'REVISION' => 'revision',
    ],
    'PAPER_AUTHOR' => [
        'AUTHOR' => 0,
        'CO_AUTHOR' => 1,
    ],
    'PAPER_FILE'=>[
        'FULL_PAPER'=> 'full_paper',
        'REVIEW_FILE'=> 'review_file',
    ],
];
