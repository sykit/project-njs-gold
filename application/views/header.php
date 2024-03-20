<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMItA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="shortcut icon" href="<?= base_url(); ?>public/images/favicon2.png" type="image/x-icon">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet"
        type="text/css" />
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url();?>public/css/style.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="<?= base_url(); ?>public/js/core/ajquery.min.js"></script>

</head>

<body data-url="<?= base_url(); ?>" 
    data-authenticated="<?= $this->session->userdata('authenticated');?>"
    data-fgroupid="<?= $this->session->userdata('func_group_id');?>" 
    data-userid="<?= $this->session->userdata('user_id');?>"
    data-username="<?= $this->session->userdata('username');?>"
    data-email="<?= $this->session->userdata('email');?>"
    data-surname="<?= $this->session->userdata('surname');?>"
    data-fgroupname="<?= $this->session->userdata('func_group_name');?>"
    >
    <!-- include alerts icon -->
    <?php
    $this->load->view('components/alerts-icon');
    ?>
    <!-- end alerts icon -->

    <main data-url="<?= base_url(); ?>">