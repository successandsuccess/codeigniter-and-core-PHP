<?php

if(empty($_SESSION['admin_id']) || $_SESSION['admin_id'] == "")
{
	header('Location: /logincaamember.php');
}

$result = $employers->readAllEmployers();
	
require_once("admin_dashboard.php");
?>

<div class="member-card card">

    <h3>Help Center</h3>

    <div class="form-group">


        <div class="clearfix"></div>

    </div>
	
    <table id="viewAllHelpTbl" class="table table-striped table-bordered nowrap" style="width:100%;">

        <thead>
          <tr>
            <th style="text-align: center; width:5%">#</th>
            <th style="text-align: center; width:11%">Tab</th>
            <th style="text-align: center; width:84%">What can I do on each Tab?</th>
          </tr>
        </thead>
        
		<tbody>
		
        <tr>
            <td>1</td>
            <td>Dashboard</td>
            <td>You can see total Incomes and Expenses (YTD, QTD, MTD) on Dashboard.</td>
        </tr>
		
        <tr>
            <td>2</td>
            <td>Members</td>
            <td>
				<p>1.	All Names (first and last) link automatically to the Member’s Account without having to login each time.</p>
				<p>2.	Sorting – each column can be sorted.</p>
				<p>3.	SEARCH a user out of 3,000+</p>
				<p>4.	Default is 50 names displayed on the page, admin can select 100, 200, and 500.</p>
				<p>5.	Page forward and page back bottom right page just like Visitors page.</p>
				<p>6.	All emails are linkable to open admin email program.</p>
				<p>7.	When admin selects user, a new tab will open instead of changing page because admin needs the ability to come back to the members admin page.</p>
				<p>8.	A, B, C, D thru Z shows only those members.</p>
				<p>9.   Drop down (only show Board; Only show Students; Only show CAA etc.</p> 
				<p>10.  Show only CAAs by State.</p>
				<p>11.  Show only _______</p>
				<p>12.  You can see (edit and add) the information of the members you want.</p>
			</td>
        </tr>
		
        <tr>
            <td>3</td>
            <td>Programs</td>
            <td>
			<p>1.	All Universities link automatically to the Program Director Portal without having to login each time.</p>
			<p>2.	Sorting – each column can be sorted.</p>
			</td>
        </tr>
		
        <tr>
            <td>4</td>
            <td>Employers</td>
            <td>You can search the employers you want.</td>
        </tr>
		
        <tr>
            <td>5</td>
            <td>CME Audit</td>
            <td>You can check if each members paid for CME and if each members add the 40 credits.</td>
        </tr>
		
        <tr>
            <td>6</td>
            <td>Exams</td>
            <td>You can decide for CDQ Exam and Certification Exam of the members.</td>
        </tr>
		
        <tr>
            <td>7</td>
            <td>Financials</td>
            <td>You can see (print and add) all FINANCIAL GENERAL LEDGER.</td>
        </tr>
		
        <tr>
            <td>8</td>
            <td>Email</td>
            <td>You can send (receive, edit, delete, add, make of a group) the email to every members(or group).</td>
        </tr>
		
        <tr>
            <td>9</td>
            <td>Blog</td>
            <td>You can publish (add, edit, delete) all blogs.</td>
        </tr>
		
        <tr>
            <td>10</td>
            <td>Surveys</td>
            <td></td>
        </tr>
		
        <tr>
            <td>11</td>
            <td>Visitors</td>
            <td></td>
        </tr>
		
        <tr>
            <td>12</td>
            <td>Settings</td>
            <td>You can edit (replace, change, add) all element (i.e., popup text, links, logo, phone number etc...).</td>
        </tr>
		
        </tbody>
    </table>

</div>