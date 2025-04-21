<?php
// Nome utente loggato (dinamico in base alla sessione)
$logged_user = htmlspecialchars($this->session->userdata('username'), ENT_QUOTES, 'UTF-8');

// Percorso base dinamico per i file caricati dall'utente
$base_upload_path = './cripted/archivio/' . $logged_user . '/';
?>

<main class="content">
  <div class="container-fluid">
    <div class="content-header">
      <h1>Tampered certified archiving of digital files</h1>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard-1.html">Dashboard</a></li>
          <li class="breadcrumb-item active">File Upload</li>
        </ol>
      </nav>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <?php
        // Form per il caricamento del file
        $attributes = array("name" => "archive", "id" => "archive");
        echo form_open_multipart("admin/archive", $attributes);
        ?>
        <div class="box-header">
          <h3></h3>
        </div>
        <div class="box-body">
          <!-- Seleziona file -->
          <div class="row">
            <div class="col-sm-12 form-group">
              <label for="jsValidationFirstName">
                <b>SELECT A FILE OR A COMPRESSED FOLDER </b><sup class="text-danger">*</sup>
              </label>
              <input id="jsValidationFile" type="file" name="archive" class="form-control" required>
              <p>(.zip o .rar) Currently Encrypter supports the following formats: 'txt', 'doc', 'xls', 'pdf', 'odt', 'jpg', 'pps', 'mp3', 'avi', 'mp4', 'gif', 'zip', 'rar', 'htm', 'html'</p>
            </div>
          </div>

          <!-- Seleziona cartella -->
          <div class="row">
            <div class="col-sm-12 form-group">
              <label for="jsValidationFirstName">
                <b>SELECT FOLDER WHERE YOU WANT TO KEEP FILE </b><sup class="text-danger">*</sup>
              </label>
              <select name="folder" class="form-control">
                <option value="">Select</option>
                <?php foreach ($files as $fol) : ?>
                  <option value="<?= htmlspecialchars($fol->cartella, ENT_QUOTES, 'UTF-8') ?>">
                    <?= htmlspecialchars($fol->cartella, ENT_QUOTES, 'UTF-8') ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <!-- Rinomina file -->
          <div class="row">
            <div class="col-12 form-group">
              <label for="jsValidationAddress"><b>Rename File</b></label>
              <input name="newname" id="jsValidationapubblic" type="text" class="form-control" placeholder="Rename File">
            </div>
          </div>

          <!-- Codice operatore -->
          <div class="row">
            <div class="col-12 form-group">
              <label for="jsValidationAddress"><b>Operator verification code: <?= htmlspecialchars($unicode, ENT_QUOTES, 'UTF-8') ?> </b></label>
              <input name="as2" id="jsValidationas2" type="text" class="form-control" placeholder="Enter the verification code">
              <input type="hidden" name="as1" value="<?= htmlspecialchars($unicode, ENT_QUOTES, 'UTF-8') ?>">
            </div>
          </div>

          <!-- Data scadenza -->
          <div class="row">
            <div class="col-12 form-group">
              <p>
                <input name="scadenza" id="datepicker" type="text" class="form-control" autocomplete="off" placeholder="Click in the field to enter the date">
              </p>
            </div>
          </div>
        </div>

        <!-- Pulsante invio -->
        <div class="box-footer">
          <button type="submit" class="btn btn-primary pull-right">Invia</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</main>

<script>
  // Inizializza il datepicker
  $(function() {
    $("#datepicker").datepicker();
  });
</script>