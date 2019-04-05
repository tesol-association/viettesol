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
        'EDIT_SUBMISSION_MESSAGE' => '<strong> %s </strong>  update for paper title <strong> %s  </strong> at <strong> %s </strong>', // AuthorName, PaperTitle, TimeAt

        'ADD_CO_AUTHOR' => 'add_co_author',
        'ADD_CO_AUTHOR_MESSAGE' => '<strong> %s </strong>  add co-author %s for paper title <strong> %s  </strong> at <strong> %s </strong>', // AuthorName, CoAuthorName, PaperTitle, TimeAt

        'SEND_FULL_PAPER' => 'send_full_paper',
        'SEND_FULL_PAPE_MESSAGE' => '<strong> %s </strong>  send full paper for paper title <strong> %s  </strong> at <strong> %s </strong>', // AuthorName,PaperTitle, TimeAt

        //Track Director
        'ASSIGN_REVIEWER' => 'assign_reviewer',
        'ASSIGN_REVIEWER_MESSAGE' => '<strong> %s </strong>  assign reviewer %s for paper title <strong> %s  </strong> at <strong> %s </strong>', // TrackDirectorName, ReviewerName, PaperTitle, TimeAt

        'UN_ASSIGNMENT' => 'unassigned_reviewer',
        'UN_ASSIGNMENT_MESSAGE' => '<strong> %s </strong>  unassign reviewer %s for paper title <strong> %s  </strong> at <strong> %s </strong>', // TrackDirectorName, ReviewerName, PaperTitle, TimeAt

        'TRACK_DICIDED' => 'track_decided',
        'TRACK_DICIDED_MESSAGE' => 'Tracck <strong> %s </strong>  decided %s for paper title <strong> %s  </strong> at <strong> %s </strong>', // TrackDirectorName, disicion, PaperTitle, TimeAt

        // Reviewer
        'SEND_REVIEW_RESULT' => 'send_review_result',
        'SEND_REVIEW_RESULT_MESSAGE' => '<strong> %s </strong> send review result for paper title <strong> %s  </strong> at <strong> %s </strong>', // ReviewrerName, PaperTitle, TimeAt

        'ATTACH_FILE_REVIEW' => 'attach_file_review',
        'ATTACH_FILE_REVIEW_MESAGE' => 'message ???', //Chua lam
        //Director
        'DIRECTOR_ADD_PRESENTATION_LIST' => 'add_presentation_list',
        'DIRECTOR_REMOVE_PRESENTATION_LIST' => 'remove_presentation_list',
        //ADMIN
        'SCHEDULE_PAPER' => 'paper_scheduled',
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
