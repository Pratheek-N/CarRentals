<?php
require ('fpdf/fpdf.php');
require ('config.php');
$id = $_GET["order_id"];
$sql="SELECT * FROM  cars, rentedcars WHERE rentedcars.order_id=$id and cars.id=rentedcars.car_id";
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
    $this->Cell(190,25,'BILL',0,0,'C');
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
    if($id==$row['order_id']){
$pdf = new PDF('p','mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('arial','B',14);
$pdf->Cell(60,15,'Order Id',1,0,'C');
$pdf->SetFont('arial','',12);
$pdf->Cell(130,15,$id,1,1,'C');
$pdf->SetFont('arial','B',14);
$pdf->Cell(60,15,'Name',1,0,'C');
$pdf->SetFont('arial','',12);
$pdf->Cell(130,15,$row['customer_username'],1,1,'C');
$pdf->SetFont('arial','B',14);
$pdf->Cell(60,15,'Car Name',1,0,'C');
$pdf->SetFont('arial','',12);
$pdf->Cell(130,15,$row['car_name'],1,1,'C');
$pdf->SetFont('arial','B',14);
$pdf->Cell(60,15,'Brand',1,0,'C');
$pdf->SetFont('arial','',12);
$pdf->Cell(130,15,$row['brand_id'],1,1,'C');
$pdf->SetFont('arial','B',14);
$pdf->Cell(60,15,'Nameplate',1,0,'C');
$pdf->SetFont('arial','',12);
$pdf->Cell(130,15,$row['car_nameplate'],1,1,'C');
$pdf->SetFont('arial','B',14);
$pdf->Cell(60,15,'Booking Date',1,0,'C');
$pdf->SetFont('arial','',12);
$pdf->Cell(130,15,$row['booking_date'],1,1,'C');
$pdf->SetFont('arial','B',14);
$pdf->Cell(60,15,'Rent Start Date',1,0,'C');
$pdf->SetFont('arial','',12);
$pdf->Cell(130,15,$row['rent_start_date'],1,1,'C');
$pdf->SetFont('arial','B',14);
$pdf->Cell(60,15,'Rent End Date',1,0,'C');
$pdf->SetFont('arial','',12);
$pdf->Cell(130,15,$row['rent_end_date'],1,1,'C');
$pdf->SetFont('arial','B',14);
$pdf->Cell(60,15,'Fare',1,0,'C');
$pdf->SetFont('arial','',12);
$pdf->Cell(130,15,'Rs.'.$row['fare'].'/'.$row['charge_type'],1,1,'C');
$pdf->SetFont('arial','B',14);
$pdf->Cell(60,15,'Returned Date',1,0,'C');
$pdf->SetFont('arial','',12);
$pdf->Cell(130,15,$row['car_return_date'],1,1,'C');
$pdf->SetFont('arial','B',14);
$pdf->Cell(60,15,'Number Of Days',1,0,'C');
$pdf->SetFont('arial','',12);
$pdf->Cell(130,15,$row['no_of_days'],1,1,'C');
$pdf->SetFont('arial','B',14);
$pdf->Cell(60,15,'Distance(km)',1,0,'C');
$pdf->SetFont('arial','',12);
$pdf->Cell(130,15,$row['distance'],1,1,'C');
$pdf->SetFont('arial','B',14);
$pdf->Cell(60,15,'Total Amount',1,0,'C');
$pdf->SetFont('arial','',12);
$pdf->Cell(130,15,'Rs.'.$row['total_amount'].'/-',1,1,'C');
    }
}


$pdf->Output();


?>