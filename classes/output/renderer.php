<?php

namespace block_userinfo\output;

use stdClass;
use plugin_renderer_base;
use block_userinfo\extras\utils;

/**
 * userinfo block renderer
 * 
 * @package block_userinfo
 * @copyright 2020 Grupo Saite
 * @author José Ribamar Durand <junior_durand@outlook.com>
 */
class renderer extends plugin_renderer_base {
    /**
     * Export this data so it can be used as the context for a mustache template
     * 
     * @return stdClass
     */
    public function export_for_template() {


        $templatecontext = new stdClass();
        $templatecontext = utils::get_user_info();
        return $templatecontext;
    }

    /**
     * Return the content for the block userinfo.
     * 
     * @return string HTML String
     */
    public function render() {
        return $this->render_from_template("block_userinfo/main", $this->export_for_template());
    }
}