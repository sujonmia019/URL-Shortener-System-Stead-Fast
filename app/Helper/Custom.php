<?php


if (!function_exists('table_checkbox')) {
    function table_checkbox($row_id){
        return '<div class="form-checkbox">
            <input type="checkbox" class="form-check-input select_data" id="checkbox-'.$row_id.'" value="'.$row_id.'" onClick="select_single_item('.$row_id.')">
            <label class="form-check-label" for="checkbox-'.$row_id.'"></label>
        </div>';
    }
}

if (!function_exists('set_page_data')) {
    function set_page_data(string $page_title = null, string $site_title){
        return view()->share(['title'=>$page_title,'site_title'=>$site_title]);
    }
}

if (!function_exists('tooltip')) {
    function tooltip(string $title){
        return 'data-widget="collapse" data-toggle="tooltip" title="'.$title.'"';
    }
}
