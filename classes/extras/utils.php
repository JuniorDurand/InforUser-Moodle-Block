<?php

namespace block_userinfo\extras;

require_once("$CFG->dirroot/course/lib.php");

use stdClass;
use core_course_category;
use moodle_url;

/**
 * Useful functions class
 * 
 * @package block_userinfo
 * @copyright 2020 Grupo Saite
 * @author José Ribamar Durand <junior_durand@outlook.com>
 */
class utils {
    /**
     * Returns a list of courses eligible for the block proposal
     * 
     * @return array
     */
    public static function get_courses() {      
        $response = array();
        $courses = course_get_enrolled_courses_for_logged_in_user();
        
        foreach ($courses as $course) {
            $course = course_get_format($course->id)->get_course();
            
            if ($course->isunit) {
                continue;
            }
            
            $course->courseimage = utils::get_course_summary_image($course);
            $course->viewurl = new moodle_url("/course/view.php", array(
                "id" => $course->id,
            ));
            
            $response[] = $course;
        }
        
        return $response;
    }


    public static function get_user_info() {
        global $USER;
        global $DB;
        $user = $DB->get_records('user');

        $templatecontext = new stdClass();
        $templatecontext->user_name = $USER->username;
        $templatecontext->email = $USER->email;
        $templatecontext->email = $USER->email;
        $templatecontext->firstname = $USER->firstname;
        $templatecontext->lastname = $USER->lastname;
        
        

        var_dump($USER);
        echo "<br>-------------------<br>";
        var_dump($templatecontext);
        
        return $templatecontext;
    }
    
    /**
     *
     */
    public static function get_course_summary_image(stdClass $course) {
        global $CFG;
        
        $url = "$CFG->wwwroot/theme/saiteava/pix/theme/default-course.jpg";
        $category = core_course_category::get($course->category);
        $courses = $category->get_courses();
        
        foreach ($courses as $categoryCourse) {
            if ($categoryCourse->id === $course->id) {
                foreach ($categoryCourse->get_course_overviewfiles() as $file) {
                    if ($file->is_valid_image()) {
                        $components = array(
                            "/pluginfile.php",
                            $file->get_contextid(),
                            $file->get_component(),
                            $file->get_filearea(),
                            $file->get_filepath(),
                            $file->get_filename(),
                        );

                        $path = implode("/", $components);
                        return (new moodle_url($path))->out();
                    }
                }

                break;
            }
        }

        return $url;
    }

}