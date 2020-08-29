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
      /* if(!empty($array)){
			$test_id = $array[0];
			$this->view->render('test_constructor/index',['test_id'=>$test_id]);
		}else{
			$test_id = _Test::createTest(SESSION::get(USER_ID));
			$this->redirect('test/constructor/'.$test_id);
		} */
   }

   public function solving()
   {
      $this->view->layout = "test_solving";
      $this->view->render('test_solving/index');
   }

   public function editQuestion()
   {
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
      $path = strpos($extractedDatas['path'], 'uploads/') !== false ? trim($extractedDatas['path'], 'uploads/') : $extractedDatas['path'];
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

      Polyglot::setPage('signup');
      $address = 'rejepowerkin@gmail.com';
      $this->sendMail($address, [
         'templateName' => 'register',
         'link' => $link,
         'subject' => Polyglot::translate('Registration letter')
      ]);
   }
}
