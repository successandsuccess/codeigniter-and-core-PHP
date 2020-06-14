<?php

require_once (ROOT_PATH . "/../classes/phpoffice_phpspreadsheet/index.php");

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

ini_set('memory_limit', '256M'); // or you could use 1G

class SpreadSheetClass {

    public function writeSheet($activeSheet, $mainData) {
        $isPrintHeader = false;

        $colStart = 833;
        $colIndex = $colStart;

        $styleArray = [
            'font' => [
                'bold' => true,
            ],
        ];

        $rowIndex = 1;
        foreach ($mainData as $row) {
            if (! $isPrintHeader) {
                $headers = array_keys($row);
                $colIndex = $colStart;
                foreach($headers as $header) {
                    $activeSheet->setCellValue(chr($colIndex).$rowIndex, $header);
                    $activeSheet->getStyle(chr($colIndex).$rowIndex)->applyFromArray($styleArray);
                    $colIndex++;
                }
                $rowIndex++;
                $isPrintHeader = true;
            }

            $colIndex = $colStart;
            $data = array_values($row);
            foreach($data as $item) {
                $activeSheet->setCellValue(chr($colIndex).$rowIndex, $item);
                $colIndex++;
            }
            $rowIndex++;
        }

        foreach(range(chr($colStart),chr($colIndex)) as $columnID) {
            $activeSheet->getColumnDimension($columnID)
                ->setAutoSize(true);
        }
    }

    public function export() {
        $db = new Database();

        $mainQuery =
            "SELECT " .
                "H.`User ID`, " .
                "H.Role, " .
                "H.`Full Name`, " .
                "H.Email, " .
                "H.Pass, " .
                "H.CRM, " .
                "H.`Certificate #`, " .
                "H.`Zip Code`, " .
                "H.`1st Year`, " .
                "H.`CME Due`, " .
                "H.`CDQ Due`, " .
                "E.University_Name AS `University Name`, " .
                "H.`Graduation Date`, " .
                "E.Designation, " .
                "H.Birthdate, " .
                "H.Gender  " .
            "FROM " .
                "( " .
                "SELECT " .
                    "A.id AS `User ID`, " .
                    "A.role AS Role, " .
                    "A.full_name AS `Full Name`, " .
                    "A.email AS Email, " .
                    "A.`PASSWORD` AS Pass, " .
                    "B.id_crm AS CRM, " .
                    "B.id_certificate AS `Certificate #`, " .
                    "C.zip_code AS `Zip Code`, " .
                    "B.first_year AS `1st Year`, " .
                    "B.cme_due AS `CME Due`, " .
                    "B.cdq_due AS `CDQ Due`, " .
                    "D.actual_graduation_date AS `Graduation Date`, " .
                    "D.university_id AS `University ID`, " .
                    "F.dob AS Birthdate, " .
                    "G.gender AS Gender  " .
                "FROM " .
                    "( SELECT id, email, PASSWORD, full_name, role FROM users ) AS A " .
                    "LEFT JOIN ( SELECT user_id, id_crm, id_certificate, first_year, cme_due, cdq_due FROM temp_stats Group by user_id ) AS B ON A.id = B.user_id " .
                    "LEFT JOIN ( SELECT user_id, zip_code FROM final_address_contact_information Group by user_id ) AS C ON A.id = C.user_id " .
                    "LEFT JOIN ( SELECT user_id, university_id, actual_graduation_date FROM final_program_university_info Group by user_id ) AS D ON A.id = D.user_id " .
                    "LEFT JOIN ( SELECT user_id, dob FROM final_account_security_information Group by user_id ) AS F ON A.id = F.user_id " .
                    "LEFT JOIN ( SELECT user_id, gender FROM final_personal_information Group by user_id ) AS G ON A.id = G.user_id  " .
                ") AS H " .
                "LEFT JOIN ( SELECT id, University_Name, Designation FROM tbl_university ) AS E ON H.`University ID` = E.id";

        $mainData = $db->getData($mainQuery);

        $spreadsheet = new Spreadsheet();
        $Excel_writer = new Xlsx($spreadsheet);

        $spreadsheet->setActiveSheetIndex(0);
        $activeSheet = $spreadsheet->getActiveSheet();
        $activeSheet->setTitle('Main');

        $this->writeSheet($activeSheet, $mainData);

        $certQuery =
            "SELECT " .
                "E.`User ID`, " .
                "E.Role, " .
                "E.`Full Name`, " .
                "E.Email, " .
                "E.University_Id AS `University ID`, " .
                "C.University_Name AS `University Name`, " .
                "E.`Class of`, " .
                "D.Expected_Graduation AS `Expected Graduation Date`, " .
                "E.`Date Paid`, " .
            "IF " .
                "( " .
                    "E.Amount = 1, " .
                    "'$1000.00', " .
                "IF " .
                    "( " .
                        "E.Amount = 2, " .
                        "'$1327.50', " .
                    "IF " .
                        "( " .
                            "E.Amount = 3, " .
                            "'$150.00', " .
                        "IF " .
                        "( E.Amount = 4, '$150', NULL )))) AS Amount, " .
                "E.`CC Last4`, " .
                "E.`Cert Exam Date`, " .
                "E.`Cert Late Fee Amount`, " .
                "E.`Retake #5 Fee` " .
            "FROM " .
                "( " .
                "SELECT " .
                    "A.id AS `User ID`, " .
                    "A.role AS `Role`, " .
                    "A.full_name AS `Full Name`, " .
                    "A.email AS `Email`, " .
                    "B.University_Id, " .
                    "B.class_of AS `Class of`, " .
                    "CAST( FROM_UNIXTIME( Z.action_date ) AS DATE ) AS `Date Paid`, " .
                    "X.certification_date AS `Cert Exam Date`, " .
                    "Z.amount_num AS `Amount`, " .
                    "Z.card_num4 AS `CC Last4`, " .
                    "Y.retake5_amount AS `Retake #5 Fee`, " .
                    "Y.late_fee_amount AS `Cert Late Fee Amount` " .
                "FROM " .
                    "( SELECT id, email, role, full_name FROM users ) AS A " .
                    "LEFT JOIN ( SELECT user_id, certification_date FROM temp_stats ) AS X ON A.id = X.user_id " .
                    "LEFT JOIN ( SELECT user_id, University_Id, First_Name, Last_Name, class_of FROM tbl_class GROUP BY user_id ) AS B ON A.id = B.user_id " .
                    "LEFT JOIN ( SELECT user_id, card_num4, action_date, amount_num FROM action_history_certification GROUP BY user_id ) AS Z ON A.id = Z.user_id " .
                    "LEFT JOIN ( SELECT user_id, late_fee_amount, retake5_amount FROM incomecertification GROUP BY user_id ) AS Y ON A.id = Y.user_id  " .
                ") AS E " .
                "LEFT JOIN ( SELECT id, University_Name FROM tbl_university ) AS C ON E.University_Id = C.id " .
                "LEFT JOIN ( SELECT University_Id, Expected_Graduation FROM tbl_expected_dates GROUP BY University_Id ) AS D ON E.University_Id = D.University_Id";
        $certData = $db->getData($certQuery);


        $spreadsheet->createSheet();
        $spreadsheet->setActiveSheetIndex(1);
        $activeSheet = $spreadsheet->getActiveSheet();
        $activeSheet->setTitle('Cert');

        $this->writeSheet($activeSheet, $certData);

        $cmeQuery =
                "SELECT " .
                    "H.*  " .
                "FROM " .
                    "( " .
                    "SELECT " .
                        "A.id AS `User ID`, " .
                        "A.role AS Role, " .
                        "A.full_name AS `Full Name`, " .
                        "A.email AS Email, " .
                        "Z.first_year AS `1st Year`, " .
                        "B.cme_cycle_start AS Cycle, " .
                        "Z.cme_due AS `CME Due Date`, " .
                        "CAST( FROM_UNIXTIME( D.action_date ) AS DATE ) AS `Date Paid`, " .
                        "C.amount AS Amount, " .
                        "D.card_num4 AS `CC Last 4`, " .
                        "DATE_ADD( Z.cme_due, INTERVAL 2 YEAR ) AS `Next Due Date`, " .
                        "C.late_due_date AS `Late Due Start`, " .
                        "C.late_fee_amount AS `Late Fee Amount`, " .
                        "B.cme_doc AS `Document Name`, " .
                        "CAST( FROM_UNIXTIME( B.date_submitted ) AS DATE ) AS `Date Uploaded`, " .
                        "B.cme_hours AS `#Credits`, " .
                        "B.cme_type AS Type, " .
                        "B.cme_provider AS Provider " .
                    "FROM " .
                        "( SELECT id, email, PASSWORD, full_name, role FROM users ) AS A " .
                        "LEFT JOIN ( SELECT user_id, first_year, cme_due FROM temp_stats GROUP BY user_id ) AS Z ON Z.user_id = A.id " .
                        "LEFT JOIN ( SELECT user_id, date_submitted, cme_type, cme_hours, cme_doc, cme_provider, cme_cycle_start FROM tbl_add_cme ) AS B ON A.id = B.user_id " .
                        "LEFT JOIN ( SELECT user_id, amount, late_due_date, late_fee_amount FROM incomecme ) AS C ON A.id = C.user_id " .
                        "LEFT JOIN ( SELECT user_id, card_num4, action_date FROM action_history_cme ) AS D ON A.id = D.user_id  " .
                    ") AS H  " .
                "GROUP BY " .
                    "H.`User ID`";

        $cmeData = $db->getData($cmeQuery);

        $spreadsheet->createSheet();
        $spreadsheet->setActiveSheetIndex(2);
        $activeSheet = $spreadsheet->getActiveSheet();
        $activeSheet->setTitle('CME');
        $this->writeSheet($activeSheet, $cmeData);

        $cdqQuery =
            "SELECT " .
                "A.id AS `User ID`, " .
                "A.role AS Role, " .
                "A.full_name AS `Full Name`, " .
                "A.email AS Email, " .
                "C.first_year AS `1st Year`, " .
                "C.cdq_due AS `CDQ Due Date`, " .
                "C.cdq_due AS `Exam Date`, " .
                "CAST( FROM_UNIXTIME( D.action_date ) AS DATE ) AS `Date Paid`, " .
            "IF " .
                "( " .
                    "D.amount_num = 1, " .
                    "'$1000.00', " .
                "IF " .
                    "( " .
                        "D.amount_num = 2, " .
                        "'$1327.50', " .
                    "IF " .
                        "( " .
                            "D.amount_num = 3, " .
                            "'$150.00', " .
                        "IF " .
                        "( D.amount_num = 4, '$150', NULL )))) AS `Amount`, " .
                "D.card_num4 AS `CC Last 4`, " .
                "Date_ADD( C.cdq_due, INTERVAL 10 YEAR ) AS `Next Due Date` " .
            "FROM " .
                "( SELECT id, email, PASSWORD, full_name, role FROM users ) AS A " .
                "LEFT JOIN ( SELECT user_id, first_year, cdq_due FROM temp_stats Group By user_id ) AS C ON A.id = C.user_id " .
                "LEFT JOIN ( SELECT user_id FROM action_history_cdq GROUP BY user_id ) AS B ON A.id = B.user_id " .
                "LEFT JOIN ( SELECT user_id, card_num4, action_date, amount_num FROM action_history_cdq Group by user_id ) AS D ON A.id = D.user_id";

        $cdqData = $db->getData($cdqQuery);

        $spreadsheet->createSheet();
        $spreadsheet->setActiveSheetIndex(3);
        $activeSheet = $spreadsheet->getActiveSheet();
        $activeSheet->setTitle('CDQ');
        $this->writeSheet($activeSheet, $cdqData);

        $certUnpaidQuery =
            "SELECT " .
                "A.id AS 'User ID', " .
                "A.role AS Role, " .
                "A.full_name AS 'Full Name', " .
                "A.email AS Email, " .
                "C.id AS 'University ID', " .
                "C.University_Name AS 'University Name', " .
                "B.class_of AS 'Expected Graduation Date' " .
            "FROM " .
                "( SELECT id, email, role, full_name FROM users ) AS A " .
                "LEFT JOIN ( SELECT user_id, class_of, University_id FROM tbl_class ) AS B ON A.id = B.user_id " .
                "LEFT JOIN (select id, University_Name from tbl_university) AS C ON B.University_Id = C.id";

        $certUnpaidData = $db->getData($certUnpaidQuery);

        $spreadsheet->createSheet();
        $spreadsheet->setActiveSheetIndex(4);
        $activeSheet = $spreadsheet->getActiveSheet();
        $activeSheet->setTitle('CERT Unpaid');
        $this->writeSheet($activeSheet, $certUnpaidData);

        $cmeUnpaidQuery =
            "SELECT " .
                "A.id AS 'User ID', " .
                "A.role AS Role, " .
                "A.full_name AS 'Full Name', " .
                "A.email AS Email, " .
                "CONCAT_WS( " .
                    "'-', " .
                    "B.cme_cycle_start,( " .
                        "B.cme_cycle_start + 2 " .
                    ")) AS 'Cycle' " .
            "FROM " .
                "( SELECT id, email, role, full_name FROM users ) AS A " .
                "LEFT JOIN ( SELECT user_id, cme_cycle_start FROM tbl_add_cme GROUP BY user_id ) AS B ON A.id = B.user_id";

        $cmeUnpaidData = $db->getData($cmeUnpaidQuery);

        $spreadsheet->createSheet();
        $spreadsheet->setActiveSheetIndex(5);
        $activeSheet = $spreadsheet->getActiveSheet();
        $activeSheet->setTitle('CME Unpaid');
        $this->writeSheet($activeSheet, $cmeUnpaidData);

        $cdqUnpaidQuery =
            "SELECT " .
                "A.id AS 'User ID', " .
                "A.role AS Role, " .
                "A.full_name AS 'Full Name', " .
                "A.email AS Email " .
            "FROM " .
                "( SELECT id, email, role, full_name FROM users ) AS A";

        $cdqUnpaidData = $db->getData($cdqUnpaidQuery);

        $spreadsheet->createSheet();
        $spreadsheet->setActiveSheetIndex(6);
        $activeSheet = $spreadsheet->getActiveSheet();
        $activeSheet->setTitle('CDQ Unpaid 2021');
        $this->writeSheet($activeSheet, $cdqUnpaidData);

        $spreadsheet->setActiveSheetIndex(0);

        $timestamp = time();
        $filename = 'export_excel'.$timestamp.'.xlsx';

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename='. $filename);
        header('Cache-Control: max-age=0');

        if (ob_get_length() > 0) {
            ob_end_clean();
        }
        $Excel_writer->save('php://output');
        die;
    }
}
?>