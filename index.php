<?php require "header.tpl"; ?>
<?php require "main.tpl"; ?>
<div class="container mt-5">
    <div id="accordion">
        <div class="card">
            <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Задания
                    </button>
                </h5>
            </div>

            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                    <pre><?php require "tasks.txt"; ?></pre>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require "footer.tpl"; ?>
