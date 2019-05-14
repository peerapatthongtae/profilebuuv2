<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use Ramsey\Uuid\Uuid;
use Firebase\JWT\JWT;
use Tuupola\Base62;

require '../vendor/autoload.php';


$app = new \Slim\App;

use Monolog\Logger;
use Monolog\Handler\RotatingFileHandler;

$logger = new Logger("slim");
$rotating = new RotatingFileHandler(__DIR__ . "/logs/slim.log", 0, Logger::DEBUG);
$logger->pushHandler($rotating);

// Routes
$app->group('/api', function () use ($app) {
 
    // Version group
    $app->group('/v1', function () use ($app) {
		$app->get('/students', 'getStudents');
        $app->get('/student/{Student_ID}/about', 'getStudent');
        $app->get('/amountstudentcurriculum/{Entry_Years}', 'getAmountstudents');
        $app->get('/job/{Student_ID}', 'getStudentAunqa');    
        $app->get('/amountstudentstatus/{Entry_Years}', 'getStudentStatus');
        $app->get('/student/{Student_ID}/subjects', 'getSubjectByStudent');
        $app->get('/student/{Student_ID}/credit', 'getCreditStudent');
        $app->get('/activities', 'getActivity');
        $app->get('/activity/{Activitie_ID}/activity', 'getActivityById');
        $app->get('/activity/{Activitie_ID}/student', 'getActivityStudent');
        $app->get('/activity/{Student_ID}/activities', 'getActivityInStudent');
        $app->get('/awards', 'getAward');
        $app->get('/award/{Award_ID}/award', 'getAwardById');
        $app->get('/award/{Award_ID}/student', 'getAwardStudent');
        $app->get('/award/{Student_ID}/awards', 'getAwardInStudent');
        $app->get('/scholarships', 'getScholarship');
        $app->get('/scholarship/{Scholarship_ID}/scholarship', 'getScholarshipById');
        $app->get('/scholarship/{Scholarship_ID}/student', 'getScholarshipStudent');
        $app->get('/scholarship/{Student_ID}/scholarships', 'getScholarshipInStudent');
        $app->get('/adviser/{Student_ID}/adviser', 'getStudentInAdviser');
        $app->get('/adviser/{Adviser_Name}/student', 'getAdviserInStudent');
        $app->get('/advisers', 'getAdviserForStudent');
        $app->get('/subjects/{Student_ID}/student', 'getSubjectsInStudent');
        $app->get('/status/{GPA_Year}/{GPA_Term}/student', 'getStatusStudent');
        $app->get('/amountstudent/{Subject_Code}/{Term_Number}/{Subject_Year}/subjects', 'getStudentSubjects');
        $app->get('/student/{Subject_Code}/{Subject_Year}/{Term_Number}/subject', 'getStudentPastSubject');
        $app->get('/grade/{Subject_Code}/{Subject_Year}/{Term_Number}/subject', 'getGradeInSubject');
        $app->get('/subject/{Subject_Code}/{Subject_Year}/{Term_Number}/students', 'getSubjectHasStudent');
        $app->get('/pro/{GPA_Term}/{GPA_Year}/students', 'getStatusProStudents');
        $app->get('/student/{Student_ID}/pro', 'getStudentStatusPro');
        $app->get('/students/{GPA_Term}/{GPA_Year}/{Grade_Pro}/pro', 'getStatusProTermStudents');
        $app->get('/students/{GPA_Term}/{GPA_Year}/{Grade_Pro}/count', 'getStudentProCount');
        $app->get('/statuspros', 'getStatusPro');
        $app->get('/students/{Subject_Code}/{Subject_Year}/{Term_Number}/fail', 'getStudentFailSubject');
        $app->get('/student/{Stat_Years}/{Course_ID}/course', 'getStudentInYear');
    });
});

// JWT
$app->add(new \Slim\Middleware\JwtAuthentication([
    'secure' => false,
    "logger" => $logger,
    "secret" => "e97f804e0b16e0fdb2ab13ce69fa3225cc7423eb",
    "rules" => [
        new \Slim\Middleware\JwtAuthentication\RequestPathRule([
            "path" => "/api",
            "passthrough" => ["/api/token"]
        ]),
    ]
]));

$app->add(new \Slim\Middleware\HttpBasicAuthentication([
    'secure' => false,
    "path" => "/api/token",
    "users" => [
        "buu_profile" => "profile_999"
    ]
]));



$app->get("/api/token", function (Request $request, Response $response, array $args) {
    $secret = 'e97f804e0b16e0fdb2ab13ce69fa3225cc7423eb';
    /* Here generate and return JWT to the client. */
    $now = new DateTime();
    $future = new DateTime("now +120 minute");
    $server = $request->getServerParams();
    $jti = (new Base62)->encode(random_bytes(16));
    // $jti = 
    $payload = [
        "iat" => $now->getTimeStamp(),
        "exp" => $future->getTimeStamp(),
        "jti" => $jti,
        "sub" => $server["PHP_AUTH_USER"],
    ];


    $token = JWT::encode($payload, $secret, "HS256");
    $data["token"] = $token;
    $data["expires"] = $future->getTimeStamp();

    return $response->withJson(array('status' => 'true','result'=>$data),200);


});

$app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
    $name = $args['name'];
    $response->getBody()->write("Hello, $name");

    return $response;
});
// JWT

// $corsOptions = array(
//     "origin" => "*",
//     "exposeHeaders" => array("Content-Type", "X-Requested-With", "X-authentication", "X-client"),
//     "allowMethods" => array('GET', 'POST', 'PUT', 'DELETE', 'OPTIONS')
// );
// $cors = new \CorsSlim\CorsSlim($corsOptions);
 
// $app->add($cors);

$app->run();

// Connect Database Code
function getConnection() {
    $dbhost=getenv('MYSQL_HOST');
    $dbuser=getenv('MYSQL_USER');
    $dbpass=getenv('MYSQL_PASSWORD');
    $dbname=getenv('MYSQL_DATABASE');
    $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->query("set names utf8");
    return $dbh;
}
// เช็ควิชาที่ลงเรียนว่าผ่านเกณฑ์ไหม เช่น ส่งไป สามวิชาแล้วผ่านทั้งสามวิชาคือผ่าน
function getSubjectByStudent($request, $response) {
    $Student_ID = 0;
    $Student_ID = $request->getAttribute('Student_ID');
    $Subject_Code = htmlspecialchars($_GET['Subject_Code']);
    $Subject_Code = str_replace("*", "", $Subject_Code);
    $Subject_Code = str_replace(",", "|", $Subject_Code);

    try {
        $db = getConnection();


        $sql = "SELECT Subject_has_Student.Subject_Code, Subject_has_Student.Term_Number AS Term,Subject_has_Student.Subject_Credit,Subject_has_Student.Grade,Subject_has_Student.Subject_Year AS Year
		FROM Subject_has_Student 
        WHERE Student_ID= :Student_ID
        AND Subject_Code REGEXP '".$Subject_Code."'
        AND (Grade != 'W' AND Grade != 'F') ";
        $stmt = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $values = array(
            ':Student_ID' => $Student_ID,            
        );
        $stmt->execute($values);
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);

        if($result){
            return $response->withJson(array('status' => 'true','result'=>$result),200);
        }else{
            return $response->withJson(array('status' => 'Student Not Found'),422);
        }
        $db=null;

    } catch(PDOException $ex) {
      return $response->withJson(array('error' => $ex->getMessage()),422);
    }
}
        // แสดงข้อมูลรหัสนิสิต คำนำหน้า ชื่อ นามสกุลไทย หลักสูตร ปีที่เข้า สถานะของนิสิตทุกคนในฐานข้อมูล
        function getStudents($request, $response) {
            $sql = "SELECT Student_ID, CONCAT(Student_Prefix, ' ',Student_Name_TH , ' ' ,Student_Lname_TH) AS Full_Name, Course, Entry_Years, Status_Name
            FROM Student
            left join Status on Status.Status_ID = Student.Status_ID";
            try {
                $db = getConnection();

                $result = null;

                $stmt = $db->query($sql);
                $result = $stmt->fetchAll(PDO::FETCH_OBJ);
                if($result){
                    return $response->withJson(array('status' => 'true','result'=>$result),200);
                }else{
                    return $response->withJson(array('status' => 'False'),422);
                }
                $db=null;
                    
            }
            catch(\PDOException $ex){
                return $response->withJson(array('error' => $ex->getMessage()),422);
            }

        }

        // แสดงข้อมูลทั้งหมด ของนิสิตรายบุคคล
        function getStudent($request, $response) {
            $Student_ID = 0;;
            $Student_ID =  $request->getAttribute('Student_ID');
            try {
                $db = getConnection();
                $sql = "SELECT * FROM Student 
                WHERE Student_ID=:Student_ID";
                $stmt = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $values = array(
                    ':Student_ID' => $Student_ID
                );
                $stmt->execute($values);
                $result = $stmt->fetchObject();

                if($result){
                    return $response->withJson(array('status' => 'true','result'=>$result),200);
                }else{
                    return $response->withJson(array('status' => 'False'),422);
                }
                $db=null;

            } catch(PDOException $ex) {
            return $response->withJson(array('error' => $ex->getMessage()),422);
            }
            }

        // จำนวนนิสิตในแต่ละชั้นปี ตามหลักสูตรและระดับการศึกษา
        function getAmountstudents($request, $response) {
            $Entry_Years = 0;;
            $Entry_Years =  $request->getAttribute('Entry_Years');
            $Entry_Years = str_replace("*", "", $Entry_Years);
            try {
                $db = getConnection();
                $sql = "SELECT Entry_Years, Course, Level, count(*) AS Count 
                FROM Student 
                WHERE Entry_Years IN (".$Entry_Years.")
                GROUP BY Entry_Years, Course";
                $stmt = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $values = array(
                    ':Entry_Years' => $Entry_Years
                );
                $stmt->execute($values);
                $result = $stmt->fetchAll(PDO::FETCH_OBJ);

        
                if($result){
                    return $response->withJson(array('status' => 'true','result'=>$result),200);
                }else{
                    return $response->withJson(array('status' => 'False'),422);
                }
                $db=null;
        
            } catch(PDOException $ex) {
              return $response->withJson(array('error' => $ex->getMessage()),422);
                }
            }
            // ดูว่านิสิตที่ค้นหาสถานะการทำงานเป็นอย่างไร เช่น กำลังทำงาน ยังไม่ทำงาน หรือไม่ทำงาน กำลังศึกษาต่อ
            function getStudentAunqa($request, $response) {
                $Student_ID = 0;;
                $Student_ID =  $request->getAttribute('Student_ID');
                $Student_ID = str_replace("*", "%", $Student_ID);
                try {
                    $db = getConnection();
                    $sql = "SELECT CONCAT(Student.Student_Prefix, ' ',Student.Student_Name_Th , ' ' ,Student.Student_Lname_Th) AS Full_Name, Student.Course, Student.Work_Status, Student.Work_Position AS Position, Student.Workplace_Company AS Company, Student.Workplace_Address
                    
                    FROM Student 
                    WHERE Student.Student_ID LIKE :Student_ID";
                    $stmt = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $values = array(
                        ':Student_ID' => $Student_ID
                    );
                    $stmt->execute($values);
                    $result = $stmt->fetchAll(PDO::FETCH_OBJ);
            
                    if($result){
                        return $response->withJson(array('status' => 'true','result'=>$result),200);
                    }else{
                        return $response->withJson(array('status' => 'False'),422);
                    }
                    $db=null;
            
                } catch(PDOException $ex) {
                  return $response->withJson(array('error' => $ex->getMessage()),422);
                }
            }
            // ดูว่านิสิตในแต่ละชั้นปีมีกี่คน แยกตามสถานะนิสิต และระดับการศึกษา
            function getStudentStatus($request, $response) {
                $Entry_Years = 0;;
                $Entry_Years =  $request->getAttribute('Entry_Years');
                
                try {
                    $db = getConnection();
                    $sql = "SELECT  Status.Status_Name, Level, count(*) AS Count 
                    FROM Student 
                    INNER JOIN Status ON Student.Status_ID = Status.Status_ID 
                    WHERE Entry_Years = :Entry_Years 
                    GROUP BY Status_Name,Level";
                    $stmt = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $values = array(
                        ':Entry_Years' => $Entry_Years,
                    );
                    $stmt->execute($values);
                    $result = $stmt->fetchAll(PDO::FETCH_OBJ);
    
            
                    if($result){
                        return $response->withJson(array('status' => 'true','result'=>$result),200);
                    }else{
                        return $response->withJson(array('status' => 'False'),422);
                    }
                    $db=null;
            
                } catch(PDOException $ex) {
                    return $response->withJson(array('error' => $ex->getMessage()),422);
                }
            }
            // หาหน่วยกิตรวมของนิสิตรายบุคคล
            function getCreditStudent($request, $response) {
                $Student_ID = 0;
                $Student_ID =  $request->getAttribute('Student_ID');
                try {
                    $db = getConnection();
                    $sql = "SELECT sum(Subject_Credit) as sum_credit
                    FROM Subject_has_Student 
                    WHERE Student_ID = :Student_ID
                    AND Grade != 'F' 
                    AND Grade != 'W' 
                    AND Grade != '' ";
                    $stmt = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $values = array(
                        ':Student_ID' => $Student_ID
                    );
                    $stmt->execute($values);
                    $result = $stmt->fetchAll(PDO::FETCH_OBJ);


                    if($result){
                        return $response->withJson(array('status' => 'true','result'=>$result),200);
                    }else{
                        return $response->withJson(array('status' => 'False'),422);
                    }
                    $db=null;

                } catch(PDOException $ex) {
                    return $response->withJson(array('error' => $ex->getMessage()),422);
                }
            }
            // แสดงชื่อกิจกรรมทั้งหมด
            function getActivity($request, $response) {
                try {
                    $db = getConnection();
                    $sql = "SELECT Activity.Activitie_ID, Activity.Activitie_Name
                    FROM `Activity` ";
                    $stmt = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    
                    $stmt->execute($values);
                    $result = $stmt->fetchAll(PDO::FETCH_OBJ);


                    if($result){
                        return $response->withJson(array('status' => 'true','result'=>$result),200);
                    }else{
                        return $response->withJson(array('status' => 'False'),422);
                    }
                    $db=null;

                } catch(PDOException $ex) {
                    return $response->withJson(array('error' => $ex->getMessage()),422);
                }
            }
            // แสดงรายละเอียดของกิจกรรมนั้นๆตามไอดี
            function getActivityById($request, $response) {
                $Activitie_ID = 0;
                $Activitie_ID =  $request->getAttribute('Activitie_ID');
                try {
                    $db = getConnection();
                    $sql = "SELECT Activity.Activitie_Name, Activity.Activity_Term, Activity.Activity_Year, Activity.Hour 
                    FROM `Activity` 
                    WHERE Activitie_ID = :Activitie_ID ";
                    $stmt = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $values = array(
                        ':Activitie_ID' => $Activitie_ID
                    );
                    $stmt->execute($values);
                    $result = $stmt->fetchAll(PDO::FETCH_OBJ);


                    if($result){
                        return $response->withJson(array('status' => 'true','result'=>$result),200);
                    }else{
                        return $response->withJson(array('status' => 'False'),422);
                    }
                    $db=null;

                } catch(PDOException $ex) {
                    return $response->withJson(array('error' => $ex->getMessage()),422);
                }
            }
            // ดูว่าใครอยู่ในกิจกรรมนั้นบ้าง
            function getActivityStudent($request, $response) {
                $Activitie_ID = 0;
                $Activitie_ID =  $request->getAttribute('Activitie_ID');
                try {
                    $db = getConnection();
                    $sql = "SELECT Activity_has_Student.Student_Student_ID AS Student_ID, CONCAT(Student.Student_Prefix, ' ',Student.Student_Name_Th , ' ' ,Student.Student_Lname_Th) AS Full_Name
                    
                    FROM Activity 
                    INNER JOIN Activity_has_Student ON Activity.Activitie_ID = Activity_has_Student.Activity_Activitie_ID 
                    INNER JOIN Student ON Activity_has_Student.Student_Student_ID = Student.Student_ID
                    WHERE Activitie_ID= :Activitie_ID";
                    $stmt = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $values = array(
                        ':Activitie_ID' => $Activitie_ID
                    );
                    $stmt->execute($values);
                    $result = $stmt->fetchAll(PDO::FETCH_OBJ);


                    if($result){
                        return $response->withJson(array('status' => 'true','result'=>$result),200);
                    }else{
                        return $response->withJson(array('status' => 'False'),422);
                    }
                    $db=null;

                } catch(PDOException $ex) {
                    return $response->withJson(array('error' => $ex->getMessage()),422);
                }
            }
               
            // แสดงว่านิสิตมีกิจกรรมอะไรที่ลงไปแล้วบ้าง
            function getActivityInStudent($request, $response) {
                $Student_ID = 0;
                $Student_ID =  $request->getAttribute('Student_ID');
                $Student_ID = str_replace("*", "%", $Student_ID);
                try {
                    $db = getConnection();
                    $sql = "SELECT Activity.Activitie_Name, Activity.Activity_Term, Activity.Activity_Year, Activity.Hour
                    FROM Activity
                    INNER JOIN Activity_has_Student ON Activity.Activitie_ID = Activity_has_Student.Activity_Activitie_ID 
                    INNER JOIN Student ON Activity_has_Student.Student_Student_ID = Student.Student_ID
                    WHERE Student.Student_ID LIKE  :Student_ID ";
                    $stmt = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $values = array(
                        ':Student_ID' => $Student_ID
                    );
                    $stmt->execute($values);
                    $result = $stmt->fetchAll(PDO::FETCH_OBJ);


                    if($result){
                        return $response->withJson(array('status' => 'true','result'=>$result),200);
                    }else{
                        return $response->withJson(array('status' => 'False'),422);
                    }
                    $db=null;

                } catch(PDOException $ex) {
                    return $response->withJson(array('error' => $ex->getMessage()),422);
                }
            }
            // แสดงรายชื่อรางวัลทั้งหมด
            function getAward($request, $response) {
                try {
                    $db = getConnection();
                    $sql = "SELECT Award.Award_ID, Award.Award_Name
                    FROM `Award` ";
                    $stmt = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    
                    $stmt->execute($values);
                    $result = $stmt->fetchAll(PDO::FETCH_OBJ);


                    if($result){
                        return $response->withJson(array('status' => 'true','result'=>$result),200);
                    }else{
                        return $response->withJson(array('status' => 'False'),422);
                    }
                    $db=null;

                } catch(PDOException $ex) {
                    return $response->withJson(array('error' => $ex->getMessage()),422);
                }
            }
            // แสดงรายละเอียดของรางวัลนั้นๆตามไอดี
            function getAwardById($request, $response) {
                $Award_ID = 0;
                $Award_ID =  $request->getAttribute('Award_ID');
                try {
                    $db = getConnection();
                    $sql = "SELECT  Award.Award_Term, Award.Award_Year, Award.Award_Amount, Award.Award_Giver, Award.Award_Date
                    FROM `Award` 
                    WHERE Award.Award_ID = :Award_ID ";
                    $stmt = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $values = array(
                        ':Award_ID' => $Award_ID
                    );
                    $stmt->execute($values);
                    $result = $stmt->fetchAll(PDO::FETCH_OBJ);


                    if($result){
                        return $response->withJson(array('status' => 'true','result'=>$result),200);
                    }else{
                        return $response->withJson(array('status' => 'False'),422);
                    }
                    $db=null;

                } catch(PDOException $ex) {
                    return $response->withJson(array('error' => $ex->getMessage()),422);
                }
            }
                
            // ดูว่าใครอยู่ในรางวัลนั้นบ้าง
            function getAwardStudent($request, $response) {
                $Award_ID = 0;
                $Award_ID =  $request->getAttribute('Award_ID');
                try {
                    $db = getConnection();
                    $sql = "SELECT Award_has_Student.Student_ID, CONCAT(Student.Student_Prefix , ' ' ,Student.Student_Name_Th, ' ',Student.Student_Lname_Th) AS Full_Name                   
                    FROM Award 
                    INNER JOIN Award_has_Student ON Award.Award_ID = Award_has_Student.Award_ID 
                    INNER JOIN Student ON Award_has_Student.Student_ID = Student.Student_ID
                    WHERE Award.Award_ID = :Award_ID ";
                    $stmt = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $values = array(
                        ':Award_ID' => $Award_ID
                    );
                    $stmt->execute($values);
                    $result = $stmt->fetchAll(PDO::FETCH_OBJ);


                    if($result){
                        return $response->withJson(array('status' => 'true','result'=>$result),200);
                    }else{
                        return $response->withJson(array('status' => 'False'),422);
                    }
                    $db=null;

                } catch(PDOException $ex) {
                    return $response->withJson(array('error' => $ex->getMessage()),422);
                }
            }
               
            // แสดงว่านิสิตมีรางวัลอะไรที่ลงไปแล้วบ้าง
            function getAwardInStudent($request, $response) {
                $Student_ID = 0;
                $Student_ID =  $request->getAttribute('Student_ID');
                try {
                    $db = getConnection();
                    $sql = "SELECT Award.Award_Name, Award.Award_Term, Award.Award_Year, Award.Award_Amount, Award.Award_Giver, Award.Award_Date
                    FROM Award
                    INNER JOIN Award_has_Student ON Award.Award_ID = Award_has_Student.Award_ID 
                    INNER JOIN Student ON Award_has_Student.Student_ID = Student.Student_ID
                    WHERE Student.Student_ID = :Student_ID ";
                    $stmt = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $values = array(
                        ':Student_ID' => $Student_ID
                    );
                    $stmt->execute($values);
                    $result = $stmt->fetchAll(PDO::FETCH_OBJ);


                    if($result){
                        return $response->withJson(array('status' => 'true','result'=>$result),200);
                    }else{
                        return $response->withJson(array('status' => 'False'),422);
                    }
                    $db=null;

                } catch(PDOException $ex) {
                    return $response->withJson(array('error' => $ex->getMessage()),422);
                }
            }
            // แสดงรายชื่อทุนทั้งหมด
            function getScholarship($request, $response) {
                try {
                    $db = getConnection();
                    $sql = "SELECT Scholarship.Scholarship_ID, Scholarship.Scholarship_Name
                    FROM `Scholarship` ";
                    $stmt = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    
                    $stmt->execute($values);
                    $result = $stmt->fetchAll(PDO::FETCH_OBJ);


                    if($result){
                        return $response->withJson(array('status' => 'true','result'=>$result),200);
                    }else{
                        return $response->withJson(array('status' => 'False'),422);
                    }
                    $db=null;

                } catch(PDOException $ex) {
                    return $response->withJson(array('error' => $ex->getMessage()),422);
                }
            }
                
            // แสดงรายละเอียดของทุนนั้นๆตามไอดี
            function getScholarshipById($request, $response) {
                $Scholarship_ID = 0;
                $Scholarship_ID =  $request->getAttribute('Scholarship_ID');
                try {
                    $db = getConnection();
                    $sql = "SELECT Scholarship.Scholarship_Name, Scholarship.Scholarship_Giver, Scholarship.Scholarship_Year AS Year, Scholarship.Scholarship_Count, Scholarship.Scholarship_Amount, Scholarship.Scholarship_Amounttotal
                    FROM `Scholarship` 
                    WHERE Scholarship.Scholarship_ID = :Scholarship_ID ";
                    $stmt = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $values = array(
                        ':Scholarship_ID' => $Scholarship_ID
                    );
                    $stmt->execute($values);
                    $result = $stmt->fetchAll(PDO::FETCH_OBJ);


                    if($result){
                        return $response->withJson(array('status' => 'true','result'=>$result),200);
                    }else{
                        return $response->withJson(array('status' => 'False'),422);
                    }
                    $db=null;

                } catch(PDOException $ex) {
                    return $response->withJson(array('error' => $ex->getMessage()),422);
                }
            }
               
            // ดูว่าใครอยู่ในทุนนั้นบ้าง
            function getScholarshipStudent($request, $response) {
                $Scholarship_ID = 0;
                $Scholarship_ID =  $request->getAttribute('Scholarship_ID');
                try {
                    $db = getConnection();
                    $sql = "SELECT Scholarship_has_Student.Student_ID, CONCAT(Student.Student_Prefix, ' ',Student.Student_Name_Th , ' ' ,Student.Student_Lname_Th) AS Full_Name
                    FROM Scholarship 
                    INNER JOIN Scholarship_has_Student ON Scholarship.Scholarship_ID = Scholarship_has_Student.Scholarship_ID 
                    INNER JOIN Student ON Scholarship_has_Student.Student_ID = Student.Student_ID
                    WHERE Scholarship.Scholarship_ID = :Scholarship_ID ";
                    $stmt = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $values = array(
                        ':Scholarship_ID' => $Scholarship_ID
                    );
                    $stmt->execute($values);
                    $result = $stmt->fetchAll(PDO::FETCH_OBJ);


                    if($result){
                        return $response->withJson(array('status' => 'true','result'=>$result),200);
                    }else{
                        return $response->withJson(array('status' => 'False'),422);
                    }
                    $db=null;

                } catch(PDOException $ex) {
                    return $response->withJson(array('error' => $ex->getMessage()),422);
                }
            }
        
            // แสดงว่านิสิตมีทุนอะไรที่ลงไปแล้วบ้าง
            function getScholarshipInStudent($request, $response) {
                $Student_ID = 0;
                $Student_ID =  $request->getAttribute('Student_ID');
                try {
                    $db = getConnection();
                    $sql = "SELECT  Scholarship.Scholarship_Name, Scholarship.Scholarship_Giver, Scholarship.Scholarship_Year, Scholarship.Scholarship_Count, Scholarship.Scholarship_Amount, Scholarship.Scholarship_Amounttotal
                    FROM Scholarship
                    INNER JOIN Scholarship_has_Student ON Scholarship.Scholarship_ID = Scholarship_has_Student.Scholarship_ID 
                    INNER JOIN Student ON Scholarship_has_Student.Student_ID = Student.Student_ID
                    WHERE Student.Student_ID = :Student_ID ";
                    $stmt = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $values = array(
                        ':Student_ID' => $Student_ID
                    );
                    $stmt->execute($values);
                    $result = $stmt->fetchAll(PDO::FETCH_OBJ);


                    if($result){
                        return $response->withJson(array('status' => 'true','result'=>$result),200);
                    }else{
                        return $response->withJson(array('status' => 'False'),422);
                    }
                    $db=null;

                } catch(PDOException $ex) {
                    return $response->withJson(array('error' => $ex->getMessage()),422);
                }
            }
            // นิสิตมีอาจาย์ที่ปรึกษาเป็นใคร
            function getStudentInAdviser($request, $response) {
                $Student_ID = 0;
                $Student_ID =  $request->getAttribute('Student_ID');
                $Student_ID = str_replace("*", "%", $Student_ID);
                try {
                    $db = getConnection();
                    $sql = "SELECT CONCAT(Adviser.Adviser_Prefix, ' ',Adviser.Adviser_Name, ' ',Adviser.Adviser_Lname)AS Full_Name_Teacher
                    FROM Student
                    INNER JOIN Adviser ON Student.Student_ID = Adviser.Student_ID
                    WHERE Student.Student_ID LIKE :Student_ID ";
                    $stmt = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $values = array(
                        ':Student_ID' => $Student_ID
                    );
                    $stmt->execute($values);
                    $result = $stmt->fetchAll(PDO::FETCH_OBJ);


                    if($result){
                        return $response->withJson(array('status' => 'true','result'=>$result),200);
                    }else{
                        return $response->withJson(array('status' => 'False'),422);
                    }
                    $db=null;

                } catch(PDOException $ex) {
                    return $response->withJson(array('error' => $ex->getMessage()),422);
                }
            }
               
            // แสดงอาจารย์ว่ามีนิสิตคนไหนในที่ปรึกษา
            function getAdviserInStudent($request, $response) {
                $Adviser_Name = 0;
                $Adviser_Name =  $request->getAttribute('Adviser_Name');
                $Adviser_Name = str_replace("*", "%", $Adviser_Name);
                try {
                    $db = getConnection();
                    $sql = "SELECT Student.Student_ID, CONCAT(Student.Student_Prefix, ' ',Student.Student_Name_Th, ' ',Student.Student_Lname_Th) AS Full_Name
                    FROM Adviser
                    INNER JOIN Student ON Adviser.Student_ID = Student.Student_ID
                    WHERE Adviser.Adviser_Name LIKE :Adviser_Name
                    AND Adviser.Adviser_Lname LIKE :Adviser_Lname ";
                    $stmt = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $values = array(
                        ':Adviser_Name' => $Adviser_Name                     
                    );
                    $stmt->execute($values);
                    $result = $stmt->fetchAll(PDO::FETCH_OBJ);


                    if($result){
                        return $response->withJson(array('status' => 'true','result'=>$result),200);
                    }else{
                        return $response->withJson(array('status' => 'False'),422);
                    }
                    $db=null;

                } catch(PDOException $ex) {
                    return $response->withJson(array('error' => $ex->getMessage()),422);
                }
            }
               
            // แสดงว่าอาจารย์คนไหนเป็นที่ปรึกษาเด็กบ้าง
            function getAdviserForStudent($request, $response) {                
                try {
                    $db = getConnection();
                    $sql = "SELECT CONCAT(Adviser.Adviser_Prefix, ' ',Adviser.Adviser_Name, ' ',Adviser.Adviser_Lname) AS Full_Name_Teacher
                    FROM Adviser
                    GROUP BY Adviser.Adviser_Prefix, Adviser.Adviser_Name, Adviser.Adviser_Lname";
                    $stmt = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                   
                    $stmt->execute($values);
                    $result = $stmt->fetchAll(PDO::FETCH_OBJ);


                    if($result){
                        return $response->withJson(array('status' => 'true','result'=>$result),200);
                    }else{
                        return $response->withJson(array('status' => 'False'),422);
                    }
                    $db=null;

                } catch(PDOException $ex) {
                    return $response->withJson(array('error' => $ex->getMessage()),422);
                }
            }
                
            // ดูว่านิสิตลงเรียนอะไรไปบ้าง
            function getSubjectsInStudent($request, $response) {
                $Student_ID = 0;
                $Student_ID =  $request->getAttribute('Student_ID');
                try {
                    $db = getConnection();
                    $sql = "SELECT  Subject.Subject_Code, Subject.Subject_Name, Subject_has_Student.Term_Number AS Term, Subject_has_Student.Subject_Year AS Year, Subject_has_Student.Subject_Credit AS Credit, Subject_has_Student.Grade
                    FROM Student
                    INNER JOIN Subject_has_Student ON Student.Student_ID = Subject_has_Student.Student_ID
                    INNER JOIN Subject ON Subject_has_Student.Subject_Code = Subject.Subject_Code
                    WHERE Student.Student_ID = :Student_ID
                    ORDER BY Subject_has_Student.Subject_Year, Subject_has_Student.Term_Number ";
                    $stmt = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $values = array(
                        ':Student_ID' => $Student_ID
                    );
                    $stmt->execute($values);
                    $result = $stmt->fetchAll(PDO::FETCH_OBJ);


                    if($result){
                        return $response->withJson(array('status' => 'true','result'=>$result),200);
                    }else{
                        return $response->withJson(array('status' => 'False'),422);
                    }
                    $db=null;

                } catch(PDOException $ex) {
                    return $response->withJson(array('error' => $ex->getMessage()),422);
                }
            }
            // จำนวนนิสิตตามสถานะ โดยแยกตามปีและเทอม ทั้งคณะ
            function getStatusStudent($request, $response) {
                $GPA_Year = 0;
                $GPA_Year =  $request->getAttribute('GPA_Year');
                $GPA_Term = 0;
                $GPA_Term =  $request->getAttribute('GPA_Term');
                try {
                    $db = getConnection();
                    $sql = "SELECT Status.Status_Name, count(*) as Count
                    FROM GPA
                    INNER JOIN Status ON GPA.Status_Term = Status.Status_ID
                    WHERE GPA.GPA_Year = :GPA_Year
                    AND GPA.GPA_Term = :GPA_Term
                    GROUP BY GPA.GPA_Term, GPA.GPA_Year, Status.Status_Name";
                    
                    $stmt = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $values = array(
                        ':GPA_Year' => $GPA_Year,
                        ':GPA_Term' => $GPA_Term
                    );
                    $stmt->execute($values);
                    $result = $stmt->fetchAll(PDO::FETCH_OBJ);


                    if($result){
                        return $response->withJson(array('status' => 'true','result'=>$result),200);
                    }else{
                        return $response->withJson(array('status' => 'False'),422);
                    }
                    $db=null;

                } catch(PDOException $ex) {
                    return $response->withJson(array('error' => $ex->getMessage()),422);
                }
            }
            // จำนวนนิสิตที่ลงทะเบียนเรียนในวิชานั้นๆ โดยแยกตามเทอมและปีการศึกษา
            function getStudentSubjects($request, $response) {
                $Subject_Code = 0;
                $Subject_Code =  $request->getAttribute('Subject_Code');
                $Term_Number = 0;
                $Term_Number =  $request->getAttribute('Term_Number');
                $Subject_Year = 0;
                $Subject_Year =  $request->getAttribute('Subject_Year');
                try {
                    $db = getConnection();
                    $sql = "SELECT  COUNT(*) AS Count
                    FROM Subject_has_Student
                    INNER JOIN Subject ON Subject_has_Student.Subject_Code = Subject.Subject_Code
                    INNER JOIN Student ON Subject_has_Student.Student_ID = Student.Student_ID
                    WHERE Subject.Subject_Code LIKE :Subject_Code
                    AND Subject_has_Student.Term_Number = :Term_Number
                    AND Subject_has_Student.Subject_Year = :Subject_Year ";
                    
                    $stmt = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $values = array(
                        ':Subject_Code' => $Subject_Code,
                        ':Term_Number' => $Term_Number,
                        ':Subject_Year' => $Subject_Year
                    );
                    $stmt->execute($values);
                    $result = $stmt->fetchAll(PDO::FETCH_OBJ);


                    if($result){
                        return $response->withJson(array('status' => 'true','result'=>$result),200);
                    }else{
                        return $response->withJson(array('status' => 'False'),422);
                    }
                    $db=null;

                } catch(PDOException $ex) {
                    return $response->withJson(array('error' => $ex->getMessage()),422);
                }
            }
               
            // จำนวนนิสิตที่เรียนผ่านในรายวิชานั้นๆ โดยแยกตามเทอมและปีการศึกษา
            function getStudentPastSubject($request, $response) {
                $Subject_Code = 0;
                $Subject_Code =  $request->getAttribute('Subject_Code');
                $Subject_Year = 0;
                $Subject_Year =  $request->getAttribute('Subject_Year');
                $Term_Number = 0;
                $Term_Number =  $request->getAttribute('Term_Number');
                try {
                    $db = getConnection();
                    $sql = "SELECT COUNT(*) AS Count
                    FROM Subject_has_Student
                    WHERE Subject_has_Student.Subject_Code = :Subject_Code
                    AND Subject_has_Student.Grade != 'F' 
                    AND Subject_has_Student.Subject_Year = :Subject_Year
                    AND Subject_has_Student.Grade != 'W'
                    AND Subject_has_Student.Grade != 'I'
                    AND Subject_has_Student.Term_Number = :Term_Number ";
                    
                    $stmt = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $values = array(
                        ':Subject_Code' => $Subject_Code,
                        ':Term_Number' => $Term_Number,
                        ':Subject_Year' => $Subject_Year
                    );
                    $stmt->execute($values);
                    $result = $stmt->fetchAll(PDO::FETCH_OBJ);


                    if($result){
                        return $response->withJson(array('status' => 'true','result'=>$result),200);
                    }else{
                        return $response->withJson(array('status' => 'False'),422);
                    }
                    $db=null;

                } catch(PDOException $ex) {
                    return $response->withJson(array('error' => $ex->getMessage()),422);
                }
            }
                  
            // แต่ละรายวิชานั้นๆมีจำนวนิสิตได้เกรดอะไรบ้าง และแต่ละเกรดมีนิสิตเท่าไหร่
            function getGradeInSubject($request, $response) {
                $Subject_Code = 0;
                $Subject_Code =  $request->getAttribute('Subject_Code');
                $Subject_Year = 0;
                $Subject_Year =  $request->getAttribute('Subject_Year');
                $Term_Number = 0;
                $Term_Number =  $request->getAttribute('Term_Number');
                try {
                    $db = getConnection();
                    $sql = "SELECT Subject_has_Student.Grade, COUNT(*) AS Count
                    FROM Subject_has_Student
                    WHERE Subject_has_Student.Subject_Code = :Subject_Code
                    AND Subject_has_Student.Subject_Year = :Subject_Year
                    AND Subject_has_Student.Term_Number = :Term_Number
                    GROUP BY Subject_has_Student.Grade ";
                    
                    $stmt = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $values = array(
                        ':Subject_Code' => $Subject_Code,
                        ':Term_Number' => $Term_Number,
                        ':Subject_Year' => $Subject_Year
                    );
                    $stmt->execute($values);
                    $result = $stmt->fetchAll(PDO::FETCH_OBJ);


                    if($result){
                        return $response->withJson(array('status' => 'true','result'=>$result),200);
                    }else{
                        return $response->withJson(array('status' => 'False'),422);
                    }
                    $db=null;

                } catch(PDOException $ex) {
                    return $response->withJson(array('error' => $ex->getMessage()),422);
                }
            }
                
            // วิชานี้มีเด็กคนไหนลงทะเบียนบ้าง
            function getSubjectHasStudent($request, $response) {
                $Subject_Code = 0;
                $Subject_Code =  $request->getAttribute('Subject_Code');
                $Subject_Year = 0;
                $Subject_Year =  $request->getAttribute('Subject_Year');
                $Term_Number = 0;
                $Term_Number =  $request->getAttribute('Term_Number');
                try {
                    $db = getConnection();
                    $sql = "SELECT CONCAT(Student.Student_ID, ' ',Student.Student_Prefix, Student.Student_Name_Th, ' ',Student.Student_Lname_Th) AS Full_Name
                    FROM Subject_has_Student
                    INNER JOIN Student ON Subject_has_Student.Student_ID = Student.Student_ID
                    INNER JOIN Subject ON Subject_has_Student.Subject_Code = Subject.Subject_Code
                    WHERE Subject_has_Student.Subject_Code = :Subject_Code
                    AND Subject_has_Student.Term_Number = :Term_Number
                    AND Subject_has_Student.Subject_Year = :Subject_Year ";
                    
                    $stmt = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $values = array(
                        ':Subject_Code' => $Subject_Code,
                        ':Term_Number' => $Term_Number,
                        ':Subject_Year' => $Subject_Year
                    );
                    $stmt->execute($values);
                    $result = $stmt->fetchAll(PDO::FETCH_OBJ);


                    if($result){
                        return $response->withJson(array('status' => 'true','result'=>$result),200);
                    }else{
                        return $response->withJson(array('status' => 'False'),422);
                    }
                    $db=null;

                } catch(PDOException $ex) {
                    return $response->withJson(array('error' => $ex->getMessage()),422);
                }
            }
            // ดูในเทอมนั้น ปีนั้นมีคนไม่ติดโปร และติดโปรอะไรบ้าง 
            function getStatusProStudents($request, $response) {
                $GPA_Term = 0;
                $GPA_Term =  $request->getAttribute('GPA_Term');
                $GPA_Year = 0;
                $GPA_Year =  $request->getAttribute('GPA_Year');
               
                try {
                    $db = getConnection();
                    $sql = "SELECT CONCAT(GPA.Student_ID, ' ',Student.Student_Prefix, ' ',Student.Student_Name_Th, ' ',Student.Student_Lname_Th) AS Full_Name ,GPA.GPAX_Term, GPA.Grade_Pro, Status_Pro.Pro_Name                    FROM GPA
                    INNER JOIN Student ON GPA.Student_ID = Student.Student_ID
                    INNER JOIN Status_Pro ON GPA.Grade_Pro = Status_Pro.Pro_ID
                    WHERE GPA.GPA_Term = :GPA_Term
                    AND GPA.GPA_Year = :GPA_Year ";
                    
                    $stmt = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $values = array(
                        ':GPA_Term' => $GPA_Term,
                        ':GPA_Year' => $GPA_Year
                        
                    );
                    $stmt->execute($values);
                    $result = $stmt->fetchAll(PDO::FETCH_OBJ);


                    if($result){
                        return $response->withJson(array('status' => 'true','result'=>$result),200);
                    }else{
                        return $response->withJson(array('status' => 'False'),422);
                    }
                    $db=null;

                } catch(PDOException $ex) {
                    return $response->withJson(array('error' => $ex->getMessage()),422);
                }
            }
               
            // ดูว่านิสิตคนที่ค้นหาติดโปรอะไรบ้าง ในเทอมไหน
            function getStudentStatusPro($request, $response) {
                $Student_ID = 0;
                $Student_ID =  $request->getAttribute('Student_ID');
                
                try {
                    $db = getConnection();
                    $sql = "SELECT GPA.GPA_Term AS Term, GPA.GPA_Year AS Year, GPA.GPAX_Term, GPA.Grade_Pro, Status_Pro.Pro_Name
                    FROM GPA
                    INNER JOIN Student ON GPA.Student_ID = Student.Student_ID
                    INNER JOIN Status_Pro ON GPA.Grade_Pro = Status_Pro.Pro_ID
                    WHERE Student.Student_ID = :Student_ID ";
                    
                    $stmt = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $values = array(
                        ':Student_ID' => $Student_ID
                        
                        
                    );
                    $stmt->execute($values);
                    $result = $stmt->fetchAll(PDO::FETCH_OBJ);


                    if($result){
                        return $response->withJson(array('status' => 'true','result'=>$result),200);
                    }else{
                        return $response->withJson(array('status' => 'False'),422);
                    }
                    $db=null;

                } catch(PDOException $ex) {
                    return $response->withJson(array('error' => $ex->getMessage()),422);
                }
            }
               
            // ดูว่าเทอมนี้ ปีนี้มีคนที่โปรที่ค้นหาเป็นใครบ้าง
            function getStatusProTermStudents($request, $response) {
                $GPA_Term = 0;
                $GPA_Term =  $request->getAttribute('GPA_Term');
                $GPA_Year = 0;
                $GPA_Year =  $request->getAttribute('GPA_Year');
                $Grade_Pro = 0;
                $Grade_Pro =  $request->getAttribute('Grade_Pro');
                try {
                    $db = getConnection();
                    $sql = "SELECT CONCAT(GPA.Student_ID, ' ',Student.Student_Prefix, ' ',Student.Student_Name_Th, ' ',Student.Student_Lname_Th) AS Full_Name, GPA.GPAX_Term, Status_Pro.Pro_Name
                    FROM GPA
                    INNER JOIN Student ON GPA.Student_ID = Student.Student_ID
                    INNER JOIN Status_Pro ON GPA.Grade_Pro = Status_Pro.Pro_ID
                    WHERE GPA.GPA_Term = :GPA_Term
                    AND GPA.GPA_Year = :GPA_Year
                    AND GPA.Grade_Pro = :Grade_Pro ";
                    
                    $stmt = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $values = array(
                        ':GPA_Term' => $GPA_Term,
                        ':GPA_Year' => $GPA_Year,
                        ':Grade_Pro' => $Grade_Pro   
                    );
                    $stmt->execute($values);
                    $result = $stmt->fetchAll(PDO::FETCH_OBJ);


                    if($result){
                        return $response->withJson(array('status' => 'true','result'=>$result),200);
                    }else{
                        return $response->withJson(array('status' => 'False'),422);
                    }
                    $db=null;

                } catch(PDOException $ex) {
                    return $response->withJson(array('error' => $ex->getMessage()),422);
                }
            }
              
            // ดูว่าในเทอมนั้น ปีนั้น มีคนติดโปรต่างๆกี่คน
            function getStudentProCount($request, $response) {
                $GPA_Term = 0;
                $GPA_Term =  $request->getAttribute('GPA_Term');
                $GPA_Year = 0;
                $GPA_Year =  $request->getAttribute('GPA_Year');
                $Grade_Pro = 0;
                $Grade_Pro =  $request->getAttribute('Grade_Pro');
                try {
                    $db = getConnection();
                    $sql = "SELECT COUNT(*) AS Count
                    FROM GPA
                    INNER JOIN Student ON GPA.Student_ID = Student.Student_ID
                    INNER JOIN Status_Pro ON GPA.Grade_Pro = Status_Pro.Pro_ID
                    WHERE GPA.GPA_Term = :GPA_Term
                    AND GPA.GPA_Year = :GPA_Year
                    AND GPA.Grade_Pro = :Grade_Pro ";
                    
                    $stmt = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $values = array(
                        ':GPA_Term' => $GPA_Term,
                        ':GPA_Year' => $GPA_Year,
                        ':Grade_Pro' => $Grade_Pro   
                    );
                    $stmt->execute($values);
                    $result = $stmt->fetchAll(PDO::FETCH_OBJ);


                    if($result){
                        return $response->withJson(array('status' => 'true','result'=>$result),200);
                    }else{
                        return $response->withJson(array('status' => 'False'),422);
                    }
                    $db=null;

                } catch(PDOException $ex) {
                    return $response->withJson(array('error' => $ex->getMessage()),422);
                }
            }
            // ดูความหมายของPro_ID
            function getStatusPro($request, $response) {
               
                try {
                    $db = getConnection();
                    $sql = "SELECT  Status_Pro.Pro_ID, Status_Pro.Pro_Name
                    FROM `Status_Pro` ";
                    
                    $stmt = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                   
                    $stmt->execute($values);
                    $result = $stmt->fetchAll(PDO::FETCH_OBJ);


                    if($result){
                        return $response->withJson(array('status' => 'true','result'=>$result),200);
                    }else{
                        return $response->withJson(array('status' => 'False'),422);
                    }
                    $db=null;

                } catch(PDOException $ex) {
                    return $response->withJson(array('error' => $ex->getMessage()),422);
                }
            }
            // ดูว่าเด็กคนไหนที่ยังไม่ผ่านวิชานี้บ้าง 
            function getStudentFailSubject($request, $response) {
                $Subject_Code = 0;
                $Subject_Code =  $request->getAttribute('Subject_Code');
                $Subject_Year = 0;
                $Subject_Year =  $request->getAttribute('Subject_Year');
                $Term_Number = 0;
                $Term_Number =  $request->getAttribute('Term_Number');
                try {
                    $db = getConnection();
                    $sql = "SELECT Student.Student_ID, CONCAT(Student.Student_Prefix, ' ', Student.Student_Name_Th, ' ',Student.Student_Lname_Th) AS Full_Name, Student.Course, Subject_has_Student.Grade
                    FROM Student
                    INNER JOIN Subject_has_Student ON Student.Student_ID = Subject_has_Student.Student_ID
                    WHERE Subject_has_Student.Subject_Code = :Subject_Code
                    AND Subject_has_Student.Subject_Year = :Subject_Year
                    AND Subject_has_Student.Term_Number = :Term_Number
                    AND(Subject_has_Student.Grade = 'F' OR Subject_has_Student.Grade = 'W')";
                    
                    $stmt = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $values = array(
                        ':Subject_Code' => $Subject_Code,
                        ':Subject_Year' => $Subject_Year,
                        ':Term_Number' => $Term_Number   
                    );
                    $stmt->execute($values);
                    $result = $stmt->fetchAll(PDO::FETCH_OBJ);


                    if($result){
                        return $response->withJson(array('status' => 'true','result'=>$result),200);
                    }else{
                        return $response->withJson(array('status' => 'False'),422);
                    }
                    $db=null;

                } catch(PDOException $ex) {
                    return $response->withJson(array('error' => $ex->getMessage()),422);
                }
            }
            // ค้นนิสิตในแต่ละปี โดยค้นหาจากปีการศึกษา และรหัสหลักสูตร
            function getStudentInYear($request, $response) {
                $Stat_Years = 0;
                $Stat_Years =  $request->getAttribute('Stat_Years');
                $Course_ID = 0;
                $Course_ID =  $request->getAttribute('Course_ID');
                try {
                    $db = getConnection();
                    $sql = "SELECT Status.Status_Name,Static_Student.Stat_Amount AS Count
                    FROM Course
                    INNER JOIN Static_Student ON Course.Course_Name = Static_Student.Stat_Course
                    INNER JOIN Status ON Static_Student.Stat_Status = Status.Status_ID
                    WHERE Static_Student.Stat_Years = :Stat_Years
                    AND Course.Course_ID = :Course_ID
                    GROUP BY Static_Student.Stat_Course, Static_Student.Stat_Status";
                    
                    $stmt = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $values = array(
                        ':Stat_Years' => $Stat_Years,
                        ':Course_ID' => $Course_ID                     
                    );
                    $stmt->execute($values);
                    $result = $stmt->fetchAll(PDO::FETCH_OBJ);


                    if($result){
                        return $response->withJson(array('status' => 'true','result'=>$result),200);
                    }else{
                        return $response->withJson(array('status' => 'False'),422);
                    }
                    $db=null;

                } catch(PDOException $ex) {
                    return $response->withJson(array('error' => $ex->getMessage()),422);
                }
            }

            function generateRandomString($length = 10) {
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
                return $randomString;
            }
           
?>