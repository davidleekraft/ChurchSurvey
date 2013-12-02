<?php
//die("hi");
App::import('Vendor','tcpdf/tcpdf');
//App::import('Vendor','xtcpdf');  
//$pdf = new XTCPDF(); 

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false); 

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Chair');
$pdf->SetTitle('Skills Report');
$pdf->SetSubject('Skills Report');
$pdf->SetKeywords('TCPDF, Skills, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH,'Skills Report', 'By chair of the church');

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO); 

// set font
$pdf->SetFont('times', '', 9);

// add a page
$pdf->AddPage();
$tbl .= "<div>" .$skills . "</div>";
$pdf->writeHTML($tbl, true, false, false, false, '');
$tbl = '<br pagebreak="true"/>';
// -----------------------------------------------------------------------------
foreach($members as $member)
{
$tbl .= "<h1>Report for: " .  $member['Member']['FName'] . " " . $member['Member']['LName'] . "</h1>";
$tbl .= "<b>" . $member['Status']['Type'] . "</b><br/>";
$tbl .= 'home phone: ' . ($member['Member']['HomePhone'] ? $member['Member']['HomePhone']:"N/A") . '<br/>';
$tbl .= "cell phone: " . ($member['Member']['CellPhone'] ? $member['Member']['CellPhone']:"N/A") . "<br/>";
$tbl .= "work phone: " . ($member['Member']['WorkPhone'] ? $member['Member']['WorkPhone']:"N/A") . "<br/>";
$tbl .= "email: ". ($member['Member']['Email'] ? $member['Member']['Email']:"N/A"). "<br/><br/>";
$tbl .= <<<EOD
<table cellspacing="0" cellpadding="15" border="1">
    <tr>
		<th style="text-align:center;font-size:large"><b>God's Gifts</b></th>
		<th style="text-align:center;font-size:large"><b>Computer Skills</b></th>
		<th style="text-align:center;font-size:large"><b>Other</b></th>
    </tr>
    <tr>
EOD;

	$tbl .= '<td>';
	$counter = 0;
	foreach ($choices as $choice)
	{
		
		if($choice['Choice']['SectionID'] == 1  && $choice['Member']['MemberID'] == $member['Member']['MemberID'])
		{
			
			$tbl .=  '<span>' . $choice['Choice']['Text'] . '</span><br />';
			$counter++;
		}
	}
	if($counter == 0)
		$tbl .=  '<span>N/A</span><br />';
	$tbl .= "</td>";
	$tbl .= '<td>';
	$counter = 0;
	foreach ($choices as $choice)
	{
		if($choice['Choice']['SectionID'] == 2  && $choice['Member']['MemberID'] == $member['Member']['MemberID'])
		{
			$tbl .=  $choice['Choice']['Text'] . "<br />";
			$counter++;
		}
	}
	
	if($counter == 0)
		$tbl .=  '<span style="padding:20px">N/A</span><br />';
	$tbl .= "</td>";
	$tbl .= "<td>";
	$counter = 0;
	foreach ($choices as $choice)
	{
		if($choice['Choice']['SectionID'] != 1 && $choice['Choice']['SectionID'] != 2  && $choice['Member']['MemberID'] == $member['Member']['MemberID'])
		{
				
				$tbl .= $choice['Choice']['Text'] . "<br/>";
				$counter++;
		}
	}
	if($counter == 0)
		$tbl .=  '<span>N/A</span><br />';
	$tbl .= "</td>";



$tbl .= <<<EOD

    </tr>

</table>
EOD;



$pdf->writeHTML($tbl, true, false, false, false, '');
$tbl = '<br pagebreak="true"/>';
}
//Close and output PDF document
$pdf->lastPage();
$pdf->Output( 'skills_report'.'.pdf', 'I');
?> 
