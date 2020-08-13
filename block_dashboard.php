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
 * Contains the class for dashboard block
 * 
 * @package block_dashboard
 * @copyright 2020 Grupo Saite
 * @author Vinicius Costa Castro <costacastrovinicius7@gmail.com>
 */
class block_dashboard extends block_base {
    /**
     * Init
     */
    public function init() {
        $this->title = get_string("pluginname", "block_dashboard");
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

        $renderer = $this->page->get_renderer("block_dashboard");
        //var_dump($renderer);
        $this->content = (object) array(
            "text" => $renderer->render(),
        );

        //var_dump($this->content);
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