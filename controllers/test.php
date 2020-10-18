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
      
      $this->view->render('test_constructor/index');
   }

   public function constructor($array = null)
   {
      Polyglot::setPage('test_constructor');
      // Polyglot::setPage('not_found');

      if (!empty($array)) {
         $test_id = $array[0];
         if (isset($array[1])) {
            if ($array[1] == 'postview') {
               $test_arr = _Test::getPreviewDatas($test_id);
               // echo "<pre>";
               // print_r($test_arr);die;
               $this->view->layout = 'main';
               //Polyglot::setPage('constructor_postview');
               Polyglot::extendPage('navbar');
               $this->view->render('constructor_postview/index', ['test_id' => $test_id, "test_arr" => $test_arr]);
            } else if ($array[1] == 'preview') {
               $this->view->render('constructor_preview/index', ['test_id' => $test_id]);
            }
         } else {
            $user_id = _Test::getUser($test_id);
            if($user_id == Session::get(USER_ID)){
               $this->view->render('test_constructor/index', ['test_id' => $test_id]);
            }else{
               echo "sizin testiniz dal";
               $this->error();
            }         
         }
      } else {
         $test_id = _Test::createTest(SESSION::get(USER_ID));
         $this->redirect('test/constructor/' . $test_id);
      }
   }

   public function solving($array = null)
   {
      if (!empty($array[0])) {
         if ($array[0] == 'getSolvingQuestions') {
            $this->getSolvingQuestions();
            return;
         }
   
         else if ($array[0] == 'confirmAnswer') {
            $this->confirmAnswer();
            return;
         }
         $test_id = $array[0];
         //$this->view->render('test_solving/index',['test_id'=>$test_id]);return;
         if (isset($array[1])) {
            if ($array[1] == 'postview') {
               $this->view->render('solving_postview/index', ['test_id' => $test_id, 'test_arr' => $test_arr]);
            } else if ($array[1] == 'preview') {
               $hasQuestions = _Test::hasQuestion($test_id, 'TEST_ID');
               $test_arr = _Test::getPreviewDatas($test_id);
               $isPublic = _Test::isPublic($test_id);
               // echo "<pre>";
               // print_r($test_arr);die;
               $this->view->layout = 'main';
               Polyglot::setPage('solving_preview');
               Polyglot::extendPage('navbar');
               $this->view->render('solving_preview/index', ['test_id' => $test_id, 'test_arr' => $test_arr, 'hasQuestions' => $hasQuestions, 'isPublic' => $isPublic]);
            }
         } else {
            if (_Test::isPublic($test_id)) {
               if (!Result::hasResult(Session::get(USER_ID),$test_id)) {
                  Result::insertRow($test_id, Session::get(USER_ID));
               }
               $this->view->render('test_solving/index', ['test_id' => $test_id]);
            } else {
               if (Session::has(Cryptography::encrypt($test_id))) {
                  if (!Result::hasResult(Session::get(USER_ID),$test_id)) {
                     Result::insertRow($test_id, Session::get(USER_ID));
                  }
                  $this->view->render('test_solving/index', ['test_id' => $test_id]);
               } else {
                  $hasQuestions = _Test::hasQuestion($test_id, 'TEST_ID');
                  $test_arr = _Test::getPreviewDatas($test_id);
                  $isPublic = _Test::isPublic($test_id);
                  // echo "<pre>";
                  // print_r($test_arr);die;
                  $this->view->render('solving_preview/index', ['test_id' => $test_id, 'test_arr' => $test_arr, 'hasQuestions' => $hasQuestions, 'isPublic' => $isPublic]);
               }
            }
         }
      } else {
         $this->error();
      }
   }

   public function result($array){
      $result_id = $array[0];
      $this->view->render('user_results/index');
   }

   public function results($array){
      if(isset($array[0])){
         $test_id = $array[0];
         $this->view->layout = "main";
         Polyglot::setPage("navbar");
         $tableInfoes = Result::resultTable($test_id);
         $graphInfoes = Result::questionChart($test_id);
         $pieInfoes = Result::payChart($test_id);
         $questionIndexes = [];
         $trueAnswers = [];
         $wrongAnswers = [];
         $noAnswers = [];
         $pieKeys = [];
         $pieValues = [];
         foreach($graphInfoes as $info){
            array_push($questionIndexes,$info['QUESTION_ORDER']);
            array_push($trueAnswers,$info['TRUE_ANSWER_COUNT']);
            array_push($wrongAnswers,$info['FALSE_ANSWER_COUNT']);
            array_push($noAnswers,$info['NOT_SOLVED']);
         }
         foreach($pieInfoes as $infoKeys => $infoValues){
            array_push($pieKeys,$infoKeys);
            array_push($pieValues,$infoValues);
         }
         $this->view->render('result/index', ['test_id' => $test_id,
                                              'tableInfoes' => $tableInfoes,
                                              'questionIndexes' => json_encode($questionIndexes),
                                              'trueAnswers' => json_encode($trueAnswers),
                                              'wrongAnswers' => json_encode($wrongAnswers),
                                              'noAnswers' => json_encode($noAnswers),
                                              'pieKeys' => json_encode($pieKeys),
                                              'pieValues' => json_encode($pieValues),
                                             ]);
      }  
   }

   public function getSolvingQuestions()
   {
      if (isset($_POST['testId'])) {
         $testId = (int) $_POST['testId'];
         $responseArray = _Test::getQuestionsForSolving($testId);
         $questionsArray = $responseArray['questions'];
         $answersArray = $responseArray['answers'];
         //$array = _Test::get($testId, ['GIVEN_TIME']);
         $time = $responseArray['remained_minutes'];
         $orderQuestion = count($questionsArray);

         if ($orderQuestion > 0) {
            $response_array = [
               'questions' => $questionsArray,
               'answers' => $answersArray,
               'orderQuestion' => $orderQuestion,
               'testId' => $testId,
               'time' => $time
            ];
            echo json_encode($response_array);
         } else {
            echo 0;
         }
      } else {
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

   public function delete()
   {
      // print_r($_POST);
      $testId = $_POST['test_id'];
      echo $testId;
      _Test::set($testId,'REMOVED',1);
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
      
      // print_r($extractedDatas);
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

   public function confirmAnswer()
   {
      //  print_r($_POST);die;
      if (!empty($_POST)) {
         $array = [];
         $questionId = $_POST['data']['id'];
         $solving_id = !empty($_POST['data']['solving_id']) ? (int) $_POST['data']['solving_id'] : 0;
         $dataArray = Question::get($questionId, ['QUESTION_TYPE', 'TEST_ID', 'ANSWERS']);

         $array['question_id'] = $questionId;
         $array['user_id'] = SESSION::get(USER_ID);
         $array['test_id'] = $dataArray['TEST_ID'];
         $array['answer'] = $_POST['data']['answer'];
         if (!empty($array['answer'])) {
            if ($dataArray['QUESTION_TYPE'] == 'single-choice' || $dataArray['QUESTION_TYPE'] == 'true-false') {
               $array['true_false'] = $dataArray['ANSWERS'] == $_POST['data']['answer'] ? 1 : 0;
            } else if ($dataArray['QUESTION_TYPE'] == 'multi-choice') {
               $array['true_false'] = Helper::checkMultipleChoice($array['answer'], json_decode($dataArray['ANSWERS']));
            } else if ($dataArray['QUESTION_TYPE'] == 'input') {
               $array['true_false'] = strtolower($dataArray['ANSWERS']) == strtolower($_POST['data']['answer']) ? 1 : 0;
            } else if ($dataArray['QUESTION_TYPE'] == 'blank' || $dataArray['QUESTION_TYPE'] == 'matching') {
               $array['true_false'] = Helper::checkSequence($array['answer'], $dataArray['ANSWERS']);
            }

            //print_r($array);die;
            // echo $solving_id;die;
            if (Solving::has($solving_id)) {
               $solving_id = Solving::updateAnswer($solving_id, $array);
            } else {
               $solving_id = Solving::insertAnswer($array);
            }
            echo $solving_id;
         } else {
            Solving::deleteAnswer($solving_id);
            echo 'null';
         }

         //------------------------------------------------

         /* 
         Answerler bosh gelip bilyan eken! Eger Bosh gelse jogap yoklugy yagny,
			Shol solving id-li row-y pozmaly!
		*/

         //----------------------------//------------------------
      } else {
         echo "no data";
      }
   }


   public function publishTest()
   {
      if (!empty($_POST)) {
         // print_r($_POST);
         // print_r($_FILES);
         // die;

         $testId = $_POST['test_id'];
         $name = !empty($_POST['name']) ? $_POST['name'] : 'NONAME';
         $description = !empty($_POST['description']) ? $_POST['description'] : 'No Description';
         $language = !empty($_POST['langs']) ? $_POST['langs'] : 'Turkmen';
         $isPublic = !empty($_POST['status']) ? $_POST['status'] == 'public' : 0;
         $password = !empty($_POST['password']) && !$isPublic ? md5($_POST['password']) : '';
         $givenTime = !empty($_POST['time']) ? $_POST['time'] : 60;
         $startTime = !empty($_POST['start-date']) && !empty($_POST['start-time']) ? $_POST['start-date'] . " " . $_POST['start-time'] : null;
         $deadline = !empty($_POST['end-date']) && !empty($_POST['end-time']) ? $_POST['end-date'] . " " . $_POST['end-time'] : null;
         $isRandom = 0;
         $user_id = Session::get(USER_ID);
         $fileName = $_POST['deletedFileName'];
         if (!empty($_FILES['photo']['tmp_name'])) {
            Helper::deleteFiles($fileName);
            $fileName = Helper::uploadImage($_FILES['photo']);
         }

         $bool = _Test::updateTest($testId, [
            'testId' => $testId,
            'name' => $name,
            'description' => $description,
            'language' => $language,
            'isPublic' => $isPublic,
            'password' => $password,
            'fileName' => $fileName,
            'givenTime' => $givenTime,
            'startTime' => $startTime,
            'deadline' => $deadline,
            'isRandom' => $isRandom,
            'user_id' => $user_id,
         ]);

         if ($bool) {
            echo $fileName;
         }
      }
   }

   public function getTestInfo()
   {
      $testId;
      $informations = _Test::get($testId, ['DESCRIPTION,']);
   }

   public function copy($array = null)
   {
/*       if (!empty($array) && (!empty($array[0]) || !empty($array[1]))) {
         //security tarapda duzetmeli yerleri bar! dine barlamak uchin doredilen!
         _Test::copyTest($array[0], Session::get(USER_ID));
      } else {
         echo "[domain/test/copy/test_id/user_id] strukturada girizin! test_id-ni user_id uchin kopyalaya";
      } */
      $test_id = $_POST['test_id'];
      _Test::copyTest($test_id, Session::get(USER_ID));
   }

   public function checkTestPassword()
   {
      $test_id = $_POST['test_id'];
      $entered_password = $_POST['password'];

      $password = _Test::get($test_id, ['PASSWORD'])['PASSWORD'];
      // echo $password."000";die;
      if (md5($entered_password) == $password) {
         Session::set(Cryptography::encrypt($test_id), 'cool');
         echo 1;
      } else {
         echo 0;
      }
   }

   public function finishSolvingTest(){
      $test_id = $_POST['test_id'];
      _Test::solvingFinish($test_id, Session::get(USER_ID));
      $response = _Test::getSolvingScore($test_id, Session::get(USER_ID));
      echo json_encode($response);
   }


   public function test()
   {
      //print_r(Others::get());
      //echo Helper::copyUploadedImage('532175f5ce18f559b0.png');
      // $test_cards = _Test::getMyHistory(4, 0, 10);
      echo "<pre>";
      // print_r(Mail::setFeedback(4, "salam men erkin"));
      //print_r(Result::resultTable(1));
      _Test::getSolvingScore();

   }
}
