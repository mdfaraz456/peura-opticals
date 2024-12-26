<?php
    class BannerPage{
        private $Type;
        private $conndb;
        function getBanners()
        {
            $conn = new dbClass;
           
            $this->conndb = $conn;
    
            $stmt = $conn->getAllData("SELECT * FROM `banner` WHERE `status` = 1 ORDER BY `id` DESC");
            return $stmt;
        }
    }
    class TestimonialPage {
        public function getTestimonial(){
            $conn = new dbClass;
    
            $output = $conn->getAllData("SELECT * FROM `testimonial` WHERE `status` = 1 ORDER BY `id` DESC");
            return $output;
        }
    }
?>