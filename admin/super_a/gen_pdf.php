<?php
session_start();
function fetch_data($name, $pass, $company)
{

    $output = '';

    $output .= '<tr>  
        <td>' . $company . '</td>  

                          <td>' . $name . '</td>  
                          <td>' . $pass . '</td>  
                        

                          </tr>  
                          ';

    return $output;
}
if (isset($_GET["username"])) {
    require_once('partial/tcpdf/tcpdf.php');
    $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $obj_pdf->SetCreator(PDF_CREATOR);
    $obj_pdf->SetTitle(" Registration Record");
    $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
    $obj_pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $obj_pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    $obj_pdf->SetDefaultMonospacedFont('helvetica');
    $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);
    $obj_pdf->setPrintHeader(false);
    $obj_pdf->setPrintFooter(false);
    $obj_pdf->SetAutoPageBreak(TRUE, 10);
    $obj_pdf->SetFont('helvetica', '', 11);
    $obj_pdf->AddPage();
    $content = '';
    $content .= '  
      <h4 align="center">Login Deatils </h4><br /> 
      <table border="1" cellspacing="0" cellpadding="3">  
           <tr>  
           <th width="30%">Company</th>  
                <th width="30%">Username</th>  
                <th width="30%">Password</th>  
               

                </tr>  
      ';
    $content .= fetch_data($_GET['username'], $_GET['pass'], $_GET['co']);
    $content.="";
    $content .= '</table>';
    $obj_pdf->writeHTML($content);
    $obj_pdf->Output('Login_details.pdf', 'I');
}
