<?php

require_once '../PHPWord.php';

// New Word Document
$PHPWord = new PHPWord();

// New portrait section
$section = $PHPWord->createSection();

include'db_connection.php';

$section->addText('Admin Log History', array("bold" => true, "size" => 16));

$styleTable = array('borderSize'=>6, 'cellMargin'=>10);
$styleFirstRow = array('borderBottomSize'=>18, 'borderBottomColor'=>'0000FF');

$fontStyle = array('bold'=>true, 'align'=>'center');
$styleTable = array('borderSize'=>6, 'borderColor'=>'006699', 'cellMargin'=>80);

$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
$table = $section->addTable('myOwnTableStyle');
// Add row
$table->addRow(900);
// Add cells
$table->addCell(2000, $styleCell)->addText('User Level', $fontStyle);
$table->addCell(2000, $styleCell)->addText('Name', $fontStyle);
$table->addCell(2000, $styleCell)->addText('Action', $fontStyle);
$table->addCell(2000, $styleCell)->addText('Date & Time', $fontStyle);
// Add more rows / cells

$query = mysqli_query($conn, "select * from tbl_admin_logs order by log_id desc");
while($row = mysqli_fetch_assoc($query)){
	$table->addRow();
	$table->addCell(2000)->addText($row['user_level']);
	$table->addCell(2000)->addText($row['name']);
	$table->addCell(2000)->addText($row['action']);
	$table->addCell(2000)->addText($row['date']);
}

$objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
$filename = "admin_logs.docx";
$objWriter->save($filename);
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename='.$filename);
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Pragma: public');
header('Content-Length: ' . filesize($filename));
flush();
readfile($filename);
unlink($filename); // deletes the temporary file

?>
