<!DOCTYPE html>
<html lang="en" xml:lang="en"> <!--- language --->
<head>
    <meta charset="utf-8" />
    <title><?php echo $settings['0']['value']; ?>  - Invoice Management</title>
    <link rel="stylesheet" href="/assets/styles/style.css" type="text/css" media="screen" />

    <meta name="Description" content=''/>
    <meta name="Keywords" content=''/>
    <meta name="Author" content=""/>
    <meta name="Robots" content="all, noindex, nofollow"/>
    <meta name="Googlebot" content="all, noindex, nofollow"/>

    <script type="text/javascript" src="/assets/js/jquery.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#add_invoice_form form').submit(function() {
                $.ajax({
                  url: '<?php echo site_url('invoice/create'); ?>',
                  type: "POST",
                  data: ({ 'ajax'      : '1',
                           'subject'   : $('input[name="subject"]').val(),
                           'cost'      : $('input[name="cost"]').val(),
                           'id_client' : $('#client').val()
                        }),
                  success: function(response) {
                                if(response == 'FALSE') {
                                    alert('Can not add new client');
                                } else {
                                    $('#open_invoices_table').html(response).show('slow');
                                }
                           }
                });
                return false;
            });
        });

        function closeInvoice(invoiceId) {
                $.ajax({
                  url: '<?php echo site_url('invoice/close'); ?>',
                  type: "POST",
                  data: ({ 'ajax'       : '1',
                           'id_invoice' : invoiceId
                        }),
                  success: function(response) {
                                if(response == 'FALSE') {
                                    alert('Can not close invoice');
                                } else {
                                    $('#open_invoices_table').html(response).show('slow');
                                }
                           }
                });
                return false;
        }

        function deleteInvoice(invoiceId) {
                $.ajax({
                  url: '<?php echo site_url('invoice/delete'); ?>',
                  type: "POST",
                  data: ({ 'ajax'       : '1',
                           'id_invoice' : invoiceId
                        }),
                  success: function(response) {
                                if(response == 'FALSE') {
                                    alert('Can not delete invoice');
                                } else {
                                    $('#open_invoices_table').html(response).show('slow');
                                }
                           }
                });
                return false;
        }
    </script>


</head>
<body>
    <div id="wrapper">
        <div id="header">
            <div class="content">
                <?php if($this->uri->segment(1) == '') { ?>
                <p class="current_amount">
                    Current Amount: <?php echo $current_amount; ?> LTL
                    Done: <?php echo $done_amount; ?> LTL 
                </p>
                <?php } ?>
<<<<<<< HEAD
                <div class="settings_buttons">
                    <a  href="<?php echo site_url('/settings'); ?>">Settings</a>
                    <a  href="<?php echo site_url('/login/logout'); ?>">Sign Out</a>                   
                </div>
                <h1><a href="<?php echo site_url('/'); ?>"><?php echo $settings['0']['value']; ?> </a></h1>
=======
                <a class="sign_out_button" href="<?php echo site_url('/login/out'); ?>">Sign Out</a>
                <h1><a href="<?php echo site_url('/'); ?>">Company Name</a></h1>
>>>>>>> master
            </div>
        </div>
        <div id="content">