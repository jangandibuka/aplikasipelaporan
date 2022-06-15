<style>
    .info-box {
        min-height: auto;
        text-align: center;
    }

    .info-box-number {
        font-size: 20px;
        padding-top: 20px;
        padding-bottom: 20px;
        text-align: center;
    }

    .info-box-title {
        background-color: rgba(0, 0, 0, 0.2);
    }

    .checked {
        color: orange;
    }

    .overlay {
        background-color: rgba(0, 0, 0, .7) !important;
        background-color: rgba(0, 0, 0, .3) !important;
        width: 100%;
        height: 100%;
        position: absolute;
        left: 0;
        top: 0;
        color: white;
        z-index: 999 !important;
    }

    .overlay-content {
        position: absolute;
        text-align: center;
        width: 100%;
        height: 100%;
        top: 50%;
        font-size: 18px;
    }

    .p-0 {
        padding: 0 !important;
    }

    .m-0 {
        margin: 0 !important;
    }
</style>

<script src="<?php echo base_url('assets/js/jquery-1.12.0.min.js') ?>"></script>

<section class="content">
    <?php
    $this->load->view('dashboard/dashboard_admin/taruna')
    ?>
    <?php
    $this->load->view('dashboard/dashboard_admin/pegawai')
    ?>
</section>

<script>
    // const COLORS_CHART = [
    //     '#4dc9f6',
    //     '#f67019',
    //     '#f53794',
    //     '#537bc4',
    //     '#acc236',
    //     '#166a8f',
    //     '#00a950',
    //     '#58595b',
    //     '#8549ba'
    // ];
    const COLORS_CHART = [
        'rgba(255, 99, 132)',
        'rgba(255, 206, 86)',
        'rgba(54, 162, 235)',
        'rgba(75, 192, 192)',
        'rgba(153, 102, 255)',
        'rgba(255, 159, 64)'
    ];

    var overlay = '<div class="overlay"><div class="overlay-content"><i class="fa fa-refresh fa-spin"></i> Loading...</div></div>';

    var loading = {
        start: function(elm) {
            $(elm).append(overlay);
        },
        stop: function(elm) {
            $(`${elm} .overlay`).remove();
        }
    }
</script>