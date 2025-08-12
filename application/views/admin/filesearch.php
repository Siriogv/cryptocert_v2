<?php
$this->load->helper('qrcode');
$this->load->model('model_object');
?>
<main class="content">
    <div class="container-fluid">
        <div class="content-header">
            <h1><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard-1.html">Dashboard</a></li>
                    <li class="breadcrumb-item active">Search File</li>
                </ol>
            </nav>
        </div>

        <?php if (is_array($certificat) && count($certificat) > 0) { ?>
        <div class="row table-responsive">
            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name" class="form-control mb-3">
            <table id="myTable" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                <?php
                $i = 1;
                foreach ($certificat as $r) {
                    $file_path = FCPATH . str_replace('./', '', $r->path);
                    $file_hash = null;
                    $cert = '';
                    $doc_v = base_url("images/file.png");

                    // Verifica se il file esiste
                    if (file_exists($file_path)) {
                        $file_content = file_get_contents($file_path);
                        $file_hash = hash($r->codifica, $file_content);

                        // Confronta l'hash
                        if ($file_hash !== $r->contenuto) {
                            $ins['alert'] = 1;
                            $this->db->where('id', $r->id);
                            $this->db->update("contenuto_certificato", $ins);
                            $cert = "<div id='certno'><h3>Not Certified <span class='status-icon bg-warning'></span></h3></div>";
                            $doc_v = base_url("images/file_broken.png");
                        } else {
                            $cert = "<div id='certok'><h3>Certified <span class='status-icon bg-success'></span></h3></div>";
                        }
                    } else {
                        $cert = "<div id='certno'><h3>File Not Found <span class='status-icon bg-danger'></span></h3></div>";
                        $doc_v = base_url("images/file_broken.png");
                    }

                    // Genera il codice QR
                    $qrcode = new QRCode();
                    $qrcode->setData(base_url() . "/index.php/admin/file?h=" . urlencode($r->hex));
                    $qrcode->setOutputEncoding(QRCode::$_ENCODING_UTF8);
                    $qrcode->setOutPutFormat(QRCode::$_OUTPUT_FORMAT_PNG);
                    $qrcode_url = $qrcode->getUrlQuery();

                    // Mostra i dati nel tavolo
                    ?>
                    <tr>
                        <td>
                            <div class='col-md-12'>
                                <a data-toggle='modal' data-target='#documento<?= $r->id ?>'>
                                    <img src='<?= $doc_v ?>' width='30'><?= htmlspecialchars(basename($r->path), ENT_QUOTES, 'UTF-8') ?>
                                </a>
                            </div>

                            <div id='documento<?= $r->id ?>' class='modal'>
                                <div class="modal-content col-lg-6">
                                    <span class="close" onclick="closeModal(<?= $r->id ?>)">&times;</span>
                                    <div class="col-lg-6">
                                        <?= $cert ?>
                                        <div><img src="<?= $qrcode_url ?>" alt="QR Code"></div>
                                        <form action='<?= $_SERVER['PHP_SELF'] ?>' method='POST'>
                                            <?php if (empty($r->bclink)) { ?>
                                                <input type='hidden' name='id' value='<?= $r->id ?>'><br>
                                                <span>
                                                    <a href='<?= base_url("index.php/admin/certifyfile?docid={$r->id}") ?>'>Certify in Metamask</a>
                                                </span>
                                            <?php } else { ?>
                                                <span><h5><b>Blockchain Link:</b><br><?= htmlspecialchars($r->bclink, ENT_QUOTES, 'UTF-8') ?></h5></span>
                                                <span><h5><b>Transaction Id:</b><br><?= htmlspecialchars($r->bc, ENT_QUOTES, 'UTF-8') ?></h5></span>
                                                <span><h5><b>Notarizing Date:</b><br><?= htmlspecialchars($r->data, ENT_QUOTES, 'UTF-8') ?></h5></span>
                                            <?php } ?>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td><?= $cert ?></td>
                        <td>
                            <div class="user-panel-actions">
                                <a href="<?= base_url($r->path) ?>" class="alert-close"><i class="fas fa-pencil-alt"></i></a>
                            </div>
                        </td>
                        <td>
                            <a href="<?= base_url("index.php/admin/deletefile/{$r->id}") ?>" data-widget="dismiss" class="alert-close"><i class="fas fa-times"></i></a>
                        </td>
                    </tr>
                <?php $i++;
                } ?>
            </table>
        </div>
        <?php } else { ?>
        <div class="alert alert-info">No records found.</div>
        <?php } ?>
    </div>
</main>

<script>
function myFunction() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

function closeModal(id) {
    document.getElementById('documento' + id).style.display = 'none';
}

$(".close").click(function() {
    $('.modal').modal('hide');
});
</script>