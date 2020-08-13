<?php

namespace block_dashboard;

use advanced_testcase;
use block_dashboard\extras\utils;

/**
 * Dashboard block unitary tests
 * 
 * @package block_dasboard
 * @copyright 2020 Grupo Saite
 * @author Vinicius Costa Castro <costacastrovinicius7@gmail.com>
 */
class block_dashboard_course_test extends advanced_testcase {
    /**
     * Checks whether the get_courses function returns only eligible courses
     * 
     * @return null
     */
    public function test_course_query() {
        global $DB;

        $this->resetAfterTest(true);
        $this->resetAllData();
        $user1 = $this->getDataGenerator()->create_user();
        $course1 = $this->getDataGenerator()->create_course(array(
            "format" => "classroom",
            "isunit" => 1,
        ));
        $course2 = $this->getDataGenerator()->create_course(array(
            "format" => "classroom",
            "isunit" => 0,
        ));
        $this->getDataGenerator()->enrol_user($user1->id, $course1->id);
        $this->getDataGenerator()->enrol_user($user1->id, $course2->id);
        $this->setUser($user1->id);
        $courses = utils::get_courses();
        $this->assertEquals($courses[0]->id, $course2->id);
        $this->resetAllData();
    }
}