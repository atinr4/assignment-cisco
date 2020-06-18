<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Assignment @yield('title')</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link href="https://www.jqueryscript.net/demo/Simple-JSON-Beautifier-With-jQuery-CSS-CSS3-Beautify-json/beautify-json.css">
        <style>
            #myTable_wrapper{
                width: 100% !important;
            }
            #myTable_filter{
                display:none;
            }
            .error{
                 color: #d01818;
                 font-size: 13px;
            }
        </style>
    </head>
    <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Assignment</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/">Router Details List </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/draw-shapes">Shapes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/api-showcase">Api Listing</a>
                </li>
            </ul>
        </div>
        </nav>
        <div class="flex-center position-ref full-height">
            <div class="container">
                <div class="row">
                    @yield('content')
                </div>
            </div>
            
        </div>
        <script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
        <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
        <script src="https://www.jqueryscript.net/demo/Simple-JSON-Beautifier-With-jQuery-CSS-CSS3-Beautify-json/jquery.beautify-json.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.js"></script>
        <script>
            $(document).ready( function () {
                var table = $('#myTable').DataTable({
                    "paging":   false,
                    "info":     false,
                    orderCellsTop: true,
                    fixedHeader: true
                });

                $('#myTable thead tr').clone(true).appendTo( '#myTable thead' );
                $('#myTable thead tr:eq(1) th').each( function (i) {
                    var title = $(this).text();
                    if(title != 'Edit/ Delete') {
                        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
                
                        $( 'input', this ).on( 'keyup change', function () {
                            if ( table.column(i).search() !== this.value ) {
                                table
                                    .column(i)
                                    .search( this.value )
                                    .draw();
                            }
                        } );
                    } else {
                        $(this).html('');
                    }
                   
                } );

                $('#search').on( 'keyup', function () {
                    table.search( this.value ).draw();
                } );

                $.validator.addMethod('IP4Checker', function(value) {
                var ip = /^(\d|[1-9]\d|1\d\d|2([0-4]\d|5[0-5]))\.(\d|[1-9]\d|1\d\d|2([0-4]\d|5[0-5]))\.(\d|[1-9]\d|1\d\d|2([0-4]\d|5[0-5]))\.(\d|[1-9]\d|1\d\d|2([0-4]\d|5[0-5]))$/;
                    return value.match(ip);
                }, 'Invalid IP address');

                $.validator.addMethod('MACAddress', function(value) {
                    var mac ="^([0-9A-F]{2}[:-]){5}([0-9A-F]{2})$";
                    return value.match(mac);
                },'Invalid Mac')

                $("#createForm").validate({
                    rules: {
                        sapid: {
                            required: true,
                            maxlength: 18
                        },
                        host_name: {
                            required: true
                        },
                        loop_back: {
                            required: true,
                            IP4Checker: true
                        },
                        mac_address: {
                            required: true,
                            MACAddress: true
                        }
                    },
                    messages: {
                        sapid: {
                            required: "Please provide a SapID",
                            minlength: "Your SapID must be at least 18 characters long"
                        },
                        host_name: "Please enter Hostname",
                        loop_back: {
                            required: "Please enter Valid IP Address"
                        },
                        mac_address: {
                            required: "Please provide a valid MAC address"
                        }
                    }
                });

                $("#editForm").validate({
                    rules: {
                        sapid: {
                            required: true,
                            maxlength: 18
                        },
                        host_name: {
                            required: true
                        },
                        loop_back: {
                            required: true,
                            IP4Checker: true
                        },
                        mac_address: {
                            required: true,
                            MACAddress: true
                        }
                    },
                    messages: {
                        sapid: {
                            required: "Please provide a SapID",
                            minlength: "Your SapID must be at least 18 characters long"
                        },
                        host_name: "Please enter Hostname",
                        loop_back: {
                            required: "Please enter Valid IP Address"
                        },
                        mac_address: {
                            required: "Please provide a valid MAC address"
                        }
                    }
                });
                


                //API Page
                $('#headerDiv').hide();
                $('#api').on('change', function(){
                    if ($(this).val() == "{{URL::to('/api/login')}}") {
                        $('#headerDiv').hide();
                    } else {
                        $('#headerDiv').show();
                    }
                });

                $('#submit').on('click' , function() {
                    var myKeyVals = $('#payload').val();
                    var apiValue = $('#api').val();
                    var access_token = $('#header').val();
                    $.ajax({
                        type: 'POST',
                        url: apiValue,
                        data: myKeyVals,
                        contentType:"application/json; charset=utf-8",
                        headers: {
                            "Authorization":"Bearer " + access_token
                        },
                        success: function(resultData) { 
                            $('#showCode').html(JSON.stringify(resultData, null, 4));
                            
                            $('#showCode').beautifyJSON({
                                type: "strict"
                            });
                        },
                        error: function(xhr, textStatus, errorThrown){
                            $('#showCode').html(JSON.stringify(xhr, null, 4));
                            
                            $('#showCode').beautifyJSON({
                                type: "strict"
                            });
                        }
                    });
                 });

            } );
        </script>

    </body>
</html>
