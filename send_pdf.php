
<?php   

    include('server.php');
    session_start();

    require_once __DIR__ . '/vendor/autoload.php';


    $mpdf = new \Mpdf\Mpdf;
    extract($_POST);

    if (isset($sub_pdf)) {
        $ph_id = mysqli_real_escape_string($conn, $_SESSION['ph_id']);
        if (isset($ph_id)) {
        $query = "select * from users_dispense where concat (ph_id,first_name,last_name,
                                                             ph_name,org_name,ex_date)
                                               like '%$ph_id%' order by ex_date";

        $query_run = mysqli_query($conn,$query);

        }

        ob_start();

        $html = '';
        $html .= '
            <h2 align="center">Export to PDF file</h2>
            <table style="width:100%; border-collapse:collapse;">
                <tr>
                   <th style="border:1px solid #ddd; padding: 8px; text-align:left;">License number</th>
                   <th style="border:1px solid #ddd; padding: 8px; text-align:left;">Firstname</th>
                   <th style="border:1px solid #ddd; padding: 8px; text-align:left;">Lastname</th>
                   <th style="border:1px solid #ddd; padding: 8px; text-align:left;">Pharmacy name</th>
                   <th style="border:1px solid #ddd; padding: 8px; text-align:left;">Orgarnize</th>
                   <th style="border:1px solid #ddd; padding: 8px; text-align:left;">Date</th>
                </tr>
        ';

        if (mysqli_num_rows($query_run) > 0) {
            foreach($query_run as $item) {
                $html .= '
                <tr>
                   <td style="border:1px solid #ddd; padding: 8px; text-align:left;">'.$item['ph_id'].'</td>
                   <td style="border:1px solid #ddd; padding: 8px; text-align:left;" class="TH">'.$item['first_name'].'</td>
                   <td style="border:1px solid #ddd; padding: 8px; text-align:left;" class="TH">'.$item['last_name'].'</td>
                   <td style="border:1px solid #ddd; padding: 8px; text-align:left;" class="TH">'.$item['ph_name'].'</td>
                   <td style="border:1px solid #ddd; padding: 8px; text-align:left;" class="TH">'.$item['org_name'].'</td>
                   <td style="border:1px solid #ddd; padding: 8px; text-align:left;">'.$item['ex_date'].'</td>
                </tr>
                ';
            }
        } else {
            $html .= '
                <tr>
                   <td colspan="6" style="border:1px solid #ddd; padding: 8px; text-align:left;">No data record</td>
                </tr>
            ';
        }

        $html .= '</table>';
        $html = ob_get_contents();
        $mpdf->WriteHTML($html);
        $mpdf->setPaper("A4", "portrait");
        //$mpdf->render();
        $mpdf->Output("report.pdf");
        ob_end_flush();

    }

?>
