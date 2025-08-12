<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Archive</title>
</head>
<body>
    <h1>Upload File</h1>
    <?php echo form_open_multipart('upload/archive'); ?>
        <p>
            <label for="folderSelect">Existing Folders</label>
            <select id="folderSelect">
                <option value="">-- Select --</option>
                <?php if(!empty($folders)){ foreach($folders as $fol){ ?>
                    <option value="<?=html_escape($fol->cartella);?>"><?=html_escape($fol->cartella);?></option>
                <?php } } ?>
            </select>
        </p>
        <p>
            <label for="folder">Folder</label>
            <input type="text" name="folder" id="folder" value="<?=html_escape($unicode);?>">
        </p>
        <p>
            <label for="archive">File</label>
            <input type="file" name="archive" id="archive" required>
        </p>
        <p>
            <label for="newname">New Name</label>
            <input type="text" name="newname" id="newname">
        </p>
        <p>
            <label for="scadenza">Scadenza</label>
            <input type="text" name="scadenza" id="scadenza" required>
        </p>
        <p>
            <label for="pubblic">Identificativo</label>
            <input type="text" name="pubblic" id="pubblic" required>
        </p>
        <button type="submit">Upload</button>
    <?php echo form_close(); ?>
    <script>
    document.getElementById('folderSelect').addEventListener('change',function(){
        document.getElementById('folder').value=this.value;
    });
    </script>
</body>
</html>

