<?php
    include 'company.php';
    
    session_start();
    
    //get all the form variables
    $title = $_GET["title"];
    $location = $_GET["location"];
    $radius = $_GET["radius"];
    $position = $_GET["position"];
    
    //parsing string for city and state
    $newlocation = explode(",", $location);
    //echo $newlocation[0]; //city
    //echo $newlocation[1]; //state
    
    //adds an underscore to the city and/or state if they consist of two words
    $newlocation[0] = str_replace(" ", "_", $newlocation[0]);
    $newlocation[1] = str_replace(" ", "_", $newlocation[1]);

    //store location and radius into session variables bc the google map needs them to function
    $_SESSION['location'] = $location;
    $_SESSION['radius'] = $radius;

    //api url
    $service_url = "http://api.glassdoor.com/api/api.htm?t.p=143255&t.k=feruwLf5Ofc&userip=127.0.0.1&useragent=Chrome/57.0.2987.133&format=json&v=1&action=employers&city=$newlocation[0]&state=$newlocation[1]";
    $curl = curl_init($service_url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $curl_response = curl_exec($curl);
    if ($curl_response === false) {
        $info = curl_getinfo($curl);
        curl_close($curl);
        die('error occured during curl exec. Additioanl info: ' . var_export($info));
    }
    curl_close($curl);

    //decodes json response to an array
    $decoded = json_decode($curl_response);
    if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
        die('error occured: ' . $decoded->response->errormessage);
    }
   // echo $_SESSION['location'];
	
    $companyList = array();
	//prints out necessary properties from the json objects
	for($x = 0; $x <= count((array)$decoded); $x++)
	{
        $companyObj = new company;
		//parses the company name from the json object
		//echo "Company Name: ";
		//var_export($decoded->response->employers[$x]->name);
        $companyObj->setName($decoded->response->employers[$x]->name);
		//echo "<br>";
		//parses the company website from the json object
		//echo "Company Website: ";
		//var_export($decoded->response->employers[$x]->website);
        $companyObj->setWebsite($decoded->response->employers[$x]->website);

		//echo "<br>";
		//parses the company's overall rating from the json object
		//echo "Company's Overall Rating: ";
		//var_export($decoded->response->employers[$x]->overallRating);
        $companyObj->setOverall($decoded->response->employers[$x]->overallRating);

		//echo "<br>";
		//parses the company's culture and value rating from the json object
		//echo "Company's Culture and Values Rating: ";
		//var_export($decoded->response->employers[$x]->cultureAndValuesRating);
        $companyObj->setCulture($decoded->response->employers[$x]->cultureAndValuesRating);

		//echo "<br>";
		//parses the company's senior leadership rating from the json object
		//echo "Company's Senior Leadership Rating: ";
		//var_export($decoded->response->employers[$x]->seniorLeadershipRating);
        $companyObj->setLeadership($decoded->response->employers[$x]->seniorLeadershipRating);

		//echo "<br>";
		//parses the company's compensation and benefits rating from the json object
		//echo "Company's Compensation and Benefits Rating: ";
		//var_export($decoded->response->employers[$x]->compensationAndBenefitsRating);
        $companyObj->setCompensation($decoded->response->employers[$x]->compensationAndBenefitsRating);

		//echo "<br>";
		//parses the company's career opportunities rating from the json object
		//echo "Company's Career Opportunities Rating: ";
		//var_export($decoded->response->employers[$x]->careerOpportunitiesRating);
        $companyObj->setOpportunity($decoded->response->employers[$x]->careerOpportunitiesRating);

		//echo "<br>";
		//parses the company's work life balance rating from the json object
		//echo "Company's Work Life Balance Rating: ";
		//var_export($decoded->response->employers[$x]->workLifeBalanceRating);
        $companyObj->setWLBalance($decoded->response->employers[$x]->workLifeBalanceRating);

		//echo "<br>";
		//parses the job title from the json object
		//echo "Job Title: ";
		//var_export($decoded->response->employers[$x]->featuredReview->jobTitle);
		//echo "<br>";
		//parses the location from the json object
		//echo "Job Location: ";
		//var_export($decoded->response->employers[$x]->featuredReview->location);
        $companyObj->setLocation($decoded->response->employers[$x]->featuredReview->location);

		//echo "<br>";
		//parses the headline from the json object
		//echo "Headline: ";
		//var_export($decoded->response->employers[$x]->featuredReview->headline);
		//echo "<br>";
		//parses the pros from the json object
		//echo "Company Pros: ";
		//var_export($decoded->response->employers[$x]->featuredReview->pros);
        $companyObj->setPros($decoded->response->employers[$x]->featuredReview->pros);

		//echo "<br>";
		//parses the cons from the json object
		//echo "Company Cons: ";
		//var_export($decoded->response->employers[$x]->featuredReview->cons);
        $companyObj->setCons($decoded->response->employers[$x]->featuredReview->cons);

		echo "<br>";
		echo "<br>";
        array_push($companyList, $companyObj);
	}

    $_SESSION["companies"] = $companyList;

    foreach($_SESSION["companies"] as &$value){
        echo var_export($value->getName());
        
    }
	//testing purposes
   //var_export($decoded->response);
   // echo $decoded->response;
   
   //uncomment after testing
	header("Location: map.php");
?>