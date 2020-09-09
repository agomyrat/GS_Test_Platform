<?php
class Test extends Controller
{

   function __construct()
   {
      parent::__construct();
      $this->view->layout = "test";
   }

   public function index()
   {
      //Polyglot::setPage('test_constructor');
      $this->view->render('test_constructor/index');
   }

   public function constructor($array = null)
   {
      if(!empty($array)){
			$test_id = $array[0];
			$this->view->render('test_constructor/index',['test_id'=>$test_id]);
		}else{
			$test_id = _Test::createTest(SESSION::get(USER_ID));
			$this->redirect('test/constructor/'.$test_id);
		}
   }

   public function solving($array = null)
   {
      $test_id = $array[0];
      $this->view->layout = "test_solving";
      $this->view->render('test_solving/index',['test_id'=>$test_id]);
   }

   public function getSolvingQuestions(){
	if(isset($_POST['testId'])){
		$testId = (int) $_POST['testId'];
		$responseArray = _Test::getQuestionsForSolving($testId);
		$questionsArray = $responseArray['questions'];
		$answersArray = $responseArray['answers'];
		$array = _Test::get($testId,['GIVEN_TIME']);
		$time = (int) $array['GIVEN_TIME'];
		$orderQuestion = count($questionsArray);

		if($orderQuestion > 0){
			$response_array = [
				'questions'=>$questionsArray,
				'answers'=>$answersArray,
				'orderQuestion'=>$orderQuestion,
				'testId'=>$testId,
				'time'=>$time
			];
			echo json_encode($response_array);
		}else{
			echo 0;
		}

	}else{
		echo "Couldn't get testId";
	}
}

   public function getQuestions()
   {
	   
      // echo 'geldi';
      if (isset($_POST['testId'])) {
         $testId = (int) $_POST['testId'];
         $questionsArray = _Test::getQuestions($testId);
         $orderQuestion = count($questionsArray);

         if ($orderQuestion > 0) {
            $response_array = [
               'questions' => $questionsArray,
               'orderQuestion' => $orderQuestion,
               'testId' => $testId
            ];
            echo json_encode($response_array);
         } else {
            echo 0;
         }
      } else {
         echo "Couldn't get testId";
      }
   }

   public function deleteQuestion()
   {
      // print_r($_POST);
      $questionId = $_POST['questionId'];
      Helper::deleteDatasAndFiles($questionId);
   }

   public function saveQuestion()
   {
      // print_r(json_decode($_POST['data']));
      // print_r(($_FILES));
      // //print_r(json_decode($_POST['data']));
      // !empty($_POST['choiceFiles']) ? print_r(json_decode($_POST['choiceFiles'])) : null;
      // !empty($_POST['deletedQuestionFile']) ? print_r(json_decode($_POST['deletedQuestionFile'])) : null;
      // !empty($_POST['deletedChoiceFiles']) ? print_r(json_decode($_POST['deletedChoiceFiles'])) : null;
      // die;

      $extractedDatas = Helper::extractDatas(json_decode($_POST['data']));

      $questionId = $extractedDatas['questionId'];
      $question = $extractedDatas['question'];
      $choices = $extractedDatas['choices'];
      $answers = $extractedDatas['answers'];
      $testId = $extractedDatas['testId'];
      $questionType = $extractedDatas['questionType'];
      $isRandom = $extractedDatas['isRandom'];
      $hasImage = $extractedDatas['hasImage'];
      $order = $extractedDatas['order'];
      $path = $extractedDatas['path'];
      $choiceFiles = !empty($_POST['choiceFiles']) ? json_decode($_POST['choiceFiles']) : null;
      $deletedQuestionFile = !empty($_POST['deletedQuestionFile']) ? json_decode($_POST['deletedQuestionFile']) : null;
      $deletedChoiceFiles = !empty($_POST['deletedChoiceFiles']) ? json_decode($_POST['deletedChoiceFiles']) : null;

      $qFileName = Helper::uploadQuestionFile($_FILES);
      $aFileNames = Helper::uploadChoiceFiles($_FILES);

      $qFileName = !empty($qFileName) ? $qFileName : $path;

      if ($qFileName === null && $aFileNames === null) {
         echo '0';
         exit('0');
      }

      $choices = Helper::insertFileNamesToChoices($choiceFiles, $choices);
      $choices = Helper::insertFileNamesToChoices($aFileNames, $choices);

      Helper::deleteFiles($deletedChoiceFiles);
      Helper::deleteFiles($deletedQuestionFile);

      if ($questionId !== null && Question::has($questionId)) {

         $questionId = Question::updateQuestion($questionId, [
            'testId' => $testId,
            'question' => $question,
            'qFileName' => $qFileName,
            'questionData' => $choices,
            'answers' => $answers,
            'questionType' => $questionType,
            'isRandom' => $isRandom,
            'hasImage' => $hasImage,
            'order' => $order
         ]);
      } else {

         $questionId = Question::insertQuestion([
            'testId' => $testId,
            'question' => $question,
            'qFileName' => $qFileName,
            'questionData' => $choices,
            'answers' => $answers,
            'questionType' => $questionType,
            'isRandom' => $isRandom,
            'hasImage' => $hasImage,
            'order' => $order,
         ]);
      }
      if ($questionId) {
         $response_array = [
            'question' => $question,
            'choices' => $choices,
            'answer' => $answers,
            'type' => $questionType,
            'hasImage' => $hasImage,
            'isRandom' => $isRandom,
            'id' => $questionId,
            'path' => $qFileName,
            'aFilesNames' => $aFileNames,
            'order' => $order
         ];
         echo json_encode($response_array);
      } else {
         echo "database problem bar!";
      }
   }

   public function confirmAnswer(){
	print_r($_POST);die;
	if(!empty($_POST)){
		$array = [];
		$questionId = $_POST['data']['id'];
		$solving_id = !empty($_POST['data']['solving_id']) ? (int) $_POST['data']['solving_id'] : 0;
		$dataArray = Question::get($questionId,['QUESTION_TYPE','TEST_ID','ANSWERS']);
		
		$array['question_id'] = $questionId;
		$array['user_id'] = SESSION::get(USER_ID);
		$array['test_id'] = $dataArray['TEST_ID'];
		$array['answer'] = $_POST['data']['answer'];
		if(!empty($array['answer'])){
			if($dataArray['QUESTION_TYPE']=='single-choice' || $dataArray['QUESTION_TYPE']=='true-false'){
				$array['true_false'] = $dataArray['ANSWERS']==$_POST['data']['answer'] ? 1:0;
			}else if($dataArray['QUESTION_TYPE']=='multi-choice'){
				$array['true_false'] = Helper::checkMultipleChoice($array['answer'],$dataArray['ANSWERS']);
			}else if($dataArray['QUESTION_TYPE']=='input'){
				$array['true_false'] = strtolower($dataArray['ANSWERS'])==strtolower($_POST['data']['answer']) ? 1:0;
			}else if($dataArray['QUESTION_TYPE']=='blank' || $dataArray['QUESTION_TYPE']=='matching'){
				$array['true_false'] = Helper::checkSequence($array['answer'],$dataArray['ANSWERS']);
			}
		}
			
		//------------------------------------------------

      /* 
         Answerler bosh gelip bilyan eken! Eger Bosh gelse jogap yoklugy yagny,
			Shol solving id-li row-y pozmaly!
		*/

		//----------------------------//------------------------
		//print_r($array);die;
		if(Solving::has($solving_id)){
			$solving_id = Solving::updateAnswer($solving_id,$array);
		}else{
			$solving_id = Solving::insertAnswer($array);
		}
		echo $solving_id;
	}else{
		echo "no data";
	}
	
}

   public function getTestInfo(){
      $informations = _Test::get();
   }

   public function practice()
   {
      $link = 'adf';
      // // echo "<pre>";
      // // print_r(_Test::getQuestions(1));
      // //print_r(_Test::get(4,['TEST_ID','CREATED_BY','TEST_NAME']));
      /* $username = 'ERIC';
		
		$file = View::getHtmlTemplate('register',['link'=>$link]);;
		echo ($file)."<br>"; */
      // use PHPMailer\PHPMailer\Exception;
      /* require "libs/Mail.php";
		sendMail(); */

      // Polyglot::setPage('signup');
      // $address = 'rejepowerkin@gmail.com';
      // $this->sendMail($address, [
      //    'templateName' => 'register',
      //    'link' => $link,
      //    'subject' => Polyglot::translate('Registration letter')
	  // ]);
	  
    //      $var = '[{&quot;value&quot;:&quot;&quot;,&quot;type&quot;:&quot;image&quot;,&quot;path&quot;:&quot;..\/..\/uploads\/1370865f4b7df9a25d6.jpeg&quot;,&quot;isChecked&quot;:true,&quot;id&quot;:&quot;a&quot;,&quot;pathValue&quot;:false},{&quot;value&quot;:&quot;asd&quot;,&quot;type&quot;:&quot;string&quot;,&quot;path&quot;:&quot;&quot;,&quot;isChecked&quot;:false,&quot;id&quot;:&quot;b&quot;},{&quot;value&quot;:&quot;asd&quot;,&quot;type&quot;:&quot;string&quot;,&quot;path&quot;:&quot;&quot;,&quot;isChecked&quot;:false,&quot;id&quot;:&quot;c&quot;}]'
    //   ;$arr = json_decode(htmlspecialchars_decode($var));
    //   echo "<pre>";
	//   print_r($arr);
	  $array = _Test::get(['GIVEN_TIME','QUESTION_COUNT','TEST_ID']);
		print_r($array);
   }
}
