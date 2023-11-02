
<?php   

    include('server.php');
    session_start();

    require_once 'dompdf/autoload.inc.php';


    use Dompdf\Dompdf;
    extract($_POST);


    if (isset($sub_pdf)) {
        $user_id = mysqli_real_escape_string($conn, $_SESSION['user_name']);
        $id_num_sc = $_SESSION['id_num_sc'] ;

        $select = "select firstn_lastn from users_dispense where id_num = '$id_num_sc'";
        $result2 = mysqli_query($conn,$select);

        if (mysqli_num_rows($result2) > 0) {
            $row = mysqli_fetch_array($result2);
            $_SESSION['firstn_lastn'] = $row['firstn_lastn'];
        }

        if (isset($id_num_sc)) {
        $query = "select * from users_dispense where concat (id_num,firstn_lastn,ph_name,
                                                             num_pills,org_name,ex_date)
                                               like '%$id_num_sc%' order by ex_date DESC";

        $query_run = mysqli_query($conn,$query);

        }

        $html = '';
        $html .= '
        <html>
           <head>
              <meta http-equiv="Content-Language" content="th">
              <meta http-equiv="content-Type" content="text/html; charset=window-874">
              <meta http-equiv="content-Type" content="text/html; charset=tis-620">
        
           </head>
           <body>
            <h2 align="center">Data Dispense Phamacy</h2>
            <table style="width:100%; border-collapse:collapse;">
                <tr>
                   <th colspan="4" font-size: 30px; style="border:1px solid #ddd; padding: 8px; text-align:center;">
                   '.$_SESSION['firstn_lastn'].'</th>
                </tr>
                <tr>     
                   <th style="border:1px solid #ddd; padding: 8px; text-align:center;">Pharmacy name</th>
                   <th style="border:1px solid #ddd; padding: 8px; text-align:center;">Count pills</th>
                   <th style="border:1px solid #ddd; padding: 8px; text-align:center;">Orgarnize</th>
                   <th style="border:1px solid #ddd; padding: 8px; text-align:center;">Date</th>
                </tr>
        ';

        if (mysqli_num_rows($query_run) > 0) {
            foreach($query_run as $item) {
                $html .= '
                <tr>
                   <td style="border:1px solid #ddd; padding: 8px; text-align:center;">'.$item['ph_name'].'</td>
                   <td style="border:1px solid #ddd; padding: 8px; text-align:center;">'.$item['num_pills'].'</td>
                   <td style="border:1px solid #ddd; padding: 8px; text-align:center;">'.$item['org_name'].'</td>
                   <td style="border:1px solid #ddd; padding: 8px; text-align:center;">'.$item['ex_date'].'</td>
                </tr>
                ';
            }
        } else {
            $html .= '
                <tr>
                   <td colspan="4" style="border:1px solid #ddd; padding: 8px; text-align:left;">No data record</td>
                </tr>
            ';
        }

        $html .= '</table>
            </body>
        </html>';
        
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper("A4", "portrait");
        $dompdf->render();
        $dompdf->stream("report.pdf");

    }

?>
