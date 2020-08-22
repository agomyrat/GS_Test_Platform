<?php

class _Object{
	public $param;

	function __construct(){
		$param = 'halal';
	}
}

    class Test extends Controller
{
	
	function __construct()
	{
		parent::__construct();
        $this->view->layout = "test";
	}

	public function index(){
		//Polyglot::setPage('test_constructor');
		$this->view->render('test_constructor/index');
		
	}

	public function constructor($array = null){
		if(!empty($array)){
			$test_id = $array[0];
			$this->view->render('test_constructor/index',['test_id'=>$test_id]);
		}else{
			$test_id = _Test::createTest(SESSION::get(USER_ID));
			$this->redirect('test/constructor/'.$test_id);
		}
	}

	public function getQuestions(){
		echo json_encode(_Test::getQuestions($_POST['data']['test_id']));
	}

	public function deleteQuestion(){
		print_r($_POST);
		$this->deleteDatasAndFiles($_POST['questionId']);
	}

	public function saveQuestion(){
		//print_r((json_decode($_POST['data'])));
		//print_r($_FILES);
		//print_r(json_decode($_POST['data']));

		$extractedDatas = $this->extractDatas(json_decode($_POST['data']));

		$questionId = $extractedDatas['questionId'];
		$question = $extractedDatas['question'];
		$choices = $extractedDatas['choices'];
		$answers = $extractedDatas['answers'];
		$testId = $extractedDatas['testId'];
		$questionType = $extractedDatas['questionType'];
		$isRandom = $extractedDatas['isRandom'];
		$hasImage = $extractedDatas['hasImage'];

		if(Question::has($questionId)){
			$this->deleteDatasAndFiles($questionId);
		}

		$questionImages = $this->extractQuestionImages($_FILES);
		$choiceImages = $this->extractChoiceImages($_FILES);
		$questionImagesNames = $this->uploadImages($questionImages);
		$choiceImagesNames = $this->uploadImages($choiceImages);
		$questionImagePaths = $this->generatePath($questionImagesNames);
		$choicesImagePaths = $this->generatePath($choiceImagesNames);
		$choices = ($this->antiExtractImages($choicesImagePaths,$choices));

		if($questionImagesNames !== false  && $choiceImagesNames !== false){
			$questionId = Question::insertQuestion(['testId' => $testId,
		 										 'question'=>$question,
		 										 'questionImages'=>$questionImagesNames,
		 										 'questionData'=>$choices,
		 										 'choiceImages'=>$choiceImagesNames,
		 										 'answers'=>$answers,
		 										 'questionType'=>$questionType,
												 'isRandom'=>$isRandom,
												 'hasImage'=>$hasImage 				 
												  ]);

			$response_array = [
				'question' => $question,
				'choices' =>json_decode($choices),
				'answer'=>json_decode($answers),
				'type'=>$questionType,
				'hasImage'=>$hasImage,
				'isRandom'=>$isRandom,
				'id'=> $questionId,
				'qFilePaths'=> json_decode($questionImagePaths),
				'cFilesPaths'=>json_decode($choicesImagePaths)
			];
			
			echo json_encode($response_array);
			}else{ echo 'Suratlar we datalar save edilmedi!';}
	}

	public function extractDatas($object){
		$extractedDatasArray = [];

		if(!empty($object)){
			$extractedDatasArray['questionId'] = isset($object->id) ? $object->id : '0';
			$extractedDatasArray['question'] = isset($object->question) ? $object->question : '';
			$extractedDatasArray['choices'] = isset($object->choices) ? json_encode($object->choices) : '';
			$extractedDatasArray['answers'] = isset($object->answer) ? json_encode($object->answer) : '';
			$extractedDatasArray['testId'] = isset($object->testId) ? $object->testId : 1;
			$extractedDatasArray['questionType'] = isset($object->type) ? $object->type : 'single-choice'; 
			$extractedDatasArray['isRandom'] = isset($object->isRandom) ? $object->isRandom : 0; 
			$extractedDatasArray['hasImage'] = isset($object->hasImage) ? $object->hasImage : 0;
		}

		return $extractedDatasArray;
	}

	public function extractQuestionImages($array=null){
		$questionImages = [];
		$counter = 0;
		while(!empty($array)){
			if(isset($array['qFile-'.$counter])){
				array_push($questionImages , $array['qFile-'.$counter]);
			}else{
				break;		
			}
			$counter++;
		}

		return $questionImages;
	}

	public function extractChoiceImages($array=null){
		$questionImages = [];
		$counter = 0;
		while(!empty($array)){
			if(isset($array['file-'.$counter])){
				array_push($questionImages , $array['file-'.$counter]);
			}else{
				break;		
			}
			$counter++;
		}
		
		return $questionImages;
	}

	public function extractImageNames($array){
		$imagesNames = [];
		if(!empty($array)){
			foreach($array as $image){
				array_push($imagesNames, uniqid($image['size']));
			}
		}
		return json_encode($imagesNames);
	}

	public function uploadImages($imagesArray){
		$imagesNames = [];
		//birinji hemme suratlary foreach bilen barlamaly
		//son hemme suratlary foreach bilen upload etmeli
		if(!empty($imagesArray)){ 

			foreach($imagesArray as $image){
				$type = $image['type'];
				$error = $image['error'];
				$size = $image['size'];
			
				$type_exploded = explode('/', rtrim($type, '/') );
				$actualExt = strtolower(end($type_exploded));
				$permitted = array('jpg', 'jpeg', 'png', 'gif', 'JPG', 'JPEG', 'PNG' , 'GIF');

				if(!(in_array($actualExt, $permitted) && $error===0 && $size<5000000)){ return false;}
			}

			foreach($imagesArray as $image){
				$type = $image['type'];
				$tmp_name = $image['tmp_name'];
				$error = $image['error'];
				$size = $image['size'];
				$name = uniqid($size);

				$type_exploded = explode('/', rtrim($type, '/') );
				$actualExt = strtolower(end($type_exploded));
				$permitted = array('jpg', 'jpeg', 'png', 'gif', 'JPG', 'JPEG', 'PNG' , 'GIF');
				$actualName = $name.'.'.$actualExt;

				$destination = 'uploads/'.$actualName;
				move_uploaded_file($tmp_name, $destination);
				array_push($imagesNames, $actualName);
			}
		}

		return json_encode($imagesNames);
	}

	public function generatePath($json){
		$pathArray = [];
		if(!empty($json)){
			$array = json_decode($json);
			foreach ($array as $element) {
				$path = URL.'uploads/'.$element;
				array_push($pathArray,$path);
			}
		}

		return json_encode($pathArray);
	}

	public function antiExtractImages($jsonImagePathsArray,$jsonArrayWithPathKeys){
		$arrayWithPathKeys = json_decode($jsonArrayWithPathKeys);
		$imagePathsArray = json_decode($jsonImagePathsArray);
		if(!empty($arrayWithPathKeys) && !empty($imagePathsArray)){
			for ($i=0; $i < count($arrayWithPathKeys); $i++) {
				$arrayWithPathKeys[$i]->path = $imagePathsArray[$i];
			}
			return json_encode($arrayWithPathKeys);
		}
		return $jsonArrayWithPathKeys;
	}

	public function deleteDatasAndFiles($questionId){
			$fileNamesArray = Question::getImageNames($questionId);
			Question::deleteRow($questionId);
			foreach($fileNamesArray as $fileName){
				$path = 'uploads/'.$fileName;
				if(file_exists($path)){
					unlink('uploads/'.$fileName);
				}			
			}
	}

	public function practice(){
		// echo "<pre>";
		// print_r(_Test::getQuestions(1));
		print_r(_Test::get(4,['TEST_ID','CREATED_BY','TEST_NAME']));
		
	}


}