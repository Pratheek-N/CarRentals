<?php
require ('fpdf/fpdf.php');
require ('config.php');
$car_id = $_GET["id"];
$sql="SELECT * FROM  cars, rentedcars WHERE rentedcars.car_id=cars.id";
$data=mysqli_query($conn,$sql);

class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('images/logo.png',10,3,40);
    // Arial bold 15
    $this->SetFont('Arial','B',25);
    // Move to the right
    // $this->Cell(2);
    // Title
    $this->Cell(190,25,'BOOKING DETAILS',0,0,'C');
    // Line break
    $this->Ln(30);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}
while($row=mysqli_fetch_assoc($data)){
    if($car_id==$row['id']){
$pdf = new PDF('p','mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('arial','B',14);
$pdf->Cell(60,20,'Order Id',1,0,'C');
$pdf->SetFont('arial','',12);
$pdf->Cell(130,20,$car_id,1,1,'C');
$pdf->SetFont('arial','B',14);
$pdf->Cell(60,20,'Name',1,0,'C');
$pdf->SetFont('arial','',12);
$pdf->Cell(130,20,$row['customer_username'],1,1,'C');
$pdf->SetFont('arial','B',14);
$pdf->Cell(60,20,'Car Name',1,0,'C');
$pdf->SetFont('arial','',12);
$pdf->Cell(130,20,$row['car_name'],1,1,'C');
$pdf->SetFont('arial','B',14);
$pdf->Cell(60,20,'Brand',1,0,'C');
$pdf->SetFont('arial','',12);
$pdf->Cell(130,20,$row['brand_id'],1,1,'C');
$pdf->SetFont('arial','B',14);
$pdf->Cell(60,20,'Type',1,0,'C');
$pdf->SetFont('arial','',12);
$pdf->Cell(130,20,$row['type_id'],1,1,'C');
$pdf->SetFont('arial','B',14);
$pdf->Cell(60,20,'Nameplate',1,0,'C');
$pdf->SetFont('arial','',12);
$pdf->Cell(130,20,$row['car_nameplate'],1,1,'C');
$pdf->SetFont('arial','B',14);
$pdf->Cell(60,20,'Booking Date',1,0,'C');
$pdf->SetFont('arial','',12);
$pdf->Cell(130,20,$row['booking_date'],1,1,'C');
$pdf->SetFont('arial','B',14);
$pdf->Cell(60,20,'Start Date',1,0,'C');
$pdf->SetFont('arial','',12);
$pdf->Cell(130,20,$row['rent_start_date'],1,1,'C');
$pdf->SetFont('arial','B',14);
$pdf->Cell(60,20,'Return Date',1,0,'C');
$pdf->SetFont('arial','',12);
$pdf->Cell(130,20,$row['rent_end_date'],1,1,'C');
$pdf->SetFont('arial','B',14);
$pdf->Cell(60,20,'Fare',1,0,'C');
$pdf->SetFont('arial','',12);
$pdf->Cell(130,20,'Rs.'.$row['fare'].'/'.$row['charge_type'],1,1,'C');
    }
}


$pdf->Output();


?>