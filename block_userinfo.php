<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Contains the class for userinfo block
 * 
 * @package block_userinfo
 * @copyright 2020 Grupo Saite
 * @author José Ribamar Durand <junior_durand@outlook.com>
 */
class block_userinfo extends block_base {
    /**
     * Init
     */
    public function init() {
        $this->title = get_string("pluginname", "block_userinfo");
    }

    /**
     * Returns the contents.
     * 
     * @return stdClass contents of block
     */
    public function get_content() {
        if (isset($this->content)) {
            return $this->content;
        }

        $renderer = $this->page->get_renderer("block_userinfo");

        $this->content = (object) array(
            "text" => $renderer->render(),
        );

        return $this->content;
    }

    /**
     * Locations where block can be displayed
     * 
     * @return array
     */
    public function applicable_formats() {
        return array(
            "my" => true,
        );
    }
}