<?php
foreach ($certificat as $r) {
    $file_path = FCPATH . str_replace('./', '', $r->path);
    $file_content = '';

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
        } else {
            $cert = "<div id='certok'><h3>Certified <span class='status-icon bg-success'></span></h3></div>";
        }
    } else {
        $cert = "<div id='certno'><h3>File Not Found <span class='status-icon bg-danger'></span></h3></div>";
    }

    // Mostra i dati nel tavolo
    ?>
    <tr>
        <td>
            <a data-toggle='modal' data-target='#documento<?= $r->id ?>'>
                <img src='<?= base_url("images/file.png") ?>' width='30'><?= htmlspecialchars($r->path, ENT_QUOTES, 'UTF-8') ?>
            </a>
        </td>
        <td><?= $cert ?></td>
        <td>
            <div class="user-panel-actions">
                <a href="<?= base_url($r->path) ?>" class="alert-close"><i class="fas fa-pencil-alt"></i></a>
            </div>
        </td>
        <td>
            <a href="<?= base_url("index.php/admin/deletefile/{$r->id}") ?>" class="alert-close"><i class="fas fa-times"></i></a>
        </td>
    </tr>
    <?php
}
?>
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

$(".close").click(function() {
	$('.modal').modal('hide');
});
</script>