<?php

    class company{
        public $name;
        public $website;
        public $overall_rating;
        public $culture_rating;
        public $leadership_rating;
        public $compensation_rating;
        public $opportunity_rating;
        public $wlbalance;
        public $location;
        public $pros;
        public $cons;
		public $logo;
		public $jobtitle;
        
        public function setName($input){
            $this->name = $input;
        }
        
        public function setWebsite($input){
            $this->website = $input;
        }
		
		public function setTitle($input){
            $this->jobtitle = $input;
        }
        
        public function setOverall($input){
            $this->overall_rating = $input;
        }
        
        public function setCulture($input){
            $this->culture_rating = $input;
        }
        
        public function setLeadership($input){
            $this->leadership_rating = $input;
        }
        
        public function setCompensation($input){
            $this->compensation_rating = $input;
        }
        
        public function setOpportunity($input){
            $this->opportunity_rating = $input;
        }
        
        public function setWLBalance($input){
            $this->wlbalance = $input;
        }
        
        public function setLocation($input){
            $this->location = $input;
        }
        public function setPros($input){
            $this->pros = $input;
        }
        public function setCons($input){
            $this->cons = $input;     
        }
		
		public function setLogo($input){
            $this->logo = $input;
        }
        
        public function getName(){
            return $this->name . "<br/>";
        }
        public function getWebsite(){
            return $this->website;
        }
		 public function getTitle(){
            return $this->jobtitle . "<br/>";
        }
        public function getOverall(){
            return $this->overall_rating . "<br/>";
        }
        public function getCulture(){
            return $this->culture_rating . "<br/>";
        }
        public function getLeadership(){
            return $this->leadership_rating . "<br/>";
        }
        public function getCompensation(){
            return $this->compensation_rating . "<br/>";
        }
        public function getOpportity(){
            return $this->opportunity_rating . "<br/>";
        }
        public function getWLBalance(){
            return $this->wlbalance . "<br/>";
        }
        public function getLocation(){
            return $this->location . "<br/>";
        }
        public function getPros(){
            return $this->pros . "<br/>";
        }
        public function getCons(){
            return $this->cons . "<br/>";
        }
		
		public function getLogo(){
            return $this->logo;
        }
		

    }

?>
