<?php include 'header.php'; ?>
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Preview Export Rangking</h1>

    <div class="card shadow mb-4">
        <div class="card-body text-center">
            <iframe src="export_rangking_pdf.php" width="100%" height="600px" style="border:1px solid #ccc;"></iframe>
            <br><br>
            <a href="export_rangking_pdf.php" class="btn btn-danger" target="_blank">
                <i class="fas fa-file-download"></i> Download PDF
            </a>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>