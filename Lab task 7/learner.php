<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Dashboard</title>
    <link href="css/modern.css" rel="stylesheet">
    <script src="js/settings.js"></script>
</head>

<body>
    <div class="wrapper">
        <?php
        include 'sidebar.php';
        ?>
        <div class="main">
            <?php
            include 'navbar.php';
            ?>
            <main class="content">
                <div class="container-fluid">

                    <div class="header">
                        <h1 class="header-title">
                            Add Learner
                        </h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Add Learner</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Horizontal form</h5>
                                    <h6 class="card-subtitle text-muted">Horizontal Bootstrap layout.</h6>
                                </div>
                                <div class="card-body">
                                    <form id="validation-form">
                                        <div class="form-group row" >
                                            <label class="col-form-label col-sm-2 text-sm-right">Email</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="validation-email" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-sm-2 text-sm-right">Password</label>
                                            <div class="col-sm-10">
                                            <input type="password" class="form-control" name="validation-password" placeholder="Password">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-sm-2 text-sm-right">Textarea</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" placeholder="Textarea" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <fieldset class="form-group">
                                            <div class="row">
                                                <label class="col-form-label col-sm-2 text-sm-right pt-sm-0">Radios</label>
                                                <div class="col-sm-10">
                                                    <div class="custom-controls-stacked">
                                                        <label class="custom-control custom-radio">
                                                            <input name="custom-radio-3" type="radio" class="custom-control-input">
                                                            <span class="custom-control-label">Default radio</span>
                                                        </label>
                                                        <label class="custom-control custom-radio">
                                                            <input name="custom-radio-3" type="radio" class="custom-control-input">
                                                            <span class="custom-control-label">Second default radio</span>
                                                        </label>
                                                        <label class="custom-control custom-radio">
                                                            <input name="custom-radio-3" type="radio" class="custom-control-input" disabled>
                                                            <span class="custom-control-label">Disabled radio</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <div class="form-group row">
                                            <label class="col-form-label col-sm-2 text-sm-right pt-sm-0">Checkbox</label>
                                            <div class="col-sm-10">
                                                <label class="custom-control custom-checkbox m-0">
                                                    <input type="checkbox" class="custom-control-input">
                                                    <span class="custom-control-label">Check me out</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-10 ml-sm-auto">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            <?php
            include 'footer.php';
            ?>

        </div>

    </div>

    <!-- Javascript Start from here -->
    <script src="js/app.js"></script>

    <script>
        $(function() {
            // Initialize validation
            $("#validation-form").validate({
                focusInvalid: false,
                rules: {
                    "validation-email": {
                        required: true,
                        email: true
                    },
                    "validation-password": {
                        required: true,
                        minlength: 8,
                        maxlength: 20
                    }
                },
                // Errors
                errorPlacement: function errorPlacement(error, element) {
                    var $parent = $(element).parents(".form-group .col-sm-10");
                    // Do not duplicate errors
                    if ($parent.find(".jquery-validation-error").length) {
                        return;
                    }
                    $parent.append(
                        error.addClass("jquery-validation-error small form-text invalid-feedback")
                    );
                },
                highlight: function(element) {
                    var $el = $(element);
                    var $parent = $el.parents(".form-group");
                    $el.addClass("is-invalid");
                    // Select2 and Tagsinput
                    if ($el.hasClass("select2-hidden-accessible") || $el.attr("data-role") === "tagsinput") {
                        $el.parent().addClass("is-invalid");
                    }
                },
                unhighlight: function(element) {
                    $(element).parents(".form-group").find(".is-invalid").removeClass("is-invalid");
                }
            });
        });
    </script>

</body>

</html>