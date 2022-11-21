<div class="row gx-5 align-items-center justify-content-center">

    <div class="col-xl-5">
        <h2>
            <i class="bi bi-speedometer2 me-2"></i>
            <?= __('Admin Dashboard') ?>
        </h2>
        <p class="small">
            <?= __('Starting place for managing this Web application.') ?>
        </p>
        <?= $this->Flash->render() ?>

        <div class="row gx-3 mt-4">

            <div class="col-md-6">
                <div class="card mb-3 border-danger">
                    <div class="card-header text-danger">
                        <?= __('Authorization') ?>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="bi bi-pin-map-fill me-1"></i>
                            <?= __('Endpoints') ?>
                        </h5>
                        <p class="card-text text-muted">
                            <?= __('Resources requiring authorization.') ?>
                        </p>
                        <button type="button" class="btn btn-outline-default btn-sm" onclick="window.location='/admin/resources'">
                            <?= __('View All') ?>
                            <i class="bi bi-forward-fill ms-1"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mb-3 border-danger">
                    <div class="card-header text-danger">
                        <?= __('Authorization') ?>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="bi bi-file-lock2 me-1"></i>
                            <?= __('Permissions') ?>
                        </h5>
                        <p class="card-text text-muted">
                            <?= __('Role-based permissions for endpoints.') ?>
                        </p>
                        <button type="button" class="btn btn-outline-default btn-sm" onclick="window.location='/admin/permissions'">
                            <?= __('View All') ?>
                            <i class="bi bi-forward-fill ms-1"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mb-3 border-danger">
                    <div class="card-header text-danger">
                        <?= __('Authorization') ?>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="bi bi-person-badge me-1"></i>
                            <?= __('Roles') ?>
                        </h5>
                        <p class="card-text text-muted">
                            <?= __('Define the user roles in the application.') ?>
                        </p>
                        <button type="button" class="btn btn-outline-default btn-sm" onclick="window.location='/admin/roles'">
                            <?= __('View All') ?>
                            <i class="bi bi-forward-fill ms-1"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mb-3 border-success">
                    <div class="card-header text-success">
                        <?= __('User Media') ?>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="bi bi-person-circle me-1"></i>
                            <?= __('Avatars') ?>
                        </h5>
                        <p class="card-text text-muted">
                            <?= __('Review the user avatar images.') ?>
                        </p>
                        <button type="button" class="btn btn-outline-default btn-sm" onclick="window.location='/admin/avatars'">
                            <?= __('View All') ?>
                            <i class="bi bi-forward-fill ms-1"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mb-3 border-success">
                    <div class="card-header text-success">
                        <?= __('User Media') ?>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="bi bi-card-image me-1"></i>
                            <?= __('Images') ?>
                        </h5>
                        <p class="card-text text-muted">
                            <?= __('Review all user-uploaded images.') ?>
                        </p>
                        <button type="button" class="btn btn-outline-default btn-sm" onclick="window.location='/admin/images'">
                            <?= __('View All') ?>
                            <i class="bi bi-forward-fill ms-1"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mb-3 border-success">
                    <div class="card-header text-success">
                        <?= __('User Media') ?>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="bi bi-soundwave me-1"></i>
                            <?= __('Sounds') ?>
                        </h5>
                        <p class="card-text text-muted">
                            <?= __('Review all user-uploaded sounds.') ?>
                        </p>
                        <button type="button" class="btn btn-outline-default btn-sm" onclick="window.location='/admin/sounds'">
                            <?= __('View All') ?>
                            <i class="bi bi-forward-fill ms-1"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mb-3 border-warning">
                    <div class="card-header text-warning">
                        <?= __('User Data') ?>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="bi bi-gear me-1"></i>
                            <?= __('Sessions') ?>
                        </h5>
                        <p class="card-text text-muted">
                            <?= __('Review all available session data.') ?>
                        </p>
                        <button type="button" class="btn btn-outline-default btn-sm" onclick="window.location='/admin/sessions'">
                            <?= __('View All') ?>
                            <i class="bi bi-forward-fill ms-1"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mb-3 border-warning">
                    <div class="card-header text-warning">
                        <?= __('User Data') ?>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="bi bi-person me-1"></i>
                            <?= __('Users') ?>
                        </h5>
                        <p class="card-text text-muted">
                            <?= __('Review all application users\' data.') ?>
                        </p>
                        <button type="button" class="btn btn-outline-default btn-sm" onclick="window.location='/admin/sounds'">
                            <?= __('View All') ?>
                            <i class="bi bi-forward-fill ms-1"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mb-3 border-info">
                    <div class="card-header text-info">
                        <?= __('Reference Data') ?>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="bi bi-phone-vibrate me-1"></i>
                            <?= __('Carriers') ?>
                        </h5>
                        <p class="card-text text-muted">
                            <?= __('Review all wireless service carriers.') ?>
                        </p>
                        <button type="button" class="btn btn-outline-default btn-sm" onclick="window.location='/admin/sounds'">
                            <?= __('View All') ?>
                            <i class="bi bi-forward-fill ms-1"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mb-3 border-info">
                    <div class="card-header text-info">
                        <?= __('Reference Data') ?>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="bi bi-globe me-1"></i>
                            <?= __('Countries') ?>
                        </h5>
                        <p class="card-text text-muted">
                            <?= __('Review all countries.') ?>
                        </p>
                        <button type="button" class="btn btn-outline-default btn-sm" onclick="window.location='/admin/countries'">
                            <?= __('View All') ?>
                            <i class="bi bi-forward-fill ms-1"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mb-3 border-info">
                    <div class="card-header text-info">
                        <?= __('Reference Data') ?>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="bi bi-globe me-1"></i>
                            <?= __('States') ?>
                        </h5>
                        <p class="card-text text-muted">
                            <?= __('Review all US states.') ?>
                        </p>
                        <button type="button" class="btn btn-outline-default btn-sm" onclick="window.location='/admin/states'">
                            <?= __('View All') ?>
                            <i class="bi bi-forward-fill ms-1"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mb-3 border-info">
                    <div class="card-header text-info">
                        <?= __('Reference Data') ?>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="bi bi-clock me-1"></i>
                            <?= __('Timezones') ?>
                        </h5>
                        <p class="card-text text-muted">
                            <?= __('Review all time zones.') ?>
                        </p>
                        <button type="button" class="btn btn-outline-default btn-sm" onclick="window.location='/admin/zones'">
                            <?= __('View All') ?>
                            <i class="bi bi-forward-fill ms-1"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-7">
        
        

    </div>
</div>

