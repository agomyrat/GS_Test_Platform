<?php 

    class Helper {
        public static function extractDatas($object){
            $extractedDatasArray = [];

			if(!empty($object)){
				$extractedDatasArray['questionId'] = isset($object->id) ? $object->id : '0';
				$extractedDatasArray['question'] = isset($object->question) ? $object->question : '';
				$extractedDatasArray['choices'] = isset($object->choices) ? $object->choices : '';
				$extractedDatasArray['answers'] = isset($object->answer) ? $object->answer : '';
				$extractedDatasArray['testId'] = isset($object->testId) ? $object->testId : 1;
				$extractedDatasArray['questionType'] = isset($object->type) ? $object->type : 'single-choice'; 
				$extractedDatasArray['isRandom'] = isset($object->isRandom) ? $object->isRandom : 0; 
				$extractedDatasArray['hasImage'] = isset($object->hasImage) ? $object->hasImage : 0;
				$extractedDatasArray['order'] = isset($object->order) ? $object->order : 0;
				$extractedDatasArray['path'] = isset($object->path) ? $object->path : null;
			}
			return $extractedDatasArray;
		}

		public static function checkAndGetFileName($file){
			$type = $file['type'];
			$error = $file['error'];
			$size = $file['size'];
			$name = uniqid($size);
			time_nanosleep(0,50000000);//sleeps for 5 milliseconds

			$type_exploded = explode('/', rtrim($type, '/') );
			$actualExt = strtolower(end($type_exploded));
			$permitted = array('jpg', 'jpeg', 'png', 'gif', 'JPG', 'JPEG', 'PNG' , 'GIF');
			$actualName = $name.'.'.$actualExt;

			return (in_array($actualExt, $permitted) && $error===0 && $size<2000000) ? $actualName : null;
		}

		public static function uploadQuestionFile($files){
			if(isset($files['qFile'])){
				$tmp_name = $files['qFile']['tmp_name'];
				$fileName = self::checkAndGetFileName($files['qFile']);

				if($fileName === null){return null;}

				$destination = 'uploads/'.$fileName;
					move_uploaded_file($tmp_name, $destination);
					return $fileName;
				
			}
			return '';
		}

		public static function uploadChoiceFiles($files){
			$choiceFileNames = [];
			$counter = 0;
			//first check files
			while(isset($files['file-'.$counter])){
				if(self::checkAndGetFileName($files['file-'.$counter]) === null){
					return null;
				}
				$counter++;
			}
			//if nothing is wrong then upload files
			$counter = 0;
			while($counter<6){
				if(isset($files['file-'.$counter])){
					$tmp_name = $files['file-'.$counter]['tmp_name'];
					$fileName = self::checkAndGetFileName($files['file-'.$counter]);
					$destination = 'uploads/'.$fileName;
					move_uploaded_file($tmp_name, $destination);
					$choiceFileNames[$counter] = $fileName;	
				}
				$counter++;
			}
	
			return $choiceFileNames;
		}

		public static function insertFileNamesToChoices($fileNames, $choices){
			//$fileCounter = 0;
			if(!empty($fileNames) && !empty($choices)){
				for ($i=0; $i < count($choices); $i++) {
					if(isset($choices[$i]->path) && isset($fileNames[$i])){
						$choices[$i]->path = $fileNames[$i];
					}
				}
			}
			return $choices;
		}

		
		public static function deleteDatasAndFiles($questionId){
			$fileNamesArray = Question::getImageNames($questionId);
			Question::deleteRow($questionId);
			foreach($fileNamesArray as $fileName){
				if($fileName !== null && !empty($fileName)){
					$path = 'uploads/'.$fileName;
					if(file_exists($path)){
						unlink($path);
					}
				}				
			}
		}

		public static function deleteFiles($fileNamesArray){
			if(is_array($fileNamesArray)){
				foreach($fileNamesArray as $fileName){
					if($fileName !== null && !empty($fileName)){
						$path = 'uploads/'.$fileName;
						// echo 'fileName: '.$fileName;
						// echo "<br>";
						// echo 'path: '.$path;
						// echo "<br>";
						
						if(file_exists($path)){
							unlink($path);
						}
					}			
				}
			}else{
				if($fileNamesArray !== null && !empty($fileNamesArray)){
					$path = 'uploads/'.$fileNamesArray;
					if(file_exists($path)){
						unlink($path);
					}
				}
			}
			
		}

		public static function insertAnswersToChoices($answers, $choices){
			if(!empty($answers)){
				if(is_array($answers)){
					foreach($choices as $choice){
						$choice->isChecked = in_array($choice->id,$answers);
					}
				}else if(!empty($choices)){
					foreach($choices as $choice){
						$choice->isChecked = $choice->id==$answers;
					}
				}
			}else if (!empty($choices)){
				foreach($choices as $choice){
					$choice->isChecked = false;
				}
			}
			return $choices;
		}

		public static function checkMultipleChoice($givenAnswers, $answers){
			if(count($givenAnswers)==count($answers)){
				foreach($givenAnswers as $givenAnswer){
					if(!in_array($givenAnswer, $answers)){
						return 0;
					}
				}
			}else{
				return 0;
			}
			return 1;
		}

		public static function checkSequence($givenAnswers,$answers){
			if(count($givenAnswers)==count($answers)){
				for($i=0;$i<count($answers);$i++){
					if(strtolower($givenAnswers[$i])!=strtolower($answers[$i])){
						return 0;
					}
				}
				return 1;
			}else{
				return 0;
			}
		}

		public static function clarifyMatching($choices){
			if(!empty($choices)){
				foreach($choices as $choice){
					if(($choice->id)%2==0){
						$choice->value = '';
					}
				}
			}
			return $choices;
		}

		public static function checkMatching(){

		}

	}
