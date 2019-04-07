<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/demo-conference',function () {
    return view('layouts.conference.layout');
});
Route::get('/demo-admin',function () {
    return view('layouts.admin.layout');
});

Route::get('/demo-home',function () {
    return view('layouts.home.layout');
});
Route::get('/test',function () {
    return view('layouts.admin.conference_layout');
});

//Contact Form
Route::get('/home/contact_form/create','Home\ContactFormController@create')->name('home_contactForm_create');
Route::post('/home/contact_form/store','Home\ContactFormController@store')->name('home_contactForm_store');

//'middleware'=>'auth'
Route::group(['prefix'=>'admin', 'middleware' => ['auth', 'admin']],function(){
    Route::get('/index',function () {
        return view('layouts.admin.layout');
    });
    //menu
    Route::group(['prefix'=>'menu'],function(){
        Route::get('/list','Admin\MenuController@index')->name('admin_menu_list');

        Route::get('/create','Admin\MenuController@create')->name('admin_menu_create');
        Route::post('/store','Admin\MenuController@store')->name('admin_menu_store');
        Route::post('/delete/{id}','Admin\MenuController@destroy')->name('admin_menu_delete');

        Route::get('/view/{id}','Admin\MenuController@edit')->name('admin_menu_edit');
        Route::post('/update/{id}','Admin\MenuController@update')->name('admin_menu_update');

        Route::get('/listSubmenu/{id}','Admin\MenuController@show')->name('admin_submenu_list');

        Route::get('create-submenu/{id}','Admin\MenuController@createSubmenu')->name('admin_submenu_create');
        Route::post('add-submenu','Admin\MenuController@addSubmenu')->name('admin_submenu_add');

        Route::post('/delete-submenu/{id}','Admin\MenuController@destroySubmenu')->name('admin_submenu_delete');

        Route::get('/view-submenu/{id}','Admin\MenuController@editSubmenu')->name('admin_submenu_edit');
        Route::post('/update-submenu/{id}','Admin\MenuController@updateSubmenu')->name('admin_submenu_update');

    });

    //User Manager
    Route::group(['prefix'=>'user'],function(){
        Route::get('/list','Admin\UserManagerController@index')->name('admin_user_list');

        Route::get('/create','Admin\UserManagerController@create')->name('admin_user_create');
        Route::post('/store','Admin\UserManagerController@store')->name('admin_user_store');
        Route::post('/delete/{id}','Admin\UserManagerController@destroy')->name('admin_user_delete');

        Route::get('/view/{id}','Admin\UserManagerController@show')->name('admin_user_view');

        Route::get('/edit/{id}','Admin\UserManagerController@edit')->name('admin_user_edit');
        Route::post('/update/{id}','Admin\UserManagerController@update')->name('admin_user_update');

        Route::post('/disable/{id}','Admin\UserManagerController@disable')->name('admin_user_disable');
        Route::post('/enable/{id}','Admin\UserManagerController@enable')->name('admin_user_enable');
    });

    //Contact Form Manager
    Route::group(['prefix'=>'contact_form'],function(){
        Route::get('/list','Admin\ContactFormController@index')->name('admin_contactForm_list');
    });

    //banner
    Route::group(['prefix'=>'banner'],function(){
        Route::get('/list','Admin\BannerController@index')->name('admin_banner_list');

        Route::get('/create','Admin\BannerController@create')->name('admin_banner_create');
        Route::post('/store','Admin\BannerController@store')->name('admin_banner_store');

        Route::post('/delete/{id}','Admin\BannerController@destroy')->name('admin_banner_delete');

        Route::get('/view/{id}','Admin\BannerController@edit')->name('admin_banner_edit');
        Route::post('/update/{id}','Admin\BannerController@update')->name('admin_banner_update');
    });

    //partner_sponsor
    Route::group(['prefix'=>'partner_sponsor'],function(){
        Route::get('/list','Admin\PartnerController@index')->name('admin_partner_list');

        Route::get('/create','Admin\PartnerController@create')->name('admin_partner_create');
        Route::post('/store','Admin\PartnerController@store')->name('admin_partner_store');

        Route::post('/delete/{id}','Admin\PartnerController@destroy')->name('admin_partner_delete');

        Route::get('/view/{id}','Admin\PartnerController@edit')->name('admin_partner_edit');
        Route::post('/update/{id}','Admin\PartnerController@update')->name('admin_partner_update');
    });

    //advertisements
    Route::group(['prefix'=>'advertisements'],function(){
        Route::get('/list','Admin\AdvertisementController@index')->name('admin_advertisement_list');

        Route::get('/create','Admin\AdvertisementController@create')->name('admin_advertisement_create');
        Route::post('/store','Admin\AdvertisementController@store')->name('admin_advertisement_store');

        Route::post('/delete/{id}','Admin\AdvertisementController@destroy')->name('admin_advertisement_delete');

        Route::get('/view/{id}','Admin\AdvertisementController@edit')->name('admin_advertisement_edit');
        Route::post('/update/{id}','Admin\AdvertisementController@update')->name('admin_advertisement_update');
    });

    //comment
    Route::group(['prefix'=>'comment'],function(){
        Route::get('/list','Admin\CommentController@index')->name('admin_comment_list');

        Route::post('/store', 'Admin\CommentController@store')->name('admin_comment_store');
        Route::get('/update','Admin\CommentController@update')->name('admin-comment-update');
        Route::get('/updateAll','Admin\CommentController@updateAll')->name('admin-comment-updateAll');
    });

    /**
     * CONTENT MANAGER
     */
    Route::group(['prefix'=>'news'], function(){
       Route::get('/list', 'Admin\NewsController@index')->name('admin_news_list');
       Route::get('/create', 'Admin\NewsController@create')->name('admin_news_create');
       Route::post('/store', 'Admin\NewsController@store')->name('admin_news_store');
       Route::get('/edit/{id}', 'Admin\NewsController@edit')->name('admin_news_edit');
       Route::post('/update/{id}', 'Admin\NewsController@update')->name('admin_news_update');
       Route::post('/delete/{id}', 'Admin\NewsController@destroy')->name('admin_news_delete');
   });

    Route::group(['prefix'=>'news_category'], function(){
        Route::get('/list', 'Admin\NewsCategoryController@index')->name('admin_news_category_list');
        Route::get('/create', 'Admin\NewsCategoryController@create')->name('admin_news_category_create');
        Route::post('/store', 'Admin\NewsCategoryController@store')->name('admin_news_category_store');
        Route::get('/edit/{id}', 'Admin\NewsCategoryController@edit')->name('admin_news_category_edit');
        Route::post('/update/{id}', 'Admin\NewsCategoryController@update')->name('admin_news_category_update');
        Route::post('/delete/{id}', 'Admin\NewsCategoryController@destroy')->name('admin_news_category_delete');
    });

    Route::group(['prefix'=> 'events'],function(){
        Route::get('/list', 'Admin\EventController@index')->name('admin_event_list');
        Route::get('/create', 'Admin\EventController@create')->name('admin_event_create');
        Route::post('/store', 'Admin\EventController@store')->name('admin_event_store');
        Route::get('/edit/{id}', 'Admin\EventController@edit')->name('admin_event_edit');
        Route::post('/update/{id}', 'Admin\EventController@update')->name('admin_event_update');
        Route::post('/delete/{id}', 'Admin\EventController@destroy')->name('admin_event_delete');
    });

    Route::group(['prefix'=> 'events_category'],function(){
        Route::get('/list', 'Admin\EventCategoryController@index')->name('admin_events_category_list');
        Route::get('/create', 'Admin\EventCategoryController@create')->name('admin_events_category_create');
        Route::post('/store', 'Admin\EventCategoryController@store')->name('admin_events_category_store');
        Route::get('/edit/{id}', 'Admin\EventCategoryController@edit')->name('admin_events_category_edit');
        Route::post('/update/{id}', 'Admin\EventCategoryController@update')->name('admin_events_category_update');
        Route::post('/delete/{id}', 'Admin\EventCategoryController@destroy')->name('admin_events_category_delete');
    });


    Route::group(['prefix'=>'contact'],function(){
      Route::get('/list', 'Admin\ContactController@index')->name('admin_contact_list');
      Route::get('/create', 'Admin\ContactController@create')->name('admin_contact_create');
      Route::post('/store', 'Admin\ContactController@store')->name('admin_contact_store');
      Route::get('/edit/{id}', 'Admin\ContactController@edit')->name('admin_contact_edit');
      Route::post('/update/{id}', 'Admin\ContactController@update')->name('admin_contact_update');
      Route::post('/delete/{id}', 'Admin\ContactController@destroy')->name('admin_contact_delete');
  });

    Route::group(['prefix'=>'contact_type'],function(){
      Route::get('/list', 'Admin\ContactTypeController@index')->name('admin_contact_type_list');
      Route::get('/create', 'Admin\ContactTypeController@create')->name('admin_contact_type_create');
      Route::post('/store', 'Admin\ContactTypeController@store')->name('admin_contact_type_store');
      Route::get('/edit/{id}', 'Admin\ContactTypeController@edit')->name('admin_contact_type_edit');
      Route::post('/update/{id}', 'Admin\ContactTypeController@update')->name('admin_contact_type_update');
      Route::post('/delete/{id}', 'Admin\ContactTypeController@destroy')->name('admin_contact_type_delete');
  });

    Route::group(['prefix'=>'contribution'],function(){
        Route::get('/list', 'Admin\ContributionController@index')->name('admin_contribution_list');
        Route::post('/delete/{id}', 'Admin\ContributionController@destroy')->name('admin_contribution_delete');
    });

    Route::group(['prefix'=>'membership'],function(){
        Route::get('/list', 'Admin\MembershipController@index')->name('admin_membership_list');
        Route::get('/create', 'Admin\MembershipController@create')->name('admin_membership_create');
        Route::post('/store', 'Admin\MembershipController@store')->name('admin_membership_store');
        Route::get('/edit/{id}', 'Admin\MembershipController@edit')->name('admin_membership_edit');
        Route::post('/update/{id}', 'Admin\MembershipController@update')->name('admin_membership_update');
        Route::post('/delete/{id}', 'Admin\MembershipController@destroy')->name('admin_membership_delete');
        Route::get('/make/{id}', 'Admin\ContactController@make')->name('admin_membership_make');
    });


    /**
     * CONFERENCE MANAGER
     */
    Route::group(['prefix'=>'conference'], function() {
        Route::get('/list', 'Admin\ConferenceController@index')->name('admin_conference_list');
        Route::get('/create', 'Admin\ConferenceController@create')->name('admin_conference_create');
        Route::post('/store', 'Admin\ConferenceController@store')->name('admin_conference_store');
        Route::get('/view/{id}', 'Admin\ConferenceController@view')->name('admin_conference_view');
        Route::get('/edit/{id}', 'Admin\ConferenceController@edit')->name('admin_conference_edit');
        Route::post('/update/{id}', 'Admin\ConferenceController@update')->name('admin_conference_update');
        Route::post('/delete/{id}', 'Admin\ConferenceController@destroy')->name('admin_conference_delete');
    });

    Route::group(['prefix'=>'/conf/{conference_id}'], function() {
        // Conference TimeLine
        Route::group(['prefix'=>'/timeline'], function() {
            Route::get('/view', 'Admin\ConferenceTimelineController@view')->name('admin_timeline_view');
            Route::get('/create', 'Admin\ConferenceTimelineController@create')->name('admin_timeline_create');
            Route::post('/store', 'Admin\ConferenceTimelineController@store')->name('admin_timeline_store');
            Route::get('/edit/{id}', 'Admin\ConferenceTimelineController@edit')->name('admin_timeline_edit');
            Route::post('/update/{id}', 'Admin\ConferenceTimelineController@update')->name('admin_timeline_update');
        });

        Route::group(['prefix'=>'/track'], function() {
            Route::get('/list', 'Admin\TrackController@index')->name('admin_track_list');
            Route::get('/create', 'Admin\TrackController@create')->name('admin_track_create');
            Route::post('/store', 'Admin\TrackController@store')->name('admin_track_store');
            Route::get('/edit/{id}', 'Admin\TrackController@edit')->name('admin_track_edit');
            Route::post('/update/{id}', 'Admin\TrackController@update')->name('admin_track_update');
            Route::post('/delete/{id}', 'Admin\TrackController@destroy')->name('admin_track_delete');
        });

        Route::group(['prefix'=>'/buildings'], function(){
            Route::get('/list', 'Admin\ConferenceManager\BuildingsController@index')->name('admin_buildings_list');
            Route::get('/create', 'Admin\ConferenceManager\BuildingsController@create')->name('admin_buildings_create');
            Route::post('/store', 'Admin\ConferenceManager\BuildingsController@store')->name('admin_buildings_store');
            Route::get('/edit/{id}', 'Admin\ConferenceManager\BuildingsController@edit')->name('admin_buildings_edit');
            Route::post('/update/{id}', 'Admin\ConferenceManager\BuildingsController@update')->name('admin_buildings_update');
            Route::post('/delete/{id}', 'Admin\ConferenceManager\BuildingsController@destroy')->name('admin_buildings_delete');

            Route::group(['prefix'=>'/{building_id}/rooms'], function(){
                Route::get('/list', 'Admin\ConferenceManager\RoomsController@index')->name('admin_rooms_list');
                Route::get('/create', 'Admin\ConferenceManager\RoomsController@create')->name('admin_rooms_create');
                Route::post('/store', 'Admin\ConferenceManager\RoomsController@store')->name('admin_rooms_store');
                Route::get('/edit/{id}', 'Admin\ConferenceManager\RoomsController@edit')->name('admin_rooms_edit');
                Route::post('/update/{id}', 'Admin\ConferenceManager\RoomsController@update')->name('admin_rooms_update');
                Route::post('/delete/{id}', 'Admin\ConferenceManager\RoomsController@destroy')->name('admin_rooms_delete');
            });
        });

        Route::group(['prefix'=>'/speakers'], function(){
            Route::get('/list', 'Admin\ConferenceManager\SpeakersController@index')->name('admin_speakers_list');
            Route::get('/create', 'Admin\ConferenceManager\SpeakersController@create')->name('admin_speakers_create');
            Route::post('/store', 'Admin\ConferenceManager\SpeakersController@store')->name('admin_speakers_store');
            Route::get('/view/{id}', 'Admin\ConferenceManager\SpeakersController@show')->name('admin_speakers_view');
            Route::get('/edit/{id}', 'Admin\ConferenceManager\SpeakersController@edit')->name('admin_speakers_edit');
            Route::post('/update/{id}', 'Admin\ConferenceManager\SpeakersController@update')->name('admin_speakers_update');
            Route::post('/delete/{id}', 'Admin\ConferenceManager\SpeakersController@destroy')->name('admin_speakers_delete');
        });

        Route::group(['prefix'=>'/announcements'], function(){
            Route::get('/list', 'Admin\ConferenceManager\AnnouncementsController@index')->name('admin_announcements_list');
            Route::get('/create', 'Admin\ConferenceManager\AnnouncementsController@create')->name('admin_announcements_create');
            Route::post('/store', 'Admin\ConferenceManager\AnnouncementsController@store')->name('admin_announcements_store');
            Route::get('/edit/{id}', 'Admin\ConferenceManager\AnnouncementsController@edit')->name('admin_announcements_edit');
            Route::post('/update/{id}', 'Admin\ConferenceManager\AnnouncementsController@update')->name('admin_announcements_update');
            Route::post('/delete/{id}', 'Admin\ConferenceManager\AnnouncementsController@destroy')->name('admin_announcements_delete');
        });

        Route::group(['prefix'=>'/session_type'], function(){
            Route::get('/list', 'Admin\ConferenceManager\SessionTypeController@index')->name('admin_session_type_list');
            Route::get('/create', 'Admin\ConferenceManager\SessionTypeController@create')->name('admin_session_type_create');
            Route::post('/store', 'Admin\ConferenceManager\SessionTypeController@store')->name('admin_session_type_store');
            Route::get('/edit/{id}', 'Admin\ConferenceManager\SessionTypeController@edit')->name('admin_session_type_edit');
            Route::post('/update/{id}', 'Admin\ConferenceManager\SessionTypeController@update')->name('admin_session_type_update');
            Route::post('/delete/{id}', 'Admin\ConferenceManager\SessionTypeController@destroy')->name('admin_session_type_delete');
        });

        Route::group(['prefix'=>'/special_event'], function(){
            Route::get('/list', 'Admin\ConferenceManager\SpecialEventController@index')->name('admin_special_event_list');
            Route::get('/create', 'Admin\ConferenceManager\SpecialEventController@create')->name('admin_special_event_create');
            Route::post('/store', 'Admin\ConferenceManager\SpecialEventController@store')->name('admin_special_event_store');
            Route::get('/edit/{id}', 'Admin\ConferenceManager\SpecialEventController@edit')->name('admin_special_event_edit');
            Route::post('/update/{id}', 'Admin\ConferenceManager\SpecialEventController@update')->name('admin_special_event_update');
            Route::post('/delete/{id}', 'Admin\ConferenceManager\SpecialEventController@destroy')->name('admin_special_event_delete');
        });

        Route::group(['prefix'=>'/conference_partners_sponsers'], function(){
            Route::get('/list', 'Admin\ConferenceManager\ConferencePartnerSponserController@index')->name('admin_conference_partners_sponsers_list');
            Route::get('/create', 'Admin\ConferenceManager\ConferencePartnerSponserController@create')->name('admin_conference_partners_sponsers_create');
            Route::post('/store', 'Admin\ConferenceManager\ConferencePartnerSponserController@store')->name('admin_conference_partners_sponsers_store');
            Route::get('/edit/{id}', 'Admin\ConferenceManager\ConferencePartnerSponserController@edit')->name('admin_conference_partners_sponsers_edit');
            Route::post('/update/{id}', 'Admin\ConferenceManager\ConferencePartnerSponserController@update')->name('admin_conference_partners_sponsers_update');
            Route::post('/delete/{id}', 'Admin\ConferenceManager\ConferencePartnerSponserController@destroy')->name('admin_conference_partners_sponsers_delete');
        });

        Route::group(['prefix'=>'/conference_roles'], function(){
            Route::get('/list', 'Admin\ConferenceManager\ConferenceRoleController@index')->name('admin_conference_roles_list');
            Route::get('/create', 'Admin\ConferenceManager\ConferenceRoleController@create')->name('admin_conference_roles_create');
            Route::post('/store', 'Admin\ConferenceManager\ConferenceRoleController@store')->name('admin_conference_roles_store');
            Route::get('/edit/{id}', 'Admin\ConferenceManager\ConferenceRoleController@edit')->name('admin_conference_roles_edit');
            Route::post('/update/{id}', 'Admin\ConferenceManager\ConferenceRoleController@update')->name('admin_conference_roles_update');
            Route::post('/delete/{id}', 'Admin\ConferenceManager\ConferenceRoleController@destroy')->name('admin_conference_roles_delete');
        });

        Route::group(['prefix'=>'/user_conference_roles'], function(){
            Route::get('/list', 'Admin\ConferenceManager\UserConferenceRoleController@index')->name('admin_user_conference_roles_list');
            Route::post('/update/{id}', 'Admin\ConferenceManager\UserConferenceRoleController@update')->name('admin_user_conference_roles_update');
        });

        Route::group(['prefix'=>'/conference_gallery'], function(){
            Route::get('/list', 'Admin\ConferenceManager\ConferenceGalleryController@index')->name('admin_conference_gallery_list');
            Route::post('/store', 'Admin\ConferenceManager\ConferenceGalleryController@store')->name('admin_conference_gallery_store');
            Route::post('/delete/{id}', 'Admin\ConferenceManager\ConferenceGalleryController@destroy')->name('admin_conference_gallery_delete');
        });

        Route::group(['prefix'=>'/review_form'], function() {
            Route::get('/list', 'Admin\ReviewFormController@index')->name('admin_review_form_list');
            Route::get('/create', 'Admin\ReviewFormController@create')->name('admin_review_form_create');
            Route::post('/store', 'Admin\ReviewFormController@store')->name('admin_review_form_store');
            Route::get('/edit/{id}', 'Admin\ReviewFormController@edit')->name('admin_review_form_edit');
            Route::post('/update/{id}', 'Admin\ReviewFormController@update')->name('admin_review_form_update');
            Route::post('/delete/{id}', 'Admin\ReviewFormController@destroy')->name('admin_review_form_delete');

            Route::group(['prefix'=>'/{review_form_id}/criteria'], function() {
                Route::get('/list', 'Admin\CriteriaReviewController@index')->name('admin_criteria_review_list');
                Route::get('/create', 'Admin\CriteriaReviewController@create')->name('admin_criteria_review_create');
                Route::post('/store', 'Admin\CriteriaReviewController@store')->name('admin_criteria_review_store');
                Route::get('/edit/{id}', 'Admin\CriteriaReviewController@edit')->name('admin_criteria_review_edit');
                Route::post('/update/{id}', 'Admin\CriteriaReviewController@update')->name('admin_criteria_review_update');
                Route::post('/delete/{id}', 'Admin\CriteriaReviewController@destroy')->name('admin_criteria_review_delete');
            });
        });

        Route::group(['prefix'=>'/paper'], function() {
            Route::get('/list', 'Admin\PaperController@index')->name('admin_paper_list');
            Route::get('/create', 'Admin\PaperController@create')->name('admin_paper_create');
            Route::post('/store', 'Admin\PaperController@store')->name('admin_paper_store');
            Route::get('/edit/{id}', 'Admin\PaperController@edit')->name('admin_paper_edit');
            Route::post('/update/{id}', 'Admin\PaperController@update')->name('admin_paper_update');
            Route::post('/delete/{id}', 'Admin\PaperController@destroy')->name('admin_paper_delete');
            Route::get('/submission/{id}', 'Admin\PaperController@submission')->name('admin_paper_submission');
            Route::post('/decision/{id}', 'Admin\PaperController@decisionAjax')->name('admin_paper_decision');
        });

        Route::group(['prefix'=>'/time_block'], function(){
            Route::get('/list','Admin\ConferenceManager\TimeBlockController@index')->name('admin_time_block_list');

            Route::get('/create', 'Admin\ConferenceManager\TimeBlockController@create')->name('admin_time_block_create');
            Route::post('/store', 'Admin\ConferenceManager\TimeBlockController@store')->name('admin_time_block_store');

            Route::get('/edit/{id}', 'Admin\ConferenceManager\TimeBlockController@edit')->name('admin_time_block_edit');
            Route::post('/update/{id}', 'Admin\ConferenceManager\TimeBlockController@update')->name('admin_time_block_update');

            Route::post('/delete/{id}', 'Admin\ConferenceManager\TimeBlockController@destroy')->name('admin_time_block_delete');
        });

        Route::group(['prefix'=>'/schedule'], function(){
            Route::get('/list','Admin\ConferenceManager\ScheduleController@index')->name('admin_schedule_list');

            Route::get('/getTable','Admin\ConferenceManager\ScheduleController@getTable')->name('admin_schedule_getTable');

            Route::get('/store','Admin\ConferenceManager\ScheduleController@addSchedule')->name('admin_schedule_store');

            Route::get('/delete','Admin\ConferenceManager\ScheduleController@delete')->name('admin_schedule_delete');
        });

        Route::group(['prefix'=>'/calendar'], function(){
            Route::get('/calendarPaper','Admin\ConferenceManager\CalendarController@index')->name('admin_calendar_list');

            Route::get('/getData','Admin\ConferenceManager\CalendarController@getData')->name('admin_calendar_getData');

            Route::get('/calendarConference','Admin\ConferenceManager\CalendarController@calendarConference')->name('admin_calendar_calendarConference');

            Route::get('/getDataConference','Admin\ConferenceManager\CalendarController@getDataConference')->name('admin_calendar_getDataConference');
        });

        Route::group(['prefix'=>'/{paper_id}/review_assignment'], function() {
            Route::post('/store', 'Admin\ConferenceManager\ReviewAssignmentController@store')->name('admin_review_assignment_store');
        });
    });

});

/**
 * PAGE FOR REVIEWER
 */
Route::group(['prefix'=>'/conf/{conference_id}','middleware' => ['auth']], function() {
    Route::group(['prefix' => '/reviewer'], function () {
        Route::get('/paper/list', 'Admin\ConferenceManager\ReviewAssignmentController@showPaperList')->name('reviewer_paper_list');
        Route::get('/do_review/{assignment_id}', 'Admin\ConferenceManager\ReviewAssignmentController@showAssignment')->name('reviewer_do_review');
        Route::post('/store_assignment/{assignment_id}', 'Admin\ConferenceManager\ReviewAssignmentController@storeAssignment')->name('reviewer_store_assignment');
        Route::post('/reject/{assignment_id}', 'Admin\ConferenceManager\ReviewAssignmentController@rejectAssignment')->name('reviewer_reject_assignment');
        Route::post('/accept/{assignment_id}', 'Admin\ConferenceManager\ReviewAssignmentController@acceptAssignment')->name('reviewer_accept_assignment');
//        Route::get('/edit/{id}', 'Admin\ConferenceManager\ReviewAssignmentController@edit')->name('reviewer_paper_edit');
//        Route::post('/update/{id}', 'Admin\ConferenceManager\ReviewAssignmentController@update')->name('reviewer_paper_update');
//        Route::post('/delete/{id}', 'Admin\ConferenceManager\ReviewAssignmentController@destroy')->name('reviewer_paper_delete');
    });

});
Route::get('/mail/test', 'Admin\ConferenceManager\ReviewAssignmentController@testMail');
/**
 * AUTHENTICATION
 */
Auth::routes();
Route::get('/login/magic_link', 'Auth\MagicController@show')->name('show_login_magic_link');
Route::post('/login/magic_link', 'Auth\MagicController@sendToken')->name('send_magic_link');
Route::get('/magic_link', 'Auth\MagicController@authenticate')->name('authenticate_using_token');
/**
 *
 */
Route::post('/notify', 'EmailController@notify');

Route::group(['prefix'=>'home'],function(){
    Route::get('/index','Home\MainController@index')->name('home_page');

    Route::get('/main','Home\MainController@getData')->name('home-main');

    Route::post('/main/search','Home\MainController@searchPost')->name('home-search');

    Route::get('/news','Home\MainController@getNews')->name('home-news');
    Route::get('/news/{slug}','Home\MainController@getNewsDetail')->name('home-newsDetail');

    Route::get('/news_category/{slug}','Home\MainController@getNewsByCategory')->name('home-news_category');

    Route::get('/news_tags/{tag}','Home\MainController@getNewsByTag')->name('home-news_tag');

    Route::get('/event','Home\MainController@getEvent')->name('home-event');
    Route::get('/event/{slug}','Home\MainController@getEventDetail')->name('home-eventDetail');

    Route::get('/event_category/{slug}','Home\MainController@getEventByCategory')->name('home-event_category');

    Route::get('/event_tags/{tag}','Home\MainController@getEventByTag')->name('home-event_tag');

    Route::get('/event/registration/{id}','Home\MainController@createFormRegistraion')->name('create-form');
    Route::post('/event/registration/store','Home\MainController@addRegisterEvent')->name('store-register');

    //User Profile
    Route::group(['prefix'=>'profile'], function(){
        Route::get('/view','Home\UserProfileController@index')->name('home_profile_view');

        Route::get('/edit/{id}','Home\UserProfileController@edit')->name('home_profile_edit');
        Route::post('/update/{id}','Home\UserProfileController@update')->name('home_profile_update');
    });

    //Change Password
    Route::group(['prefix'=>'changepassword'], function(){
        Route::get('/view','Home\ChangePasswordController@index')->name('home_changepassword_view');
        Route::post('/save','Home\ChangePasswordController@store')->name('home_changepassword_save');
    });
});

Route::group(['prefix'=>'/conference/{conference_path}'], function() {
         Route::get('/home','Conference\ConferenceController@index')->name('conference_home');
});
