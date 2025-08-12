<main class='content'>
    <div class='container-fluid'>
        <div class='content-header'>
            <h1><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></h1>
            <nav aria-label='breadcrumb'>
                <ol class='breadcrumb'>
                    <li class='breadcrumb-item'><a href='dashboard-1.html'>Dashboard</a></li>
                    <li class='breadcrumb-item active'>Archive</li>
                </ol>
            </nav>
        </div>

        <div class='row'>
            <div class='col-lg-12'>
                <form class='box needs-validation' novalidate method='post' action='<?= base_url('index.php/admin/archive') ?>' enctype='multipart/form-data'>
                    <div class='box-body'>
                        <div class='row'>
                            <div class='col-sm-12 form-group'>
                                <label for='folder'><b>Select Folder</b></label>
                                <select id='folder' name='folder' class='form-control'>
                                    <option value=''>-- Choose folder --</option>
                                    <?php foreach ($files as $fol) { ?>
                                        <option value='<?= htmlspecialchars($fol->cartella, ENT_QUOTES, 'UTF-8') ?>'>
                                            <?= htmlspecialchars($fol->cartella, ENT_QUOTES, 'UTF-8') ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class='col-sm-12 form-group'>
                                <label for='archive'><b>Choose File</b></label>
                                <input id='archive' type='file' name='archive' class='form-control' required>
                                <span class='invalid-feedback'>File is required.</span>
                            </div>
                            <div class='col-sm-12 form-group'>
                                <label for='newname'><b>Rename File (optional)</b></label>
                                <input id='newname' type='text' name='newname' class='form-control'>
                            </div>
                            <div class='col-sm-12 form-group'>
                                <label for='scadenza'><b>Expiration Date</b></label>
                                <input id='scadenza' type='date' name='scadenza' class='form-control' required>
                                <span class='invalid-feedback'>Expiration date required.</span>
                            </div>
                            <div class='col-sm-12 form-group'>
                                <label for='pubblic'><b>Public Identifier</b></label>
                                <input id='pubblic' type='text' name='pubblic' value='<?= htmlspecialchars($unicode, ENT_QUOTES, 'UTF-8') ?>' class='form-control' readonly>
                            </div>
                        </div>
                    </div>
                    <div class='box-footer'>
                        <button class='btn btn-primary pull-right'>Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
