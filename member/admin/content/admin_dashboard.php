                <div class="top-heading card">
                    <h2>Admin</h2>
                    <span class="toggler"><img src="images/arrow-doen.png" alt=""></span>
                </div>
                <div class="admin-cards card">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="adminCard member">
                                <h3>ITE Registration</h3>
                                <ul>
                                    <div id="2020">
                                        <!-- <li>Total Students 2020 <span class="amount"><?php echo $dashboard_data->get_totalCAAs();?></span></li> -->
                                        <li>Total Students 2020 <span class = "amount"><?php echo $dashboard_data->get_total_student_2020(2020);?></span></li>
                                        <!-- <li>Total Selected <span class="amount"><?php echo $dashboard_data->get_decertifiedCAAs();?></span></li> -->
                                        <li>Total Selected <span class="amount"><?php echo $dashboard_data->get_selected_student_2020(2020);?></span></li>
                                        <!-- <li>Remaining <span class="percent"><?php echo $dashboard_data->get_women_persent()."%";?></span></li> -->
                                        <li>Remaining <span class="amount"><?php echo ($dashboard_data->get_total_student_2020(2020)-$dashboard_data->get_selected_student_2020(2020));?></span></li>

                                        <li class="gap20"></li>
                                        <!-- <li>Men <span class="percent"><?php echo $dashboard_data->get_men_persent()."%";?></span></li> -->
                                        <!-- <li>Women <span class="percent"><?php echo $dashboard_data->get_men_persent()."%";?></span></li> -->
                                    </div>
                                    <div id="2021" style="display: none;">
                                        <li>Total Students 2021 <span class = "amount"><?php echo $dashboard_data->get_total_student_2020(2021);?></span></li>
                                        <li>Total Selected <span class="amount"><?php echo $dashboard_data->get_selected_student_2020(2021);?></span></li>
                                        <li>Remaining <span class="amount"><?php echo ($dashboard_data->get_total_student_2020(2021)-$dashboard_data->get_selected_student_2020(2021));?></span></li>

                                        <li class="gap20"></li>
                                        <!-- <li>Men <span class="percent"><?php echo $dashboard_data->get_men_persent()."%";?></span></li> -->
                                        <!-- <li>Women <span class="percent"><?php echo $dashboard_data->get_men_persent()."%";?></span></li> -->
                                    </div>
                                    <div id="2022" style="display: none;">
                                        <!-- <li>Total Students 2020 <span class="amount"><?php echo $dashboard_data->get_totalCAAs();?></span></li> -->
                                        <li>Total Students 2022 <span class = "amount"><?php echo $dashboard_data->get_total_student_2020(2022);?></span></li>
                                        <!-- <li>Total Selected <span class="amount"><?php echo $dashboard_data->get_decertifiedCAAs();?></span></li> -->
                                        <li>Total Selected <span class="amount"><?php echo $dashboard_data->get_selected_student_2020(2022);?></span></li>
                                        <!-- <li>Remaining <span class="percent"><?php echo $dashboard_data->get_women_persent()."%";?></span></li> -->
                                        <li>Remaining <span class="amount"><?php echo ($dashboard_data->get_total_student_2020(2022)-$dashboard_data->get_selected_student_2020(2022));?></span></li>

                                        <li class="gap20"></li>
                                        <!-- <li>Men <span class="percent"><?php echo $dashboard_data->get_men_persent()."%";?></span></li> -->
                                        <!-- <li>Women <span class="percent"><?php echo $dashboard_data->get_men_persent()."%";?></span></li> -->
                                    </div>
                                    <div id="2023" style="display: none;">
                                        <!-- <li>Total Students 2020 <span class="amount"><?php echo $dashboard_data->get_totalCAAs();?></span></li> -->
                                        <li>Total Students 2023 <span class = "amount"><?php echo $dashboard_data->get_total_student_2020(2023);?></span></li>
                                        <!-- <li>Total Selected <span class="amount"><?php echo $dashboard_data->get_decertifiedCAAs();?></span></li> -->
                                        <li>Total Selected <span class="amount"><?php echo $dashboard_data->get_selected_student_2020(2023);?></span></li>
                                        <!-- <li>Remaining <span class="percent"><?php echo $dashboard_data->get_women_persent()."%";?></span></li> -->
                                        <li>Remaining <span class="amount"><?php echo ($dashboard_data->get_total_student_2020(2023)-$dashboard_data->get_selected_student_2020(2023));?></span></li>

                                        <li class="gap20"></li>
                                        <!-- <li>Men <span class="percent"><?php echo $dashboard_data->get_men_persent()."%";?></span></li> -->
                                        <!-- <li>Women <span class="percent"><?php echo $dashboard_data->get_men_persent()."%";?></span></li> -->
                                    </div>
                                    <div id="2024" style="display: none;">
                                        <!-- <li>Total Students 2020 <span class="amount"><?php echo $dashboard_data->get_totalCAAs();?></span></li> -->
                                        <li>Total Students 2024 <span class = "amount"><?php echo $dashboard_data->get_total_student_2020(2024);?></span></li>
                                        <!-- <li>Total Selected <span class="amount"><?php echo $dashboard_data->get_decertifiedCAAs();?></span></li> -->
                                        <li>Total Selected <span class="amount"><?php echo $dashboard_data->get_selected_student_2020(2024);?></span></li>
                                        <!-- <li>Remaining <span class="percent"><?php echo $dashboard_data->get_women_persent()."%";?></span></li> -->
                                        <li>Remaining <span class="amount"><?php echo ($dashboard_data->get_total_student_2020(2024)-$dashboard_data->get_selected_student_2020(2024));?></span></li>

                                        <li class="gap20"></li>
                                        <!-- <li>Men <span class="percent"><?php echo $dashboard_data->get_men_persent()."%";?></span></li> -->
                                        <!-- <li>Women <span class="percent"><?php echo $dashboard_data->get_men_persent()."%";?></span></li> -->
                                    </div>
                                    <div id="2025" style="display: none;">
                                        <!-- <li>Total Students 2020 <span class="amount"><?php echo $dashboard_data->get_totalCAAs();?></span></li> -->
                                        <li>Total Students 2025 <span class = "amount"><?php echo $dashboard_data->get_total_student_2020(2025);?></span></li>
                                        <!-- <li>Total Selected <span class="amount"><?php echo $dashboard_data->get_decertifiedCAAs();?></span></li> -->
                                        <li>Total Selected <span class="amount"><?php echo $dashboard_data->get_selected_student_2020(2025);?></span></li>
                                        <!-- <li>Remaining <span class="percent"><?php echo $dashboard_data->get_women_persent()."%";?></span></li> -->
                                        <li>Remaining <span class="amount"><?php echo ($dashboard_data->get_total_student_2020(2025)-$dashboard_data->get_selected_student_2020(2025));?></span></li>

                                        <li class="gap20"></li>
                                        <!-- <li>Men <span class="percent"><?php echo $dashboard_data->get_men_persent()."%";?></span></li> -->
                                        <!-- <li>Women <span class="percent"><?php echo $dashboard_data->get_men_persent()."%";?></span></li> -->
                                    </div>
                                    <div id="2026" style="display: none;">
                                        <!-- <li>Total Students 2020 <span class="amount"><?php echo $dashboard_data->get_totalCAAs();?></span></li> -->
                                        <li>Total Students 2026 <span class = "amount"><?php echo $dashboard_data->get_total_student_2020(2026);?></span></li>
                                        <!-- <li>Total Selected <span class="amount"><?php echo $dashboard_data->get_decertifiedCAAs();?></span></li> -->
                                        <li>Total Selected <span class="amount"><?php echo $dashboard_data->get_selected_student_2020(2026);?></span></li>
                                        <!-- <li>Remaining <span class="percent"><?php echo $dashboard_data->get_women_persent()."%";?></span></li> -->
                                        <li>Remaining <span class="amount"><?php echo ($dashboard_data->get_total_student_2020(2026)-$dashboard_data->get_selected_student_2020(2026));?></span></li>

                                        <li class="gap20"></li>
                                        <!-- <li>Men <span class="percent"><?php echo $dashboard_data->get_men_persent()."%";?></span></li> -->
                                        <!-- <li>Women <span class="percent"><?php echo $dashboard_data->get_men_persent()."%";?></span></li> -->
                                    </div>
                                    <li class="gap20"></li>
                                    <!-- <li>Total students <span class="amount"><?php echo $dashboard_data->get_total_student();?></span> -->
                                    <li>Total students <span class="amount"><?php echo $dashboard_data->get_total_student_new();?></span>
                                        <ul>
                                            <!-- <li>Class of <?php echo date('Y');?> <span class="amount"><?php echo $dashboard_data->get_student_classOf(date('Y'));?></span></li> -->
                                            <li onclick="javascript:ite_registration(<?php echo date('Y');?>)" style="cursor: pointer;">Class of <?php echo date('Y');?> <span class="amount"><?php echo $dashboard_data->get_student_classOf_new(date('Y'));?></span></li>
                                            <li onclick="javascript:ite_registration(<?php echo (date('Y') + 1);?>)" style="cursor: pointer;">Class of <?php echo (date('Y') + 1);?> <span class="amount"><?php echo $dashboard_data->get_student_classOf_new((date('Y') + 1));?></span></li>
                                            <li onclick="javascript:ite_registration(<?php echo (date('Y') + 2);?>)" style="cursor: pointer;">Class of <?php echo (date('Y') + 2);?> <span class="amount"><?php echo $dashboard_data->get_student_classOf_new((date('Y')) + 2);?></span></li>
                                            <li onclick="javascript:ite_registration(<?php echo (date('Y') + 3);?>)" style="cursor: pointer;">Class of <?php echo (date('Y') + 3);?> <span class="amount"><?php echo $dashboard_data->get_student_classOf_new((date('Y')) + 3);?></span></li>
                                            <li onclick="javascript:ite_registration(<?php echo (date('Y') + 4);?>)" style="cursor: pointer;">Class of <?php echo (date('Y') + 4);?> <span class="amount"><?php echo $dashboard_data->get_student_classOf_new((date('Y')) + 4);?></span></li>
                                            <li onclick="javascript:ite_registration(<?php echo (date('Y') + 5);?>)" style="cursor: pointer;">Class of <?php echo (date('Y') + 5);?> <span class="amount"><?php echo $dashboard_data->get_student_classOf_new((date('Y')) + 5);?></span></li>
                                            <li onclick="javascript:ite_registration(<?php echo (date('Y') + 6);?>)" style="cursor: pointer;">Class of <?php echo (date('Y') + 6);?> <span class="amount"><?php echo $dashboard_data->get_student_classOf_new((date('Y')) + 6);?></span></li>

                                            <div class="row">
                                                <form action="" enctype="multipart/form-data" method="post" accept-charset="utf-8" class="export-excel-wrapper">
                                                    <button class="export-excel-btn" name="export" type="submit">
                                                        Export to Excel
                                                    </button>
                                                </form>
                                            </div>

                                            <li class="clix"><b>NBME </b><a href="#"> Click Here</a></li>
                                        </ul>
                                    </li>

                                    <div id="ite_new_text">
                                    <li class="gap20" style="margin-bottom: 43px;"></li>
                                        <li>Students Paid</li>
                                        <li>Student Not Paid</li>
                                        <li>Student Year 2021</li>
                                    </div>
                                </ul>
                            </div>
                        </div>
                        <script>
                            function ite_registration(year){
                                for(var i = 2020; i < 2027; i++)
                                {
                                    if(i == year)
                                    {
                                        document.getElementById(i).style.display = 'block';
                                    }
                                    else
                                    {
                                        document.getElementById(i).style.display = 'none';
                                    }

                                }

                            }
                        </script>

                        <style>

                        </style>

                        <div class="col-lg-3">


                            <div class="adminCard Eregistration">


                                <h3>Cert Registration</h3>

                                <style>
                                    .adminCard.Eregistration ul li {
                                        cursor: pointer;
                                    }
                                </style>

                                <ul>

                                    <!-- <li>Total Cert Due <?php echo date('Y');?> <span class="amount"><?php echo $dashboard_data->expected_students_count('Cert', date('Y'));?></span></li> -->
                                    <li onclick="javascript:cert_registration_remaining_export()">Total Cert Due <?php echo date('Y');?> <span class="amount"><?php echo $dashboard_data->expected_students_count_new('Cert', date('Y'));?></span></li>


                                    <!-- <li>Total Cert Paid <span class="amount"><?php echo $dashboard_data->get_registered_student('Certification',date('Y'), '0');?></span></li> -->
                                    <li onclick="javascript:cert_registration_remaining_export()">Total Cert Paid <span class="amount"><?php echo $dashboard_data->get_registered_student_new_month('Certification',date('Y'), '0');?></span></li>


                                    <li onclick="javascript:cert_registration_remaining_export()">Remaining <span class="amount"><?php echo ($dashboard_data->expected_students_count_new('Cert', date('Y')) - $dashboard_data->get_registered_student_new_month('Certification',date('Y'), '0'));?></span></li>


                                    <li class="gap20"></li>


                                    <!-- <li>- - Feb. <?php echo date('Y');?> Paid<span class="amount"><?php echo $dashboard_data->get_registered_student('Certification',date('Y'), '2');?></span></li> -->

                                    <li onclick="javascript:cert_registration_remaining_export()">- - Feb. <?php echo date('Y');?> Paid<span class="amount"><?php echo $dashboard_data->get_registered_student_new_month('Certification',date('Y'), '2');?></span></li>

                                    <!-- <li>- - June <?php echo date('Y');?> Paid<span class="amount"><?php echo $dashboard_data->get_registered_student('Certification',date('Y'), '6');?></span></li> -->
                                    <li onclick="javascript:cert_registration_remaining_export()">- - June <?php echo date('Y');?> Paid<span class="amount"><?php echo $dashboard_data->get_registered_student_new_month('Certification',date('Y'), '6');?></span></li>


                                    <!-- <li>- - Oct. <?php echo date('Y');?> Paid<span class="amount"><?php echo $dashboard_data->get_registered_student('Certification',date('Y'), '10');?></span></li> -->
                                    <li onclick="javascript:cert_registration_remaining_export()">- - Oct. <?php echo date('Y');?> Paid<span class="amount"><?php echo $dashboard_data->get_registered_student_new_month('Certification',date('Y'), '10');?></span></li>


                                    <!-- <li>Remaining <span class="amount"><?php echo ($dashboard_data->expected_students_count('Cert', date('Y')) - $dashboard_data->get_registered_student('Certification',date('Y'), '0'));?></span></li> -->
                                    <li onclick="javascript:cert_registration_remaining_export()">Remaining <span class="amount"><?php echo ($dashboard_data->expected_students_count_new('Cert', date('Y')) - $dashboard_data->get_registered_student_new_month('Certification',date('Y'), '0'));?></span></li>


                                    <li class="gap20"></li>


                                    <li onclick="javascript:cert_registration_remaining_next_year_export()">Total Cert Due <?php echo (date('Y') + 1);?><span class="amount"><?php echo $dashboard_data->expected_students_count_new('Cert', (date('Y') + 1));?></span></li>


                                    <!-- <li>-Total Cert Paid<span class="amount"><?php echo $dashboard_data->get_registered_student('Certification',(date('Y') + 1), '0');?></span></li>/ -->
                                    <li onclick="javascript:cert_registration_remaining_next_year_export()">Total Cert Paid<span class="amount"><?php echo $dashboard_data->get_registered_student_new_month('Certification',(date('Y') + 1), '0');?></span></li>


                                    <!-- <li>Remaining <span class="amount"><?php echo ($dashboard_data->expected_students_count('Cert', (date('Y') + 1)) - $dashboard_data->get_registered_student('Certification',(date('Y') + 1), '0'));?></span></li> -->
                                    <li onclick="javascript:cert_registration_remaining_next_year_export()">Remaining <span class="amount"><?php echo ($dashboard_data->expected_students_count_new('Cert', (date('Y') + 1)) - $dashboard_data->get_registered_student_new_month('Certification',(date('Y') + 1), '0'));?></span></li>

                                    <li class="gap20" style="margin-bottom: 62px"></li>
                                    <li>Export 2020</li>
                                    <li>Export 2021</li>
                                    <li>June 2020 Cert Exam</li>
                                    <li>Oct 2020 Cert Exam</li>
                                    <li>Feb 2021 Cert Exam</li>
                                    <li>June 2020 Cert Exam</li>

                                    <li class="clix"><b>NBME </b><a href="#"> Click Here</a></li>


                                </ul>


                            </div>


                        </div>

                        <style>
                            #cert_registration_remaining_export_wrapper .dt-button.buttons-excel.buttons-html5{
                                display: none;
                            }
                        </style>
                        <?php
                        $records = $dashboard_data->get_cert_registration_export_data(date('Y'));

                        if( !empty( $records ) ) {
                            $counts_users=1;
                            ?>
                            <table id="cert_registration_remaining_export" class="display" style="width: 100%; display:none;">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>User ID</th>
                                    <th>Role</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>University ID</th>
                                    <th>University Name</th>
                                    <th>Class of</th>
                                    <th>Cert Exam Date</th>
                                    <th>Pass/Fail</th>
                                    <th>Date Paid</th>
                                    <th>Expected Graduation Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach( $records as $item ) {
                                    if( isset($item) ) {
                                        ?>
                                        <tr>
                                            <td><?php echo $counts_users; ?></td>
                                            <td><?php echo $item['user_id']; ?></td>
                                            <td><?php echo $item['role']; ?></td>
                                            <td><?php echo $item['full_name']; ?></td>
                                            <td><?php echo $item['email']; ?></td>
                                            <td><?php echo $item['University_id']; ?></td>
                                            <td><?php echo $item['University_Name']; ?></td>
                                            <td><?php echo $item['class_of']; ?></td>
                                            <td><?php echo $item['Expected_Cert_Exam'] ? $item['Expected_Cert_Exam'] : null ; ?></td>
                                            <td>
                                                <?php
                                                    if ($item['Certification_score'] == 1) {
                                                        echo('Pass');
                                                    } else if ($item['Certification_score'] == 2) {
                                                        echo('Fail');
                                                    } else {
                                                        echo('Pending');
                                                    }
                                                ?>
                                            </td>
                                            <td><?php echo $item['action_date'] ? date('m/d/Y', $item['action_date']) : null ; ?></td>
                                            <td><?php echo $item['Expected_Graduation'] ? $item['Expected_Graduation'] : null ; ?></td>
                                        </tr>
                                        <?php
                                        $counts_users++;
                                    }
                                }
                                ?>
                                </tbody>
                            </table>

                        <?php } ?>
                        <script>

                            if( $('#cert_registration_remaining_export') != undefined )
                            {
                                $('#cert_registration_remaining_export').DataTable({
                                    dom: 'Bfrtip',
                                    buttons: [
                                        {
                                            extend: 'excelHtml5',
                                            title: 'CERT Registration Remaining'
                                        }
                                    ],
                                    paging: false,
                                    searching: false
                                });
                            }

                            function cert_registration_remaining_export()
                            {
                                $('#cert_registration_remaining_export_wrapper .dt-button.buttons-excel.buttons-html5').click();
                            }

                        </script>

                        <style>
                            #cert_registration_remaining_next_year_export_wrapper .dt-button.buttons-excel.buttons-html5{
                                display: none;
                            }
                        </style>
                        <?php
                        $records = $dashboard_data->get_cert_registration_export_data(date('Y') + 1);

                        if( !empty( $records ) ) {
                            $counts_users=1;
                            ?>
                            <table id="cert_registration_remaining_next_year_export" class="display" style="width: 100%; display:none;">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>User ID</th>
                                    <th>Role</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>University ID</th>
                                    <th>University Name</th>
                                    <th>Class of</th>
                                    <th>Cert Exam Date</th>
                                    <th>Pass/Fail</th>
                                    <th>Date Paid</th>
                                    <th>Expected Graduation Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach( $records as $item ) {
                                    if( isset($item) ) {
                                        ?>
                                        <tr>
                                            <td><?php echo $counts_users; ?></td>
                                            <td><?php echo $item['user_id']; ?></td>
                                            <td><?php echo $item['role']; ?></td>
                                            <td><?php echo $item['full_name']; ?></td>
                                            <td><?php echo $item['email']; ?></td>
                                            <td><?php echo $item['University_id']; ?></td>
                                            <td><?php echo $item['University_Name']; ?></td>
                                            <td><?php echo $item['class_of']; ?></td>
                                            <td><?php echo $item['Expected_Cert_Exam'] ? $item['Expected_Cert_Exam'] : null ; ?></td>
                                            <td>
                                                <?php
                                                if ($item['Certification_score'] == 1) {
                                                    echo('Pass');
                                                } else if ($item['Certification_score'] == 2) {
                                                    echo('Fail');
                                                } else {
                                                    echo('Pending');
                                                }
                                                ?>
                                            </td>
                                            <td><?php echo $item['action_date'] ? date('m/d/Y', $item['action_date']) : null ; ?></td>
                                            <td><?php echo $item['Expected_Graduation'] ? $item['Expected_Graduation'] : null ; ?></td>
                                        </tr>
                                        <?php
                                        $counts_users++;
                                    }
                                }
                                ?>
                                </tbody>
                            </table>

                        <?php } ?>
                        <script>

                            if( $('#cert_registration_remaining_next_year_export') != undefined )
                            {
                                $('#cert_registration_remaining_next_year_export').DataTable({
                                    dom: 'Bfrtip',
                                    buttons: [
                                        {
                                            extend: 'excelHtml5',
                                            title: 'CERT Registration Remaining'
                                        }
                                    ],
                                    paging: false,
                                    searching: false
                                });
                            }

                            function cert_registration_remaining_next_year_export()
                            {
                                $('#cert_registration_remaining_next_year_export_wrapper .dt-button.buttons-excel.buttons-html5').click();
                            }

                        </script>

                        <div class="col-lg-3">


                            <div class="adminCard Cregistration">

                                <h3>CDQ Registration</h3>


                                <ul>


                                    <!-- <li>Total CDQ Due <?php echo date('Y');?> <span class="amount"><?php echo $dashboard_data->expected_students_count('CDQ', date('Y'));?></span></li> -->
                                    <li>Total CDQXXXX Due <?php echo date('Y');?> <span class="amount"><?php echo ($dashboard_data->expected_students_count_new('CDQ', date('Y')) + 157);?></span></li>


                                    <!-- <li>- - Feb. <?php echo date('Y');?> Paid<span class="amount"><?php echo $dashboard_data->get_registered_student('CDQ', date('Y'), '2');?></span></li> -->
                                    <li>- - Feb. <?php echo date('Y');?> Paid<span class="amount"><?php echo $dashboard_data->get_registered_student_new_month('CDQ', date('Y'), '2');?></span></li>

                                    <!-- <li>- - June <?php echo date('Y');?> Paid<span class="amount"><?php echo $dashboard_data->get_registered_student('CDQ', date('Y'), '6');?></span></li> -->
                                    <li>- - June <?php echo date('Y');?> Paid<span class="amount"><?php echo ($dashboard_data->get_registered_student_new_month('CDQ', date('Y'), '6') + 157) ;?></span></li>


                                    <!-- <li>Remaining <span class="amount"><?php echo ($dashboard_data->expected_students_count('CDQ', date('Y')) - $dashboard_data->get_registered_student('CDQ', date('Y'), '0'));?></span></li> -->
                                    <li>Remaining <span class="amount"><?php echo ($dashboard_data->expected_students_count_new('CDQ', date('Y')) - $dashboard_data->get_registered_student_new_month('CDQ', date('Y'), '0'));?></span></li>

                                    <li class="gap20"></li>


                                    <!-- <li>Total CDQ Due <?php echo (date('Y') + 1);?><span class="amount"><?php echo $dashboard_data->expected_students_count('CDQ', (date('Y') + 1));?></span></li> -->
                                    <li>Total CDQ Due <?php echo (date('Y') + 1);?><span class="amount"><?php echo $dashboard_data->expected_students_count_new('CDQ', (date('Y') + 1));?></span></li>


                                    <!-- <li>Total CDQ Due <?php echo (date('Y') + 2);?><span class="amount"><?php echo $dashboard_data->expected_students_count('CDQ', (date('Y') + 2));?></span></li> -->
                                    <li>Total CDQ Due <?php echo (date('Y') + 2);?><span class="amount"><?php echo $dashboard_data->expected_students_count_new('CDQ', (date('Y') + 2));?></span></li>


                                    <!-- <li>Total CDQ Due <?php echo (date('Y') + 3);?><span class="amount"><?php echo $dashboard_data->expected_students_count('CDQ', (date('Y') + 3));?></span></li> -->
                                    <li>Total CDQ Due <?php echo (date('Y') + 3);?><span class="amount"><?php echo $dashboard_data->expected_students_count_new('CDQ', (date('Y') + 3));?></span></li>


                                    <!-- <li>Total CDQ Due <?php echo (date('Y') + 4);?><span class="amount"><?php echo $dashboard_data->expected_students_count('CDQ', (date('Y') + 4));?></span></li> -->
                                    <li>Total CDQ Due <?php echo (date('Y') + 4);?><span class="amount"><?php echo $dashboard_data->expected_students_count_new('CDQ', (date('Y') + 4));?></span></li>


                                    <!-- <li>Total CDQ Due <?php echo (date('Y') + 5);?><span class="amount"><?php echo $dashboard_data->expected_students_count('CDQ', (date('Y') + 5));?></span></li> -->
                                    <li>Total CDQ Due <?php echo (date('Y') + 5);?><span class="amount"><?php echo $dashboard_data->expected_students_count_new('CDQ', (date('Y') + 5));?></span></li>


                                    <li class="gap20"></li>


                                    <li>Total All 6 Years <span class="amount">

									<?php

									    $CDQ_6sum = 0;



										for($i=0; $i < 6; $i++){



                                            // $CDQ_6sum = $CDQ_6sum + $dashboard_data->expected_students_count('CDQ', (date('Y') + $i));
                                            $CDQ_6sum = $CDQ_6sum + $dashboard_data->expected_students_count_new('CDQ', (date('Y') + $i));



										}



										echo $CDQ_6sum;



									?>

									</span></li>

                                    <li class="gap20" style="margin-bottom: 61px"></li>


                                    <li>Export 2020</li>
                                    <li>Export 2021</li>
                                    <li>June 2020 CDQ Exam</li>
                                    <li>Feb 2021 CDQ Exam</li>
                                    <li>June 2020 CDQ Exam</li>
                                    <li class="clix"><b>NBME </b><a href="#"> Click Here</a></li>
                                </ul>
                            </div>
                        </div>


                        <div class="col-lg-3" style="padding-left:0px;">
                            <div class="adminCard financials">
                                <h3>CME Registration</h3>
                                <ul>
                                    <li>Cycle (2018-2020) <span class="amount"> <?php echo $dashboard_data->expected_students_count_new('CME', date('Y'));?></span></li>
                                    <!-- <li>Total Started <?php echo date('Y');?>  <span class="amount"> <?php echo $dashboard_data->expected_students_count('CME', date('Y'));?></span></li> -->
                                    <li>Total Started <?php echo date('Y');?>  <span class="amount"> <?php echo $dashboard_data->expected_students_count_cme('CME', date('Y'));?></span></li>
                                    <li>Total Paid<span class="amount"><?php echo $dashboard_data->get_registered_student('CME', date('Y'),'0');?></span></li>
                                    <!-- <li>Total Paid<span class="amount"><?php echo $dashboard_data->get_registered_student_new_month('CME', date('Y'),'0');?></span></li> -->
                                    <!-- <li>Remaining <span class="amount"><?php echo ($dashboard_data->expected_students_count('CME', date('Y')) - $dashboard_data->get_registered_student('CME', date('Y'),'0'));?></span></li> -->
                                    <li>Remaining <span class="amount"  style="cursor: pointer" onclick="javascript:cme_registration_remaining_export()"><?php echo number_format(($dashboard_data->expected_students_count_new_number_format('CME', date('Y')) - $dashboard_data->get_registered_student_number_format('CME', date('Y'),'0')));?></span></li>



                                    <style>
                                    #cme_registration_remaining_export_wrapper .dt-button.buttons-excel.buttons-html5{
                                        display: none;
                                    }
                                    </style>
                                    <?php
                                        $get_results_remaining = $dashboard_data->expected_students_for_export('CME', date('Y'), 'CME', date('Y'), '0');
                                        if( !empty( $get_results_remaining ) ) {
                                            $counts_users=1;
                                            ?>


                                    <table id="cme_registration_remaining_export" class="display" style="width: 100%; display:none;">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>User ID</th>
                                                <th>Full Name</th>
                                                <th>Email</th>
                                                <th>Role</th>
                                                <th>First Year</th>
                                                <th>CME DUE</th>
                                                <th>CDQ DUE</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach( $get_results_remaining as $item ) {
                                                if( isset($item[0]) ) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $counts_users; ?></td>
                                                    <td><?php echo $item[0]['user_id']; ?></td>
                                                    <td><?php echo $item[0]['full_name']; ?></td>
                                                    <td><?php echo $item[0]['email']; ?></td>
                                                    <td><?php echo $item[0]['role'] ?></td>
                                                    <td><?php echo $item[0]['first_year'] ?></td>
                                                    <td><?php echo $item[0]['cme_due']; ?></td>
                                                    <td><?php echo $item[0]['cdq_due'] ?></td>
                                                </tr>
                                            <?php
                                                $counts_users++;
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>

                                    <?php } ?>
                                    <script>

                                        if( $('#cme_registration_remaining_export') != undefined )
                                        {
                                            $('#cme_registration_remaining_export').DataTable({
                                                dom: 'Bfrtip',
                                                buttons: [
                                                    {
                                                        extend: 'excelHtml5',
                                                        title: 'CME Registration Remaining 2018-2019'
                                                    }
                                                ],
                                                paging: false,
                                                searching: false
                                            });
                                        }

                                        function cme_registration_remaining_export()
                                        {
                                            $('#cme_registration_remaining_export_wrapper .dt-button.buttons-excel.buttons-html5').click();
                                        }

                                    </script>






                                    <li class="gap20"></li>
                                    <li>Cycle (2019-2021) <span class="amount"> <?php echo $dashboard_data->expected_students_count_new('CME', (date('Y') + 1));?></span></li>
                                    <!-- <li>Total CME Due <?php echo (date('Y') + 1);?> <span class="amount"><?php echo $dashboard_data->expected_students_count('CME', (date('Y') + 1));?></span></li> -->
                                    <!-- <li>Total Registered <span class="amount"><?php echo $dashboard_data->get_registered_student('CME', (date('Y') + 1),'0');?></span></li> -->
                                    <li>Total Started <?php echo (date('Y') + 1);?><span class="amount"><?php echo $dashboard_data->expected_students_count_cme('CME', (date('Y')+1));?></span></li>
                                    <li>Total Paid<span class="amount"><?php echo $dashboard_data->get_registered_student('CME', (date('Y')+1),'0');?></span></li>
                                    <!-- <li>Remaining <span class="amount"><?php echo ($dashboard_data->expected_students_count('CME', (date('Y') + 1)) - $dashboard_data->get_registered_student('CME', (date('Y') + 1),'0'));?></span></li> -->
                                    <li>Remaining <span class="amount" style="cursor: pointer" onclick="javascript:cme_registration_remaining_export1()"><?php echo number_format(($dashboard_data->expected_students_count_new_number_format('CME', (date('Y') + 1)) - $dashboard_data->get_registered_student_number_format('CME', (date('Y') + 1),'0')));?></span></li>


                                    <style>
                                    #cme_registration_remaining_export1_wrapper .dt-button.buttons-excel.buttons-html5{
                                        display: none;
                                    }
                                    </style>
                                    <?php
                                        $get_results_remaining1 = $dashboard_data->expected_students_for_export('CME', (date('Y') + 1), 'CME', (date('Y') + 1), '0');
                                        if( !empty( $get_results_remaining1 ) ) {
                                            $counts_users1=1;
                                            ?>


                                    <table id="cme_registration_remaining_export1" class="display" style="width: 100%; display:none;">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>User ID</th>
                                                <th>Full Name</th>
                                                <th>Email</th>
                                                <th>Role</th>
                                                <th>First Year</th>
                                                <th>CME DUE</th>
                                                <th>CDQ DUE</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach( $get_results_remaining1 as $item ) {
                                                if( isset($item[0]) ) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $counts_users1; ?></td>
                                                    <td><?php echo $item[0]['user_id']; ?></td>
                                                    <td><?php echo $item[0]['full_name']; ?></td>
                                                    <td><?php echo $item[0]['email']; ?></td>
                                                    <td><?php echo $item[0]['role']; ?></td>
                                                    <td><?php echo $item[0]['first_year']; ?></td>
                                                    <td><?php echo $item[0]['cme_due']; ?></td>
                                                    <td><?php echo $item[0]['cdq_due']; ?></td>
                                                </tr>
                                            <?php
                                                $counts_users1++;
                                                }
                                        } ?>
                                        </tbody>
                                    </table>

                                    <?php } ?>
                                    <script>

                                        if( $('#cme_registration_remaining_export1') != undefined )
                                        {
                                            $('#cme_registration_remaining_export1').DataTable({
                                                dom: 'Bfrtip',
                                                buttons: [
                                                    {
                                                        extend: 'excelHtml5',
                                                        title: 'CME Registration Remaining 2019-2020'
                                                    }
                                                ],
                                                paging: false,
                                                searching: false
                                            });
                                        }

                                        function cme_registration_remaining_export1()
                                        {
                                            $('#cme_registration_remaining_export1_wrapper .dt-button.buttons-excel.buttons-html5').click();
                                        }

                                    </script>





                                    <li class="gap20"></li>
                                    <li>Cycle (2020-2022) <span class="amount"> <?php echo $dashboard_data->expected_students_count_new('CME', (date('Y') + 2));?></span></li>
                                    <!-- <li>Total CME Due <?php echo (date('Y') + 1);?> <span class="amount"><?php echo $dashboard_data->expected_students_count('CME', (date('Y') + 2));?></span></li> -->
                                    <!-- <li>Total Registered <span class="amount"><?php echo $dashboard_data->get_registered_student('CME', (date('Y') + 2),'0');?></span></li> -->
                                    <li>Total Started <?php echo (date('Y') + 1);?><span class="amount"><?php echo $dashboard_data->expected_students_count_cme('CME', (date('Y')+2));?></span></li>
                                    <li>Total Paid<span class="amount"><?php echo $dashboard_data->get_registered_student('CME', (date('Y')+2),'0');?></span></li>
                                    <!-- <li>Remaining <span class="amount"><?php echo ($dashboard_data->expected_students_count('CME', (date('Y') + 2)) - $dashboard_data->get_registered_student('CME', (date('Y') + 2),'0'));?></span></li> -->
                                    <li>Remaining <span class="amount" style="cursor: pointer" onclick="javascript:cme_registration_remaining_export2()"><?php echo number_format(($dashboard_data->expected_students_count_new_number_format('CME', (date('Y') + 2)) - $dashboard_data->get_registered_student_number_format('CME', (date('Y') + 2),'0')));?></span></li>


                                    <style>
                                    #cme_registration_remaining_export2_wrapper .dt-button.buttons-excel.buttons-html5{
                                        display: none;
                                    }
                                    </style>
                                    <?php
                                        $get_results_remaining2 = $dashboard_data->expected_students_for_export('CME', (date('Y') + 2), 'CME', (date('Y') + 2), '0');
                                        if( !empty( $get_results_remaining2 ) ) {
                                            $counts_users2=1;
                                            ?>


                                    <table id="cme_registration_remaining_export2" class="display" style="width: 100%; display:none;">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>User ID</th>
                                                <th>Full Name</th>
                                                <th>Email</th>
                                                <th>Role</th>
                                                <th>First Year</th>
                                                <th>CME DUE</th>
                                                <th>CDQ DUE</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach( $get_results_remaining2 as $item ) {
                                                if( isset($item[0]) ) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $counts_users2; ?></td>
                                                    <td><?php echo $item[0]['user_id']; ?></td>
                                                    <td><?php echo $item[0]['full_name']; ?></td>
                                                    <td><?php echo $item[0]['email']; ?></td>
                                                    <td><?php echo $item[0]['role'] ?></td>
                                                    <td><?php echo $item[0]['first_year'] ?></td>
                                                    <td><?php echo $item[0]['cme_due']; ?></td>
                                                    <td><?php echo $item[0]['cdq_due'] ?></td>
                                                </tr>
                                            <?php
                                            $counts_users2++;
                                                }
                                        } ?>
                                        </tbody>
                                    </table>

                                    <?php } ?>
                                    <script>

                                        if( $('#cme_registration_remaining_export2') != undefined )
                                        {
                                            $('#cme_registration_remaining_export2').DataTable({
                                                dom: 'Bfrtip',
                                                buttons: [
                                                    {
                                                        extend: 'excelHtml5',
                                                        title: 'CME Registration Remaining 2020-2022'
                                                    }
                                                ],
                                                paging: false,
                                                searching: false
                                            });
                                        }

                                        function cme_registration_remaining_export2()
                                        {
                                            $('#cme_registration_remaining_export2_wrapper .dt-button.buttons-excel.buttons-html5').click();
                                        }

                                    </script>








                                    <li class="gap20"></li>
                                    <li>Export 2020</li>
                                    <li>Export 2021</li>
                                    <li>June 2020 CME</li>
                                    <li>June 2020 Not Paid</li>
                                    <li>June 2020 Paid</li>
                                    <li>June 2021 Not Paid</li>
                                    <li>June 2021 Paid</li>
                                    <li class="clix"><b>            </b><a href="#">                </a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-3" style="padding-left:15px;">
                            <div class="adminCard member2">
                                <h3>Members</h3>
                                <ul>
                                    <li>Total CAAs<span class="amount"><?php echo number_format($dashboard_data->get_totalCAAs());?></span></li>
                                    <li>Decertified <span class="amount"><?php echo $dashboard_data->get_decertifiedCAAs();?></span></li>
                                    <li>Retired <span class="amount"><?php echo $dashboard_data->get_decertifiedCAAs();?></span></li>
                                     <li class="gap20"></li>
                                    <li>Women <span class="percent"><?php echo $dashboard_data->get_women_persent()."%";?></span></li>
                                    <li>Men <span class="percent"><?php echo $dashboard_data->get_men_persent()."%";?></span></li>
                                    <li class="gap20"></li>
                                    <li>Total students <span class="amount"><?php echo $dashboard_data->get_total_student();?></span>
                                        <ul>
                                            <li>Class of <?php echo date('Y');?> <span class="amount"><?php echo $dashboard_data->get_student_classOf(date('Y'));?></span></li>



                                            <li>Class of <?php echo (date('Y') + 1);?> <span class="amount"><?php echo $dashboard_data->get_student_classOf((date('Y') + 1));?></span></li>



                                            <li>Class of <?php echo (date('Y') + 2);?> <span class="amount"><?php echo $dashboard_data->get_student_classOf((date('Y')) + 2);?></span></li>



                                        </ul>



                                    </li>



                                </ul>


                            </div>


                        </div>


                        <div class="col-lg-3">


                            <div class="adminCard Eregistration2">


                                <h3>Income</h3>


                                <ul>


                                    <li>YTD Income <span class="amount">$<?php echo $dashboard_data->total_count_type('All', 'Year');?></span></li>


                                    <li>QTD Income <span class="amount">$<?php echo $dashboard_data->total_count_type('All', 'Quarter');?></span></li></span></li>


                                    <li>MTD Income <span class="amount">$<?php echo $dashboard_data->total_count_type('All', 'Month');?></span></li></span></li>


                                    <li class="gap20"></li>


                                    <li><b><?php echo date('Y');?> Income-to-Date</b></li>


                                    <li>ITE<span class="amount">$<?php echo $dashboard_data->total_count_type('ITE', 'Year');?></span></li>


                                    <li>Cert <span class="amount">$<?php echo $dashboard_data->total_count_type('Certification', 'Year');?></span></li>


                                    <li>CDQ<span class="amount">$<?php echo $dashboard_data->total_count_type('CDQ', 'Year');?></span></li>


                                    <li>CME<span class="amount">$<?php echo $dashboard_data->total_count_type('CME', 'Year');?></span></li>


                                    <li>Interest <span class="amount">$<?php echo $dashboard_data->total_count_type('Interest', 'Year');?></span></li>


                                    <li>Other<span class="amount">$<?php echo $dashboard_data->total_count_type('Other', 'Year');?></span></li>


                                    <li class="gap20"></li>


                                    <li>Ledger Balance<span class="amount">$<?php echo $dashboard_data->total_count_type('All', 'Year');?></span></li>


                                    <li class="gap20"></li>


                                    <li class="clix"><b>Forecast </b><a href="#"> Click Here</a></li>


                                </ul>


                            </div>


                        </div>


                        <div class="col-lg-3">


                            <div class="adminCard Cregistration2">


                                <h3>Expenses</h3>


                                <ul>


                                    <li>YTD Expenses <span class="amount">$<?php echo $dashboard_data->total_count_type('Admin', 'Year');?></span></li>


                                    <li>QTD Expenses <span class="amount">$<?php echo $dashboard_data->total_count_type('Admin', 'Quarter');?></span></li>


                                    <li>MTD Expenses <span class="amount">$<?php echo $dashboard_data->total_count_type('Admin', 'Month');?></span></li>


                                    <li class="gap20"></li>


                                    <li><b><?php echo date('Y');?> Income-to-Date</b></li>


                                    <li>Contractor<span class="amount">$<?php echo $dashboard_data->total_count_type_new('Contractor Expense', 'Year');?></span></li>


                                    <li>Merchant<span class="amount">$<?php echo $dashboard_data->total_count_type_new('Merchant Expenses', 'Year');?></span></li>


                                    <li>NBME (Exam)<span class="amount">$<?php echo $dashboard_data->total_count_type_new('NBME(Exam Administration)', 'Year');?></span></li>


                                    <li>Office Expense<span class="amount">$<?php echo $dashboard_data->total_count_type_new('Office Expenses', 'Year');?></span></li>


                                    <li>Mngt. & Admin.<span class="amount">$<?php echo $dashboard_data->total_count_type_new('Management & Administration', 'Year');?></span></li>


                                    <li>Insurance<span class="amount">$<?php echo $dashboard_data->total_count_type_new('Insurance', 'Year');?></span></li>


                                    <li>Taxes & Title<span class="amount">$<?php echo $dashboard_data->total_count_type_new('Taxes & Titles', 'Year');?></span></li>



                                    <li>Test Committee<span class="amount">$<?php echo $dashboard_data->total_count_type_new('Test Committee Expense', 'Year');?></span></li>


                                    <li>Board of Director<span class="amount">$<?php echo $dashboard_data->total_count_type_new('Board of Director Expenses', 'Year');?></span></li>


                                    <li>Accreditation<span class="amount">$<?php echo $dashboard_data->total_count_type_new('Accreditation', 'Year');?></span></li>



                                    <li class="gap20"></li>


                                    <li><b>MTD Income</b><span class="amount">$<?php echo $dashboard_data->total_count_type('All', 'Month');?></span></li>


                                    <li><b>MTD Expenses</b><span class="amount">$<?php echo $dashboard_data->total_count_type('Admin', 'Month');?></span></li>


                                    <li class="gap20"></li>


                                    <li class="clix"><b>Forecast </b><a href="#"> Click Here</a></li>


                                </ul>


                            </div>


                        </div>


                        <div class="col-lg-3" style="padding-left:0px;">


                            <div class="adminCard financials2">


                                <h3>Forecasting</h3>


                                <ul>


                                    <li><b><?php echo date('Y');?></b></li>


                                    <li>ITE Due<span class="amount">$0</span></li>


                                    <li>Cert Due<span class="amount">$<?php echo number_format((doubleval(str_replace(",","",$dashboard_data->expected_students_count_new('Cert', date('Y')))) * 1327.5));?></span></li>


                                    <li>CDQ Due<span class="amount">$<?php echo number_format((doubleval(str_replace(",","",$dashboard_data->expected_students_count_new('CDQ', date('Y')))) * 1000));?></span></li>



                                    <li>CME Due<span class="amount">$<?php echo number_format((doubleval(str_replace(",","",$dashboard_data->expected_students_count_new('CME', date('Y')))) * 235));?></span></li>
                                    <br>
                                    <li>Grand Total<span class="amount">$<?php echo number_format(((doubleval(str_replace(",","",$dashboard_data->expected_students_count_new('Cert', date('Y')))) * 1327.5) + (doubleval(str_replace(",","",$dashboard_data->expected_students_count_new('CDQ', date('Y')))) * 1000) + (doubleval(str_replace(",","",$dashboard_data->expected_students_count_new('CME', date('Y')))) * 235)));?></span></li>

                                    <li class="gap20"></li>


                                    <li><b><?php echo (date('Y') + 1);?></b></li>


                                    <li>ITE Due<span class="amount">$0</span></li>
                                    <li>Cert Due<span class="amount">$<?php echo number_format((doubleval(str_replace(",","",$dashboard_data->expected_students_count_new('Cert', (date('Y') + 1)))) * 1327.5));?></span></li>
                                    <li>CDQ Due<span class="amount">$<?php echo number_format((doubleval(str_replace(",","",$dashboard_data->expected_students_count_new('CDQ', (date('Y') + 1)))) * 1000));?></span></li>
                                    <li>CME Due<span class="amount">$<?php echo number_format((doubleval(str_replace(",","",$dashboard_data->expected_students_count_new('CME', (date('Y') + 1)))) * 235));?></span></li>
                                    <br>
                                    <li>Grand Total<span class="amount">$<?php echo number_format(((doubleval(str_replace(",","",$dashboard_data->expected_students_count_new('Cert', (date('Y') + 1)))) * 1327.5) + (doubleval(str_replace(",","",$dashboard_data->expected_students_count_new('CDQ', (date('Y') + 1)))) * 1000) + (doubleval(str_replace(",","",$dashboard_data->expected_students_count_new('CME', (date('Y') + 1)))) * 235)));?></span></li>
                                    <li class="gap20"></li>
                                    <li class="clix"><b>Forecast </b><a href="#"> Click Here</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                    include("content/admin_demographics.php");
                ?>
