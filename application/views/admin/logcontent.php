<main class="content">
    <div class="container-fluid">
        <div class="content-header">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/home">Dashboard</a></li>
                    <li class="breadcrumb-item active">Log</li>
                </ol>
            </nav>
        </div>
        <div>
            <h1>Log Content
                <a href="<?php echo base_url(); ?>admin/deleteLog" class="btn btn-danger float-right">Reset</a>
                <a href="<?php echo base_url(); ?>admin/esportaLog" class="btn btn-info float-right">Export</a>
            </h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <div class="box-header">
                        <h3>
                            <?= $title ?>
                        </h3>
                    </div>
                    <div class="box-body">
                        <?= $content ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
