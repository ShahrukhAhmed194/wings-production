<?php

// namespace App\Repositories;

use App\Models\Settings;

class Info {

    public static function Settings($group, $name){
        $q = Settings::where('group', $group)->where('name', $name)->first();

        // Null Check
        if ($q){
            return $q->value;
        }else{
            return null;
        }
    }
    // Site Info by Group
    public static function SettingsGroup($group){
        return Settings::where('group', $group)->get();
    }

    // Site Info by Keys
    public static function SettingsGroupKey($group = 'general'){
        $query = Settings::where('group', $group)->get();

        // Generate Output
        $output = [];
        foreach($query as $data){
            if($data->name == 'logo' || $data->name == 'footer_logo' || $data->name == 'favicon' || $data->name == 'og_image' || $data->name == 'pm_image' || $data->name == 'homepage_banner_image'){
                $output[$data->name] = asset('uploads/info/' . $data->value);
            }else{
                $output[$data->name] = $data->value;
            }
        }

        // // Return Default
        // foreach($keys as $key){
        //     if(!isset($output[$key])){
        //         $output[$key] = null;
        //     }
        // }

        return $output;
    }

    public static function pageTemplates(){
        $template = array();

        $template[] = [
            'name' => 'Committee',
            'blade' => 'committee'
        ];

        $template[] = [
            'name' => 'Member List',
            'blade' => 'members'
        ];

        $template[] = [
            'name' => 'Notice',
            'blade' => 'noticeboard'
        ];

        $template[] = [
            'name' => 'News',
            'blade' => 'news.index'
        ];

        $template[] = [
            'name' => 'Galleries',
            'blade' => 'galleries'
        ];

        $template[] = [
            'name' => 'Second Galleries',
            'blade' => 'second-gallery'
        ];

        $template[] = [
            'name' => 'Contact Us',
            'blade' => 'contactUs'
        ];

        return $template;
    }
}
