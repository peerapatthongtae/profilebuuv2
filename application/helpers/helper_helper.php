<?php
    function get_terms() {
        $terms = array(
            'เทอม 1' => 'เทอม 1',
            'เทอม 2' => 'เทอม 2',
            'ซัมเมอร์' => 'ซัมเมอร์',
        );
    return $terms;
    }

    function get_bloods() {
        $bloods = array(
            'ไม่ระบุ' => 'ไม่ระบุ',
            'A' => 'A',
            'B' => 'B',
            'O' => 'O',
            'AB' => 'AB',
            'RH+' => 'RH+',
            'RH-' => 'RH-'
        );
    return $bloods;
    }
    function get_status_creator() {
        $status_creator = array(
            'ไม่ระบุ' => 'ไม่ระบุ',
            'มีชีวิต' => 'มีชีวิต',
            'ถึงแก่กรรม' => 'ถึงแก่กรรม'
        );
    return $status_creator;
    }

    function get_status_parent() {
        $status_parent = array(
            'ไม่ระบุ' => 'ไม่ระบุ',
            'มีชีวิต' => 'มีชีวิต',
            'ถึงแก่กรรม' => 'ถึงแก่กรรม',
            'บิดา มารดา' => 'บิดา มารดา',
            'บิดา' => 'บิดา',
            'มารดา' => 'มารดา',
            'ญาติ' => 'ญาติ',
            'ผู้รับอุปการะ' => 'ผู้รับอุปการะ',
            'ตนเอง' => 'ตนเอง',
            'อื่นๆ' => 'อื่นๆ',
            'สามี' => 'สามี',
            'ภรรยา' => 'ภรรยา'
        );
    return $status_parent;
    }
    function get_courses(){
        $course = array(
            'วท.บ. เทคโนโลยีสารสนเทศ' => 'วท.บ. เทคโนโลยีสารสนเทศ',
            'วท.บ. วิทยาการคอมพิวเตอร์' => 'วท.บ. วิทยาการคอมพิวเตอร์',
            'วท.บ. วิศวกรรมซอร์ฟแวร์' => 'วท.บ. วิศวกรรมซอร์ฟแวร์',
            'วท.ม. เทคโนโลยีสารสนเทศ' => 'วท.ม. เทคโนโลยีสารสนเทศ',
            'วท.ม. วิทยาการคอมพิวเตอร์' => 'วท.ม. วิทยาการคอมพิวเตอร์',
            'ปร.ด. วิทยาการคอมพิวเตอร์' => 'ปร.ด. วิทยาการคอมพิวเตอร์'
        );
    return $course;
    }

    function get_scholarship() {
        $scholarship = array(
            'ทุนผลการเรียนดีเด่น' => 'ทุนผลการเรียนดีเด่น',
            'ทุนกิจกรรม' => 'ทุนกิจกรรม',
            'ทุนขาดแคลนทุนทรัพย์' => 'ทุนขาดแคลนทุนทรัพย์'
        );
    return $scholarship;
    }

function get_workplace() {
        $status_workplace = array(
            'ยังไม่ทำงาน' => 'ยังไม่ทำงาน',
            'ทำงาน' => 'ทำงาน',
            'ยังไม่ทำงานและกำลังศึกษาต่อ' => 'ยังไม่ทำงานและกำลังศึกษาต่อ'
        );
    return $status_workplace;
    }

function thaiDate($strDate = '2018-01-01 00:00:00', $full_date = false, $show_time = true)
{
    $strYear = date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));
    $strHour= date("H",strtotime($strDate));
    $strMinute= date("i",strtotime($strDate));
    $strSeconds= date("s",strtotime($strDate));
    if(!$full_date) {
        
        $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ษ.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
		
		if($show_time) {
			return "$strDay $strMonthThai $strYear $strHour:$strMinute น.";
		} else {
			return "$strDay $strMonthThai $strYear ";
		}
    } else {
        $strDayCut['Sun'] = 'อาทิตย์';
        $strDayCut['Mon'] = 'จันทร์';
        $strDayCut['Tue'] = 'อังคาร';
        $strDayCut['Wed'] = 'พุธ';
        $strDayCut['Thu'] = 'พฤหัส';
        $strDayCut['Fri'] = 'ศุกร์';
        $strDayCut['Sat'] = 'เสาร์';
        $strMonthCut = array('', 'มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฏาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤษจิกายน', 'ธันวาคม');
    
        $strMonthThai=$strMonthCut[$strMonth];
		$strDayThai=$strDayCut[date("D",strtotime($strDate))];
		
		if($show_time) {
			return "วัน $strDayThai ที่ $strDay $strMonthThai พ.ศ. $strYear เวลา $strHour:$strMinute น.";
		} else {
			return "วัน $strDayThai ที่ $strDay $strMonthThai พ.ศ. $strYear";			
		}
        
    }
}



?>
