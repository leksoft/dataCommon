<?php
namespace App\Lib;
class Common {

    /* แปลงวันที่จาก Text ลงฐานข้อมูล
     * รับค่าเข้ามาเป็น วว/ดด/ปปปป
     * แปลงค่ากลับไปเป็น yyyy/mm/dd
     */

    function dateToMysql($txt) {
        $result = "";
        if ($txt != "") {
            $year = substr($txt, 6, 4);
            if ($year > 2500) {
                $year = $year - 543;
            }
            $month = substr($txt, 3, 2);
            $day = substr($txt, 0, 2);
            $result = $year . "-" . $month . "-" . $day;
        }
        return $result;
    }

    /* แปลงวันที่จากฐานข้อมูล ไป TextBox รปแบบวันที่นำเข้า 2009-07-30 */

    function dateToText($strDate) {
        $result = "";
        if ($strDate === "" || $strDate == null || $strDate == "0000-00-00") {
            return "";
        } else if (substr($strDate, 0, 4) != "0000") {
            $strYear = date("Y", strtotime($strDate)) + 543;
            $strMonth = date("m", strtotime($strDate));
            $strDay = date("d", strtotime($strDate));
            $result = "$strDay/$strMonth/$strYear";
            return $result;
        }
    }
       /**
     *
     * @param <date> $strDate
     * @param <int> $style 0=วัน เดือน ปี พ.ศ, 1=เดือน ปี พ.ศ.
     * @return <string> string
     */
    function dateThaiLong($strDate, $style = 0) {
        $strYear = date("Y", strtotime($strDate));
       
        $strMonth = date("n", strtotime($strDate));
        $strDay = (int)date("d", strtotime($strDate));
        $strMonthCut = Array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฏาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
        $strMonthThai = $strMonthCut[$strMonth];

        if ($style == 0) {
            return "$strDay $strMonthThai $strYear";
        } else {
            return "$strMonthThai พ.ศ.$strYear";
        }
    }
     function dateThaiLong2($strDate, $style = 0) {
       
        $strYear = date("Y", strtotime($strDate)) + 543;
        $strMonth = date("n", strtotime($strDate));
        $strDay = (int)date("d", strtotime($strDate));
        $strMonthCut = Array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฏาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
        $strMonthThai = $strMonthCut[$strMonth];

        if ($style == 0) {
            return "$strDay $strMonthThai $strYear";
        } else {
            return "$strMonthThai พ.ศ.$strYear";
        }
    }

    /* แปลงวันที่จากฐานข้อมูล ไป TextBox รปแบบวันที่นำเข้า 2009-07-30 */

    function dateToTextShort($strDate) {
        $result = "";
        if ($strDate === "")
            return $this->dateToText(date("Y/m/d"));

        if (substr($strDate, 0, 4) != "0000") {
            $strYear = date("Y", strtotime($strDate)) + 543;
            $strYear = substr($strYear, 2);
            $strMonth = date("m", strtotime($strDate));
            $strDay = $this->DataN(date("d", strtotime($strDate)));
            $result = "$strDay/$strMonth/$strYear";
        }
        return $result;
    }

    /*
     * หาผลต่างของวันที่และเวลา return เป็นชั่วโมง
     * echo "Date Time Diff = ".dateTimeDiff("2008-08-01 00:00","2008-08-01 19:00")."<br>";
     */
    function dateTimeDiff($strDateTime1, $strDateTime2) {
        return (strtotime($strDateTime2) - strtotime($strDateTime1)) / ( 60 * 60 ); // 1 Hour =  60*60
    }
    
    //คืนค่าวันที่ การป้อนป้อน 2012-12-01
    function get_dateMySql($date){
        $day = substr($date, 8, 2);
        return $day;
    }
   
    //แปลงค่าเงินเป็นตัวหนังสือ
function num2wordsThai($num) {
    $num = str_replace(",", "", $num);
    $num_decimal = explode(".", $num);
    $num = $num_decimal[0];
    $returnNumWord = '';
    $lenNumber = strlen($num);
    $lenNumber2 = $lenNumber - 1;
    $kaGroup = array("", "สิบ", "ร้อย", "พัน", "หมื่น", "แสน", "ล้าน", "สิบ", "ร้อย", "พัน", "หมื่น", "แสน", "ล้าน");
    $kaDigit = array("", "หนึ่ง", "สอง", "สาม", "สี่", "ห้า", "หก", "เจ็ด", "แปด", "เก้า");
    $kaDigitDecimal = array("ศูนย์", "หนึ่ง", "สอง", "สาม", "สี่", "ห้า", "หก", "เจ็ต", "แปด", "เก้า");
    $ii = 0;
    for ($i = $lenNumber2; $i >= 0; $i--) {
        $kaNumWord[$i] = substr($num, $ii, 1);
        $ii++;
    }
    $ii = 0;
    for ($i = $lenNumber2; $i >= 0; $i--) {
        if (($kaNumWord[$i] == 2 && $i == 1) || ($kaNumWord[$i] == 2 && $i == 7)) {
            $kaDigit[$kaNumWord[$i]] = "ยี่";
        } else {
            if ($kaNumWord[$i] == 2) {
                $kaDigit[$kaNumWord[$i]] = "สอง";
            }
            if (($kaNumWord[$i] == 1 && $i <= 2 && $i == 0) || ($kaNumWord[$i] == 1 && $lenNumber > 6 && $i == 6)) {
                if ($kaNumWord[$i + 1] == 0) {
                    $kaDigit[$kaNumWord[$i]] = "หนึ่ง";
                } else {
                    $kaDigit[$kaNumWord[$i]] = "เอ็ด";
                }
            } elseif (($kaNumWord[$i] == 1 && $i <= 2 && $i == 1) || ($kaNumWord[$i] == 1 && $lenNumber > 6 && $i == 7)) {
                $kaDigit[$kaNumWord[$i]] = "";
            } else {
                if ($kaNumWord[$i] == 1) {
                    $kaDigit[$kaNumWord[$i]] = "หนึ่ง";
                }
            }
        }
        if ($kaNumWord[$i] == 0) {
            if ($i != 6) {
                $kaGroup[$i] = "";
            }
        }
        $kaNumWord[$i] = substr($num, $ii, 1);
        $ii++;
        $returnNumWord.=$kaDigit[$kaNumWord[$i]] . $kaGroup[$i];
    }
    if (isset($num_decimal[1])) {
        $returnNumWord.="จุด";
        for ($i = 0; $i < strlen($num_decimal[1]); $i++) {
            $returnNumWord.=$kaDigitDecimal[substr($num_decimal[1], $i, 1)];
        }
    }
    return $returnNumWord;
}
    

    

}
