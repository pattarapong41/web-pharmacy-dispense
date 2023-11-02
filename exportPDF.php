<?php 

    session_start();
    include('server.php');
    require('fpdf.php');
    

    $pdf=new FPDF();
    $pdf->AddPage();
    $pdf->AddFont('angsa','','angsa.php');
    $pdf->AddFont('angsa','B','angsa.php');
    extract($_POST);
    
    //$pdf->Image('images/SUTHLOGO-01.png',10,10,0);
    $pdf->SetFont('angsa','B',20);
    $pdf->cell(0,10,iconv('UTF-8','cp874','ข้อมูลประวัติการจ่ายยา'),0,1,'C');
    $pdf->SetY(26);

    if (isset($sub_pdf)) {
        $ph_id = mysqli_real_escape_string($conn, $_SESSION['ph_id']);
       if (isset($ph_id)) {
           $query = "SELECT * FROM 'users_dispense' WHERE CONCAT(ph_id,first_name,last_name,
                                                             ph_name,org_name,ex_date)
                                                LIKE '%$ph_id%' ORDER BY ex_date";

           $query_run = mysqli_query($conn,$query);
          // $re_dispense = mysqli_fetch_assoc($query_run);

           
       
           //$pdf->Cell(40,10,iconv('UTF-8','cp874',$re_dispense['ph_id']),1,0,'C');
          // $pdf->Cell(30,10,iconv('UTF-8','cp874',$re_dispense['first_name']),1,0,'C');
          // $pdf->Cell(30,10,iconv('UTF-8','cp874',$re_dispense['last_name']),1,0,'C');
          // $pdf->Cell(40,10,iconv('UTF-8','cp874',$re_dispense['ph_name']),1,0,'C');
          // $pdf->Cell(30,10,iconv('UTF-8','cp874',$re_dispense['org_name']),1,0,'C');
          // $pdf->Cell(20,10,iconv('UTF-8','cp874',$re_dispense['ex_date']),1,0,'C');

        }
    }

    $pdf->Cell(40,10,'License number',1,0,'C');
    $pdf->Cell(30,10,'Firstname',1,0,'C');
    $pdf->Cell(30,10,'Lastname',1,0,'C');
    $pdf->Cell(40,10,'Phamarcy name',1,0,'C');
    $pdf->Cell(30,10,'Orgarnize',1,0,'C');
    $pdf->Cell(20,10,'Date',1,1,'C');

    if (mysqli_num_rows($query_run) > 0) {
        foreach($query_run as $item) {
           $pdf->Cell(40,10,iconv('UTF-8','cp874',$item['ph_id']),1,0,'C');
           $pdf->Cell(30,10,iconv('UTF-8','cp874',$item['first_name']),1,0,'C');
           $pdf->Cell(30,10,iconv('UTF-8','cp874',$item['last_name']),1,0,'C');
           $pdf->Cell(40,10,iconv('UTF-8','cp874',$item['ph_name']),1,0,'C');
           $pdf->Cell(30,10,iconv('UTF-8','cp874',$item['org_name']),1,0,'C');
           $pdf->Cell(20,10,iconv('UTF-8','cp874',$item['ex_date']),1,0,'C');
        }
    }


    $pdf->Output();

?>