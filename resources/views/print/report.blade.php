<html>
    <head>
        <title>-</title>
        <style>
            #body {
                margin: 0 2rem;
                padding-top: 100px; /* Space for header */
                padding-bottom: 80px; /* Space for footer */
            }

            .details {
                display: flex;
            }

            .details .col-7 {
                width: 80%;
                padding: 10px;
            }

            .details .col-3 {
                width: 30%;
                padding: 10px;
            }

            .details .float-right {
                justify-content: end;
                text-align: right;
            }

            .details .float-left {
                justify-content: start;
                text-align: left;
            }

            .details p {
                text-align: left;
                
            }


            header, footer {
                left: 0;
                right: 0;
                background-color: #f1f1f1;
               
            }

            header {
                top: 0;
                border-bottom: 2px solid #952323;
                display: grid;
                grid-template-columns: 1fr auto 1fr;
                align-items: center;
                padding: 10px;
            }

            header > div {
                display: flex;
                justify-content: center;
                align-items: center;
            }

            header > div:nth-child(2) {
                flex-direction: column;
                text-align: center;
            }

            header p {
              margin: 5px 0;
            }

            header img {
                width: 100px; /* Set the desired width */
                height: 100px; /* Set the desired height */
                object-fit: cover; /* Ensure the image maintains aspect ratio and covers the specified dimensions */
            }

            footer {
                bottom: 0;
                /* border-top: 2px solid #ccc; */
                border-top: 2px solid #952323;
                display: flex;
                justify-content: space-between;
                align-items: center;
                columns: 6;
                margin-top: 2rem;
            }

            footer p {
              margin: 5px 0;
            }

            .content {
                text-align: center; /* Center text within the main content */
            }

            .content .title {
                margin: 2rem 0 1rem 0 ;
            }

            .content .desc {
                margin: 5px 0;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }

            .table-1 td, .table-1 th {
                border: 1px solid #000;
                padding: 8px;
                text-align: left;
            }

            .table-1 th {
                background-color: #f2f2f2;
                text-align: center;
            }

            @page {
                size: legal;
                margin: 1cm .5in;
            }

            @media print {
                table.paging thead td, table.paging tfoot td {
                    height: .5in;
                }
            }

            /* header, footer {
                width: 100%; height: 1in;
            } */

            /* header {
                position: absolute;
                top: 0;
               
            } */

            @media print {
                @page {
                    margin: 1cm .8in;
                }

                .details {
                    display: flex;
                }

                .details .col-7 {
                    width: 70%;
                    padding: 10px;
                }

                .details .col-3 {
                    width: 30%;
                    padding: 10px;
                }

                .details .float-right {
                    justify-content: end;
                    text-align: right;
                }

                .details .float-left {
                    justify-content: start;
                    text-align: left;
                }

                .details p {
                    text-align: left;
                    
                }
                
                /* header, footer {
                    position: fixed;
                }
                 */
                footer {
                    /* position: fixed; */
                    border: none;
                    margin: 0;
                    bottom: 0;
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    columns: 6;
                    padding-top: 10px;
                }

                /* main */
                .content .title {
                    margin: 5px 0 ;
                }

                .content .desc {
                    margin: 5px 0;
                }

                /* table */
                table {
                    width: 100%;
                    border-collapse: collapse;
                }

                .table-1 {
                    margin-bottom: 1cm;
                }

                .table-1 td, .table-1 th {
                    border: 1px solid #000;
                    padding: 8px;
                    text-align: left;
                }

                .table-1 th {
                    background-color: #f2f2f2;
                    text-align: center;
                }

                /* content */
                .content {
                    text-align: center;
                    page-break-before: auto;
                    page-break-after: auto;
                    page-break-inside: avoid;
                    margin-bottom: 8in; /* Space for footer */
                }

                /* table 1*/
                .table-1 {
                    margin-top: 10px;
                }

                /* Additional Styles */
                header {
                    top: 0;
                    border-bottom: 2px solid #952323;
                    display: grid;
                    grid-template-columns: 1fr auto 1fr;
                    align-items: center;
                    padding-bottom: 10px;
                    margin-bottom: 0.5cm;
                }

                header > div {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                }

                header > div:nth-child(2) {
                    flex-direction: column;
                    text-align: center;
                }

                header p {
                margin: 3px 0;
                }

                header img {
                    width: 100px; /* Set the desired width */
                    height: 100px; /* Set the desired height */
                    object-fit: cover; /* Ensure the image maintains aspect ratio and covers the specified dimensions */
                }

                .uppercase {
                    text-transform: uppercase;
                }

                /* footer */

                footer p {
                    margin: 5px 0;
                }
            }
        </style>
    </head>
    <body  #body>
        <!-- <div id="header">(repeated header)</div> -->
            <table class="paging">
                <thead>
                    <tr>
                        <td>
                            <header>
                                <div><img src="/assets/img/pup-logo.png" alt="PUP Logo"></div>
                                <div>
                                    <p>Republic of the Philippines</p>
                                    <p class="uppercase">Polytechnic University of the Philippines</p>
                                    <p>Office of the Vice President for Campuses</p>
                                    <p class="uppercase">BANSUD ORIENTAL MINDORO CAMPUS</p>
                                </div>
                                <div><img src="/assets/img/bagong-pilipinas-logo.png" alt="Bagong Pilipinas Logo"></div>
                            </header>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="content" >
                                <h2 class="title">{{ $title }}</h2>
                                <p class="desc">{{ $description }}</p>

                                <table class="table-1">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Student No</th>
                                            <th>Student Name</th>
                                            <th>Program</th>
                                            <th> Year Level</th>
                                            <th>Remarks</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($tableData) && count($tableData) > 0)
                                            @foreach($tableData as $key => $data)
                                                <tr>
                                                    <td>{{$key+=1}}</td>
                                                    <td>{{$data->user_student->student_number}}</td>
                                                    <td>{{$data->user_student->name}}</td>
                                                    <td>{{$data->program->program_name}}</td>
                                                    <td>{{$data->class_year}}</td>
                                                    <td>{{$data->status}}</td>
                                                    <td>{{$data->formatted_status}}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="7">No records found</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>

                                <div class="row details">
                                    <div class="col-7 ">
                                      
                                    </div>
                                    <div class="col-3 ">
                                        <p>Prepared by:</p>
                                        <p style="margin-bottom:0;padding-bottom:0"><b>JULIE ANNE D. ABEL</b></p>
                                        <p>Admission Officer</p>
                                    </div>
                                </div>
                                <div class="row details">
                                    <div class="col-7">
                                        <p>Noted by:</p>
                                        <p><b>SHEIANN REYNOSO</b></p>
                                        <p>Registrar</p>
                                    </div>
                                    <div class="col-3">
                                        <!-- Empty div for spacing -->
                                    </div>
                                </div>
                                <div class="row details">
                                    <div class="col-7 ">
                                        <p>Attested by:</p>
                                        <p><b>MARIA JOSIEFEL ANN R. MAAPOY</b></p>
                                        <p class="mt-0">Head of Students Services</p>
                                    </div>
                                    <div class="col-3 ">
                                       <!-- Empty div for spacing -->
                                      
                                      </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td>
                            <footer>
                                <!-- <div id="footer-info"> -->
                                <div>
                                <p>Poblacion, Bansud, Oriental, Mindoro</p>
                                <p>Cell phone #: 0910-788-6089/0955-378-6993</p>
                                <p>Website: <a href="www.pup.edu.ph" target="_blank">www.pup.edu.ph</a> E-mail: pup_ou.bansud@yahoo.com</p>
                                <p>THE COUNTRY’S 1st POLYTECHNICU</p>
                                </div>
                                <div><img src="/assets/img/certificate-number.png" alt="Certificate Number"></div>
                                <!-- </div> -->
                            </footer>
                        </td>
                    </tr>
                </tfoot>
            </table>

            
    </body>
</html>