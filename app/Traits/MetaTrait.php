<?php

namespace App\Traits;


trait MetaTrait
{


    public function getDescription(){

        // if(strlen($this->description) > 2){
        //     $res = strip_tags($this->description);
        // }
        // else{
            $res = siteSettings('description');
        // }
        return $res;
    }

    public function getKeywords(){

        // if(strlen($this->tags) > 2){
        //     $res = $this->tags;
        // }
        // else{
            $res = siteSettings('tags');
        // }
        return $res;
    }


    public function getOgImage(){
        // if($this->og_image){
        //     $res = $this->og_image;
        // }
        // else if($this->main_image){
        //     $res = $this->main_image;
        // }
        // else{
        //     $res = siteSettings('og_image');
        // }
        // return Resize::img($res,'mainMedia');

        return "";
    }

    public function getOgDescription(){
        if(strlen($this->og_description) > 2){
            $res = $this->og_description;
        }
        else if(strlen($this->description) > 2){
            $res = $this->description;
        }
        else{
            $res = siteSettings('description');
        }
        return $res;
    }


}
