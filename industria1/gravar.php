<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="row g-3 align-items"><!-- align-items-end para alinhar os cards pela base -->
                <div class="cols-12 col-md-12 mb-0"><!-- mb-0 remove margem inferior -->
                    <div class="card" style="height:55vh; min-height:120px; max-height:400px; margin-bottom:0;">
                        <div class="card-header" style="background-color: #ffeba7; color:#ffeba7;">
                            <b>teste</b>
                        </div>
                        <div class="card-body" style="background:#fff; border-radius:8px; overflow-x:auto; height:100%;">
                            <div class="row g-3 align-items">
                                <div class="cols-12 col-md-6 mb-0">
                                    <?php include "TaxaProd.php"; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</body>
</html>