<?php
namespace App\Traits;

use App\Models\Settings;

trait GeneralTrait{

    protected function slug($string){
        return urlencode(strtolower(str_replace(' ', '-', str_replace('/', '', $string))));
    }

    protected function generateCustomID($id){
        if(strlen($id) == 1){
            $id_string = "AAMS-000" . $id;
        }elseif(strlen($id) == 2){
            $id_string = "AAMS-00" . $id;
        }elseif(strlen($id) == 3){
            $id_string = "AAMS-0" . $id;
        }else{
            $id_string = "AAMS-" . $id;
        }

        return $id_string;
    }
    // Site Info
    protected function settings($group, $name){
        $q = Settings::where('group', $group)->where('name', $name)->first();

        // Null Check
        if ($q){
            return $q->value;
        }else{
            return null;
        }
    }

    // Site Info by Group
    protected function settingsGroup($group){
        return Settings::where('group', $group)->get();
    }

    // Site Info by Keys
    protected function settingsGroupKey($group = 'general'){
        $query = Settings::where('group', $group)->get();

        // Generate Output
        $output = [];
        foreach($query as $data){
            if($data->name == 'logo' || $data->name == 'favicon' || $data->name == 'og_image'){
                $output[$data->name] = asset('uploads/info/' . $data->value);
            }else{
                $output[$data->name] = $data->value;
            }
        }

        return $output;
    }

    protected function halls()
    {
        return [
            "Test Hall",
        ];
    }

    protected function blood_group(){
        return [
            "A+",
            "A-",
            "B+",
            "B-",
            "O+",
            "O-",
            "AB+",
            "AB-"
        ];
    }

    protected function tShirts(){
        return [
            "XS",
            "S",
            "M",
            "L",
            "XL",
            "XXL"
        ];
    }

    protected function months(){
        return [
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",
            "September",
            "October",
            "November",
            "December"
        ];
    }

    protected function days(){
        return [
            "1",
            "2",
            "3",
            "4",
            "5",
            "6",
            "7",
            "8",
            "9",
            "10",
            "11",
            "12",
            "13",
            "14",
            "15",
            "16",
            "17",
            "18",
            "19",
            "20",
            "21",
            "22",
            "23",
            "24",
            "25",
            "26",
            "27",
            "28",
            "29",
            "30",
            "31"
        ];
    }

    protected function years(){
        $from_year = 1970;
        $current_year = date('Y');
        $duration = $current_year - $from_year;

        $years = array();
        for($y = 0; $y <= $duration; $y++){
            $years[] = $from_year + $y;
        }

        return $years;
    }

    protected function pageTemplates(){
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
            'name' => 'Contact Us',
            'blade' => 'contactUs'
        ];

        return $template;
    }

}
