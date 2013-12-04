
<?php
App::import('Vendor','tcpdf/tcpdf');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false); 

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Ross Moroney');
$pdf->SetTitle('Member Report');
$pdf->SetSubject('Member Report');
$pdf->SetKeywords('TCPDF, CakePHP, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH,"Report for: " . $members[0]['Member']['FName']. " " . $members[0]['Member']['LName'], 'By chair of the church');

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
// --------------------------------Table For a Report-------------------------------------
$tbl .= <<<EOD
<table cellspacing="0" cellpadding="15" border="1">
    <tr>
        <th style="text-align:center;font-size:large"><b>Contact info</b></th>
		<th style="text-align:center;font-size:large"><b>God's Gifts</b></th>
		<th style="text-align:center;font-size:large"><b>Computer Skills</b></th>
		<th style="text-align:center;font-size:large"><b>Other</b></th>
    </tr>
    <tr>
	<td>
EOD;
$tbl .= "<b>" . $members[0]['Member']['FName'] . " " . $members[0]['Member']['LName'] . " ";
$tbl .= $members[0]['Status']['Type'] . "</b> <br/>";
$tbl .= 'home phone:' . ' <b>' . $members[0]['Member']['HomePhone'] . '</b><br/>';
$tbl .= "cell phone:" .  ' <b>'  . $members[0]['Member']['CellPhone'] . "</b><br/>";
$tbl .= "work phone:" . ' <b>' . $members[0]['Member']['WorkPhone'] . " </b><br/>";
$tbl .= "email:" . " <b>" . $members[0]['Member']['Email'] . "</b></td>";

	$tbl .= '<td style="text-align:left">';
	foreach ($choices as $choice)
	{
		
		if($choice['Choice']['SectionID'] == 1)
		{
			$tbl .=  '<span>' . $choice['Choice']['Text'] . '</span><br />';
		}
	}
	$tbl .= "</td>";
	$tbl .= "<td>";
	foreach ($choices as $choice)
	{
		if($choice['Choice']['SectionID'] == 2)
		{
			$tbl .=  $choice['Choice']['Text'] . "<br />";
		}
	}
	$tbl .= "</td>";
	$tbl .= "<td>";
	foreach ($choices as $choice)
	{
		if($choice['Choice']['SectionID'] != 1 && $choice['Choice']['SectionID'] != 2)
		{
			$tbl .=  $choice['Choice']['Text'] . "<br />";
		}
	}
	$tbl .= "</td>";



$tbl .= <<<EOD

    </tr>

</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');
//Close and output PDF document
$pdf->Output( $members[0]['Member']['LName']."_id". $members[0]['Member']['MemberID'].'.pdf', 'I');
?> 
