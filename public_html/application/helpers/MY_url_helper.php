<?php
    function api_url($suffix_url = ''){
        return BASE_URL_API. $suffix_url;
    }

    function url_suffix () {
        return config_item('url_suffix');
    }

    function assets_version($version = false){
        if(false === $version)
            return "";
        else if(true === $version)
            return config_item(__FUNCTION__);
        else
            return $version;
    }

    function assets_ver_str($version = false){
        if(false === $version)
            return "";
        else
            return "?v=".assets_version($version);
    }

    function linkCSS ($files_arr, $url_prefix = false, $caching_free = false) {
        $files_arr = (false === is_array($files_arr)) ? [$files_arr] : $files_arr;
        if(false === $url_prefix){
            foreach($files_arr as $f){
                echo '<link rel="stylesheet" href="' . base_url('assets/css/' . $f . '.css'). assets_ver_str($caching_free) . '">'.PHP_EOL;
            }
        }else{
            $url_prefix = trim(str_replace('\\','/', $url_prefix), '/');            
            foreach($files_arr as $f){
                $f = trim(str_replace('\\','/', $f), '/');                
                echo '<link rel="stylesheet" href="' . base_url($url_prefix ."/". $f . '.css'). assets_ver_str($caching_free) . '">'.PHP_EOL;
            }
        }
    }

    function linkJS ($js_files_arr, $url_prefix = false, $caching_free = false) {
        $js_files_arr = (false === is_array($js_files_arr)) ? [$js_files_arr] : $js_files_arr;
        if(false === $url_prefix){
            foreach($js_files_arr as $f){
                echo '<script src="' . base_url('assets/js/' . $f . '.js'). assets_ver_str($caching_free) . '"></script>'.PHP_EOL;
            }
        }else{
            $url_prefix = trim(str_replace('\\','/', $url_prefix), '/');            
            foreach($js_files_arr as $f){
                $f = trim(str_replace('\\','/', $f), '/');            
                echo '<script src="' . base_url($url_prefix ."/". $f . '.js'). assets_ver_str($caching_free) . '"></script>'.PHP_EOL;
            }
        }
    }

    function linkSiteIcon ($image_path, $type = 'png') {
        $valid_icon = ['png','ico'];
        if(!in_array($type, $valid_icon))
            return false;
        if($type == "png"){
            echo '<link rel="icon" type="image/png" href="' . $image_path . '">'.PHP_EOL;
        }
        elseif($type == "ico") {
            echo '<link rel="icon" type="img/ico" href="'.$image_path.'">'.PHP_EOL;
        }
    }

    function load_ui_library(array $lib_arr, $module='css'){
        $listed_library  = config_item('assets_libs');
        foreach($lib_arr as $libs){
            $filter_lib_name = strtolower(preg_replace('/[^\w]/i', "_", $libs));
            if(array_key_exists($filter_lib_name, $listed_library)){
                if(true === isset($listed_library[$filter_lib_name]['files']['css']) && $module === "css")
                    linkCSS($listed_library[$filter_lib_name]['files']['css'], $listed_library[$filter_lib_name]['root_path'], true);
                if(true === isset($listed_library[$filter_lib_name]['files']['js']) && $module === "js")
                    linkJS ($listed_library[$filter_lib_name]['files']['js'], $listed_library[$filter_lib_name]['root_path'], true);
            }else{
                echo "UI library ($libs) not listed/found which you wanted to load".PHP_EOL;
            }
        }
    }

    function writePageTitle($pageTitle = ""){
        echo "{ ". COMPANY_NAME ." } ". $pageTitle;
    }