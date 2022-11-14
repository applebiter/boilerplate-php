<div class="row gx-5 align-items-center justify-content-center">

    <div class="col-lg-7">
        <h2>
            <i class="bi bi-speedometer2 me-2"></i>
            <?= __('Admin Dashboard') ?>
        </h2>
        <p class="small">
            <?= __('Starting place for managing this Web application.') ?>
        </p>
        <?= $this->Flash->render() ?>

        <div class="row gx-3">

            <div class="col-md-6 col-xl-4">
                <div class="card border-secondary mb-3">
                    <div class="card-header text-danger">
                        <?= __('Authorization') ?>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="bi bi-map me-1"></i>
                            <?= __('Application Endpoints') ?>
                        </h5>
                        <p class="card-text">
                            <?= __('Create endpoints for each available resource that requires authorization.') ?>
                        </p>
                        <button type="button" class="btn btn-outline-default btn-sm" onclick="window.location='/admin/resources'">
                            <?= __('View All') ?>
                            <i class="bi bi-forward-fill ms-1"></i>
                        </button>
                        <button type="button" class="btn btn-outline-default btn-sm" onclick="window.location='/admin/resources'">
                            <?= __('Add New') ?>
                            <i class="bi bi-plus-lg ms-1"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-4">
                <div class="card border-secondary mb-3">
                    <div class="card-header text-danger">
                        <?= __('Authorization') ?>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="bi bi-file-lock2 me-1"></i>
                            <?= __('Endpoint Permissions') ?>
                        </h5>
                        <p class="card-text">
                            <?= __('Define specific permissions for each resource based on user role.') ?>
                        </p>
                        <button type="button" class="btn btn-outline-default btn-sm" onclick="window.location='/admin/permissions'">
                            <?= __('View All') ?>
                            <i class="bi bi-forward-fill ms-1"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-4">
                <div class="card border-secondary mb-3">
                    <div class="card-header text-danger">
                        <?= __('Authorization') ?>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="bi bi-person-badge me-1"></i>
                            <?= __('User Role Definitions') ?>
                        </h5>
                        <p class="card-text">Add &amp; List</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-4">
                <div class="card border-secondary mb-3">
                    <div class="card-header text-success">
                        <?= __('User Media') ?>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?= __('User Avatars') ?></h5>
                        <p class="card-text">Add &amp; List</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-4">
                <div class="card border-secondary mb-3">
                    <div class="card-header text-success">
                        <?= __('User Media') ?>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?= __('User Images') ?></h5>
                        <p class="card-text">Add &amp; List</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-4">
                <div class="card border-secondary mb-3">
                    <div class="card-header text-success">
                        <?= __('User Media') ?>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?= __('User Sounds') ?></h5>
                        <p class="card-text">Add &amp; List</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-4">
                <div class="card border-secondary mb-3">
                    <div class="card-header text-warning">
                        <?= __('User Data') ?>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?= __('User Session Data') ?></h5>
                        <p class="card-text">Add &amp; List</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-4">
                <div class="card border-secondary mb-3">
                    <div class="card-header text-warning">
                        <?= __('User Data') ?>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?= __('Application Users') ?></h5>
                        <p class="card-text">Add &amp; List</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-4">
                <div class="card border-secondary mb-3">
                    <div class="card-header text-info">
                        <?= __('Reference Data') ?>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?= __('Mobile Carriers') ?></h5>
                        <p class="card-text">Add &amp; List</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-4">
                <div class="card border-secondary mb-3">
                    <div class="card-header text-info">
                        <?= __('Reference Data') ?>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?= __('Countries') ?></h5>
                        <p class="card-text">Add &amp; List</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-4">
                <div class="card border-secondary mb-3">
                    <div class="card-header text-info">
                        <?= __('Reference Data') ?>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?= __('States of the US') ?></h5>
                        <p class="card-text">Add &amp; List</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-4">
                <div class="card border-secondary mb-3">
                    <div class="card-header text-info">
                        <?= __('Reference Data') ?>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?= __('Timezones') ?></h5>
                        <p class="card-text">Add &amp; List</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        
        

    </div>
</div>

